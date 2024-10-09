<?php

declare(strict_types=1);


function is_admin_fields_empty(string $admin_username,string $admin_email,string $admin_password,string $admin_confirm_password,string $admin_code){
    if(empty($admin_username) || empty($admin_email) || empty($admin_password) || empty($admin_confirm_password) || empty($admin_code)){
        return true;
    }
    else{
        return false;
    }
}