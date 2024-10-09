<?php

$token = $_GET["token"];

$token_hash = hash("sha256", $token);

include '../utils/db.connection.php';

$query = "SELECT * FROM user WHERE activation_token = :account_token;";

$stmt = $pdo->prepare($query);
$stmt->bindParam(':account_token', $token_hash);
$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC);

if($result === null){
    die('token not found');
}

$query_update = "UPDATE user
                 SET activation_token = NULL
                 WHERE id = :id;
";

$stmt_update = $pdo->prepare($query_update);
$stmt_update->bindParam(':id', $result['id']);
$stmt_update->execute();