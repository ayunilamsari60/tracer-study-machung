<?php
// include __DIR__ . '/read_env.php';
$host = '127.0.0.1';
$dbname = 'tracer_study';
$username = 'root';
$password = '';

// $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
// $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
try {
    include_once __DIR__ . '/read_env.php';
} catch (Exception $e) {
    // Optional: log error
    error_log($e->getMessage());
}


date_default_timezone_set('Asia/Jakarta');
?>