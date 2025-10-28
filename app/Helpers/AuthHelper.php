<?php

class AuthHelper
{
    public static function user()
    {
        return $_SESSION['user'] ?? null;
    }

    public static function userId()
    {
        return $_SESSION['id'] ?? null;
    }

    public static function nama()
    {
        return $_SESSION['nama'] ?? null;
    }

    public static function role()
    {
        return $_SESSION['role_nama'] ?? 'Tanpa Role';
    }

    public static function roleId()
    {
        return $_SESSION['role_id'] ?? null;
    }

    public static function check()
    {
        return isset($_SESSION['id']);
    }

    public static function logout()
    {
        session_destroy();
        header('Location: ' . BASEURL . '/login');
        exit;
    }
    public static function getRoleByUserId($userId)
    {
        require_once __DIR__ . '/../../core/Database.php';
        $db = new Database();

        $db->query("
            SELECT r.nama AS role_nama
            FROM user_roles ur
            JOIN roles r ON ur.role_id = r.id
            WHERE ur.user_id = :user_id
            LIMIT 1
        ");
        $db->bind('user_id', $userId);
        $row = $db->single();

        return $row['role_nama'] ?? 'Belum ada Role';
    }
}
