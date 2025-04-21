<h3>Step 1: Status Anda</h3>
<section>
    <label class="mb-3 form-label">Jelaskan status anda saat ini?<span class="text-danger"> *(Wajib
            diisi)</span></label>

    <div class="form-check mb-3">
        <input class="form-check-input" id="bekerja" type="radio" name="F8" value="1" <?php echo ($data['F8'] == 1) ? 'checked' : 'disabled'; ?> />
        <label class="form-check-label" for="bekerja">Bekerja</label>
    </div>
    <div class="form-check mb-3">
        <input class="form-check-input" id="wiraswasta" type="radio" name="F8" value="2" <?php echo ($data['F8'] == 2) ? 'checked' : 'disabled'; ?> />
        <label class="form-check-label" for="wiraswasta">Wiraswasta</label>
    </div>
    <div class="form-check mb-3">
        <input class="form-check-input" id="pendidikan" type="radio" name="F8" value="3" <?php echo ($data['F8'] == 3) ? 'checked' : 'disabled'; ?> />
        <label class="form-check-label" for="pendidikan">Melanjutkan Pendidikan</label>
    </div>
    <div class="form-check mb-3">
        <input class="form-check-input" id="mencari-kerja" type="radio" name="F8" value="4" <?php echo ($data['F8'] == 4) ? 'checked' : 'disabled'; ?> />
        <label class="form-check-label" for="mencari-kerja">Tidak kerja, sedang mencari kerja</label>
    </div>
    <div class="form-check mb-3">
        <input class="form-check-input" id="belum-bekerja" type="radio" name="F8" value="5" <?php echo ($data['F8'] == 5) ? 'checked' : 'disabled'; ?> />
        <label class="form-check-label" for="belum-bekerja">Belum memungkinkan bekerja</label>
    </div>
</section>