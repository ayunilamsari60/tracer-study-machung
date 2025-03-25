<?php
require '../config/koneksi.php'; // Panggil koneksi database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    // 
    $F8 = isset($_POST["F8"]) ? $_POST["F8"] : null;
    // $F502 = isset($_POST["F502"]) ? $_POST["F502"] : null;
    // $F18D = isset($_POST["F18D"]) ? $_POST["F18D"] : null;
    $F18a = isset($_POST['F18a']) ? $_POST['F18a'] : NULL;
    $F18b = isset($_POST['f18b']) ? $_POST['f18b'] : NULL;
    $F18c = isset($_POST['F18c']) ? $_POST['F18c'] : NULL;
    $F18d = isset($_POST['F18d']) ? $_POST['F18d'] : NULL;

    $f1201 = $_POST['F1201'] ?? NULL;
    $f1202 = $_POST['f1202'] ?? NULL;

    // Jika user tidak memilih "Lainnya", kosongkan f1202
    if ($f1201 !== "7") {
        $f1202 = NULL;
    }

    // Query untuk menyimpan data
    $sql = "INSERT INTO data_table (F8, F18a, F18b, F18c, F18d, F1201, F1202) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $F8, $F18a, $F18b, $F18c, $F18d, $f1201, $f1202);

    if ($stmt->execute()) {
        echo "Data berhasil disimpan!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Akses ditolak!";
}
