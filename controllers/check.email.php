<?php
require_once "../includes/email_php.php";
?>
<?php require_once "../includes/cym_header.php";?>
                <img src="/SERENA/imgs/email.jpg" alt="Email icon">
                <div id="text-cym">
                    <h2>Check Email</h2>
                    <h2 id="highlight-h2">Your email: <?php echo $valid_email ?></h2>
                    <p>
                        Please check your email inbox and click on the
                        provided link.
                    </p>
          <?php require_once "../includes/cym_footer.php";
          ?>