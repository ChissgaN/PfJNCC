<?php

namespace Models;
use Models\Usuarios;
use Models\Database;

require_once $_SERVER['DOCUMENT_ROOT'] . '/Vendor/autoload.php';

class Materias{

    private $conexion;
    public function __construct(){
        $database = new Database;
        $this->conexion = $database->getConn();
    }

    public function select(){
        $query = "SELECT materias.*, 
                GROUP_CONCAT(CASE WHEN usuarios.rol_id = 2 THEN usuarios.name END) AS maestros,
                COUNT(CASE WHEN usuarios.rol_id = 3 THEN 1 END) AS num_alumnos
                FROM materias 
                LEFT JOIN usuarios ON usuarios.materias_id = materias.id
                GROUP BY materias.id;";
    
        try {
            $stm = $this->conexion->prepare($query);
            $stm->execute();
    
            $result = $stm->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    public function createMate($materia, $userId){
        $query = "INSERT INTO materias(`materia`) VALUES (?)";
        
        try {
            $stm = $this->conexion->prepare($query);
            $stm->execute([$materia]);
            $lastInsertedId = $this->conexion->lastInsertId();
            if(isset($userId) && $userId != null ){
                $proof = new Usuarios;
                $proof->updateMateria($lastInsertedId, $userId);
            }
            
            

            
            return true;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function editMate($materia){
        $query = "UPDATE materias SET `materia`=? WHERE id=?";

    try {
            $stm = $this->conexion->prepare($query);
            $stm->execute([$materia]);
        }catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function deleteMate($id){
        $query = 'DELETE FROM materias WHERE id = ?';

        try {
            $stm = $this->conexion->prepare($query);
            $stm->execute([$id]);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
    
}

