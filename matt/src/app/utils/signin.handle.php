<?php


if($_SERVER["REQUEST_METHOD"] === "POST"){
    $username = $_POST['email'];
    $password = $_POST['password'];
    $errors = [];
    $_SESSION['count'] = 0;
    $time = date('H:i:s');
    $resetTimeLimit = 30;
    $locked=[];
    

    try{

        require_once "./db.connection.php";
        require_once "./MVC/signin/signin_model.inc.php";
        require_once "./MVC/signin/signin_controller.inc.php";
        require_once "./config.session.php";

        $result = get_user($pdo, $username);
        $current_time = strtotime($time);
        $unlock_time = strtotime($result['begin']);

        
        if($current_time < $unlock_time){
            user_freeze($pdo,$username,$result['attempt']);
            header('Location: ../pages/signin.php?tempo_lock=true');
            exit();
        }
        
        if($result['attempt'] > 7){
            header('Location: ../pages/signin.php?locked=true');
            exit();
        }

        if (!isset($_SESSION['start_time'])) {
            $_SESSION['start_time'] = time(); // Save the start time
        }

        

        /* ERROR HANDLERS */
        if(emptyField($username,$password)){
            $errors["empty_signin_field"] = "All fields are required. Please ensure no field is left blank.";
            
        }

        if (is_username_wrong($result)){
            $errors["login_error"] = "Incorrect login info!";
        }
                                                // field,     getting the column name of the user
        if((!is_username_wrong($result) && is_password_wrong($password, $result["password"])) ){
            
                     
            if($result['attempt'] == 4){
                    get_attempt($pdo, $username, $result['attempt'] + 1);
                    $errors["login_error"] = "Incorrect password";
            }
            if($result['locked'] == 1){
                user_freeze($pdo, $username, $result['attempt'] + 1);
                $errors["login_error"] = "Incorrect password";
            }
            if($result['locked'] == 0){
                update_attempt($pdo, $username, $result['attempt'] + 1);
                $errors["login_error"] = "Incorrect password";

            }
            
            
        }
        if((!is_username_wrong($result) && !is_password_wrong($password, $result["password"])) && $result['activation_token'] !== NULL ){
            $errors["login_error"] = "Account haven't been activate. Kindly check your email";
        }

        if($errors){
            $_SESSION['error_signin'] = $errors;
            header("Location: ../pages/signin.php");
            die();
        }

        
        if($result['attempt'] <= 8){
            $newSession = session_create_id();
            $sessionId = $newSession . "_" . $result["id"];
            session_id($sessionId);
    
            // outputing the data from the user to the client side.
            if($result['role'] === 'user'){
                $_SESSION["user_id"] = $result["id"];
            }
            if($result['role'] === 'admin'){
                $_SESSION["admin_id"] = $result["id"];
            }
    
            
            $_SESSION["user_email"] = htmlspecialchars($result["email"]);
            // every 30mins updated the session again
            $_SESSION["last_regeneration"] = time();
            header("Location: ../pages/landing.php?".$sessionId."");
            $pdo = null;
            $stmt = null;
            die();
        }

    } catch(PDOException $e){
        die("Query failed: ". $e->getMessage());
    }
} else {
    header("Location: ../pages/signin.php");
}