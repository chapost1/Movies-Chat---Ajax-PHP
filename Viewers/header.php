<?php
$currentUser = $_SESSION['currentUser'];
$user_name = $currentUser->getUsername();
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <!--jQuery-->
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <!--Bootsrtap-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
              crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
        crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
        crossorigin="anonymous"></script>
        <link href="../style/movies_style11.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <header>
            <button id="chatBTN" class="btn btn-primary" onclick="goChat();">Chat</button>
            <button id="homeBTN" class="btn btn-basic" onclick="goHome();">Movies</button>
            <h1>Welcome to JBMDb,<br/> <?php echo $user_name; ?> </h1>
            <button id="logoutBTN" class="btn btn-danger" onclick="unsetUser();">Logout</button>
        </header>
    </body>
    <script>
        /////// take user out of connection and kickout
        function unsetUser() {
            $.post("../Controllers/usersControllers/logout.php", function (data) {
                if (data === 'ok') {
                    window.location.href = "../";
                }
            });
        }
        ;
        ////// take user to chat page
        function goChat() {
            window.location.href = "../chat";
        }
        ;
        ////// take user to Movies page
        function goHome() {
            window.location.href = "../movies";
        }
        ;
    </script>
</html>
