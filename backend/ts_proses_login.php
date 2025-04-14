<?php
session_start();

// Username dan password statis (bisa kamu ganti sesuai keinginan)
$valid_username = "admin";
$valid_password = "123456";

// Ambil input dari form
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Validasi login
if ($username === $valid_username && $password === $valid_password) {
    $_SESSION['logged_in'] = true;
    $_SESSION['username'] = $username;
    header("Location: /tracer-study-machung/admin");
    exit;
} else {
    header("Location: login.php?error=Username atau password salah");
    exit;
}
