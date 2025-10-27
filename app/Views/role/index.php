<div class="page-heading">
    <h3>Manajemen Role</h3>
</div>

<a href="<?= BASEURL ?>/role/create" class="btn btn-primary mb-3">+ Tambah Role</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Deskripsi</th>
            <th>Dibuat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($roles as $i => $role): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= htmlspecialchars($role['nama']) ?></td>
                <td><?= htmlspecialchars($role['deskripsi'] ?? '-') ?></td>
                <td><?= htmlspecialchars($role['created_at']) ?></td>
                <td>
                    <a href="<?= BASEURL ?>/role/edit/<?= $role['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="<?= BASEURL ?>/role/delete/<?= $role['id'] ?>" 
                       onclick="confirmModal(event)"
                       class="btn btn-sm btn-danger">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
