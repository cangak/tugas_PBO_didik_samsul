<?php ?>
<h2><?= $data['title']; ?></h2>
<div class="card">
    <div class="card-body">

<form action="<?= BASEURL; ?>/user/update/<?= $data['user']['id']; ?>" method="post">
      <div class="form-floating mb-3">
                <input class="form-control" id="nama" type="text" name="nama" value="<?= htmlspecialchars($data['user']['nama']); ?>">
                <label for="nama" class="form-label">Nama</label>
          
            </div>
      <div class="form-floating mb-3">
     <input class="form-control" id="username" type="text" name="username" value="<?= htmlspecialchars($data['user']['username']); ?>">

    <label for="username" class="form-label" >Username:</label><br>
 
    </div>
     <div class="form-floating mb-3">
     <input class="form-control" id="password" type="password" name="password">

    <label for="password" class="form-label" >Password (kosongkan jika tidak ingin diubah):</label><br>
 
    </div>

    <div class="mb-3">

            <button class="btn btn-primary" type="submit">Update</button>
            <a href="<?= BASEURL ?>/user" class="btn btn-secondary">Batal</a>

             </div></form>
</div>
</div>