<?php

$dsn = "mysql:host=localhost;dbname=simplelogindb";
$user = "root";
$pass = "";

try{
    $pdo = new PDO($dsn,$user,$pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    die("Connect failed: ". $e->getMessage());
}