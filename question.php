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
                padding: 30px;
                padding-left: 80px;
            }
            #questionBody{
                display: block;
                padding: 30px;
                padding-left: 80px;
            }
            .userWhoPosted{
                display: block;
                height: 80px;
                width: 80px;
                background-color: white;
                border-radius: 50%;
                margin-left: 20px;
            }
            #postingUsername{
                padding-left: 100px;
            }
            #postingUserTags{
                padding-left: 100px;
            }
            .answer{
                display: block;
                padding: 30px;
                padding-left: 80px;
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
        </style>
    </head>
    <body>
        <div id="includedContent"></div>
        <div id="questionStructure" class="container">
            <div class="userWhoPosted">
                <span id="postingUsername">Username</span>
                <span id="postingUserTags">Networking</span>
            </div>
            <div id="questionTitle">
                Question Title
            </div>
            <div id="questionBody">Question body</div>
            <h4 id="divider"><b>Answer</b></h4>
            <div id="answerSection">
                <div class="answer">Testing Answer</div>
            </div>
        </div>
        <div id="postingBall">
            <a href="postQuestion.html"><i id="plusIcon" class="fa fa-plus fa-3x"></i></a>
        </div>
        <div id="footer">
            <div>Copyright &copy; All rights reserved</div>
        </div>
    </body>
</html>