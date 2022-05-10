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
                margin: 50px;
            }
            #category.scrollmenu{
                background-color: #e9e9e9;
                overflow: auto;
                white-space: nowrap;
            }
            #category.scrollmenu a{
                display: inline-block;
                text-align: center;
                padding: 14px;
                text-decoration: none;
                color: black;
            }
            #category.scrollmenu a:hover{
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
            }
            .topics a{
                text-decoration: none;
                color: black;
                padding: 20px;
            }
            .topics a:hover{
                background-color: #ddd;
            }
            .questions{
                background-color: #e9e9e9;
                height: fit-content;
                border-radius: 5px;
                margin-left: 100px;
            }
            .questions:hover{
                background-color: #ddd;
                box-shadow: 5px 5px 5px;
                -webkit-box-shadow: 0 0 10px
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
        <div id="searchBar">
            <input type="text" id="searchInput" placeholder="Search here...">
            <span><button type="submit"><i class="fa fa-search"></i></button></span>
        </div>
        <div class="container" id="topicContainer">
            <div id="category" class="scrollmenu">
                <a href="#">Networking</a>
                <a href="#">Networking</a>
                <a href="#">Networking</a>
                <a href="#">Networking</a>
                <a href="#">Networking</a>
                <a href="#">Networking</a>
                <a href="#">Networking</a>
                <a href="#">Networking</a>
                <a href="#">Networking</a>
                <a href="#">Networking</a>
                <a href="#">Networking</a>
                <a href="#">Networking</a>
            </div>
            <div class="row">
                <div id="topics" class="flex-container col-2">
                    <div class="topics"><a href="#">Testing Topic</a></div>
                    <div class="topics"><a href="#">Testing Topic</a></div>
                    <div class="topics"><a href="#">Testing Topic</a></div>
                    <div class="topics"><a href="#">Testing Topic</a></div>
                    <div class="topics"><a href="#">Testing Topic</a></div>
                    <div class="topics"><a href="#">Testing Topic</a></div>
                    <div class="topics"><a href="#">Testing Topic</a></div>
                    <div class="topics"><a href="#">Testing Topic</a></div>
                    <div class="topics"><a href="#">Testing Topic</a></div>
                    <div class="topics"><a href="#">Testing Topic</a></div>
                    <div class="topics"><a href="#">Testing Topic</a></div>
                </div>
                <div class="questions col-7">
                    <a href="question.php">
                        <div class="title">Title</div>
                        <div class="briefContent">Content Area</div>
                    </a>
                </div>
            </div>
        </div>
        <div id="postingBall">
            <a href="postQuestion.php"><i id="plusIcon" class="fa fa-plus fa-3x"></i></a>
        </div>
        <div id="footer">
            <div>Copyright &copy; All rights reserved</div>
        </div>
    </body>
</html>