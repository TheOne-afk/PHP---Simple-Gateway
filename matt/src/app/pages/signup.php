<?php 
require_once '../utils/MVC/signup/signup_view.inc.php';
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
 <!-- TODO: Add onInputChange on every input fields  -->
    <div class="sign-up-container" >
        <!-- Form container -->
        <form action="../utils/signup.handle.php" method="POST">
            <!-- Header -->
            <span><h1>Create</h1><h1>account</h1></span>
            
            <?php user_message(); ?>

            <!-- Username -->
            <div class="field-container" id="username-container">
                <div>
                <input type="text" name="username" id="username"  placeholder="Username" oninput="onInputChange()" >
                <img src="../../../public/images/svg/person.svg" width="30" height="30" alt="profile">
                </div>
                <?php username_is_taken() ?>
                <?php username_format_error() ?>
            </div>

            <!-- Email -->
            <div class="field-container" id="email-container">
                <div>
                <input type="text" name="email" id="email" placeholder="Email" oninput="onInputChange()"  >
                <img src="../../../public/images/svg/envelope.svg" width="25" height="25" alt="email">
                </div>
                <?php is_email_correct() ?>
            </div>

            <!-- Password -->
            <div class="field-container" id="password-container">
                <div>
                <input type="password" name="password" id="password" placeholder="Password" oninput="onInputChange()"  >
                <img src="../../../public/images/svg/lock.svg" width="25" height="25" alt="profile">
                </div>
                <?php is_password_errors();
                ?>
            </div>

            <!-- Confirm password -->
            <div class="field-container" id="confirm-password-container">
                <div>
                <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirm password" oninput="onInputChange()"  >
                <img src="../../../public/images/svg/lock.svg" width="25" height="25" alt="" >
                </div>
            </div>
            <div>
            </div>

            <div class="submit-container">
            <input type="submit" value="Signup" name="submit" >
            </div>
        </form>

        <!-- Side Image -->
        <div class="image" >
            <div>
                <h1>Sign In to Your Account</h1>
                <p>If you already have an account, please sign in to access your personalized dashboard and continue enjoying all the features available to you.</p>
                <div class="sign-in-container" >
                    <button class="sign-in-btn" type="button" onclick="handleSignInRedirect()" >Sign in</button>
                </div>
            </div>
            <img src="../../../public/images/svg/wickedbackground.svg" alt="...">
        </div>
    </div>
    
    <script src="../../../public/js/signup.js"></script>
</body>
</html>