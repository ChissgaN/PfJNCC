<?php
    session_start();
    if (!isset($_SESSION['userData'])) {
       header('location: ../Views/login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Style Sheet CSS-->
    <link rel="stylesheet" href="../assets/admindashStyles.css">

    <!-- Boostrap Styles-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Google Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <title>Dashboard Admin</title>
</head>
<body style="background-color: whitesmoke;" >

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
                <a class="optionsTg" href="" style="color: black;">Perfil
                    <span class="material-symbols-outlined iconsTg">person</span>
                </a>
            </li>
            <button style="background-color: white; border: none" id="btnLogout" type="submit">
            <li  class="ms-3 litg">
                <p  class="mb-0 optionsTg"  style="color: red;">Logout
                    <span class="material-symbols-outlined iconsTg">logout</span>
                </p>
            </li>
            </button>
            
        </ul>
    </form>
    </div>
    </nav>

<!-- Inside -->
    <div class="inside" >
        <h3>Dashboard</h3>
        <div class="insideTwoContainer">
            <div class="insideTwo" >
                <a href="" class="hoDa">Home </a>
                <p class="pDa" > / Dashboard</p>
            </div>
        </div>
    </div>
    <div class="p-3 rectangle" >
        <h6>Bienvenido</h6>
        <p>Selecciona la acción que quieras realizar en el menu de la izquierda</p>
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

    <script src="../Scripts/toggle.js" ></script>
</body>
</html>



