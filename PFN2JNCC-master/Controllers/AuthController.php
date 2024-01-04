<?php


use Models\Auth;
use Models\Usuarios;

require_once $_SERVER['DOCUMENT_ROOT'] . '../Vendor/autoload.php';


class AuthController{

    public function login() {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $auth = new Auth;
        $user = $auth->select($email);

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['userData'] = $user;

            if ($user['rol_id'] == 2) {
                header('location: ../Views/maestro_dashboard.php');
            }else if ($user['rol_id'] == 3) {
                header('location: ../Views/alumno_dashboard.php');

            } else {
                header('location: ../Views/admin_dashboard.php');
            }
            exit();
        }

        header('location: ../Views/login.php');
        exit();
    }

    public function logout(){
        session_start();
        session_destroy();

        header('location: ../Views/login.php');
        exit();
    }

    public function create(){

        $usuario = new Usuarios;
        $data =  $usuario->all();
        
    }

    public function store(){
        
        $name =  $_POST['name'];
        $surname =  $_POST['surname'];
        $email =  $_POST['email'];
        $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $address =  $_POST['address'];
        $rol_id =  $_POST['rol'];
        $date =  $_POST['date'];
        $materias_id =  $_POST['materias'];
    
        $auth = new Auth;
        $auth->register($name, $surname, $email, $hash, $address, $rol_id, $date, $materias_id); 

        $this->update();
    
    }

    public function update(){
        $usuario = new Usuarios;
        $data = $usuario->all();

        include $_SERVER['DOCUMENT_ROOT'] . '/Views/admin_maestros.php';
    }


    public function edit (){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : '';
        $address = $_POST['address'];
        $rol_id = $_POST['rolEdit'];
        $date = $_POST['date'];
        $materias_id = $_POST['materiasEdit'];

        $editTeacher = new Auth;
        $editTeacher->edit($id, $name, $surname, $email, $password, $address, $rol_id, $date,  $materias_id);


        header('location: ../Views/admin_maestros.php?edit');

    }

    public function delete(){
        $id = $_POST['id'];
    
        $teacher = new Auth;
        $teacher->delete($id);
    
        header('location: ../Views/admin_maestros.php?delete');
    }
}




