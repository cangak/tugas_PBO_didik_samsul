<?php

class Menu {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAll() {
        $this->db->query("SELECT * FROM menus ORDER BY id ASC");
        return $this->db->resultSet();
    }

    public function getAllActive() {
        $this->db->query("SELECT * FROM menus WHERE is_active = 1 ORDER BY order_no ASC");
        return $this->db->resultSet();
    }

    public function getById($id) {
        $this->db->query("SELECT * FROM menus WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getParentOptions() {
        $this->db->query("SELECT id, title FROM menus WHERE parent_id IS NULL ORDER BY order_no ASC");
        return $this->db->resultSet();
    }

    public function tambah($data) {
        $query = "INSERT INTO menus (parent_id, title, icon, url, order_no, role_access, is_active)
                  VALUES (:parent_id, :title, :icon, :url, :order_no, :role_access, :is_active)";
        $this->db->query($query);
        $this->db->bind(':parent_id', $data['parent_id'] ?: null);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':icon', $data['icon']);
        $this->db->bind(':url', $data['url']);
        $this->db->bind(':order_no', $data['order_no']);
        $this->db->bind(':role_access', $data['role_access']);
        $this->db->bind(':is_active', $data['is_active']);
        $this->db->execute();
    }

    public function update($id, $data) {
        $query = "UPDATE menus SET 
                    parent_id = :parent_id,
                    title = :title,
                    icon = :icon,
                    url = :url,
                    order_no = :order_no,
                    role_access = :role_access,
                    is_active = :is_active
                  WHERE id = :id";
        $this->db->query($query);
        $this->db->bind(':parent_id', $data['parent_id'] ?: null);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':icon', $data['icon']);
        $this->db->bind(':url', $data['url']);
        $this->db->bind(':order_no', $data['order_no']);
        $this->db->bind(':role_access', $data['role_access']);
        $this->db->bind(':is_active', $data['is_active']);
        $this->db->bind(':id', $id);
        $this->db->execute();
    }

    public function delete($id) {
        $this->db->query("DELETE FROM menus WHERE id = :id OR parent_id = :id");
        $this->db->bind(':id', $id);
        $this->db->execute();
    }
}
