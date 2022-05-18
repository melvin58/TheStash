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
            #tagContainerTitle{
                display: Block;
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
                <label for="category"><h5><b>Choose a category: </b></h5></label>
                    <select name="category">
                    <?php
                        $servername = "thestashdb.mysql.database.azure.com";
                        $username = "Melvin";
                        $password = "P@ssw0rd12345";
                        $conn = new mysqli($servername, $username, $password);
            
                        if(mysqli_connect_error()){
                            die("Connection failed: ". mysqli_connect_error());
                        }
                        $catQuery = "SELECT category_name FROM thestash.category";
                        $catQueryResult = $conn->query($catQuery);
                        $catName = [];
                        while ($row = $catQueryResult -> fetch_array(MYSQLI_ASSOC)){
                            $catName[] = $row;
                        };
                        $count = 0;
                        while ($count < count($catName)){
                            echo '<option value="'. $catName[$count]["category_id"] .'">'. $catName[$count]["category_name"] .'</option>';
                            $count++;
                        }

                        echo '</select>';
                        echo '<br>';
                        echo '<br>';
                        echo '<div id="tagContainer" class="container">';
                            echo '<h5 id="tagContainerTitle"><b>Choose a Tag</b></h5>';
                            $tagQuery = "SELECT tag_id,tag_name FROM thestash.tags";
                            $tagQueryResult = $conn->query($tagQuery);
                            $tagName = [];
                            while ($row = $tagQueryResult -> fetch_array(MYSQLI_ASSOC)){
                                $tagName[] = $row;
                            }
                            $count = 0;
                            while ($count < count($tagName)){
                                echo '<div>';
                                echo '<input name="tag[]" type="checkbox" value="'. $tagName[$count]["tag_id"] .'">';
                                echo '<label for="tag"> '.  $tagName[$count]["tag_name"] .'</label>';
                                echo '</div>'; 
                                $count++;
                            }
                        echo '</div>';
                    ?>
                <br>
                <br>
                <label for="attachFiles"><h5><b>Attach images here:</b></h5></label>
                <input id="attachFiles" name="attachFiles" type="file">
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