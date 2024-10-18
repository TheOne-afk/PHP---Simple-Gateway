<?php
include '../utils/handle_admin_logs.php';
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
            <div>
                <div class="option-container">
                <img src="../../../public/images/svg/profile.svg" alt="user" height="30" width="30">
                <a href="../pages/admin_landing.php">Users</a>
                </div>
            </div>
            <div  class="selected-wrapper">
                <div class="option-container  selected">
                <img src="../../../public/images/svg/profile.svg" alt="user" height="30" width="30">
                <a href="#">Audit logs</a>
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
                            
                <thead>
                <tr>
                    <td>#</td>
                    <td>Username</td>
                    <td>Status</td>
                    <td>Timestamp</td>
                </tr>
                </thead>
                            <tbody class="table-body" id="searchresult">
                <?php
                $count = 1;
                            foreach($resultRecords as $row){
                                $num = $count++;
                                ?>
                                <tr class="row">
                                    
                                    <td>#<?php echo $num ?></td>
                                    <td><?php echo $row['username']?></td>
                                    <td><?php echo $row['action']?></td>
                                    <td><?php echo $row['timestamp']?></td>
                                </tr>
                                <?php
                                
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
<script src='../../../public/js/admin_landing_page.js' ></script>
    
</body>
</html>