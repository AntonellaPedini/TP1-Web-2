<?php
//require_once __DIR__ . '/../config.php';


class Model {
    protected $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB, MYSQL_USER, MYSQL_PASS);
        $this-> _deploy();
    }

    private function _deploy(){
        $query=$this->db->query('SHOW TABLES');
        $tables=$query->fetchAll();
        if(count($tables)==0){
            $sql=<<<END
            //copiamos las tablas del archivo exportado de phpMyAdmin
            END;
            $this->db->query($sql);
        }
    }
}