<?php 
    session_start();
    $servername = "thestashdb.mysql.database.azure.com";
    $username = "Melvin";
    $password = "P@ssw0rd12345";
    $conn = new mysqli($servername, $username, $password);

    if(mysqli_connect_error()){
        die("Connection failed: ".mysqli_connect_error());
    }
    $user_id = $_SESSION["user_id"];
    $accountToDelete = $conn->prepare("DELETE FROM thestash.users WHERE `user_id`=?");
    $accountToDelete->bind_param("i", $user_id);
    $accountToDelete->execute();
    if($accountToDelete){
        $_SESSION["deleteStatus"] = "TRUE";
        header("Location: index.php");
    }
    else{
        $_SESSION["deleteStatus"] = 'FALSE';
        header("Location: index.php");
    }
?>