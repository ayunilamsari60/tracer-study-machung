<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Wizard dengan Redirect</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.min.js"></script>
    <style>
        .is-invalid {
            border: 1px solid red;
        }
    </style>
</head>

<body>

    <div id="job-form-wizard">
        <h3>Step 1</h3>
        <section>
            <form id="form-step-1">
                <label>Status Kerja:</label><br>
                <input type="radio" name="F8" value="1"> Bekerja<br>
                <input type="radio" name="F8" value="2"> Wiraswasta<br>
                <input type="radio" name="F8" value="3"> Pendidikan<br>
                <input type="radio" name="F8" value="4"> Mencari Kerja<br>
            </form>
        </section>

        <h3>Step 2</h3>
        <section>
            <form id="form-step-2">
                <label>Nama Perusahaan:</label>
                <input type="text" name="company_name">
            </form>
        </section>

        <h3>Step 3</h3>
        <section>
            <form id="form-step-3">
                <label>Gaji Bulanan:</label>
                <input type="number" name="salary">
            </form>
        </section>
    </div>

    <script>
        $(document).ready(function () {
            $("#job-form-wizard").steps({
                headerTag: "h3",
                bodyTag: "section",
                transitionEffect: "slide",
                autoFocus: true,
                onStepChanging: function (event, currentIndex, newIndex) {
                    if (currentIndex === 0 && newIndex > currentIndex) {
                        let statusKerja = $("input[name='F8']:checked").val();
                        if (!statusKerja) {
                            alert("Silakan pilih status kerja sebelum melanjutkan!");
                            return false;
                        }
                    }

                    if (currentIndex === 1 && newIndex > currentIndex) {
                        let companyName = $("#form-step-2 input[name='company_name']").val().trim();
                        if (companyName === "") {
                            alert("Mohon isi nama perusahaan sebelum melanjutkan!");
                            return false;
                        }
                    }

                    return true;
                },
                onFinished: function (event, currentIndex) {
                    let formData = {
                        F8: $("input[name='F8']:checked").val(),
                        company_name: $("#form-step-2 input[name='company_name']").val(),
                        salary: $("#form-step-3 input[name='salary']").val(),
                    };

                    // Kirim data dengan AJAX
                    $.ajax({
                        url: "submit.php",
                        method: "POST",
                        data: formData, // Kirim semua data di form
                        success: function (response) {
                            alert("Data berhasil dikirim!");
                            window.location.href = "submit.php"; // Pindah ke halaman submit.php
                        },
                        error: function () {
                            alert("Terjadi kesalahan saat mengirim data.");
                        }
                    });

                }
            });
        });
    </script>

</body>

</html>