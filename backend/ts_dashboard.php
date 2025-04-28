<?php 
include "config/koneksi.php"; // Ganti path sesuai struktur proyekmu

// Query untuk mengambil nilai tahun_isian dari tabel ts_konfigurasi
$sql_tahun_isian = "SELECT tahun_isian FROM ts_konfigurasi LIMIT 1"; // Mengambil hanya 1 record
$result_tahun_isian = $conn->query($sql_tahun_isian);

// Mengecek hasil query untuk tahun_isian
if ($result_tahun_isian->num_rows > 0) {
    $row_tahun_isian = $result_tahun_isian->fetch_assoc();
    $tahun_isian = $row_tahun_isian['tahun_isian'];
} else {
    echo "Tidak ada konfigurasi tahun isian ditemukan.<br>";
    $tahun_isian = null; // Jika tidak ada data, atur ke null
}

// Query untuk menghitung total mahasiswa terdaftar
$sql_total_mahasiswa = "
    SELECT COUNT(*) AS total_mahasiswa
    FROM ts_data_mahasiswa1 m
    LEFT JOIN ts_register_mahasiswa r ON m.id_user = r.id_user
    LEFT JOIN submit_data s ON r.id_register = s.id_register
    WHERE s.id_register IS NULL
    AND m.thn_ajaran = ?
";
$stmt = $conn->prepare($sql_total_mahasiswa);
$stmt->bind_param("s", $tahun_isian);  // Gantilah dengan nilai tahun_isian yang sesuai
$stmt->execute();
$result_total_mahasiswa = $stmt->get_result();

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
    AND r.tahun_isian = ?  -- Menambahkan WHERE untuk tahun_isian
";

$stmt_total_submit = $conn->prepare($sql_total_submit);
$stmt_total_submit->bind_param("i", $tahun_isian);  // Binding tahun_isian dari hasil query ts_konfigurasi
$stmt_total_submit->execute();
$result_total_submit = $stmt_total_submit->get_result();

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
