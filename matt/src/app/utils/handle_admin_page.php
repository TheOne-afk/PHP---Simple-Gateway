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
$_SESSION['pages']  = 10;
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
if (isset($_POST['input'])) {
    $inputData = $_POST['input'] . '%'; // Add wildcard for LIKE query

    // Prepare the SQL statement
    $sql = "SELECT * FROM user WHERE username LIKE :input";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':input', $inputData);
    $stmt->execute();

    // Fetch and display the results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($results) {
        foreach ($results as $row) {
            ?>
            <tr>
            <td class="id" ><?php echo $row['id'] ?></td>
                <td class="username"><?php echo $row['username'] ?></td>
                <td>
                <button class="edit-button">Edit</button>
                <button class="save-button" style="display:none;">Save</button>
                </td>
            </tr>
            <?php

        }
    } else {
        ?>
                <tr>
                    <td class="n-a" >---</td>
                    <td class="n-a" >---</td>
                    <td class="n-a" >---</td>
                    <td class="n-a" >---</td>
                    <td class="n-a" >---</td>
                </tr>
        <?php
    }
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the posted data
    $username = isset($_POST['username']) ? $_POST['username'] : "";
    $id =  isset($_POST['id']) ? $_POST['id'] : "";

    try {
        // Prepare the update statement
        $sql = "UPDATE user SET username = :username WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':id', $id);

        // Execute the statement
        if ($stmt->execute()) {
            echo json_encode(['message' => 'Username updated successfully!']);
            exit;
        } else {
            echo json_encode(['message' => 'Failed to update username.']);
            exit;
        }
    } catch (PDOException $e) {
        echo json_encode(['message' => 'Error: ' . $e->getMessage()]);
        exit;
    }
}


?>