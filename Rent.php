<?php

class Rent{
    public function __construct(public $id, public $book_id, public $renter_name, public $date, public $returned){
        $this->id = $id;
        $this->book_id = $book_id;
        $this->renter_name = $renter_name;
        $this->date = $date;
        $this->returned = $returned;
    }
}

?>