<?php

//require_once '../form_utility/get_title.php';



// if ($_SERVER['PHP_SELF'] !== $currentPath) {
//     header("Location: http://localhost:1234/serena/views/missing.php");
//     exit;
// }

?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SERENA <?= $title ?? '' ?></title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,700|Playfair+Display:400,400i" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="frontend/css/calstyle.css">
    <link rel="stylesheet" type="text/css" href="frontend/css/base_color.css">
    <link rel="stylesheet" type="text/css" href="frontend/css/sign_up.css">
</head>

<body>
    <div class="so-container">
        <header id="so-head">
            <div class="container">
                <div class="row">
                    <div class="col col-6 col-md-6 col-lg-6">
                        <h1><a href="#">SERENA</a></h1>
                    </div>
                    <div class="col col-12 col-md-6 col-lg-6">
                        <ul>
                            <li>Already have an account?<span><a href="#" class="text-gold">Sign in</a></span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>