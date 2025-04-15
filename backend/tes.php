<?php
include "../config/koneksi.php";

$request = $_REQUEST;

// Cek jumlah total data
$sql = "SELECT COUNT(*) AS total FROM ts_data_mahasiswa";
$totalResult = $conn->query($sql)->fetch_assoc();
$totalData = $totalResult['total'];

$columns = ['tahun_lulus', 'fakultas', 'nama_prodi', 'nim', 'nama_mahasiswa', 'no_telepon', 'email'];
$orderColumn = $columns[$request['order'][0]['column'] - 1];
$orderDir = $request['order'][0]['dir'];

$start = $request['start'];
$length = $request['length'];
$search = $conn->real_escape_string($request['search']['value']);

$where = "";
if (!empty($search)) {
    $where .= " WHERE nama_mahasiswa LIKE '%$search%' OR nim LIKE '%$search%' ";
}

$sql = "SELECT * FROM ts_data_mahasiswa $where ORDER BY $orderColumn $orderDir LIMIT $start, $length";
$dataResult = $conn->query($sql);

$data = [];
$no = $start + 1;
while ($row = $dataResult->fetch_assoc()) {
    $data[] = [
        "no" => $no++,
        "tahun_lulus" => $row['tahun_lulus'],
        "fakultas" => $row['fakultas'],
        "nama_prodi" => $row['nama_prodi'],
        "nim" => $row['nim'],
        "nama_mahasiswa" => $row['nama_mahasiswa'],
        "no_telepon" => $row['no_telepon'],
        "email" => $row['email'],
        "aksi" => '<button class="btn btn-sm btn-outline-primary">Lihat</button>'
    ];
}

$response = [
    "draw" => intval($request['draw']),
    "recordsTotal" => intval($totalData),
    "recordsFiltered" => intval($totalData), // Bisa beda kalau pakai filter
    "data" => $data
];

echo json_encode($response);
