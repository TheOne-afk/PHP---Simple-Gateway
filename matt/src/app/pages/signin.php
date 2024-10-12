<?php

require_once '../utils/MVC/signin/signin_view.inc.php';
require_once '../utils/config.session.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link rel="stylesheet" href="../../../public/css/signup.css">
    <link rel="stylesheet" href="../../../public/css/global.css">
</head>
<body>

<!-- Sign up container -->
    <div class="sign-up-container" >
        <!-- Form container -->
        <form action="../utils/signin.handle.php" method="POST">
            <!-- Header -->
            <span><h1>Welcome</h1><h1>Back!</h1></span>

            <?php empty_field(); ?>
            <?php  email_wrong(); ?>
            <?php
            if(isset($_GET['locked'])){
                if($_GET['locked'] == 'true'){
                    echo "<span id='requriedValid' >Your account has been locked due to multiple failed login attempts. Please contact support to unlock your account.</span>";
                }
            }
            if(isset($_GET['tempo_lock'])){
                if($_GET['tempo_lock'] == 'true'){
                    echo "<span id='requriedValid' >Your account is temporarily locked due to multiple unsuccessful login attempts. Please wait try again later</span>";
                }
            }
            ?>

            <!-- Username -->
            <div class="field-container">
                <div>
                <input type="text" name="email" id="email" placeholder="Username">
                <img src="../../../public/images/svg/person.svg" width="25" height="25" alt="email">
                </div>
            </div>

            <!-- Password -->
            <div class="field-container">
                <div>
                <input type="password" name="password" id="password" placeholder="Password">
                <img src="../../../public/images/svg/lock.svg" width="25" height="25" alt="profile">
                </div>
            </div>

            <div class="submit-container">
            <input type="submit" value="Signin" name="submit">
            </div>
        </form>
        <div class="image" >
            <div>
                <h1>Join Us Today</h1>
                <p>Create a new account to unlock access to exclusive features and become part of our community. Sign up now and start your journey with us!</p>
                <div class="sign-in-container" >
                    <button class="sign-in-btn" type="button" onclick="handleSignUpRedirect()" >Sign up</button>
                </div>
            </div>
            <img src="../../../public/images/svg/wickedbackground.svg" alt="...">
        </div>
    </div>
    
   <script src="../../../public/js/signin.js"></script>
</body>
</html>