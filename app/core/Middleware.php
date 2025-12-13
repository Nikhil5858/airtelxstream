<?php

class Middleware
{
    public static function adminAuth()
    {
        if (!isset($_SESSION['admin_logged_in'])) {
            header("Location: " . BASE_URL . "/admin/login");
            exit;
        }
    }

    public static function guestOnly()
    {
        if (isset($_SESSION['admin_logged_in'])) {
            header("Location: " . BASE_URL . "/admin/dashboard");
            exit;
        }
    }
}
