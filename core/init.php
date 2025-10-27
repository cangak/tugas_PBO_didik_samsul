<?php
// core/init.php - bootstrap
$config = require __DIR__ . '/../config/config.php';
define('BASEURL', $config['base_url']);


/* penjelasan autloloader:
andai kita punya rumah dengan berbagai komponen(class), pintu, cendela,atap,dinding, dindingDapur,ddindinKamar, dll.
dengan cara lama kita harus require_once tiap komponen satu satu, misal require_once 'pintu.php', require_once 'jendela.php', require_once 'atap.php', require_once 'dinding.php', require_once 'dindingDapur.php', require_once 'dindingKamar.php', dll.
dengan autoloader, cukuo di definisaikan dimana letak file2 komponen tersebut, dan ketika perlu tinggal apnggil nama
new Pintu(), new Jendela(), new Atap(), new Dinding(), new DindingDapur(), new DindingKamar(), dll.
tanpa harus require_once satu satu.php sudah otomatis mencari file yang diperlukan.
*/
spl_autoload_register(function($class){
    $paths = [
        __DIR__ . '/' . $class . '.php',
        __DIR__ . '/../app/Controllers/' . $class . '.php',
        __DIR__ . '/../app/Models/' . $class . '.php',
        __DIR__ . '/../app/Helpers/Flasher.php',
        __DIR__ . '/../app/Helpers/AuthHelper.php',

    ];
    foreach($paths as $p) if(file_exists($p)) require_once $p;
});
