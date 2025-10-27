<?php
class Role
{
     private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAll()
    {
        $this->db->query("SELECT * FROM roles ORDER BY id DESC");
        return $this->db->resultSet();
    }

    public function getById($id)
    {
        $this->db->query("SELECT * FROM roles WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function store($data)
    {
        $query = "INSERT INTO roles (nama, deskripsi) VALUES (:nama, :deskripsi)";
        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('deskripsi', $data['deskripsi']);
        return $this->db->execute();
    }

    public function update($data)
    {
        $query = "UPDATE roles SET nama = :nama, deskripsi = :deskripsi WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('deskripsi', $data['deskripsi']);
        $this->db->bind('id', $data['id']);
        return $this->db->execute();
    }

    public function delete($id)
    {
        $this->db->query("DELETE FROM roles WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->execute();
    }
}
