<?php

declare(strict_types=1);
function add_code(object $pdo, string $adminCode, ){
    $expiration = date('Y-m-d H:i:s', strtotime('+1 hour')); // Code valid for 1 hour
    $query = "INSERT INTO admin_codes (code, expiration) VALUES (:code, :expired);";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":code", $adminCode);
    $stmt->bindParam(":expire", $expiration);
    $stmt->execute();

    echo "Admin code added successfully!";
}

function get_code(object $pdo, string $adminCode){
    $query = "SELECT * FROM admin_codes WHERE code = :code AND expiration > NOW();";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":code", $adminCode);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function set_admin(object $pdo, string $adminUser,string $adminEmail, string $adminPass){
            $query = "INSERT INTO user (username,email,password,role) VALUES (:adminUser, :adminEmail, :adminPass, 'admin');";
            $stmt = $pdo->prepare($query);
            $admin_hash_password = password_hash($adminPass, PASSWORD_DEFAULT);
            $stmt->bindParam(":adminUser", $adminUser);
            $stmt->bindParam(":adminEmail", $adminEmail);
            $stmt->bindParam(":adminPass", $admin_hash_password);
            $stmt->execute();
}