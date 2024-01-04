<?php

namespace Views; 

    session_start();
    if (!isset($_SESSION['userData'])) {
        header('location: ../Views/login.php');
    }

use Models\Database;
use Models\Materias;

require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/Database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/Materias.php';

$database = new Database();
$conn = $database->getConn();

$materia = new Materias;
$data = $materia->select();

$query = "SELECT usuarios.id, usuarios.name, usuarios.surname FROM usuarios where rol_id = 2";
$result = $conn->query($query);

/* Edit  */

$queryEdit = "SELECT usuarios.id, usuarios.name, usuarios.surname FROM usuarios where rol_id = 2";
$resultEdit  = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Style Sheet CSS-->
    <link rel="stylesheet" href="../assets/adminclasesStyles.css">

    <!-- Boostrap Styles-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Google Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

    <!-- DataTables JavaScript -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <title>Admin Clases</title>
</head>

<body style="background-color: whitesmoke;" id="body">
    
<!-- Principal Nav -->
    <nav class="nave" >
    <div class="divMenu" >
        <a href="" class="menuA" >
            <span class="material-symbols-outlined menu">menu</span>
            <h5 class="ms-5 home" >Home</h5>
        </a>
    </div>
    <div class="divMenu">
        <button href="" class="dropA" id="dropA">
            <h5 class="admiDrop" >Administrador</h5>
            <span class="material-symbols-outlined drop">arrow_drop_down</span>
        </button>
        <!-- menu toggle -->
        <form action="../index.php?controller=AuthController&action=logout" method="post" id="logoutForm">
            <ul class="menuToggle" id="menuToggle">
            
                <li class="ms-3 mt-2 mb-4 litg" >
                    <a class="optionsTg" href="./admin_dashboard.php" style="color: black;">Perfil
                        <span class="material-symbols-outlined iconsTg">person</span>
                    </a>
                </li>
                <button style="background-color: white; border: none" id="btnLogout" >
                    <li  class="ms-3 litg">
                        <a  class="optionsTg" href=""  style="color: red;">Logout
                            <span class="material-symbols-outlined iconsTg">logout</span>
                        </a>
                    </li>
                </button>
            </ul>
        </form>
    </div>
    </nav>

<!-- Inside -->
    <div class="inside" >
        <h4>Lista de Clases</h4>
        <div class="insideTwoContainer">
            <div class="insideTwo" >
                <a href="./admin_dashboard.php" class="hoDa">Home </a>
                <p class="pDa" > / Clases</p>
            </div>
        </div>
    </div>

    <div class="ms-3 allTable">
        <div class="d-flex divOp">
            <p class="ms-2 mb-0" >Información de Clases</p>
            <button class="me-2  mb-0 btn btn-primary addClass" id="addClassB" >Agregar Clase</button>
        </div>
        <div class="d-flex ms-3 me-3 mt-2 bar">
            <div class="divVar" style="background-color:gray">
                <a class="ms-2 opVa" href="">Copy</a>
                <a class="opVa" href="">Excel</a>
                <a class="opVa" href="">PDF</a>
                <a class="opVa" href="">Colum visibiliry <span class="material-symbols-outlined dropVa" style="color:white" >arrow_drop_down</span></a>
            </div>
            <div>
                <label for="" class="search" >Search</label>
                <input type="text" class="inSearch">
            </div>
        </div>
        <table id="miTabla" class=" ms-3 me-4 mt-3 tableP">
            
            <thead>
                <tr class="fileHead">
                    <th class="ps-3 id">#</th>
                    <th class="ps-3 clase">Clase</th>
                    <th class="ps-3 maestros">Maestro</th>
                    <th class="ps-3 alumnos">Alumnos inscritos</th>
                    <th class="ps-3 acciones">Acciones</th>
                </tr>
            </thead>
            <tbody class="bodyTable" >
                <?php foreach ($data as $materia): ?>
                    <tr class="fileBody">
                        <td class="ps-3 idP"><?php echo $materia['id']; ?></td>
                        <td class="ps-3 claseP"><?php echo $materia['materia']; ?></td>
                        <td class="ps-3 maestrosP"><?php echo $materia['maestros']; ?></td>
                        <td class="ps-3 alumnosP"><?php echo $materia['num_alumnos']; ?></td>
                        <td class="d-flex ps-5 pt-2 accionesP">
                        <button class="editButton"
                            data-id="<?php echo $materia['id']; ?>"
                            data-materia="<?php echo $materia['materia']; ?>"
                                style="border: none; background-color:white">
                                <span class="material-symbols-outlined ps-2 pe-2" style="color:#007bff">edit_square</span>
                        </button>

                            <!-- Delete Class -->
                        <form action="../index.php?controller=MateriasController&action=deleteMateria" method="post">
                            <input type="hidden" name="id" value="<?php echo $materia['id']; ?>">
                            <button style="border: none; background-color:white"><span class="material-symbols-outlined" style="color:red" >delete</span></button>
                        </form>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<!-- Footer -->
    <footer class="ftr" >
        <p class="ms-3 mb-0">Copyright 2014-2021. All rights reserve</p>
        <p class="mb-0 me-3">Created by ChissgaN</p>
    </footer>


