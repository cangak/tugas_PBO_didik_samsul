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
}
