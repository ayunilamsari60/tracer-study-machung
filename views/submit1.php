<?php
require '../config/koneksi.php'; // Panggil koneksi database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form

    // Step 1 data Start
    $F8 = isset($_POST["F8"]) ? $_POST["F8"] : '';
    // Step 1 data End

    // Step 2 data : Pendidikan Start
    $F18a = isset($_POST['F18a']) ? $_POST['F18a'] : '';
    $F18b = isset($_POST['f18b']) ? $_POST['f18b'] : '';
    $F18c = isset($_POST['F18c']) ? $_POST['F18c'] : '';
    $F18d = isset($_POST['F18d']) ? $_POST['F18d'] : '';

    $f1201 = $_POST['F1201'] ?? '';
    $f1202 = $_POST['f1202'] ?? '';

    // Jika user tidak memilih "Lainnya", kosongkan f1202
    if ($f1201 !== "7") {
        $f1202 = '';
    }
    // Step 2 data : Pendidikan End

    // Step 3 data Start
    $F1761 = isset($_POST['F1761']) ? $_POST['F1761'] : '';
    $F1762 = isset($_POST['F1762']) ? $_POST['F1762'] : '';
    $F1763 = isset($_POST['F1763']) ? $_POST['F1763'] : '';
    $F1764 = isset($_POST['F1764']) ? $_POST['F1764'] : '';
    $F1765 = isset($_POST['F1765']) ? $_POST['F1765'] : '';
    $F1766 = isset($_POST['F1766']) ? $_POST['F1766'] : '';
    $F1767 = isset($_POST['F1767']) ? $_POST['F1767'] : '';
    $F1768 = isset($_POST['F1768']) ? $_POST['F1768'] : '';
    $F1769 = isset($_POST['F1769']) ? $_POST['F1769'] : '';
    $F1770 = isset($_POST['F1770']) ? $_POST['F1770'] : '';
    $F1771 = isset($_POST['F1771']) ? $_POST['F1771'] : '';
    $F1772 = isset($_POST['F1772']) ? $_POST['F1772'] : '';
    $F1773 = isset($_POST['F1773']) ? $_POST['F1773'] : '';
    $F1774 = isset($_POST['F1774']) ? $_POST['F1774'] : '';

    $f21 = isset($_POST['f21']) ? $_POST['f21'] : '';
    
    // Step 3 data End

    // Query untuk menyimpan data
    $sql = "INSERT INTO data_table 
            (F8, F18a, F18b, F18c, F18d, F1201, F1202, F1761, F1762, F1763, F1764, F1765, F1766, F1767, F1768, F1769, F1770, F1771, F1772, F1773, F1774) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $F8, $F18a, $F18b, $F18c, $F18d, $f1201, $f1202, $F1761, $F1762, $F1763, $F1764, $F1765, $F1766, $F1767, $F1768, $F1769, $F1770, $F1771, $F1772, $F1773, $F1774);

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
