<?php

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database(); // Asumsi kamu sudah punya class Database (PDO wrapper)
    }

    /**
     * Ambil semua user
     */
    public function getAll()
    {
        $this->db->query("SELECT id, nama, username FROM users ORDER BY id DESC");
        return $this->db->resultSet();
    }

    /**
     * Ambil user berdasarkan ID
     */
    public function getById($id)
    {
        $this->db->query("SELECT id, nama, username FROM users WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    /**
     * Ambil user berdasarkan username (biasanya untuk login)
     */
    public function getByUsername($username)
    {
        $this->db->query("SELECT * FROM users WHERE username = :username");
        $this->db->bind('username', $username);
        return $this->db->single();
    }

    /**
     * Tambah user baru
     */
    public function tambah($data)
    {
        $query = "INSERT INTO users (nama, username, password) VALUES (:nama, :username, :password)";
        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('username', $data['username']);

        // Simpan password dengan hashing aman (bcrypt)
        $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);
        $this->db->bind('password', $hashedPassword);

        return $this->db->execute();
    }

    /**
     * Update user
     * (Password opsional — hanya diupdate jika diberikan)
     */
    public function update($id, $data)
    {
        if (!empty($data['password'])) {
            $query = "UPDATE users SET nama = :nama, username = :username, password = :password WHERE id = :id";
            $this->db->query($query);
            $this->db->bind('password', password_hash($data['password'], PASSWORD_BCRYPT));
        } else {
            $query = "UPDATE users SET nama = :nama, username = :username WHERE id = :id";
            $this->db->query($query);
        }

        $this->db->bind('nama', $data['nama']);
        $this->db->bind('username', $data['username']);
        $this->db->bind('id', $id);

        return $this->db->execute();
    }

    /**
     * Hapus user berdasarkan ID
     */
    public function delete($id)
    {
        $this->db->query("DELETE FROM users WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->execute();
    }

    /**
     * Verifikasi login user
     */
    public function verifyLogin($username, $password)
    {
        $user = $this->getByUsername($username);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
    public function getUsersTanpaRole()
{
    $query = "
        SELECT u.id, u.nama, u.username
        FROM users u
        LEFT JOIN user_roles ur ON u.id = ur.user_id
        WHERE ur.user_id IS NULL
        ORDER BY u.nama
    ";
    $this->db->query($query);
    return $this->db->resultSet();
}
}
