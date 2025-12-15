<?php

class Middleware
{
    public static function adminAuth()
    {
        if (empty($_SESSION['admin_id'])) {
            header("Location: " . BASE_URL . "/admin/login");
            exit;
        }
    }

    public static function guestOnly()
    {
        if (!empty($_SESSION['admin_id'])) {
            header("Location: " . BASE_URL . "/admin/dashboard");
            exit;
        }
    }
}
