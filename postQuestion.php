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
                $("#includedContent").load("navbar.php"); 
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
            #postQuestionFormBody{
                margin-top: 60px;
                background-color: #e9e9e9;
                padding: 50px;
            }
            #bodyHead{
                margin-bottom: 50px;
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
        </style>
    </head>
    <body>
        <div id="includedContent"></div>
        <div id="postQuestionFormBody" class="container">
            <form action="questionHandler.php" method="post">
                <h4 id="bodyHead"><b>Post a question here</b></h4>
                <label for="questionTitle"><h5><b>Title:</b></h5></label>
                <input type="text" name="questionTitle" id="questionTitle">
                <br>
                <br>
                <label for="questionDetails"><h5><b>Question Details: </b></h5></label>
                <textarea placeholder="Please enter the question details here" type="text"name="questionDetails" id="questionDetails" rows="4" cols="50"></textarea>
                <br>
                <br>
                <label for="attachFiles"><h5><b>Attach images here:</b></h5></label>
                <input id="attachFiles" name="attachFiles type="file">
                <br>
                <br>
                <input type="submit">
            </form>
        </div>
        <div id="footer">
            <div>Copyright &copy; All rights reserved</div>
        </div>
    </body>
</html>