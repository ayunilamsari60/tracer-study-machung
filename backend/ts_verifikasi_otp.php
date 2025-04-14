<?php
session_start();
require 'config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $otp_kode = $_POST['otp_kode'] ?? null;

    if (!isset($_SESSION['email'])) {
        $_SESSION['error'] = "Session expired. Silakan register ulang.";
        header("Location: /tracer-study-machung/auth-register");
        exit();
    }

    $email = $_SESSION['email'];

    if (!$otp_kode) {
        $_SESSION['error'] = "Kode OTP wajib diisi.";
        header("Location: /tracer-study-machung/verifikasi-otp");
        exit();
    }

    try {
        $stmt = $conn->prepare("SELECT otp_kode, otp_kadaluwarsa, otp_verifikasi FROM ts_register_mahasiswa WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        if (!$user) {
            $_SESSION['error'] = "User tidak ditemukan.";
            header("Location: /tracer-study-machung/verifikasi-otp");
            exit();
        }

        if ($user['otp_verifikasi'] == 1) {
            $_SESSION['error'] = "Email sudah terverifikasi.";
            header("Location: /tracer-study-machung/verifikasi-otp");
            exit();
        }

        if (strtotime($user['otp_kadaluwarsa']) < time()) {
            $_SESSION['error'] = "Kode OTP sudah kadaluarsa.";
            header("Location: /tracer-study-machung/verifikasi-otp");
            exit();
        }

        if ($user['otp_kode'] != $otp_kode) {
            $_SESSION['error'] = "Kode OTP salah.";
            header("Location: /tracer-study-machung/verifikasi-otp");
            exit();
        }

        // Update status verifikasi
        $stmt = $conn->prepare("UPDATE ts_register_mahasiswa SET otp_verifikasi = 1 WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $_SESSION['success'] = "OTP berhasil diverifikasi! Anda akan diarahkan ke form.";
        header("Location: /tracer-study-machung/verifikasi-otp");
        exit();
    } catch (Exception $e) {
        $_SESSION['error'] = "Gagal verifikasi: " . $e->getMessage();
        header("Location: /tracer-study-machung/verifikasi-otp");
        exit();
    }
}
?>
