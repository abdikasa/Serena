<?php

namespace App\Core;

use Exception;
require_once "/xampp/htdocs/SERENA/controllers/PageController.php";

class Router
{

    protected $routes = [
        "GET" => [],
        "POST" => [],
    ];

    public static function load($link)
    {
        $router = new self();
        require $link;
        return $router;
    }

    public function direct($url, $reqType)
    {
        //$url = Request::getUri();

        if (array_key_exists($url, $this->routes[$reqType])) {
            $urlArr = explode("@", $this->routes[$reqType][$url]);
            //urlArr[0] = "ClassController";
            //urlArr[1] = "method of ClassController"

            if ($this->callAction($urlArr["0"], $urlArr["1"])) {
                //calls Contoller->method()
                $url = "App\\Controllers\\" . $urlArr[0];
                (new $url)->{$urlArr["1"]}();
            }
        } else {
            throw new Exception("No route defined, Something went wrong");
        }
    }

    public function get($uri, $controller)
    {
        $this->routes["GET"][$uri] = $controller;
    }


    public function post($uri, $controller)
    {
        $this->routes["POST"][$uri] = $controller;
    }

    public function red($uri, $controller)
    {
        $this->routes["RED"][$uri] = $controller;
    }

    protected function callAction($class, $method)
    {
        
        //Check is passed $controller is an actual class.

        $class = "App\\Controllers\\" . $class;

        if (!class_exists($class)) {
            throw new Exception("{$class} class doesn't exist!");
        }

        //safely create the class
        $controller = new $class;

        //check if the method exists of the aformentioned controller.
        if (!method_exists($controller, $method)) {
            throw new Exception("{$method} method does not exist!");
        }

        return true;
    }
}
