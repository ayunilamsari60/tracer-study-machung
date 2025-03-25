<h3>Step 2: Detail Status</h3>
<section>
    <!-- Pekerjaan Content Start -->
    <div id="bekerja-content" class="step-2-content" style="display: none">
        <label>Pekerjaan apa yang Anda lakukan?</label>
        <input type="text" class="form-control" name="pekerjaan"
            placeholder="Masukkan pekerjaan Anda" />
    </div>
    <!-- Pekerjaan Content End -->

    <!-- Wiraswasta Content Start -->
    <div id="wiraswasta-content" class="step-2-content" style="display: none">
        <label>Apa jenis usaha yang Anda jalankan?</label>
        <input type="text" class="form-control" name="usaha" placeholder="Masukkan jenis usaha" />
    </div>
    <!-- Wiraswasta Content End -->

    <!-- Pendidikan Content Start -->
    <div id="pendidikan-content" class="step-2-content" style="display: none">
        <div class="mb-3">
            <label for="sumber_biaya" class="form-label">Sumber Biaya (f18a)</label>
            <select id="sumber_biaya" class="form-select" name="sumber_biaya">
                <option selected disabled>Silahkan Pilih...</option>
                <option value="1">Biaya Sendiri (1)</option>
                <option value="2">Beasiswa (2)</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="perguruan_tinggi">Perguruan Tinggi (f18b)</label>
            <input type="text" class="form-control" name="perguruan_tinggi" id="perguruan_tinggi"
                placeholder="Masukkan nama perguruan tinggi" />
        </div>
        <div class="mb-3">
            <label for="program_studi">Program Studi (f18c)</label>
            <input type="text" class="form-control" name="program_studi" id="program_studi"
                placeholder="Masukkan nama program studi" />
        </div>
        <div class="mb-3">
            <label for="tanggal_masuk">Tanggal Masuk (f18d)</label>
            <input type="date" class="form-control" name="tanggal_masuk" id="tanggal_masuk" />
        </div>
        <div class="mb-3">
            <label class="mb-3">Sebutkan sumber dana dalam pembiayaan kuliah?
                (f1201)</label>

            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="sumber_dana" id="sumber_dana1"
                    value="1" />
                <label class="form-check-label" for="sumber_dana1">Biaya Sendiri (1)</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="sumber_dana" id="sumber_dana2"
                    value="2" />
                <label class="form-check-label" for="sumber_dana2">Beasiswa ADIK (2)</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="sumber_dana" id="sumber_dana3"
                    value="3" />
                <label class="form-check-label" for="sumber_dana3">Beasiswa BIDIKMISI (3)</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="sumber_dana" id="sumber_dana4"
                    value="4" />
                <label class="form-check-label" for="sumber_dana4">Beasiswa PPA (4)</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="sumber_dana" id="sumber_dana5"
                    value="5" />
                <label class="form-check-label" for="sumber_dana5">Beasiswa AFIRMASI (5)</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="sumber_dana" id="sumber_dana6"
                    value="6" />
                <label class="form-check-label" for="sumber_dana6">Beasiswa Perusahaan/Swasta
                    (6)</label>
            </div>

            <!-- Opsi Lainnya dengan input text -->
            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="sumber_dana" id="sumber_dana7"
                    value="7" />
                <label class="form-check-label" for="sumber_dana7">Lainnya, tuliskan (7)</label>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control mt-2" id="sumber_dana_lainnya" name="f1202"
                    placeholder="Tulis sumber dana lainnya..." style="display: none" />
            </div>
        </div>
    </div>
    <!-- Pendidikan Content End -->

    <!-- Mencari Kerja Content Start -->
    <div id="mencari-kerja-content" class="step-2-content" style="display: none">
        <label>Bagaimana strategi Anda dalam mencari pekerjaan?</label>
        <input type="text" class="form-control" name="strategi_mencari"
            placeholder="Masukkan strategi Anda" />
    </div>
    <!-- Mencari Kerja Content End -->
     
    <!-- Tidak Bekerja Content Start -->
    <div id="tidak-bekerja-content" class="step-2-content" style="display: none">
        <label>Mengapa Anda belum memungkinkan untuk bekerja?</label>
        <input type="text" class="form-control" name="alasan" placeholder="Jelaskan alasan Anda" />
    </div>
    <!-- Tidak Bekerja Content End -->
</section>