<?php

namespace Views;

session_start();
if (!isset($_SESSION['userData'])) {
    header('location: ../Views/login.php');
}

use Models\Database;


require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/Database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/Permisos.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Controllers/PermisosController.php';

$database = new Database();
$conn = $database->getConn();

$query = "SELECT * FROM roles";
$result = $conn->query($query);

$permisosController = new \PermisosController();
$usuarios = $permisosController->all();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Style Sheet CSS-->
    <link rel="stylesheet" href="../assets/adminpermisosStyles.css">

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

    <title>Admin Permisos</title>
</head>

<body style="background-color: whitesmoke;" id="body">

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
                <h5 class="admiDrop">Administrador</h5>
                <span class="material-symbols-outlined drop">arrow_drop_down</span>
            </button>
            <!-- menu toggle -->
            <form action="../index.php?controller=AuthController&action=logout" method="post" id="logoutForm">
                <ul class="menuToggle" id="menuToggle">

                    <li class="ms-3 mt-2 mb-4 litg">
                        <a class="optionsTg" href="./admin_dashboard.php" style="color: black;">Perfil
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
        <h4>Lista de Permisos</h4>
        <div class="insideTwoContainer">
            <div class="insideTwo">
                <a href="./admin_dashboard.php" class="hoDa">Home </a>
                <p class="pDa"> / Permisos</p>
            </div>
        </div>
    </div>

    <div class="ms-3 allTable">
        <div class="d-flex divOp">
            <p class="ms-2 mb-0">Información de Permisos</p>

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
                <input type="seach" class="inSearch">
            </div>

        </div>
        <table id="miTabla" class=" ms-3 me-4 mt-3 tableP">
            <thead>
                <tr class="fileHead">
                    <th class="ps-3 id">#</th>
                    <th class="ps-3 clase">Email/Usuario</th>
                    <th class="ps-3 maestros">Permiso</th>
                    <th class="ps-3 alumnos">Estado</th>
                    <th class="ps-3 acciones">Acciones</th>
                </tr>
            </thead>
            <tbody class="bodyTable">
                <?php foreach ($usuarios as $usuario) : ?>
                    <tr class="fileBody" data-estado="<?php echo $usuario['nombre_estado']; ?>">
                        <td class="ps-3 idP"><?php echo $usuario['id']; ?></td>
                        <td class="ps-3 claseP"><?php echo $usuario['email']; ?></td>
                        <td class="ps-3 maestrosP"><?php echo $usuario['nombre_rol']; ?></td>
                        <td class="ps-3 alumnosP"><?php echo $usuario['nombre_estado']; ?></td>
                        <td class="ps-5 pt-2 accionesP">
                            <button class="editPermisosButton"
                                    data-id="<?php echo $usuario['id']; ?>"
                                    data-userrol="<?php echo $usuario['rol_id']; ?>"
                                    style="border: none; background-color:white">
                                <span class="material-symbols-outlined ps-2 pe-2" style="color:#007bff">edit_square</span>
                            </button>
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
            <h5 class="ms-3 mb-2 textAdmin">admin</h5>
            <p class="ms-3 mb-2 textAdmin">Administrador</p>
        </div>
        <ul class="mt-4 options"> MENU ADMINISTRACIÓN
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


    <!-- Edit -->
    <div class="edit" id="editPermi">
        <h2 class="ms-4 mt-4 mb-4">Editar Permiso</h2>
        <form action="../index.php?controller=PermisosController&action=editPermiso&id=<?= $usuario['id'] ?>" method="post" id="editPermisosForm">

            <input type="hidden" name="id" id="editUserId">
            <div class="formuCre">
                <label class="d-inline" for="">
                    <h6>Email del Usuario</h6>
                </label>
                <input class="inpAdd mb-4" type="email" name="email" id="editEmail">

                <select class="mt-3 mb-3" name="rol_id" id="rolSelc" style="color: black;">
                    <option value="" disabled selected>Seleccione un Rol</option>
                    <?php while ($row = $result->fetch(\PDO::FETCH_ASSOC)) : ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['rol']; ?></option>
                    <?php endwhile; ?>
                </select>

                <!-- Switch para el estado -->
                <div class="form-check form-switch mt-3">
                    <input class="form-check-input" type="checkbox" id="estadoSwitch" name="status_id" value="1">
                    <label class="form-check-label" for="estadoSwitch">Activo</label>
                    <input type="hidden" name="status_id" value="1">
                </div>
            </div>
            <div class="mt-4 d-flex justify-content-end">
                <button class="btn btn-secondary me-3" id="close" type="button" >Close</button>
                <button class="btn btn-primary me-3" type="submit">Guardar Cambios</button>
            </div>
        </form>
    </div>

    <script src="../Scripts/togglepermisos.js"></script>
</body>

</html>



