<!-- dashboard.php -->
<?php
$title = "Dashboard"; // Judul halaman
ob_start(); // Mulai output buffering
?>

<h4 class="mb-sm-0 font-size-18">Dashboard</h4>
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Selamat Datang</h5>
                <p class="card-text">Ini adalah halaman dashboard utama.</p>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean(); // Simpan konten yang sudah dibuat
include 'master.php'; // Gunakan template utama
?>
