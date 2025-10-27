<h2>Tambah Menu</h2>
<form action="<?= BASEURL ?>/role/update/<?= $data['role']['id'] ?>" method="POST">

    <label>Nama Role</label>
    <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($data['role']['nama']) ?>" required>

    <label>Deskripsi</label>
    <input type="text" name="deskripsi" class="form-control" value="<?= htmlspecialchars($data['role']['deskripsi']) ?>">
    <button type="submit" class="btn btn-success mt-3">Simpan</button>
</form>
