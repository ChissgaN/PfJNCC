<?php

namespace Models;

use Models\Database;

require_once $_SERVER['DOCUMENT_ROOT'] . '/Vendor/autoload.php';

class Usuarios{
    private $conexion;
    public function __construct(){
        $database = new Database;
        $this->conexion = $database->getConn();
    }

    // mostrar todos los Maestros
    public function all(){

        $query = "SELECT usuarios.*, materias.materia
          FROM usuarios
          LEFT JOIN materias ON usuarios.materias_id = materias.id
          WHERE usuarios.rol_id = 2";

        try {
            $stm = $this->conexion->prepare($query);
            $stm->execute();
            $rs = $stm->fetchAll(\PDO::FETCH_ASSOC);
            return $rs;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function updateMateria($materias_id, $id){

        $query = "UPDATE usuarios SET `materias_id`=? WHERE id=?";
        try {
            $stm = $this->conexion->prepare($query);
            $stm->execute([$materias_id, $id]);
        } catch (\PDOException $e) {
            throw new \Exception("Error al editar: " . $e->getMessage());
        }

    }
 
}

