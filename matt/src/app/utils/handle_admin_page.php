<?php

include 'db.connection.php';
include '../utils/MVC/admin_page/admin_page.model.php';
session_start();
$result = get_user($pdo);

$update_user = user_table_actions($pdo);


if(isset($_GET['page_no']) && $_GET['page_no'] !== ""){
    $page_no = $_GET['page_no'];
} else {
    $page_no = 1;
}

if(isset($_POST['filter'])){
    $page_records = intval($_POST['num']);
    $_SESSION['pages'] = $page_records;
}
$total_records_per_page = $_SESSION['pages']; // default
$offset = ($page_no - 1) * $total_records_per_page;
$previous_pagee = $page_no - 1;
$next_page = $page_no + 1;

$result_count = "SELECT COUNT(*) as total_records FROM user";
$stmt = $pdo->prepare($result_count);
$stmt->execute();
$resultRec = $stmt->fetch();
$total_records = $resultRec['total_records'];
$total_no_of_pages = ceil($total_records / $total_records_per_page);

// displaying the rows based on the limits
$sql = "SELECT * FROM user LIMIT $offset, $total_records_per_page;";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$resultRecords = $stmt->fetchAll();

if(isset($_POST['logout'])){
    session_start();
    session_destroy();
    header("Location: ../pages/signin.php");
    exit();
}


if(cancle_delete()){
    header("Location: admin_landing.php?page_no=".$page_no."");
}
if(is_yes($pdo)){
    header("Location: admin_landing.php?page_no=".$page_no);
}
if(is_cancel()){
    header("Location: admin_landing.php?page_no=".$page_no);
}
if(user_table_actions($pdo)){
    return header("Location: admin_landing.php?page_no=".$page_no."&update=success");
}