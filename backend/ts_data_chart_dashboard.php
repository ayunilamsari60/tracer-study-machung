<?php
include "config/koneksi.php";

// Ambil tahun_isian dari tabel konfigurasi
$tahun_isian = null;
$sql_tahun = "SELECT * FROM ts_konfigurasi LIMIT 1";
$result_tahun = $conn->query($sql_tahun);

if ($result_tahun && $result_tahun->num_rows > 0) {
    $row_tahun = $result_tahun->fetch_assoc();
    $tahun_isian = $row_tahun['tahun_isian'];
    $tahun_mulai = $row_tahun['tahun_lulus_mulai'];
    $tahun_akhir = $row_tahun['tahun_lulus_akhir'];
}

// --- Query untuk BARCHART ---
$sql_barchart = "
SELECT 
    tp.nama_prodi,
    COUNT(DISTINCT m.id_user) AS total,  -- Menghitung mahasiswa unik
    SUM(CASE WHEN s.id_register IS NOT NULL THEN 1 ELSE 0 END) AS sudah,
    SUM(
        CASE WHEN 
            m.thn_ajaran BETWEEN '$tahun_mulai' AND '$tahun_akhir'
            AND s.id_register IS NULL 
            AND m.id_user NOT IN (
                SELECT DISTINCT r.id_user
                FROM ts_register_mahasiswa r
                LEFT JOIN ts_form_submit s ON r.id_register = s.id_register
                WHERE s.id_register IS NULL
            ) 
        THEN 1 ELSE 0 END
    ) AS belum
FROM ts_data_prodi tp
LEFT JOIN ts_data_mahasiswa m ON tp.id = m.id_prodi
LEFT JOIN ts_register_mahasiswa r ON m.id_user = r.id_user 
    AND r.tahun_isian = '$tahun_isian'
LEFT JOIN ts_form_submit s ON r.id_register = s.id_register
GROUP BY tp.id
ORDER BY tp.nama_prodi ASC;

";


$result_barchart = $conn->query($sql_barchart);
$barchart_data = [];

if ($result_barchart && $result_barchart->num_rows > 0) {
    while ($row = $result_barchart->fetch_assoc()) {
        $barchart_data[] = [
            'prodi' => $row['nama_prodi'],
            'sudah' => (int)$row['sudah'],
            'belum' => (int)$row['belum']

        ];
    }
}

// --- Query untuk SPILINE AREA CHART ---
$spilinechart_data = [];

for ($i = 0; $i < 5; $i++) {
    $tahun_target = $tahun_isian - $i;
    $tahun_lulus_mulai = $tahun_mulai - $i;
    $tahun_lulus_akhir = $tahun_akhir - $i;

    // Query menghitung sudah mengisi
    $sql_sudah_mengisi = "
        SELECT COUNT(*) AS sudah_mengisi
        FROM ts_register_mahasiswa r
        LEFT JOIN ts_form_submit s ON r.id_register = s.id_register
        WHERE r.tahun_isian = '$tahun_target'
          AND s.id_register IS NOT NULL
    ";
    $result_sudah = $conn->query($sql_sudah_mengisi);
    $row_sudah = $result_sudah->fetch_assoc();
    $sudah_mengisi = (int)$row_sudah['sudah_mengisi'];

    // Query menghitung total mahasiswa di tahun itu
    $sql_total_mahasiswa = "
        SELECT COUNT(*) AS total_mahasiswa
        FROM ts_data_mahasiswa
        WHERE thn_ajaran BETWEEN '$tahun_lulus_mulai' AND '$tahun_lulus_akhir'
    ";
    $result_total = $conn->query($sql_total_mahasiswa);
    $row_total = $result_total->fetch_assoc();
    $total_mahasiswa = (int)$row_total['total_mahasiswa'];

    // Belum mengisi = total mahasiswa - sudah mengisi
    $belum_mengisi = $total_mahasiswa - $sudah_mengisi;

    // Simpan ke array untuk chart
    $spilinechart_data[] = [
        'tahun' => $tahun_target,
        'sudah_mengisi' => $sudah_mengisi,
        'belum_mengisi' => $belum_mengisi
    ];
}





// --- Gabungkan kedua data ---
$response = [
    'barchart' => $barchart_data,
    'spilinechart' => $spilinechart_data
];

header('Content-Type: application/json');
echo json_encode($response);
?>
