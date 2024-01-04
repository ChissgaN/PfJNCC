<?php

use Models\Materias;
use Models\Usuarios;
require_once $_SERVER['DOCUMENT_ROOT'] . '/Vendor/autoload.php';

class MateriasController{
    
    public function createMateria(){
        
        $userId = $_POST['maestro_id'];
        $materia =  $_POST['materia'];
    
        $materiaInst = new Materias;
        $materiaInst->createMate($materia, $userId); 

        $this->update();
         
    
    }

    public function update(){
        $materias = new Materias;
        $data = $materias->select();

        include $_SERVER['DOCUMENT_ROOT'] . '../Views/admin_clases.php';
    }

    public function editMateria(){
        $materiaId = $_POST['id'];
        $materia = $_POST['materiasEdit'];
        $maestro_id = $_POST['maestro_id'];

        $editMateria = new Materias;
        $editMateria->editMate($materia);
        if(isset($maestro_id) && $maestro_id != null ){
            $proof = new Usuarios;
            $proof->updateMateria($materiaId, $maestro_id);
        }


        header('location: ../Views/admin_clases.php?edit');

    }

    public function deleteMateria(){
        $id = $_POST['id'];
    
        $materia = new Materias;
        $materia->deleteMate($id);
    
        header('location: ../Views/admin_clases.php?delete');
    }
}


