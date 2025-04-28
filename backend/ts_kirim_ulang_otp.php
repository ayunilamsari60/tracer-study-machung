<?php
session_start();
require 'config/koneksi.php';
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['resendOtp'])) {
    if (!isset($_SESSION['email']) || !isset($_SESSION['tahun_isian'])) {
        header("Location: index.php?status=error");
        exit();
    }

    $email = $_SESSION['email'];
    $tahun_isian = $_SESSION['tahun_isian'];

    try {
        $conn->begin_transaction(); // Mulai transaksi

        // Ambil data pengguna berdasarkan email dan tahun isian
        $stmt = $conn->prepare("SELECT otp_pengiriman, updated_at FROM ts_register_mahasiswa WHERE email = ? AND tahun_isian = ?");
        $stmt->bind_param("si", $email, $tahun_isian);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        if (!$user) {
            throw new Exception("User tidak ditemukan untuk tahun isian tersebut.");
        }

        $lastUpdatedDate = date("Y-m-d", strtotime($user['updated_at']));
        $today = date("Y-m-d");

        // Cek apakah masih dalam hari yang sama
        $otp_attempts = ($lastUpdatedDate == $today) ? $user['otp_pengiriman'] + 1 : 1;

        // Batasi pengiriman OTP maksimal 2 kali sehari
        if ($otp_attempts > 2) {
            header("Location: /tracer-study-machung/verifikasi-otp/limit");
            exit();
        }

        // Buat OTP baru
        $otp_kode = rand(1000, 9999);
        $otp_kadaluwarsa = date("Y-m-d H:i:s", strtotime("+10 minutes"));

        // Update OTP, jumlah pengiriman, dan updated_at di database
        $stmt = $conn->prepare("UPDATE ts_register_mahasiswa 
                                SET otp_kode = ?, otp_kadaluwarsa = ?, otp_pengiriman = ?, updated_at = NOW() 
                                WHERE email = ? AND tahun_isian = ?");
        $stmt->bind_param('ssisi', $otp_kode, $otp_kadaluwarsa, $otp_attempts, $email, $tahun_isian);
        $stmt->execute();
        $stmt->close();

        $conn->commit(); // Selesai transaksi

        // Kirim OTP via email
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = getenv('EMAIL_USERNAME');
        $mail->Password = getenv('EMAIL_PASSWORD');
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom(getenv('EMAIL_USERNAME'), 'Tracer Study Universitas Ma Chung');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Kode OTP Baru';
        $mail->Body = "
        <div style='text-align:center; margin-top:20px;'>
            <img src='cid:checklist_image' alt='logo' style='width:200px; height:auto;'>
        </div>
        <div style='text-align: center; width: 400px; margin: 0 auto;'>
            <b style='font-size: 18px;'>Verifikasi Email untuk Proses Tiket Anda!</b>
            <b style='font-size: 18px;'>Kode OTP Anda adalah <strong>{$otp_kode}</strong> </b>

            <p style='text-align: justify;'>
                Tiket Anda memerlukan verifikasi OTP agar dapat diproses oleh admin. Silakan masukkan kode OTP di form verifikasi untuk melanjutkan proses.<br><br>
                <b>Kode ini hanya berlaku selama 10 menit.</b>
            </p>
            <br>
            <p style='text-align: justify;'>*Catatan: Mohon untuk tidak membalas email ini.</p>
        </div>
        <div style='margin-top: 2rem;'>
            <img src='cid:logo_image' alt='logo' style='width:150px; height:auto;'><br>
            <b>Unit Sistem Informasi dan Pusat Data Universitas Ma Chung</b><br>
            Jika Anda memerlukan informasi lebih lanjut, silakan hubungi kontak di bawah ini.<br>
            E-mail   : uptsisteminformasi@machung.ac.id<br>
            Address  : Villa Puncak Tidar Blok N No. 01 Malang
        </div>";

        $mail->send();

        // Redirect sukses
        header("Location: /tracer-study-machung/verifikasi-otp/success");
        exit();
    } catch (Exception $e) {
        $conn->rollBack();
        error_log("Error: " . $e->getMessage());
        header("Location: /tracer-study-machung/verifikasi-otp/error");
        exit();
    }
}
?>
