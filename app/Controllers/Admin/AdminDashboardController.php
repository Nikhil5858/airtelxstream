<?php

class AdminDashboardController extends Controller 
{
    public function index() 
    {
        $this->view("Admin/dashboard/index");
    }
}
