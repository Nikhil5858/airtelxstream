<?php

$routes = [

    //Home 
    "" => "Frontend/HomeController@index",
    "home/index" => "Frontend/HomeController@index",

    //Single Page
    "singlepage" => "Frontend/SinglepageController@index",
    "singlepage/index" => "Frontend/SinglepageController@index",

    //Otp Model
    "auth/send-otp"   => "Frontend/AuthController@sendOtp",
    "auth/verify-otp" => "Frontend/AuthController@verifyOtp",

    //Serach
    "search" => "Frontend/SearchController@index",
    "search/results" => "Frontend/SearchController@results",

    //Profile
    "profile" =>                "Frontend/ProfileController@index",
    "profile/plans"      => "Frontend/ProfileController@plans",
    "profile/help"       => "Frontend/ProfileController@help",
    "profile/language"   => "Frontend/ProfileController@language",
    "profile/logout" => "Frontend/ProfileController@logout",

    //Myplan
    "myplan" => "Frontend/MyplanController@index",
    "myplan/subscribe" => "Frontend/MyplanController@subscribe",
    
    //Free
    "free" => "Frontend/FreeController@index",

    //Ott
    "ott" => "Frontend/OttController@index",
];
