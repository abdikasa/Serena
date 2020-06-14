<?php

return [
    "subject" => 'SERENA | Verify your email',
    "body" => "<!DOCTYPE HTML><html><head><link href='https://fonts.googleapis.com/css?family=Montserrat:300,700|Playfair+Display:400, 400i' rel='stylesheet'>
    </head>
    <body style='font-family: 'Montserrat', sans-serif; font-weight: 300; line-height: 1.5;'>
    <header id='showcase' class='grid' style='max-width: 700px; margin: 0 auto;'>
    <div class='card'>
    <h2 style='font-family: 'Playfair Display', serif; font-weight: 600; font-style: italic;'><a>SERENA</a></h2>
    <img src='https://images.pexels.com/photos/1884581/pexels-photo-1884581.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260' style='display: block; width: 100%; height: auto;'>
    </div>
    <div class='card-content'>
    <h6 id='card-title' style='font-family: 'Playfair Display', serif; font-style: italic; font-weight: bold;'>YOU'RE ONE STEP AWAY</h6>
    <h1 id='card-head' style='font-family: 'Playfair Display', serif; font-weight: 600; font-style: italic; margin-top: -20px;'>Verify your email address</h1>
    <p style='margin-top: -0.5rem; margin-bottom: 2em;'>To complete your profile and start shopping with SERENA, click the button below to verify your account to get amazing deals.</p>
    <a href='http://localhost:1234/serena/activation.php?email=$get_email&randomToken=$get_random_token' class='btn button verify-btn' style='font-family: 'Montserrat', sans-serif; font-weight: 700; font-size: 13px; text-transform: uppercase; letter-spacing: 3px; display: inline-block; text-decoration: none; color: #fff; background: #222; padding: 1em 2em; border-radius: 4px; border: 1px solid #666;'>Verify</a>
    </div>
    </header>
    </body>
    <html>"
];
