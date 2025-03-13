<?php
session_start();
require '../config/koneksi.php';
require '../vendor/autoload.php'; // Pastikan PHPMailer sudah diinstall

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$errorMessage = ""; // Variabel untuk menyimpan error

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tahun_kelulusan = $_POST['tahun_lulus'] ?? null;
    $nama = $_POST['nama'] ?? null;
    $email = $_POST['email'] ?? null;
    $no_telepon = $_POST['no_telepon'] ?? null;

    if (!$tahun_kelulusan || !$nama || !$email || !$no_telepon) {
        $errorMessage = "Semua data wajib diisi!";
    } else {
        try {
            // Cek apakah email sudah terdaftar
            $query = "SELECT otp_verifikasi FROM ts_register_mahasiswa WHERE email = :email";
            $stmt = $conn->prepare($query);
            $stmt->execute([':email' => $email]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result && $result['otp_verifikasi'] == 1) {
                $errorMessage = "Email sudah terdaftar!";
            } else {
                // Buat kode OTP
                $otp_kode = rand(1000, 9999);
                $otp_kadaluwarsa = date("Y-m-d H:i:s", strtotime("+10 minutes"));

                // Simpan data ke database
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

                // Kirim OTP ke email
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'dirgafarrel2008@gmail.com';
                $mail->Password = 'ogby bfce flrc noku'; // Ganti dengan password email pengirim
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

                // Simpan pesan sukses ke session
                $_SESSION['success_message'] = "Registrasi berhasil! OTP telah dikirim ke email.";
                header("Location: ../views/auth-register.php"); // Redirect ke halaman form
                exit();
            }
        } catch (PDOException $e) {
            $errorMessage = "Gagal menyimpan data: " . $e->getMessage();
        } catch (Exception $e) {
            $errorMessage = "Gagal mengirim email: " . $mail->ErrorInfo;
        }
    }

    // Jika ada error, simpan di session lalu kembali ke form
    $_SESSION['error_message'] = $errorMessage;
    header("Location: ../views/auth-register.php");
    exit();
} else {
    die("Metode tidak diperbolehkan!");
}
?>
