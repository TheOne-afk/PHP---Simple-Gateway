<?php
require_once "../utils/MVC/signup/signup_view.inc.php";
require_once '../utils/config.session.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link rel="stylesheet" href="../../../public/css/global.css">
    <link rel="stylesheet" href="../../../public//css//signup.css">
</head>
<body>
    <div class="sign-up-container admin-signup-container" >
        <form action="../utils/admin.handle.php" method="POST">
            <span><h1>Create</h1><h1>account</h1></span>

            <?php admin_message(); ?>

            <!-- Admin username -->
            <div class="field-container" id="admin-username-container">
                <div>
                <input type="text" name="admin-username" id="admin-username"  placeholder="Username" oninput="onInputChange()" >
                <img src="../../../public/images/svg/person.svg" width="30" height="30" alt="profile">
                </div>
                <?php username_format_error() ?>
            </div>

            <!-- Admin Email -->
            <div class="field-container" id="admin-email-container">
                <div>
                <input type="text" name="admin-email" id="admin-email" placeholder="Email" oninput="onInputChange()"  >
                <img src="../../../public/images/svg/envelope.svg" width="25" height="25" alt="email">
                </div>
                <?php is_email_correct() ?>
            </div>

            <!-- Admin password -->
            <div class="field-container" id="admin-password-container">
                <div>
                <input type="password" name="admin-password" id="admin-password" placeholder="Password" oninput="onInputChange()"  >
                <img src="../../../public/images/svg/lock.svg" width="25" height="25" alt="profile">
                </div>
                <?php is_password_errors(); ?>
            </div>

            <!-- Admin confirm password -->
            <div class="field-container" id="admin-confirm-password-container">
                <div>
                <input type="password" name="admin-confirm-password" id="admin-confirm-password" placeholder="Confirm password" oninput="onInputChange()"  >
                <img src="../../../public/images/svg/lock.svg" width="25" height="25" alt="..." >
                </div>
            </div>

            <!-- Admin Code -->
            <div class="field-container" id="admin-code-container">
                <div>
                <input type="text" name="admin-code" id="admin-code" placeholder="Admin code" oninput="onInputChange()"  >
                <img src="../../../public/images/png/c.png" width="25" height="25" alt="..." >
                </div>
            </div>

            <div>
            </div>

            <div class="submit-container">
            <input type="submit" value="Sign up" name="submit" >
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
    
    <script src="../../../public/js/admin_signup.js"></script>
</body>
</html>