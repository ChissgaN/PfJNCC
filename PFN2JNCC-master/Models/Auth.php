<?php

namespace Models;
use Models\Database;

require_once $_SERVER['DOCUMENT_ROOT'] . '/Vendor/autoload.php';

class Auth{

    private $conexion;
    public function __construct(){
        $database = new Database;
        $this->conexion = $database->getConn();
    }

    public function select($email){
        $query = "SELECT * FROM usuarios WHERE email = ?";
    
        try {
            $stm = $this->conexion->prepare($query);
            $stm->execute([$email]);
    
            $result = $stm->fetch(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    public function register($name, $surname, $correo, $password, $address, $rol_id, $date, $materias_id = null){
        $query = "INSERT INTO usuarios(`name`, `surname`, `email`, `password`, `address`, `rol_id`, `date`, `materias_id`, `status_id`) VALUES (?,?,?,?,?,?,?,?,1)";
        
        try {
            $stm = $this->conexion->prepare($query);
            $stm->execute([$name, $surname, $correo, $password, $address, $rol_id, $date, $materias_id]);

            
            return true;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function edit($id, $name, $surname, $email, $password, $address, $rol_id, $date, $materias_id){
        $query = "UPDATE usuarios SET `name`=?, `surname`=?, `email`=?, `password`=?, `address`=?, `rol_id`=?, `date`=?,  `materias_id`=? WHERE id=?";

    try {
            $stm = $this->conexion->prepare($query);
            $stm->execute([$name, $surname, $email, $password, $address, $rol_id, $date, $materias_id, $id]);
        }catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function delete($id){
        $query = 'DELETE FROM usuarios WHERE id = ?';

        try {
            $stm = $this->conexion->prepare($query);
            $stm->execute([$id]);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

}



