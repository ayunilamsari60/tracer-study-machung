<?php
include "config/koneksi.php";

// Ambil nilai tahun_isian yang sudah disetting di ts_konfigurasi
$sql_konfigurasi = "SELECT tahun_isian FROM ts_konfigurasi LIMIT 1";
$result_konfigurasi = $conn->query($sql_konfigurasi);
$tahun_isian = '';

// Ambil tahun_isian dari ts_konfigurasi
if ($result_konfigurasi && $result_konfigurasi->num_rows > 0) {
    $row = $result_konfigurasi->fetch_assoc();
    $tahun_isian = $row['tahun_isian'];
}

// Query untuk mendapatkan semua prodi dan jumlah mahasiswa yang sudah/belum mengisi
$sql = "
SELECT 
    tp.nama_prodi,
    COUNT(m.id_user) AS total,
    SUM(CASE WHEN s.id_register IS NOT NULL THEN 1 ELSE 0 END) AS sudah,
    SUM(CASE WHEN m.thn_ajaran = ? AND s.id_register IS NULL THEN 1 ELSE 0 END) AS belum
FROM ts_data_prodi tp
LEFT JOIN ts_data_mahasiswa1 m ON tp.id = m.id_prodi
LEFT JOIN ts_register_mahasiswa r ON m.id_user = r.id_user AND r.tahun_isian = ?
LEFT JOIN submit_data s ON r.id_register = s.id_register
GROUP BY tp.id
ORDER BY tp.nama_prodi ASC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $tahun_isian, $tahun_isian);  // Bind tahun_isian untuk kedua filter
$stmt->execute();
$result = $stmt->get_result();
$data = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            'prodi' => $row['nama_prodi'],
            'sudah' => (int)$row['sudah'],
            'belum' => (int)$row['belum']
        ];
    }
} else {
    // Jika tidak ada data, kembalikan array kosong
    $data = [];
}

header('Content-Type: application/json');
echo json_encode($data);
?>
