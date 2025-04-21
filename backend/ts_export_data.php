<?php
include "config/koneksi.php";
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

// Ambil data dari tabel
$query = "
    SELECT 
    tp.kode_prodi,
    tm.nim_mahasiswa,
    tm.nama,
    rm.email,
    rm.no_telepon,

    sd.F8, sd.F502, sd.F505, sd.F5a1, sd.F5a2, sd.F1101, sd.F1102, sd.F5b, sd.F5c, sd.F5d, 
    sd.F18a, sd.F18b, sd.F18c, sd.F18d, sd.F1201, sd.F14, sd.F15, sd.F1761, sd.F1762, sd.F1763, 
    sd.F1764, sd.F1765, sd.F1766, sd.F1767, sd.F1768, sd.F1769, sd.F1770, sd.F1771, sd.F1772, 
    sd.F1773, sd.F1774, sd.F21, sd.F22, sd.F23, sd.F24, sd.F25, sd.F26, sd.F27, sd.F301, sd.F302, 
    sd.F303, sd.F401, sd.F402, sd.F403, sd.F404, sd.F405, sd.F406, sd.F407, sd.F408, sd.F409, sd.F410, 
    sd.F411, sd.F412, sd.F413, sd.F414, sd.F415, sd.F416, sd.F6, sd.F7, sd.F7a, sd.F1001, sd.f1601, sd.f1602, 
    sd.f1603, sd.f1604, sd.f1605, sd.f1606, sd.f1607, sd.f1608, sd.f1609, sd.f1610, sd.f1611, sd.f1612, sd.f1613, sd.f1614

    FROM submit_data sd
    JOIN ts_register_mahasiswa rm ON rm.id_register = sd.id_register
    JOIN ts_data_mahasiswa1 tm ON tm.id_user = rm.id_user
    JOIN ts_data_prodi tp ON tp.id = tm.id_prodi
";
// $query = "SELECT * FROM submit_data";
$result = $conn->query($query);

// Buat spreadsheet baru
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Ambil nama kolom
$columns = [];
while ($field = $result->fetch_field()) {
    $columns[] = $field->name;
}

// Set nama kolom sebagai header di baris 1
foreach ($columns as $index => $columnName) {
    $colLetter = Coordinate::stringFromColumnIndex($index + 1); // Ubah ke huruf A, B, C, ...
    $sheet->setCellValue($colLetter . '1', $columnName);
}

// Isi data mulai baris ke-2
$rowIndex = 2;
while ($row = $result->fetch_assoc()) {
    foreach ($columns as $colIndex => $columnName) {
        $colLetter = Coordinate::stringFromColumnIndex($colIndex + 1);
        $sheet->setCellValue($colLetter . $rowIndex, $row[$columnName]);
    }
    $rowIndex++;
}

// Simpan sebagai file Excel
$writer = new Xlsx($spreadsheet);
$filename = 'hasil_export_submit_data.xlsx';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment;filename=\"$filename\"");
header('Cache-Control: max-age=0');
$writer->save('php://output');
exit;
?>