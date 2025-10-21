dikarenakan framework ini berjalan tanpa .htaccess dan berdasarkan explode() query string
tes.co/query1/query2/query3
perlu vhost atau belum bisa dalam sub folder.

1. edit config/config.php
ubah sesuai.
BAGIAN base url belum bisa dalam subfolder
'base_url' => 'http://didik_samsul_refactor.test', 

user : lalapo
pass : lalapo


app/
  Controllers/
    ErrorController.php
    HalamanController.php
    HomeController.php
    KontakController.php
    LoginController.php
  Helpers/
    Flasher.php
  Models/
    Halaman.php
    Kontak.php
    Login.php
  Views/
    home.php
    halaman/
    kontak/
    layouts/
    login/
assets/
  compiled/
  extensions/
  static/
config/
  config.php
core/
  App.php
  Controller.php
  Database.php
  init.php
database/
  tugas_web_dinamis.sql
public/
  index.php
  assets/
  uploads/


Controllers : Tempat file controller (logika tiap modul/page).
Models : Tempat file model (akses data/database).
Views : Tempat file view (tampilan/page).
Helpers : Helper/utility.
assets : Asset frontend (CSS, JS, font, dll).
config : Konfigurasi aplikasi.
core : File inti framework (routing, database, dsb).
database : File SQL untuk inisialisasi database.
public : Root web server (akses utama aplikasi).

penambahan modul
```php
<?php
<!-- filepath: app/Controller/ProdukController.php -->
class ProdukController extends Controller {
    public function index() {
        $data['judul'] = 'Daftar Produk';
        $data['produk'] = $this->model('Produk')->getAll();
        $this->view('produk/index', $data);
    }
}
```
```php
<?php
<!-- afilepath : pp/Model/Produk.php -->
class Produk {
    public function getAll() {
        // Query ke database
        // return array data produk
    }
}
```
```php
<?php
<!-- filepath: app/Views/produk/index.php -->
<h1><?= $judul ?></h1>
<ul>
<?php foreach($produk as $p): ?>
  <li><?= $p['nama'] ?></li>
<?php endforeach; ?>
</ul>
```