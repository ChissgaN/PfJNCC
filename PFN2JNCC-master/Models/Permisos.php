<?php
namespace Models;
use Models\Database;

require_once $_SERVER['DOCUMENT_ROOT'] . '/Vendor/autoload.php';

class Permisos{

    private $conexion;
    public function __construct(){
        $database = new Database;
        $this->conexion = $database->getConn();
    }

    public function all(){

        $query = "SELECT usuarios.*, roles.rol AS nombre_rol, estados.estado AS nombre_estado 
        FROM usuarios
        LEFT JOIN roles ON usuarios.rol_id = roles.id
        LEFT JOIN estados ON usuarios.status_id = estados.id;";

        try {
            $stm = $this->conexion->prepare($query);
            $stm->execute();
            $rs = $stm->fetchAll(\PDO::FETCH_ASSOC);
            return $rs;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function editPermi($email, $rol_id, $status_id, $id) {
        $query = "UPDATE usuarios SET `email`=?, `rol_id`=?, `status_id`=? WHERE id=?";
        try {
            $stm = $this->conexion->prepare($query);
            $stm->execute([$email, $rol_id, $status_id, $id]);
        } catch (\PDOException $e) {
            throw new \Exception("Error al editar: " . $e->getMessage());
        }
    }

    
}


