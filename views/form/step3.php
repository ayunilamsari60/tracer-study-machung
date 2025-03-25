<h3>Informasi Tambahan</h3>
<section>
    <div id="informasi-tambahan-content" class="step-3-content" style="display: none">
        <div class="mb-3">
            <label for="hobi" class="form-label">Hobi</label>
            <input type="text" class="form-control" name="hobi" id="hobi"
                placeholder="Masukkan hobi Anda">
        </div>

        <div class="mb-3">
            <label for="cita_cita" class="form-label">Cita-Cita</label>
            <input type="text" class="form-control" name="cita_cita" id="cita_cita"
                placeholder="Masukkan cita-cita Anda">
        </div>

        <?php
        $kompetensi = [
            ["f1761", "Etika", "f1762"],
            ["f1763", "Keahlian Berdasarkan Bidang Ilmu", "f1764"],
            ["f1765", "Bahasa Inggris", "f1766"]
        ];
        ?>

        <div class="mb-3">
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
        <div class="mb-3">
            <h3 for="" class="mb-3">Menurut anda seberapa besar penekanan pada metode pembelajaran dibawah ini dilaksanakan di program studi anda?
            </h3>

            <?php
            $pertanyaan = [
                "f21" => "Perkuliahan",
                "f22" => "Demonstrasi",
                "f23" => "Partisipasi dalam proyek riset",
                "f24" => "Magang",
                "f25" => "Praktikum",
                "f26" => "Kerja Lapangan"
            ];

            $opsi = [
                1 => "Sangat Besar (1)",
                2 => "Besar (2)",
                3 => "Cukup Besar (3)",
                4 => "Kurang Besar (4)",
                5 => "Tidak Sama Sekali (5)"
            ];
            ?>
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
    </div>
</section>