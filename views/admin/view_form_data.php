<!-- dashboard.php -->
<?php
include 'config/koneksi.php';
include_once 'templates/section.php';
$title = "Lihat Data"; // Judul halaman
// Buat query untuk mengambil data dari tabel ts_form_submit berdasarkan ID
$query = "SELECT * FROM ts_form_submit WHERE id = $id";
$result = $conn->query($query);

// Cek jika data ditemukan
if ($result->num_rows > 0) {
    $data = $result->fetch_assoc(); // Ambil data sebagai array asosiasi
} else {
    echo "Data tidak ditemukan";
}
?>
<?php section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Form Data</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="../data-responden">Data Responden</a></li>
                    <li class="breadcrumb-item active">Form Data</li>
                </ol>
            </div>
        </div>

        <?php
        // Looping dari form1 hingga form3
        for ($i = 1; $i <= 2; $i++) {
            echo '<div class="card p-5">';
            // Include form berdasarkan nomor loop
            include "form/step$i.php";
            echo '</div>';
        }
        ?>
        <div class="card p-5">
            <?php include "form/step3.php"; ?>
        </div>

    </div>
</div>
<?php endsection(); ?>
<?php push('scripts') ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Ambil semua checkbox di halaman
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');

        // Menambahkan event listener untuk mencegah klik pada setiap checkbox
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('click', function (event) {
                event.preventDefault();  // Mencegah perubahan status
                return false;  // Mencegah aksi lebih lanjut
            });
        });
    });
</script>
<?php endpush('scripts') ?>
<?php
include 'templates/master.php'; // Gunakan template utama
?>