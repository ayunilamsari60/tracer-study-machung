<?php
include "config/koneksi.php";
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

// Tangkap input dari POST
$tahunLulus = isset($_POST['tahun_lulus']) ? $_POST['tahun_lulus'] : '';
$prodi = isset($_POST['prodi']) ? $_POST['prodi'] : '';

// Ambil data dari tabel
$query = "
    SELECT 
    tp.kode_dikti,
    tm.nim_mahasiswa,
    tm.nama_mahasiswa,
    rm.no_telepon,
    rm.email,
    YEAR(w.tglsk) as thn_ajaran,
    rm.NIK,

    sd.F8, sd.F502, sd.F505, sd.F5a1, sd.F5a2, sd.F1101, sd.F1102, sd.F5b, sd.F5c, sd.F5d, 
    sd.F18a, sd.F18b, sd.F18c, sd.F18d, sd.F1201, sd.F14, sd.F15, sd.F1761, sd.F1762, sd.F1763, 
    sd.F1764, sd.F1765, sd.F1766, sd.F1767, sd.F1768, sd.F1769, sd.F1770, sd.F1771, sd.F1772, 
    sd.F1773, sd.F1774, sd.F21, sd.F22, sd.F23, sd.F24, sd.F25, sd.F26, sd.F27, sd.F301, sd.F302, 
    sd.F303, sd.F401, sd.F402, sd.F403, sd.F404, sd.F405, sd.F406, sd.F407, sd.F408, sd.F409, sd.F410, 
    sd.F411, sd.F412, sd.F413, sd.F414, sd.F415, sd.F416, sd.F6, sd.F7, sd.F7a, sd.F1001, sd.F1601, sd.F1602, 
    sd.F1603, sd.F1604, sd.F1605, sd.F1606, sd.F1607, sd.F1608, sd.F1609, sd.F1610, sd.F1611, sd.F1612, sd.F1613, sd.F1614
";

if ($_POST['export_form'] == 'umc') {
    $query .= ", sd.UMC1, sd.UMC2, sd.UMC3, sd.UMC4, sd.UMC5";
}


$query .= " 
    FROM ts_form_submit sd
    JOIN ts_register_mahasiswa rm ON rm.id_register = sd.id_register
    JOIN akademik_master_mahasiswa tm ON tm.nim_mahasiswa = rm.nim_mahasiswa
    JOIN akademik_master_program_studi tp ON tp.kode_prodi = tm.id_prodi
    JOIN akademik_transaksi_wisuda_detail wd ON tm.nim_mahasiswa = wd.nim_mahasiswa
    JOIN akademik_transaksi_yudisium w ON wd.id_wisuda = w.id_yudisium";

if (!empty($tahunLulus)) {
    $tahunLulus = $conn->real_escape_string($tahunLulus);
    $query .= " WHERE YEAR(w.tglsk) = '$tahunLulus'";
}
if (!empty($prodi)) {
    $prodi = $conn->real_escape_string($prodi);
    $query .= " WHERE tp.kode_prodi = '$prodi'";
}
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
$customHeaders = [
    'kode_prodi' => 'Kode Prodi',
    'nim_mahasiswa' => 'NIM/Nomor Mahasiswa',
    'nama' => 'Nama',
    'no_telepon' => 'HP',
    'email' => 'Email',
    'thn_ajaran' => 'Tahun Lulus',
    // tambahkan sesuai kebutuhan...
];

$sheetColumnIndex = 1; // Untuk melacak posisi kolom Excel (A, B, C, ...)

foreach ($columns as $index => $columnName) {
    // Sisipkan kolom NIK setelah kolom ke-2 (yaitu setelah index 1)
    if ($index === 0) {
        $colLetterKPT = Coordinate::stringFromColumnIndex($sheetColumnIndex++);
        $sheet->setCellValue($colLetterKPT . '1', 'Kode PT'); // Header 'NIK'
    }
    if ($index === 7) {
        $colLetterNPWP = Coordinate::stringFromColumnIndex($sheetColumnIndex++);
        $sheet->setCellValue($colLetterNPWP . '1', 'NPWP'); // Header 'NIK'
    }

    // Kolom normal dari database
    $colLetter = Coordinate::stringFromColumnIndex($sheetColumnIndex++);
    $headerLabel = $customHeaders[$columnName] ?? $columnName;
    $sheet->setCellValue($colLetter . '1', $headerLabel);
}



// Isi data mulai baris ke-2
$rowIndex = 2;
while ($row = $result->fetch_assoc()) {
    $colIndex = 1;
    foreach ($columns as $index => $columnName) {
        if ($index === 0) {
            $colLetterKPT = Coordinate::stringFromColumnIndex($colIndex++);
            $sheet->setCellValueExplicit($colLetterKPT . $rowIndex, '071074', DataType::TYPE_STRING); // Misalnya dari variabel lain
        }
        if ($index === 7) {
            $colLetterNPWP = Coordinate::stringFromColumnIndex($colIndex++);
            $sheet->setCellValueExplicit($colLetterNPWP . $rowIndex, '0', DataType::TYPE_STRING); // Misalnya dari variabel lain
        }

        $colLetter = Coordinate::stringFromColumnIndex($colIndex++);
        $sheet->setCellValueExplicit($colLetter . $rowIndex, $row[$columnName], DataType::TYPE_STRING);
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