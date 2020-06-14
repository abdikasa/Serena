<?php
require_once("/xampp/htdocs/SERENA/includes/so_header.php");
?>

<section id="so-details">
    <div class="container">
        <div class="row">
            <div class="col col-12 col-md-12 col-lg-12">
                <div class="info-row">
                    <h6 style="color:#DFB28B">Registration</h6>
                    <h1>Create your account.</h1>
                    <p><span id="dob-red">You must be at least 16 years old to create an account.</span> <span id="atleast8">Password must be at least 8 characters</span> and <span id="passCase">contain<br>at least one upper case letter,
                            one lower case letter and a number.</span>
                    </p>
                </div>
                <?php if ($_POST) {
                    if (!empty($missing) || !empty($errors)) {
                ?>
                        <div class="d-flex row">
                    <?php
                        if (isset($_POST["submit_btn"])) {
                            if (!empty($missing)) { //if the missing fields array is not empty
                                if (empty($errors)) {
                                    echo "<div class='col-12'>";
                                } else {
                                    echo "<div class='col-6'>";
                                }
                                echo "<h6><u><b>Missing</b></u></h6>";
                                foreach ($missing as $key) {
                                    echo "<li>" . convertScores($key) . " is missing!</li>";
                                }
                                echo "</div>";
                            }
                            if (!empty($errors)) {
                                if (!$missing) {
                                    echo "<div class='col-12'>";
                                } else {
                                    echo "<div class='col-5 offset-lg-1'>";
                                }
                                echo "<h6><u><b>Errors</b></u></h6>";
                                foreach ($errors as $key) {
                                    echo "<li>$key</li>";
                                }
                                echo "</div>";
                            }
                            echo "</div>";
                        }
                    }
                }
                    ?>
                        </div>
            </div>
        </div>
</section>
<section id="so-register">
    <div class="container">
        <div class="row">
            <div class="img-left col col-lg-7">
            </div>
            <div class="form-right col col-lg-5 offset-lg-1">
                <form method="post" action="" id="so-form" class="validate">
                    <!-- <div class='radio-group'>
                        <input type="radio" name="gender" value="Mr." checked>
                        <label for="test1">Mr.</label>
                        <input type="radio" name="gender" value="Ms.">
                        <label for="test2">Ms.</label>
                        <input type="radio" name="gender" value="Mx.">
                        <label for="test3">Mx.</label>
                    </div> -->
                    <div class="form-group">
                        <p><input type="text" name="first_name" id="first_name" class="sign-u form-control shadow-none" minlength="2" maxlength="32" placeholder="First Name" autocomplete="new-password" autocomplete="false" autocomplete="off" required value=<?php if (($missing || $errors) && !$suspect) echo "'" . $first_name . "'" ?>></p>
                        <div class="magic-placeholder">
                            <p>First Name</p>
                        </div>
                    </div>
                    <div class="form-group not-required">
                        <p> <input type="text" name="last_name" id="last_name" class="sign-u form-control shadow-none" minlength="2" maxlength="32" placeholder="Last Name" autocomplete="new-password" autocomplete="false" autocomplete="off" value=<?php if (($missing || $errors) && !$suspect) echo "'" . $last_name . "'" ?>></p>
                        <div class="magic-placeholder">
                            <p>Last Name</p>
                        </div>
                    </div>
                    <div class="date-picker">
                            <p>Date of Birth</p>
                        <?php require_once "/xampp/htdocs/SERENA/includes/calendar.php"; ?>
                    </div>
                    <div class="form-group">
                        <p> <input type="email" name="email" id="email" class="sign-u form-control shadow-none" placeholder="Email" minlength="6" title="Your email must follow this format: someemail@example.com" autocomplete="new-password" autocomplete="false" required autocomplete="off" value=<?php if (($missing || $errors) && !$suspect) echo "'" . $email . "'" ?>></p>
                        <div class="magic-placeholder">
                            <p>Email</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <i class="show_icon fas fa-eye-slash"></i>
                        <p> <input type="password" name="password" id="password" class="sign-u form-control shadow-none" placeholder="Password" autocomplete="new-password" autocomplete="false" autocomplete="off" minlength="8" maxlength="32" required value=<?php if (($missing || $errors) && !$suspect) echo "'" . $password . "'" ?>></p>
                        <div class="magic-placeholder show_hide">
                            <p>Password</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <i class="show_icon fas fa-eye-slash"></i>
                        <p> <input type="password" name="confirm_password" id="confirm_password" class="sign-u form-control shadow-none" placeholder="Confirm Password" minlength="8" max-length="32" autocomplete="new-password" autocomplete="false" autocomplete="off" required value=<?php if (($missing || $errors) && !$suspect) echo "'" . $confirm_password . "'" ?>></p>
                        <div class="magic-placeholder show_hide">
                            <p>Confirm Password</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <p> <input type="tel" name="phone_number" id="phone_number" class="sign-u form-control shadow-none" placeholder="Your phone number" autocomplete="new-password" autocomplete="false" autocomplete="off" required title="Your phone number must follow this format: 416XXXYYYY (no spaces)" value=<?php if (($missing || $errors) && !$suspect) echo "'" . $phone_number . "'" ?>></p>
                        <div class="magic-placeholder mp-5">
                            <p>Your phone number</p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php require_once "/xampp/htdocs/SERENA/includes/so_footer.php"; ?>
</body>

</html>