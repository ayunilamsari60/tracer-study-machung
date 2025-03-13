<?php
session_start();
require '../config/koneksi.php';
require '../vendor/autoload.php'; // Pastikan PHPMailer sudah diinstall

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tahun_kelulusan = $_POST['tahun_lulus'] ?? null;
    $nama = $_POST['nama'] ?? null;
    $email = $_POST['email'] ?? null;
    $no_telepon = $_POST['no_telepon'] ?? null;

    if (!$tahun_kelulusan || !$nama || !$email || !$no_telepon) {
        $_SESSION['error'] = "Semua data wajib diisi!";
        header("Location: ../views/auth-register.php");
        exit;
    }

    try {
        $query = "SELECT otp_verifikasi FROM ts_register_mahasiswa WHERE email = :email";
        $stmt = $conn->prepare($query);
        $stmt->execute([':email' => $email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && $result['otp_verifikasi'] == 1) {
            $_SESSION['error'] = "Email sudah terdaftar!";
            header("Location: ../views/auth-register.php");
            exit;
        }

        $otp_kode = rand(1000, 9999);
        $otp_kadaluwarsa = date("Y-m-d H:i:s", strtotime("+10 minutes"));

        $query = "INSERT INTO ts_register_mahasiswa (tahun_kelulusan, nama, email, no_telepon, otp_kode, otp_kadaluwarsa, otp_verifikasi) 
                  VALUES (:tahun_kelulusan, :nama, :email, :no_telepon, :otp_kode, :otp_kadaluwarsa, 0)
                  ON DUPLICATE KEY UPDATE 
                  tahun_kelulusan = VALUES(tahun_kelulusan), 
                  nama = VALUES(nama), 
                  no_telepon = VALUES(no_telepon),
                  otp_kode = VALUES(otp_kode), 
                  otp_kadaluwarsa = VALUES(otp_kadaluwarsa), 
                  otp_verifikasi = 0";

        $stmt = $conn->prepare($query);
        $stmt->execute([
            ':tahun_kelulusan' => $tahun_kelulusan,
            ':nama' => $nama,
            ':email' => $email,
            ':no_telepon' => $no_telepon,
            ':otp_kode' => $otp_kode,
            ':otp_kadaluwarsa' => $otp_kadaluwarsa
        ]);

        $_SESSION['email'] = $email;

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'dirgafarrel2008@gmail.com';
        $mail->Password = 'ogby bfce flrc noku'; // Masukkan password Gmail kamu
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('emailkamu@gmail.com', 'Manusia Gokil');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Kode OTP Anda';
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

        // $_SESSION['berhasil'] = "Kode OTP telah dikirim ke email Anda!";
        header("Location: ../views/verifikasi_otp.php");
        exit;
    } catch (PDOException $e) {
        $_SESSION['error'] = "Gagal menyimpan data: " . $e->getMessage();
        header("Location: ../views/auth-register.php");
        exit;
    } catch (Exception $e) {
        $_SESSION['error'] = "Gagal mengirim email: " . $mail->ErrorInfo;
        header("Location: ../views/auth-register.php");
        exit;
    }
}
?>
