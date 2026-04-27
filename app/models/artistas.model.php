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

    public function insert ($nombre_completo, $fecha_nacimiento, $fecha_fallecimiento, $corriente, $nacionalidad, $biografia, $imagen){
        $query = $this->db-> prepare ('INSERT INTO (`id_artista`, `nombre_completo`, `fecha_nacimiento`, `fecha_fallecimiento`, `corriente`, `nacionalidad`, `biografia`, `imagen`) VALUES (?,?, ?,?,?,?,?,?)');
        $query -> execute ([$nombre_completo, $fecha_nacimiento, $fecha_fallecimiento, $corriente, $nacionalidad, $biografia, $imagen]);
        return $this->db->lastInsertId ;
    }

    public function delete ($id){
        $query = $this->db->prepare ('DELETE FROM artistas WHERE id_artista = ?') ;
        $query->execute ([$id]);
        return $this->db->rowCount();
    }

    public function update ($nombre_completo, $fecha_nacimiento, $fecha_fallecimiento, $corriente, $nacionalidad, $biografia, $imagen, $id_artista){
        $query = $this->db-> prepare ('UPDATE artista SET (`nombre_completo`=?,`fecha_nacimiento`=?,`fecha_fallecimiento`=?,`corriente`= ?,`nacionalidad`=?,`biografia`=?,`imagen`=?) WHERE `id_artista`=?');
        $query -> execute ([$nombre_completo, $fecha_nacimiento, $fecha_fallecimiento, $corriente, $nacionalidad, $biografia, $imagen, $id_artista]);
        return $this->db->rowCount();
        
    }

}
