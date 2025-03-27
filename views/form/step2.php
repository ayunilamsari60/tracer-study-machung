<h3>Step 2: Detail Status</h3>
<section>
    <!-- Pekerjaan Content Start -->
    <div id="bekerja-content" class="step-2-content" style="display: none">
        <div class="mb-4">
            <label>Dalam berapa bulan Anda mendapatkan pekerjaan pertama?</label>
            <input type="number" class="form-control" name="f502" placeholder="Masukkan jumlah bulan" />
        </div>

        <div class="mb-4">
            <label>Berapa rata-rata pendapatan Anda per bulan? (take home pay)</label>
            <input type="number" class="form-control" name="f505" placeholder="Masukkan pendapatan per bulan" />
        </div>

        <div class="mb-4">
            <label>Dimana lokasi tempat Anda bekerja?</label>
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="provinsi" class="form-label">Provinsi</label>
                    <select id="provinsi" class="form-select" name="f5a1">
                        <option value="" selected disabled>Pilih Provinsi</option>
                        <!-- Tambahkan daftar provinsi lainnya -->
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="kota" class="form-label">Kota/Kabupaten</label>
                    <select id="kota" class="form-select" name="f5a2">
                        <option value="" selected disabled>Pilih Kota/Kabupaten</option>
                        <!-- Opsi kota/kabupaten akan dimuat berdasarkan provinsi yang dipilih -->
                    </select>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <label>Alamat Instansi</label>
            <input type="text" class="form-control" name="UMC1" placeholder="Masukkan alamat instansi" />
        </div>

        <div class="mb-4">
            <label>Nama PIC/HRD/Atasan</label>
            <input type="text" class="form-control" name="UMC2" placeholder="Masukkan Nama PIC/HRD/Atasan" />
        </div>

        <div class="mb-4">
            <label>Telepon/Email PIC/HRD/Atasan</label>
            <input type="text" class="form-control" name="UMC3" placeholder="Masukkan Telepon/Email PIC/HRD/Atasan" />
        </div>

        <div class="mb-4">
            <label class="form-label">Apa jenis perusahaan/instansi/institusi tempat Anda bekerja sekarang?</label>

            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="f1101" value="1" id="instansi1">
                <label class="form-check-label" for="instansi1">Instansi Pemerintahan</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="f1101" value="2" id="instansi2">
                <label class="form-check-label" for="instansi2">Organisasi non-profit/LSM</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="f1101" value="3" id="instansi3">
                <label class="form-check-label" for="instansi3">Perusahaan Swasta</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="f1101" value="4" id="instansi4">
                <label class="form-check-label" for="instansi4">Wiraswasta/Perusahaan sendiri</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="f1101" value="5" id="instansi5">
                <label class="form-check-label" for="instansi5">BUMN/BUMD</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="f1101" value="6" id="instansi6">
                <label class="form-check-label" for="instansi6">Institusi/Organisasi Multilateral</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="f1101" value="7" id="instansi7">
                <label class="form-check-label" for="instansi7">Lainnya, tuliskan</label>
            </div>
            <div  class="mb-4 instansiLainnyaInput" style="display: none;">
                <input type="text" class="form-control" name="f1102" placeholder="Tuliskan lainnya" />
            </div>
        </div>

        <div class="mb-4">
            <label>Apa nama perusahaan/kantor tempat Anda bekerja?</label>
            <input type="text" class="form-control" name="f5b" placeholder="Masukkan nama perusahan/kantor" />
        </div>

        <div class="mb-4">
            <label for="tingkat_pekerjaan" class="form-label">Apa tingkat tempat kerja Anda?</label>
            <select id="tingkat_pekerjaan" class="form-select" name="f5d">
                <option selected disabled>Silahkan Pilih...</option>
                <option value="1">Lokal/Wilayah/wirausaha tidak berbadan hukum</option>
                <option value="2">Nasional/wiraswasta berbadan hukum</option>
                <option value="3">Internasional</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="form-label">Seberapa erat hubungan bidang studi dengan pekerjaan Anda?</label>
            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="f14" value="1" id="hubungan1">
                <label class="form-check-label" for="hubungan1">Sangat erat</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="f14" value="2" id="hubungan2">
                <label class="form-check-label" for="hubungan2">Erat</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="f14" value="3" id="hubungan3">
                <label class="form-check-label" for="hubungan3">Cukup Erat</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="f14" value="4" id="hubungan4">
                <label class="form-check-label" for="hubungan4">Kurang Erat</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="f14" value="5" id="hubungan5">
                <label class="form-check-label" for="hubungan5">Tidak Sama Sekali</label>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label">Tingkat pendidikan apa yang paling tepat/sesuai untuk pekerjaan Anda saat
                ini?</label>

            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="f15" value="1" id="pendidikan1">
                <label class="form-check-label" for="pendidikan1">Setingkat lebih tinggi</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="f15" value="2" id="pendidikan2">
                <label class="form-check-label" for="pendidikan2">Tingkat yang sama</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="f15" value="3" id="pendidikan3">
                <label class="form-check-label" for="pendidikan3">Setingkat lebih rendah</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="f15" value="4" id="pendidikan4">
                <label class="form-check-label" for="pendidikan4">Tidak perlu pendidikan tinggi</label>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label">Kapan Anda mulai mencari pekerjaan? Mohon pekerjaan sambilan tidak
                dimasukkan</label>

            <div class="form-check mb-2 d-flex align-items-center gap-2">
                <input class="form-check-input" type="radio" name="f301" value="1" id="cariKerja1">
                <label class="form-check-label" for="cariKerja1">Kira-kira</label>
                <input type="number" class="form-control form-control-sm w-auto" name="f302" min="0" placeholder="...">
                Bulan sebelum lulus
            </div>

            <div class="form-check mb-2 d-flex align-items-center gap-2">
                <input class="form-check-input" type="radio" name="f301" value="2" id="cariKerja2">
                <label class="form-check-label" for="cariKerja2">Kira-kira</label>
                <input type="number" class="form-control form-control-sm w-auto" name="f303" min="0" placeholder="...">
                Bulan sesudah lulus
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="f301" value="3" id="cariKerja3">
                <label class="form-check-label" for="cariKerja3">Saya tidak mencari kerja</label>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label">Bagaimana Anda mencari pekerjaan tersebut?</label>

            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="f401" value="1" id="cari1">
                <label class="form-check-label" for="cari1">Melalui koran/majalah/brosur</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="f402" value="1" id="cari2">
                <label class="form-check-label" for="cari2">Melamar ke perusahaan tanpa mengetahui lowongan yang
                    ada</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="f403" value="1" id="cari3">
                <label class="form-check-label" for="cari3">Pergi ke bursa/pameran kerja</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="f404" value="1" id="cari4">
                <label class="form-check-label" for="cari4">Mencari lewat internet/iklan online/milis</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="f405" value="1" id="cari5">
                <label class="form-check-label" for="cari5">Dihubungi oleh perusahaan</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="f406" value="1" id="cari6">
                <label class="form-check-label" for="cari6">Menghubungi Kemenakertrans</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="f407" value="1" id="cari7">
                <label class="form-check-label" for="cari7">Menghubungi agen tenaga kerja komersial/swasta</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="f408" value="1" id="cari8">
                <label class="form-check-label" for="cari8">Memeroleh informasi dari pusat/kantor pengembangan karir
                    fakultas/universitas</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="f409" value="1" id="cari9">
                <label class="form-check-label" for="cari9">Menghubungi kantor kemahasiswaan/hubungan alumni</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="f4010" value="1" id="cari10">
                <label class="form-check-label" for="cari10">Membangun jejaring (network) sejak masih kuliah</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="f4011" value="1" id="cari11">
                <label class="form-check-label" for="cari11">Melalui relasi (misalnya dosen, orang tua, saudara, teman,
                    dll.)</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="f4012" value="1" id="cari12">
                <label class="form-check-label" for="cari12">Membangun bisnis sendiri</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="f4013" value="1" id="cari13">
                <label class="form-check-label" for="cari13">Melalui penempatan kerja atau magang</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="f4014" value="1" id="cari14">
                <label class="form-check-label" for="cari14">Bekerja di tempat yang sama dengan tempat kerja semasa
                    kuliah</label>
            </div>

            <div class="form-check mb-2 d-flex align-items-center gap-2">
                <input class="form-check-input" type="checkbox" name="f4015" value="1" id="cari15">
                <label class="form-check-label" for="cari15">Lainnya, tuliskan</label>
            </div>
            <div class="mb-4" id="cariLainnyaInput" style="display: none;">
                <input type="text" class="form-control" name="f4015" placeholder="Tuliskan lainnya" />
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label">Berapa perusahaan/instansi/institusi yang sudah Anda lamar (lewat surat/email)
                sebelum memperoleh pekerjaan pertama?</label>
            <input type="number" class="form-control" name="f6" placeholder="Masukkan jumlah lamaran" min="0" />
        </div>

        <div class="mb-4">
            <label class="form-label">Berapa banyak perusahaan/instansi/institusi yang merespons lamaran Anda?</label>
            <input type="number" class="form-control" name="f7" placeholder="Masukkan jumlah respons" min="0" />
        </div>

        <div class="mb-4">
            <label class="form-label">Berapa banyak perusahaan/instansi/institusi yang mengundang Anda untuk
                wawancara?</label>
            <input type="number" class="form-control" name="f7a" placeholder="Masukkan jumlah wawancara" min="0" />
        </div>

        <div class="mb-4">
            <label class="form-label">Berapa perusahaan/instansi yang telah Anda masuki untuk bekerja?</label>
            <input type="number" class="form-control" name="UMC4" placeholder="Masukkan jumlah perusahaan" min="0" />
        </div>

        <div class="mb-4">
            <label class="form-label">Apakah Anda aktif mencari pekerjaan dalam 4 minggu terakhir? Pilihlah satu
                jawaban</label>
            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="f1001" value="1" id="cariKerja1">
                <label class="form-check-label" for="cariKerja1">Tidak</label>
            </div>
            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="f1001" value="2" id="cariKerja2">
                <label class="form-check-label" for="cariKerja2">Tidak, tapi saya sedang menunggu hasil lamaran
                    kerja</label>
            </div>
            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="f1001" value="3" id="cariKerja3">
                <label class="form-check-label" for="cariKerja3">Ya, saya akan mulai bekerja dalam 2 minggu ke
                    depan</label>
            </div>
            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="f1001" value="4" id="cariKerja4">
                <label class="form-check-label" for="cariKerja4">Ya, tapi saya belum pasti akan bekerja dalam 2 minggu
                    ke depan</label>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label">Jika menurut Anda pekerjaan Anda saat ini tidak sesuai dengan pendidikan Anda,
                mengapa Anda mengambilnya? Jawaban bisa lebih dari satu.</label>

            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="f1601" value="1" id="alasan1">
                <label class="form-check-label" for="alasan1">Pertanyaan tidak sesuai; pekerjaan saya sekarang sudah
                    sesuai dengan pendidikan saya.</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="f1602" value="1" id="alasan2">
                <label class="form-check-label" for="alasan2">Saya belum mendapatkan pekerjaan yang lebih
                    sesuai.</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="f1603" value="1" id="alasan3">
                <label class="form-check-label" for="alasan3">Di pekerjaan ini saya memeroleh prospek karir yang
                    baik.</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="f1604" value="1" id="alasan4">
                <label class="form-check-label" for="alasan4">Saya lebih suka bekerja di area pekerjaan yang tidak ada
                    hubungannya dengan pendidikan saya.</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="f1605" value="1" id="alasan5">
                <label class="form-check-label" for="alasan5">Saya dipromosikan ke posisi yang kurang berhubungan dengan
                    pendidikan saya dibanding posisi sebelumnya.</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="f1606" value="1" id="alasan6">
                <label class="form-check-label" for="alasan6">Saya dapat memeroleh pendapatan yang lebih tinggi di
                    pekerjaan ini.</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="f1607" value="1" id="alasan7">
                <label class="form-check-label" for="alasan7">Pekerjaan saya saat ini lebih
                    aman/terjamin/secure.</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="f1608" value="1" id="alasan8">
                <label class="form-check-label" for="alasan8">Pekerjaan saya saat ini lebih menarik.</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="f1609" value="1" id="alasan9">
                <label class="form-check-label" for="alasan9">Pekerjaan saya saat ini lebih memungkinkan saya mengambil
                    pekerjaan tambahan/jadwal yang fleksibel, dll.</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="f1610" value="1" id="alasan10">
                <label class="form-check-label" for="alasan10">Pekerjaan saya saat ini lokasinya lebih dekat dari rumah
                    saya.</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="f1611" value="1" id="alasan11">
                <label class="form-check-label" for="alasan11">Pekerjaan saya saat ini dapat lebih menjamin kebutuhan
                    keluarga saya.</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="f1612" value="1" id="alasan12">
                <label class="form-check-label" for="alasan12">Pada awal meniti karir ini, saya harus menerima pekerjaan
                    yang tidak berhubungan dengan pendidikan saya.</label>
            </div>

            <div class="form-check mb-2 d-flex align-items-center gap-2">
                <input class="form-check-input" type="checkbox" name="f1613" value="1" id="alasan13">
                <label class="form-check-label" for="alasan13">Lainnya, tuliskan</label>
            </div>
            <div class="mb-4" id="alassanf1613" style="display: none;">
                <input type="text" class="form-control" name="f1613" placeholder="Tuliskan lainnya" />
            </div>
        </div>
    </div>
    <!-- Pekerjaan Content End -->

    <!-- Wiraswasta Content Start -->
    <div id="wiraswasta-content" class="step-2-content" style="display: none">
        <div class="mb-4">
            <label>Dalam berapa bulan Anda memulai wiraswasta?</label>
            <input type="number" class="form-control" name="bulan_wiraswasta_pertama"
                placeholder="Masukkan jumlah bulan" />
        </div>

        <div class="mb-4">
            <label class="form-label">Apa jenis perusahaan/instansi/institusi tempat Anda bekerja sekarang?</label>

            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="f1101" value="1" id="instansi1w">
                <label class="form-check-label" for="instansi1w">Instansi Pemerintahan</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="f1101" value="2" id="instansi2w">
                <label class="form-check-label" for="instansi2w">Organisasi non-profit/LSM</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="f1101" value="3" id="instansi3w">
                <label class="form-check-label" for="instansi3w">Perusahaan Swasta</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="f1101" value="4" id="instansi4w">
                <label class="form-check-label" for="instansi4w">Wiraswasta/Perusahaan sendiri</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="f1101" value="5" id="instansi5w">
                <label class="form-check-label" for="instansi5w">BUMN/BUMD</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="f1101" value="6" id="instansi6w">
                <label class="form-check-label" for="instansi6w">Institusi/Organisasi Multilateral</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="f1101" value="7" id="instansi7w">
                <label class="form-check-label" for="instansi7w">Lainnya, tuliskan</label>
            </div>
            <div  class="mb-4 instansiLainnyaInput" style="display: none;">
                <input type="text" class="form-control" name="f1102" placeholder="Tuliskan lainnya" />
            </div>
        </div>
    </div>
    <!-- Wiraswasta Content End -->

    <!-- Pendidikan Content Start -->
    <div id="pendidikan-content" class="step-2-content" style="display: none">
        <div class="mb-3">
            <label for="sumber_biaya" class="form-label">Sumber Biaya (f18a)</label>
            <select id="sumber_biaya" class="form-select" name="F18a">
                <option selected disabled>Silahkan Pilih...</option>
                <option value="1">Biaya Sendiri (1)</option>
                <option value="2">Beasiswa (2)</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="perguruan_tinggi">Perguruan Tinggi (f18b)</label>
            <input type="text" class="form-control" name="F18b" id="perguruan_tinggi"
                placeholder="Masukkan nama perguruan tinggi" />
        </div>
        <div class="mb-3">
            <label for="program_studi">Program Studi (f18c)</label>
            <input type="text" class="form-control" name="F18c" id="program_studi"
                placeholder="Masukkan nama program studi" />
        </div>
        <div class="mb-3">
            <label for="tanggal_masuk">Tanggal Masuk (f18d)</label>
            <input type="date" class="form-control" name="F18d" id="tanggal_masuk" />
        </div>
        <div class="mb-3">
            <label class="mb-3">Sebutkan sumber dana dalam pembiayaan kuliah?
                (f1201)</label>

            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="F1201" id="sumber_dana1" value="1" />
                <label class="form-check-label" for="sumber_dana1">Biaya Sendiri (1)</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="F1201" id="sumber_dana2" value="2" />
                <label class="form-check-label" for="sumber_dana2">Beasiswa ADIK (2)</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="F1201" id="sumber_dana3" value="3" />
                <label class="form-check-label" for="sumber_dana3">Beasiswa BIDIKMISI (3)</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="F1201" id="sumber_dana4" value="4" />
                <label class="form-check-label" for="sumber_dana4">Beasiswa PPA (4)</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="F1201" id="sumber_dana5" value="5" />
                <label class="form-check-label" for="sumber_dana5">Beasiswa AFIRMASI (5)</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="F1201" id="sumber_dana6" value="6" />
                <label class="form-check-label" for="sumber_dana6">Beasiswa Perusahaan/Swasta (6)</label>
            </div>

            <!-- Opsi Lainnya dengan input text -->
            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="F1201" id="sumber_dana7" value="7" />
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
        <input type="text" class="form-control" name="strategi_mencari" placeholder="Masukkan strategi Anda" />
    </div>
    <!-- Mencari Kerja Content End -->

    <!-- Tidak Bekerja Content Start -->
    <div id="tidak-bekerja-content" class="step-2-content" style="display: none">
        <label>Mengapa Anda belum memungkinkan untuk bekerja?</label>
        <input type="text" class="form-control" name="alasan" placeholder="Jelaskan alasan Anda" />
    </div>
    <!-- Tidak Bekerja Content End -->
</section>