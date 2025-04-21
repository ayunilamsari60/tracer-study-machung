<h3>Step 2: Detail Status</h3>
<section>
    <!-- Pekerjaan Content Start -->
    <?php if ($data['F8'] == 1) { ?>
        <div id="bekerja-content" class="step-2-content">
            <div class="mb-4">
                <label>Dalam berapa bulan Anda mendapatkan pekerjaan pertama?</label>
                <input type="number" class="form-control" name="f502"
                    placeholder="<?php echo htmlspecialchars($data['F502']) ?>"
                    value="<?php echo htmlspecialchars($data['F502']) ?>" disabled />
            </div>

            <div class="mb-4">
                <label>Berapa rata-rata pendapatan Anda per bulan? (take home pay)</label>
                <input type="number" class="form-control" name="f505"
                    placeholder="<?php echo htmlspecialchars($data['F505']) ?>"
                    value="<?php echo htmlspecialchars($data['F505']) ?>" disabled />
            </div>

            <div class="mb-4">
                <label>Dimana lokasi tempat Anda bekerja?</label>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Provinsi <span class="text-danger">*</span></label>
                        <select id="provinsi" class="form-select" name="f5a1" disabled>
                            <option value="<?php echo htmlspecialchars($data['F5A1']) ?>" selected disabled>
                                <?php echo htmlspecialchars($data['F5A1']) ?>
                            </option>
                            <!-- Tambahkan daftar provinsi lainnya -->
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="kota" class="form-label">Kota/Kabupaten</label>
                        <select id="kota" class="form-select" name="f5a2" disabled>
                            <option value="<?php echo htmlspecialchars($data['F5A2']) ?>" selected disabled>
                                <?php echo htmlspecialchars($data['F5A2']) ?>
                            </option>
                            <!-- Opsi kota/kabupaten akan dimuat berdasarkan provinsi yang dipilih -->
                        </select>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <label>Alamat Instansi</label>
                <input type="text" class="form-control" name="UMC1"
                    placeholder="<?php echo htmlspecialchars($data['UMC1']) ?>"
                    value="<?php echo htmlspecialchars($data['UMC1']) ?>" disabled />
            </div>

            <div class="mb-4">
                <label>Nama PIC/HRD/Atasan</label>
                <input type="text" class="form-control" name="UMC2"
                    placeholder="<?php echo htmlspecialchars($data['UMC2']) ?>"
                    value="<?php echo htmlspecialchars($data['UMC2']) ?>" disabled />
            </div>

            <div class="mb-4">
                <label>Telepon/Email PIC/HRD/Atasan</label>
                <input type="text" class="form-control" name="UMC3"
                    placeholder="<?php echo htmlspecialchars($data['UMC3']) ?>"
                    value="<?php echo htmlspecialchars($data['UMC3']) ?>" disabled />
            </div>

            <div class="mb-4">
                <label class="form-label">Apa jenis perusahaan/instansi/institusi tempat Anda bekerja sekarang?</label>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="f1101" value="1" id="instansi1" <?php echo ($data['F1101'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="instansi1">Instansi Pemerintahan</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="f1101" value="2" id="instansi2" <?php echo ($data['F1101'] == 2) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="instansi2">Organisasi non-profit/LSM</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="f1101" value="3" id="instansi3" <?php echo ($data['F1101'] == 3) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="instansi3">Perusahaan Swasta</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="f1101" value="4" id="instansi4" <?php echo ($data['F1101'] == 4) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="instansi4">Wiraswasta/Perusahaan sendiri</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="f1101" value="5" id="instansi5" <?php echo ($data['F1101'] == 5) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="instansi5">BUMN/BUMD</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="f1101" value="6" id="instansi6" <?php echo ($data['F1101'] == 6) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="instansi6">Institusi/Organisasi Multilateral</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="f1101" value="7" id="instansi7" <?php echo ($data['F1101'] == 7) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="instansi7">Lainnya, tuliskan</label>
                </div>
                <div class="mb-4 instansiLainnyaInput">
                    <input type="text" class="form-control" name="f1102"
                        placeholder="<?php echo htmlspecialchars($data['F1102']) ?>"
                        value="<?php echo htmlspecialchars($data['F1102']) ?>" disabled />
                </div>
            </div>

            <div class="mb-4">
                <label>Apa nama perusahaan/kantor tempat Anda bekerja?</label>
                <input type="text" class="form-control" name="f5b"
                    placeholder="<?php echo htmlspecialchars($data['F5B']) ?>"
                    value="<?php echo htmlspecialchars($data['F5B']) ?>" disabled />
            </div>

            <div class="mb-4">
                <label for="tingkat_pekerjaan" class="form-label">Apa tingkat tempat kerja Anda?</label>
                <select id="tingkat_pekerjaan" class="form-select" name="f5d" disabled>
                    <option value="<?php echo htmlspecialchars($data['F5D']) ?>" selected disabled>
                        <?php echo htmlspecialchars($data['F5D']) ?>
                    </option>
                </select>
            </div>

            <div class="mb-4">
                <label class="form-label">Seberapa erat hubungan bidang studi dengan pekerjaan Anda?</label>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="f14" value="1" id="hubungan1" <?php echo ($data['F14'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="hubungan1">Sangat erat</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="f14" value="2" id="hubungan2" <?php echo ($data['F14'] == 2) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="hubungan2">Erat</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="f14" value="3" id="hubungan3" <?php echo ($data['F14'] == 3) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="hubungan3">Cukup Erat</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="f14" value="4" id="hubungan4" <?php echo ($data['F14'] == 4) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="hubungan4">Kurang Erat</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="f14" value="5" id="hubungan5" <?php echo ($data['F14'] == 5) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="hubungan5">Tidak Sama Sekali</label>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Tingkat pendidikan apa yang paling tepat/sesuai untuk pekerjaan Anda saat
                    ini?</label>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="f15" value="1" id="pendidikan1" <?php echo ($data['F15'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="pendidikan1">Setingkat lebih tinggi</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="f15" value="2" id="pendidikan2" <?php echo ($data['F15'] == 2) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="pendidikan2">Tingkat yang sama</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="f15" value="3" id="pendidikan3" <?php echo ($data['F15'] == 3) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="pendidikan3">Setingkat lebih rendah</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="f15" value="4" id="pendidikan4" <?php echo ($data['F15'] == 4) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="pendidikan4">Tidak perlu pendidikan tinggi</label>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Kapan Anda mulai mencari pekerjaan? Mohon pekerjaan sambilan tidak
                    dimasukkan</label>

                <div class="form-check mb-2 d-flex align-items-center gap-2">
                    <input class="form-check-input" type="radio" name="f301" value="1" id="cariKerja1" <?php echo ($data['F301'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cariKerja1">Kira-kira</label>
                    <input type="number" class="form-control form-control-sm w-auto" name="f302" min="0"
                        placeholder="<?php echo htmlspecialchars($data['F302']) ?>"
                        value="<?php echo htmlspecialchars($data['F302']) ?>" disabled>
                    Bulan sebelum lulus
                </div>

                <div class="form-check mb-2 d-flex align-items-center gap-2">
                    <input class="form-check-input" type="radio" name="f301" value="2" id="cariKerja2" <?php echo ($data['F301'] == 2) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cariKerja2">Kira-kira</label>
                    <input type="number" class="form-control form-control-sm w-auto" name="f303" min="0"
                        placeholder="<?php echo htmlspecialchars($data['F303']) ?>"
                        value="<?php echo htmlspecialchars($data['F303']) ?>" disabled>
                    Bulan sesudah lulus
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="f301" value="3" id="cariKerja3" <?php echo ($data['F301'] == 3) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cariKerja3">Saya tidak mencari kerja</label>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Bagaimana Anda mencari pekerjaan tersebut?</label>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f401" value="1" id="cari1"
                        data-group="mencari-pekerjaan" <?php echo ($data['F401'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari1">Melalui koran/majalah/brosur</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f402" value="1" id="cari2"
                        data-group="mencari-pekerjaan" <?php echo ($data['F402'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari2">Melamar ke perusahaan tanpa mengetahui lowongan yang
                        ada</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f403" value="1" id="cari3"
                        data-group="mencari-pekerjaan" <?php echo ($data['F403'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari3">Pergi ke bursa/pameran kerja</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f404" value="1" id="cari4"
                        data-group="mencari-pekerjaan" <?php echo ($data['F404'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari4">Mencari lewat internet/iklan online/milis</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f405" value="1" id="cari5"
                        data-group="mencari-pekerjaan" <?php echo ($data['F405'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari5">Dihubungi oleh perusahaan</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f406" value="1" id="cari6"
                        data-group="mencari-pekerjaan" <?php echo ($data['F406'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari6">Menghubungi Kemenakertrans</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f407" value="1" id="cari7"
                        data-group="mencari-pekerjaan" <?php echo ($data['F407'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari7">Menghubungi agen tenaga kerja komersial/swasta</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f408" value="1" id="cari8"
                        data-group="mencari-pekerjaan" <?php echo ($data['F408'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari8">Memeroleh informasi dari pusat/kantor pengembangan karir
                        fakultas/universitas</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f409" value="1" id="cari9"
                        data-group="mencari-pekerjaan" <?php echo ($data['F409'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari9">Menghubungi kantor kemahasiswaan/hubungan alumni</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f410" value="1" id="cari10"
                        data-group="mencari-pekerjaan" <?php echo ($data['F410'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari10">Membangun jejaring (network) sejak masih kuliah</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f411" value="1" id="cari11"
                        data-group="mencari-pekerjaan" <?php echo ($data['F411'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari11">Melalui relasi (misalnya dosen, orang tua, saudara, teman,
                        dll.)</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f412" value="1" id="cari12"
                        data-group="mencari-pekerjaan" <?php echo ($data['F412'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari12">Membangun bisnis sendiri</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f413" value="1" id="cari13"
                        data-group="mencari-pekerjaan" <?php echo ($data['F413'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari13">Melalui penempatan kerja atau magang</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f414" value="1" id="cari14"
                        data-group="mencari-pekerjaan" <?php echo ($data['F414'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari14">Bekerja di tempat yang sama dengan tempat kerja semasa
                        kuliah</label>
                </div>

                <div class="form-check mb-2 d-flex align-items-center gap-2">
                    <input class="form-check-input" type="checkbox" name="f415" value="1" id="cari15"
                        data-group="mencari-pekerjaan" <?php echo ($data['F415'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari15">Lainnya, tuliskan</label>
                </div>
                <div class="mb-4 cariLainnyaInput">
                    <input type="text" class="form-control" name="f416"
                        placeholder="<?php echo htmlspecialchars($data['F1102']) ?>"
                        value="<?php echo htmlspecialchars($data['F1102']) ?>" disabled />
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Berapa perusahaan/instansi/institusi yang sudah Anda lamar (lewat surat/email)
                    sebelum memperoleh pekerjaan pertama?</label>
                <input type="number" class="form-control" name="f6"
                    placeholder="<?php echo htmlspecialchars($data['F6']) ?>"
                    value="<?php echo htmlspecialchars($data['F6']) ?>" disabled min="0" />
            </div>

            <div class="mb-4">
                <label class="form-label">Berapa banyak perusahaan/instansi/institusi yang merespons lamaran Anda?</label>
                <input type="number" class="form-control" name="f7"
                    placeholder="<?php echo htmlspecialchars($data['F7']) ?>"
                    value="<?php echo htmlspecialchars($data['F7']) ?>" disabled min="0" />
            </div>

            <div class="mb-4">
                <label class="form-label">Berapa banyak perusahaan/instansi/institusi yang mengundang Anda untuk
                    wawancara?</label>
                <input type="number" class="form-control" name="f7a"
                    placeholder="<?php echo htmlspecialchars($data['F7A']) ?>"
                    value="<?php echo htmlspecialchars($data['F7A']) ?>" disabled min="0" />
            </div>

            <div class="mb-4">
                <label class="form-label">Berapa perusahaan/instansi yang telah Anda masuki untuk bekerja?</label>
                <input type="number" class="form-control" name="UMC4"
                    placeholder="<?php echo htmlspecialchars($data['UMC4']) ?>"
                    value="<?php echo htmlspecialchars($data['UMC4']) ?>" disabled min="0" />
            </div>

            <div class="mb-4">
                <label class="form-label">Apakah Anda aktif mencari pekerjaan dalam 4 minggu terakhir? Pilihlah satu
                    jawaban</label>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="f1001" value="1" id="Kerja1" <?php echo ($data['F1001'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="Kerja1">Tidak</label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="f1001" value="2" id="Kerja2" <?php echo ($data['F1001'] == 2) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="Kerja2">Tidak, tapi saya sedang menunggu hasil lamaran
                        kerja</label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="f1001" value="3" id="Kerja3" <?php echo ($data['F1001'] == 3) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="Kerja3">Ya, saya akan mulai bekerja dalam 2 minggu ke
                        depan</label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="f1001" value="4" id="Kerja4" <?php echo ($data['F1001'] == 4) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="Kerja4">Ya, tapi saya belum pasti akan bekerja dalam 2 minggu
                        ke depan</label>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Jika menurut Anda pekerjaan Anda saat ini tidak sesuai dengan pendidikan Anda,
                    mengapa Anda mengambilnya? Jawaban bisa lebih dari satu.</label>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f1601" value="1" id="alasan1"
                        data-group="penyesuaian-pekerjaan" <?php echo ($data['F1601'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="alasan1">Pertanyaan tidak sesuai; pekerjaan saya sekarang sudah
                        sesuai dengan pendidikan saya.</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f1602" value="1" id="alasan2"
                        data-group="penyesuaian-pekerjaan" <?php echo ($data['F1602'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="alasan2">Saya belum mendapatkan pekerjaan yang lebih
                        sesuai.</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f1603" value="1" id="alasan3"
                        data-group="penyesuaian-pekerjaan" <?php echo ($data['F1603'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="alasan3">Di pekerjaan ini saya memeroleh prospek karir yang
                        baik.</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f1604" value="1" id="alasan4"
                        data-group="penyesuaian-pekerjaan" <?php echo ($data['F1604'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="alasan4">Saya lebih suka bekerja di area pekerjaan yang tidak ada
                        hubungannya dengan pendidikan saya.</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f1605" value="1" id="alasan5"
                        data-group="penyesuaian-pekerjaan" <?php echo ($data['F1605'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="alasan5">Saya dipromosikan ke posisi yang kurang berhubungan dengan
                        pendidikan saya dibanding posisi sebelumnya.</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f1606" value="1" id="alasan6"
                        data-group="penyesuaian-pekerjaan" <?php echo ($data['F1606'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="alasan6">Saya dapat memeroleh pendapatan yang lebih tinggi di
                        pekerjaan ini.</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f1607" value="1" id="alasan7"
                        data-group="penyesuaian-pekerjaan" <?php echo ($data['F1607'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="alasan7">Pekerjaan saya saat ini lebih
                        aman/terjamin/secure.</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f1608" value="1" id="alasan8"
                        data-group="penyesuaian-pekerjaan" <?php echo ($data['F1608'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="alasan8">Pekerjaan saya saat ini lebih menarik.</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f1609" value="1" id="alasan9"
                        data-group="penyesuaian-pekerjaan" <?php echo ($data['F1609'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="alasan9">Pekerjaan saya saat ini lebih memungkinkan saya mengambil
                        pekerjaan tambahan/jadwal yang fleksibel, dll.</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f1610" value="1" id="alasan10"
                        data-group="penyesuaian-pekerjaan" <?php echo ($data['F1610'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="alasan10">Pekerjaan saya saat ini lokasinya lebih dekat dari rumah
                        saya.</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f1611" value="1" id="alasan11"
                        data-group="penyesuaian-pekerjaan" <?php echo ($data['F1611'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="alasan11">Pekerjaan saya saat ini dapat lebih menjamin kebutuhan
                        keluarga saya.</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f1612" value="1" id="alasan12"
                        data-group="penyesuaian-pekerjaan" <?php echo ($data['F1612'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="alasan12">Pada awal meniti karir ini, saya harus menerima pekerjaan
                        yang tidak berhubungan dengan pendidikan saya.</label>
                </div>

                <div class="form-check mb-2 d-flex align-items-center gap-2">
                    <input class="form-check-input" type="checkbox" name="f1613" value="1" id="alasan13"
                        data-group="penyesuaian-pekerjaan" <?php echo ($data['F1613'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="alasan13">Lainnya, tuliskan</label>
                </div>
                <div class="mb-4 alasanLainnyaInput">
                    <input type="text" class="form-control" name="f1614"
                        placeholder="<?php echo htmlspecialchars($data['F1102']) ?>"
                        value="<?php echo htmlspecialchars($data['F1102']) ?>" disabled />
                </div>
            </div>
        </div>
    <?php } ?>
    <!-- Pekerjaan Content End -->

    <!-- Wiraswasta Content Start -->
    <?php if ($data['F8'] == 2) { ?>
        <div id="wiraswasta-content" class="step-2-content">
            <div class="mb-4">
                <label>Dalam berapa bulan Anda memulai wiraswasta?</label>
                <input type="number" class="form-control" name="f502"
                    placeholder="<?php echo htmlspecialchars($data['F502']) ?>"
                    value="<?php echo htmlspecialchars($data['F502']) ?>" disabled />
            </div>

            <div class="mb-4">
                <label class="form-label">Apa jenis perusahaan/instansi/institusi tempat Anda bekerja sekarang?</label>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="f1101" value="1" id="instansi1" <?php echo ($data['F1101'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="instansi1">Instansi Pemerintahan</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="f1101" value="2" id="instansi2" <?php echo ($data['F1101'] == 2) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="instansi2">Organisasi non-profit/LSM</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="f1101" value="3" id="instansi3" <?php echo ($data['F1101'] == 3) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="instansi3">Perusahaan Swasta</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="f1101" value="4" id="instansi4" <?php echo ($data['F1101'] == 4) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="instansi4">Wiraswasta/Perusahaan sendiri</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="f1101" value="5" id="instansi5" <?php echo ($data['F1101'] == 5) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="instansi5">BUMN/BUMD</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="f1101" value="6" id="instansi6" <?php echo ($data['F1101'] == 6) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="instansi6">Institusi/Organisasi Multilateral</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="f1101" value="7" id="instansi7" <?php echo ($data['F1101'] == 7) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="instansi7">Lainnya, tuliskan</label>
                </div>
                <div class="mb-4 instansiLainnyaInput">
                    <input type="text" class="form-control" name="f1102"
                        placeholder="<?php echo htmlspecialchars($data['F1102']) ?>"
                        value="<?php echo htmlspecialchars($data['F1102']) ?>" disabled />
                </div>
            </div>

            <div class="mb-4">
                <label for="posisi_wiraswasta" class="form-label">Bila berwiraswasta, apa posisi/jabatan Anda saat
                    ini?</label>
                <select id="posisi_wiraswasta" class="form-select" name="f5c" disabled>
                    <option value="<?php echo htmlspecialchars($data['F5C']) ?>" selected disabled>
                        <?php echo htmlspecialchars($data['F5C']) ?>
                    </option>
                </select>
            </div>

            <div class="mb-4">
                <label for="tingkat_pekerjaan" class="form-label">Apa tingkat tempat kerja Anda?</label>
                <select id="tingkat_pekerjaan" class="form-select" name="f5d" disabled>
                    <option value="<?php echo htmlspecialchars($data['F5D']) ?>" selected disabled>
                        <?php echo htmlspecialchars($data['F5D']) ?>
                    </option>
                </select>
            </div>

            <div class="mb-4">
                <label class="form-label">Seberapa erat hubungan bidang studi dengan pekerjaan Anda?</label>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="f14" value="1" id="hubungan1" <?php echo ($data['F14'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="hubungan1">Sangat erat</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="f14" value="2" id="hubungan2" <?php echo ($data['F14'] == 2) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="hubungan2">Erat</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="f14" value="3" id="hubungan3" <?php echo ($data['F14'] == 3) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="hubungan3">Cukup Erat</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="f14" value="4" id="hubungan4" <?php echo ($data['F14'] == 4) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="hubungan4">Kurang Erat</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="f14" value="5" id="hubungan5" <?php echo ($data['F14'] == 5) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="hubungan5">Tidak Sama Sekali</label>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Bagaimana Anda mencari pekerjaan tersebut?</label>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f401" value="1" id="cari1"
                        data-group="mencari-pekerjaan" <?php echo ($data['F401'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari1">Melalui koran/majalah/brosur</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f402" value="1" id="cari2"
                        data-group="mencari-pekerjaan" <?php echo ($data['F402'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari2">Melamar ke perusahaan tanpa mengetahui lowongan yang
                        ada</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f403" value="1" id="cari3"
                        data-group="mencari-pekerjaan" <?php echo ($data['F403'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari3">Pergi ke bursa/pameran kerja</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f404" value="1" id="cari4"
                        data-group="mencari-pekerjaan" <?php echo ($data['F404'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari4">Mencari lewat internet/iklan online/milis</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f405" value="1" id="cari5"
                        data-group="mencari-pekerjaan" <?php echo ($data['F405'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari5">Dihubungi oleh perusahaan</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f406" value="1" id="cari6"
                        data-group="mencari-pekerjaan" <?php echo ($data['F406'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari6">Menghubungi Kemenakertrans</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f407" value="1" id="cari7"
                        data-group="mencari-pekerjaan" <?php echo ($data['F407'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari7">Menghubungi agen tenaga kerja komersial/swasta</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f408" value="1" id="cari8"
                        data-group="mencari-pekerjaan" <?php echo ($data['F408'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari8">Memeroleh informasi dari pusat/kantor pengembangan karir
                        fakultas/universitas</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f409" value="1" id="cari9"
                        data-group="mencari-pekerjaan" <?php echo ($data['F409'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari9">Menghubungi kantor kemahasiswaan/hubungan alumni</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f410" value="1" id="cari10"
                        data-group="mencari-pekerjaan" <?php echo ($data['F410'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari10">Membangun jejaring (network) sejak masih kuliah</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f411" value="1" id="cari11"
                        data-group="mencari-pekerjaan" <?php echo ($data['F411'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari11">Melalui relasi (misalnya dosen, orang tua, saudara, teman,
                        dll.)</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f412" value="1" id="cari12"
                        data-group="mencari-pekerjaan" <?php echo ($data['F412'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari12">Membangun bisnis sendiri</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f413" value="1" id="cari13"
                        data-group="mencari-pekerjaan" <?php echo ($data['F413'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari13">Melalui penempatan kerja atau magang</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f414" value="1" id="cari14"
                        data-group="mencari-pekerjaan" <?php echo ($data['F414'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari14">Bekerja di tempat yang sama dengan tempat kerja semasa
                        kuliah</label>
                </div>

                <div class="form-check mb-2 d-flex align-items-center gap-2">
                    <input class="form-check-input" type="checkbox" name="f415" value="1" id="cari15"
                        data-group="mencari-pekerjaan" <?php echo ($data['F415'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari15">Lainnya, tuliskan</label>
                </div>
                <div class="mb-4 cariLainnyaInput">
                    <input type="text" class="form-control" name="f416"
                        placeholder="<?php echo htmlspecialchars($data['F1102']) ?>"
                        value="<?php echo htmlspecialchars($data['F1102']) ?>" disabled />
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Jika menurut Anda pekerjaan Anda saat ini tidak sesuai dengan pendidikan Anda,
                    mengapa Anda mengambilnya? Jawaban bisa lebih dari satu.</label>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f1601" value="1" id="alasan1"
                        data-group="penyesuaian-pekerjaan" <?php echo ($data['F1601'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="alasan1">Pertanyaan tidak sesuai; pekerjaan saya sekarang sudah
                        sesuai dengan pendidikan saya.</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f1602" value="1" id="alasan2"
                        data-group="penyesuaian-pekerjaan" <?php echo ($data['F1602'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="alasan2">Saya belum mendapatkan pekerjaan yang lebih
                        sesuai.</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f1603" value="1" id="alasan3"
                        data-group="penyesuaian-pekerjaan" <?php echo ($data['F1603'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="alasan3">Di pekerjaan ini saya memeroleh prospek karir yang
                        baik.</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f1604" value="1" id="alasan4"
                        data-group="penyesuaian-pekerjaan" <?php echo ($data['F1604'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="alasan4">Saya lebih suka bekerja di area pekerjaan yang tidak ada
                        hubungannya dengan pendidikan saya.</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f1605" value="1" id="alasan5"
                        data-group="penyesuaian-pekerjaan" <?php echo ($data['F1605'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="alasan5">Saya dipromosikan ke posisi yang kurang berhubungan dengan
                        pendidikan saya dibanding posisi sebelumnya.</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f1606" value="1" id="alasan6"
                        data-group="penyesuaian-pekerjaan" <?php echo ($data['F1606'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="alasan6">Saya dapat memeroleh pendapatan yang lebih tinggi di
                        pekerjaan ini.</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f1607" value="1" id="alasan7"
                        data-group="penyesuaian-pekerjaan" <?php echo ($data['F1607'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="alasan7">Pekerjaan saya saat ini lebih
                        aman/terjamin/secure.</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f1608" value="1" id="alasan8"
                        data-group="penyesuaian-pekerjaan" <?php echo ($data['F1608'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="alasan8">Pekerjaan saya saat ini lebih menarik.</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f1609" value="1" id="alasan9"
                        data-group="penyesuaian-pekerjaan" <?php echo ($data['F1609'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="alasan9">Pekerjaan saya saat ini lebih memungkinkan saya mengambil
                        pekerjaan tambahan/jadwal yang fleksibel, dll.</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f1610" value="1" id="alasan10"
                        data-group="penyesuaian-pekerjaan" <?php echo ($data['F1610'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="alasan10">Pekerjaan saya saat ini lokasinya lebih dekat dari rumah
                        saya.</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f1611" value="1" id="alasan11"
                        data-group="penyesuaian-pekerjaan" <?php echo ($data['F1611'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="alasan11">Pekerjaan saya saat ini dapat lebih menjamin kebutuhan
                        keluarga saya.</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f1612" value="1" id="alasan12"
                        data-group="penyesuaian-pekerjaan" <?php echo ($data['F1612'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="alasan12">Pada awal meniti karir ini, saya harus menerima pekerjaan
                        yang tidak berhubungan dengan pendidikan saya.</label>
                </div>

                <div class="form-check mb-2 d-flex align-items-center gap-2">
                    <input class="form-check-input" type="checkbox" name="f1613" value="1" id="alasan13"
                        data-group="penyesuaian-pekerjaan" <?php echo ($data['F1613'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="alasan13">Lainnya, tuliskan</label>
                </div>
                <div class="mb-4 alasanLainnyaInput">
                    <input type="text" class="form-control" name="f1614"
                        placeholder="<?php echo htmlspecialchars($data['F1102']) ?>"
                        value="<?php echo htmlspecialchars($data['F1102']) ?>" disabled />
                </div>
            </div>
        </div>
    <?php } ?>
    <!-- Wiraswasta Content End -->

    <!-- Pendidikan Content Start -->
    <?php if ($data['F8'] == 3) { ?>
        <div id="pendidikan-content" class="step-2-content">
            <div class="mb-4">
                <label for="sumber_biaya" class="form-label">Sumber Biaya</label>
                <select id="sumber_biaya" class="form-select" name="F18a" disabled>
                    <option value="<?php echo htmlspecialchars($data['F18A']) ?>" selected disabled>
                        <?php echo htmlspecialchars($data['F18A']) ?>
                    </option>
                </select>
            </div>

            <div class="mb-4">
                <label for="perguruan_tinggi">Perguruan Tinggi</label>
                <input type="text" class="form-control" name="F18b" id="perguruan_tinggi"
                    placeholder="<?php echo htmlspecialchars($data['F18B']) ?>"
                    value="<?php echo htmlspecialchars($data['F18B']) ?>" disabled />
            </div>

            <div class="mb-4">
                <label for="program_studi">Program Studi</label>
                <input type="text" class="form-control" name="F18c" id="program_studi"
                    placeholder="<?php echo htmlspecialchars($data['F18C']) ?>"
                    value="<?php echo htmlspecialchars($data['F18C']) ?>" disabled />
            </div>

            <div class="mb-4">
                <label for="tanggal_masuk">Tanggal Masuk</label>
                <input type="date" class="form-control" name="F18d" id="tanggal_masuk"
                    placeholder="<?php echo htmlspecialchars($data['F18D']) ?>"
                    value="<?php echo htmlspecialchars($data['F18D']) ?>" disabled />
            </div>

            <div class="mb-4">
                <label>Sebutkan sumber dana dalam pembiayaan kuliah?</label>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="F1201" id="sumber_dana1" value="1" <?php echo ($data['F1201'] == 1) ? 'checked' : 'disabled'; ?> />
                    <label class="form-check-label" for="sumber_dana1">Biaya Sendiri</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="F1201" id="sumber_dana2" value="2" <?php echo ($data['F1201'] == 2) ? 'checked' : 'disabled'; ?> />
                    <label class="form-check-label" for="sumber_dana2">Beasiswa ADIK</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="F1201" id="sumber_dana3" value="3" <?php echo ($data['F1201'] == 3) ? 'checked' : 'disabled'; ?> />
                    <label class="form-check-label" for="sumber_dana3">Beasiswa BIDIKMISI</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="F1201" id="sumber_dana4" value="4" <?php echo ($data['F1201'] == 4) ? 'checked' : 'disabled'; ?> />
                    <label class="form-check-label" for="sumber_dana4">Beasiswa PPA</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="F1201" id="sumber_dana5" value="5" <?php echo ($data['F1201'] == 5) ? 'checked' : 'disabled'; ?> />
                    <label class="form-check-label" for="sumber_dana5">Beasiswa AFIRMASI</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="F1201" id="sumber_dana6" value="6" <?php echo ($data['F1201'] == 6) ? 'checked' : 'disabled'; ?> />
                    <label class="form-check-label" for="sumber_dana6">Beasiswa Perusahaan/Swasta</label>
                </div>

                <!-- Opsi Lainnya dengan input text -->
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="F1201" id="sumber_dana7" value="7" <?php echo ($data['F1201'] == 7) ? 'checked' : 'disabled'; ?> />
                    <label class="form-check-label" for="sumber_dana7">Lainnya, tuliskan</label>
                </div>

                <div class="mb-4 danaLainnyaInput">
                    <input type="text" class="form-control" name="f1202"
                        placeholder="<?php echo htmlspecialchars($data['F1202']) ?>"
                        value="<?php echo htmlspecialchars($data['F1202']) ?>" disabled />
                </div>
            </div>
        </div>
    <?php } ?>
    <!-- Pendidikan Content End -->

    <!-- Mencari Kerja Content Start -->
    <?php if ($data['F8'] == 4) { ?>
        <div id="mencari-kerja-content" class="step-2-content">
            <div class="mb-4">
                <label class="form-label">Kapan Anda mulai mencari pekerjaan? Mohon pekerjaan sambilan tidak
                    dimasukkan</label>

                <div class="form-check mb-2 d-flex align-items-center gap-2">
                    <input class="form-check-input" type="radio" name="f301" value="1" id="cariKerja1" <?php echo ($data['F301'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cariKerja1">Kira-kira</label>
                    <input type="number" class="form-control form-control-sm w-auto" name="f302" min="0"
                        placeholder="<?php echo htmlspecialchars($data['F302']) ?>"
                        value="<?php echo htmlspecialchars($data['F302']) ?>" disabled>
                    Bulan sebelum lulus
                </div>

                <div class="form-check mb-2 d-flex align-items-center gap-2">
                    <input class="form-check-input" type="radio" name="f301" value="2" id="cariKerja2" <?php echo ($data['F301'] == 2) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cariKerja2">Kira-kira</label>
                    <input type="number" class="form-control form-control-sm w-auto" name="f303" min="0"
                        placeholder="<?php echo htmlspecialchars($data['F303']) ?>"
                        value="<?php echo htmlspecialchars($data['F303']) ?>" disabled>
                    Bulan sesudah lulus
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="f301" value="3" id="cariKerja3" <?php echo ($data['F301'] == 3) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cariKerja3">Saya tidak mencari kerja</label>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Bagaimana Anda mencari pekerjaan tersebut?</label>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f401" value="1" id="cari1"
                        data-group="mencari-pekerjaan" <?php echo ($data['F401'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari1">Melalui koran/majalah/brosur</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f402" value="1" id="cari2"
                        data-group="mencari-pekerjaan" <?php echo ($data['F402'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari2">Melamar ke perusahaan tanpa mengetahui lowongan yang
                        ada</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f403" value="1" id="cari3"
                        data-group="mencari-pekerjaan" <?php echo ($data['F403'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari3">Pergi ke bursa/pameran kerja</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f404" value="1" id="cari4"
                        data-group="mencari-pekerjaan" <?php echo ($data['F404'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari4">Mencari lewat internet/iklan online/milis</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f405" value="1" id="cari5"
                        data-group="mencari-pekerjaan" <?php echo ($data['F405'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari5">Dihubungi oleh perusahaan</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f406" value="1" id="cari6"
                        data-group="mencari-pekerjaan" <?php echo ($data['F406'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari6">Menghubungi Kemenakertrans</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f407" value="1" id="cari7"
                        data-group="mencari-pekerjaan" <?php echo ($data['F407'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari7">Menghubungi agen tenaga kerja komersial/swasta</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f408" value="1" id="cari8"
                        data-group="mencari-pekerjaan" <?php echo ($data['F408'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari8">Memeroleh informasi dari pusat/kantor pengembangan karir
                        fakultas/universitas</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f409" value="1" id="cari9"
                        data-group="mencari-pekerjaan" <?php echo ($data['F409'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari9">Menghubungi kantor kemahasiswaan/hubungan alumni</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f410" value="1" id="cari10"
                        data-group="mencari-pekerjaan" <?php echo ($data['F410'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari10">Membangun jejaring (network) sejak masih kuliah</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f411" value="1" id="cari11"
                        data-group="mencari-pekerjaan" <?php echo ($data['F411'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari11">Melalui relasi (misalnya dosen, orang tua, saudara, teman,
                        dll.)</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f412" value="1" id="cari12"
                        data-group="mencari-pekerjaan" <?php echo ($data['F412'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari12">Membangun bisnis sendiri</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f413" value="1" id="cari13"
                        data-group="mencari-pekerjaan" <?php echo ($data['F413'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari13">Melalui penempatan kerja atau magang</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="f414" value="1" id="cari14"
                        data-group="mencari-pekerjaan" <?php echo ($data['F414'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari14">Bekerja di tempat yang sama dengan tempat kerja semasa
                        kuliah</label>
                </div>

                <div class="form-check mb-2 d-flex align-items-center gap-2">
                    <input class="form-check-input" type="checkbox" name="f415" value="1" id="cari15"
                        data-group="mencari-pekerjaan" <?php echo ($data['F415'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="cari15">Lainnya, tuliskan</label>
                </div>
                <div class="mb-4 cariLainnyaInput">
                    <input type="text" class="form-control" name="f416"
                        placeholder="<?php echo htmlspecialchars($data['F1102']) ?>"
                        value="<?php echo htmlspecialchars($data['F1102']) ?>" disabled />
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Berapa perusahaan/instansi/institusi yang sudah Anda lamar (lewat surat/email)
                    sebelum memperoleh pekerjaan pertama?</label>
                <input type="number" class="form-control" name="f6"
                    placeholder="<?php echo htmlspecialchars($data['F6']) ?>"
                    value="<?php echo htmlspecialchars($data['F6']) ?>" disabled min="0" />
            </div>

            <div class="mb-4">
                <label class="form-label">Berapa banyak perusahaan/instansi/institusi yang merespons lamaran Anda?</label>
                <input type="number" class="form-control" name="f7"
                    placeholder="<?php echo htmlspecialchars($data['F7']) ?>"
                    value="<?php echo htmlspecialchars($data['F7']) ?>" disabled min="0" />
            </div>

            <div class="mb-4">
                <label class="form-label">Berapa banyak perusahaan/instansi/institusi yang mengundang Anda untuk
                    wawancara?</label>
                <input type="number" class="form-control" name="f7a"
                    placeholder="<?php echo htmlspecialchars($data['F7A']) ?>"
                    value="<?php echo htmlspecialchars($data['F7A']) ?>" disabled min="0" />
            </div>

            <div class="mb-4">
                <label class="form-label">Berapa perusahaan/instansi yang telah Anda masuki untuk bekerja?</label>
                <input type="number" class="form-control" name="UMC4"
                    placeholder="<?php echo htmlspecialchars($data['UMC4']) ?>"
                    value="<?php echo htmlspecialchars($data['UMC4']) ?>" disabled min="0" />
            </div>

            <div class="mb-4">
                <label class="form-label">Apakah Anda aktif mencari pekerjaan dalam 4 minggu terakhir? Pilihlah satu
                    jawaban</label>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="f1001" value="1" id="Kerja1" <?php echo ($data['F1001'] == 1) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="Kerja1">Tidak</label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="f1001" value="2" id="Kerja2" <?php echo ($data['F1001'] == 2) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="Kerja2">Tidak, tapi saya sedang menunggu hasil lamaran
                        kerja</label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="f1001" value="3" id="Kerja3" <?php echo ($data['F1001'] == 3) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="Kerja3">Ya, saya akan mulai bekerja dalam 2 minggu ke
                        depan</label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="f1001" value="4" id="Kerja4" <?php echo ($data['F1001'] == 4) ? 'checked' : 'disabled'; ?>>
                    <label class="form-check-label" for="Kerja4">Ya, tapi saya belum pasti akan bekerja dalam 2 minggu
                        ke depan</label>
                </div>
            </div>
        </div>
    <?php } ?>
    <!-- Mencari Kerja Content End -->

    <!-- Tidak Bekerja Content Start -->
    <?php if ($data['F8'] == 5) { ?>
        <div id="tidak-bekerja-content" class="step-2-content">
            <label>Mengapa Anda belum memungkinkan untuk bekerja?</label>
            <input type="text" class="form-control" name="UMC5" placeholder="<?php echo htmlspecialchars($data['UMC5']); ?>"
                value="<?php echo htmlspecialchars($data['UMC5']); ?>" disabled />
        </div>
    <?php } ?>
    <!-- Tidak Bekerja Content End -->
</section>