<?php

class movie{
    
    public $id;
    public $name;
    public $length;
    public $genre;
    public $rating;
    public $image;
    
    function __construct($id, $name, $length, $genre, $rating, $image) {
        if(!($id == "" || $id === NULL)){
            $this->id = $id;
        }
        $this->name = $name;
        $this->length = $length;
        $this->genre = $genre;
        $this->rating = $rating;
        $this->image = $image;
    }

    
    
}