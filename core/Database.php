<?php
// class untuk akses database dengan PDO
class Database {
    // properti untuk koneksi dan statement
    protected $dbh;
    protected $stmt;

    public function __construct(){
        // load konfigurasi dari confi.php
        $cfg = require __DIR__ . '/../config/config.php';
        $dsn = "mysql:host={$cfg['db_host']};dbname={$cfg['db_name']};charset=utf8mb4";
        try {
            $this->dbh = new PDO($dsn, $cfg['db_user'], $cfg['db_pass'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch (PDOException $e) {
            die('DB Connection failed: ' . $e->getMessage());
        }
    }
    //method untuk query, bind, execute, fetchAll, fetch, lastInsertId
    public function query($sql){ $this->stmt = $this->dbh->prepare($sql); }
    public function bind($param, $value, $type = null){
        if(is_null($type)) $type = is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR;
        $this->stmt->bindValue($param, $value, $type);
    }
    public function execute(){ return $this->stmt->execute(); }
    public function resultSet(){ $this->execute(); return $this->stmt->fetchAll(); }
    public function single(){ $this->execute(); return $this->stmt->fetch(); }
    public function lastInsertId(){ return $this->dbh->lastInsertId(); }
}
