<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Form Mahasiswa</title>
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <style>
        .alert {
            margin-bottom: 0;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Form Mahasiswa - Pekerjaan</h4>
                <form id="job-form-wizard" action="submit1.php" method="POST">
                    <div id="form-alert" class="alert alert-danger alert-dismissible fade show d-none" role="alert">
                        <b><span id="form-alert-text">Pesan error di sini...</span></b>
                    </div>


                    <?php include 'form/step1.php'; ?>

                    <?php include 'form/step2.php'; ?>

                    <?php include 'form/step3.php'; ?>

                </form>
            </div>
        </div>
    </div>

    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/select2/js/select2.min.js"></script>
    <script src="assets/libs/jquery-steps/build/jquery.steps.min.js"></script>
    <script>
        $(document).ready(function () {
            function tampilkanAlert(teks) {
                $("#form-alert-text").text(teks);
                $("#form-alert").removeClass("d-none"); // tampilkan alert
            }


            $("#job-form-wizard").steps({
                headerTag: "h3",
                bodyTag: "section",
                transitionEffect: "slide",
                autoFocus: true,
                labels: {
                    cancel: "Batal",
                    current: "Langkah saat ini:",
                    pagination: "Pagination",
                    finish: "Selesai",
                    next: "Lanjut",
                    previous: "Kembali",
                    loading: "Memuat..."

                },

                onStepChanging: function (event, currentIndex, newIndex) {
                    // **Validasi Step 1 sebelum lanjut ke Step 2**
                    if (currentIndex === 0 && newIndex > currentIndex) {
                        let statusKerja = $("input[name='F8']:checked").val();
                        if (!statusKerja) {
                            tampilkanAlert("Silahkan pilih status kerja sebelum melanjutkan!");
                            return false;
                        } else {
                            $("#form-alert").addClass("d-none"); // sembunyikan alert jika valid
                        }


                        $(".step-2-content").hide().find("input, select, textarea, button").prop("disabled", true);

                        if (statusKerja === "1") {
                            $("#bekerja-content").show().find("input, select, textarea, button").prop("disabled", false);
                        } else if (statusKerja === "2") {
                            $("#wiraswasta-content").show().find("input, select, textarea, button").prop("disabled", false);
                        } else if (statusKerja === "3") {
                            $("#pendidikan-content").show().find("input, select, textarea, button").prop("disabled", false);
                        } else if (statusKerja === "4") {
                            $("#mencari-kerja-content").show().find("input, select, textarea, button").prop("disabled", false);
                        } else if (statusKerja === "5") {
                            $("#tidak-bekerja-content").show().find("input, select, textarea, button").prop("disabled", false);
                        }

                        // Simpan status kerja ke global variable (supaya bisa diakses nanti)
                        window.statusKerja = statusKerja;

                    }

                    // Di Step 2, kalau status "tidak bekerja", klik next langsung trigger finish
                    if (currentIndex === 1 && window.statusKerja === "5" && newIndex > currentIndex) {
                        $("#job-form-wizard").steps("finish");
                        return false; // cegah ke step 3
                    }

                    // **Validasi Step 2 sebelum lanjut ke Step 3 (HANYA saat Next)**
                    if (currentIndex === 1 && newIndex > currentIndex) {
                        let isValid = true;

                        // Cek semua input yang terlihat di Step 2
                        $(".step-2-content input:visible").each(function () {
                            if ($(this).is(":visible:not(:disabled)") && $(this).val().trim() === "") {
                                isValid = false;
                                $(this).addClass("is-invalid"); // Tambahkan class error
                            } else {
                                $(this).removeClass("is-invalid"); // Hilangkan class error jika sudah diisi
                            }
                        });

                        if (!isValid) {
                            tampilkanAlert("Mohon isi semua data di Step 2 sebelum melanjutkan!");
                            return false;
                        } else {
                            $("#form-alert").addClass("d-none"); // sembunyikan alert jika valid
                        }

                        $(".step-3-content").show(); // Tampilkan Step 3 jika valid
                    }

                    return true;
                },
                onStepChanged: function (event, currentIndex, priorIndex) {
                    let statusKerja = $("input[name='F8']:checked").val();

                    // Hanya ubah tombol jika di step 1 menuju step 2 dan status tidak bekerja
                    if (currentIndex === 1 && statusKerja === "5") {
                        $(".actions ul li a[href='#next']").text("Selesai");
                    } else {
                        $(".actions ul li a[href='#next']").text("Lanjut");
                    }
                },

                onFinished: function (event, currentIndex) {
                    let isValid = true;

                    // Cek semua input di form sebelum submit
                    $("#job-form-wizard input:visible").each(function () {
                        if ($(this).is(":visible") && $(this).val().trim() === "") {
                            isValid = false;
                            $(this).addClass("is-invalid"); // Tambahkan class error
                        } else {
                            $(this).removeClass("is-invalid"); // Hilangkan class error jika sudah diisi
                        }
                    });

                    if (!isValid) {
                        tampilkanAlert("Mohon lengkapi semua data sebelum menyelesaikan!");
                        return false;
                    } else{
                        $("#form-alert").addClass("d-none"); // sembunyikan alert jika valid
                    }

                    $("#job-form-wizard").submit();
                },
            });
        });
    </script>


    <script>
        // jquery untuk menampilkan inputan lainnya
        $(document).ready(function () {
            $(".select2").select2();

            $('#provinsi').on('change', function () {
                var kodeProvinsi = $(this).val();
                var $kota = $('#kota');

                $kota.html('<option>Loading...</option>');

                $.post('../backend/ts_data_kode_kabupaten_kota.php', {
                    kode_provinsi: kodeProvinsi
                }, function (data) {
                    $kota.html(data);
                }).fail(function () {
                    $kota.html('<option>Gagal memuat data</option>');
                });
            });

            $("input[name='f1101']").on("change", function () {
                let selectedValue = $(this).val();

                // Menonaktifkan semua input instansi lainnya
                $(".instansiLainnyaInput input").prop("disabled", true).val("");

                if (selectedValue === "7") {
                    let container = $(this).closest('.mb-4').find(".instansiLainnyaInput");
                    container.show().find("input").prop("disabled", false).prop("required", true);
                } else {
                    $(".instansiLainnyaInput").hide();
                }
            });
            $("input[name='f1101']").on("input", function () {
                let selectedValue = $(this).val();
                console.log("Real-time input: " + selectedValue);
            });


            $(document).ready(function () {
                $("input[name='F1201']").on("change", function () {
                    let selectedValue = $(this).val();
                    let lainnyaInput = $(this).closest('.mb-4').find(".danaLainnyaInput");

                    // Menonaktifkan dan menyembunyikan input "Lainnya"
                    $(".danaLainnyaInput").prop("disabled", true).val("").hide();

                    // Jika "Lainnya" dipilih, tampilkan input dan aktifkan
                    if (selectedValue === "7") {
                        let container = $(this).closest('.mb-4').find(".danaLainnyaInput");
                        container.show().find("input").prop("disabled", false).prop("required", true);
                    } else {
                        $(".instansiLainnyaInput").hide();
                    }
                });
            });


            // Handle input lainnya "cariLainnyaInput"
            $("input[name='f415']").on("change", function () {
                let container = $(".cariLainnyaInput"); // Ambil div dengan class cariLainnyaInput
                if ($(this).is(":checked")) {
                    container.show().find("input").prop("required", true);
                } else {
                    container.hide().find("input").val("").prop("required", false);
                }
            });

            // Handle input lainnya "alasanLainnyaInput"
            $("input[name='f1613']").on("change", function () {
                let container = $(".alasanLainnyaInput"); // Seleksi langsung elemen dengan class alasanLainnyaInput
                if ($(this).is(":checked")) {
                    container.show().find("input").prop("required", true);
                } else {
                    container.hide().find("input").val("").prop("required", false);
                }
            });

            $('input[name="f301"]').on('change', function () {
                const selectedValue = $(this).val();

                // Matikan semua input number dulu
                $('input[name="f302"], input[name="f303"]').prop('readonly', true).val('');

                // Aktifkan input sesuai radio yang dipilih
                if (selectedValue === "1") {
                    $('input[name="f302"]').prop('readonly', false);
                } else if (selectedValue === "2") {
                    $('input[name="f303"]').prop('readonly', false);
                }
            });
        });
    </script>
</body>

</html>