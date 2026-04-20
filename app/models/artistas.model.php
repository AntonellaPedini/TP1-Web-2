<?php
//require_once __DIR__ . '/mock_data.php';

class ArtistasModel {
    private $db;

    public function __construct (){
        $this->db = new PDO ('mysql:host=localhost;dbname=galeria_de_arte_digital;charset=utf8', 'root', '');
    }

    public function getAll() {
        $query = $this->db->prepare ('SELECT * FROM artista') ;
        $query->execute ();
        $artistas = $query->fetchAll (PDO::FETCH_OBJ) ;
        return $artistas;
    }

    public function getByName($name) {
        $query = $this->db->prepare ('SELECT * FROM artista WHERE nombre_completo = ?') ;
        $query->execute ([$name]);
        $artista = $query->fetch (PDO::FETCH_OBJ) ;
        return $artista;
    }
}
