<?php
    session_start();
    if(isset($_SESSION["loginStatus"]) && $_SESSION["loginStatus"] == 'TRUE'){
        header("Location: profile.php");
    }
    else{
        header("Location: createUser.php");
    }
?>