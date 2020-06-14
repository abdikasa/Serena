<?php
// require_once("/xampp/htdocs/SERENA/core/bootstrap.php");
$missing  = [];
$errors = [];
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//$currentPath = "/serena/views/sign.up.view.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $allFields = [
        'first_name', 'last_name', 'email', 'select_years', 'select_days',
        'select_months', 'password', 'confirm_password', 'phone_number'
    ];

    $required = ['first_name', 'email', 'select_years', 'password', 'confirm_password', 'phone_number'];

    require_once '/xampp/htdocs/SERENA/form_utility/process_mail.php';
    require_once "/xampp/htdocs/SERENA/form_utility/validateFields.php";

    foreach ($allFields as $key) {
        if (!in_array($key, $missing) && !empty($_POST[$key])) {
            //if not in missing array, do this
            switch ($key) {
                case "first_name":
                case "last_name":
                    $key = new Validate($key, 2);
                    $key->requireDecency();
                    $key->validateName();
                    break;
                case "select_years":
                    Validate::registerDOB(
                        $_POST["select_days"],
                        $_POST["select_months"],
                        $_POST["select_years"]
                    );
                    break;
                case "email":
                    $key = new Validate($key, 6);
                    $key->requireDecency();
                    if (!$suspect) {
                        $key->validateEmail();
                    }
                    break;
                case "password":
                case "confirm_password":
                    $key = new Validate($key, 8);
                    $key->requireMixedCase();
                    $key->requireNumbers(1);
                    $key->validatePassword();
                    break;
                case "phone_number":
                    $key = new Validate($key, 12);
                    $key->validatePhone();
                    break;
            }
        }
    }

    $errors = Validate::getErrors();
    $suspect == true ? $errors[] = $mailError :  "";
    Validate::matchedPass("password", "confirm_password") == true ? $errors[] = "Passwords do not match!" : "";


    if (count($missing) == 0 && count($errors) == 0) {
        $months = [
            "January", "February", "March", "April", "May",
            "June", "July", "August", "September", "October", "November",
            "Decmeber"
        ];

        $select_months = array_search($select_months, $months);
        if ($select_months < 10) {
            $select_months = "0" . ($select_months + 1);
        }
        if ($select_days < 10) {
            $select_days = "0" . $select_days;
        }
        $date = "$select_years-$select_months-$select_days";
        date_default_timezone_set("America/Toronto");
        $r_date = date('Y-m-d H:i:s');
        $hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);
        $token = genToken(32);
        $addUser["token"] = $token;
        $addUser["hash"] = $hash;
        $addUser["r_date"] = $r_date;
        $addUser["date"] = $date;
        require_once "/xampp/htdocs/SERENA/form_utility/addUser.php";
    }
}
