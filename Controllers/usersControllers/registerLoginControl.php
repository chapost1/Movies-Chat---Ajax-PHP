<?php
session_start();
require '../../DB/table_users/registerLoginControl.php';
////// Username Existence Check
if (isset($_POST['userCheck'])) {
    $username = filter_var($_POST['userCheck'], FILTER_SANITIZE_STRING);
    $callBack = checkUsernameExistence($username);
    echo $callBack;
    ////// Email Existence Check
} elseif (isset($_POST['emailCheck'])) {
    $email = filter_var($_POST['emailCheck'], FILTER_SANITIZE_EMAIL);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $callBack = checkEmailExistence($email);
        echo $callBack;
    } else {
        echo("bad Email");
    }
    ////// Create Userrr
} elseif (isset($_POST['register'])) {
    $user_id = "";
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    //// :)
    $TempPassword = $_POST['password'];
    $chemicalX = "p0wer_Puff_oohhhhh@^%#";
    $password = sha1($TempPassword . $chemicalX);
    ///
    $callBack = createUser($user_id, $username, $password, $email);
    echo $callBack;
    /////// Check Username & Password While LOGIN
} elseif (isset($_POST['login'])) {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $TempPassword = $_POST['password'];
    $chemicalX = "p0wer_Puff_oohhhhh@^%#";
    $password = sha1($TempPassword . $chemicalX);
///
    $callBack = checkValidation($username, $password);
    if ($callBack === 'not exist') {
        ////User is not Exist, so let the client know.
        echo 'not exist';
    } else {
        ////// user exists, take the user and enjoy.
        $_SESSION['currentUser'] = $callBack;
    }
}
