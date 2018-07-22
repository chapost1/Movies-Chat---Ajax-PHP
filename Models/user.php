<?php

class user {

    private $user_id;
    private $username;
    private $email;
    private $password;

    function __construct($user_id, $username, $email, $password) {
        if(!($user_id === "")){
        $this->user_id = $user_id;
        };
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }

    function getUser_id() {
        return $this->user_id;
    }

    function getUsername() {
        return $this->username;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

    function setUser_id($user_id) {
        $this->user_id = $user_id;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPassword($password) {
        $this->password = $password;
    }

}
