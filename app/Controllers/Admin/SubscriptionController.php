<?php

class SubscriptionController extends Controller
{
    private Subscription $subscription;

    public function __construct()
    {
        Middleware::adminAuth();
        $this->subscription = $this->model('Subscription');
    }

    public function index()
    {
        $plans = $this->subscription->all();

        $this->view("Admin/subscription/index", [
            "layout" => "admin",
            "plans"  => $plans
        ]);
    }

    public function store()
    {
        $this->subscription->create([
            "plan_name"     => $_POST['plan_name'],
            "price"         => $_POST['price'],
            "duration_days" => $_POST['duration_days'],
            "is_active"     => $_POST['is_active'] ?? 0
        ]);

        $this->redirect("admin/subscription");
    }

    public function update()
    {
        $this->subscription->update($_POST['id'], [
            "plan_name"     => $_POST['plan_name'],
            "price"         => $_POST['price'],
            "duration_days" => $_POST['duration_days'],
            "is_active"     => $_POST['is_active'] ?? 0
        ]);

        $this->redirect("admin/subscription");
    }

    public function delete()
    {
        $this->subscription->delete($_POST['id']);
        $this->redirect("admin/subscription");
    }
}
