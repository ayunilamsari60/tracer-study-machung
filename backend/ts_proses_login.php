<?php
session_start();
include "config/koneksi.php"; // Ganti path sesuai struktur proyekmu

// Ambil input dari form
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$remember = isset($_POST['remember']);

// Bersihkan input
$username = trim(mysqli_real_escape_string($conn, $username));
$password = trim($password);

// Cek user di database
$query = mysqli_query($conn, "SELECT * FROM ts_admin WHERE username = '$username'");
$user = mysqli_fetch_assoc($query);

if ($user && password_verify($password, $user['password'])) {
    // Set session login
    $_SESSION['logged_in'] = true;
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];

    // Fitur remember me
    if ($remember) {
        $token = bin2hex(random_bytes(16)); // Token acak
        setcookie('remember_token', $token, time() + (86400 * 7), "/"); // Berlaku 7 hari
        $conn->query("UPDATE ts_admin SET remember_token = '$token', updated_at = NOW() WHERE id = " . $user['id']);
    } else {
        // Kalau nggak pakai remember me, tetap update updated_at-nya
        $conn->query("UPDATE ts_admin SET updated_at = NOW() WHERE id = " . $user['id']);
    }

    header("Location: /tracer-study-machung/admin");
    exit;
}
 else {
    header("Location: login.php?error=Username atau password salah");
    exit;
}
