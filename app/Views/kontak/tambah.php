<?php ?>
<h1>Tambah Kontak</h1>
<div class="card">
    <div class="card-body">
        <form method="post" action="<?= BASEURL ?>/kontak/store">
             <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nama" name="nama" required>
                        <label for="nama">Nama Kontak</label>
                    </div>
                       <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="nomor_hp"  name="nomor_hp" required>
                        <label for="nomor_hp">Nomor Kontak</label>
                    </div>
           
                    <div class="form-floating mb-3">
                <select class="form-select" id="status" name="status">
                    <option value="AKTIF">Aktif</option>
                    <option value="TIDAK">Nonaktif</option>
                </select>
                <label for="status" class="form-label">Status</label>

            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= BASEURL ?>/kontak" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
</form>