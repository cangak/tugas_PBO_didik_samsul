<?php ?>
<h2><?= $data['title']; ?></h2>
<div class="card">
    <div class="card-body">
<h2><?= $data['title']; ?></h2>
<form action="<?= BASEURL; ?>/user/store" method="post">
    <label>Nama:</label><br>
    <input type="text" name="nama" required><br><br>

    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Simpan</button>
</form>
    </div></div>