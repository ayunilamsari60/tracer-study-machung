<?php
session_start();
include "config/koneksi.php"; // Ganti dengan path ke config.php

// Ambil input dari form
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Hindari SQL Injection
$username = mysqli_real_escape_string($conn, $username);

// Cek user di database
$query = mysqli_query($conn, "SELECT * FROM ts_admin WHERE username = '$username'");
$user = mysqli_fetch_assoc($query);
// Validasi login
if ($user && password_verify($password, $user['password'])) {
    // Jika user ditemukan, set session
    $_SESSION['logged_in'] = true;
    $_SESSION['username'] = $username;
    header("Location: /tracer-study-machung/admin");
    exit;
} else {
    header("Location: login.php?error=Username atau password salah");
    exit;
}
