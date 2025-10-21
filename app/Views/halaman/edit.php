<?php ?>
<h1><?= $data['title'] ?></h1>
<form method="post" action="<?= BASEURL ?>/halaman/update/<?= $data['halaman']['id'] ?>" enctype="multipart/form-data">
    <div class="mb-3">
        <label>Judul Halaman</label>
        <input type="text" name="judul_halaman" class="form-control" value="<?= $data['halaman']['judul_halaman'] ?>" required>
    </div>
    <div class="mb-3">
        <label>Konten Halaman</label>
        <textarea name="konten_halaman" class="form-control" rows="5" required><?= $data['halaman']['konten_halaman'] ?></textarea>
    </div>
    <div class="mb-3">
        <label>Gambar</label>
        <?php if ($data['halaman']['gambar']): ?>
            <img src="<?= BASEURL ?>/uploads/<?= $data['halaman']['gambar'] ?>" width="100"><br>
        <?php endif; ?>
        <input type="file" name="gambar" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="<?= BASEURL ?>/halaman" class="btn btn-secondary">Batal</a>
</form>