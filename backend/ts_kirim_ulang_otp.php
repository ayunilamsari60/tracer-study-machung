<?php
session_start();
require '../config/koneksi.php';
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Periksa apakah tombol "Kirim Ulang" ditekan
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['resendOtp'])) {
    if (!isset($_SESSION['email'])) {
        header("Location: index.php?status=error"); // Jika session expired
        exit();
    }

    $email = $_SESSION['email'];

    try {
        // Buat OTP baru
        $otp_kode = rand(1000, 9999);
        $otp_kadaluwarsa = date("Y-m-d H:i:s", strtotime("+10 minutes"));

        // Update OTP di database
        $stmt = $conn->prepare("UPDATE ts_register_mahasiswa SET otp_kode = :otp_kode, otp_kadaluwarsa = :otp_kadaluwarsa WHERE email = :email");
        $stmt->execute([
            ':otp_kode' => $otp_kode,
            ':otp_kadaluwarsa' => $otp_kadaluwarsa,
            ':email' => $email
        ]);

        // Kirim OTP ke email
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'dirgafarrel2008@gmail.com';
        $mail->Password = 'ogby bfce flrc noku';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('emailkamu@gmail.com', 'Manusia Gokil');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Kode OTP Baru';
        $mail->Body = "
        <div style='text-align:center; margin-top:20px;'>
            <b style='font-size: 18px;'>Verifikasi Email untuk Proses Tiket Anda!</b>
            <b style='font-size: 18px;'>Kode OTP Anda adalah <strong>{$otp_kode}</strong> </b>
            <p style='text-align: justify;'>
                Tiket Anda memerlukan verifikasi OTP agar dapat diproses oleh admin. Silakan masukkan kode OTP di form verifikasi untuk melanjutkan proses.<br><br>
                <b>Kode ini hanya berlaku selama 10 menit.</b>
            </p>
            <p style='text-align: justify;'>*Catatan: Mohon untuk tidak membalas email ini.</p>
        </div>";

        $mail->send();

        // Redirect kembali dengan status sukses
        header("Location: ../views/verifikasi_otp.php?kirim_ulang=success");
        exit();
    } catch (Exception $e) {
        // Redirect kembali dengan status error
        header("Location: ../views/verifikasi_otp.php?kirim_ulang=error");
        exit();
    }
}
