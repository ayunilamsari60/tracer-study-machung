<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Form Validasi Bootstrap</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

  <form id="myForm" novalidate>
    <!-- Input Teks -->
    <div class="mb-3">
      <label for="nama" class="form-label">Nama Lengkap</label>
      <input type="text" class="form-control" id="nama" required>
      <div class="invalid-feedback">
        Nama wajib diisi.
      </div>
    </div>

    <!-- Radio -->
    <div class="mb-3">
      <label class="form-label">Jenis Kelamin</label><br>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="gender" id="laki" value="L" required>
        <label class="form-check-label" for="laki">Laki-laki</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="gender" id="perempuan" value="P" required>
        <label class="form-check-label" for="perempuan">Perempuan</label>
      </div>
      <div class="invalid-feedback d-block">
        Silakan pilih jenis kelamin.
      </div>
    </div>

    <!-- Checkbox -->
    <div class="mb-3">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="setuju" required>
        <label class="form-check-label" for="setuju">
          Saya menyetujui syarat dan ketentuan
        </label>
        <div class="invalid-feedback">
          Anda harus menyetujui sebelum melanjutkan.
        </div>
      </div>
    </div>

    <button type="submit" class="btn btn-primary">Kirim</button>
  </form>

  <script>
document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('myForm');

  // Hapus error saat user mulai mengetik di input text
  document.getElementById('nama').addEventListener('input', function () {
    if (this.value.trim() !== "") {
      this.classList.remove('is-invalid');
      this.classList.add('is-valid');
    } else {
      this.classList.remove('is-valid');
      this.classList.add('is-invalid');
    }
  });

  // Hapus error saat user pilih radio
  document.querySelectorAll('input[name="gender"]').forEach(radio => {
    radio.addEventListener('change', function () {
      document.querySelectorAll('input[name="gender"]').forEach(r => {
        r.classList.remove('is-invalid');
        r.classList.add('is-valid');
      });
    });
  });

  // Hapus error saat user centang checkbox
  document.getElementById('setuju').addEventListener('change', function () {
    if (this.checked) {
      this.classList.remove('is-invalid');
      this.classList.add('is-valid');
    } else {
      this.classList.remove('is-valid');
      this.classList.add('is-invalid');
    }
  });

  // Validasi saat submit
  form.addEventListener('submit', function (event) {
    event.preventDefault();
    event.stopPropagation();

    let isValid = true;

    // Validasi nama
    const namaInput = document.getElementById('nama');
    if (namaInput.value.trim() === "") {
      namaInput.classList.add('is-invalid');
      isValid = false;
    }

    // Validasi radio
    const radios = document.querySelectorAll('input[name="gender"]');
    const radioChecked = Array.from(radios).some(r => r.checked);
    if (!radioChecked) {
      radios.forEach(r => r.classList.add('is-invalid'));
      isValid = false;
    }

    // Validasi checkbox
    const checkbox = document.getElementById('setuju');
    if (!checkbox.checked) {
      checkbox.classList.add('is-invalid');
      isValid = false;
    }

    if (isValid) {
      alert("Form valid dan siap dikirim!");
      // form.submit(); // kirim form ke server kalau mau
    }
  });
});
</script>


</body>
</html>
