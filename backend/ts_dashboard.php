<?php
include "config/koneksi.php"; // Ganti path sesuai struktur proyekmu

// Query untuk mengambil nilai tahun_isian dari tabel ts_konfigurasi
$sql_tahun_isian = "SELECT * FROM ts_konfigurasi LIMIT 1"; // Mengambil hanya 1 record
$result_tahun_isian = $conn->query($sql_tahun_isian);

// Mengecek hasil query untuk tahun_isian
if ($result_tahun_isian->num_rows > 0) {
    $row_tahun_isian = $result_tahun_isian->fetch_assoc();
    $tahun_isian = $row_tahun_isian['tahun_isian'];
    $tahun_mulai = $row_tahun_isian['tahun_lulus_mulai'];
    $tahun_akhir = $row_tahun_isian['tahun_lulus_akhir'];
} else {
    echo "Tidak ada konfigurasi tahun isian ditemukan.<br>";
    $tahun_isian = null; // Jika tidak ada data, atur ke null
}

// Query untuk menghitung total mahasiswa terdaftar
$sql_total_mahasiswa = "
    SELECT COUNT(DISTINCT m.nim_mahasiswa) AS total_mahasiswa
    FROM akademik_master_mahasiswa m
    LEFT JOIN ts_register_mahasiswa r ON m.nim_mahasiswa = r.nim_mahasiswa
    LEFT JOIN ts_form_submit s ON r.id_register = s.id_register
    LEFT JOIN akademik_transaksi_wisuda_detail d ON m.nim_mahasiswa = d.nim_mahasiswa
    LEFT JOIN akademik_transaksi_wisuda t ON d.id_wisuda = t.id_wisuda
    WHERE s.id_register IS NULL
    AND YEAR(t.tglsk) BETWEEN ? AND ?
";

$stmt = $conn->prepare($sql_total_mahasiswa);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("ii", $tahun_mulai, $tahun_akhir);
$stmt->execute();
$result_total_mahasiswa = $stmt->get_result();

if ($result_total_mahasiswa && $result_total_mahasiswa->num_rows > 0) {
    $row = $result_total_mahasiswa->fetch_assoc();
    $total_mahasiswa = $row['total_mahasiswa'];
} else {
    echo "Tidak ada data mahasiswa yang ditemukan.<br>";
    $total_mahasiswa = 0;
}



// Query untuk menghitung mahasiswa yang sudah di-submit
$sql_total_submit = "
    SELECT COUNT(*) AS total_submit
    FROM akademik_master_mahasiswa m
    LEFT JOIN ts_register_mahasiswa r ON m.nim_mahasiswa = r.nim_mahasiswa
    LEFT JOIN ts_form_submit s ON r.id_register = s.id_register
    WHERE s.id_register IS NOT NULL
    AND r.tahun_isian = ?
";

$stmt_total_submit = $conn->prepare($sql_total_submit);
$stmt_total_submit->bind_param("i", $tahun_isian);  // Gunakan tahun dari tglsk
$stmt_total_submit->execute();
$result_total_submit = $stmt_total_submit->get_result();

if ($result_total_submit && $result_total_submit->num_rows > 0) {
    $row_total_submit = $result_total_submit->fetch_assoc();
    $total_submit = $row_total_submit['total_submit'];
} else {
    echo "Tidak ada data submit yang ditemukan.<br>";
    $total_submit = 0;
}


// Menghitung jumlah mahasiswa yang belum di-submit
$total_belum_submit = $total_mahasiswa - $total_submit;
?>