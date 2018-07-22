<?php

require '../../Models/movie.php';
require 'connection.php';

////Add A Movie
/// Gets Movie Properties to add
/// returns if it added to db or not.
function createMovie($id, $name, $length, $genre, $rating, $image) {
    $conn = $GLOBALS['conn'];
    $currentMovie = new movie($id, $name, $length, $genre, $rating, $image);
    $sqlAddMovie = $conn->prepare("INSERT INTO movies (name, length, genre, rating, image) VALUES (?, ?, ?, ?, ?)");
    $sqlAddMovie->bind_param("sssds", $currentMovie->name, $currentMovie->length, $currentMovie->genre, $currentMovie->rating, $currentMovie->image);
    try {
        $result = $sqlAddMovie->execute();
        if (!$result) {
            throw new Exception("Adding: " . htmlspecialchars($currentMovie->name) . " has failed.");
        };
        $worked = true;
    } catch (Exception $e) {
        echo $e->getMessage();
        $worked = false;
    }
    $conn->close();
    return $worked;
}

;

////Get all movies records from db
///makes an array of it
/// returns the array
function allMovies() {
    require 'connection.php';
    $sqlSelectAll = "SELECT * FROM movies";
    try {
        $result = $conn->query($sqlSelectAll);
        if (!$result) {
            throw new Exception("We are having some issues. Couldn't load movies.");
        }
        $moviesArray = array();
        while ($row = $result->fetch_assoc()) {
            $currentMovie = new movie($row['id'], $row['name'], $row['length'], $row['genre'], $row['rating'], $row['image']);
            array_push($moviesArray, $currentMovie);
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    $conn->close();
    return $moviesArray;
}

;

/// Delete a movie
////Get an ID of movie to delete
/// returns if it happened
function delMovie($m_id) {
    $conn = $GLOBALS['conn'];
    $sqlDelMovie = ("DELETE FROM movies WHERE id=" . $m_id . "");
    try {
        $result = $conn->query($sqlDelMovie);
        if (!$result) {
            throw new Exception("Deleting has failed.");
        };
        $worked = true;
    } catch (Exception $e) {
        echo $e->getMessage();
        $worked = false;
    }
    $conn->close();
    return $worked;
}

;

/// Edit a movie
////Get an ID of movie to edit
/// returns movie Object
function giveMovie($m_id) {
    $conn = $GLOBALS['conn'];
    $sqlGetMovie = ("SELECT * FROM movies WHERE id=" . $m_id . "");
    try {
        $result = $conn->query($sqlGetMovie);
        $conn->close();
        if (!$result) {
            throw new Exception("Getting Properties failed.");
        };
        $row = $result->fetch_assoc();
        $movie = new movie($row['id'], $row['name'], $row['length'], $row['genre'], $row['rating'], $row['image']);
        return $movie;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

;

/// Update a movie
////Get an ID of movie to update
/// returns if it happened
function updateMovie($id, $name, $length, $genre, $rating, $image) {
    $conn = $GLOBALS['conn'];
    $currentMovie = new movie($id, $name, $length, $genre, $rating, $image);
    $sqlUpdateSentence = $conn->prepare("UPDATE movies SET name = ? , length = ? , genre = ? , rating = ? , image = ? WHERE id = $currentMovie->id");
    $sqlUpdateSentence->bind_param("sssds", $currentMovie->name, $currentMovie->length, $currentMovie->genre, $currentMovie->rating, $currentMovie->image);
    try {
        $result = $sqlUpdateSentence->execute();
        if (!$result) {
            throw new Exception("Updating: " . htmlspecialchars($currentMovie->name) . " has failed.");
        };
        $worked = true;
    } catch (Exception $e) {
        echo $e->getMessage();
        $worked = false;
    }
    $conn->close();
    return $worked;
}

;

/// Search a movie
////Get a name of movie to Search
/// returns moviesArray which found
function searchMovie($searchKey) {
    $conn = $GLOBALS['conn'];
    $sqlSelectAll = "SELECT * FROM movies WHERE name LIKE '%".$searchKey."%'";
    try {
        $result = $conn->query($sqlSelectAll);
        if (!$result) {
            throw new Exception("We are having some issues. Couldn't load movies.");
        }
        $moviesArray = array();
        while ($row = $result->fetch_assoc()) {
            $currentMovie = new movie($row['id'], $row['name'], $row['length'], $row['genre'], $row['rating'], $row['image']);
            array_push($moviesArray, $currentMovie);
        }
    } catch (Exception $e) {
        echo $e->getMessage();
        return "didn't Find Any";
    }

    $conn->close();
    return $moviesArray;
}

;
