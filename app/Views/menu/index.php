<h2>Daftar Menu</h2>
<a href="<?= BASEURL ?>/menu/tambah" class="btn btn-primary mb-3">+ Tambah Menu</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Parent</th>
            <th>URL</th>
            <th>Ikon</th>
            <th>Urutan</th>
            <th>Aktif</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['menus'] as $m): ?>
        <tr>
            <td><?= $m['id'] ?></td>
            <td><?= htmlspecialchars($m['title']) ?></td>
            <td><?= $m['parent_id'] ?></td>
            <td><?= htmlspecialchars($m['url']) ?></td>
            <td><i class="<?= htmlspecialchars($m['icon']) ?>"></i></td>
            <td><?= $m['order_no'] ?></td>
            <td><?= $m['is_active'] ? 'Ya' : 'Tidak' ?></td>
            <td>
                <a href="<?= BASEURL ?>/menu/edit/<?= $m['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="<?= BASEURL ?>/menu/delete/<?= $m['id'] ?>" class="btn btn-sm btn-danger" onclick="confirmModal(event)">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
