<?php

class HomeModel {
    private $db;

    public function __construct (){
        $this->db = new PDO ('mysql:host=localhost;dbname=galeria_de_arte_digital;charset=utf8', 'root', '');
    }

    public function getAll() {
        $query = $this->db->prepare ('SELECT * FROM obras') ;
        $query->execute ();
        $obras = $query->fetchAll (PDO::FETCH_OBJ) ;
        return $obras;
    }

    public function get($id) {
        $query = $this->db->prepare ('SELECT * FROM obras WHERE id_obra = ?') ;
        $query->execute ([$id]);
        $obra = $query->fetch (PDO::FETCH_OBJ) ;
        return $obra;
    }
    
    public function getImagenesCarrusel() {
        $query = $this->db->prepare('SELECT id_obra, nombre, imagen FROM obras WHERE imagen IS NOT NULL');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    }