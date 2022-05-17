<?php 
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width-content-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/bc00b134de.js" crossorigin="anonymous"></script>
        <title>TheStash</title>
        <link rel="stylesheet" href="navbar.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
        <script> 
            $(function(){
                $("#includedContent").load("navbar.html"); 
            });
        </script>
        <style>
            body{
                font-family: Arial, Helvetica, sans-serif;
            }
            html,body{
                margin: 0px;
                padding: 0px;
            }
            #questionStructure{
                margin-top: 50px;
                background-color: #e9e9e9;
                padding-top: 30px;
            }
            #questionTitle{
                display: block;
            }
            #questionBody{
                display: block;
                
            }
            #userWhoPosted{
                height: 80px;
                width: 80px;
                background-color: white;
                border-radius: 50%;
                margin-left: 30px;
                
            }
            #postingUsername{
                margin-left: 100px;
                padding-top: 10px;
                padding-bottom 10px;
                white-space: nowrap;
            }
            .postingUserTags{
                margin-left: 100px;
                padding-top: 10px;
                padding-bottom 10px;
                white-space: nowrap;
            }
            .answer{
                display: block;
            }
            .answerUsername{
                display: Block;
            }
            .answerBox{
                display: Block;
                margin-left:80px
            }
            .answerContainer{
                margin-left: 50px;
                background-color: white;
                height: fit-content;
                width: 50%;
                margin-bottom: 20px;
                padding: 20px;
                border-radius: 5px;
            }
            #defaultReply{
                margin-left: 70px;
            }
            #divider{
                display: block;
                padding: 30px;
                padding-left: 80px;
            }
            #footer{
                margin-top: 50px;
                left: 0;
                bottom: 0;
                width: 100%;
                background-color: #e9e9e9;
                text-align: center;
            }
            #footer div{
                padding: 10px;
            }
            #postingBall{
                height: 80px;
                width: 80px;
                background-color: #90ee90;
                border-radius: 50%;
                position: fixed;
                right: 80px;
                top: 500px;
            }
            #postingBall:hover{
                box-shadow: 3px 3px 3px;
                -webkit-box-shadow: 0 0 30px
            }
            #plusIcon{
                margin-left: 19px;
                margin-top: 15px;
                color: white;
            }
            #questionSection{
                margin-top: 30px;
                background-color: white;
                width: fit-content;
                margin-left: 50px;
                padding: 20px;
                border-radius: 5px;
            }
            .submitBtn{
                border: none;
                background-color: #4CAF50;
                padding: 10px;
                width: 100px;
                border-radius: 5px;
            }
            .submitBtn:hover{
                box-shadow: 3px 3px 3px;
                -webkit-box-shadow: 0 0 5px
            }
            .btnMsg{
                color: white;
            }
        </style>
    </head>
    <body>
        <?php

            $servername = "thestashdb.mysql.database.azure.com";
            $username = "Melvin";
            $password = "P@ssw0rd12345";
            $conn = new mysqli($servername, $username, $password);

            if(mysqli_connect_error()){
                die("Connection failed: ".mysqli_connect_error());
            }
            else{
                $queryParam = $_GET["question"];
                $_SESSION["queryParam"] = $queryParam;
                $questionsQuery = "SELECT questions_raised.question_title,questions_raised.question_body,questions_raised.tags_related,questions_raised.amount_of_upvotes,questions_raised.amount_of_downvotes,
                users.username,users.profile_picture FROM thestash.questions_raised INNER JOIN thestash.users ON user_id_linked = `user_id` WHERE question_id = $queryParam";
                $questionsQueryResult = $conn->query($questionsQuery);
                $questions = [];
                while ($row = $questionsQueryResult -> fetch_array(MYSQLI_ASSOC)){
                    $questions[] = $row;
                }
            }

            //request to retrieve related tags according to question
            if($questions != null){
                if($questions[0]["tags_related"] != null){
                    $tagQuery = 'SELECT tag_name FROM thestash.tags WHERE tag_id IN ('. $questions[0]["tags_related"] .')';
                    $tagQueryResult = $conn->query($tagQuery);
                    $tagsToQuestion = [];
                    while ($row = $tagQueryResult -> fetch_array(MYSQLI_ASSOC)){
                        $tagsToQuestion[] = $row;
                    }
                }
                else{
                    $tagsToQuestion = null;
                }
                $_SESSION["retrievalFailure"] = 'FALSE';
            }
            else{
                $questionsQuery = "SELECT question_title,question_body,tags_related,amount_of_upvotes,amount_of_downvotes,
                username_of_posting_user FROM thestash.questions_raised WHERE question_id = $queryParam";
                $questionsQueryResult = $conn->query($questionsQuery);
                $questions = [];
                while ($row = $questionsQueryResult -> fetch_array(MYSQLI_ASSOC)){
                    $questions[] = $row;
                }
                if($questions[0]["tags_related"] != null){
                    $tagQuery = 'SELECT tag_name FROM thestash.tags WHERE tag_id IN ('. $questions[0]["tags_related"] .')';
                    $tagQueryResult = $conn->query($tagQuery);
                    $tagsToQuestion = [];
                    while ($row = $tagQueryResult -> fetch_array(MYSQLI_ASSOC)){
                        $tagsToQuestion[] = $row;
                    }
                }
                else{
                    $tagsToQuestion = null;
                }
                $_SESSION["retrievalFailure"] = 'TRUE';
            }
            
            //request to retrieve related answers according to question
            $ansQuery = 'SELECT answers_given.answer_body,answers_given.answer_photo,answers_given.votes_given,users.username,users.profile_picture 
            FROM thestash.answers_given INNER JOIN thestash.users ON user_linked_to = user_id WHERE question_id_linked = '. $queryParam .'';
            $ansQueryResult = $conn->query($ansQuery);
            $ansToQuestion = [];
            while ($row = $ansQueryResult -> fetch_array(MYSQLI_ASSOC)){
                $ansToQuestion[] = $row;
            }

            //popup error message for posting answer if not yet logged in
            if(isset($_SESSION["posting_error"])){
                echo '<script>alert("Oops... Look like you are not logged in....")</script>';
                unset($_SESSION["posting_error"]);
            }

            echo '<div id="includedContent"></div>';
            echo '<div id="questionStructure" class="container">';
            echo '<div>';
                if($_SESSION["retrievalFailure"] == 'FALSE'){
                    echo '<div id="userWhoPosted">';
                    echo '<div id="postingUsername">'. $questions[0]["username"] .'</div>';
                    $count = 0;
                    if($tagsToQuestion != null){
                        while($count < count($tagsToQuestion)){
                            echo '<div class="postingUserTags">'. $tagsToQuestion[$count]["tag_name"] .'</div>';
                            $count++;
                        }
                    }
                    else{
                        echo '<div class="postingUserTags">No tags tagged</div>';
                    }
                    echo '</div>';
                    
                    echo '<div id="questionSection">';
                    echo '<div id="questionTitle">';
                        echo '<b>'.$questions[0]["question_title"].'</b>';
                    echo '</div>';
                    echo '<div id="questionBody">'. $questions[0]["question_body"] .'</div>';
                    echo '</div>';
                    unset($_SESSION["retrievalFailure"]);
                }
                else{
                    echo '<div id="userWhoPosted">';
                    echo '<div id="postingUsername">'. $questions[0]["username_of_posting_user"] .'</div>';
                    $count = 0;
                    if($tagsToQuestion != null){
                        while($count < count($tagsToQuestion)){
                            echo '<div class="postingUserTags">'. $tagsToQuestion[$count]["tag_name"] .'</div>';
                            $count++;
                        }
                    }
                    else{
                        echo '<div class="postingUserTags">No tags tagged</div>';
                    }
                    echo '</div>';
                    
                    echo '<div id="questionSection">';
                    echo '<div id="questionTitle">';
                        echo '<b>'.$questions[0]["question_title"].'</b>';
                    echo '</div>';
                    echo '<div id="questionBody">'. $questions[0]["question_body"] .'</div>';
                    echo '</div>';
                    unset($_SESSION["retrievalFailure"]);
                }
                echo '<h5 id="divider"><b>Replies</b></h5>';
                echo '<div id="answerSection" class="container">';
                echo '<div class="row">';
                    $count = 0;
                    if(count($ansToQuestion) == 0){
                        echo '<div id="defaultReply">No replies posted yet</div>';
                    }
                    else{
                        while($count < count($ansToQuestion)){
                            echo '<div class="answerContainer col-12">';
                                echo '<div class="answerUsername"><b>'. $ansToQuestion[$count]["username"] .'</b></div>';
                                echo '<div class="answer">'. $ansToQuestion[$count]["answer_body"] .'</div>';
                            echo '</div>';
                            $count++;
                        }
                    }
                    echo '</div>';
                echo '</div>';
                echo '<div id="answerBox">';
                    echo '<h5 id="divider"><b>Type your response here</b></h5>';
                        echo '<form action="ansPosting.php" method="post">';
                            echo '<textarea class="answerBox" placeholder="Enter here..." type="text" name="answerBox" rows="4" cols="50"></textarea>';
                            echo '<br>';
                            echo '<input class=answerBox name="ansPhoto" type="file">';
                            echo '<br>';
                            echo '<div class="answerBox"><button class="submitBtn" type="submit"><div class="btnMsg">Submit</div></button></div>';
                            echo '<br>';
                            echo '<br>';    
                        echo '</form>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
            echo '<div id="postingBall">';
                echo '<a href="postQuestion.php"><i id="plusIcon" class="fa fa-plus fa-3x"></i></a>';
            echo '</div>';
            echo '<div id="footer">';
                echo '<div>Copyright &copy; All rights reserved</div>';
            echo '</div>';
        ?>
    </body>
</html>