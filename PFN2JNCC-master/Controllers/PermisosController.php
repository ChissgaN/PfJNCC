<?php 
use Models\Permisos;

require_once $_SERVER['DOCUMENT_ROOT'] . '../Vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '../Models/Permisos.php';

class PermisosController{

    public function create(){

        $usuario = new Permisos;
        $data =  $usuario->all();
    }

    public function all(){
        $usuario = new Permisos;
        return $usuario->all();
    }


    public function editPermiso() {
        $id = $_POST['id'];
        $email = $_POST['email'];
        $rol_id = $_POST['rol_id'];
        $status_id = $_POST['status_id'];

        $editPermisos = new Permisos;
        $editPermisos->editPermi($email, $rol_id,  $status_id, $id);
    
        header('location: ../Views/admin_permisos.php?editPermi');

        print_r($_POST);
    }

    
}



