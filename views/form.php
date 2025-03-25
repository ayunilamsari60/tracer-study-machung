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
</head>

<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Form Wizard - Pekerjaan</h4>
                <form id="job-form-wizard" action="submit.php" method="POST">
                    <h3>Step 1: Status Anda</h3>
                    <section>
                        <label class="mb-3 form-label">Jelaskan status anda saat ini?</label>
                        <div class="form-check mb-3">
                            <input class="form-check-input" id="bekerja" type="radio" name="status" value="1" />
                            <label class="form-check-label" for="bekerja">Bekerja (1)</label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" id="wiraswasta" type="radio" name="status" value="2" />
                            <label class="form-check-label" for="wiraswasta">Wiraswasta (2)</label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" id="pendidikan" type="radio" name="status" value="3" />
                            <label class="form-check-label" for="pendidikan">Melanjutkan Pendidikan (3)</label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" id="mencari-kerja" type="radio" name="status" value="4" />
                            <label class="form-check-label" for="mencari-kerja">Tidak kerja, sedang mencari kerja (4)</label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" id="belum-bekerja" type="radio" name="status" value="5" />
                            <label class="form-check-label" for="belum-bekerja">Belum memungkinkan bekerja (5)</label>
                        </div>
                    </section>

                    <?php include 'form/step2.php'; ?>

                    <?php include 'form/step3.php'; ?>

                </form>
            </div>
        </div>
    </div>

    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/jquery-steps/build/jquery.steps.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#job-form-wizard").steps({
                headerTag: "h3",
                bodyTag: "section",
                transitionEffect: "slide",
                autoFocus: true,
                onStepChanging: function(event, currentIndex, newIndex) {
                    // **Validasi Step 1 sebelum lanjut ke Step 2**
                    if (currentIndex === 0 && newIndex > currentIndex) {
                        let statusKerja = $("input[name='status']:checked").val();
                        if (!statusKerja) {
                            alert("Silakan pilih status kerja sebelum melanjutkan!");
                            return false;
                        }

                        $(".step-2-content").hide();
                        if (statusKerja === "1") {
                            $("#bekerja-content").show();
                        } else if (statusKerja === "2") {
                            $("#wiraswasta-content").show();
                        } else if (statusKerja === "3") {
                            $("#pendidikan-content").show();
                        } else if (statusKerja === "4") {
                            $("#mencari-kerja-content").show();
                        } else {
                            $("#tidak-bekerja-content").show();
                        }
                    }

                    // **Validasi Step 2 sebelum lanjut ke Step 3 (HANYA saat Next)**
                    if (currentIndex === 1 && newIndex > currentIndex) {
                        let isValid = true;

                        // Cek semua input yang terlihat di Step 2
                        $(".step-2-content input:visible").each(function() {
                            if ($(this).is(":visible") && $(this).val().trim() === "") {
                                isValid = false;
                                $(this).addClass("is-invalid"); // Tambahkan class error
                            } else {
                                $(this).removeClass("is-invalid"); // Hilangkan class error jika sudah diisi
                            }
                        });

                        if (!isValid) {
                            alert("Mohon isi semua data di Step 2 sebelum melanjutkan!");
                            return false;
                        }

                        $(".step-3-content").show(); // Tampilkan Step 3 jika valid
                    }

                    return true;
                },
                onFinished: function(event, currentIndex) {
                    $("#job-form-wizard").submit();
                },
            });

            // // **Hapus tanda error saat user mengetik**
            // $(document).on("input", ".step-2-content input", function() {
            //     if ($(this).val().trim() !== "") {
            //         $(this).removeClass("is-invalid");
            //     }
            // });

            // // **Tampilkan input "Sumber Dana Lainnya" hanya jika opsi ke-7 dipilih**
            // $("input[name='sumber_dana']").change(function() {
            //     if ($("#sumber_dana7").is(":checked")) {
            //         $("#sumber_dana_lainnya").show().focus();
            //     } else {
            //         $("#sumber_dana_lainnya").hide().val(""); // Sembunyikan dan reset nilai
            //     }
            // });
        });
    </script>


    <script>
        $(document).ready(function() {
            $("input[name='sumber_dana']").on("change", function() {
                // console.log("Sumber dana berubah:", $(this).val()); // Debugging

                if ($(this).val() === "7") {
                    $("#sumber_dana_lainnya").show().prop("required", true);
                } else {
                    $("#sumber_dana_lainnya").hide().val("").prop("required", false);
                }
            });
        });
    </script>
</body>

</html>