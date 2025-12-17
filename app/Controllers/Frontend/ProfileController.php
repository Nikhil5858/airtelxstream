<?php

class ProfileController extends Controller
{
    public function __construct()
    {
        if (empty($_SESSION['user_id'])) {
            $this->redirect('login');
        }
    }

    public function index()
    {
        $user = $this->model('User')->find($_SESSION['user_id']);

        $this->view("Frontend/profile/index", [
            'user' => $user
        ]);
    }

    public function help()
    {
        $this->view("Frontend/profile/help");
    }

    public function language()
    {
        $this->view("Frontend/profile/language");
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

        $this->redirect('home/index');
    }    
}
