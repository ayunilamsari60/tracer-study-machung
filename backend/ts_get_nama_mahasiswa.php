<?php
require 'config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tahun_lulus'])) {
    $tahun = $_POST['tahun_lulus'];

    if (empty($tahun)) {
        die("Error: Tahun tidak dikirim!");
    }

    // Ganti query agar ambil id_user dan nama
    // $stmt = $conn->prepare("SELECT id_user, nama FROM ts_data_mahasiswa WHERE thn_ajaran = ?");
    $stmt = $conn->prepare("SELECT t.tglsk, a.nim_mahasiswa, b.nama_mahasiswa 
    FROM akademik_transaksi_wisuda t
    LEFT JOIN akademik_transaksi_wisuda_detail a ON a.id_wisuda = t.id_wisuda
    LEFT JOIN akademik_master_mahasiswa b ON b.nim_mahasiswa = a.nim_mahasiswa
    WHERE YEAR(t.tglsk) = ?");

    $stmt->bind_param("i", $tahun);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo '<option value="" selected disabled>Tidak ada data mahasiswa pada tahun ini</option>';
    } else {
        echo '<option value="" selected disabled>Pilih Nama</option>';
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . htmlspecialchars($row['nim_mahasiswa']) . '">' . htmlspecialchars($row['nama_mahasiswa']) . '</option>';
        }
    }

    $stmt->close();
    $conn->close();
    exit();
}

die("Error: Request tidak valid!");
