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
        <title>JBMDb chat</title>
        <!--jQuery-->
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <!--Bootsrtap-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
              crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
        crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
        crossorigin="anonymous"></script>
        <style>
            body {
                text-align: center;
                background-color: #1d1818;
            }

            header {
                position: fixed;
                width: 100%;
                z-index: 9001;
                height: 200px;
                border: 3px double black;
                background: rgb(239, 141, 49);
                /* Old browsers */
                background: -moz-linear-gradient(top, rgba(239, 141, 49, 1) 0%, rgba(245, 171, 102, 1) 53%, rgba(250, 198, 149, 1) 100%);
                /* FF3.6-15 */
                background: -webkit-linear-gradient(top, rgba(239, 141, 49, 1) 0%, rgba(245, 171, 102, 1) 53%, rgba(250, 198, 149, 1) 100%);
                /* Chrome10-25,Safari5.1-6 */
                background: linear-gradient(to bottom, rgba(239, 141, 49, 1) 0%, rgba(245, 171, 102, 1) 53%, rgba(250, 198, 149, 1) 100%);
                /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ef8d31', endColorstr='#fac695', GradientType=0);
                /* IE6-9 */
            }

            header h1 {
                margin-top: 30px;
                line-height: 60px;
            }

            #logoutBTN {
                position: absolute;
                right: 1%;
                bottom: 1%;
            }

            #chatBTN {
                position: absolute;
                left: 1%;
                bottom: 1%;
            }

            #homeBTN {
                position: absolute;
                left: 50%;
                transform: translateX(-50%);
                bottom: 1%;
            }

            .btn-basic:hover {
                background-color: darkgrey;
            }

            /*
            */

            nav {
                position: fixed;
                left: 50%;
                transform: translateX(-50%);
                top: 200px;
                z-index: 9001;
                /*
                style inside css. max-width:960px;
                */
                border-top: 6px solid #3f693f;
                border-left: 3px double #a96b6b;
                border-right: 6px solid #3f693f;
                border-bottom: 1px solid black;
            }

            .usersDropdown {
                position: relative;
                height: 100px;
                background-color: #3f693f;
            }

            .usersDropdown ::-webkit-scrollbar {
                width: 12px;
            }

            .usersDropdown ::-webkit-scrollbar-track {
                -webkit-box-shadow: inset 0 0 7px rgba(0, 0, 0, 0.5);
                border-radius: 10px;
            }

            .usersDropdown ::-webkit-scrollbar-thumb {
                border-radius: 10px;
                -webkit-box-shadow: inset 0 0 7px rgba(0, 0, 0, 0.7);
                background-color: #082408;
            }


            .headChose {
                width: 82%;
                line-height: 100px;
                font-size: 300%;
                font-weight: bold;
            }

            .userSelector {
                padding-top: 2px;
                padding-bottom: 2px;
                width: 18%;
                background-color: #315731;
                border-color: black;
                font-size: 200%;
                font-weight: bold;
                text-align: center;
            }

            article {
                padding-top: 20px;
                position: relative;
                top: 300px;
                min-height: 700px;
                /*
                style inside css. max-width:960px;
                */
                border-left: 3px double #a96b6b;
                border-right: 3px double #a96b6b;
                background-image: url('images/paws.jpg');
                background-repeat: repeat-y;
                margin-bottom: 80px;
                padding-bottom: 10px;
            }

            .mCont {
                position: relative;
                height: 100px;
                margin-bottom: 10px;
            }

            .friendMessage {
                position: absolute;
                right: 0;
                -webkit-border-top-left-radius: 50px;
                -webkit-border-bottom-left-radius: 50px;
                -moz-border-radius-topleft: 50px;
                -moz-border-radius-bottomleft: 50px;
                border-top-left-radius: 50px;
                border-bottom-left-radius: 50px;
                background-color: rgb(105, 229, 233);
                direction: rtl;
            }

            .friendMessage h4 {
                right: 2%;
            }

            .friendMessage p {
                right: 2%;
            }

            .friendMessage h6 {
                left: 9%;
            }

            .myMessage {
                position: absolute;
                left: 0;
                -webkit-border-top-right-radius: 50px;
                -webkit-border-bottom-right-radius: 50px;
                -moz-border-radius-topright: 50px;
                -moz-border-radius-bottomright: 50px;
                border-top-right-radius: 50px;
                border-bottom-right-radius: 50px;
                background-color: rgb(104, 192, 138);
                padding-right: 5px;
            }

            .myMessage h4 {
                left: 2%;
            }

            .myMessage p {
                left: 2%;
            }

            .myMessage h6 {
                right: 9%;
            }

            .message {
                width: 400px;
                min-height: 100px;
                overflow-y: auto;
            }

            .message h4 {
                position: absolute;
                top: 2%;
                text-decoration-line: underline;
                color: darkolivegreen;
            }

            .message p {
                position: absolute;
                top: 31%;
                width: 90%;
                font-weight: bold;
            }

            .message h6 {
                position: absolute;
                top: 4%;
                font-weight: normal;
            }

            .mCont ::-webkit-scrollbar {
                width: 5px;
            }

            .mCont ::-webkit-scrollbar-track {
                -webkit-box-shadow: inset 0 0 7px rgba(0, 0, 0, 0.6);
                border-radius: 10px;
            }

            .mCont ::-webkit-scrollbar-thumb {
                border-radius: 10px;
                -webkit-box-shadow: inset 0 0 7px rgba(0, 0, 0, 0.2);
            }

            .senderContainer {
                margin-top: 80px;
                position: fixed;
                bottom: 0;
                left: 50%;
                transform: translateX(-50%);
                /*
                style inside css. max-width:960px;
                */
            }

            .sender {
                position: relative;
                border-bottom: 6px solid rgb(221, 221, 221);
                border-left: 3px double #a96b6b;
                border-right: 6px solid rgb(221, 221, 221);
                height: 80px;
                width: 100%;
                position: absolute;
                bottom: 0%;
            }

            .sendInput {
                width: 82%;
                height: 100%;
                font-size: 200%;
                border: 3px double rgb(172, 166, 166);
            }

            .sendBTN {
                position: relative;
                width: 18%;
                font-size: 220%;
                background-image: url(images/arrow.png);
                background-size: 32%;
                background-position-x: 90%;
                background-position-y: 18%;
                background-repeat: no-repeat;
            }

            .sendBTN p {
                position: absolute;
                bottom: 20%;
                transform: translateY(50%);
            }

            @media screen and (max-width:906px) {
                .userSelector {
                    font-size: 150%;
                }
            }

            @media screen and (max-width:685px) {
                .sendBTN {
                    font-size: 140%;
                }
                .headChose {
                    font-size: 200%;
                }
                .userSelector {
                    font-size: 150%;
                }
            }

            @media screen and (max-width:566px) {
                .userSelector {
                    font-size: 100%;
                }
                .message {
                    width: 200px;
                }
            }

            @media screen and (max-width:488px) {
                .sendBTN {
                    font-size: 100%;
                }
                .userSelector {
                    font-size: 80%;
                }
            }

            @media screen and (max-width:427px) {
                .sendBTN {
                    font-size: 100%;
                }
                .userSelector {
                    font-size: 65%;
                }
                header h1 {
                    margin-top: 20px;
                    font-size: 180%;
                }
            }

            @media screen and (max-width:377px) {
                .sendBTN {
                    font-size: 85%;
                }
            }

            @media screen and (max-width:300px) {
                header h1 {
                    margin-top: 20px;
                    line-height: 40px;
                    font-size: 180%;
                }
            }
        </style>
    </head>
    <body onload="loadListeners();">
        <header>
            <button id="chatBTN" class="btn btn-primary" onclick="goChat();">Chat</button>
            <button id="homeBTN" class="btn btn-basic" onclick="goHome();">Movies</button>
            <h1>Welcome to JBMDb,<br/> <?php echo $user_name; ?> </h1>
            <button id="logoutBTN" class="btn btn-danger" onclick="unsetUser();">Logout</button>
        </header>
    </div>


    <nav style="max-width:960px" class="container ">
        <div class="row usersDropdown">
            <div class="headChose col-xs-8">Chat With..</div>
            <input id="userName" type="hidden" value="<?php echo $user_name; ?>"/>
            <input id="friendName" type="hidden" value=""/>
            <select id="selectUser" class="userSelector selectpicker col-xs-4" multiple>
            </select>
        </div>
    </nav>

    <article style="max-width:960px" class="container">

    </article>

    <div style="max-width:960px" class="senderContainer container">
        <div class="row sender">
            <input id="messageBeforeSending" class="sendInput col-xs-9" type="text" />
            <button id="sendBTN" type="button" class="col-xs-3 sendBTN" onclick="sendMessage();">
                <p>SEND</p>
            </button>
        </div>
    </div>
