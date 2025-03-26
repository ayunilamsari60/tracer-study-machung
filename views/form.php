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
                <h4 class="card-title mb-4">Form Mahasiswa - Pekerjaan</h4>
                <form id="job-form-wizard" action="submit1.php" method="POST">
                    
                    <?php include 'form/step1.php'; ?>

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
                        let statusKerja = $("input[name='F8']:checked").val();
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
                        // $(".step-2-content input:visible").each(function() {
                        //     if ($(this).is(":visible") && $(this).val().trim() === "") {
                        //         isValid = false;
                        //         $(this).addClass("is-invalid"); // Tambahkan class error
                        //     } else {
                        //         $(this).removeClass("is-invalid"); // Hilangkan class error jika sudah diisi
                        //     }
                        // });

                        // if (!isValid) {
                        //     alert("Mohon isi semua data di Step 2 sebelum melanjutkan!");
                        //     return false;
                        // }

                        $(".step-3-content").show(); // Tampilkan Step 3 jika valid
                    }

                    return true;
                },
                onFinished: function(event, currentIndex) {
                    $("#job-form-wizard").submit();
                },
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $("input[name='F1201']").on("change", function() {
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