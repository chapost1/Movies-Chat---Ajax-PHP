<?php

require '../../DB/table_chat/chatControl.php';
///// start, select users to talk with.
if (isset($_POST['selectUsers'])) {
    $username = $_POST['uName'];
    $usernamesArray = getUsers($username);
    echo json_encode($usernamesArray);
}
elseif (isset($_POST['saveMessage'])) {
    /////save message in DB, which sent. huhmm...
    $message_id = "";
    $from_user = $_POST['messageFrom'];
    $to_user = $_POST['messageTo'];
    $messageCont = htmlspecialchars($_POST['messageCont']);
    $date = $_POST['mDate'];
    $time = $_POST['mTime'];
    $response = uploadMessageToDB($message_id , $from_user , $to_user , $messageCont , $date , $time);
    echo $response;
} elseif (isset ($_POST['getMessages'])) {
    $user1 = $_POST['userName'];
    $user2 = $_POST['friendName'];
    $messagesArray = getRelevantMessagesFromDB($user1 , $user2);
    if(!($messagesArray == "couldn't load messages. please try again later.")){
        /// messages came back;
    echo json_encode($messagesArray);
    } else {
        //// string, of failure, no need JSON_ENCODE
        echo $messagesArray;
    }
}
