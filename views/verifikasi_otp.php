<?php
session_start();
if (!isset($_SESSION['email'])) {
    $_SESSION['error'] = "Session expired. Silakan register ulang.";
    header("Location: ../views/auth-register.php");
    exit();
}
?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>SI Trace Study Ma Chung</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />


</head>

<body>

    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row">
                <!-- Tempat menampilkan pesan sukses -->
                <?php if (isset($_GET['kirim_ulang']) && $_GET['kirim_ulang'] == 'success'): ?>
                    <h4 class="alert alert-success text-center otp-alert">OTP baru telah dikirim ke email Anda</h4>
                <?php elseif (isset($_GET['kirim_ulang']) && $_GET['kirim_ulang'] == 'error'): ?>
                    <h4 class="alert alert-danger text-center otp-alert">Gagal mengirim OTP. Silakan coba lagi!</h4>
                <?php endif; ?>

                <div class="row justify-content-center">
                    <div class="col-lg-12 text-center mb-5 text-muted">
                        <h2>Verifikasi Kode OTP</h2>
                        <h6 class="mt-3">Silakan cek email Anda. Kami telah mengirimkan kode OTP untuk memastikan bahwa data yang Anda isi benar</h6>
                    </div>
                </div>

                <!-- end row -->
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card">

                            <div class="card-body">

                                <div class="p-2">
                                    <div class="text-center">

                                        <div class="avatar-md mx-auto">
                                            <div class="avatar-title rounded-circle bg-light">
                                                <i class="bx bxs-envelope h1 mb-0 text-primary"></i>
                                            </div>
                                        </div>
                                        <div class="p-2 mt-4">

                                            <h4>Verifikasi Email Anda</h4>
                                            <p class="mb-5">Masukkan kode 4 digit yang telah dikirim ke <br>
                                                <span class="fw-semibold"><?php echo $_SESSION['email']; ?></span>
                                            </p>

                                            <form action="../backend/ts_verifikasi_otp.php" method="POST">
                                                <div class="mb-3">
                                                    <input type="text" class="form-control form-control-lg text-center" maxLength="4" id="otp-input" name="otp_kode" id="otp_kode" placeholder="Masukkan Kode OTP" required />
                                                </div>

                                                <div class="mt-4">
                                                    <button type="submit" class="btn btn-success w-md">Verifikasi</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="mt-5 text-center">
                            <form action="../backend/ts_kirim_ulang_otp.php" method="POST">
                                <p>Tidak mendapatkan OTP?
                                    <button type="submit" name="resendOtp" class="fw-medium text-primary" style="border: none; background: none; cursor: pointer; color: blue;">Kirim Ulang</button>
                                </p>
                            </form>

                            <!-- <p>Tidak mendapatkan OTP? <a href="#" class="fw-medium text-primary resend-otp">Kirim Ulang</a></p> -->
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>
        <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>


        <!-- two-step-verification js -->
        <script src="assets/js/pages/two-step-verification.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>

        <script>
            <?php if (isset($_SESSION['error'])) { ?>
                Swal.fire({
                    title: 'Gagal!',
                    text: '<?php echo $_SESSION['error']; ?>',
                    icon: 'error'
                });
                <?php unset($_SESSION['error']); ?>
            <?php } ?>

            <?php if (isset($_SESSION['success'])) { ?>
                Swal.fire({
                    title: 'Berhasil!',
                    text: '<?php echo $_SESSION['success']; ?>',
                    icon: 'success'
                }).then(() => {
                    window.location.href = "dashboard.php"; // Redirect jika sukses
                });
                <?php unset($_SESSION['success']); ?>
            <?php } ?>
            // $(document).ready(function() {
            // $(".resend-otp").click(function(e) {
            // e.preventDefault(); // Mencegah pindah halaman

            // // Hapus alert sebelumnya jika ada
            // $(".otp-alert").remove();

            // // Tampilkan pesan sukses
            // $("<h4 class='alert alert-success text-center otp-alert'>OTP baru telah dikirim ke email Anda</h4>")
            // .hide()
            // .prependTo(".container") // Masukkan di dalam container
            // .fadeIn(500);


            // });
            // });
        </script>

</body>

</html>