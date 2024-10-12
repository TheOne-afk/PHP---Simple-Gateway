<?php

declare(strict_types=1);

function get_user(object $pdo, string $user){
    $query = "SELECT * FROM user WHERE username = :user;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user", $user);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function get_attempt(object $pdo, string $username){
    $lock_time =  date('Y-m-d H:i:s', strtotime('+30 seconds'));
    $current_time = date('Y-m-d H:i:s');
    $query = "
    UPDATE user SET locked = 0, begin = :begin
    WHERE username = :username
    ";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":begin", $lock_time);
    $stmt->bindParam(":username", $username);
    $stmt->execute();
}

function update_attempt(object $pdo, string $username, int $count){
    $query = "UPDATE user SET attempt = :count WHERE username = :username";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":count", $count);
    $stmt->bindParam(":username", $username);
    $stmt->execute();
}

function user_freeze(object $pdo, string $username, int $count){
    $query = "
    UPDATE user SET attempt = :count, locked = 1
    WHERE username = :username
    ";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":count", $count);
    $stmt->bindParam(":username", $username);
    $stmt->execute();
}

