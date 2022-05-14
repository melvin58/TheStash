<?php
    session_start();
    if(isset($_SESSION["loginStatus"]) && $_SESSION["loginStatus"] == "TRUE"){
        header("Location: postQuestion.php");
    }
    else{
        $_SESSION["posting_error"] = "TRUE";
        header("Location: index.php");
    }
?>