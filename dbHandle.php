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
        $createUser = $conn->prepare("INSERT INTO thestash.users (username,`password`)VALUES (?, ?)");
        $createUser->bind_param("ss", $username, $password);
        $createUser->execute();
        $conn -> close();
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
        // if($loginUser != null){
        //     while($row = $loginUser->fetch_array(MYSQLI_ASSOC)){
        //         $_SESSION["username"] = $row["username"];
        //         $_SESSION["password"] = $row["password"];
        //         header("Location: index.php");
        //     };
        // }
    }
    
    /*$catQueryResult = $conn->query($catQuery);

    //category array
    // $catArray = $catQueryResult -> fetch_array(MYSQLI_ASSOC);
    // print_r($catArray);
    $catName = [];
    while ($row = $catQueryResult -> fetch_array(MYSQLI_ASSOC)) {
        //echo $row['category_id'];
        $catName[] =  $row['category_name'];
    }*/
?>