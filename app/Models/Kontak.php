<?php
class Kontak
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllKontak()
    {
        $this->db->query("SELECT kontak.*, users.nama as nama_user FROM kontak LEFT JOIN users ON users.id = kontak.user_id");
        return $this->db->resultSet();
    }

    public function getKontakById($id)
    {
        $this->db->query("SELECT kontak.*, users.nama as nama_user FROM kontak LEFT JOIN users ON users.id = kontak.user_id WHERE kontak.id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function updateKontak($id, $data)
    {
        $this->db->query("UPDATE kontak SET nama = :nama, nomor_hp = :nomor_hp, status = :status, user_id= :user_id WHERE id = :id");
        $this->db->bind(':nama', $data['nama']);
        $this->db->bind(':nomor_hp', $data['nomor_hp']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':user_id', $_SESSION['id']);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function deleteKontak($id)
    {
        $this->db->query("DELETE FROM kontak WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function tambahKontak($data)
    {
        $this->db->query("INSERT INTO kontak (nama, nomor_hp, status, user_id) VALUES (:nama, :nomor_hp, :status, :user_id)");
        $this->db->bind(':nama', $data['nama']);
        $this->db->bind(':nomor_hp', $data['nomor_hp']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':user_id', $data['user_id']);
        return $this->db->execute();
    }

    public function countKontak()
    {
        $this->db->query("SELECT COUNT(*) as total FROM kontak");
        return $this->db->single()['total'];
    }
}