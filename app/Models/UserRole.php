<?php

class UserRole
{
    private $db;

    public function __construct()
    {
        $this->db = new Database(); // asumsi kamu punya Database wrapper (PDO)
    }

    public function getAll()
    {
        $query = "
            SELECT ur.user_id, ur.role_id, u.nama AS user_nama, r.nama AS role_nama
            FROM user_roles ur
            JOIN users u ON ur.user_id = u.id
            JOIN roles r ON ur.role_id = r.id
            ORDER BY u.nama
        ";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function tambah($data)
    {
        $query = "INSERT INTO user_roles (user_id, role_id) VALUES (:user_id, :role_id)";
        $this->db->query($query);
        $this->db->bind('user_id', $data['user_id']);
        $this->db->bind('role_id', $data['role_id']);
        return $this->db->execute();
    }

    public function hapus($user_id, $role_id)
    {
        $query = "DELETE FROM user_roles WHERE user_id = :user_id AND role_id = :role_id";
        $this->db->query($query);
        $this->db->bind('user_id', $user_id);
        $this->db->bind('role_id', $role_id);
        return $this->db->execute();
    }

    public function exists($user_id, $role_id)
    {
        $query = "SELECT COUNT(*) AS cnt FROM user_roles WHERE user_id = :user_id AND role_id = :role_id";
        $this->db->query($query);
        $this->db->bind('user_id', $user_id);
        $this->db->bind('role_id', $role_id);
        $row = $this->db->single();
        return $row && $row['cnt'] > 0;
    }
}
