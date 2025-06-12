<?php
session_start();
require 'config/koneksi.php';
require 'vendor/autoload.php'; // Pastikan PHPMailer sudah diinstal

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tahun_kelulusan = $_POST['tahun_lulus'] ?? null;
    // $tahun_isian = $_POST['tahun_isian'] ?? null;  // Menggunakan nilai POST
    // Tambahkan ambil dari database
    $stmt = $conn->prepare("SELECT tahun_isian FROM ts_konfigurasi LIMIT 1");
    $stmt->execute();
    $result = $stmt->get_result();
    $config = $result->fetch_assoc();
    $stmt->close();

    if (!$config) {
        $_SESSION['error'] = "Konfigurasi tahun isian tidak ditemukan.";
        header("Location: " . base_url("/"));
        exit();
    }

    $tahun_isian = $config['tahun_isian']; // ✅

    $nama = $_POST['nama'] ?? null;
    $nik = $_POST['nik'] ?? null;
    $email = $_POST['email'] ?? null;
    $no_telepon = $_POST['no_telepon'] ?? null;

    if ($no_telepon) {
        // 1. Hapus semua karakter non-angka
        $no_telepon = preg_replace('/[^0-9]/', '', $no_telepon);

        // 2. Hapus leading '0' jika ada, lalu tambahkan +62
        $no_telepon = '+62' . ltrim($no_telepon, '0');
    }

    if (!$tahun_kelulusan || !$nama || !$email || !$no_telepon) {
        $_SESSION['error'] = "Semua data wajib diisi!";
        header("Location: " . base_url("/"));
        exit;
    }

    try {
        if (!$conn) {
            throw new Exception("Koneksi database gagal!");
        }
    
        $conn->begin_transaction(); // Mulai transaksi
    
        // 1. Cek apakah user sudah submit di tahun yang sama
        $stmt = $conn->prepare("
            SELECT rm.id_register 
            FROM ts_register_mahasiswa rm
            INNER JOIN ts_form_submit fs ON rm.id_register = fs.id_register
            WHERE rm.nim_mahasiswa = ? AND rm.tahun_isian = ?
        ");
        $stmt->bind_param("ii", $nama, $tahun_isian);
        $stmt->execute();
        $result = $stmt->get_result();
        $userTahunSama = $result->fetch_assoc();
        $stmt->close();

        if ($userTahunSama) {
            $_SESSION['error'] = "Nama mahasiswa ini sudah mengirim isian untuk tahun $tahun_isian dan tidak bisa mendaftar ulang di tahun yang sama!";
            header("Location: " . base_url("/"));
            exit();
        }

    
        // 2. Cek apakah email sudah terverifikasi di tahun yang sama
        $stmt = $conn->prepare("SELECT otp_verifikasi FROM ts_register_mahasiswa WHERE email = ? AND tahun_isian = ?");
        $stmt->bind_param("si", $email, $tahun_isian);
        $stmt->execute();
        $result = $stmt->get_result();
        $existingUser = $result->fetch_assoc();
        $stmt->close();
    
        if ($existingUser && $existingUser['otp_verifikasi'] == 1) {
            $_SESSION['error'] = "Email sudah terdaftar dan terverifikasi untuk tahun $tahun_isian!";
            header("Location: " . base_url("/"));
            exit();
        }
    
        // 3. Hitung jumlah permintaan OTP hari ini
        $stmt = $conn->prepare("SELECT otp_pengiriman, updated_at FROM ts_register_mahasiswa WHERE email = ? AND tahun_isian = ?");
        $stmt->bind_param("si", $email, $tahun_isian);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();
    
        $today = date("Y-m-d");
        $otp_attempts = 1;
    
        if ($user) {
            $lastUpdatedDate = $user['updated_at'] ? date("Y-m-d", strtotime($user['updated_at'])) : null;
            if ($lastUpdatedDate == $today) {
                $otp_attempts = $user['otp_pengiriman'] + 1;
            }
    
            if ($otp_attempts > 2) {
                $_SESSION['error'] = "Email ini sudah meminta kode OTP sebanyak 2 kali dalam sehari.";
                header("Location: " . base_url("/"));
                exit();
            }
        }
    
        // 4. Generate OTP
        $otp_kode = rand(1000, 9999);
        $otp_kadaluwarsa = date("Y-m-d H:i:s", strtotime("+10 minutes"));
    
        // 5. Insert or Update berdasarkan UNIQUE (email, tahun_isian)
        $stmt = $conn->prepare("
            INSERT INTO ts_register_mahasiswa 
                (nim_mahasiswa, nik, email, no_telepon, otp_kode, otp_kadaluwarsa, otp_verifikasi, otp_pengiriman, tahun_isian) 
            VALUES (?, ?, ?, ?, ?, ?, 0, ?, ?)
            ON DUPLICATE KEY UPDATE 
                nim_mahasiswa = VALUES(nim_mahasiswa),
                no_telepon = VALUES(no_telepon),
                otp_kode = VALUES(otp_kode),
                otp_kadaluwarsa = VALUES(otp_kadaluwarsa),
                otp_verifikasi = 0,
                otp_pengiriman = VALUES(otp_pengiriman),
                updated_at = NOW()
        ");
        $stmt->bind_param("isssssii", $nama, $nik, $email, $no_telepon, $otp_kode, $otp_kadaluwarsa, $otp_attempts, $tahun_isian);
        $stmt->execute();
        $stmt->close();
    
        // 6. Simpan session
        $_SESSION['email'] = $email;
        $_SESSION['tahun_isian'] = $tahun_isian;
    
        // 7. Kirim email OTP
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = getenv('EMAIL_USERNAME') ?: 'emailkamu@gmail.com';
        $mail->Password = getenv('EMAIL_PASSWORD') ?: 'passwordemailkamu';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
    
        $mail->setFrom(getenv('EMAIL_USERNAME'), 'Tracer Study Universitas Ma Chung');
        $mail->addEmbeddedImage('assets/images/checklist.png', 'checklist_image');
        $mail->addEmbeddedImage('assets/images/logo-machung.png', 'logo_machung');
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
                Halaman ini memerlukan verifikasi OTP. Silakan masukkan kode OTP di form verifikasi untuk melanjutkan pengisian form TracerStudy.<br><br>
                <b>Kode ini hanya berlaku selama 10 menit.</b>
            </p>
            <br>
            <p style="text-align: justify;">*Catatan: Mohon untuk tidak membalas email ini.</p>
        </div>
        <div style="margin-top: 2rem;">
            <img src="cid:logo_machung" alt="logo" style="width:150px; height:auto;"><br>
            <b>Unit Sistem Informasi dan Pusat Data Universitas Ma Chung</b><br>
            Jika Anda memerlukan informasi lebih lanjut, silakan hubungi kontak di bawah ini.<br>
            E-mail   : uptsisteminformasi@machung.ac.id<br>
            Address  : Villa Puncak Tidar Blok N No. 01 Malang
        </div>
        ';
    
        $mail->send();
    
        $conn->commit(); // Simpan transaksi
        header("Location: " . base_url("verifikasi-otp"));
        exit();
    } 
    
     catch (mysqli_sql_exception $e) {
        $conn->rollback(); // Rollback jika ada error database
        $_SESSION['error'] = "Gagal menyimpan data: " . $e->getMessage();
        header("Location: " . base_url("/"));
        exit;
    } catch (Exception $e) {
        $_SESSION['error'] = "Gagal mengirim email: " . $mail->ErrorInfo;
        header("Location: " . base_url("/"));
        exit;
    }
}
