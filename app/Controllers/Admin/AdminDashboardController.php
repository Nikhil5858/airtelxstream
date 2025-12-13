<?php

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        Middleware::adminAuth();
    }

    public function index()
    {
        $this->view("Admin/dashboard/index", [
            "layout" => "admin"
        ]);
    }
}
