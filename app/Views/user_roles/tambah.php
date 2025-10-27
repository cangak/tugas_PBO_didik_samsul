<h3><?= htmlspecialchars($title) ?></h3>

<form action="<?= BASEURL ?>/userrole/store" method="POST">
    <div class="form-group mb-3">
        <label for="user_id">Pilih User</label>
        <select name="user_id" id="user_id" class="form-control" required>
            <option value="">-- Pilih User --</option>
            <?php foreach ($users as $user): ?>
                <option value="<?= $user['id'] ?>"><?= htmlspecialchars($user['nama']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group mb-3">
        <label for="role_id">Pilih Role</label>
        <select name="role_id" id="role_id" class="form-control" required>
            <option value="">-- Pilih Role --</option>
            <?php foreach ($roles as $role): ?>
                <option value="<?= $role['id'] ?>"><?= htmlspecialchars($role['nama']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="<?= BASEURL ?>/userrole" class="btn btn-secondary">Kembali</a>
</form>
