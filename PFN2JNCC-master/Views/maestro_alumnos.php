<?php

namespace Views;

session_start();
if (!isset($_SESSION['userData'])) {
    header('location: ../Views/login.php');
}

use Models\Database;

require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/Database.php';

$database = new Database();
$conn = $database->getConn();

$query = "SELECT usuarios.id, usuarios.name, usuarios.surname, usuarios.rol_id FROM usuarios WHERE usuarios.rol_id = 3";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Style Sheet CSS-->
    <link rel="stylesheet" href="../assets/alumnosStyles.css">

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

    <title>Alumnos</title>
</head>

<body style="background-color: whitesmoke;">

    <!-- Principal Nav -->
    <nav class="nave">
        <div class="divMenu">
            <a href="" class="menuA">
                <span class="material-symbols-outlined menu">menu</span>
                <h5 class="ms-5 home">Home</h5>
            </a>
        </div>
        <div class="divMenu">
            <button href="" class="dropA" id="dropA">
                <h5 class="admiDrop">Maestro</h5>
                <span class="material-symbols-outlined drop">arrow_drop_down</span>
            </button>
            <!-- menu toggle -->
            <form action="../index.php?controller=AuthController&action=logout" method="post" id="logoutForm">
                <ul class="menuToggle" id="menuToggle">

                    <li class="ms-3 mt-2 mb-4 litg">
                        <a class="optionsTg" href="./maestro_dashboard.php" style="color: black;">Perfil
                            <span class="material-symbols-outlined iconsTg">person</span>
                        </a>
                    </li>
                    <button style="background-color: white; border: none" id="btnLogout">
                        <li class="ms-3 litg">
                            <a class="optionsTg" href="" style="color: red;">Logout
                                <span class="material-symbols-outlined iconsTg">logout</span>
                            </a>
                        </li>
                    </button>

                </ul>
            </form>
        </div>
    </nav>

    <!-- Inside -->
    <div class="inside">
        <h4>Alumnos Asignados</h4>
        <div class="insideTwoContainer">
            <div class="insideTwo">
                <a href="./maestro_dashboard.php" class="hoDa">Home </a>
                <p class="pDa"> / Alumnos</p>
            </div>
        </div>
    </div>

    <div class="ms-3 allTable">
        <div class="d-flex divOp">
            <p class="ms-2 mb-0">Alumnos Asignados</p>

        </div>
        <div class="d-flex ms-3 me-3 mt-2 bar">
            <div class="divVar" style="background-color:gray">
                <a class="ms-2 opVa" href="">Copy</a>
                <a class="opVa" href="">Excel</a>
                <a class="opVa" href="">PDF</a>
                <a class="opVa" href="">Colum visibiliry <span class="material-symbols-outlined dropVa" style="color:white">arrow_drop_down</span></a>
            </div>
            <div>
                <label for="" class="search">Search</label>
                <input type="text" class="inSearch">
            </div>

        </div>
        <table id="miTabla" class="ms-3 me-4 mt-3 tableP">
            <thead>
                <tr class="fileHead">
                    <th class="ps-3 id">#</th>
                    <th class="ps-3 clase">Nombre de Alumno</th>
                    <th class="ps-3 maestros">Calificación</th>
                    <th class="ps-3 alumnos">Mensajes</th>
                    <th class="ps-3 acciones">Acciones</th>
                </tr>
            </thead>
            <tbody class="bodyTable">
                <?php foreach ($result as $usuario) : ?>
                    <tr class="fileBody">
                        <td class="ps-3 idP"><?php echo $usuario['id']; ?></td>
                        <td class="ps-3 claseP"><?php echo $usuario['name'] . ' ' . $usuario['surname']; ?></td>
                        <td class="ps-3 maestrosP">Sin Asignar</td>
                        <td class="ps-3 alumnosP">
                            <p class="mb-0 ps-2" style="background-color: cornflowerblue; color: white; border-radius: 6px; width: 65%; ">Sin mensajes</p>
                        </td>
                        <td class="ps-5 pt-2 accionesP">
                            <button id="editBo" style="border: none; background-color:white"><span class="material-symbols-outlined ps-2 pe-2" style="color:#007bff">playlist_add</span></button>
                            <span class="material-symbols-outlined" style="color:#007bff">send</span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>


    <!-- Footer -->
    <footer class="ftr">
        <p class="ms-3 mb-0">Copyright 2014-2021. All rights reserve</p>
        <p class="mb-0 me-3">Created by ChissgaN</p>
    </footer>


    <!-- Sidebar -->
    <div class="sidebar">
        <div class="d-flex align-top logoDiv">
            <img src="../assets/logoS.JPEG" alt="University logo" class="d-inline-block logo">
            <p class="d-inline-block align-middle uni">Universidad</p>
        </div>
        <div class=" mt-3   admin">
            <h5 class="ms-3 mb-2 textAdmin">Maestro</h5>
            <p class="ms-3 mb-2 textAdmin">maestro</p>
        </div>
        <ul class="mt-4 options"> MENU ADMINISTRACIÓN
            <li class="mt-4">
                <a class="optionsA" href="./maestro_alumnos.php">Alumnos
                    <span class="material-symbols-outlined icons">school</span>
                </a>
            </li>
            <li class="mt-4">
                <a class="optionsA" href="./maestros_clases.php">Clases
                    <span class="material-symbols-outlined icons">jamboard_kiosk</span>
                </a>
            </li>
        </ul>
    </div>

    <script src="../Scripts/togglemaestro.js"></script>

</body>

</html>