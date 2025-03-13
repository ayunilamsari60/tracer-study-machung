<?php
session_start();
require '../config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $otp_kode = $_POST['otp_kode'] ?? null;

    if (!isset($_SESSION['email'])) {
        $_SESSION['error'] = "Session expired. Silakan register ulang.";
        header("Location: ../views/auth-register.php");
        exit();
    }

    $email = $_SESSION['email'];

    if (!$otp_kode) {
        $_SESSION['error'] = "Kode OTP wajib diisi.";
        header("Location: ../views/verifikasi_otp.php");
        exit();
    }

    try {
        $stmt = $conn->prepare("SELECT otp_kode, otp_kadaluwarsa, otp_verifikasi FROM ts_register_mahasiswa WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            $_SESSION['error'] = "User tidak ditemukan.";
            header("Location: ../views/verifikasi_otp.php");
            exit();
        }

        if ($user['otp_verifikasi'] == 1) {
            $_SESSION['error'] = "Email sudah terverifikasi.";
            header("Location: ../views/verifikasi_otp.php");
            exit();
        }

        if (strtotime($user['otp_kadaluwarsa']) < time()) {
            $_SESSION['error'] = "Kode OTP sudah kadaluarsa.";
            header("Location: ../views/verifikasi_otp.php");
            exit();
        }

        if ($user['otp_kode'] != $otp_kode) {
            $_SESSION['error'] = "Kode OTP salah.";
            header("Location: ../views/verifikasi_otp.php");
            exit();
        }

        // Update status verifikasi
        $stmt = $conn->prepare("UPDATE ts_register_mahasiswa SET otp_verifikasi = 1 WHERE email = :email");
        $stmt->execute([':email' => $email]);

        $_SESSION['success'] = "OTP berhasil diverifikasi! Anda akan diarahkan ke form.";
        header("Location: ../views/verifikasi_otp.php");
        exit();
    } catch (PDOException $e) {
        $_SESSION['error'] = "Gagal verifikasi: " . $e->getMessage();
        header("Location: ../views/verifikasi_otp.php");
        exit();
    }
}
?>
