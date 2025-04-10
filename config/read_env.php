<?php 
function loadEnv($path) {
    // Cek apakah file .env ada
    if (!file_exists($path)) {
        // Tidak usah throw error, cukup log kalau mau
        // error_log('.env file not found at: ' . $path);
        return;
    }

    // Baca semua baris dalam file .env
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        // Skip baris komentar
        if (strpos(trim($line), '#') === 0) {
            continue;
        }

        // Pisahkan nama dan nilai
        $parts = explode('=', $line, 2);
        if (count($parts) !== 2) {
            continue; // Lewati baris yang tidak valid
        }

        $name = trim($parts[0]);
        $value = trim($parts[1]);

        // Jangan timpa jika sudah ada
        if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
            putenv(sprintf('%s=%s', $name, $value));
            $_ENV[$name] = $value;
            $_SERVER[$name] = $value;
        }
    }
}

// Panggil fungsi loadEnv
loadEnv(__DIR__ . '/.env');
?>
