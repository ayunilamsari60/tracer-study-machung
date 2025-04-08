<?php
    require '../config/koneksi.php'; // Panggil koneksi database

    $query = "SELECT * FROM ts_master_provinsi";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['Kode_Provinsi'] . '">' . $row['Nama_Provinsi'] . '</option>';
        }
    } else {
        echo '<option disabled>Tidak ada data provinsi</option>';
    }
    ?>