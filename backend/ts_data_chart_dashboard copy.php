<?php
include "config/koneksi.php";

// Query utama gabungan
$sql = "
SELECT 
    m.thn_ajaran AS tahun,
    m.id_prodi,
    tp.nama_prodi,
    COUNT(m.id_user) AS total,
    SUM(CASE WHEN s.id_register IS NOT NULL THEN 1 ELSE 0 END) AS sudah,
    SUM(CASE WHEN s.id_register IS NULL THEN 1 ELSE 0 END) AS belum
FROM ts_data_mahasiswa m
LEFT JOIN ts_register_mahasiswa r ON m.id_user = r.id_user
LEFT JOIN submit_data s ON r.id_register = s.id_register
JOIN ts_data_prodi tp ON tp.id = m.id_prodi
GROUP BY m.thn_ajaran, m.id_prodi
ORDER BY m.thn_ajaran DESC, m.id_prodi ASC
";

$result = $conn->query($sql);
$data = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            'tahun' => $row['tahun'],
            'prodi' => $row['nama_prodi'],
            'sudah' => (int)$row['sudah'],
            'belum' => (int)$row['belum']
        ];
    }
} else {
    $data = []; // kosong jika tidak ada data
}

header('Content-Type: application/json');
echo json_encode($data);
?>
