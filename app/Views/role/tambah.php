<h2>Tambah Menu</h2>
<form action="<?= BASEURL ?>/role/store" method="POST">
    <label>Nama Role</label>
    <input type="text" name="nama" class="form-control" required>

    <label>Deskripsi</label>
    <input type="text" name="deskripsi" class="form-control" placeholder="">
    <button type="submit" class="btn btn-success mt-3">Simpan</button>
</form>
