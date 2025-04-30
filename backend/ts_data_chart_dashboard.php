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
// $sql_barchart = "
// SELECT 
//     mps.nama_prodi_in AS nama_prodi,
//     COUNT(DISTINCT m.nim_mahasiswa) AS total,
//     COUNT(DISTINCT CASE WHEN s.id_register IS NOT NULL THEN m.nim_mahasiswa END) AS sudah,
//     COUNT(DISTINCT CASE 
//         WHEN s.id_register IS NULL AND r.id_register IS NOT NULL
//         THEN m.nim_mahasiswa 
//     END) AS belum
// FROM akademik_master_program_studi mps
// LEFT JOIN akademik_master_mahasiswa m ON m.id_prodi = mps.kode_prodi
// LEFT JOIN akademik_transaksi_wisuda_detail wd ON m.nim_mahasiswa = wd.nim_mahasiswa
// LEFT JOIN akademik_transaksi_wisuda w ON wd.id_wisuda = w.id_wisuda
// LEFT JOIN ts_register_mahasiswa r ON m.nim_mahasiswa = r.nim_mahasiswa AND r.tahun_isian = '$tahun_isian'
// LEFT JOIN ts_form_submit s ON r.id_register = s.id_register
// GROUP BY mps.kode_prodi
// ORDER BY mps.nama_prodi_in ASC

// ";
$sql_barchart = "
SELECT 
    mps.nama_prodi_in AS nama_prodi,
    COUNT(DISTINCT m.nim_mahasiswa) AS total,
    COUNT(DISTINCT CASE WHEN s.id_register IS NOT NULL THEN m.nim_mahasiswa END) AS sudah,
    COUNT(DISTINCT CASE 
        WHEN s.id_register IS NULL THEN m.nim_mahasiswa 
    END) AS belum
FROM akademik_master_program_studi mps
LEFT JOIN akademik_master_mahasiswa m ON m.id_prodi = mps.kode_prodi
LEFT JOIN akademik_transaksi_wisuda_detail wd ON m.nim_mahasiswa = wd.nim_mahasiswa
LEFT JOIN akademik_transaksi_wisuda w ON wd.id_wisuda = w.id_wisuda
LEFT JOIN ts_register_mahasiswa r ON m.nim_mahasiswa = r.nim_mahasiswa AND r.tahun_isian = '$tahun_isian'
LEFT JOIN ts_form_submit s ON r.id_register = s.id_register
GROUP BY mps.kode_prodi
ORDER BY mps.nama_prodi_in ASC

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

    // Query menghitung sudah mengisi (sudah mengisi)
    $sql_sudah_mengisi = "
        SELECT COUNT(DISTINCT m.nim_mahasiswa) AS sudah_mengisi
        FROM akademik_master_mahasiswa m
        LEFT JOIN ts_register_mahasiswa r ON m.nim_mahasiswa = r.nim_mahasiswa
        LEFT JOIN ts_form_submit s ON r.id_register = s.id_register
        LEFT JOIN akademik_transaksi_wisuda_detail wd ON m.nim_mahasiswa = wd.nim_mahasiswa
        LEFT JOIN akademik_transaksi_wisuda w ON wd.id_wisuda = w.id_wisuda
        WHERE r.tahun_isian = '$tahun_target'
          AND s.id_register IS NOT NULL
    ";
    $result_sudah = $conn->query($sql_sudah_mengisi);
    $row_sudah = $result_sudah->fetch_assoc();
    $sudah_mengisi = (int)$row_sudah['sudah_mengisi'];

    // Query menghitung total mahasiswa di tahun itu
    $sql_total_mahasiswa = "
        SELECT COUNT(DISTINCT m.nim_mahasiswa) AS total_mahasiswa
        FROM akademik_master_mahasiswa m
        LEFT JOIN akademik_transaksi_wisuda_detail wd ON m.nim_mahasiswa = wd.nim_mahasiswa
        LEFT JOIN akademik_transaksi_wisuda w ON wd.id_wisuda = w.id_wisuda
        WHERE YEAR(w.tglsk) BETWEEN '$tahun_lulus_mulai' AND '$tahun_lulus_akhir'
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
