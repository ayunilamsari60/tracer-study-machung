<?php
require 'routes.php';
define('BASE_PATH', __DIR__);

route('GET', '/', function () {
    require 'views/auth-register.php';
});

route('POST', '/register/post', function () {
    require 'backend/ts_register_mahasiswa.php';
});

route('GET', '/verifikasi-otp', function () {
    require 'views/verifikasi_otp.php';
});
route('POST', '/verifikasi-otp/post', function () {
    require 'backend/ts_verifikasi_otp.php';
});

// 💡 Versi dengan parameter dinamis
route('GET', '/verifikasi-otp/{status}', function ($status) {
    $_GET['status'] = $status; // agar bisa dibaca di views
    require 'views/verifikasi_otp.php';
});

route('POST', '/kirim-ulang/post', function () {
    require 'backend/ts_kirim_ulang_otp.php';
});

route('GET', '/form', function () {
    require 'views/form.php';
});

route('POST', '/form/submit', function () {
    require 'backend/ts_form_submit.php';
});

// Admin Routes

route('GET', '/admin', function () {
    auth_check();
    require 'views/admin/dashboard.php';
});
route('GET', '/admin/data-responden', function () {
    auth_check();
    require 'views/admin/data-responden.php';
});
route('GET', '/admin/pertanyaan', function () {
    auth_check();
    require 'views/admin/pertanyaan.php';
});

route('GET', '/admin/login', function () {
    session_start();
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
        header("Location: /tracer-study-machung/admin");
        exit;
    }
    require 'views/admin/login.php';
});

route('POST', '/admin/login', function () {
    require 'backend/ts_proses_login.php';
});

route('GET', '/admin/logout', function () {
    session_start();
    include "config/koneksi.php";

    // Hapus token dari DB juga
    if (isset($_SESSION['user_id'])) {
        $conn->query("UPDATE ts_admin SET remember_token = NULL WHERE id = " . $_SESSION['user_id']);
    }
    session_unset();
    session_destroy();
    setcookie('remember_token', '', time() - 3600, '/');

    exit;
});

if (empty($routeMatched)) {
    http_response_code(404);
    require 'views/errors/404.php'; // Pastikan file ini ada
    exit;
}
