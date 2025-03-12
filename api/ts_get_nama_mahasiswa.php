<?php
header("Content-Type: application/json");

$apiUrl = "http://10.50.3.205/tracer_study/api/ts_data_mahasiswa.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tahun'])) {
    $tahun = $_POST['tahun'];

    $postData = http_build_query(["tahun" => $tahun]);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode == 200) {
        echo $response;
    } else {
        echo json_encode(["status" => 500, "message" => "Gagal mengambil data"]);
    }
    exit();
}

echo json_encode(["status" => 400, "message" => "Tahun tidak valid"]);
exit();
?>
