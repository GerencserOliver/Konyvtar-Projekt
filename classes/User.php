<?php

class User {
    public function __construct(public $id, public $name, public $email, public $password) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }
}
?>

<!-- CREATE TABLE felhasznalok (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nev VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    jelszo VARCHAR(255) NOT NULL
); -->