<?php
$host = 'localhost';
$dbname = 'tracer_study';
$username = 'root';
$password = '';

$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

putenv("EMAIL_USERNAME=dirgafarrel2008@gmail.com");
putenv("EMAIL_PASSWORD=ogby bfce flrc noku");


date_default_timezone_set('Asia/Jakarta');
// try {
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     echo "Koneksi gagal: " . $e->getMessage();
// }
?>