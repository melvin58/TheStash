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
                $("#includedContent").load("navbar.html"); 
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
            #userCreationBody{
                background-color: #e9e9e9;
                margin-top: 80px;
            }
            #title{
                display: block;
                text-align: center;
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
        <div id="userCreationBody">
            <h4><b id="title">User Creation</b></h4>
            <div class="container">
                <label for="profilePicture"><h5><b>Upload profile picture here: </b></h5></label>
                <input id="profilePicture" type="file">
                <br>
                <br>
                <label for="username"><h5><b>Enter username here: </b></h5></label>
                <input id="username" type="text">
                <br>
                <br>
                <label for="password"><h5><b>Enter password here: </b></h5></label>
                <input id="password" type="password">
                <br>
                <br>
                <button type="submit">Submit</button>
            </div>
        </div>
        <div id="footer">
            <div>Copyright &copy; All rights reserved</div>
        </div>
    </body>
</html>