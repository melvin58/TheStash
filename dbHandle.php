<?php
    $servername = "thestashdb.mysql.database.azure.com";
    $username = "Melvin";
    $password = "P@ssw0rd12345";
    $conn = new mysqli($servername, $username, $password);

    if(mysqli_connect_error()){
        die("Connection failed: ".mysqli_connect_error());
    }
    else{
        $profilePicture = $_POST["profilePicture"];
        $username = $_POST["username"];
        $password = $_POST["password"];

        if($profilePicture != null){
            $createUser = $conn->prepare("INSERT INTO thestash.users (username,`password`)VALUES (?, ?)");
            $createUser->bind_param("ss", $username, $password);
            $createUser->execute();
        }
        else{
            $createUser = $conn->prepare("INSERT INTO thestash.users (username,`password`, profile_picture)VALUES (?, ?, ?)");
            $createUser->bind_param("ssb", $username, $password, $profilePicture);
            $createUser->execute();
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
        $conn -> close();
        header("Location: index.php");
    }
?>