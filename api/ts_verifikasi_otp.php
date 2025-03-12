<?php
session_start();
header("Content-Type: application/json");
require '../config/koneksi.php';

$input = json_decode(file_get_contents("php://input"), true);
$otp_kode = $input['otp_kode'] ?? null;

// Cek apakah email ada di session
if (!isset($_SESSION['email'])) {
    echo json_encode(["status" => 400, "message" => "Session expired. Silakan register ulang"]);
    exit();
}

$email = $_SESSION['email']; // Ambil email dari session

if (!$otp_kode) {
    echo json_encode(["status" => 400, "message" => "Kode OTP wajib diisi"]);
    exit();
}

try {
    // Ambil data user berdasarkan email
    $stmt = $conn->prepare("SELECT otp_kode, otp_kadaluwarsa, otp_verifikasi FROM ts_register_mahasiswa WHERE email = :email");
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo json_encode(["status" => 400, "message" => "User tidak ditemukan"]);
        exit();
    }

    if ($user['otp_verifikasi'] == 1) {
        echo json_encode(["status" => 400, "message" => "Email sudah terverifikasi"]);
        exit();
    }

    if (strtotime($user['otp_kadaluwarsa']) < time()) {
        echo json_encode(["status" => 400, "message" => "Kode OTP sudah kadaluarsa"]);
        exit();
    }

    if ($user['otp_kode'] != $otp_kode) {
        echo json_encode(["status" => 400, "message" => "Kode OTP salah"]);
        exit();
    }

    // Update status verifikasi
    $stmt = $conn->prepare("UPDATE ts_register_mahasiswa SET otp_verifikasi = 1 WHERE email = :email");
    $stmt->execute([':email' => $email]);

    echo json_encode(["status" => 200, "message" => "OTP berhasil diverifikasi"]);
} catch (PDOException $e) {
    echo json_encode(["status" => 500, "message" => "Gagal verifikasi: " . $e->getMessage()]);
}
?>
