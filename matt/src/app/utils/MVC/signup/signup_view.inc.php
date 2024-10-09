<?php

// enabling the strict types to true to prevent typos or sumbit the wrong data and so on (optional).
declare(strict_types=1);

function user_message(){
    if(session_method('empty_input')){
        echo '<span id="requriedValid" >'. session_method('empty_input') .'</span>';
        unset_session();
    }
    else if(isset($_GET["signup"]) && $_GET["signup"] === "success"){
        echo '<span id="userCreated" >The user has been successfully created. <br>Kindly check your email for activation</span>';
    }
}

function admin_message(){
    if(session_method('admin_empty_input')){
        echo '<span id="requriedValid" >'. session_method('admin_empty_input') .'</span>';
        unset_session();
    }
    else if(isset($_GET["code"]) && $_GET["code"] === "invalid"){
        echo '<span id="requriedValid" >Invalid or expired code.</span>';
    }
}

/* Username format */
function username_format_error(){
    if(session_method('username_format')){
        echo '<span id="userValid" >'. session_method('username_format') .'</span>';
        unset_session();
    }
}

/* Username is taken */
function username_is_taken(){
    if(session_method('username_taken')){
        echo '<span id="userTaken">'. session_method('username_taken') .'</span>';
        unset_session();
    }
}

/* Email Format */
function is_email_correct(){
    if(session_method('invalid_email')){
        echo '<span id="emailValid">'. session_method('invalid_email') .'</span>';
        unset_session();
    }
}

/* Is Password Match the Confirm Password */
function is_password_match(){
    if(session_method('password_not_match')){
        echo '<span id="confirmPassValid">'. session_method('password_not_match') .'</span>';
        unset_session();
    }
}

function is_password_errors(){
    if(isset($_SESSION['error_signup']["password_valids"])){
        $errors = $_SESSION['error_signup']["password_valids"];

        foreach ($errors as $error){
            echo '<span id="passValid" >'. $error .'</span>';
        }

        unset($_SESSION['error_signup']["password_valids"]);
    }
}

/* Session method (DIY Principle) */
function session_method(string $errorMessage){
    if(isset($_SESSION['error_signup']) && isset($_SESSION['error_signup'][$errorMessage])){
        return $_SESSION['error_signup'][$errorMessage];
    }
    return null;  // Return null if the key does not exist
}

/* unset method */
function unset_session(){
    if(isset($_SESSION['error_signup'])){
    unset($_SESSION['error_signup']);
    }
}