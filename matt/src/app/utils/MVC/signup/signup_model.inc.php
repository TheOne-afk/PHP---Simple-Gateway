<?php

// enabling the strict types to true to prevent typos or sumbit the wrong data and so on (optional).
declare(strict_types=1);

function get_username(object $pdo,string $username) {
    $query = "SELECT username FROM user WHERE username = :username;";
    // by sending query our separately from the actually data from the user we now seperate the data from the query
    // which makes something prevent sql injection
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    // fetch type is PDO type refer to FETCH_ASSOC this basically means we can refer the data inside the database using the name of the COLLUMN
    $result = $stmt->fetch(PDO::FETCH_ASSOC); // fetch only grab one peace of data inside the database if you want fetch all the data use fetchAll();
    return $result; //  when we run this function we grab the data or if the user not exist then we execute false statement

}

function get_email(object $pdo,string $email) {
    $query = "SELECT username FROM user WHERE email = :email;";
    // by sending query our separately from the actually data from the user we now seperate the data from the query
    // which makes something prevent sql injection
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    // fetch type is PDO type refer to FETCH_ASSOC this basically means we can refer the data inside the database using the name of the COLLUMN
    $result = $stmt->fetch(PDO::FETCH_ASSOC); // fetch only grab one peace of data inside the database if you want fetch all the data use fetchAll();
    return $result; //  when we run this function we grab the data or if the user not exist then we execute false statement

}

function setUser(object $pdo, string $username, string $email, string $password, string $activation_token){
    $query = "INSERT INTO user (username,email,password,role,activation_token, attempt) VALUES (:username, :email, :password,'user', :activation_token, 0);";
    $stmt = $pdo->prepare($query);
    $hashpassword = password_hash($password, PASSWORD_DEFAULT); // going to hash our password using the Bcrypt algorithm and also going to add a cost factor to it so it's going to slow down the brute forcing process if someone were to try and attack your site.
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $hashpassword);
    $stmt->bindParam(":activation_token", $activation_token);
    $stmt->execute();
}