</body>
<script>
    //// Header /////
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
    //// Header /////
    ////
    var letSend = false;
    ///
    function loadListeners() {
        selectUsers();

    }
    function selectUsers() {
        //// select * usernames where != to my.
        let myUname = document.getElementById('userName').value;
        let url = '../Controllers/chatControllers/chatControl.php';
        $.post(url, {uName: myUname, selectUsers: null}, function (users) {
            users = JSON.parse(users);
            if (users.length > 0) {
                let selectUser = document.getElementById('selectUser');
                users.forEach(function (user, index) {
                    selectUser.innerHTML += '<option>' + user + '</option>';
                });
            }
        })
    }
    ;
    var pie = 0;
    //////// selecting and starting interval.
    ////selectListener. when user choose friend to talk with.
    document.getElementsByTagName('select')[0].onchange = function () {
        //// in case didn't choose before..now it wll be fine.
        document.getElementById('selectUser').style.border = "1px solid black";
        var index = this.selectedIndex;
        var inputText = this.children[index].innerHTML.trim();
        ///need to verify he chose friend.
        letSend = true;
        //// here send inputText TO hidden input for detecting to for save in DB and start Interval.
        let friendName = document.getElementById('friendName');
        //
        friendName.value = inputText;
        if (pie === 1) {
            pie = 2;
            clearInterval(mommy);
            cohen = setInterval(function () {
                getMessages(inputText);
            }, 500);
        } else if (pie === 2) {
            pie = 1;
            clearInterval(cohen);
            mommy = setInterval(function () {
                getMessages(inputText);
            }, 500);
        } else {
            pie = 1;
            mommy = setInterval(function () {
                getMessages(inputText);
            }, 500);
        }
        ;
        setTimeout(function () {
            if (document.getElementsByTagName('article')[0].childElementCount > 5) {
                /// if enough messages, go botoom.
                window.scrollTo(0, document.body.scrollHeight);
            } else {
                /// if not, go top.
                document.body.scrollTop = document.documentElement.scrollTop = 0;
            }
            ;
        }, 520);
    };
    ///// send message.
    function sendMessage() {
        let messageBeforeSending = document.getElementById('messageBeforeSending');
        if (letSend && messageBeforeSending.value.length > 0) {
            //// get Properties to save in DB
            let sendThis = messageBeforeSending.value;
            let messageTo = document.getElementById('friendName').value;
            let messageFrom = document.getElementById('userName').value;
            let messageDate = getDateNow();
            let messageTime = getTimeNow();
            ////// now save in DB
            let objectToSend = {messageFrom: messageFrom, messageTo: messageTo, messageCont: sendThis, mDate: messageDate, mTime: messageTime, saveMessage: null};
            let url = '../Controllers/chatControllers/chatControl.php';
            $.post(url, objectToSend, function (response) {
                if (response == "didn't work") {
                    document.getElementById('sendBTN').style.border = " 1px solid red";
                }
                ;
                document.getElementById('sendBTN').style.border = "1 px solid gray;";
                /// else everything is fine...
            });
            /// now we know the message sent, clear the vector for next message :)
            messageBeforeSending.value = "";
        } else {
            if (!(letSend)) {
                //// if didn't choose friend, let him see it in red.
                document.getElementById('selectUser').style.border = "3px solid red";
            }
        }
    }
    ///get Date and time
    function getDateNow() {
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //January is 0!
        var yyyy = today.getFullYear();
        if (dd < 10) {
            dd = '0' + dd
        }
        if (mm < 10) {
            mm = '0' + mm
        }
        today = mm + '-' + dd + '-' + yyyy;
        return today;
    }
    function getTimeNow() {
        var now = new Date();
        var hours = now.getHours();
        var minutes = now.getMinutes();
        if (hours < 10) {
            hours = '0' + hours;
        }
        if (minutes < 10) {
            minutes = '0' + minutes;
        }
        now = hours + ':' + minutes;
        return now;
    }
    //// getMessages, set Interval yeah!
    function getMessages(friendName) {
        let userName = document.getElementById('userName').value;
        /// ask DB for messages which sent from user or
        let objectToSend = {userName: userName, friendName: friendName, getMessages: null};
        let url = '../Controllers/chatControllers/chatControl.php';
        $.post(url, objectToSend, function (messages) {
            if (messages == "couldn't load messages. please try again later.") {
                //// something happened
            } else {
                debugger;
                let article = document.getElementsByTagName('article')[0];
                article.innerHTML = "";
                /// keep going..
                messages = JSON.parse(messages);
                messages.forEach(function (message) {
                    if (message.from_user == userName) {
                        //// user messages
                        article.innerHTML += "<div class='mCont'><div class='myMessage message row'><h4>" + "You" + "</h4><p>" + message.messageCont + "</p>\n\
                        <h6>" + message.time + "</h6></div></div>";
                    } else {
                        //// friend messages
                        article.innerHTML += "<div class='mCont'><div class='friendMessage message row'><h4>" + message.from_user + "</h4><p>" + message.messageCont + "</p>\n\
                        <h6>" + message.time + "</h6></div></div>";
                    }
                })
            }
        })
    }
</script>
</html>
