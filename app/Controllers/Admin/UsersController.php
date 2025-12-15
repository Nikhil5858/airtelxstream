<?php

class UsersController extends Controller
{
    private User $user;

    public function __construct()
    {
        Middleware::adminAuth();
        $this->user = $this->model('User');
    }

    public function index()
    {
        $users = $this->user->all();

        $this->view("Admin/users/index", [
            "layout" => "admin",
            "users"  => $users
        ]);
    }

    public function store()
    {
        $this->user->create([
            "name"       => $_POST['name'],
            "email"      => $_POST['email'],
            "password"   => password_hash($_POST['password'], PASSWORD_DEFAULT),
            "is_subscription_active" => $_POST['is_subscription_active'] ?? 0
        ]);

        $this->redirect("admin/users");
    }

    public function update()
    {
        $this->user->update($_POST['id'], $_POST);
        $this->redirect("admin/users");
    }

    public function delete()
    {
        $this->user->delete($_POST['id']);
        $this->redirect("admin/users");
    }
}
