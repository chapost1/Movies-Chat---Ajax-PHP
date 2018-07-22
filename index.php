<?php

require_once 'Models/user.php';
session_start();
///////////////
require_once 'DB/createSchema.php';
///// require for season
////
// Grabs the URI and breaks it apart in case we have querystring stuff
$request_uri = explode('/', $_SERVER['REQUEST_URI'], 2);

// Route it up!
switch ($request_uri[1]) {
    // Home page
    case '':
    case 'home':
        require './Viewers/home.php';
        break;
    // movies page
    case 'movies':
        if (isset($_SESSION['currentUser'])) {
            require './Viewers/movies.php';
        } else {
            require './Viewers/notAuser.php';
        }
        break;
    case 'chat':
        if (isset($_SESSION['currentUser'])) {
            require './Viewers/chat.php';
        } else {
            require './Viewers/notAuser.php';
        }
        break;
    // Everything else - catch error 404
    default:

        require './Viewers/404.php';
        break;
}