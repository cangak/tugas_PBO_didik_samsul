<h2>Tambah Menu</h2>
<form action="<?= BASEURL ?>/menu/store" method="POST">
    <label>Judul Menu</label>
    <input type="text" name="title" class="form-control" required>

    <label>Parent</label>
    <select name="parent_id" class="form-control">
        <option value="">-- Tidak ada --</option>
        <?php foreach ($data['parents'] as $p): ?>
            <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['title']) ?></option>
        <?php endforeach; ?>
    </select>

    <label>Ikon (Bootstrap Icon class)</label>
    <input type="text" name="icon" class="form-control" placeholder="bi bi-person-fill">

    <label>URL</label>
    <input type="text" name="url" class="form-control" placeholder="/kontak">

    <label>Urutan</label>
    <input type="number" name="order_no" class="form-control" value="0">

    <label>Role Access</label>
    <input type="text" name="role_access" class="form-control" placeholder="admin,user">

    <label>Aktif?</label>
    <select name="is_active" class="form-control">
        <option value="1">Ya</option>
        <option value="0">Tidak</option>
    </select>

    <button type="submit" class="btn btn-success mt-3">Simpan</button>
</form>
