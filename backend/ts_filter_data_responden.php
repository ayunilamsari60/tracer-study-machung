<?php
include 'config/koneksi.php';
$sql = "
    SELECT 
        sd.id AS submit_id,
        sd.id_register,
        rm.id_user,
        rm.email,
        rm.no_telepon,
        tp.*,
        tm.*
    FROM ts_form_submit sd
    JOIN ts_register_mahasiswa rm ON rm.id_register = sd.id_register
    JOIN ts_data_mahasiswa tm ON tm.id_user = rm.id_user
    JOIN ts_data_prodi tp ON tp.id = tm.id_prodi
";
// 4. Eksekusi query
$result = $conn->query($sql);

// Ambil data fakultas unik
// $fakultasQuery = "SELECT DISTINCT fakultas FROM ts_data_mahasiswa";
// $fakultasResult = $conn->query($fakultasQuery);

// Ambil data program studi unik
$prodiQuery = "SELECT DISTINCT nama_prodi, kode_prodi FROM ts_data_prodi";
$prodiResult = $conn->query($prodiQuery);
