<!-- dashboard.php -->
<?php
include "backend/ts_dashboard.php"; // Mengambil data dari backend
include_once "templates/section.php"; // Memanggil file section.php untuk mendukung fungsi section dan endsection
$title = 'Dashboard';
?>
<?php push('styles') ?>
    <!-- tui charts Css -->
    <link href="<?= base_url("assets/libs/tui-chart/tui-chart.min.css")?>" rel="stylesheet" type="text/css" />
<?php endpush('styles') ?>

<?php 
section('content'); // Memulai section untuk konten dinamis
?>
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Tracerstudy</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="container-fluid">

        <div class="card overflow-hidden shadow mb-4">
            <div class="bg-primary bg-soft">
                <div class="row">
                    <div class="col-7">
                        <div class="text-primary p-4">
                            <h5 class="text-primary mb-1">Selamat Datang!</h5>
                            <h2 class="text-primary fw-bold"><?= htmlspecialchars($_SESSION['username']) ?></h2>
                        </div>
                    </div>
                    <div class="col-5 d-flex justify-content-end align-items-end pe-3 pb-2">
                        <img src="<?= base_url("assets/images/profile-img.png")?>" alt="Dashboard Banner" class="img-fluid" style="max-width: 80%;">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card mini-stats-wid w-100">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">Alumni Sudah Mengisi Form pada tahun isian : <?= $tahun_isian ?></p>
                                <h3 class="mb-6"><?php  echo $total_submit;?></h3>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                    <span class="avatar-title">
                                        <i class="fas fa-user-check font-size-16"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mini-stats-wid w-100">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">Alumni Belum Mengisi Form</p>
                                <h3 class="mb-6"><?php echo $total_belum_submit ?></h3>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                    <span class="avatar-title">
                                        <i class="fas fa-user-times font-size-16"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h5 class="text-muted fw-medium">Jumlah Pengisian Berdasarkan Program Studi</h5>
                            <h5 class="text-muted fw-medium">Berdasarkan Tahun Isian : <?= $tahun_isian ?> </h5>
                        </div>

                        <div id="bar-charts" dir="ltr"></div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-muted fw-medium">Jumlah Pengisian Berdasarkan Tahun</h5>

                        <div id="spline_area" class="apex-charts" dir="ltr"></div>                      
                    </div>
                </div><!--end card-->
            </div>
        </div>
        <!-- end row -->
        </div>
    <!-- end row -->

</div>
<?php 
endsection(); // Mengakhiri section untuk konten dinamis
?>
<?php push('scripts') ?>
    <!-- tui charts plugins -->
    <script src="<?= base_url("assets/libs/tui-chart/tui-chart-all.min.js")?>"></script>
    <script src="<?= base_url("assets/libs/tui-chart/maps/usa.js")?>"></script>
    <script src="<?= base_url("assets/js/pages/tui-charts.init.js?v=' . time() . '")?>"></script>

    <!-- apexcharts -->
    <script src="<?= base_url("assets/libs/apexcharts/apexcharts.min.js")?>"></script>
    <script src="<?= base_url("assets/js/pages/apexcharts.init.js?v=' . time() . '")?>"></script>
<?php endpush('scripts') ?>

<?php
include 'templates/master.php'; // Gunakan template utama
?>