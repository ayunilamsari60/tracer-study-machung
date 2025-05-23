<?php
session_start();
if (!isset($_SESSION['id_register'])) {
    $_SESSION['error'] = "Session expired. Silakan register ulang.";
    header("Location: " . base_url(""));
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Form Mahasiswa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <link rel="shortcut icon" href="<?= base_url("assets/images/favicon.ico") ?>">

    <link href="<?= base_url("assets/css/bootstrap.min.css") ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url("assets/css/icons.min.css") ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url("assets/css/app.min.css") ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url("assets/libs/select2/css/select2.min.css") ?>" rel="stylesheet" type="text/css" />
    <style>
        .alert {
            margin-bottom: 0;
        }

        /* Border merah untuk Select2 ketika invalid */
        .select2-container--default.is-invalid .select2-selection {
            border: 1px solid #dc3545;
            /* warna merah ala Bootstrap */
            border-radius: 0.375rem;
            /* agar sama dengan .form-control */
        }

        /* Feedback di bawah Select2 */
        .select2-container--default.is-invalid~.invalid-feedback {
            display: block;
        }

        /* Efek glow merah saat invalid */
        .select2-container--default.is-invalid .select2-selection--single:focus {
            border-color: #dc3545 !important;
            /* merah seperti Bootstrap error */
            box-shadow: 0 0 0 0.15rem rgba(220, 53, 69, 0.25) !important;
            /* glow merah */
        }

        /* Efek glow merah saat invalid */
        .select2-container.is-invalid .select2-selection--single {
            border-color: #dc3545 !important;
            /* merah seperti Bootstrap error */
            box-shadow: none !important;
            /* glow merah */
        }

        body,
        html,
        .container {
            overflow-x: hidden !important;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Form Mahasiswa - Pekerjaan</h4>
                <form id="job-form-wizard" action="form/submit" method="POST">
                    <div id="form-alert" class="alert alert-danger alert-dismissible fade show d-none" role="alert">
                        <b><span id="form-alert-text">Pesan error di sini...</span></b>
                    </div>
                    <?php
                    // Melanjutkan kode lain di form.php
                    include 'form/step1.php';
                    include 'form/step2.php';
                    include 'form/step3.php';
                    ?>
                </form>
            </div>
        </div>
    </div>

    <script src="<?= base_url("assets/libs/jquery/jquery.min.js") ?>"></script>
    <script src="<?= base_url("assets/libs/bootstrap/js/bootstrap.bundle.min.js") ?>"></script>
    <script src="<?= base_url("assets/libs/select2/js/select2.min.js") ?>"></script>
    <script src="<?= base_url("assets/libs/jquery-steps/build/jquery.steps.min.js") ?>"></script>
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
                            $("#tidak-bekerja-content").show().find("input, select, textarea, button").prop("disabled", false);
                        } else if (statusKerja === "3") {
                            $("#wiraswasta-content").show().find("input, select, textarea, button").prop("disabled", false);
                        } else if (statusKerja === "4") {
                            $("#pendidikan-content").show().find("input, select, textarea, button").prop("disabled", false);
                        } else if (statusKerja === "5") {
                            $("#mencari-kerja-content").show().find("input, select, textarea, button").prop("disabled", false);
                        }

                        // Simpan status kerja ke global variable (supaya bisa diakses nanti)
                        window.statusKerja = statusKerja;

                    }

                    // Validasi Step 2 sebelum lanjut ke Step 3 (HANYA saat Next)
                    if (currentIndex === 1 && newIndex > currentIndex) {
                        let isValid = true;

                        // Validasi input
                        // Dapatkan container yang sedang aktif
                        const activeContainer = $(".step-2-content:visible");
                        let radioNames = [];

                        activeContainer.find("input:visible:not(:disabled)").each(function () {
                            const $input = $(this);
                            const type = $input.attr("type");

                            if (type === "radio") {
                                const name = $input.attr("name");

                                // Validasi hanya 1x per grup name radio
                                if (!radioNames.includes(name)) {
                                    radioNames.push(name);

                                    const radios = activeContainer.find(`input[type='radio'][name='${name}']:visible:not(:disabled)`);
                                    const isChecked = radios.is(":checked");

                                    if (!isChecked) {
                                        radios.addClass("is-invalid");
                                        isValid = false;
                                    } else {
                                        radios.removeClass("is-invalid");
                                    }
                                }
                            } else {
                                if (!$input.is("[readonly]") && $input.val().trim() === "") {
                                    $input.addClass("is-invalid");
                                    isValid = false;
                                } else {
                                    $input.removeClass("is-invalid");
                                }
                            }
                        });


                        // ✅ 2. Validasi checkbox group (minimal 1 per group)
                        let groupNames = [];
                        $(".step-2-content input[type='checkbox']:visible").each(function () {
                            const group = $(this).data("group");
                            if (group && !groupNames.includes(group)) {
                                groupNames.push(group);
                            }
                        });

                        groupNames.forEach(group => {
                            const checkboxes = $(`input[type='checkbox'][data-group='${group}']:visible`);
                            const isChecked = checkboxes.is(":checked");

                            if (!isChecked) {
                                isValid = false;
                                checkboxes.addClass("is-invalid");
                            } else {
                                checkboxes.removeClass("is-invalid");
                            }
                        });
                        // Hilangkan class is-invalid jika sudah ada minimal satu tercentang di grup
                        $(".step-2-content input[type='checkbox']").on("change", function () {
                            const group = $(this).data("group");

                            if (group) {
                                const groupCheckboxes = $(`input[type='checkbox'][data-group='${group}']`);
                                const isChecked = groupCheckboxes.is(":checked");

                                if (isChecked) {
                                    groupCheckboxes.removeClass("is-invalid");
                                }
                            }
                        });


                        // Validasi select
                        $(".step-2-content select:not(:disabled)").each(function () {
                            if ($(this).val() === "" || $(this).val() === null) {
                                $(this).addClass("is-invalid");
                                $(this).next(".select2-container").addClass("is-invalid");
                                isValid = false;
                            } else {
                                $(this).removeClass("is-invalid");
                                $(this).next(".select2-container").removeClass("is-invalid");
                            }
                        });

                        if (!isValid) {
                            tampilkanAlert("Mohon isi semua data di Step 2 sebelum melanjutkan!");
                            return false;
                        } else {
                            $("#form-alert").addClass("d-none");
                        }

                        $(".step-3-content").show();
                    }

                    return true;
                },

                onFinished: function (event, currentIndex) {
                    let isValid = true;

                    // Reset error
                    $(".is-invalid").removeClass("is-invalid");

                    // Cek apakah bagian tidak-bekerja aktif
                    const isTidakBekerjaActive = $("#tidak-bekerja-content").is(":visible");

                    if (isTidakBekerjaActive) {
                        // Validasi UMC5 (input alasan belum bekerja)
                        const alasan = $("input[name='UMC5']").val().trim();
                        if (alasan === "") {
                            $("input[name='UMC5']").addClass("is-invalid");
                            tampilkanAlert("Mohon isi alasan mengapa Anda belum memungkinkan untuk bekerja!");
                            return false;
                        }

                        // Skip validasi step 3 karena tidak diperlukan
                        $("#form-alert").addClass("d-none");
                        $("#job-form-wizard").submit();
                        return;
                    }

                    // Kalau bukan 'tidak bekerja', validasi step 3 seperti biasa
                    $(".step-3-content").find("input[type=radio]").each(function () {
                        let name = $(this).attr("name");
                        if ($(".step-3-content input[name='" + name + "']:checked").length === 0) {
                            $(".step-3-content input[name='" + name + "']").addClass("is-invalid");
                            isValid = false;
                        } else {
                            $(".step-3-content input[name='" + name + "']").removeClass("is-invalid");
                        }
                    });

                    if (!isValid) {
                        tampilkanAlert("Mohon isi semua pertanyaan di step 3 sebelum menyelesaikan!");
                        return false;
                    }

                    // Jika semua valid
                    $("#form-alert").addClass("d-none");
                    $("#job-form-wizard").submit();
                }

            });
        });
    </script>


    <script>
        // jquery untuk menampilkan inputan lainnya
        $(document).ready(function () {
            $("#penghasilan").on("input", function () {
                let value = $(this).val().replace(/\D/g, ""); // Hapus semua karakter non-digit
                if (!value) {
                    $(this).val("");
                    return;
                }
                $(this).val(value.replace(/\B(?=(\d{3})+(?!\d))/g, ".")); // Tambah titik setiap 3 digit dari belakang
            });

            // Hapus titik saat submit form
            $("#job-form-wizard").on("submit", function () {
                let raw = $("#penghasilan").val().replace(/\./g, ""); // Hilangkan semua titik
                $("#penghasilan").val(raw); // Set kembali nilai mentah tanpa titik
            });

            $(".select2").select2();
            // Hilangkan is-invalid ketika user mulai mengisi atau memilih
            $(".step-2-content input, .step-2-content textarea").on("input", function () {
                if ($(this).val().trim() !== "") {
                    $(this).removeClass("is-invalid");
                }
            });
            $("input[type=radio]").on("change", function () {
                let name = $(this).attr("name");
                $("input[name='" + name + "']").removeClass("is-invalid").closest("label").removeClass("text-danger");
            });


            $(".step-2-content select:not(:disabled)").on("change", function () {
                if ($(this).val() !== "" && $(this).val() !== null) {
                    $(this).removeClass("is-invalid");
                    $(this).next(".select2-container").removeClass("is-invalid");
                }
            });

            $(".step-2-content input[type='checkbox'], .step-2-content input[type='radio']").on("change", function () {
                const name = $(this).attr("name");
                if ($(`input[name='${name}']:checked`).length > 0) {
                    $(`input[name='${name}']`).removeClass("is-invalid");
                }
            });

            $(".select2").on("select2:select select2:unselect", function () {
                if ($(this).val() !== "" && $(this).val() !== null) {
                    $(this).removeClass("is-invalid");
                    $(this).next(".select2-container").removeClass("is-invalid");
                }
            });


            $('#provinsi').on('change', function () {
                var kodeProvinsi = $(this).val();
                var $kota = $('#kota');

                $kota.html('<option>Loading...</option>');

                $.post('backend/ts_data_kode_kabupaten_kota.php', {
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
            $('.step-2-content input[name="f302"], .step-2-content input[name="f303"]').prop('readonly', true);
            $('.step-2-content input[name="f301"]').on('change', function () {
                const selectedValue = $(this).val();
                const container = $(this).closest(".step-2-content");

                // Semua input number di container ini diset readonly dan dikosongkan
                container.find('input[name="f302"], input[name="f303"]').prop('readonly', true).val('');

                // Aktifkan input sesuai nilai radio
                if (selectedValue === "1") {
                    container.find('input[name="f302"]').prop('readonly', false);
                } else if (selectedValue === "2") {
                    container.find('input[name="f303"]').prop('readonly', false);
                }
            });

        });
    </script>
</body>

</html>