<?php
$addUser = [];
$pattern = '/[\s\r\n]|Content-Type:|Bcc:|Cc:/i';
$suspect = preg_match($pattern, $_POST["email"]);
//check if email is not suspect.
if (!$suspect) {

    foreach ($_POST as $key => $val) {
        if (!is_array($val)) {
            $val = trim($val);
        }

        if (!in_array($key, $allFields)) {
            continue;
        }

        if (in_array($key, $required) && empty($val)) {
            $missing[] = $key;
            $$key = "";
            continue;
        }
        
        //key for example would be first_name
        //the $$ means 'first_name' = "Some name";
        //Now you can reference Some name with $first_name.
        $addUser[$key] = $$key = trim(htmlspecialchars($val, ENT_QUOTES, "UTF-8"));
    }
} else {
    $mailError = "Mail Injection Error! Potential suspect phrases found in email.";
}

function convertScores($key){
    return ucfirst(str_replace("_", " ", $key));
}

function genToken($length){
    $random = md5(uniqid(mt_rand(), true));
    $base64_encode = base64_encode($random);
    //remove = or plus symbols
    $modified_str = str_replace(array('+', '='), array('',''), $base64_encode);
    $token = substr($modified_str,0, $length);
    return $token;
}
