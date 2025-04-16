<?php

function route($method, $pattern, $callback) {
    global $routeMatched;

    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $basePath = '/tracer-study-machung'; // Ganti sesuai project kamu

    // Hapus base path dari URL
    $route = substr($uri, strlen($basePath));

    // Ganti {parameter} dengan regex
    $patternRegex = preg_replace('#\{([a-zA-Z_][a-zA-Z0-9_]*)\}#', '(?P<\1>[^/]+)', $pattern);
    $patternRegex = "#^" . $patternRegex . "$#";

    if ($_SERVER['REQUEST_METHOD'] === strtoupper($method) && preg_match($patternRegex, $route, $matches)) {
        $routeMatched = true;
        // Ambil hanya named parameter
        $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
        call_user_func_array($callback, $params);
        exit;
    }
}

function auth_check() {
    session_start();
    include_once __DIR__ . '/config/koneksi.php';

    // Jika session belum ada, cek cookie remember_token
    if (!isset($_SESSION['logged_in']) && isset($_COOKIE['remember_token'])) {
        $token = mysqli_real_escape_string($conn, $_COOKIE['remember_token']);
        $query = mysqli_query($conn, "SELECT * FROM ts_admin WHERE remember_token = '$token'");
        $user = mysqli_fetch_assoc($query);

        if ($user) {
            // Set session login otomatis
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
        } else {
            // Token tidak valid, hapus cookie
            setcookie('remember_token', '', time() - 3600, '/');
        }
    }

    // Jika tetap belum login, redirect
    if (!isset($_SESSION['logged_in'])) {
        header("Location: /tracer-study-machung/admin/login");
        exit;
    }
}