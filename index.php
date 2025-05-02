<?php
require 'routes.php';
define('BASE_PATH', __DIR__);

// API Routes
route('GET', '/api/statistik_mahasiswa', function () {
    require 'backend/ts_data_chart_dashboard.php';
});
route('POST', '/api/get-nama-mahasiswa', function () {
    require 'backend/ts_get_nama_mahasiswa.php';
});

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
route('GET', '/selesai', function () {
    require 'views/halaman_terakhir.php';
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

route('POST', '/export', function () {
    require 'backend/ts_export_data.php';
});

route('GET', '/admin/konfigurasi', function () {
    auth_check();
    require 'views/admin/konfigurasi.php';
});

route('POST', '/admin/konfigurasi', function () {
    auth_check();
    require 'backend/ts_konfigurasi.php';
});


route('GET', '/admin/data-responden/{id}', function ($id) {
    auth_check();
    $_GET['id'] = $id; // agar bisa dibaca di views
    require 'views/admin/view_form_data.php';
});
route('GET', '/admin/pertanyaan', function () {
    auth_check();
    require 'views/admin/pertanyaan.php';
});

route('GET', '/admin/login', function () {
    session_start();
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
        header("Location: " . base_url("admin"));
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
    header('Location: ' . base_url('admin/login'));
    exit;
});

resolve();

// if (empty($routeMatched)) {
//     http_response_code(404);
//     require 'views/errors/404.php'; // Pastikan file ini ada
//     exit;
// }
