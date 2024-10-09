<?php
include '../utils/handle_admin_page.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../public/css/admin.css">
</head>
<body>

<div class="container">
    <div class="navbar">
        <div class="logo-container">
        <img src="../../../public/images/svg/ireland-coffee.svg" alt="user" height="35" width="35">
            <a href="#">ADMIN</a>
        </div>
    </div>
    <div class="secondary-container">
        <div class="sidebar">
            <div class="options" >
            <div>
                <div class="option-container">
                <img src="../../../public/images/svg/dashboard.svg" alt="user" height="22" width="22">
                    <a href="#">Dashboard</a>
                </div>
            </div>
            <div  class="selected-wrapper">
                <div class="option-container selected">
                <img src="../../../public/images/svg/profile.svg" alt="user" height="30" width="30">
                <a href="#">Users</a>
                </div>
            </div>
            </div>
            <div  class="logout-wrapper">
                <div class="logout-container">
                <img src="../../../public/images/svg/logout.svg" alt="logout" height="25" width="25">
                <form  method="POST">
                <button name="logout">Logout</button>
                </form>
                </div>
            </div>
        </div>
        <form class="main-container" method="POST" action="<?php echo $update_user ?>">
            <table>
                    <?php 
                        if($result){
                            ?>
                            
                <tr>
                    <td>#</td>
                    <td>ID</td>
                    <td>Username</td>
                    <td>Email</td>
                    <td>Created at</td>
                    <td>Role</td>
                    <td>Locked</td>
                    <td>Action</td>
                </tr>
                <?php
                $count = 1;
                            foreach($result as $row){
                                $num = $count++;
                                ?>
                                <tr class="row">
                                    
                                    <td><?php echo $num ?></td>
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
                                                <a class="edit"  href="admin_landing.php?id=<?php echo $row["id"] ?>">
                                                    <img src="../../../public/images/svg/edit-button.svg" alt="edit" height="23" width="23" >
                                                </a>
                                                <?php
                                            ;
                                        }
                                    }
                                    else{
                                        if(!isset($_GET['delete_id'])){
                                            ?>
                                        <a class="edit"  href="admin_landing.php?id=<?php echo $row["id"] ?>">
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
                                            <a class="delete" href="admin_landing.php?delete_id=<?php echo $row["id"] ?>"> 
                                            <img src="../../../public/images/svg/delete.svg" alt="edit" height="23" width="23" >
                                            </a>
                                            <?php
                                        }
                                    }
                                    else{
                                        if(!isset($_GET['delete_id'])){
                                            ?>
                                            <a class="delete" href="admin_landing.php?delete_id=<?php echo $row["id"] ?>"> 
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
                                            <a class="edit"  href="admin_landing.php?id=<?php echo $row["id"] ?>">
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
                                                
                                                <a class="delete" href="admin_landing.php?delete_id=<?php echo $row["id"] ?>"> 
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
                        }
                        else{
                            ?>
                            <tr>
                                <td>No Record Found</td>
                            </tr>
                            <?php
                        }
                    ?>
            </table>
                    </form>
    </div>
</div>

    
</body>
</html>