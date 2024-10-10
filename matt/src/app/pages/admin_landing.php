<?php
include '../utils/handle_admin_page.php';
include '../utils/db.connection.php';

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
            <div class="top-wrapper" >
            <div class="dropdown">
                <select name="num" id="num">
                <option value="10">10</option>
                    <option value="15">15</option>
                </select>
                <button id="filter" type="submit" name="filter">
                    <img src="../../../public/images/svg/filter.svg" alt="..." height="20" width="20">
                </button>
            </div>
            <div>
                <input type="text" id="search" placeholder="Search">
            </div>
            </div>
            <div class="wrap" >
                <table>
                </table>
            <table>
                    <?php 
                        if($result){
                            ?>
                            
                <thead>
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
                </thead>
                        <?php
                        }
                        if(!isset($_POST['input'])){
                            ?>
                            <tbody class="table-body" id="searchresult">
                <?php
                $count = 1;
                            foreach($resultRecords as $row){
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
                        }
                        ?>
                        </tbody>
                            <?php
                        ?>
                        </table>
                        </div>
            
            <nav>
            <div class="pagination" >
                    
                    <a class="<?= ($page_no <= 1) ? "disable" : ""  ?>" <?= ($page_no > 1) ? 'href=?page_no='.$previous_pagee : '' ?>><</a>
                    <?php 
                    for($counter = 1; $counter <= $total_no_of_pages; $counter++){?>
                    <a class="<?php
                    if(isset($_GET['page_no'])){
                        if($_GET['page_no'] == $counter){
                            echo "selected_page";
                        }
                        
                    }
                    else{
                        if($counter === 1){
                            echo "selected_page";
                        }
                    }
                    ?>" href="?page_no=<?= $counter ?>"><?= $counter ?></a>
                    <?php 
                    }
                    ?>
                    
                    <a class="<?= ($page_no >= $total_no_of_pages) ? "disable" : "" ?>" <?= ($page_no <  $total_no_of_pages) ? 'href=?page_no='.$next_page : '' ?>>></a>
                
            </div>
            </nav>
            </form>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript" >
    /* Ajaw */
    $(document).ready(function(){ // first it add a function to the document, means it is ready
        $('#search').keyup(function(){ // getting the events in input, gettings the keys
            let input = $(this).val(); // $(this) - this element | val() - get value
            // alert(input);

            if(input != ""){ // if the input is empty the perform this
                $.ajax({ // and by using the ajax method is like a object
                    url: "../utils/handle_admin_page.php", // direct to this page
                    method: "POST", // and using the post method
                    data: {input: input}, // with the data input

                    success:function(data){ // after successfully 
                        $('#searchresult').html(data) // then the data will display on this section
                    }
                })
            }
        })
    })
</script>
    
</body>
</html>