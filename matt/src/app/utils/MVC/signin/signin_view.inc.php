<?php

declare(strict_types=1);

function empty_field(){
    if(session_method('empty_signin_field')){
        echo '<span id="requriedValid">'. session_method('empty_signin_field') .'</span>';
        unset_session();
    }
}


function email_wrong(){
    if(session_method('login_error')){
        echo '<span id="requriedValid">'. session_method('login_error') .'</span>';
        unset_session();
    }
    else if(isset($_GET["login"]) && $_GET['login'] === "success"){
        echo '<span id="userCreated" >The user has been successfully login.</span>';
    }
}

function logout_count(){
    if(session_method('login_count')){
        echo '<span id="countdown">'. session_method('login_count') .'</span>';
        unset_session();
    }
}

function session_method(string $errorMessage){
    if(isset($_SESSION['error_signin']) && isset($_SESSION['error_signin'][$errorMessage])){
        return $_SESSION['error_signin'][$errorMessage];
    }
    return null;  // Return null if the key does not exist
}


/* unset method */
function unset_session(){
    if(isset($_SESSION['error_signin'])){
    unset($_SESSION['error_signin']);
    }
}

