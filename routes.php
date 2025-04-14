<?php

function route($method, $pattern, $callback) {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $basePath = '/tracer-study-machung'; // Ganti sesuai project kamu

    // Hapus base path dari URL
    $route = substr($uri, strlen($basePath));

    // Ganti {parameter} dengan regex
    $patternRegex = preg_replace('#\{([a-zA-Z_][a-zA-Z0-9_]*)\}#', '(?P<\1>[^/]+)', $pattern);
    $patternRegex = "#^" . $patternRegex . "$#";

    if ($_SERVER['REQUEST_METHOD'] === strtoupper($method) && preg_match($patternRegex, $route, $matches)) {
        // Ambil hanya named parameter
        $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
        call_user_func_array($callback, $params);
        exit;
    }
}
