<?php
    session_start();
    $servername = "thestashdb.mysql.database.azure.com";
    $username = "Melvin";
    $password = "P@ssw0rd12345";
    $conn = new mysqli($servername, $username, $password);

    if(mysqli_connect_error()){
        die("Connection failed: ".mysqli_connect_error());
    }
    
    if (isset($_POST["profilePicture"]) && isset($_POST["profilePicture"]) && isset($_POST["username"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $createUser = $conn->prepare("INSERT INTO thestash.users (username,`password`) VALUES (?, ?)");
        $createUser->bind_param("ss", $username, $password);
        $createUser->execute();
        $conn -> close();
        $_SESSION["accountCreation"] = 'TRUE';
        header("Location: createUser.php");
        /*else if($_POST["profilePicture"] && $_POST["profilePicture"] && $_POST["username"] != null){
        
            $createUser = $conn->prepare("INSERT INTO thestash.users (username,`password`, profile_picture)VALUES (?, ?, ?)");
            $createUser->bind_param("ssb", $username, $password, $profilePicture);
            $createUser->execute();
            $conn -> close();
            header("Location: createUser.php");
        }*/
    }
    //lack one mroe condition for picture uploading
    else if(isset($_POST["usernameLogin"]) && isset($_POST["passwordLogin"])){
        $usernameLogin = $_POST["usernameLogin"];
        $passwordLogin = $_POST["passwordLogin"];
        $loginUser = $conn->prepare('SELECT `user_id`,username,`password` FROM thestash.users WHERE username=? and `password`=?');
        $loginUser->bind_param("ss", $usernameLogin, $passwordLogin);
        $loginUser->execute();
        $result = $loginUser->get_result();
        $userInfo = $result->fetch_assoc();
        
        if($userInfo == null){
            $_SESSION["loginFailure"] = 'TRUE';
            $conn -> close();
            header("Location: createUser.php");
        }
        else if($userInfo['username'] == null || $userInfo['password'] == null){
            $_SESSION["loginFailure"] = 'TRUE';
            $conn -> close();
            header("Location: createUser.php");
        }
        else{
            $_SESSION["user_id"] = $userInfo["user_id"];
            $_SESSION["username"] = $userInfo["username"];
            $_SESSION["password"] = $userInfo["password"];
            $conn -> close();
            //login status
            if(isset($_SESSION["username"]) && isset($_SESSION["password"])){
                $_SESSION["loginStatus"] = 'TRUE';
                $_SESSION["confirmLogIn"] = 'TRUE';
            }
            else{
                $_SESSION["loginStatus"] = 'FALSE';
            }
            header("Location: index.php");
        }
        // if($loginUser != null){
        //     while($row = $loginUser->fetch_array(MYSQLI_ASSOC)){
        //         $_SESSION["username"] = $row["username"];
        //         $_SESSION["password"] = $row["password"];
        //         header("Location: index.php");
        //     };
        // }
    }
    if(isset($_GET["search"])){
        $searchInput = $_GET["search"];
        $searchString = "SELECT question_id,question_title,question_body FROM thestash.questions_raised WHERE question_title LIKE '%".$searchInput."%' OR question_body LIKE '%".$searchInput."%'";
        $search = $conn->query($searchString);
        $searchResult = [];
        while ($row = $search -> fetch_array(MYSQLI_ASSOC)){
            $searchResult[] = $row;
        }
        $_SESSION["searchResult"] = $searchResult;
        header("Location: index.php");
    }
    if(isset($_GET["tagName"])){
        echo "yes";
    }
?>