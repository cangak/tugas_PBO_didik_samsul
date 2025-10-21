<?php
class Halaman
{
    private $db;
    public function __construct() {
        $this->db = new Database();
    }
    public function getAll() {
        $this->db->query("SELECT halaman.*, users.nama as nama_user FROM halaman LEFT JOIN users ON users.id = halaman.user_id");
        return $this->db->resultSet();
    }
    public function getById($id) {
        $this->db->query("SELECT * FROM halaman WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    public function tambah($data) {
        $this->db->query("INSERT INTO halaman (judul_halaman, konten_halaman, gambar, user_id) VALUES (:judul_halaman, :konten_halaman, :gambar, :user_id)");
        $this->db->bind(':judul_halaman', $data['judul_halaman']);
        $this->db->bind(':konten_halaman', $data['konten_halaman']);
        $this->db->bind(':gambar', $data['gambar']);
        $this->db->bind(':user_id', $data['user_id']);
        return $this->db->execute();
    }
    public function update($id, $data) {
        $this->db->query("UPDATE halaman SET judul_halaman = :judul_halaman, konten_halaman = :konten_halaman, gambar = :gambar, user_id = :user_id WHERE id = :id");
        $this->db->bind(':judul_halaman', $data['judul_halaman']);
        $this->db->bind(':konten_halaman', $data['konten_halaman']);
        $this->db->bind(':gambar', $data['gambar']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
    public function delete($id) {
        $this->db->query("DELETE FROM halaman WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function countHalaman()
{
    $this->db->query("SELECT COUNT(*) as total FROM halaman");
    return $this->db->single()['total'];
}
}