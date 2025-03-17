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
        // Pastikan koneksi ada
        if (!$conn) {
            throw new Exception("Koneksi database gagal!");
        }

        $conn->beginTransaction(); // Mulai transaksi

        // Ambil data pengguna dari database
        $stmt = $conn->prepare("SELECT otp_pengiriman, updated_at FROM ts_register_mahasiswa WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $lastUpdatedDate = $user['updated_at'] ? date("Y-m-d", strtotime($user['updated_at'])) : null;
            $today = date("Y-m-d");
            $otp_attempts = ($lastUpdatedDate == $today) ? $user['otp_pengiriman'] + 1 : 1;

            // Batasi pengiriman OTP maksimal 2 kali sehari
            if ($otp_attempts > 2) {
                $_SESSION['error'] = "Email ini sudah meminta kode OTP sebanyak 2 kali dalam sehari";
                header("Location: ../views/auth-register.php");
                exit();
            }
        } else {
            $otp_attempts = 1;
        }

        $stmt = $conn->prepare("SELECT otp_verifikasi FROM ts_register_mahasiswa WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && $result['otp_verifikasi'] == 1) {
            $_SESSION['error'] = "Email sudah terdaftar!";
            header("Location: ../views/auth-register.php");
            exit;
        }

        $otp_kode = rand(1000, 9999);
        $otp_kadaluwarsa = date("Y-m-d H:i:s", strtotime("+10 minutes"));

        // Perbaikan untuk `ON DUPLICATE KEY UPDATE`
        $query = "INSERT INTO ts_register_mahasiswa (tahun_kelulusan, nama, email, no_telepon, otp_kode, otp_kadaluwarsa, otp_verifikasi, otp_pengiriman) 
                  VALUES (:tahun_kelulusan, :nama, :email, :no_telepon, :otp_kode, :otp_kadaluwarsa, 0, :otp_pengiriman)
                  ON DUPLICATE KEY UPDATE 
                  tahun_kelulusan = VALUES(tahun_kelulusan), 
                  nama = VALUES(nama), 
                  no_telepon = VALUES(no_telepon),
                  otp_kode = VALUES(otp_kode), 
                  otp_kadaluwarsa = VALUES(otp_kadaluwarsa), 
                  otp_verifikasi = 0,
                  otp_pengiriman = :otp_pengiriman";

        $stmt = $conn->prepare($query);
        $stmt->execute([
            ':tahun_kelulusan' => $tahun_kelulusan,
            ':nama' => $nama,
            ':email' => $email,
            ':no_telepon' => $no_telepon,
            ':otp_kode' => $otp_kode,
            ':otp_kadaluwarsa' => $otp_kadaluwarsa,
            ':otp_pengiriman' => $otp_attempts
        ]);

        $_SESSION['email'] = $email;

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = getenv('EMAIL_USERNAME') ?: 'emailkamu@gmail.com';
        $mail->Password = getenv('EMAIL_PASSWORD') ?: 'passwordemailkamu';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom(getenv('EMAIL_USERNAME'), 'Manusia Gokil');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Kode OTP Anda';
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

        $conn->commit(); // Commit transaksi

        header("Location: ../views/verifikasi_otp.php");
        exit;
    } catch (PDOException $e) {
        $conn->rollBack(); // Rollback jika ada error database
        $_SESSION['error'] = "Gagal menyimpan data: " . $e->getMessage();
        header("Location: ../views/auth-register.php");
        exit;
    } catch (Exception $e) {
        $_SESSION['error'] = "Gagal mengirim email: " . $mail->ErrorInfo;
        header("Location: ../views/auth-register.php");
        exit;
    }
}
