<?php

declare(strict_types=1);

function get_role(object $pdo, string $email){
    if(get_user($pdo, $email)){
        echo "Hello user";
    }
    else if(get_admin($pdo, $email)){
        echo "Hello user";
    }
}

function get_user(object $pdo, string $email){
    $query = "SELECT * FROM user WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function get_admin(object $pdo, string $email){
    $query = "SELECT * FROM admin WHERE admin_email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    if($stmt){
        return "";
    }
    else{
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}