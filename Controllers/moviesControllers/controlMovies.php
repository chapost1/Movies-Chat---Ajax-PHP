<?php

require '../../DB/table_movies/moviesFunctions.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    ////Geeting Values From POST and Filters them
    ////Geeting Values From POST and Filters them
    if (!isset($_POST['id'])) {
        $id = "";
    };
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $length = filter_var($_POST['length'], FILTER_SANITIZE_STRING);
    $genre = $_POST['genre'];
    $rating = (double) $_POST['rating'];
    $image = filter_var($_POST['image'],FILTER_SANITIZE_URL);
    if (isset($_POST['create'])) {
        ////Add A Movie
        ////Add A Movie
        $check = createMovie($id, $name, $length, $genre, $rating, $image);
        try {
            if (!$check) {
                throw new Exception('Couldn' . "'t add the movie to the database.");
            }
            $moviesArray = allMovies();
            echo json_encode($moviesArray);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        ////Update A Movie
        ////Update A Movie
    } elseif (isset($_POST['update'])) {
        $id = (int) $_POST['id'];
        $check = updateMovie($id, $name, $length, $genre, $rating, $image);
        try {
            if (!$check) {
                throw new Exception('Couldn' . "'t update the movie properties.");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    //// Get Movies
    //// Get Movies
} elseif (isset($_GET['allMovies'])) {
    $moviesArray = allMovies();
    echo json_encode($moviesArray);
    ///// Delete a movie
    ///// Delete a movie
} elseif (isset($_GET['deleteMovie'])) {
    $m_id = (int) $_GET['deleteMovie'];
    $check = delMovie($m_id);
    try {
        if (!$check) {
            throw new Exception('Couldn' . "'t delete the movie.");
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    //// GET Visuality For Edit
    //// GET Visuality For Edit
} elseif (isset($_GET['editMovie'])) {
    $m_id = (int) $_GET['editMovie'];
    $movie = giveMovie($m_id);
    echo json_encode($movie);
    //// Search For a movie
    //// Search For a movie
} elseif (isset($_GET['search'])) {
    $searchKey = filter_var($_GET['search'], FILTER_SANITIZE_STRING);
    $moviesArray = searchMovie($searchKey);
    if($moviesArray === "didn't Find Any"){
        echo "Couldn't Find any movie using those keywords..";
    } else{
    echo json_encode($moviesArray);
    }
};
