<!-- dashboard.php -->
<?php
include_once "templates/section.php"; // Memanggil file section.php untuk mendukung fungsi section dan endsection
include_once "backend/ts_konfigurasi.php"; // Memanggil file koneksi.php untuk koneksi database
$title = "Data Responden"; // Judul halaman

?>
<?php push('styles') ?>
<!-- DataTables -->
<link href="<?= base_url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css'); ?>" rel="stylesheet"
    type="text/css" />
<link href="<?= base_url('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css'); ?>" rel="stylesheet"
    type="text/css" />
<link href="<?= base_url('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css'); ?>"
    rel="stylesheet" type="text/css" />

<!-- App favicon -->
`
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
<?php endpush('styles') ?>
<?php
section('content'); // Memulai section untuk konten dinamis
?>
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Konfigurasi </h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Tracerstudy</a></li>
                    <li class="breadcrumb-item active">Konfigurasi</li>
                </ol>
            </div>

        </div>

        <div class="card p-4">
            <form id="myForm" method="post">
                <h5>Tahun Lulus</h5>
                <div class="row gx-1 gy-3 mb-4">
                    <div class="col-sm-3">
                        <label class="form-label">Tahun Mulai <span class="text-danger">*</span></label>
                        <select id="tahun_lulus_mulai" name="tahun_lulus_mulai" class="form-select">
                            <option value="" disabled <?= empty($tahun_lulus_mulai) ? 'selected' : '' ?>>Mulai...
                            </option>
                            <?php
                            for ($tahun = 2000; $tahun <= date("Y") + 5; $tahun++) {
                                $selected = ($tahun == $tahun_lulus_mulai) ? 'selected' : '';
                                echo "<option value='$tahun' $selected>$tahun</option>";
                            }
                            ?>
                        </select>

                    </div>
                    <div class="col-sm-3">
                        <label class="form-label">Tahun Akhir <span class="text-danger">*</span></label>
                        <select id="tahun_lulus_akhir" name="tahun_lulus_akhir" class="form-select">
                            <option value="" disabled <?= empty($tahun_lulus_akhir) ? 'selected' : '' ?>>Akhir...
                            </option>
                            <?php
                            for ($tahun = 2000; $tahun <= date("Y") + 5; $tahun++) {
                                $selected = ($tahun == $tahun_lulus_akhir) ? 'selected' : '';
                                echo "<option value='$tahun' $selected>$tahun</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <h5>Tahun Isian</h5>
                <div class="row gx-1 gy-3">
                    <div class="col-sm-3">
                        <select id="tahun_isian" name="tahun_isian" class="form-select">
                            <option value="" disabled <?= empty($tahun_isian) ? 'selected' : '' ?>>Pilih Tahun...
                            </option>
                            <?php
                            for ($tahun = 2000; $tahun <= date("Y") + 5; $tahun++) {
                                $selected = ($tahun == $tahun_isian) ? 'selected' : '';
                                echo "<option value='$tahun' $selected>$tahun</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <!-- Tombol Filter -->
                    <div class="col-12">
                        <button class="btn btn-primary mt-2" type="submit" onclick="showToast()">
                            Submit
                        </button>
                        <button id="resetFilter" class="btn btn-secondary mt-2" type="reset">Reset</button>
                    </div>
            </form>


        </div>
    </div>
</div>
</div>
<div class="position-fixed top-0 end-0 p-3" style="z-index: 1005">
    <div id="liveToast" class="toast bg-success bg-gradient text-white" role="alert" aria-live="assertive"
        aria-atomic="true">
        <div class="d-flex">

            <div class="toast-body">
                <i class="bx bx-check-double font-size-16 align-middle me-2"></i>
                Sukses!!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                aria-label="Close"></button>

        </div>
    </div>
</div>
<?php
if (isset($_SESSION['filter_success'])) {
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            new bootstrap.Toast(document.getElementById('liveToast')).show();
        });
    </script>";
    unset($_SESSION['filter_success']);
}
endsection(); // Mengakhiri section untuk konten dinamis
?>
<?php push('scripts') ?>
<!-- Datatable JS -->
<script>
    function showToast() {
        new bootstrap.Toast(document.getElementById("liveToast")).show();
    }

</script>

<?php endpush('scripts') ?>

<?php
include 'templates/master.php'; // Gunakan template utama
?>