<?php
// FULL DEBUG ERROR
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once __DIR__ . '/../core/init.php'; //autoloader
require_once __DIR__ . '/../core/App.php'; //routing
require_once __DIR__ . '/../core/Controller.php'; //base conteroller
require_once __DIR__ . '/../core/Database.php'; //database
$app = new App();
echo $class;


