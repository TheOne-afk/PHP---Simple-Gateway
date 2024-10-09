<?php

// enabling the strict types to true to prevent typos or sumbit the wrong data and so on (optional).
declare(strict_types=1);

function isInputEmpty(string $username,string $email,string $password,string $confirm_password){
    if(empty($username) || empty($email) || empty($password) || empty($confirm_password)){
        return true;
    }
}

function isEmailInvalid(string $email){
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return true;
    }
    else {
        return false;
    }
}

function isUsernameFormatted(string $username){

    if(!preg_match('/[a-zA-Z]+\.[a-zA-Z]+$/', $username)){
        return true;
    }
    else {
        return false;
    }
}


function isPasswordConfirm(string $password, string $confirm_password){
    if($password != $confirm_password){
        return true;
    }
    else{
        return false;
    }
}

function isUsernameTaken(object $pdo, string $username){
    if(get_username($pdo,$username)){
        return true;
    }
    else{
        return false;
    }
}

function isEmailRegistered(object $pdo, string $email){
    if(get_email($pdo, $email)){
        return true;
    }
    else{
        return false;
    }
}

function isPasswordMoreThanEight(string $password){
    if(strlen($password) < 8){
        return true;
    }
    else{
        return false;
    }
}

function isPasswordUppercase(string $password){
    if(!preg_match('/[A-Z]/', $password)){
        return true;
    }
    else{
        return false;
    }
}

function isPaasswordLowercase(string $password){
    if(!preg_match('/[a-z]/', $password)){
        return true;
    }
}

function isPasswordHadOneDigit(string $password){
    if(!preg_match('/\d/', $password)){
        return true;
    }
    else{
        return false;
    }
}

function isPasswordHadOneSpecialSymbol(string $password){
    if(!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)){
        return true;
    }
    else{
        return false;
    }
}

function createUser(object $pdo, string $username, string $email, string $password, string $actation_hash){
    setUser( $pdo,  $username,  $email,  $password, $actation_hash);
}