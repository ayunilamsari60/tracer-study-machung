<!-- dashboard.php -->
<?php
$title = "Dashboard";
$custom_css = '
    <!-- tui charts Css -->
    <link href="assets/libs/tui-chart/tui-chart.min.css" rel="stylesheet" type="text/css" />
';
$custom_js = '
    <!-- tui charts plugins -->
    <script src="assets/libs/tui-chart/tui-chart-all.min.js"></script>
    <script src="assets/libs/tui-chart/maps/usa.js"></script>
    <script src="assets/js/pages/tui-charts.init.js"></script>
';

ob_start();
?>

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Starter Page</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Utility</a></li>
                    <li class="breadcrumb-item active">Starter Page</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean(); // Simpan konten yang sudah dibuat
include 'templates/master.php'; // Gunakan template utama
?>