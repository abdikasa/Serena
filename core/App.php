<?php

namespace App\Core\Dico;
use Exception;

class App {

    public static $registry = [];

    public static function bind($k, $v){
        self::$registry[$k] = $v;
    }

    public static function get($k){
        if(!array_key_exists($k, static::$registry)){
            throw new Exception("NO key is found!");
        }
        return static::$registry[$k];
    }
}