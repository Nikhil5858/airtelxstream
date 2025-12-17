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
}
