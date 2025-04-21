<?php
$routes = [];
$routeMatched = false;

function route($method, $pattern, $callback)
{
    global $routes;
    $method = strtoupper($method);

    $patternRegex = preg_replace('#\{([a-zA-Z_][a-zA-Z0-9_]*)\}#', '(?P<\1>[^/]+)', $pattern);
    $patternRegex = "#^" . $patternRegex . "$#";

    $routes[] = [
        'method' => $method,
        'pattern' => $pattern,
        'regex' => $patternRegex,
        'callback' => $callback
    ];
}

function resolve()
{
    global $routes, $routeMatched;

    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    // Ambil direktori root project (misal: /tracer-study-machung)
    $scriptName = $_SERVER['SCRIPT_NAME']; // contoh: /tracer-study-machung/index.php
    $basePath = rtrim(dirname($scriptName), '/'); // hasil: /tracer-study-machung

    $route = substr($uri, strlen($basePath));
    if ($route === false || $route === '')
        $route = '/';

    $method = $_SERVER['REQUEST_METHOD'];

    foreach ($routes as $r) {
        if ($method === $r['method'] && preg_match($r['regex'], $route, $matches)) {
            $routeMatched = true;
            $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
            call_user_func_array($r['callback'], $params);
            return;
        }
    }

    http_response_code(404);
    require 'views/errors/404.php'; // Pastikan file ini ada
    exit;
}


function base_url($path = '')
{
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
    $host = $_SERVER['HTTP_HOST'];
    $script = dirname($_SERVER['SCRIPT_NAME']); // misal: /tracer-study-machung/admin

    // Pastikan nggak ada double slash
    $base = rtrim($protocol . "://" . $host . $script, "/");

    // Gabungkan dengan path tambahan
    return $base . '/' . ltrim($path, '/');
}


function auth_check()
{
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
        header("Location: admin/login");
        exit;
    }
}