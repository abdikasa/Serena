<?php

//class for validating all the fields

Use App\Core\Database\QueryBuilder;

class Validate
{

    protected $key;
    protected $mixedCase = 0;
    protected $minNums = 0;
    protected static $errors = [];
    protected $minLength;
    protected $noProfanity = 0;

    public function __construct($key, $minLength)
    {
        $this->key = $key;
        $this->minLength = $minLength;
    }

    //check for mixed case
    public function requireMixedCase()
    {
        $this->mixedCase = true;
    }

    public function requireDecency()
    {
        $this->noProfanity = true;
    }

    public function requireNumbers($num = 1)
    {
        if (is_numeric($num) && $num  > 0) {
            $this->minNums = (int) $num;
        }
    }

    public function checkProfanity()
    {
        $bad = "(nigger|nigga|niggah|fuck|pussy|kill|white power|black power|wank|wetback|vagina|penis|twink|twat|tranny|towelhead|taste my|suck my|suck it|taste it|tight white|swastika|suck|sucks|legs|semen|raging boner|raghead|porn|pubes|pole smoker|cunt|paki|pedo|paedophile|anal|ball licking|ball sucking|ball sack|barely|legal|blowjob|blow job|boner|kkk|load|rape|darkie|blackie|dildo|penetration|doggie|fag|faggot|fellatio|cunnilingus|finger|bang|fuck|tard|ejaculation|busting|incest|hump|jail|bait|jiga|jigga|jizz|lolita|masturbate|missionary)";

        if (preg_match($bad, trim($_POST[$this->key]))) {
            self::$errors[] = $this->convertUnderscores() . " field contains profanity.";
        }
    }

    public function validateName()
    {
        //check length of input.
        if (strlen(trim($_POST[$this->key])) < $this->minLength) {
            self::$errors[] = $this->convertUnderscores() . " field requires at least $this->minLength characters";
        }

        //check for profanity.
        if ($this->noProfanity) {
            $this->checkProfanity();
        }

        //lastly, check for valid first name patterns.

        if (!preg_match("/^[a-zA-Z]+[ -\/\\'\"]*[a-zA-Z]+[ \"]{0,2}[a-zA-Z]*$/", trim($_POST[$this->key]))) {
            self::$errors[] = "Not a valid " . $this->convertUnderscores();
        }

        return self::$errors ? false : true;
    }

    public function getValue()
    {
        return trim($_POST[$this->key]);
    }

    public static function registerDOB($d, $m, $y)
    {
        date_default_timezone_set('UTC');
        $months = [
            "January", "February", "March", "April", "May",
            "June", "July", "August", "September", "October", "November",
            "Decmeber"
        ];

        $leap = $y % 400 == 0 || ($y % 4 == 0 && !($y % 100 == 0));

        if ($d > 28 && $m == "February" && !$leap) {
            self::$errors[] = "Invalid days for the month February in $y";
            return;
        } else if (
            $d > 30 && ($m == "September" || $m == "June" || $m == "April"
                || $m == "November" || $m == "February")
        ) {
            self::$errors[] = "Invalid days for the month $m in $y";
            return;
        }

        if (date("Y") - $y <= 16) {
            if (date("Y") - $y < 16) {
                self::$errors[] = "You must be at least 16 years old to have an account.";
            } else if (date("n") < (array_search($m, $months) + 1)) {
                self::$errors[] = "You must be at least 16 years old to have an account.";
            } else if (date("j") < $d) {
                self::$errors[] = "You must be at least 16 years old to have an account.";
            }
        }
    }

    public function validateEmail()
    {
        //check length of input.
        if (strlen(trim($_POST[$this->key])) < $this->minLength) {
            self::$errors[] = $this->convertUnderscores() . " field requires at least $this->minLength characters";
        }

        //check for profanity.
        if ($this->noProfanity) {
            $this->checkProfanity();
        }

        $test = trim($_POST[$this->key]);

        if (!empty(trim($_POST[$this->key])) && isset($test)) {
            $valid = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            if (!$valid) {
                self::$errors[] = "Email is not valid!";
            }
        }
        return self::$errors ? false : true;
    }

    public function validatePassword()
    {
        if (strlen(trim($_POST[$this->key])) < $this->minLength) {
            self::$errors[] = $this->convertUnderscores() . " field requires at least $this->minLength characters";
        }

        //no leading or trailing spaces.
        if (preg_match('/^\s+|s+$/', trim($_POST[$this->key]))) {
            self::$errors[] = $this->convertUnderscores() . " cannot contain leading ortrailing spaces.";
        }

        if ($this->mixedCase) {
            $pattern = '/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/';
            if (!preg_match($pattern, trim($_POST[$this->key]))) {
                self::$errors[] = $this->convertUnderscores() . " should contain uppercase, lowercase and at least one number";
            }
        }

        if ($this->minNums) {
            $pattern = '/\d/';
            $found = preg_match_all($pattern, trim($_POST[$this->key]), $matches);
            if ($found < $this->minNums) {
                self::$errors[] = $this->convertUnderscores() . " should contain at least $this->minNums number(s).";
            }
        }
        return self::$errors ? false : true;
    }


    public function validatePhone()
    {
        if (!preg_match('/^[0-9]{3}[\s\-]{0,1}[0-9]{3}[\s\-]{0,1}[0-9]{4}$/', $_POST[$this->key])) {
            self::$errors[] = "Invalid " . $this->convertUnderscores() . ".";
        }
    }

    public static function getErrors()
    {
        return self::$errors;
    }

    public static function errorSize()
    {
        $size = count(self::$errors);
        return $size;
    }

    public static function matchedPass($passA, $passB)
    {
        if (trim($_POST[$passA]) != trim($_POST[$passB])) {
            return true;
        };
        return false;
    }

    public function convertUnderscores(){
        return ucfirst(str_replace("_", " ", $this->key));
    }

    public function isSelected(){
        if(!isset($_POST["$this->key"])){
            self::$errors["gender"] = "Please select your title."; 
        }
    }

    // public function does_email_already_exist(QueryBuilder $query){
    //     //Goal: Check to see if db already contains that email.

    //    $does_email_exist =  
    //    $query->selectColumn("users", "user_email", $_POST["email"]);      
       
    //    if(!$does_email_exist){
    //        self::$errors[] = "Sorry, this email already registered."; 
    //    }
    // }

}
