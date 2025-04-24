<!-- dashboard.php -->
<?php
include "backend/ts_filter_data_responden.php"; // Memanggil file untuk mengambil data responden
include_once "templates/section.php"; // Memanggil file section.php untuk mendukung fungsi section dan endsection
$title = "Data Responden"; // Judul halaman
// Ambil data dari tabel mahasiswa
// $query = "SELECT * FROM ts_data_mahasiswa";
// $result = $conn->query($query);

?>
<?php push('styles') ?>
<!-- DataTables -->
<link href="<?= base_url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css'); ?>" rel="stylesheet"
    type="text/css" />
<link href="<?= base_url('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css'); ?>" rel="stylesheet"
    type="text/css" />
<link href="<?= base_url('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css'); ?>"
    rel="stylesheet" type="text/css" />

<!-- App favicon -->
`
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
<?php endpush('styles') ?>
<?php
section('content'); // Memulai section untuk konten dinamis
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
            <form action="<?= base_url('export') ?>" method="post" id="exportform">
                <div class="row g-3">

                    <!-- Program Studi -->
                    <div class="col-md-4">
                        <label for="prodi" class="form-label">Program Studi</label>
                        <select id="prodi" name="prodi" class="form-select">
                            <option value="">Pilih Program Studi</option>
                            <?php while ($row = $prodiResult->fetch_assoc()): ?>
                                <option value="<?= $row['kode_prodi'] ?>"><?= $row['kode_prodi'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <!-- Tahun Lulus -->
                    <div class="col-md-4">
                        <label class="form-label">Tahun Lulus <span class="text-danger">*</span></label>
                        <select id="tahun_lulus" name="tahun_lulus" class="form-select"
                            onchange="updateNamaMahasiswa()">
                            <option value="" selected disabled>Pilih...</option>
                            <?php
                            for ($tahun = 2000; $tahun <= date("Y"); $tahun++) {
                                echo "<option value='$tahun'>$tahun</option>";
                            }
                            ?>
                        </select>
                    </div>
            </form>

            <!-- Tombol Filter -->
            <div class="col-12">
                <button class="btn btn-primary mt-2" id="applyFilter" type="button">
                    <i class="bi bi-funnel"></i> Terapkan Filter
                </button>
                <button id="resetFilter" class="btn btn-secondary mt-2" type="button">Reset</button>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-end mb-3 gap-3">
                <button type="submit" class="btn btn-success" form="exportform" name="export_form"
                    value="kemendiksaintek">
                    <i class="mdi mdi-file-excel"></i> Export to Excel Kemendiksaintek
                </button>
                <button type="submit" class="btn btn-outline-success" form="exportform" name="export_form" value="umc">
                    <i class="mdi mdi-file-excel"></i> Export to Excel UMC
                </button>
            </div>
            <!-- Wrapping div for horizontal scroll -->
            <div class="table-responsive">
                <table id="datatables" class="table table-bordered table-striped nowrap w-100">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>TAHUN LULUS</th>
                            <th>KODE PRODI</th>
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
                                <td><?= $row['thn_ajaran']; ?></td>
                                <td><?= $row['kode_prodi']; ?></td>
                                <td><?= $row['nama_prodi']; ?></td>
                                <td><?= $row['nim_mahasiswa']; ?></td>
                                <td><?= $row['nama']; ?></td>
                                <td><?= $row['no_telepon']; ?></td>
                                <td><?= $row['email']; ?></td>
                                <td>
                                    <a href="data-responden/<?php echo $row['submit_id']; ?>"
                                        class="btn btn-outline-primary btn-sm">
                                        Lihat
                                    </a>
                                </td>
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
endsection(); // Mengakhiri section untuk konten dinamis
?>
<?php push('scripts') ?>
<!-- Datatable JS -->
<script src="<?= base_url('assets/libs/datatables.net/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
<script src="<?= base_url('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js'); ?>"></script>
<script src="<?= base_url('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js'); ?>"></script>
<script src="<?= base_url('assets/libs/jszip/jszip.min.js'); ?>"></script>
<script src="<?= base_url('assets/libs/pdfmake/build/pdfmake.min.js'); ?>"></script>
<script src="<?= base_url('assets/libs/pdfmake/build/vfs_fonts.js'); ?>"></script>
<script src="<?= base_url('assets/libs/datatables.net-buttons/js/buttons.html5.min.js'); ?>"></script>
<script src="<?= base_url('assets/libs/datatables.net-buttons/js/buttons.print.min.js'); ?>"></script>
<script src="<?= base_url('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js'); ?>"></script>
<script src="<?= base_url('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js'); ?>"></script>
<script src="<?= base_url('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/pages/datatables.init.js'); ?>"></script>

<script>
    $(document).ready(function () {
        var table = $("#datatables").DataTable({
            "pageLength": 10,
            "processing": true,
            "deferRender": true,

            "language": {
                "zeroRecords": "Tidak ada data yang tersedia",
                "infoEmpty": "Data kosong", // Pesan jika tabel kosong
                "search": "Cari:" // Label search input
            },
            // "dom": "lrtip" // Menghilangkan search bawaan tapi tetap bisa pakai filter manual
        });

        // Event listener untuk tombol filter
        $("#applyFilter").on("click", function () {
            var fakultas = $("#fakultas").val();
            var prodi = $("#prodi").val();
            var tahun_lulus = $("#tahun_lulus").val();
            //   var tahun_lulus = parseFloat($("#filterHarga").val()) || 0;

            // Terapkan filter ke kolom masing-masing (perhatikan indeks!)
            table.column(1).search(tahun_lulus || "", true, false).draw();
            table.column(2).search(prodi || "", true, false).draw();
            // table.column(3).search(prodi || "", true, false).draw();
        });

        // Event listener untuk tombol reset filter
        $("#resetFilter").on("click", function () {
            $("#tahun_lulus").val("");
            //   $("#fakultas").val("");
            $("#prodi").val("");

            // Hapus semua filter
            table.search("").columns().search("").draw();
        });
    });
</script>
<?php endpush('scripts') ?>

<?php
include 'templates/master.php'; // Gunakan template utama
?>