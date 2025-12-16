<?php

$routes = [
    "" => "Frontend/HomeController@index",
    "home/index" => "Frontend/HomeController@index",

    "singlepage" => "Frontend/SinglepageController@index",
    "singlepage/index" => "Frontend/SinglepageController@index",

    "auth/send-otp"   => "Frontend/AuthController@sendOtp",
    "auth/verify-otp" => "Frontend/AuthController@verifyOtp",

];
