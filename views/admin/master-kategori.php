<!-- dashboard.php -->
<?php
$title = "Master Kategori"; // Judul halaman
$custom_css = '
        <!-- DataTables -->
        <link href="../assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- App favicon -->
    `   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
        ';
$custom_js = '
        <!-- Datatable JS -->
        <script src="../assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="../assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="../assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="../assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="../assets/libs/jszip/jszip.min.js"></script>
        <script src="../assets/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="../assets/libs/pdfmake/build/vfs_fonts.js"></script>
        <script src="../assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="../assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="../assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
        <script src="../assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="../assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
        <script src="../assets/js/pages/datatables.init.js"></script>';
ob_start(); // Mulai output buffering
?>

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Master Kategori</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Skote</a></li>
                    <li class="breadcrumb-item active">Master Kategori</li>
                </ol>
            </div>

        </div>

        <div class="card">
            <div class="card-body">
                <table id="datatable"
                    class="table table-bordered table-striped nowrap w-100">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>JENIS KATEGORI</th>
                            <th>JUDUL KATEGORI</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr>
                            <td>1</td>
                            <td>Kategori 1</td>
                            <td>Judul 1</td>
                            <td>
                                <div class="d-flex flex-row mb-2">
                                    <a href="" class="btn btn-success me-2" title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <a href="" class="btn btn-primary me-2" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger me-2" data-bs-toggle="modal" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>Kategori 2</td>
                            <td>Judul 2</td>
                            <td>
                                <div class="d-flex flex-row mb-2">
                                    <a href="" class="btn btn-success me-2" title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <a href="" class="btn btn-primary me-2" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger me-2" data-bs-toggle="modal" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>1</td>
                            <td>Kategori 1</td>
                            <td>Judul 1</td>
                            <td>
                                <div class="d-flex flex-row mb-2">
                                    <a href="" class="btn btn-success me-2" title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <a href="" class="btn btn-primary me-2" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger me-2" data-bs-toggle="modal" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>


                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<?php
$content = ob_get_clean(); // Simpan konten yang sudah dibuat
include 'templates/master.php'; // Gunakan template utama
?>