<?php

include('./config.session.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include('./MVC/admin_signup/admin_model.inc.php');
    $admin_code = $_POST['admin_code'];
    add_code($pdo, $admin_code);
}