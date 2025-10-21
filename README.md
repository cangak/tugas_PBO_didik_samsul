dikarenakan framework ini berjalan tanpa .htaccess dan berdasarkan explode() query string
tes.co/query1/query2/query3
perlu vhost atau belum bisa dalam sub folder.

1. edit config/config.php
ubah sesuai.
BAGIAN base url belum bisa dalam subfolder
'base_url' => 'http://tugas-oop.test', 
2. untuk pembuatan host pada OS windows bisa edit file C:\Windows\System32\drivers\etc\hosts
  dengan klik kanan  notepad Run as administrator
  lalu file -> open -> C:\Windows\System32\drivers\etc\hosts
  127.0.0.1  http://tugas-oop.test
  maka ketika kita membuka http://tugas-oop.test sama dengan membuka http://localhost/
untuk konfigurasi xampp 
C:\xampp\apache\conf\extra\httpd-vhosts.conf
<VirtualHost *:80>
    ServerAdmin webmaster@project1.local
    DocumentRoot "C:/xampp/htdocs/project1"
    ServerName http://tugas-oop.test
    ErrorLog "logs/project1-error.log"
    CustomLog "logs/project1-access.log" common
</VirtualHost>

jangan lupa C:\xampp\apache\conf\httpd.conf
cari 
#Include conf/extra/httpd-vhosts.conf
buang tanda # menjadi
Include conf/extra/httpd-vhosts.conf
restart apache

sedangkan untuk linux / mac bisa pada /etc/hosts

3. login
user : lalapo
pass : lalapo

4. noted tambahan
field role dan user_role untuk pemrograman framework


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

