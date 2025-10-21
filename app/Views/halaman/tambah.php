<?php ?>
<h1><?= $data['title'] ?></h1>
<form method="post" action="<?= BASEURL ?>/halaman/store" enctype="multipart/form-data">
    <div class="mb-3">
        <label>Judul Halaman</label>
        <input type="text" name="judul_halaman" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Konten Halaman</label>
        <textarea name="konten_halaman" class="form-control" rows="5" required></textarea>
    </div>
    <div class="mb-3">
        <label>Gambar</label>
        <input type="file" name="gambar" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="<?= BASEURL ?>/halaman" class="btn btn-secondary">Batal</a>
</form>