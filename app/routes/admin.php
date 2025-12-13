<?php

$routes = [

    "" => "Admin/AuthController@index",  
    "login" => "Admin/AuthController@index",
    "login/store" => "Admin/AuthController@login",
    "logout" => "Admin/AuthController@logout",

    "dashboard" => "Admin/AdminDashboardController@index",
];
