<?php

Use App\Core\Dico\App;
use App\Core\Database\QueryBuilder;
use App\Core\Database\Connection;
use App\Controllers\PageController;

App::bind("config", 
                $config = require_once "/xampp/htdocs/SERENA/config.php");

App::bind("db", new QueryBuilder(
    Connection::make($config["database"])
));

App::bind("phpmail", $config["phpmail"]);

$page = new PageController();


//maybe create the PageController Class 
//and redirect to an appropiate error page if needed (When something goes wrong).



