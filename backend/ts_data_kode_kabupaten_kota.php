<?php
error_reporting(0);
ini_set('display_errors', 0);

require '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['kode_provinsi'])) {
    $kode_provinsi = $_POST['kode_provinsi'];

    if (empty($kode_provinsi)) {
        echo '<option value="">Kode provinsi kosong</option>';
        exit();
    }

    $stmt = $conn->prepare("SELECT Kode_Kota_Kabupaten, Nama_Kota_Kabupaten FROM ts_master_kabupaten_kota WHERE Kode_Provinsi = ?");
    if (!$stmt) {
        echo '<option value="">Query prepare error</option>';
        exit();
    }

    $stmt->bind_param("s", $kode_provinsi);

    if (!$stmt->execute()) {
        echo '<option value="">Query execute error</option>';
        exit();
    }

    $result = $stmt->get_result();

    echo '<option value="" selected disabled>Pilih Kota/Kabupaten</option>';
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . htmlspecialchars($row['Kode_Kota_Kabupaten']) . '">' . htmlspecialchars($row['Nama_Kota_Kabupaten']) . '</option>';
    }

    $stmt->close();
    $conn->close();
    exit();
}

echo '<option value="">Permintaan tidak valid</option>';
exit();
