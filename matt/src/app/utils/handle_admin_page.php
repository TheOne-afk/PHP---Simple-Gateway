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
            $count = 1;
            ?>
            <?php
            $num = $count++;
                                ?>
                                <tr class="row">
                                    
                                    <td>#<?php echo $num ?></td>
                                    <td  style="<?php 
                                if(isset($_GET['delete_id'])){
                                    if($_GET['delete_id'] == $row['id']){
                                        echo "border-bottom: 4px solid #D24545; color: #482121; border-radius: 0;";
                                    }
                                }
                                ?>" ><?php 
                                    if(isset($_GET['id'])){
                                        if($_GET['id'] == $row['id']){
                                            echo $row['id'];
                                            
                                        }
                                        else{
                                            echo $row['id'];
                                        }
                                    }
                                    else{
                                        
                                        echo $row['id'];
                                    }
                                    ?></td>
                                    <td style="<?php 
                                if(isset($_GET['delete_id'])){
                                    if($_GET['delete_id'] == $row['id']){
                                        echo "border-bottom: 4px solid #D24545; color: #482121; border-radius: 0;";
                                    }
                                }
                                ?>"  ><?php 
                                    if(isset($_GET['id'])){
                                        if($_GET['id'] == $row['id']){
                                            echo '
                                                <input class="edit-user" type="text" name="username" value="'. $row['username'] .'" />
                                                
                                            ';
                                            
                                        }
                                        else{
                                            echo $row['username'];
                                        }
                                    }
                                    else{
                                        
                                        echo $row['username'];
                                    }
                                    ?></td>
                                    <td style="<?php 
                                if(isset($_GET['delete_id'])){
                                    if($_GET['delete_id'] == $row['id']){
                                        echo "border-bottom: 4px solid #D24545; color: #482121; border-radius: 0;";
                                    }
                                }
                                ?>"  ><?php 
                                    if(isset($_GET['id'])){
                                        if($_GET['id'] == $row['id']){
                                            echo '<input class="edit-email" type="text" name="email" value="'. $row['email'] .'" />';
                                            
                                        }
                                        else{
                                            echo $row['email'];
                                        }
                                    }
                                    else{
                                        
                                        echo $row['email'];
                                    }
                                    ?></td>
                                    <td style="<?php 
                                if(isset($_GET['delete_id'])){
                                    if($_GET['delete_id'] == $row['id']){
                                        echo "border-bottom: 4px solid #D24545; color: #482121; border-radius: 0;";
                                    }
                                }
                                ?>"  ><?php 
                                    if(isset($_GET['id'])){
                                        if($_GET['id'] == $row['id']){
                                            echo '<input class="edit-email" type="text" name="create-at" value="'. $row['create_at'] .'" />';
                                            
                                        }
                                        else{
                                            echo $row['create_at'];
                                        }
                                    }
                                    else{
                                        
                                        echo $row['create_at'];
                                    }
                                    ?></td>
                                    <td style="<?php 
                                if(isset($_GET['delete_id'])){
                                    if($_GET['delete_id'] == $row['id']){
                                        echo "border-bottom: 4px solid #D24545; color: #482121; border-radius: 0;";
                                    }
                                }
                                ?>"  ><?php 
                                    if(isset($_GET['id'])){
                                        if($_GET['id'] == $row['id']){
                                            echo '<input class="edit-role" type="text" name="role" value="'. $row['role'] .'" />';
                                            
                                        }
                                        else{
                                            echo $row['role'];
                                        }
                                    }
                                    else{
                                        
                                        echo $row['role'];
                                    }
                                    ?></td>
                                    <td style="<?php 
                                if(isset($_GET['delete_id'])){
                                    if($_GET['delete_id'] == $row['id']){
                                        echo "border-bottom: 4px solid #D24545; color: #482121; border-radius: 0;";
                                    }
                                }
                                ?>"  ><?php 
                                    if(isset($_GET['id'])){
                                        if($_GET['id'] == $row['id']){
                                            ?>
                                                <input style="cursor: pointer;" type="checkbox" name="check" <?php echo $row['attempt'] >= 6 ? "checked" : "" ?>>
                                                <?php
                                            
                                        }
                                        else{
                                            if($row['attempt'] >= 6){
                                                ?>
                                                <input type="checkbox" name="check" value="1" checked disabled>
                                                <?php
                                            }
                                            else{
                                                ?>
                                                <input type="checkbox" name="check" value="1" disabled>
                                                <?php
                                            }
                                        }
                                    }
                                    else{
                                        if($row['attempt'] >= 6){
                                            ?>
                                            <input type="checkbox" name="check" value="1" checked disabled>
                                            <?php
                                        }
                                        else{
                                            ?>
                                            <input type="checkbox" name="check" value="1" disabled>
                                            <?php
                                        }
                                    }
                                    ?></td>
                                    <td class="action">
                                    <?php 
                                    if(isset($_GET['id'])){
                                        if($_GET['id'] == $row['id']){
                                            ?>
                                                <button type="submit" name="submit" class="submit">
                                                    <img src="../../../public/images/svg/check.svg" alt="..." height="23" width="23">
                                                </button>
                                            <?php
                                            
                                        }
                                        else{
                                            ?>
                                                <a class="edit"  href="admin_landing.php?page_no=<?= $page_no ?>&id=<?= $row['id'] ?>">
                                                    <img src="../../../public/images/svg/edit-button.svg" alt="edit" height="23" width="23" >
                                                </a>
                                                <?php
                                            ;
                                        }
                                    }
                                    else{
                                        if(!isset($_GET['delete_id'])){
                                            ?>
                                        <a class="edit"  href="admin_landing.php?page_no=<?= $page_no ?>&id=<?= $row['id'] ?>">
                                            <img src="../../../public/images/svg/edit-button.svg" alt="edit" height="23" width="23" >
                                        </a>
                                        <?php
                                        }
                                    }
                                    ?>

                                    <?php 
                                    if(isset($_GET['id'])){
                                        if($_GET['id'] == $row['id']){
                                            ?>
                                                <button type="submit" name="cancel" class="cancel">
                                                    <img src="../../../public/images/svg/close.svg" alt="..." height="23" width="23">
                                                </button>
                                            <?php
                                            
                                        }
                                        else{
                                            ?>
                                            <a class="delete" href="admin_landing.php?page_no=<?= $page_no ?>&delete_id=<?= $row['id'] ?>"> 
                                            <img src="../../../public/images/svg/delete.svg" alt="edit" height="23" width="23" >
                                            </a>
                                            <?php
                                        }
                                    }
                                    else{
                                        if(!isset($_GET['delete_id'])){
                                            ?>
                                            <a class="delete"  href="admin_landing.php?page_no=<?= $page_no ?>&delete_id=<?= $row['id'] ?>"> 
                                            <img src="../../../public/images/svg/delete.svg" alt="edit" height="23" width="23" >
                                            </a>
                                            <?php
                                        }
                                    }
                                    /* DELETE FUNCTION */
                                    /* Yes BTN */
                                    if(isset($_GET['delete_id'])){
                                        if($_GET['delete_id'] == $row['id']){
                                            ?>
                                                <button type="submit" name="yes" class="yes">
                                                    <img src="../../../public/images/svg/letter-y.svg" alt="yes" height="23" width="23">
                                                </button>
                                            <?php
                                            
                                        }
                                        else{
                                            ?>
                                            <a class="edit"  href="admin_landing.php?page_no=<?= $page_no ?>&id=<?= $row['id'] ?>">
                                                <img src="../../../public/images/svg/edit-button.svg" alt="edit" height="23" width="23" >
                                            </a>
                                            <?php
                                            ;
                                        }
                                    }
                                    
                                    /* No BTN */
                                    if(isset($_GET['delete_id'])){
                                        if($_GET['delete_id'] == $row['id']){
                                            ?>
                                                <button type="submit" name="no" class="no">
                                                    <img src="../../../public/images/svg/letter-n.svg" alt="no" height="23" width="23">
                                                </button>
                                            <?php
                                            
                                        }
                                        else{
                                            ?>
                                                
                                                <a class="delete" href="admin_landing.php?page_no=<?= $page_no ?>&delete_id=<?= $row['id'] ?>"> 
                                                <img src="../../../public/images/svg/delete.svg" alt="edit" height="23" width="23" >
                                                </a>
                                                <?php
                                            ;
                                        }
                                    }
                                    
                                    ?>



                                    <!--  -->
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
                    <td class="n-a" >---</td>
                    <td class="n-a" >---</td>
                    <td class="n-a" >---</td>
                </tr>
        <?php
    }
}

?>