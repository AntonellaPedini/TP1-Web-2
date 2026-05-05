<?php

class FormModel {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=galeria_de_arte_digital;charset=utf8', 'root', '');
    }

    public function validateCredentials($username, $password) {
        $query = $this->db->prepare('SELECT * FROM users WHERE username = ? AND password = ?');
        $query->execute([$username, $password]);
        return $query->fetch(PDO::FETCH_OBJ) !== false;
    }

}