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
            #largeProfileCircle{
                height: 150px;
                width: 150px;
                background-color: white;
                border-radius: 50%;
                margin: auto;
                display: block;
            }
            #profileContainer{
                background-color: #e9e9e9;
                margin-top: 50px;
                padding: 50px;
            }
            #btnActions button{
                margin: auto;
            }
            #username{
                margin-top: 20px;
                margin-bottom: 20px;
                text-align: center;
            }
            .questionContainer{
                background-color: white;
                height: fit-content;
                width: 60%;
                border-radius: 5px;
                padding: 20px;
            }
            .questionContainer:hover{
                background-color: white;
                box-shadow: 5px 5px 5px;
                -webkit-box-shadow: 0 0 10px
            }
            .questionContainer a{
                text-decoration: none;
                color: black;
            }
            .questionTitle{
                padding-bottom: 20px;
            }
        </style>
        <?php 
        $servername = "thestashdb.mysql.database.azure.com";
        $username = "Melvin";
        $password = "P@ssw0rd12345";
        $conn = new mysqli($servername, $username, $password);

        if(mysqli_connect_error()){
            die("Connection failed: ".mysqli_connect_error());
        }
        else{
            $user_id = $_SESSION["user_id"];
            $questionsQuery = "SELECT question_id,question_title,question_body FROM thestash.questions_raised WHERE user_id_linked = $user_id";
            $questionsQueryResult = $conn->query($questionsQuery);
            $questions = [];
            while ($row = $questionsQueryResult -> fetch_array(MYSQLI_ASSOC)){
                $questions[] = $row;
            }
        }
        ?>
    </head>
    <body>
        <?php 
            echo '<div id="includedContent"></div>';
            echo '<div class="container" id="profileContainer">';
                echo '<div id="largeProfileCircle"></div>';
                echo '<div id="userInfo" class="row">';
                    echo '<h5 id="username"><b>'. $_SESSION["username"] .'</b></h5>';
                    echo '<div id="userRelatedQuestions" class="col-10">';
                        echo '<h5><b>Questions posted</b></h5>';
                        if($questions == null){
                            echo '<div id="defaultReply">No questions posted by you yet.</div>';
                        }
                        else{
                            $count = 0;
                            while ($count < count($questions)){
                                echo '<div class="questionContainer">';
                                    echo '<a href="question.php?question='. $questions[$count]["question_id"] .'">';
                                        echo '<div class="questionTitle"><b>'. $questions[$count]['question_title'] .'</b></div>';
                                        echo '<div class="briefContent">'. $questions[$count]["question_body"] .'</div>';
                                        echo '</a>';
                                echo '</div>';
                                echo '<br>';
                                $count++;
                            }
                        }
                    echo '</div>';
                    echo '<div id="btnActions" class="col-2">';
                    echo '<a href="logout.php"><button id="logOutBtn">Log Out</button></a>';
                        echo '<br>';
                        echo '<br>';
                        echo '<a href="deleteAccount.php"><button>Delete Account</button></a>';
                        echo '<br>';
                        echo '<br>';
                        echo '<button>Update Account Details</button>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
            echo '<div id="footer">';
            echo '<div>Copyright &copy; All rights reserved</div>';
            echo '</div>';
        ?>
    </body>
    <script type="text/javascript">
        document.getElementById("logOutBtn").onclick = function(){
            location.href = "logout.php";
        };
    </script>
</html>