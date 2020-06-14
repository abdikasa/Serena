<?php 

use App\Core\{Router, Request};

//requires the needed core systems
require_once "vendor/autoload.php";

Router::load("routes.php")
-> direct(Request::getUri(), Request::getType());