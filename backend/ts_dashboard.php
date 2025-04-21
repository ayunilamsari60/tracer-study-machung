<?php 
include "config/koneksi.php"; // Ganti path sesuai struktur proyekmu

// Query untuk menghitung total mahasiswa terdaftar
$sql_total_mahasiswa = "SELECT COUNT(*) AS total_mahasiswa FROM ts_data_mahasiswa1";
$result_total_mahasiswa = $conn->query($sql_total_mahasiswa);

// Mengecek hasil query untuk total mahasiswa
if ($result_total_mahasiswa->num_rows > 0) {
    $row_total_mahasiswa = $result_total_mahasiswa->fetch_assoc();
    $total_mahasiswa = $row_total_mahasiswa['total_mahasiswa'];
} else {
    echo "Tidak ada data mahasiswa yang ditemukan.<br>";
    $total_mahasiswa = 0; // Default jika tidak ada data
}

// Query untuk menghitung mahasiswa yang sudah di-submit
$sql_total_submit = "
    SELECT COUNT(*) AS total_submit
    FROM ts_data_mahasiswa1 m
    LEFT JOIN ts_register_mahasiswa r ON m.id_user = r.id_user
    LEFT JOIN submit_data s ON r.id_register = s.id_register
    WHERE s.id_register IS NOT NULL
";
$result_total_submit = $conn->query($sql_total_submit);

// Mengecek hasil query untuk mahasiswa yang sudah di-submit
if ($result_total_submit->num_rows > 0) {
    $row_total_submit = $result_total_submit->fetch_assoc();
    $total_submit = $row_total_submit['total_submit'];
} else {
    echo "Tidak ada data submit yang ditemukan.<br>";
    $total_submit = 0; // Default jika tidak ada data submit
}

// Menghitung jumlah mahasiswa yang belum di-submit
$total_belum_submit = $total_mahasiswa - $total_submit;
?>