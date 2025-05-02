<?php
// include __DIR__ . '/read_env.php';
$host2 = '127.0.0.1';
$dbname2 = 'akademik';
$username2 = 'root';
$password2 = '';

$conn2 = new mysqli($host2, $username2, $password2, $dbname2);
if ($conn2->connect_error) {
    die("Koneksi gagal: " . $conn2->connect_error);
}
?>