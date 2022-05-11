<?php
    session_start();
    if(isset($_SESSION["loginStatus"])){
        header("Location: postQuestion.php");
    }
    else{
        echo '<script>alert("Oops... Look like you are not logged in....")</script>';
        header("Location: index.php");
    }
?>