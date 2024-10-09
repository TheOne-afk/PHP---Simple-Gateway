<?php

include 'db.connection.php';
include '../utils/MVC/admin_page/admin_page.model.php';

$result = get_user($pdo);

$update_user = user_table_actions($pdo);

if(isset($_POST['logout'])){
    session_start();
    session_destroy();
    header("Location: ../pages/signin.php");
    exit();
}