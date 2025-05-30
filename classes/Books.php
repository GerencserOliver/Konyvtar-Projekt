<?php

include_once 'classes/Book.php';

class Books {
    private $conn;
    function __construct($server, $user, $password, $db)
    {
        $this->conn = new mysqli($server, $user, $password, $db);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    function getBooks() {
        $sql = "SELECT * FROM konyvek";
        $result = $this->conn->query($sql);
        $books = [];
        while ($row = $result->fetch_object()) {
            $book = new Book($row->id, $row->cim, $row->szerzo, $row->ev, $row->isbn, $row->leiras);
            $books[] = $book;
        }
        return $books;
    }

    function addBooks($book) {
        $sql = "INSERT INTO konyvek (cim, szerzo, ev, isbn, leiras) VALUES ('{$book->title}', '{$book->author}', {$book->year}, '{$book->isbn}', '{$book->description}')";
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    function deleteBooks($id) {
        $sql = "DELETE FROM konyvek WHERE id = $id";
        $this->conn->query($sql);
    }

    function getSummary() {
        $sql = "SELECT COUNT(*) as total_books FROM konyvek";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_object();
        }
        return null;
    }
}

?>