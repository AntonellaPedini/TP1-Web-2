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
        $query = $this->db->prepare ('SELECT obras.*, artista.nombre_completo
                                    FROM obras
                                    JOIN artista ON obras.id_artista = artista.id_artista
                                    WHERE obras.id_obra = ?') ;//'SELECT * FROM obras WHERE id_obra = ?'
        $query->execute ([$id]);
        $obra = $query->fetch (PDO::FETCH_OBJ) ;
        return $obra;
    }

    public function insert ($nombre, $año_creacion, $tecnica, $soporte, $corriente_artistica, $descripcion, $imagen, $id_artista){
        $query = $this->db-> prepare ('INSERT INTO obras (`nombre`, `año_creacion`, `tecnica`, `soporte`, `corriente_artistica`, `descripcion`, `imagen`, `id_artista`) VALUES (?,?,?,?,?,?,?,?)');
        $query -> execute ([$nombre, $año_creacion, $tecnica, $soporte, $corriente_artistica, $descripcion, $imagen, $id_artista]);
        return $this->db->lastInsertId();
    }

    public function delete ($id){
        $query = $this->db->prepare ('DELETE FROM obras WHERE id_obra = ?') ;
        $query->execute ([$id]);
        return $query->rowCount();
    }

    public function update($nombre, $año_creacion, $tecnica, $soporte, $corriente_artistica, $descripcion, $imagen, $id_artista, $id_obra) {
    $query = $this->db->prepare('UPDATE obras SET nombre=?, año_creacion=?, tecnica=?, soporte=?, corriente_artistica=?, descripcion=?, imagen=?, id_artista=? WHERE id_obra=?');
    $query->execute([$nombre, $año_creacion, $tecnica, $soporte, $corriente_artistica, $descripcion, $imagen, $id_artista, $id_obra]);
    return $query->rowCount();
    }

    }

