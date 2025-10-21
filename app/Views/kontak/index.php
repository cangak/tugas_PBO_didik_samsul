<h1 class="mb-4"><?= $data['title'] ?></h1>
<a href="<?= BASEURL ?>/kontak/tambah" class="btn btn-primary mb-3">Tambah Kontak</a>
<div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>No HP</th>
                <th>Status</th>
                <th>Created By</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($data['kontak'] as $k): ?>
            <tr>
                <td><?= $k['id'] ?></td>
                <td><?= $k['nama'] ?></td>
                <td><?= $k['nomor_hp'] ?></td>
                <td>
                    <span class="badge <?= $k['status'] === 'AKTIF' ? 'bg-success' : 'bg-secondary' ?>">
                        <?= $k['status'] ?>
                    </span>
                </td>
                <td><?= $k['nama_user'] ?></td>
                <td>
                    <a class="btn btn-warning btn-sm" href="<?= BASEURL ?>/kontak/edit/<?= $k['id'] ?>">Edit</a>
                    <a class="btn btn-danger btn-sm" href="<?= BASEURL ?>/kontak/delete/<?= $k['id'] ?>" onclick="confirmModal(event)">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>