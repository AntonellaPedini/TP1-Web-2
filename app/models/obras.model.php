<?php
//require_once __DIR__ . '/mock_data.php';

class ObrasModel {
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

    public function insert ($nombre, $anio, $tecnica, $soporte, $corriente, $descripcion, $imagen, $id_artista){
        $query = $this->db-> prepare ('INSERT INTO (`id_obra`, `nombre`, `año_creacion`, `tecnica`, `soporte`, `corriente_artistica`, `descripcion`, `imagen`, `id_artista`) VALUES (?,?, ?,?,?,?,?,?,?)');
        $query -> execute ([$nombre, $anio, $tecnica, $soporte, $corriente, $descripcion, $imagen, $id_artista]);
        return $this->db->lastInsertId ;
    }

    public function delete ($id){
        $query = $this->db->prepare ('DELETE FROM obras WHERE id_obra = ?') ;
        $query->execute ([$id]);
        return $this->db->rowCount();
    }

    public function update ($nombre, $anio, $tecnica, $soporte, $corriente, $descripcion, $imagen, $id_artista){
        $query = $this->db-> prepare ('UPDATE obra SET (`nombre`=?,`año_creacion`=?,`tecnica`=?,`soporte`= ?,`corriente_artistica`=?,`descripcion`=?,`imagen`=?) WHERE `id_obra`=?');
        $query -> execute ([$nombre, $anio, $tecnica, $soporte, $corriente, $descripcion, $imagen, $id_obra]);
        return $this->db->rowCount();
        
    }
    

    }

