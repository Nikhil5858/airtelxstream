<?php
session_start();

require "../../app/core/config.php";
require "../../app/core/Middleware.php"; 
require "../../app/core/Controller.php";
require "../../app/core/App.php";

$app = new App();
