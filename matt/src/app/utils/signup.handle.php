<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];
    $errors = [];
    $helllo = "eqqeq";
    $password_errors = [];
    $activation_token = bin2hex(random_bytes(16));
    $activation_token_hash = hash('sha256', $activation_token);
    try
        {
            require_once "db.connection.php"; // DB CONNECTION
            require_once "./MVC/signup/signup_model.inc.php"; // MODEL
            require_once "./MVC/signup/signup_controller.inc.php"; // CONTROLLER
            require_once "./config.session.php"; // CONFIG
            
            /* ERROR HANDLERS */
            if(isInputEmpty($username,$email,$password,$confirm_password)) {
                $errors["empty_input"] = "All fields are required. Please ensure no field is left blank.";
            }
            if(isEmailInvalid($email)) {
                $errors["invalid_email"] = "Email invlaid format";   
            }
            if(isUsernameFormatted($username)){
                $errors["username_format"] = "Username must be in this format ex. FirstName.LastName.";
            }
            if(isUsernameTaken($pdo, $username)){
                $errors["username_taken"] = "Username is taken.";
            }
            if(isEmailRegistered($pdo, $email)){
                $errors["email_register"] = "Email already registered.";
            }
            

            /* PASSWORD ERROR HANDLERS */
            if(isPasswordConfirm($password,$confirm_password)){
                $errors["password_not_match"] = "Passwords do not match. Please try again.";
            }

            if(isPasswordMoreThanEight($password)){
                $password_errors["password_more_than_eight"] = "Password must be at least 8 characters long.";
            }
            if(isPasswordUppercase($password)){
                $password_errors["password_not_uppercase"] = "Password must contain at least one uppercase letter.";
            }
            if(isPaasswordLowercase($password)){
                $password_errors["password_not_lowercase"] = "Password must contain at least one lowercase letter.";
            }
            if(isPasswordHadOneDigit($password)){
                $password_errors["password_has_one_digit"] = "Password must contain at least one digit.";
            }
            if(isPasswordHadOneSpecialSymbol($password)){
                $password_errors["password_one_special_symbol"] = "Password must contain at least one special symbol.";
            }
            if($errors || $password_errors){
                $_SESSION['error_signup'] = $errors;
                $_SESSION['error_signup']["password_valids"] = $password_errors;
                header("Location: ../pages/signup.php");
                die();
            }

            $errors["user_created"] = "The user has been successfully created. Kindly check your email for activation";
            setUser($pdo, $username, $email, $password, $activation_token_hash);

            $mail = require __DIR__. '/mailer.php';

            $mail->setFrom('noreply@example.com');
            $mail->addAddress($email);
            $mail->Subject = "Active activation";
            $mail->Body = <<<END
    
                    Click <a href="http://localhost/matt/src/app/pages/activate-account.php?token=$activation_token">here</a> 
                    to activate your account.
    
        END;
        try{
            $mail->send();
        }
        catch(Exception $e){
            echo ("Message could not be sent. Mailer error: ". $mail->ErrorInfo);
            exit;
        }
            header("Location: ../pages/signup.php?signup=success");

            
            $pdo = null;
            $stmt = null;
            die();

        }
        /* If is failed it execute an error */
        catch(PDOException $e){
            die("Query failed: " . $e->getMessage());
        }
}
else{
    header("Location: ../pages/signup.php");
}
