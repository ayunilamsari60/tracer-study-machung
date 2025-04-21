<?php
include 'config/koneksi.php';
$sql = "
    SELECT 
        sd.id AS submit_id,
        sd.id_register,
        rm.id_user,
        rm.email,
        rm.no_telepon,
        tm.*
    FROM submit_data sd
    JOIN register_mahasiswa rm ON rm.id_register = sd.id_register
    JOIN ts_data_mahasiswa1 tm ON tm.id_user = rm.id_user
";
// 4. Eksekusi query
$result = $conn->query($sql);

// Ambil data fakultas unik
$fakultasQuery = "SELECT DISTINCT fakultas FROM ts_data_mahasiswa";
$fakultasResult = $conn->query($fakultasQuery);

// Ambil data program studi unik
$prodiQuery = "SELECT DISTINCT id_prodi FROM ts_data_mahasiswa1";
$prodiResult = $conn->query($prodiQuery);
