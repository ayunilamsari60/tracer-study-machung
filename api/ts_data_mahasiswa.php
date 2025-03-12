<?php
header("Content-Type: application/json");
require '../config/koneksi.php'; // Pastikan ada koneksi ke database

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tahun'])) {
    $tahun = $_POST['tahun'];

    $stmt = $conn->prepare("SELECT nama FROM ts_data_mahasiswa WHERE tahun_kelulusan = ?");
    $stmt->execute([$tahun]);

    $result = $stmt->fetchAll(PDO::FETCH_COLUMN);

    echo json_encode(["status" => 200, "data" => $result]);
    exit();
}

echo json_encode(["status" => 400, "message" => "Tahun tidak valid"]);
exit();
?>
