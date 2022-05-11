<?php
    session_start();
    $servername = "thestashdb.mysql.database.azure.com";
    $username = "Melvin";
    $password = "P@ssw0rd12345";
    $conn = new mysqli($servername, $username, $password);

    if(mysqli_connect_error()){
        die("Connection failed: ".mysqli_connect_error());
    }
    
    if (isset($_POST["questionTitle"]) && isset($_POST["questionDetails"]) && !(isset($_POST["attachFiles"]))){
        $questionTitle = $_POST["questionTitle"];
        $questionDetails = $_POST["questionDetails"];
        $createUser = $conn->prepare("INSERT INTO thestash.questions_raised (question_title,question_body) VALUES (?, ?)");
        $createUser->bind_param("ss", $questionTitle, $questionDetails);
        if(!$createUser->execute()){
            echo '<script>alert("Error!")</script>';
        }
        else{
            $conn -> close();
            header("Location: index.php");
        }
    }
    //lack one mroe condition for picture uploading
    else if(isset($_POST["usernameLogin"]) && isset($_POST["passwordLogin"])){
        $usernameLogin = $_POST["usernameLogin"];
        $passwordLogin = $_POST["passwordLogin"];
        $loginUser = $conn->prepare('SELECT username,`password` FROM thestash.users WHERE username=? and `password`=?');
        $loginUser->bind_param("ss", $usernameLogin, $passwordLogin);
        $loginUser->execute();
        $result = $loginUser->get_result();
        $userInfo = $result->fetch_assoc();
        
        $_SESSION["username"] = $userInfo["username"];
        $_SESSION["password"] = $userInfo["password"];
        if($_SESSION['username'] == null && $_SESSION['password'] == null){
            echo "<script>alert('Wrong username or password!')</script>";
            header("Location: createUser.php");
        }
        else if($_SESSION['username'] == null || $_SESSION['password'] == null){
            echo "<script>alert('Wrong username or password!')</script>";
            header("Location: createUser.php");
        }
        else{
            header("Location: index.php");
        }
    }
?>