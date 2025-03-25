<?php
// List kompetensi
$kompetensi = [
    ["f1761", "Etika", "f1762"],
    ["f1763", "Keahlian Berdasarkan Bidang Ilmu", "f1764"],
    ["f1765", "Bahasa Inggris", "f1766"],
    ["1767","Penggunaan Teknologi Informasi", "f1768"],
    ["f1769", "Komunikasi", "f1770"],
    ["f1771", "Kerja sama tim", "f1772"],
    ["f1773", "Pengembangan", "f1774"],
];

// List pertanyaan
$pertanyaan = [
    "f21" => "Perkuliahan",
    "f22" => "Demonstrasi",
    "f23" => "Partisipasi dalam proyek riset",
    "f24" => "Magang",
    "f25" => "Praktikum",
    "f26" => "Kerja Lapangan",
    "f27" => "Diskusi",
];

$opsi = [
    1 => "Sangat Besar (1)",
    2 => "Besar (2)",
    3 => "Cukup Besar (3)",
    4 => "Kurang Besar (4)",
    5 => "Tidak Sama Sekali (5)"
];
?>

<h3>Informasi Tambahan</h3>
<section>
    <div id="kemampuan-content" class="step-3-content" style="display: none">
        <!-- Kompetensi Content Start -->
        <div class="mb-5">
            <label for="label-content">Pada saat lulus, pada tingkat mana kompetensi di bawah ini anda : kuasai? (A) Pada saat ini, pada tingkat mana kompetensi di bawah ini diperlukan dalam pekerjaan? (B) *(Wajib diisi)</label>
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th colspan="5">A</th>
                        <th rowspan="3">Kompetensi</th>
                        <th colspan="5">B</th>
                    </tr>
                    <tr>
                        <th colspan="5">Sangat Rendah - Sangat Tinggi</th>
                        <th colspan="5">Sangat Rendah - Sangat Tinggi</th>
                    </tr>
                    <tr>
                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                            <th><?= $i ?></th>
                        <?php endfor; ?>
                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                            <th><?= $i ?></th>
                        <?php endfor; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($kompetensi as $item) : ?>
                        <?php
                        $kodeA = $item[0]; // Kode untuk kolom A
                        $judul = $item[1]; // Nama Kompetensi
                        $kodeB = $item[2]; // Kode untuk kolom B
                        ?>
                        <tr>
                            <!-- Kolom A -->
                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                <td><label><input type="radio" name="<?= $kodeA ?>" value="<?= $i ?>"> </label></td>
                            <?php endfor; ?>

                            <!-- Kompetensi -->
                            <td>(<?= $kodeA ?>) <?= $judul ?> (<?= $kodeB ?>)</td>

                            <!-- Kolom B -->
                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                <td><label><input type="radio" name="<?= $kodeB ?>" value="<?= $i ?>"> </label></td>
                            <?php endfor; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- Kompetensi Content End -->

        <!-- Pertanyaan Content Start -->
        <div class="mb-3">
            <h3 for="" class="mb-3">Menurut anda seberapa besar penekanan pada metode pembelajaran dibawah ini dilaksanakan di program studi anda?
            </h3>


            <div class="container">
                <div class="row g-3"> <!-- Tambahkan row dengan gap -->
                    <?php foreach ($pertanyaan as $key => $judul) : ?>
                        <div class="col-lg-4 col-md-6 col-12"> <!-- 3 kolom di layar besar, 2 kolom di tablet, 1 kolom di HP -->
                            <label class="fw-bold d-block mb-3"><?= $judul ?> (<?= $key ?>)</label>
                            <?php foreach ($opsi as $value => $label) : ?>
                                <div class="form-check mb-2"> <!-- Bootstrap form-check -->
                                    <input class="form-check-input" type="radio" name="<?= $key ?>" value="<?= $value ?>" id="<?= $key . $value ?>">
                                    <label class="form-check-label" for="<?= $key . $value ?>"><?= $label ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="status_kerja" value="bekerja" />
                                    Bekerja (1)
                                </div> -->
        </div>
        <!-- Pertanyaan Content End -->
    </div>
</section>