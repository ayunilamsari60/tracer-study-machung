<?php session_start() ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>SI Trace Study Ma Chung</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- CSS Dependencies -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/icons.min.css" rel="stylesheet" />
    <link href="assets/css/app.min.css" rel="stylesheet" />
    <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" />
<<<<<<< HEAD:views/auth-register.html
<<<<<<< HEAD
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" />
    <script>
        function updateNamaMahasiswa() {
            var tahun = document.getElementById("tahun_lulus").value;
            var namaSelect = document.getElementById("nama");

            // Hapus semua opsi sebelum menambahkan data baru
            namaSelect.innerHTML = '<option value="">Loading...</option>';

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "proses.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    namaSelect.innerHTML = xhr.responseText; // Isi langsung dengan opsi HTML
                } else {
                    namaSelect.innerHTML = '<option value="">Tidak Ada data</option>';
                }
            };
            xhr.send("tahun_lulus=" + tahun);
        }
    </script>
=======
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

>>>>>>> 210cdf7 (ganti css)
=======
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
>>>>>>> ff02338 (tambahan backend):views/auth-register.php
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
                                <form id="registerForm" action="../backend/ts_register_mahasiswa.php" method="POST" class="mt-4">
                                    <div class="mb-3">
                                        <label class="form-label">Tahun Lulus <span class="text-danger">*</span></label>
                                        <select id="tahun_lulus" name="tahun_lulus" class="form-select" required onchange="updateNamaMahasiswa()">
                                            <option value="" selected disabled>Pilih...</option>
                                            <!-- Loop dengan PHP -->
                                             <?php for ($tahun = 2015; $tahun <= 2024; $tahun++) { ?>
                                            <option value="<?php echo $tahun; ?>"><?php echo $tahun; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Nama Mahasiswa <span class="text-danger">*</span></label>
                                        <select id="nama" name="nama" class="form-control select2">
                                            <option>Cari...</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="text" id="email" name="email" class="form-control" placeholder="Masukkan Email" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">No. Telepon <span class="text-danger">*</span></label>
                                        <input type="text" id="no_telepon" name="no_telepon" class="form-control" placeholder="Masukkan No. Telepon" required>
                                    </div>

                                    <div class="mt-4 d-grid">
                                        <button id="btn-daftar" class="btn btn-primary waves-effect waves-light" type="submit">Daftar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <p>© SI Trace Study <script>
                                document.write(new Date().getFullYear())
                            </script>, Crafted with <i class="mdi mdi-heart text-danger"></i> by Ma Chung</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS Dependencies -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/select2/js/select2.min.js"></script>
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
    <script src="assets/js/app.js"></script>

    <script>
        $(document).ready(function() {
            $(".select2").select2();
        });
        function updateNamaMahasiswa() {
            var tahun = document.getElementById("tahun_lulus").value;
            var namaSelect = document.getElementById("nama");

            // Hapus semua opsi sebelum menambahkan data baru
            namaSelect.innerHTML = '<option value="">Loading...</option>';

<<<<<<< HEAD:views/auth-register.html
<<<<<<< HEAD
        // $("#btn-daftar").click(function () {
        //     let success = Math.random() > 0.5;
        //     if (success) {
        //         Swal.fire({
        //             title: 'Processing...',
        //             text: 'Please wait a moment',
        //             allowOutsideClick: false,
        //             didOpen: () => Swal.showLoading()
        //         });
        //         setTimeout(() => window.location.href = "auth-two-step-verification.html", 2000);
        //     } else {
        //         Swal.fire({ title: 'Cancelled', text: 'Your imaginary file is safe :)', icon: 'error' });
        //     }
        // });
=======
            namaMahasiswaSelect.html('<option value="">Loading...</option>');

            fetch("ts_get_nama_mahasiswa.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `tahun=${selectedTahun}`
            })
            .then(response => response.json())
            .then(data => {
                namaMahasiswaSelect.html('<option value="">Pilih Nama</option>');
                if (data.status === 200 && Array.isArray(data.data)) {
                    data.data.forEach(nama => {
                        namaMahasiswaSelect.append(new Option(nama, nama));
                    });
=======
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../backend/ts_get_nama_mahasiswa.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    namaSelect.innerHTML = xhr.responseText; // Isi langsung dengan opsi HTML
>>>>>>> ff02338 (tambahan backend):views/auth-register.php
                } else {
                    namaSelect.innerHTML = '<option value="">Tidak Ada data</option>';
                }
            };
            xhr.send("tahun_lulus=" + tahun);
        }

        document.getElementById("registerForm").addEventListener("submit", function(event) {
            Swal.fire({
                title: 'Proses...',
                text: 'Mohon menunggu sebentar',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });
        });
<<<<<<< HEAD:views/auth-register.html

>>>>>>> 6449889 (ubah html dan css)
=======
        <?php if (isset($_SESSION['error'])) { ?>
            Swal.fire({
                title: 'Gagal!',
                text: '<?php echo $_SESSION['error']; ?>',
                icon: 'error'
            });
        <?php unset($_SESSION['error']);
        } ?>
>>>>>>> ff02338 (tambahan backend):views/auth-register.php
    </script>
</body>

</html>