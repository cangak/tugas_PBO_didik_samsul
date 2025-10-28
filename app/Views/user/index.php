<h1 class="mb-4"><?= $data['title'] ?></h1>

<a href="<?= BASEURL ?>/user/tambah" class="btn btn-primary mb-3">Tambah User</a>

<div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Role</th>
                <th>Dibuat Oleh</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($data['users'] as $u): 
            $isAdmin = AuthHelper::role() === 'admin';
        ?>
            <tr>
                <td><?= $u['id'] ?></td>
                <td><?= htmlspecialchars($u['nama']) ?></td>
                <td><?= htmlspecialchars($u['username']) ?></td>
                <td>
                <span class="badge <?= AuthHelper::getRoleByUserId($u['id']) === 'admin' ? 'bg-primary' : 'bg-secondary' ?>">
                        <?= AuthHelper::getRoleByUserId($u['id']) ?>

            </span>

                </td>
                <td><?= htmlspecialchars($u['created_by'] ?? '-') ?></td>
                <td>
                    <?php if ($isAdmin): ?>
                        <a class="btn btn-warning btn-sm" href="<?= BASEURL ?>/user/edit/<?= $u['id'] ?>">Edit</a>
                        <a class="btn btn-danger btn-sm" href="<?= BASEURL ?>/user/delete/<?= $u['id'] ?>" onclick="confirmModal(event)">Hapus</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
