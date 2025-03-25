<?php
$servername = "localhost"; // Ganti dengan server database Anda
$username = "root"; // Ganti dengan username database
$password = ""; // Ganti dengan password database jika ada
$dbname = "tracer_study"; // Ganti dengan nama database Anda

// Koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Tangkap data dari form
$status_kerja = $_POST['status_kerja'];
$pekerjaan = $_POST['pekerjaan'] ?? NULL;
$usaha = $_POST['usaha'] ?? NULL;
$pendidikan = $_POST['pendidikan'] ?? NULL;
$strategi_mencari = $_POST['strategi_mencari'] ?? NULL;
$alasan = $_POST['alasan'] ?? NULL;
$f18a = $_POST['sumber_biaya'] ?? NULL;
$f18b = $_POST['perguruan_tinggi'] ?? NULL;
$f18c = $_POST['program_studi'] ?? NULL;
$f18d = $_POST['tanggal_masuk'] ?? NULL;

$f1201 = $_POST['sumber_dana'] ?? NULL;
$f1202 = $_POST['f1202'] ?? NULL;

// Jika user tidak memilih "Lainnya", kosongkan f1202
if ($f1201 !== "7") {
    $f1202 = NULL;
}

// Tambahkan f1201 dan f1202 ke query
$sql = "INSERT INTO survey_responses 
(status_kerja, pekerjaan, usaha, pendidikan, strategi_mencari, alasan, f18a, f18b, f18c, f18d, f1201, f1202) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssssss", $status_kerja, $pekerjaan, $usaha, $pendidikan, $strategi_mencari, $alasan, $f18a, $f18b, $f18c, $f18d, $f1201, $f1202);

if ($stmt->execute()) {
    echo "Data berhasil disimpan!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
