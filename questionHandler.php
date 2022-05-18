<?php
    session_start();
    $servername = "thestashdb.mysql.database.azure.com";
    $username = "Melvin";
    $password = "P@ssw0rd12345";
    $conn = new mysqli($servername, $username, $password);

    if(mysqli_connect_error()){
        die("Connection failed: ".mysqli_connect_error());
    }
    
    if (isset($_POST["questionTitle"]) && isset($_POST["questionDetails"])){
        $questionTitle = $_POST["questionTitle"];
        $questionDetails = $_POST["questionDetails"];
        $user_id = $_SESSION["user_id"];
        $username = $_SESSION["username"];
        $category_under = $_POST["category"];
        $tags = implode(',',$_POST['tag']);
        
        $postQuestion = $conn->prepare("INSERT INTO thestash.questions_raised (question_title,question_body,user_id_linked,username_of_posting_user,category_under,tags_related) VALUES (?, ?, ?, ?, ?, ?)");
        $postQuestion->bind_param("ssssss", $questionTitle, $questionDetails, $user_id, $username, $category_under, $tags);
        if(!$postQuestion->execute()){
            echo mysqli_error;
        }
        else{
            $conn -> close();
            header("Location: index.php");
        }
    }
    //lack one more condition for picture uploading
?>