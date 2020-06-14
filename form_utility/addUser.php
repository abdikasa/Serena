<?php

require_once '/xampp/htdocs/SERENA/core/bootstrap.php';

$query = App\Core\Dico\App::get("db");

$does_email_exist =
    $query->selectColumn("", "", "");

if (!$does_email_exist) {
    $query->insertUser("", $addUser);

    if (!$query) {
        die("Failed Insert");
    } else {
        //Redirect
        $base_url = $page->checkEmail([
            "email" => base64_encode($addUser["email"]),
            "randomToken" => $addUser["token"],
        ]);

        //unset variables now

        foreach ($allFields as $key) {
            unset($$key);
        }

        header($base_url[0] . $base_url[1]);
        die;
    }
} else {
    $errors[] = "Email is already registered.";
}
