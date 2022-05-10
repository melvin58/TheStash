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
                text-align: center;
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
        <?php
            $servername = "thestashdb.mysql.database.azure.com";
            $username = "Melvin";
            $password = "P@ssw0rd12345";
            $conn = new mysqli($servername, $username, $password);

            if(mysqli_connect_error()){
                die("Connection failed: ".mysqli_connect_error());
            }
            else{
                $catQuery = "SELECT * FROM thestash.category";
                $catQueryResult = $conn->query($catQuery);

                //category array
                // $catArray = $catQueryResult -> fetch_array(MYSQLI_ASSOC);
                // print_r($catArray);
                $catName = [];
                while ($row = $catQueryResult -> fetch_array(MYSQLI_ASSOC)) {
                    //echo $row['category_id'];
                    $catName[] =  $row['category_name'];
                }
            }
        
        echo '<div id="includedContent"></div>';
        echo '<div id="searchBar">';
            echo '<input type="text" id="searchInput" placeholder="Search here...">';
            echo '<span><button type="submit"><i class="fa fa-search"></i></button></span>';
        echo '</div>';
        echo '<div class="container" id="topicContainer">';
        echo '<div id="category" class="scrollmenu">';
        $count = 0;
                    while ($count < count($catName)){
                        echo '<a href="#">'. $catName[$count] .'</a>';
                        $count++;
                    }
            echo '</div>';
            echo '<div class="row">';
                echo '<div id="topics" class="flex-container col-2">';
                    echo '<div class="topics"><a href="#">Testing Topic</a></div>';
                echo '</div>';
                echo '<div class="questions col-7">';
                    echo '<a href="question.php">';
                        echo '<div class="title">Title</div>';
                        echo '<div class="briefContent">Content Area</div>';
                    echo '</a>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
        echo '<div id="postingBall">';
            echo '<a href="postQuestion.php"><i id="plusIcon" class="fa fa-plus fa-3x"></i></a>';
        echo'</div>';
        echo '<div id="footer">';
            echo '<div>Copyright &copy; All rights reserved</div>';
        echo '</div>';
        ?>
    </body>
</html>