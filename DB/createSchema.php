<?php

$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Create book_store database
$sqlCreateSchema = "CREATE DATABASE IF NOT EXISTS movies_db_st;";
try {
    $results = $conn->query($sqlCreateSchema);
    if (!$results) {
        throw new Exception("Creating movies_db_st Has Failed");
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
// Create movies Table
$sqlCreateMoviesTable = "CREATE TABLE `movies_db_st`.`movies` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `length` VARCHAR(45) NULL,
  `genre` VARCHAR(45) NULL,
  `rating` DOUBLE NULL DEFAULT 0,
  `image` LONGTEXT NULL,
  PRIMARY KEY (`id`));";
try {
    $results1 = $conn->query($sqlCreateMoviesTable);
    if (!$results1) {
        throw new Exception("");
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
// Create users Table
$sqlCreateUsersTable = "CREATE TABLE `movies_db_st`.`users` (
`user_id` INT NOT NULL AUTO_INCREMENT,
 `username` VARCHAR(45) NULL,
 `email` VARCHAR(255) NULL,
 `password` VARCHAR(45) NULL,
 PRIMARY KEY (`user_id`));";
try {
    $results2 = $conn->query($sqlCreateUsersTable);
    if (!$results2) {
        throw new Exception("");
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
// Create messages Table
$sqlCreateMessagesTable = "CREATE TABLE `movies_db_st`.`messages` (
  `message_id` INT NOT NULL AUTO_INCREMENT,
  `from_user` VARCHAR(255) NULL,
  `to_user` VARCHAR(255) NULL,
  `message` LONGTEXT NULL,
  `date` VARCHAR(45) NULL,
  `time` VARCHAR(45) NULL,
  PRIMARY KEY (`message_id`));";
try {
    $results3 = $conn->query($sqlCreateMessagesTable);
    if (!$results3) {
        throw new Exception("");
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

$conn->close();
