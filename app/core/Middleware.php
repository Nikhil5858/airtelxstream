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

    public static function userAuth()
    {
        if (empty($_SESSION['user_logged_in'])) {
            header("Location: " . BASE_URL);
            exit;
        }
    }

    public static function userGuestOnly()
    {
        if (!empty($_SESSION['user_logged_in'])) {
            header("Location: " . BASE_URL);
            exit;
        }
    }
}
