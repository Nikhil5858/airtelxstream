<?php

class AuthController extends Controller
{
    private User $user;

    public function __construct()
    {
        $this->user = $this->model('User');
    }

    // Only guests can see login page
    public function index()
    {
        Middleware::guestOnly();

        $this->view("Admin/auth/index", [
            "layout" => "auth"
        ]);
    }

    public function login()
    {
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if ($this->user->verifyLogin($email, $password)) {
            $this->redirect('admin/dashboard');
        }

        $this->view("Admin/auth/index", [
            "layout" => "auth",
            "error"  => "Invalid login"
        ]);
    }

    public function logout()
    {
        session_destroy();
        $this->redirect('admin/login');
    }
}
