<?php 
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width-content-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/bc00b134de.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="navbar.css">
        <title>TheStash</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
        <script> 
            $(function(){
                $("#includedContent").load("navbar.php"); 
            });
        </script> 
        <style>
            body {
                font-family: Arial, Helvetica, sans-serif;
            }
            html,body{
                margin: 0px;
                padding: 0px;
            }
            #logo{
                height: 100px;
                width: 100px;
                padding: 0px;
            }
            #searchBar{
                margin-top: 50px;
                display: block;
                text-align: center;
            }
            #searchBar input{
                margin: auto;
                width: 250px;
            }
            #searchInput{
                overflow: hidden;
                border: none;
                background-color: #e9e9e9;
                padding: 10px;
                border-radius: 5px;
            }
            #searchBar button{
                
                background: #e9e9e9;
                border: none;
                padding: 10px;
                
            }
            .flex-container{
                display: flex;
                flex-direction: column;
            }
            #topicContainer{
                margin-top: 50px;
            }
            #category{
                
                text-align: center;
            }
            #category.scrollmenu{
                background-color: #e9e9e9;
                overflow: auto;
                white-space: nowrap;
                padding: 10px;
                width: fit-content;
                margin: auto;
            }
            #category.scrollmenu form button{
                display: inline-block;
                text-align: center;
                padding: 14px;
                text-decoration: none;
                color: black;
                border: none;
            }
            #category.scrollmenu form button:hover{
                background-color: #ddd;
            }
            #topics{
                float: left;
                overflow-y: scroll;
                white-space: nowrap;
                height: 500px;
            }
            #dividingLine{
                margin-left: 50px;
                border-left: 3px solid #ddd;
                height: 500px;
            }
            .topics{
                margin: 20px auto;
                border: none;
                padding: 20px;
               
            }
            .topics a{
                text-decoration: none;
                color: black;
            }
            .topics:hover{
                background-color: #ddd;
            }
            .questionContainer{
                background-color: #e9e9e9;
                height: fit-content;
                border-radius: 5px;
                margin-left: 100px;
                padding: 5px;
            }
            .questionContainer:hover{
                background-color: #ddd;
                box-shadow: 5px 5px 5px;
                -webkit-box-shadow: 0 0 10px;
            }
            .questions a{
                text-decoration: none;
                color: black;
            }
            .title{
                display: block;
                margin: 20px;
            }
            .briefContent{
                display: block;
                margin: 20px;
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
            ::-webkit-scrollbar{
                width: 10px;
            }
            ::-webkit-scrollbar-track{
                background: #f1f1f1;
                border-radius: 10px;
            }
            ::-webkit-scrollbar-thumb{
                background: #888;
                border-radius: 10px;
            }
            ::-webkit-scrollbar-thumb:hover{
                background: #555;
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
                -webkit-box-shadow: 0 0 30px;
            }
            #plusIcon{
                margin-left: 19px;
                margin-top: 15px;
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
                die("Connection failed: ". mysqli_connect_error());
            }
            else{
                $catQuery = "SELECT category_id,category_name FROM thestash.category";
                $catQueryResult = $conn->query($catQuery);
                $catName = [];
                while ($row = $catQueryResult -> fetch_array(MYSQLI_ASSOC)) {
                    $catName[] =  $row;
                };

                $questionsQuery = "SELECT question_id,question_title,question_body,tags_related,category_under FROM thestash.questions_raised";
                $questionsQueryResult = $conn->query($questionsQuery);
                $questions = [];
                while ($row = $questionsQueryResult -> fetch_array(MYSQLI_ASSOC)){
                    $questions[] = $row;
                };

                $tagsQuery = "SELECT tag_id,tag_name,category_belonged_to FROM thestash.tags";
                $tagsQueryResult = $conn->query($tagsQuery);
                $tags = [];
                while ($row = $tagsQueryResult -> fetch_array(MYSQLI_ASSOC)){
                    $tags[] = $row;
                };
            };
            //detect if posting a question fails due to not logged in
            if(isset($_SESSION["posting_error"])){
                echo '<script>alert("Oops... Look like you are not logged in....")</script>';
                unset($_SESSION["posting_error"]);
            };

            if(isset($_SESSION["deleteStatus"]) && $_SESSION["deleteStatus"] == "TRUE"){
                echo "<script>alert('Account deleted successully.')</script>";
                session_destroy();
            }
            else if(isset($_SESSION["deleteStatus"]) && $_SESSION["deleteStatus"] == "FALSE"){
                echo "<script>alert('Account deletion error!')</script>";
                unset($_SESSION["deleteStatus"]);
            };

            if(isset($_SESSION['confirmLogIn']) && $_SESSION["confirmLogIn"] == 'TRUE'){
                echo "<script>alert('Login success! Welcome " . $_SESSION["username"] . "!')</script>";
                unset($_SESSION["confirmLogIn"]);
            };
            
        echo '<div id="includedContent"></div>';
        echo '<form action="dbhandle.php" method="get">';
            echo '<div id="searchBar">';
                echo '<input type="text" id="searchInput" name="search" placeholder="Search here...">';
                echo '<span><button type="submit"><i class="fa fa-search"></i></button></span>';
            echo '</div>';
        echo '</form>';
        echo '<div class="container" id="topicContainer">';
        echo '<div id="category" class="scrollmenu row">';
                    $count = 0;
                    while ($count < count($catName)){
                        echo '<form class="col-4" action="index.php" method="get">';
                            echo '<button type="submit" class="categoryBtn">'. $catName[$count]["category_name"] .'</button>';
                            echo '<input type="hidden" name="catId" value="'. $catName[$count]["category_id"] .'">';
                        echo '</form>';
                        $count++;
                    }
            echo '</div>';
            echo '<br>';
                if(isset($_GET["catId"])){
                    echo '<div class="row">';
                    echo '<div id="topics" class="flex-container col-2">';
                    $count=0;
                    $catId = $_GET["catId"];
                    while ($count < count($tags)){
                        if(in_array($catId, $tags[$count])){
                            echo '<form action="index.php" method="get">';
                                echo '<button type="submit" class="topics">'. $tags[$count]['tag_name'] .'</button>';
                                echo '<input type="hidden" name="catId" value="'. $catId .'">';
                                echo '<input type="hidden" name="tagId" value="'. $tags[$count]['tag_id'] .'">';
                            echo '</form>';
                        }
                        $count++;
                    }
                    echo '</div>';
                    echo '<div class="questions col-7">';
                    if(isset($_GET["tagId"])){
                        $count = 0;
                        $tagId = $_GET["tagId"];
                        while ($count < count($questions)){
                            $tagIdInQuestion = explode(',',$questions[$count]["tags_related"]);
                            if(in_array($tagId, $tagIdInQuestion)){
                                echo '<div class="questionContainer">';
                                echo '<a href="question.php?question='. $questions[$count]["question_id"] .'">';
                                    echo '<div class="title"><b>'. $questions[$count]['question_title'] .'</b></div>';
                                    echo '<div class="briefContent">'. $questions[$count]["question_body"] .'</div>';
                                    echo '</a>';
                                echo '</div>';
                                echo '<br>';
                            }
                            $count++;
                        }
                    }
                    else{
                        if(isset($_SESSION["searchResult"])){
                            $count = 0;
                            $searchResult = $_SESSION["searchResult"];
                            while ($count < count($searchResult)){
                                echo '<div class="questionContainer">';
                                    echo '<a href="question.php?question='. $searchResult[$count]["question_id"] .'">';
                                        echo '<div class="title"><b>'. $searchResult[$count]['question_title'] .'</b></div>';
                                        echo '<div class="briefContent">'. $searchResult[$count]["question_body"] .'</div>';
                                        echo '</a>';
                                echo '</div>';
                                echo '<br>';
                                $count++;
                            }
                            unset($_SESSION["searchResult"]);
                        }
                        else{
                            //echo print_r($tags);
                            //echo print_r($tags);
                            $tagIdInQuestion = explode(',',$questions[0]["tags_related"]);
                            //echo in_array($tags[3]["tag_id"], $tagIdInQuestion);
                            $count = 0;
                            while ($count < count($questions)){
                                if($catId == $questions[$count]["category_under"]){
                                    echo '<div class="questionContainer">';
                                    echo '<a href="question.php?question='. $questions[$count]["question_id"] .'">';
                                        echo '<div class="title"><b>'. $questions[$count]['question_title'] .'</b></div>';
                                        echo '<div class="briefContent">'. $questions[$count]["question_body"] .'</div>';
                                        echo '</a>';
                                    echo '</div>';
                                    echo '<br>';
                                }
                                $count++;
                            }
                            /*while ($count < count($questions)){
                                echo '<div class="questionContainer">';
                                    echo '<a href="question.php?question='. $questions[$count]["question_id"] .'">';
                                        echo '<div class="title"><b>'. $questions[$count]['question_title'] .'</b></div>';
                                        echo '<div class="briefContent">'. $questions[$count]["question_body"] .'</div>';
                                        echo '</a>';
                                echo '</div>';
                                echo '<br>';
                                $count++;
                            }*/
                        }
                    }
                }
                else{
                    echo '<div class="row">';
                    echo '<div id="topics" class="flex-container col-2">';
                    $count = 0;
                    while ($count < count($tags)){
                        echo '<form action="index.php" method="get">';
                            echo '<button type="submit" class="topics">'. $tags[$count]['tag_name'] .'</button>';
                            echo '<input type="hidden" name="tagId" value="'. $tags[$count]['tag_id'] .'">';
                        echo '</form>';
                        $count++;
                    }
                    echo '</div>';
                    $count = 0;
                    echo '<div class="questions col-7">';
                    if(isset($_GET["tagId"])){
                        $tagId = $_GET["tagId"];
                        while ($count < count($questions)){
                            $tagIdInQuestion = explode(',',$questions[$count]["tags_related"]);
                            if(in_array($tagId, $tagIdInQuestion)){
                                echo '<div class="questionContainer">';
                                echo '<a href="question.php?question='. $questions[$count]["question_id"] .'">';
                                    echo '<div class="title"><b>'. $questions[$count]['question_title'] .'</b></div>';
                                    echo '<div class="briefContent">'. $questions[$count]["question_body"] .'</div>';
                                    echo '</a>';
                                echo '</div>';
                                echo '<br>';
                            }
                            $count++;
                        }
                    }
                    else{
                        if(isset($_SESSION["searchResult"])){
                            $searchResult = $_SESSION["searchResult"];
                            while ($count < count($searchResult)){
                                echo '<div class="questionContainer">';
                                    echo '<a href="question.php?question='. $searchResult[$count]["question_id"] .'">';
                                        echo '<div class="title"><b>'. $searchResult[$count]['question_title'] .'</b></div>';
                                        echo '<div class="briefContent">'. $searchResult[$count]["question_body"] .'</div>';
                                        echo '</a>';
                                echo '</div>';
                                echo '<br>';
                                $count++;
                            }
                            unset($_SESSION["searchResult"]);
                        }
                        else{
                            while ($count < count($questions)){
                                echo '<div class="questionContainer">';
                                    echo '<a href="question.php?question='. $questions[$count]["question_id"] .'">';
                                        echo '<div class="title"><b>'. $questions[$count]['question_title'] .'</b></div>';
                                        echo '<div class="briefContent">'. $questions[$count]["question_body"] .'</div>';
                                        echo '</a>';
                                echo '</div>';
                                echo '<br>';
                                $count++;
                            }
                        }
                    }
                }
                echo '</div>';
            echo '</div>';
        echo '</div>';
        echo '<div id="postingBall">';
            echo '<a href="controllerForPosting.php"><i id="plusIcon" class="fa fa-plus fa-3x"></i></a>';
        echo'</div>';
        echo '<div id="footer">';
            echo '<div>Copyright &copy; All rights reserved</div>';
        echo '</div>';
        ?>
    </body>
</html>