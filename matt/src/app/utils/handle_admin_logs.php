<?php

include '../utils/db.connection.php';

if(isset($_GET['page_no']) && $_GET['page_no'] !== ""){
    $page_no = $_GET['page_no'];
} else {
    $page_no = 1;
}
$_SESSION['pages']  = 10;
if(isset($_POST['filter'])){
    $page_records = intval($_POST['num']);
    $_SESSION['pages'] = $page_records;
}
$total_records_per_page = $_SESSION['pages']; // default
$offset = ($page_no - 1) * $total_records_per_page;
$previous_pagee = $page_no - 1;
$next_page = $page_no + 1;

$result_count = "SELECT COUNT(*) as total_records FROM audit_logs";
$stmt = $pdo->prepare($result_count);
$stmt->execute();
$resultRec = $stmt->fetch();
$total_records = $resultRec['total_records'];
$total_no_of_pages = ceil($total_records / $total_records_per_page);

// displaying the rows based on the limits
$sql = "SELECT * FROM audit_logs LIMIT $offset, $total_records_per_page;";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$resultRecords = $stmt->fetchAll();

