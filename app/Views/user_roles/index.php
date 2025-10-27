<div class="page-heading">
    <h3><?= htmlspecialchars($title) ?></h3>
</div>

<a href="<?= BASEURL ?>/userRole/tambah" class="btn btn-primary mb-3">+ Tambah User Role</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama User</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($user_roles as $i => $ur): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= htmlspecialchars($ur['user_nama']) ?></td>
                <td><?= htmlspecialchars($ur['role_nama']) ?></td>
                <td>
                    <a href="<?= BASEURL ?>/userRole/delete/<?= $ur['user_id'] ?>/<?= $ur['role_id'] ?>"
                       onclick="return confirm('Yakin ingin menghapus role dari user ini?')"
                       class="btn btn-sm btn-danger">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
