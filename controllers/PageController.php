<?php

namespace App\Controllers;

class PageController
{

    public function home()
    {

        require_once "/xampp/htdocs/SERENA/controllers/sign.up.php";
        require_once "/xampp/htdocs/SERENA/views/sign.up.view.php";
    }

    public function register()
    {
        require_once "/xampp/htdocs/SERENA/controllers/sign.up.php";
        require_once "/xampp/htdocs/SERENA/views/sign.up.view.php";
    }

    public function checkEmail($data = [])
    {
        return ["Location: controllers/check.email.php?data=", urlencode(serialize($data))];
    }
}
