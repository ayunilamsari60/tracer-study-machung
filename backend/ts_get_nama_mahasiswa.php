<?php
require '../config/koneksi.php'; // Pastikan koneksi benar

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tahun_lulus'])) {
    $tahun = $_POST['tahun_lulus'];

    // Debug: Cek apakah tahun terkirim
    if (empty($tahun)) {
        die("Error: Tahun tidak dikirim!");
    }

    // Gunakan MySQLi untuk prepared statement
    $stmt = $conn->prepare("SELECT nama FROM ts_data_mahasiswa WHERE tahun_kelulusan = ?");
    $stmt->bind_param("i", $tahun); // "i" untuk integer
    $stmt->execute();
    $result = $stmt->get_result();

    // Mengambil semua data hanya dari kolom "nama" sebagai array
    $data_mahasiswa = [];
    while ($row = $result->fetch_assoc()) {
        $data_mahasiswa[] = $row['nama'];
    }

    // Debug: Cek apakah data ditemukan
    if (empty($data_mahasiswa)) {
        die("Error: Tidak ada data untuk tahun $tahun!");
    }

    // Jika data ada, kirim dalam format HTML
    echo '<option value="">Pilih Nama</option>';
    foreach ($data_mahasiswa as $nama) {
        echo '<option value="' . htmlspecialchars($nama) . '">' . htmlspecialchars($nama) . '</option>';
    }

    $stmt->close();
    $conn->close();
    exit();
}

// Jika tidak ada request POST
die("Error: Request tidak valid!");
