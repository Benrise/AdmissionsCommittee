<?php

function auto_exit(){
    //Expire the session if user is inactive for 30
//minutes or more.
    $expireAfter = 1;

//Check to see if our "last action" session
//variable has been set.
    if(isset($_SESSION['last_action'])){

//Figure out how many seconds have passed
//since the user was last active.
        $secondsInactive = time() - $_SESSION['last_action'];

//Convert our minutes into seconds.
        $expireAfterSeconds = $expireAfter * 60;
//Check to see if they have been inactive for too long.
        if($secondsInactive >= $expireAfterSeconds){
//User has been inactive for too long.
//Kill their session.
            unset($_SESSION['user']);
            session_destroy();
            echo '<script type="text/javascript">alert("Вы отсутствовали больше 1 минуты. Сессия обнулена.")</script>';
            sleep(1);
            echo '<script type="text/javascript">window.location.replace("http://localhost/login.php");</script>';
        }
    }
    $_SESSION['last_action'] = time();
}