<!-- Sidebar -->
    <div class="sidebar">
        <div class="d-flex align-top logoDiv" >
            <img src="../assets/logoS.JPEG" alt="University logo" class="d-inline-block logo" >
            <p class="d-inline-block align-middle uni" >Universidad</p>
        </div>
        <div class=" mt-3   admin" >
            <h5 class="ms-3 mb-2 textAdmin" >admin</h5>
            <p class="ms-3 mb-2 textAdmin" >Administrador</p>
        </div>
            <ul class="mt-4 options" > MENU ADMINISTRACIÓN
                <li class="mt-4">
                    <a class="optionsA" href="./admin_permisos.php">Permisos
                        <span class="material-symbols-outlined icons">manage_accounts</span>
                    </a>
                </li>
                <li class="mt-4">
                    <a class="optionsA" href="./admin_maestros.php">Maestros
                        <span class="material-symbols-outlined icons">interactive_space</span>
                    </a>
                </li>
                <li class="mt-4">
                    <a class="optionsA" href="./admin_alumno.php">Alumnos
                    <span class="material-symbols-outlined icons">school</span>
                    </a>
                </li>
                <li class="mt-4">
                    <a class="optionsA" href="./admin_clases.php">Clases
                        <span class="material-symbols-outlined icons">jamboard_kiosk</span>
                    </a>
                </li>
            </ul>
    </div>

<!-- Create -->
    <div class="create" id="create" >
        <h2 class="ms-4 mt-4 mb-4" >Agregar clase</h2>
        <form action="../index.php?controller=MateriasController&action=createMateria" method="POST">
            <div class="formuCre">
                <label class="d-inline" for=""><h6>Nombre de la materia</h6></label>
                <input class="inpAdd mb-4" type="text" name="materia">
                

                <label class="d-inline"  for=""><h6>Maestros disponibles para la clase</h6></label>
                <select name="maestro_id" id="" class="inpAdd">
                    <option value="" disabled selected>Seleccione un Maestro</option>
                    <!-- Mostrar Maestros en el Create -->
                    <?php while ($dataCreate = $result->fetch(\PDO::FETCH_ASSOC)): ?>
                            <option value="<?php echo $dataCreate['id']; ?>"><?php echo $dataCreate['name'] . ' ' . $dataCreate['surname']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mt-4 d-flex justify-content-end" >
                <button class="btn btn-secondary me-3" id="close" type="button" >Close</button>
                <button class="btn btn-primary me-3" name="create" type="submit">Crear</button>
            </div>
        </form>
    </div>

<!-- Edit -->
    <div class="edit" id="edit" >
        <h2 class="ms-4 mt-4 mb-4" >Editar Clase</h2>
        <form action="../index.php?controller=MateriasController&action=editMateria" method="post">
            <div class="formuCre">
                <input type="hidden" name="id" value="<?php echo $materia['id']; ?>">

                <label class="d-inline" for=""><h6>Nombre de la materia</h6></label>
                <input class="inpAdd mb-4" type="text" name="materiasEdit" >

                <label class="d-inline"  for=""><h6>Maestro asignado</h6></label>
                <select name="maestro_id" id="" class="inpAdd">
                    <option value="" disabled selected>Seleccione un Maestro</option>
                    <!-- Mostrar Maestros en el Edit -->
                        <?php while ($dataEdit = $resultEdit->fetch(\PDO::FETCH_ASSOC)): ?>
                            <option value="<?php echo $dataEdit['id']; ?>" data-id="<?php echo $dataEdit['id']; ?>">
                                <?php echo $dataEdit['name'] . ' ' . $dataEdit['surname']; ?>
                            </option>
                        <?php endwhile; ?>
                </select>
            </div>
            <div class="mt-4 d-flex justify-content-end" >
                <button type="button" class="btn btn-secondary me-3" id="close">Close</button>
                <button type="submit" class="btn btn-primary me-3"  >Guardar Cambios</button>
            </div>
        </form>
    </div>

<script src="../Scripts/toggle.js" ></script>

</body>

</html>


