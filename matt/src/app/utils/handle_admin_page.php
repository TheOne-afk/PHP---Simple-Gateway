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
        $count = 0;
        foreach ($results as $row) {
            $count+=1;
            ?>
            <tr class="row" >
                <td>#<?php echo $count ?></td>
                <td class="id" ><?php echo $row['id'] ?></td>
                <td class="username"><?php echo $row['username'] ?></td>
                <td class="email"><?php echo $row['email'] ?></td>
                <td class="create_at"><?php echo $row['create_at'] ?></td>
                <td class="role"><?php echo $row['role'] ?></td>
                <td>
                <?php if ($row['locked'] == 1) { ?>
                    <input class="checked" type="checkbox" checked disabled>
                <?php } else { ?>
                    <input class="check" type="checkbox" disabled>
                <?php } ?>
                </td>
                <!-- Edit Actions -->
                <td>
                 <div class="action-container" >
                <!-- Edit Feature -->
                <button class="edit edit-button">
                <img src="../../../public/images/svg/edit-button.svg" alt="edit" height="23" width="23" >
                </button>
                <!-- Save/Submit Feature -->
                <button class="submit save-button" style="display:none;">
                <img src="../../../public/images/svg/check.svg" alt="..." height="23" width="23">
                </button>
                <!-- Cancel Feature -->
                 <button class="cancel-button" style="display:none;" >cancel</button>
                
                <!-- Delete Action -->
                <!-- Delete Feature -->
                 <button class="delete delete-button" >
                 <img src="../../../public/images/svg/delete.svg" alt="..." height="23" width="23">
                </button>
                <!-- Submit Delete Feature -->
                 <button class="yes submit-delete-button" style="display:none;" >
                 <img src="../../../public/images/svg/letter-y.svg" alt="..." height="23" width="23">
                </button>
                 </div>
                </td>
            </tr>
            <?php

        }
    }
    else {
        ?>
                <tr>
                    <td class="n-a" >---</td>
                    <td class="n-a" >---</td>
                    <td class="n-a" >---</td>
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
    $action = isset($_POST['action']) ? $_POST['action'] : null;
    // Get the posted data
    $username = isset($_POST['username']) ? $_POST['username'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $role = isset($_POST['role']) ? $_POST['role'] : "";
    $id =  isset($_POST['id']) ? $_POST['id'] : "";
    $check = isset($_POST['check']) && $_POST['check'] == 'true';
    
    if($action === 'update'){
     
         try {
             // Prepare the update statement
             if ($check) {
                 $sql = "UPDATE user SET username = :username, email = :email, role = :role, locked = 1, attempt = 8 WHERE id = :id";
             } else {
                 $sql = "UPDATE user SET username = :username, email = :email, role = :role, locked = 0, attempt = 0 WHERE id = :id";
             }
     
             $stmt = $pdo->prepare($sql);
             $stmt->bindParam(':username', $username);
             $stmt->bindParam(':email', $email);
             $stmt->bindParam(':role', $role);
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
   if($action === 'delete'){
    $id =  isset($_POST['id']) ? $_POST['id'] : "";
    try{
        $sql = "DELETE FROM user WHERE id = :userId";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':userId', $id);
        if ($stmt->execute()) {
            echo json_encode(['message' => 'Username updated successfully!']);
            exit;
        } else {
            echo json_encode(['message' => 'Failed to update username.']);
            exit;
        }

    }
    catch(PDOException $e){
        echo json_encode(['message' => 'Error: ' . $e->getMessage()]);
        exit;
    }
   }
}


?>