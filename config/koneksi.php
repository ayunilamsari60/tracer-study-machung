<?php
// include __DIR__ . '/read_env.php';
$host = '10.50.3.43';
$dbname = 'tracer_study';
$username = 'Farrel';
$password = '';

// $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
// $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
try {
    include __DIR__ . '/read_env.php';
} catch (Exception $e) {
    // Optional: log error
    echo($e->getMessage());
}


date_default_timezone_set('Asia/Jakarta');
?>