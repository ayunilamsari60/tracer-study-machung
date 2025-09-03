<?php
// include __DIR__ . '/read_env.php';
$host = 'db';
$dbname = 'tracer_study';
$username = 'user';
$password = 'userpass';

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

// $host2 = '127.0.0.1';
// $dbname2 = 'akademik';
// $username2 = 'root';
// $password2 = '';

// $conn2 = new mysqli($host2, $username2, $password2, $dbname2);
// if ($conn2->connect_error) {
//     die("Koneksi gagal: " . $conn2->connect_error);
// }


date_default_timezone_set('Asia/Jakarta');
?>