<?php

/* SESSION SECURITY */
/* Scenario: What if a hacker begin to access to our session id that's why
             we want to update the session every 30mins  to make sure people
            less time to do any sort of damage to our session id.
*/

/* setting the ini settings setting therese 2 lines into true */
ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);


session_set_cookie_params([
    'lifetime' => 1800,
    'domain' => 'localhost',
    'path' => '/',
    'secure' => true, // only use this cookie on the secure location like http connection
    'httponly' => true // to avoid users to change anything about this cookie for example javascript
]);

session_start();

// If user login to the site perform this statement if is not perform the else statement
if(isset($_SESSION["user_id"])){

    if(!isset($_SESSION["last_regeneration"])){
        regenerate_session_loggin_id();
    
    }else{
        $interval = 60 * 30; // 30mins
        // if time session is more than the interval then execute this statement
        if(time() - $_SESSION["last_regeneration"] >= $interval){
            regenerate_session_loggin_id();
        }
    }

}else
{
    

/* If is not session exist in my website then perform this if not perfom else */
if(!isset($_SESSION["last_regeneration"])){
    regenerate_session_id();

}else{
    $interval = 60 * 30; // 30mins
    // if time session is more than the interval then execute this statement
    if(time() - $_SESSION["last_regeneration"] >= $interval){
        regenerate_session_id();
    }
}

}

function regenerate_session_loggin_id(){

    session_regenerate_id(true); 
    $userId = $_SESSION["user_id"]; // grab the user id when it login
    $newSession = session_create_id(); // create a new session id
    $sessionId = $newSession . "_" . $userId; // set session id
    session_id($sessionId);

    

    $_SESSION["last_regeneration"] = time(); 
}

function regenerate_session_id(){
    session_regenerate_id(true);
    $_SESSION["last_regeneration"] = time();   // Getting the updated session timestamp
}