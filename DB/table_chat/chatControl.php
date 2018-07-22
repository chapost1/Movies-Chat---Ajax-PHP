<?php

require '../../Models/message.php';
require 'connection.php';

//////
//// let user see other users to choose
/// gets user username
// bring all others
function getUsers($username) {
    $conn = $GLOBALS['conn'];
    $sqlSentece = "SELECT username FROM users WHERE username !='" . $username . "'";
    $result = $conn->query($sqlSentece);
    try {
        if (!$result) {
            throw new Exception("we are having issues, please try again later.");
        }
        $usersArray = array();
        while ($row = $result->fetch_assoc()) {
            array_push($usersArray, $row['username']);
        }
        return $usersArray;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

//// upload message to DB
/// gets message properties from user & application
// return if happened
function uploadMessageToDB($message_id, $from_user, $to_user, $messageCont, $date, $time) {
    $conn = $GLOBALS['conn'];
    $message = new message($message_id, $from_user, $to_user, $messageCont, $date, $time);
    $sqlSentence = $conn->prepare("INSERT INTO messages (from_user, to_user, message, date, time) VALUES (?, ?, ?, ?, ?)");
    $sqlSentence->bind_param("sssss", $message->from_user, $message->to_user, $message->messageCont, $message->date, $message->time);
    try {
        $result = $sqlSentence->execute();
        $conn->close();
        if (!$result) {
            throw new Exception("didn't work");
        }
        return 'worked';
    } catch (Exception $ex) {
        return $ex->getMessage();
    }
}

///// messages Viewer in chat.
/// get from Application chosen users to check
/// returns messages to view
function getRelevantMessagesFromDB($user1, $user2) {
    $conn = $GLOBALS['conn'];
    $sqlSelectRelevnt = "SELECT * FROM messages WHERE from_user ='" . $user1 . "'"
            . " AND to_user ='" . $user2 . "' OR from_user ='" . $user2 . "' AND to_user ='" . $user1 . "'";
    try {
        $result = $conn->query($sqlSelectRelevnt);
        $conn->close();
        if(!$result){
            throw new Exception("couldn't load messages. please try again later.");
        }
        $messagesArray = array();
        while($row = $result->fetch_assoc()){
            $currentMessage = new message($row['message_id'], $row['from_user'], $row['to_user'], $row['message'], $row['date'], $row['time']);
            array_push($messagesArray, $currentMessage);
        }
        return $messagesArray;
    } catch (Exception $ex) {
        return $ex->getMessage();
    }
}
