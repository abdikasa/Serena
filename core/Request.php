<?php

namespace App\Core;

class Request
{


    public static function getUri()
    {
        return parse_url(
            trim(
                $_SERVER["REQUEST_URI"], "/"), PHP_URL_PATH
        );
    }

    public static function getType(){
        return $_SERVER["REQUEST_METHOD"];
    }
}