<?php

require_once '../../Models/user.php';
require 'connection.php';

////// Check Username Existence In DB\
///// Gets Username From client
//// Returns Answer
function checkUsernameExistence($username) {
    $conn = $GLOBALS['conn'];

    try {
        $sqlSentence = "SELECT * FROM users WHERE username ='" . $username . "'";
        $result = $conn->query($sqlSentence);
        $conn->close();
        if (!$result) {
            throw new Exception("Couldn't Get Information. Please try again later.");
        };
        if ($row = $result->fetch_assoc() > 0) {
            return "exist";
        } else {
            return "ok";
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

////// Check Email Existence In DB\
///// Gets Email From client
//// Returns Answer
function checkEmailExistence($email) {
    $conn = $GLOBALS['conn'];

    try {
        $sqlSentence = "SELECT * FROM users WHERE email ='" . $email . "'";
        $result = $conn->query($sqlSentence);
        $conn->close();
        if (!$result) {
            throw new Exception("Couldn't Get Information. Please try again later.");
        };
        if ($row = $result->fetch_assoc() > 0) {
            return "exist";
        } else {
            return "ok";
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

////// Adds User to DB
///// Gets Properites From client
//// Returns Answer
function createUser($user_id, $username, $password, $email) {
    $conn = $GLOBALS['conn'];
    /// creates User Model.
    $newUser = new user($user_id, $username, $email, $password);
    $gotUsername = $newUser->getUsername();
    $gotPassword = $newUser->getPassword();
    $gotEmail = $newUser->getEmail();
    $sqlSentence = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    /// try sentence
    $sqlSentence->bind_param("sss", $gotUsername, $gotEmail, $gotPassword);
    try {
        $result = $sqlSentence->execute();
        if (!$result) {
            throw new Exception("Creating User has failed.");
        };
        $worked = "worked";
    } catch (Exception $e) {
        echo $e->getMessage();
        $worked = "failed";
    }
    $conn->close();
    return $worked;
}

////// Check User in DB
///// Gets Details From client
//// Returns User
function checkValidation($user_name, $password_now) {
    $conn = $GLOBALS['conn'];

    try {
        $sqlSelectUser = "SELECT * FROM users WHERE username ='" . $user_name . "' AND password ='" . $password_now . "' ";
        $result = $conn->query($sqlSelectUser);
        $conn->close();
        if (!$result) {
            throw new Exception("Couldn't Get Information. Please try again later.");
        };
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $currentUser = new user($row['user_id'], $row['username'], $row['password'], $row['email']);
            return $currentUser;
        } else {
            return "not exist";
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}