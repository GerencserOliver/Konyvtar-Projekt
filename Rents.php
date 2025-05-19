<?php

include_once 'Rent.php';

class Rents {
    private $conn;

    function __construct($server, $user, $password, $db) {
        $this->conn = new mysqli($server, $user, $password, $db);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    function getRents() {
        $sql = "SELECT * FROM kolcsonzesek";
        $result = $this->conn->query($sql);
        $rents = [];
        while ($row = $result->fetch_object()) {
            $rent = new Rent($row->id, $row->konyv_id, $row->kolcsonzo_nev, $row->datum, $row->visszahozva);
            $rents[] = $rent;
        }
        return $rents;
    }

    function addRent($rent) {
        $sql = "INSERT INTO kolcsonzesek (konyv_id, kolcsonzo_nev, datum, visszahozva) VALUES ('$rent->book_id', '$rent->renter_name', '$rent->date', '$rent->returned')";
        $this->conn->query($sql);
    }

    function returnBook($id) {
        $sql = "UPDATE kolcsonzesek SET visszahozva = 1 WHERE id = $id";
        $this->conn->query($sql);
    }

    function deleteRent($id) {
        $sql = "DELETE FROM kolcsonzesek WHERE id = $id";
        $this->conn->query($sql);
    }
}

?>