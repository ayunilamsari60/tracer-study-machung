<!-- dashboard.php -->
<?php
include 'config/koneksi.php';
$title = "Data Responden"; // Judul halaman
$custom_css = '
        <!-- DataTables -->
        <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- App favicon -->
    `   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
';
$custom_js = '
        <!-- Datatable JS -->
        <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="assets/libs/jszip/jszip.min.js"></script>
        <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
        <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
        <script src="assets/js/pages/datatables.init.js"></script>
        <script src="assets/js/app.js"></script>

        <script>
    $(document).ready(function () {
        var table = $("#datatables").DataTable({
        "pageLength": 10,
        "processing": true,
        "deferRender": true,

        "language": {
            "zeroRecords": "Tidak ada data yang tersedia",
        },
        "dom": "lrtip" // Menghilangkan search bawaan tapi tetap bisa pakai filter manual
        });

        // Event listener untuk tombol filter
        $("#applyFilter").on("click", function () {
          var fakultas = $("#fakultas").val();
          var prodi = $("#prodi").val();
          var tahun_lulus = $("#tahun_lulus").val();
        //   var tahun_lulus = parseFloat($("#filterHarga").val()) || 0;

          // Terapkan filter ke kolom masing-masing (perhatikan indeks!)
        table.column(1).search(tahun_lulus || "", true, false).draw();
        table.column(2).search(fakultas || "", true, false).draw();
        table.column(3).search(prodi || "", true, false).draw();
        });

        // Event listener untuk tombol reset filter
        $("#resetFilter").on("click", function () {
          $("#tahun_lulus").val("");
          $("#fakultas").val("");
          $("#prodi").val("");

          // Hapus semua filter
          table.search("").columns().search("").draw();
        });
      });
</script>
';
// Ambil data dari tabel mahasiswa
$query = "SELECT * FROM ts_data_mahasiswa";
$result = $conn->query($query);
// Ambil data fakultas unik
$fakultasQuery = "SELECT DISTINCT fakultas FROM ts_data_mahasiswa";
$fakultasResult = $conn->query($fakultasQuery);

// Ambil data program studi unik
$prodiQuery = "SELECT DISTINCT nama_prodi FROM ts_data_mahasiswa";
$prodiResult = $conn->query($prodiQuery);

ob_start(); // Mulai output buffering
?>

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Data Responden </h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Skote</a></li>
                    <li class="breadcrumb-item active">Data Responden</li>
                </ol>
            </div>

        </div>

        <div class="card p-4">
            <h5>Filter</h5>
            <div class="row g-3">
                <!-- Fakultas -->
                <div class="col-md-4">
                    <label for="fakultas" class="form-label">Fakultas</label>
                    <select id="fakultas" name="fakultas" class="form-select">
                        <option value="">Pilih Fakultas</option>
                        <?php while ($row = $fakultasResult->fetch_assoc()): ?>
                            <option value="<?= $row['fakultas'] ?>"><?= $row['fakultas'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <!-- Program Studi -->
                <div class="col-md-4">
                    <label for="prodi" class="form-label">Program Studi</label>
                    <select id="prodi" name="prodi" class="form-select">
                        <option value="">Pilih Program Studi</option>
                        <?php while ($row = $prodiResult->fetch_assoc()): ?>
                            <option value="<?= $row['nama_prodi'] ?>"><?= $row['nama_prodi'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <!-- Tahun Lulus -->
                <div class="col-md-4">
                    <label class="form-label">Tahun Lulus <span class="text-danger">*</span></label>
                    <select id="tahun_lulus" name="tahun_lulus" class="form-select" required
                        onchange="updateNamaMahasiswa()">
                        <option value="" selected disabled>Pilih...</option>
                        <?php
                        for ($tahun = 2000; $tahun <= 2023; $tahun++) {
                            echo "<option value='$tahun'>$tahun</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Tombol Filter -->
                <div class="col-12">
                    <button class="btn btn-primary mt-2" id="applyFilter" type="submit">
                        <i class="bi bi-funnel"></i> Terapkan Filter
                    </button>
                    <button id="resetFilter" class="btn btn-secondary mt-2">Reset</button>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <!-- Wrapping div for horizontal scroll -->
                <div class="table-responsive">
                    <table id="datatables" class="table table-bordered table-striped nowrap w-100">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>TAHUN LULUS</th>
                                <th>FAKULTAS</th>
                                <th>NAMA PRODI</th>
                                <th>NIM</th>
                                <th>NAMA MAHASISWA</th>
                                <th>NO. TELEPON</th>
                                <th>EMAIL</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            while ($row = $result->fetch_assoc()) { ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $row['tahun_lulus']; ?></td>
                                    <td><?= $row['fakultas']; ?></td>
                                    <td><?= $row['nama_prodi']; ?></td>
                                    <td><?= $row['nim']; ?></td>
                                    <td><?= $row['nama_mahasiswa']; ?></td>
                                    <td><?= $row['no_telepon']; ?></td>
                                    <td><?= $row['email']; ?></td>
                                    <td><button class="btn btn-outline-primary btn-sm">Lihat</button></td>
                                </tr>
                            <?php } ?>
                        </tbody>


                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
$content = ob_get_clean(); // Simpan konten yang sudah dibuat
include 'templates/master.php'; // Gunakan template utama
?>