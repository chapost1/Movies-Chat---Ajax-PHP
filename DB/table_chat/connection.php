<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "movies_db_st";

$conn = new mysqli($servername, $username, $password, $dbname);

$GLOBALS['conn'] = $conn;