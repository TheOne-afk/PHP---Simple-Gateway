<?php
declare(strict_types=1);

function get_user(object $pdo){
    $query = "SELECT * FROM user";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $result = $stmt->fetchAll();
    return $result;
}

function user_table_actions(object $pdo){
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $create_at = $_POST['create_at'];
        $role = $_POST['role'];
        if(isset($_GET['id'])){
            $id = $_GET['id'];
        }
        
        $query = "UPDATE user SET username = :username, email = :email, create_at = :create, role = :role WHERE id = :id;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':create', $create_at);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':id', $id);
        $stmt->execute();



        if(!isset($_POST['check'])){
            $sql = "UPDATE user SET locked = 0, attempt = 0 WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        }
        else{
            $sql = "UPDATE user SET locked = 1, attempt = 6 WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        }

        
        $sqlqs = "INSERT INTO audit_logs (username, action, timestamp) VALUES ('$username','user_updated,NOW()) ";
        $pdo->exec($sqlqs);
        return true;
    }
}

function cancle_delete(){
    
    if(isset($_POST['no'])){
        return true;
    }
}

function is_yes(object $pdo){
    if(isset($_POST['yes'])){
        if(isset($_GET['delete_id'])){
            $id = $_GET['delete_id'];
        }

        
        $user = $pdo->query("SELECT * FROM user WHERE id = $id")->fetch(PDO::FETCH_ASSOC);
        $_SESSION['userGet'] = $user['username'];
        
        $sql = "DELETE FROM user WHERE id = :id;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $userGet = $_SESSION['userGet'];
        echo "<script>alert(". $userGet .")</script>";
        
        $sqlqs = "INSERT INTO audit_logs (username, action, timestamp) VALUES ('$userGet','user_deleted',NOW()) ";
        $pdo->exec($sqlqs);
        return true;
    }
}

function is_cancel(){
    if(isset($_POST['cancel'])){
        return true;
    }
}