<?php
class Login
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

     public function getUserByUsername($username)
    {
        $query = "
            SELECT 
                u.id,
                u.nama,
                u.username,
                u.password,
                r.id AS role_id,
                r.nama AS role_nama
            FROM users u
            LEFT JOIN user_roles ur ON u.id = ur.user_id
            LEFT JOIN roles r ON ur.role_id = r.id
            WHERE u.username = :username
            LIMIT 1
        ";

        $this->db->query($query);
        $this->db->bind('username', $username);
        return $this->db->single();
    }
}