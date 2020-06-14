<?php
require_once "../includes/email_php.php";
?>
<!DOCTYPE html>
<html>

<head>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,700|Playfair+Display:400,400i" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="../frontend/css/cym.css" type="text/css">
    <link rel="stylesheet" href="../frontend/css/base_color.css" type="text/css">
</head>

<body>
    <header>
        <div class="container nav-white">
            <h1 class="logoHover"><a href="#">SERENA</a></h1>
        </div>
    </header>
    <div class='flexAllZero'>
        <div id='center'>
            <div class="box">
                <img src="/SERENA/imgs/email.jpg" alt="Email icon">
                <div id="text-cym">
                    <h2>Check Email</h2>
                    <h2 id="highlight-h2">Your email: <?php echo $valid_email ?></h2>
                    <p>
                        Please check your email inbox and click on the
                        provided link.
                    </p>
                    <p id="jump_login">
                        <a href="#">
                            <i class="fas fa-chevron-left"></i>
                            &nbsp; Back to Login</a></p>
                </div>
            </div>
        </div>
    </div>

</body>

</html>