<?php

class AuthController extends Controller
{
    private User $user;

    public function __construct()
    {
        $this->user = $this->model('User');
    }

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
        session_unset();        
        session_destroy();   

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        $this->redirect('admin/login');
    }

}
