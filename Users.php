<?php

include_once 'User.php';

class Users {
    private $conn;

    function __construct($server, $user, $password, $db) {
        $this->conn = new mysqli($server, $user, $password, $db);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    function register($name, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("INSERT INTO felhasznalok (nev, email, jelszo) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashedPassword);
        return $stmt->execute();
    }

    function login($email, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM felhasznalok WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $user = $result->fetch_object();
            if (password_verify($password, $user->jelszo)) {
                return new User($user->id, $user->nev, $user->email, $user->jelszo);
            }
        }
        return null;
    }
}
?>