<?php
require '../config/koneksi.php'; // Pastikan koneksi benar

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tahun_lulus'])) {
    $tahun = $_POST['tahun_lulus'];

    // Debug: Cek apakah tahun terkirim
    if (empty($tahun)) {
        die("Error: Tahun tidak dikirim!");
    }

    $stmt = $conn->prepare("SELECT nama FROM ts_data_mahasiswa WHERE tahun_kelulusan = ?");
    $stmt->execute([$tahun]);
    $data_mahasiswa = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Debug: Cek apakah data ditemukan
    if (!$data_mahasiswa) {
        die("Error: Tidak ada data untuk tahun $tahun!");
    }

    // Jika data ada, kirim dalam format HTML
    echo '<option value="">Pilih Nama</option>';
    foreach ($data_mahasiswa as $nama) {
        echo '<option value="' . htmlspecialchars($nama) . '">' . htmlspecialchars($nama) . '</option>';
    }
    exit();
}

// Jika tidak ada request POST
die("Error: Request tidak valid!");
