<?php 
    session_start();
    $servername = "thestashdb.mysql.database.azure.com";
    $username = "Melvin";
    $password = "P@ssw0rd12345";
    $conn = new mysqli($servername, $username, $password);

    if(mysqli_connect_error()){
        die("Connection failed: ".mysqli_connect_error());
    }
    else{
        if(isset($_SESSION["loginStatus"]) && $_SESSION["loginStatus"] == 'TRUE'){
            if(isset($_POST["answerBox"])){
                //echo print_r($_SESSION);
                $queryParam = $_SESSION["queryParam"];
                $ansBody = $_POST["answerBox"];
                $ansPhoto = $_POST["ansPhoto"];
                $user_id = $_SESSION["user_id"];
                if($ansPhoto != null){
                    $ansInserting = $conn->prepare("INSERT INTO thestash.answers_given (question_id_linked,answer_body,answer_photo,user_linked_to) 
                    VALUES (?, ?, ?, ?)");
                    $ansInserting->bind_param("isbi", $queryParam, $ansBody,$ansPhoto,$user_id);
                    $ansInserting->execute();
                    $conn -> close();
                    header("Location: question.php?question=". $queryParam ."");
                }
                else{
                    $ansInserting = $conn->prepare("INSERT INTO thestash.answers_given (question_id_linked,answer_body,user_linked_to) VALUES (?, ?, ?)");
                    $ansInserting->bind_param("isi", $queryParam,$ansBody,$user_id);
                    $ansInserting->execute();
                    $conn -> close();
                    header("Location: question.php?question=". $queryParam ."");
                }
            }
        }
        else{
            $_SESSION["posting_error"] = 'TRUE';
            header("Location: question.php?question=". $_SESSION["queryParam"] ."");
        }
    }
?>