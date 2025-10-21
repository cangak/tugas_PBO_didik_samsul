<?php ?>
<h1><?= $title ?></h1>
<div class="card">
    <div class="card-body">
        <form method="POST" action="<?= BASEURL ?>/kontak/update/<?= $data['kontak']['id'] ?>">
             <div class="form-floating mb-3">
                <input class="form-control" id="nama" type="text" name="nama" value="<?= $data['kontak']['nama'] ?>">
                <label for="nama" class="form-label">Nama</label>
          
            </div>

             <div class="form-floating mb-3">
                    <input class="form-control" id="no_hp" type="text" name="nomor_hp" value="<?= $data['kontak']['nomor_hp'] ?>">
                <label for="no_hp" class="form-label">no Hp: </label>
           
                </div>
             <div class="form-floating mb-3">


                <select class="form-control" id="status" name="status" id="cars">
                    <option value="AKTIF" <?= $data['kontak']['status'] == 'AKTIF' ? 'selected' : '' ?>>AKTIF</option>
                    <option value="TIDAK" <?= $data['kontak']['status'] == 'TIDAK' ? 'selected' : '' ?>>TIDAK</option>
                </select>
                <label for="status" class="form-label">Status: </label>
            
            </div>
             <div class="mb-3">

            <button class="btn btn-primary" type="submit">Update</button>
            <a href="<?= BASEURL ?>/kontak" class="btn btn-secondary">Batal</a>

             </div>
        </form>
    </div>
</div>