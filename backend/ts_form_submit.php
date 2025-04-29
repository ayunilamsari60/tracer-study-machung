<?php
session_start();
require 'config/koneksi.php'; // Panggil koneksi database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $id_register = $_SESSION['id_register'] ?? null;

    // Step 1 data Start
    $F8 = isset($_POST["F8"]) ? $_POST["F8"] : '0';
    // Step 1 data End

    // Step 2 data General start
    $F1101 = ($_POST['f1101']) ?? '0';
    $F1102 = ($_POST['f1102']) ?? '';

    if ($F1101 !== "7") {
        $F1102 = '';
    }

    $f301 = isset($_POST['f301']) ? $_POST['f301'] : '0';
    $f302 = '0';
    $f303 = '';
    if ($f301 == "1") {
        $f302 = isset($_POST['f302']) ? $_POST['f302'] : '0';
    } else if ($f301 == "2") {
        $f303 = isset($_POST['f303']) ? $_POST['f303'] : '0';
    }

    $f502 = isset($_POST['f502']) ? $_POST['f502'] : '0';

    $f14 = isset($_POST['f14']) ? $_POST['f14'] : '0';

    $f401 = isset($_POST['f401']) ? $_POST['f401'] : '0';
    $f402 = isset($_POST['f402']) ? $_POST['f402'] : '0';
    $f403 = isset($_POST['f403']) ? $_POST['f403'] : '0';
    $f404 = isset($_POST['f404']) ? $_POST['f404'] : '0';
    $f405 = isset($_POST['f405']) ? $_POST['f405'] : '0';
    $f406 = isset($_POST['f406']) ? $_POST['f406'] : '0';
    $f407 = isset($_POST['f407']) ? $_POST['f407'] : '0';
    $f408 = isset($_POST['f408']) ? $_POST['f408'] : '0';
    $f409 = isset($_POST['f409']) ? $_POST['f409'] : '0';
    $f410 = isset($_POST['f410']) ? $_POST['f410'] : '0';
    $f411 = isset($_POST['f411']) ? $_POST['f411'] : '0';
    $f412 = isset($_POST['f412']) ? $_POST['f412'] : '0';
    $f413 = isset($_POST['f413']) ? $_POST['f413'] : '0';
    $f414 = isset($_POST['f414']) ? $_POST['f414'] : '0';
    $f415 = isset($_POST['f415']) ? $_POST['f415'] : '0';
    $f416 = isset($_POST['f416']) ? $_POST['f416'] : '';

    $f5d = isset($_POST['f5d']) ? $_POST['f5d'] : '0';

    $f1601 = isset($_POST['f1601']) ? $_POST['f1601'] : '0';
    $f1602 = isset($_POST['f1602']) ? $_POST['f1602'] : '0';
    $f1603 = isset($_POST['f1603']) ? $_POST['f1603'] : '0';
    $f1604 = isset($_POST['f1604']) ? $_POST['f1604'] : '0';
    $f1605 = isset($_POST['f1605']) ? $_POST['f1605'] : '0';
    $f1606 = isset($_POST['f1606']) ? $_POST['f1606'] : '0';
    $f1607 = isset($_POST['f1607']) ? $_POST['f1607'] : '0';
    $f1608 = isset($_POST['f1608']) ? $_POST['f1608'] : '0';
    $f1609 = isset($_POST['f1609']) ? $_POST['f1609'] : '0';
    $f1610 = isset($_POST['f1610']) ? $_POST['f1610'] : '0';
    $f1611 = isset($_POST['f1611']) ? $_POST['f1611'] : '0';
    $f1612 = isset($_POST['f1612']) ? $_POST['f1612'] : '0';
    $f1613 = isset($_POST['f1613']) ? $_POST['f1613'] : '0';
    $f1614 = isset($_POST['f1614']) ? $_POST['f1614'] : '';

    $f6 = isset($_POST['f6']) ? $_POST['f6'] : '0';
    $f7 = isset($_POST['f7']) ? $_POST['f7'] : '0';
    $f7a = isset($_POST['f7a']) ? $_POST['f7a'] : '0';

    $f1001 = isset($_POST['f1001']) ? $_POST['f1001'] : '0';
    $f1002 = isset($_POST['f1002']) ? $_POST['f1002'] : '0';

    $UMC1 = isset($_POST['UMC1']) ? $_POST['UMC1'] : '0';
    $UMC2 = isset($_POST['UMC2']) ? $_POST['UMC2'] : '0';
    $UMC3 = isset($_POST['UMC3']) ? $_POST['UMC3'] : '0';
    $UMC4 = isset($_POST['UMC4']) ? $_POST['UMC4'] : '0';
    $UMC5 = isset($_POST['UMC5']) ? $_POST['UMC5'] : '0';

    // Step 2 data General end

    // Step 2 data : Bekerja Start
    $f505 = isset($_POST['f505']) ? $_POST['f505'] : '0';
    // $f5a1 = isset($_POST['f5a1']) ? $_POST['f5a1'] : '0';
    $f5a1 = isset($_POST['f5a1']) ? str_pad($_POST['f5a1'], 6, '0', STR_PAD_LEFT) : '0';
    $f5a2 = isset($_POST['f5a2']) ? $_POST['f5a2'] : '0';
    $f5b = isset($_POST['f5b']) ? $_POST['f5b'] : '0';
    $f15 = isset($_POST['f15']) ? $_POST['f15'] : '0';
    // Step 2 data : Bekerja End

    // Step 2 data : Wiraswasta Start
    $f5c = isset($_POST['f5c']) ? $_POST['f5c'] : '0';
    // Step 2 data : Wiraswasta End

    // Step 2 data : Pendidikan Start
    $F18a = isset($_POST['F18a']) ? $_POST['F18a'] : '';
    $F18b = isset($_POST['F18b']) ? $_POST['F18b'] : '';
    $F18c = isset($_POST['F18c']) ? $_POST['F18c'] : '';
    $F18d = isset($_POST['F18d']) ? $_POST['F18d'] : '';

    $f1201 = $_POST['F1201'] ?? '0';
    $f1202 = $_POST['f1202'] ?? '';

    // Jika user tidak memilih "Lainnya", kosongkan f1202
    if ($f1201 !== "7") {
        $f1202 = '';
    }
    // Step 2 data : Pendidikan End

    // Step 2 data : Mencari Kerja Start
    // Step 2 data : Mencari Kerja End

    // Step 3 data Start
    $F1761 = isset($_POST['F1761']) ? $_POST['F1761'] : '0';
    $F1762 = isset($_POST['F1762']) ? $_POST['F1762'] : '0';
    $F1763 = isset($_POST['F1763']) ? $_POST['F1763'] : '0';
    $F1764 = isset($_POST['F1764']) ? $_POST['F1764'] : '0';
    $F1765 = isset($_POST['F1765']) ? $_POST['F1765'] : '0';
    $F1766 = isset($_POST['F1766']) ? $_POST['F1766'] : '0';
    $F1767 = isset($_POST['F1767']) ? $_POST['F1767'] : '0';
    $F1768 = isset($_POST['F1768']) ? $_POST['F1768'] : '0';
    $F1769 = isset($_POST['F1769']) ? $_POST['F1769'] : '0';
    $F1770 = isset($_POST['F1770']) ? $_POST['F1770'] : '0';
    $F1771 = isset($_POST['F1771']) ? $_POST['F1771'] : '0';
    $F1772 = isset($_POST['F1772']) ? $_POST['F1772'] : '0';
    $F1773 = isset($_POST['F1773']) ? $_POST['F1773'] : '0';
    $F1774 = isset($_POST['F1774']) ? $_POST['F1774'] : '0';

    $f21 = isset($_POST['F21']) ? $_POST['F21'] : '0';
    $f22 = isset($_POST['F22']) ? $_POST['F22'] : '0';
    $f23 = isset($_POST['F23']) ? $_POST['F23'] : '0';
    $f24 = isset($_POST['F24']) ? $_POST['F24'] : '0';
    $f25 = isset($_POST['F25']) ? $_POST['F25'] : '0';
    $f26 = isset($_POST['F26']) ? $_POST['F26'] : '0';
    $f27 = isset($_POST['F27']) ? $_POST['F27'] : '0';

    // Step 3 data End

    // Debugging hasil input
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

    // Query untuk menyimpan data
    $sql = "INSERT INTO ts_form_submit 
            (id_register, F8, F18a, F18b, F18c, F18d, F1101, F1102, F1201, F1202, 
            F1761, F1762, F1763, F1764, F1765, F1766, F1767, F1768, F1769, F1770, F1771, F1772, F1773, F1774, 
            f21, f22, f23, f24, f25, f26, f27, 
            f301, f302, f303, f401, f402, f403, f404, f405, f406, f407, f408, f409, f410, f411, f412, f413, f414, f415, f416,
            f505, f5a1, f5a2, f5b, f15, f5c, f5d, f502,
            UMC1, UMC2, UMC3, UMC4, UMC5,
            f1601, f1602, f1603, f1604, f1605, f1606, f1607, f1608, f1609, f1610, f1611, f1612, f1613, f1614, f14, f6, f7, f7a, f1001, f1002)
            VALUES (" . implode(',', array_fill(0, 83, '?')) . ")";


    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "i" . str_repeat("s", 82), 
        $id_register,
        $F8, $F18a, $F18b, $F18c, $F18d, $F1101, $F1102, $f1201, $f1202,
        $F1761, $F1762, $F1763, $F1764, $F1765, $F1766, $F1767, $F1768, $F1769, $F1770, $F1771, $F1772, $F1773, $F1774,
        $f21, $f22, $f23, $f24, $f25, $f26, $f27,
        $f301, $f302, $f303, $f401, $f402, $f403, $f404, $f405, $f406, $f407, $f408, $f409, $f410, $f411, $f412, $f413, $f414, $f415, $f416,
        $f505, $f5a1, $f5a2, $f5b, $f15, $f5c, $f5d, $f502,
        $UMC1, $UMC2, $UMC3, $UMC4, $UMC5,
        $f1601, $f1602, $f1603, $f1604, $f1605, $f1606, $f1607, $f1608, $f1609, $f1610, $f1611, $f1612, $f1613, $f1614, $f14, $f6, $f7, $f7a, $f1001, $f1002
    );

    if ($stmt->execute()) {
        unset($_SESSION['id_register']); // Misalnya kamu hanya ingin menghapus ini
        unset($_SESSION['email']);
        unset($_SESSION['tahun_isian']); 
        echo "Data berhasil disimpan!";
        header("Location: " . base_url('selesai'));
        exit; // Penting, agar redirect benar-benar berhenti
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Akses ditolak!";
}
