<?php

$router->get("serena", "PageController@home");
$router->post("serena", "PageController@home");
$router->get("serena/register", "PageController@register");
$router->post("serena/register", "PageController@register");
$router->post("serena/checkemail", "PageController@checkemail");
