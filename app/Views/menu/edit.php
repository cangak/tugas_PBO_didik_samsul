<h2>Edit Menu</h2>
<form action="<?= BASEURL ?>/menu/update/<?= $data['menu']['id'] ?>" method="POST">
    <label>Judul Menu</label>
    <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($data['menu']['title']) ?>" required>

    <label>Parent</label>
    <select name="parent_id" class="form-control">
        <option value="">-- Tidak ada --</option>
        <?php foreach ($data['parents'] as $p): ?>
            <option value="<?= $p['id'] ?>" <?= $p['id'] == $data['menu']['parent_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($p['title']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Ikon</label>
    <input type="text" name="icon" class="form-control" value="<?= htmlspecialchars($data['menu']['icon']) ?>">

    <label>URL</label>
    <input type="text" name="url" class="form-control" value="<?= htmlspecialchars($data['menu']['url']) ?>">

    <label>Urutan</label>
    <input type="number" name="order_no" class="form-control" value="<?= $data['menu']['order_no'] ?>">

    <label>Role Access</label>
    <input type="text" name="role_access" class="form-control" value="<?= htmlspecialchars($data['menu']['role_access']) ?>">

    <label>Aktif?</label>
    <select name="is_active" class="form-control">
        <option value="1" <?= $data['menu']['is_active'] ? 'selected' : '' ?>>Ya</option>
        <option value="0" <?= !$data['menu']['is_active'] ? 'selected' : '' ?>>Tidak</option>
    </select>

    <button type="submit" class="btn btn-primary mt-3">Update</button>
</form>
