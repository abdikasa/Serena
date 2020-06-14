<?php

//get the filename fromthe server.
//basename returns the file part of the path. Including the suffix
//however by passing a second param, you can remove the suffix from the file.
//otherwise you get the suffix with it if you mispell the second param.
$title = basename($_SERVER['SCRIPT_FILENAME'], '.php');
$title = str_replace("_", " ", $title);
if($title == 'index'){
    $title = 'home';
}

$title = ucwords($title);

