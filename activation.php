<?php

require_once "vendor/autoload.php";
require_once "core/bootstrap.php";

$valid_email = base64_decode($_GET["email"]);
$token = $_GET["randomToken"];

//perform sql search to check if email matches database.
$does_email_exist = App\Core\Dico\App::get("db")->selectColumn("users", "user_email", $valid_email);
$is_token_valid = App\Core\Dico\App::get("db")->selectColumn("users", "validation_key", $token);

//check if the email exists in the database
//if not run below
if (!$does_email_exist || !$is_token_valid) {
    $valid_email = "";
    die("Not valid email address OR Wrong token.");
    //should redirect to error page.
} else {

    //check to see if the user is already verified.
    $already_verified = App\Core\Dico\App::get("db")->alreadyVerified(
        $does_email_exist["user_email"],
        $does_email_exist["validation_key"],
        1,
        "users"
    );

    //if it returns bool(false), it is not verified yet.
    //verify the user account here.
    if(!$already_verified){
        App\Core\Dico\App::get("db")
            ->updateByID(
                $does_email_exist["user_id"],
                "is_active",
                1,
                "users"
            );
        echo 'Welcome to the club mate!';
    }else{
        die("You are already veriffied");
    }
}
