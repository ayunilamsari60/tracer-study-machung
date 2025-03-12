<?php
session_start();
header("Content-Type: application/json");
require '../config/koneksi.php';
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Cek apakah email ada di session
if (!isset($_SESSION['email'])) {
    echo json_encode(["status" => 400, "message" => "Session expired. Silakan register ulang"]);
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
    $mail->Body = '
    <div style="text-align:center; margin-top:20px;">
            <img src="cid:checklist_image" alt="logo" style="width:200px; height:auto;">
        </div>
        <div style="text-align: center; width: 400px; margin: 0 auto;">
            <b style="font-size: 18px;">Verifikasi Email untuk Proses Tiket Anda!</b>
            <b style="font-size: 18px;">Kode OTP Anda adalah <strong>' . $otp_kode . '</strong> </b>

            <p style="text-align: justify;">
                Tiket Anda memerlukan verifikasi OTP agar dapat diproses oleh admin. Silakan masukkan kode OTP di form verifikasi untuk melanjutkan proses.<br><br>
                <b>Kode ini hanya berlaku selama 10 menit.</b>
            </p>
            <br>
            <p style="text-align: justify;">*Catatan: Mohon untuk tidak membalas email ini.</p>
        </div>
        <div style="margin-top: 2rem;">
            <img src="cid:logo_image" alt="logo" style="width:150px; height:auto;"><br>
            <b>Unit Sistem Informasi dan Pusat Data Universitas Ma Chung</b><br>
            Jika Anda memerlukan informasi lebih lanjut, silakan hubungi kontak di bawah ini.<br>
            E-mail   : uptsisteminformasi@machung.ac.id<br>
            Address  : Villa Puncak Tidar Blok N No. 01 Malang
        </div>
    ';

    $mail->send();

    echo json_encode(["status" => 200, "message" => "Kode OTP baru telah dikirim ke email"]);
} catch (PDOException $e) {
    echo json_encode(["status" => 500, "message" => "Gagal memperbarui OTP: " . $e->getMessage()]);
} catch (Exception $e) {
    echo json_encode(["status" => 500, "message" => "Gagal mengirim email: " . $mail->ErrorInfo]);
}
