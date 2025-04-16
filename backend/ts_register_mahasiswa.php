<?php
session_start();
require 'config/koneksi.php';
require 'vendor/autoload.php'; // Pastikan PHPMailer sudah diinstal

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tahun_kelulusan = $_POST['tahun_lulus'] ?? null;
    $nama = $_POST['nama'] ?? null;
    $email = $_POST['email'] ?? null;
    $no_telepon = $_POST['no_telepon'] ?? null;

    if (!$tahun_kelulusan || !$nama || !$email || !$no_telepon) {
        $_SESSION['error'] = "Semua data wajib diisi!";
        header("Location: /tracer-study-machung");
        exit;
    }

    try {
        // Pastikan koneksi ada
        if (!$conn) {
            throw new Exception("Koneksi database gagal!");
        }

        $conn->begin_transaction(); // Mulai transaksi

        // Cek apakah email sudah terdaftar
        $stmt = $conn->prepare("SELECT otp_verifikasi FROM register_mahasiswa WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $existingUser = $result->fetch_assoc();
        $stmt->close();

        if ($existingUser && $existingUser['otp_verifikasi'] == 1) {
            $_SESSION['error'] = "Email sudah terdaftar!";
            header("Location: /tracer-study-machung");
            exit;
        }

        // Ambil data pengguna dari database untuk mengecek jumlah permintaan OTP
        $stmt = $conn->prepare("SELECT otp_pengiriman, updated_at FROM register_mahasiswa WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        if ($user) {
            $lastUpdatedDate = $user['updated_at'] ? date("Y-m-d", strtotime($user['updated_at'])) : null;
            $today = date("Y-m-d");
            $otp_attempts = ($lastUpdatedDate == $today) ? $user['otp_pengiriman'] + 1 : 1;

            // Batasi pengiriman OTP maksimal 2 kali sehari
            if ($otp_attempts > 2) {
                $_SESSION['error'] = "Email ini sudah meminta kode OTP sebanyak 2 kali dalam sehari";
                header("Location: /tracer-study-machung");
                exit();
            }
        } else {
            $otp_attempts = 1;
        }


        $otp_kode = rand(1000, 9999);
        $otp_kadaluwarsa = date("Y-m-d H:i:s", strtotime("+10 minutes"));

        // Insert atau Update data
        $stmt = $conn->prepare("
            INSERT INTO register_mahasiswa (id_user, email, no_telepon, otp_kode, otp_kadaluwarsa, otp_verifikasi, otp_pengiriman) 
            VALUES (?, ?, ?, ?, ?, 0, ?)
            ON DUPLICATE KEY UPDATE 
            id_user = VALUES(id_user),
            no_telepon = VALUES(no_telepon),
            otp_kode = VALUES(otp_kode), 
            otp_kadaluwarsa = VALUES(otp_kadaluwarsa), 
            otp_verifikasi = 0,
            otp_pengiriman = VALUES(otp_pengiriman)
        ");
        $stmt->bind_param("issssi", $nama, $email, $no_telepon, $otp_kode, $otp_kadaluwarsa, $otp_attempts);
        $stmt->execute();
        $stmt->close();

        $_SESSION['email'] = $email;

        // Kirim email dengan PHPMailer
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

        $conn->commit(); // Commit transaksi

        header("Location: /tracer-study-machung/verifikasi-otp");
        exit;
    } catch (mysqli_sql_exception $e) {
        $conn->rollback(); // Rollback jika ada error database
        $_SESSION['error'] = "Gagal menyimpan data: " . $e->getMessage();
        header("Location: /tracer-study-machung");
        exit;
    } catch (Exception $e) {
        $_SESSION['error'] = "Gagal mengirim email: " . $mail->ErrorInfo;
        header("Location: /tracer-study-machung");
        exit;
    }
}
