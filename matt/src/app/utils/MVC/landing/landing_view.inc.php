<?php

declare(strict_types=1);

function output_user(){
    if(isset($_SESSION["user_id"])){
        echo "You are logged in as a user: " . $_SESSION["user_email"];
        unset($_SESSION['user_id']);
    }
    else if(isset($_SESSION["admin_id"])){
        echo "You are logged in as a admin: " . $_SESSION["user_email"];
        unset($_SESSION['user_id']);
    }
}