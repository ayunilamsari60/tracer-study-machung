<?php
// Koneksi ke database
include "config/koneksi.php"; // Ganti path sesuai struktur proyekmu

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Ambil data dari tabel, misalnya id = 1
    $query = "SELECT tahun_lulus_mulai, tahun_lulus_akhir, tahun_isian FROM ts_konfigurasi WHERE id = 1";
    $result = $conn->query($query);

    // Cek apakah datanya ada
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $tahun_lulus_mulai = $row["tahun_lulus_mulai"];
        $tahun_lulus_akhir = $row["tahun_lulus_akhir"];
        $tahun_isian = $row["tahun_isian"];
    } else {
        echo "Data belum tersedia.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['filter_success'] = true;

    // Ambil data dari form
    $tahun_mulai = $_POST['tahun_lulus_mulai'];
    $tahun_akhir = $_POST['tahun_lulus_akhir'];
    $tahun_isian = $_POST['tahun_isian'];

    // Query UPDATE (hanya ubah id=1)
    $query = "UPDATE ts_konfigurasi SET 
            tahun_lulus_mulai = '$tahun_mulai',
            tahun_lulus_akhir = '$tahun_akhir',
            tahun_isian = '$tahun_isian'
          WHERE id = 1";

    if ($conn->query($query) === TRUE) {
        echo "Data berhasil diperbarui.";
        header("location: " . base_url("admin/konfigurasi"));
    } else {
        echo "Gagal memperbarui data: " . $conn->error;
    }
}
?>