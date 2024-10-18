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
            <a href="#">ADIN</a>
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
                <select name="num" id="rowCount">
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
                <tbody>



                </tbody>
                        </table>
                        </div>
            
            <nav>
            <div class="pagination" >
                
            </div>
            </nav>
            </form>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src='../../../public/js/admin_landing_page.js' ></script>
    
</body>
</html>