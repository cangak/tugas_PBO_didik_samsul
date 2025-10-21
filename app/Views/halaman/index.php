<?php ?>
<h1><?= $data['title'] ?></h1>
<a href="<?= BASEURL ?>/halaman/tambah" class="btn btn-primary mb-3">Tambah Halaman</a>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>ID</th>
      <th>Judul</th>
      <th>Gambar</th>
      <th>Kontens</th>
      <th>User</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data['halaman'] as $h): ?>
      <tr>
        <td><?= $h['id'] ?></td>
        <td><?= $h['judul_halaman'] ?></td>
        <td>
          <?php if ($h['gambar']): ?>
            <a href="#" class="pop">

              <img class="imageresource" src="<?= BASEURL ?>/uploads/<?= $h['gambar'] ?>" width="80">
            </a>
          <?php endif; ?>
        </td>
        <td width="30%"><?= substr($h['konten_halaman'], 0, 50) . '...'; ?></td>

        <td><?= $h['nama_user'] ?></td>
        <td>
          <a href="<?= BASEURL ?>/halaman/edit/<?= $h['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
          <a href="<?= BASEURL ?>/halaman/delete/<?= $h['id'] ?>" class="btn btn-danger btn-sm" onclick="confirmModal(event)">Delete</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>



<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <img src="" id="imagepreview" style="width: 100%;">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
  $(".pop").on("click", function() {
    let img = $(this).find('.imageresource').attr('src');
    $('#imagepreview').attr('src', img); // here asign the image to the modal when the user click the enlarge link
    $('#imagemodal').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
  });
</script>