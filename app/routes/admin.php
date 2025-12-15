<?php

$routes = [

    //Landing Page
    "" => "Admin/AuthController@index",

    //Dashboard
    "dashboard" => "Admin/AdminDashboardController@index",

    //Auth
    "login" => "Admin/AuthController@index",
    "login/store" => "Admin/AuthController@login",
    "logout" => "Admin/AuthController@logout",

    //Movies
    "movies"            => "Admin/MovieController@index",
    "movies/store"      => "Admin/MovieController@store",
    "movies/update"     => "Admin/MovieController@update",
    "movies/delete"     => "Admin/MovieController@delete",    

    //Genres
    "genres"        => "Admin/GenreController@index",
    "genres/store"  => "Admin/GenreController@store",
    "genres/update" => "Admin/GenreController@update",
    "genres/delete" => "Admin/GenreController@delete",

    //seasons
    "seasons"        => "Admin/SeasonController@index",
    "seasons/store"  => "Admin/SeasonController@store",
    "seasons/update" => "Admin/SeasonController@update",
    "seasons/delete" => "Admin/SeasonController@delete",

    //Users
    "users"         => "Admin/UsersController@index",
    "users/store"   => "Admin/UsersController@store",
    "users/update"  => "Admin/UsersController@update",
    "users/delete"  => "Admin/UsersController@delete",

    // Subscription
    "subscription"           => "Admin/SubscriptionController@index",
    "subscription/store"     => "Admin/SubscriptionController@store",
    "subscription/update"    => "Admin/SubscriptionController@update",
    "subscription/delete"    => "Admin/SubscriptionController@delete",

];
