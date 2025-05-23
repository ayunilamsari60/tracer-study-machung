<?php 
include "config/koneksi.php";
session_start();
$query = "SELECT * FROM ts_konfigurasi WHERE id = 1";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$tahun_lulus_mulai = $row['tahun_lulus_mulai'];
$tahun_lulus_akhir = $row['tahun_lulus_akhir'];
$tahun_isian = $row['tahun_isian'];
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>SI Trace Study Ma Chung</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.ico') ?>">

    <!-- CSS Dependencies -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" />
    <link href="<?= base_url('assets/css/icons.min.css') ?>" rel="stylesheet" />
    <link href="<?= base_url('assets/css/app.min.css') ?>" rel="stylesheet" />
    <link href="<?= base_url('assets/libs/select2/css/select2.min.css') ?>" rel="stylesheet" />
    <link href="<?= base_url('assets/libs/sweetalert2/sweetalert2.min.css') ?>" rel="stylesheet" type="text/css" />
    <style>
        body,
        html {
            overflow-x: hidden;
        }
    </style>
</head>

<body>
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-primary bg-soft">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4">
                                        <h3 class="text-primary">Selamat Datang!</h3>
                                        <p>Sebelum mengisi form, isi data diri Anda terlebih dahulu.</p>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end">
                                    <img src="assets/images/profile-img.png" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="p-2">
                                <form id="registerForm" action="register/post" method="POST" class="mt-4">
                                    <div class="mb-3">
                                        <label class="form-label">Tahun Lulus <span class="text-danger">*</span></label>
                                        <select id="tahun_lulus" name="tahun_lulus" class="form-select" required
                                            onchange="updateNamaMahasiswa()">
                                            <option value="" selected disabled>Pilih...</option>
                                            <!-- Loop dengan PHP -->
                                            <?php for ($tahun_lulus_mulai; $tahun_lulus_mulai <= $tahun_lulus_akhir; $tahun_lulus_mulai++) { ?>
                                                <option value="<?php echo $tahun_lulus_mulai; ?>"><?php echo $tahun_lulus_mulai; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Tahun Isian <span class="text-danger">*</span></label>
                                        <input type="text" id="tahun_isian" name="tahun_isian" class="form-control"
                                            placeholder="Masukkan Tahun Isian" value="<?= $tahun_isian ?>" readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Nama Mahasiswa <span
                                                class="text-danger">*</span></label>
                                        <select id="nama" name="nama" class="form-control select2" required>
                                            <option>Cari...</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">NIK <span class="text-danger">*</span></label>
                                        <input type="text" id="nik" name="nik" class="form-control"
                                            placeholder="Masukkan NIK" inputmode="numeric"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                            maxlength="16" required />
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="text" id="email" name="email" class="form-control"
                                            placeholder="Masukkan Email" required>
                                    </div>

                                    <label class="form-label">No. Telepon <span class="text-danger">*</span></label>
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <div class="input-group-text">+62</div>
                                            <input type="tel" id="no_telepon" name="no_telepon" class="form-control"
                                                placeholder="Masukkan No. Telepon" required>
                                        </div>
                                        <div id="nikHelp" class="form-text">*Masukan Nomor langsung ke angka 8 contoh:
                                            831232....</div>
                                    </div>

                                    <div class="mt-4 d-grid">
                                        <button id="btn-daftar" class="btn btn-primary waves-effect waves-light"
                                            type="submit">Daftar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="mt-1 text-center">
                        <p>Butuh bantuan? Kunjungi <a href="https://ithelpdesk.machung.ac.id/">https://ithelpdesk.machung.ac.id/</a> 
                        </p>
                    </div>
                    <div class="mt-1 text-center">
                        <p>© SI Trace Study
                            <script>
                                document.write(new Date().getFullYear())
                            </script>, Crafted with <i class="mdi mdi-heart text-danger"></i> by Ma Chung
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS Dependencies -->
    <script src="<?= base_url('assets/libs/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/libs/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/libs/select2/js/select2.min.js') ?>"></script>
    <script src="<?= base_url('assets/libs/sweetalert2/sweetalert2.min.js') ?>"></script>
    <!-- <script src="assets/js/app.js"></script> -->

    <script>
        $(document).ready(function () {
            $(".select2").select2();
        });
        function updateNamaMahasiswa() {
            const tahun = document.getElementById("tahun_lulus").value;
            const namaSelect = document.getElementById("nama");

            namaSelect.innerHTML = '<option value="">Loading...</option>';
            namaSelect.disabled = true;

            fetch("api/get-nama-mahasiswa", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "tahun_lulus=" + encodeURIComponent(tahun),
            })
                .then(response => response.text())
                .then(data => {
                    namaSelect.innerHTML = data;
                    namaSelect.disabled = false;
                })
                .catch(() => {
                    namaSelect.innerHTML = '<option value="">Gagal memuat data</option>';
                    namaSelect.disabled = false;
                });
        }

        document.getElementById("registerForm").addEventListener("submit", function (event) {
            Swal.fire({
                title: 'Proses...',
                text: 'Mohon menunggu sebentar',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });
        });
        <?php if (isset($_SESSION['error'])) { ?>
            Swal.fire({
                title: 'Gagal!',
                text: '<?php echo $_SESSION['error']; ?>',
                icon: 'error'
            });
            <?php unset($_SESSION['error']);
        } ?>
    </script>
</body>

</html>