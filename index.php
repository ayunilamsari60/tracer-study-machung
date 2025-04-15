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

route('GET', '/admin', function () {
    session_start();
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        header("Location: /tracer-study-machung/admin/login");
        exit;
    }
    require 'views/admin/dashboard.php';
});
route('GET', '/admin/data-responden', function () {
    require 'views/admin/p.php';
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
    session_destroy();
    header("Location: /tracer-study-machung/admin/login");
    exit;
});