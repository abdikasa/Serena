<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use App\Core\Dico\App;

require_once $_SERVER["DOCUMENT_ROOT"] . "/SERENA/vendor/autoload.php";
require_once "../core/bootstrap.php";

//Email

$valid_url = unserialize(urldecode($_GET["data"]));
$valid_email = base64_decode($valid_url["email"]);

//perform sql search to check if email matches database.
$does_email_exist = App::get("db")->selectColumn("users", "user_email", $valid_email);
if(!$does_email_exist){
    $valid_email = "";
    die("Not valid email address");
    //should redirect to error page.
}

$mail = new PHPMailer(true);

try {

    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                    // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = App::get("phpmail")["host"];            // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = App::get("phpmail")["user"];            // SMTP username
    $mail->Password   = App::get("phpmail")["pass"];                               // SMTP password
    $mail->SMTPSecure = "ssl";                                  // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above



    //Recipients
    $mail->setFrom(App::get("phpmail")["user"], App::get("phpmail")["name"]);
    $mail->addAddress("$valid_email");                      // Add a recipient
   
    // Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                            // Set email format to HTML
    $get_email = $valid_url["email"];
    $get_random_token = $valid_url["randomToken"];
    $email_details = require_once "../views/verify.email.php";
    $mail->Subject = $email_details["subject"];
    $mail->Body = $email_details["body"];
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    $mail->SMTPDebug = 4;
    echo $mail->ErrorInfo;
}

?>