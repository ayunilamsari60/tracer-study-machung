<?php
session_start();
// Izinkan akses dari semua origin (bisa diganti dengan IP tertentu)
header("Access-Control-Allow-Origin: *");

// Izinkan metode HTTP yang diperbolehkan
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

// Izinkan header tertentu
header("Access-Control-Allow-Headers: Content-Type, Authorization");

header("Content-Type: application/json");
require '../config/koneksi.php';
require '../vendor/autoload.php'; // Pastikan PHPMailer sudah diinstall

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Baca JSON input
$input = json_decode(file_get_contents("php://input"), true);

$tahun_kelulusan = $input['tahun_kelulusan'] ?? null;
$nama = $input['nama'] ?? null;
$email = $input['email'] ?? null;
$no_telepon = $input['no_telepon'] ?? null;

// Validasi input
if (!$tahun_kelulusan || !$nama || !$email || !$no_telepon) {
    echo json_encode(["status" => 400, "message" => "Semua data wajib diisi"]);
    exit();
}

try {
    // Cek apakah email sudah ada dan sudah diverifikasi
    $query = "SELECT otp_verifikasi FROM ts_register_mahasiswa WHERE email = :email";
    $stmt = $conn->prepare($query);
    $stmt->execute([':email' => $email]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result && $result['otp_verifikasi'] == 1) {
        echo json_encode(["status" => 400, "message" => "Email sudah terdaftar"]);
        exit();
    }

    // Buat kode OTP acak (6 digit)
    $otp_kode = rand(1000, 9999);
    $otp_kadaluwarsa = date("Y-m-d H:i:s", strtotime("+10 minutes")); // Berlaku 10 menit

    // Simpan data ke database (insert atau update)
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

    // Kirim OTP ke email menggunakan PHPMailer
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // Sesuaikan dengan provider email
    $mail->SMTPAuth = true;
    $mail->Username = 'dirgafarrel2008@gmail.com'; // Ganti dengan email pengirim
    $mail->Password = 'ogby bfce flrc noku'; // Ganti dengan password email pengirim
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('emailkamu@gmail.com', 'Manusia Gokil');
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

    echo json_encode(["status" => 200, "message" => "Data berhasil disimpan dan OTP telah dikirim ke email"]);
} catch (PDOException $e) {
    echo json_encode(["status" => 500, "message" => "Gagal menyimpan data: " . $e->getMessage()]);
} catch (Exception $e) {
    echo json_encode(["status" => 500, "message" => "Gagal mengirim email: " . $mail->ErrorInfo]);
}
?>
