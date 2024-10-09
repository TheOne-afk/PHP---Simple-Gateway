<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include('./config.session.php'); // CONFIG
    include('./db.connection.php'); // DB CONNECTION
    
    // MVC
    include('./MVC/admin_signup/admin_model.inc.php'); // Admin
    include('./MVC/admin_signup/admin_controller.inc.php'); // Admin
    include('./MVC/signup/signup_controller.inc.php'); // User


    $admin_username = $_POST['admin-username'];
    $admin_email = $_POST['admin-email'];
    $admin_password = $_POST['admin-password'];
    $admin_confirm_password = $_POST['admin-confirm-password'];
    $admin_code = $_POST['admin-code'];
    $admin_errors = [];
    $admin_password_errors = [];
    $admin_invalid_code = [];

    /* ERROR HANDLERS */
    if(is_admin_fields_empty($admin_username,$admin_email,$admin_password,$admin_confirm_password, $admin_code)) {
        $admin_errors["admin_empty_input"] = "All fields are required. Please ensure no field is left blank.";
    }
    if(isEmailInvalid($admin_email)) {
        $admin_errors["invalid_email"] = "Email invlaid format";   
    }
    if(isUsernameFormatted($admin_username)){
        $admin_errors["username_format"] = "Username must be in this format ex. FirstName.LastName.";
    }

    /* PASSWORD ERROR HANDLERS */
    if(isPasswordConfirm($admin_password,$admin_confirm_password)){
        $admin_errors["password_not_match"] = "Passwords do not match. Please try again.";
    }

    if(isPasswordMoreThanEight($admin_password)){
        $admin_password_errors["password_more_than_eight"] = "Password must be at least 8 characters long.";
    }
    if(isPasswordUppercase($admin_password)){
        $admin_password_errors["password_not_uppercase"] = "Password must contain at least one uppercase letter.";
    }
    if(isPaasswordLowercase($admin_password)){
        $admin_password_errors["password_not_lowercase"] = "Password must contain at least one lowercase letter.";
    }
    if(isPasswordHadOneDigit($admin_password)){
        $admin_password_errors["password_has_one_digit"] = "Password must contain at least one digit.";
    }
    if(isPasswordHadOneSpecialSymbol($admin_password)){
        $admin_password_errors["password_one_special_symbol"] = "Password must contain at least one special symbol.";
    }

    if($admin_errors || $admin_password_errors){
        $_SESSION['error_signup'] = $admin_errors;
        $_SESSION['error_signup']["password_valids"] = $admin_password_errors;
        header("Location: ../pages/admin_signup.php");
        die();
    }

    if(get_code($pdo, $admin_code)){
        set_admin($pdo, $admin_username, $admin_email, $admin_password);
        header("Location: ../pages/admin_signup.php?signup=success");
        $pdo = null;
        $stmt = null;
        die();
    }
    else{
        header("Location: ../pages/admin_signup.php?code=invalid");
    }

}
else{
    header("Location: ../pages/admin_signup.php");
}
