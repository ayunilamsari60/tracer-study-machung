<!-- layout.php -->
<?php
$title = isset($title) ? $title . " - Tracerstudy Ma Chung" : "Tracerstudy Ma Chung";
$custom_css = isset($custom_css) ? $custom_css : ""; // Default kosong jika tidak ada
$custom_js = isset($custom_js) ? $custom_js : ""; // Default kosong jika tidak ada
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <base href="/tracer-study-machung/"> -->
    <title><?php echo $title; ?></title>
    <!-- App favicon -->
    <link rel="shortcut icon" href="/tracer-study-machung/assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="/tracer-study-machung/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />

    <!-- Icons Css -->
    <link href="/tracer-study-machung/assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    <!-- App Css-->
    <link href="/tracer-study-machung/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link href="/tracer-study-machung/assets/css/app.min.css" rel="stylesheet" />
    <!-- Custom CSS dari halaman -->
    <?php echo $custom_css; ?>
</head>

<body data-sidebar="dark">
    <div id="layout-wrapper">

        <!-- Header -->
        <?php include 'header.php'; ?>

        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>

        <!-- Bagian Konten Dinamis -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <?php echo $content; // Ini yang akan diganti di setiap halaman 
                    ?>
                </div>
            </div>

            <!-- Footer -->
            <?php include 'footer.php'; ?>
        </div>
    </div>
    <div class="rightbar-overlay"></div>


    <script src="/tracer-study-machung/assets/libs/jquery/jquery.min.js"></script>
    <script src="/tracer-study-machung/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/tracer-study-machung/assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="/tracer-study-machung/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="/tracer-study-machung/assets/libs/node-waves/waves.min.js"></script>
    <script src="/tracer-study-machung/assets/libs/apexcharts/apexcharts.min.js"></script>

    <script src="/tracer-study-machung/assets/js/app.js"></script>
    <!-- Custom JS dari halaman -->
    <?php echo $custom_js; ?>
</body>

</html>