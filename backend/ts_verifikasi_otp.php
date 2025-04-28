<?php
session_start();
require 'config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $otp_kode = $_POST['otp_kode'] ?? null;

    if (!isset($_SESSION['email'])) {
        $_SESSION['error'] = "Session expired. Silakan register ulang.";
        header("Location: " . base_url("/"));
        exit();
    }

    $email = $_SESSION['email'];

    if (!$otp_kode) {
        $_SESSION['error'] = "Kode OTP wajib diisi.";
        header("Location: /tracer-study-machung/verifikasi-otp");
        exit();
    }

    try {
        // ⬇️ Ambil data tahun_isian dari konfigurasi
        $stmt = $conn->prepare("SELECT tahun_isian FROM ts_konfigurasi LIMIT 1");
        $stmt->execute();
        $result_konfig = $stmt->get_result();
        $konfigurasi = $result_konfig->fetch_assoc();
        $stmt->close();

        if (!$konfigurasi) {
            $_SESSION['error'] = "Konfigurasi sistem tidak ditemukan.";
            header("Location: /tracer-study-machung/verifikasi-otp");
            exit();
        }

        $tahun_isian_konfig = $konfigurasi['tahun_isian'];

        // ⬇️ Cari user berdasarkan email + tahun_isian
        $stmt = $conn->prepare("SELECT id_register, otp_kode, otp_kadaluwarsa, otp_verifikasi FROM ts_register_mahasiswa WHERE email = ? AND tahun_isian = ?");
        $stmt->bind_param("si", $email, $tahun_isian_konfig); // tahun_isian integer
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        if (!$user) {
            $_SESSION['error'] = "User tidak ditemukan untuk tahun isian saat ini.";
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
        $stmt = $conn->prepare("UPDATE ts_register_mahasiswa SET otp_verifikasi = 1 WHERE email = ? AND tahun_isian = ?");
        $stmt->bind_param("si", $email, $tahun_isian_konfig);
        $stmt->execute();

        $_SESSION['id_register'] = $user['id_register'];

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
