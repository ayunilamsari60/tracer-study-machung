<?php
include 'config/koneksi.php';
$sql = "
    SELECT 
        sd.id AS submit_id,
        sd.id_register,
        rm.nim_mahasiswa,
        rm.email,
        rm.no_telepon,
        YEAR(tw.tglsk) AS tahun_lulus,
        tp.*,
        tm.*
    FROM ts_form_submit sd
    JOIN ts_register_mahasiswa rm ON rm.id_register = sd.id_register
    JOIN akademik_master_mahasiswa tm ON tm.nim_mahasiswa = rm.nim_mahasiswa
    JOIN akademik_master_program_studi tp ON tp.kode_prodi = tm.id_prodi
    JOIN akademik_transaksi_wisuda_detail twd ON twd.nim_mahasiswa = rm.nim_mahasiswa
    JOIN akademik_transaksi_yudisium tw ON tw.id_wisuda = twd.id_yudisium
";
// 4. Eksekusi query
$result = $conn->query($sql);

// Ambil data fakultas unik
// $fakultasQuery = "SELECT DISTINCT fakultas FROM ts_data_mahasiswa";
// $fakultasResult = $conn->query($fakultasQuery);

// Ambil data program studi unik
$prodiQuery = "SELECT DISTINCT nama_prodi_in, kode_prodi FROM akademik_master_program_studi";
$prodiResult = $conn->query($prodiQuery);
