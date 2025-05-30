<?php

class Book{
    public function __construct(public $id, public $title, public $author, public $year, public $isbn, public $description){
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->year = $year;
        $this->isbn = $isbn;
        $this->description = $description;
    }
}

?>