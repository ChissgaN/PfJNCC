<?php

namespace Views;

session_start();
if (!isset($_SESSION['userData'])) {
    header('location: ../Views/login.php');
}

use Models\Database;
use Models\Usuarios;

require_once $_SERVER['DOCUMENT_ROOT'] . '/Vendor/autoload.php';

$database = new Database();
$conn = $database->getConn();

$query = "SELECT * FROM materias";
$result = $conn->query($query);

$qr = "SELECT * FROM roles";
$rs = $conn->query($qr);

$usuario = new Usuarios;
$data = $usuario->all();

/* Edit  */

$queryEdit = "SELECT * FROM materias";
$resultEdit  = $conn->query($query);

$qrEdit = "SELECT * FROM roles";
$rsEdit = $conn->query($qr);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Style Sheet CSS-->
    <link rel="stylesheet" href="../assets/adminmaestrosStyles.css">

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


    <title>Admin Maestros</title>
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
        <h4>Lista de Maestros</h4>
        <div class="insideTwoContainer">
            <div class="insideTwo">
                <a href="./admin_dashboard.php" class="hoDa">Home </a>
                <p class="pDa"> / Maestros</p>
            </div>
        </div>
    </div>

    <div class="ms-3 allTable">
        <div class="d-flex divOp">
            <p class="ms-2 mb-0">Información de Maestros</p>
            <button class="me-2  mb-0 btn btn-primary addClass" id="addTeacher">Agregar Maestro</button>
        </div>
        <div class="d-flex ms-3 me-3 mt-2 mb-3 bar">
            <div class="divVar" style="background-color:gray">
                <a class="ms-2 opVa" href="">Copy</a>
                <a class="opVa" href="">Excel</a>
                <a class="opVa" href="">PDF</a>
                <a class="opVa" href="">Colum visibiliry <span class="material-symbols-outlined dropVa" style="color:white">arrow_drop_down</span></a>
            </div>
            <form action="../index.php?controller=AuthController&action=find" method="post">
                <label for="" class="search">Search</label>
                <input type="text" class="inSearch">
            </form>
        </div>

        <div>
            <table id="miTabla" class="ms-3 me-4 mt-3 tableP">
                <thead>
                    <tr class="fileHead">
                        <th class="ps-3 id">#</th>
                        <th class="ps-3 clase">Nombre</th>
                        <th class="ps-3 maestros">Email</th>
                        <th class="ps-3 alumnos">Dirección</th>
                        <th class="ps-3 date">Fec. de Nacimiento</th>
                        <th class="ps-3 asigna">Clase Asignada</th>
                        <th class="ps-3 acciones">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bodyTable">
                    <?php foreach ($data as $usuario) : ?>
                        <tr class="fileBody">
                            <td class="ps-3 idP"><?php echo $usuario['id']; ?></td>
                            <td class="ps-3 claseP"><?php echo $usuario['name'] . ' ' . $usuario['surname']; ?></td>
                            <td class="ps-3 maestrosP"><?php echo $usuario['email']; ?></td>
                            <td class="ps-3 alumnosP"><?php echo $usuario['address']; ?></td>
                            <td class="ps-3 dateP"><?php echo $usuario['date']; ?></td>
                            <td class="ps-3 asignaP"><?php echo $usuario['materia']; ?></td>
                            <td class="d-flex ps-4 pt-2 accionesP">
                                <!-- Edit Teacher -->
                                <button class="editTeacherButton" data-userid="<?php echo $usuario['id']; ?>" data-username="<?php echo $usuario['name']; ?>" data-usersurname="<?php echo $usuario['surname']; ?>" data-useremail="<?php echo $usuario['email']; ?>" data-useraddress="<?php echo $usuario['address']; ?>" data-userdate="<?php echo $usuario['date']; ?>" data-userrolid="<?php echo $usuario['rol_id']; ?>" data-usermateriasid="<?php echo $usuario['materias_id']; ?>" style="border: none; background-color:white">
                                    <span class="material-symbols-outlined" style="color:#007bff">edit_square</span>
                                </button>
                                <!-- Delete Teacher -->
                                <form action="../index.php?controller=AuthController&action=delete" method="post">
                                    <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
                                    <button type="submit" class="d-flex ms-2 deleteTeacherButton" style="border: none; color: red; background-color:white;">
                                        <span class="material-symbols-outlined">delete</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
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
                    <a class="optionsA" href="../Views/admin_maestros.php">Maestros
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
    <div class="create" id="createTe">
            <h3 class="ms-3 mt-3 mb-2">Agregar Maestro</h3>
            <form action="../index.php?controller=AuthController&action=store" method="post">
                <div class="formuCre">
                    <label class="d-inline" for="">
                        <h6>Nombre(s)</h6>
                    </label>
                    <input class="inpAdd mb-2" type="text" name="name">

                    <label class="d-inline" for="">
                        <h6>Apellidos(S)</h6>
                    </label>
                    <input class="inpAdd mb-2" type="text" name="surname">

                    <label class="d-inline" for="">
                        <h6></h6>Correo
                    </label>
                    <input class="inpAdd mb-2" type="email" name="email">

                    <label class="d-inline" for="">
                        <h6></h6>Contraseña
                    </label>
                    <input class="inpAdd mb-2" type="password" name="password">

                    <label class="d-inline" for="">
                        <h6>Dirección</h6>
                    </label>
                    <input class="inpAdd mb-2" type="text" name="address">

                    <label class="d-inline" for="">
                        <h6>Fecha de Nacimiento</h6>
                    </label>
                    <input class="inpAdd mb-2" type="date" name="date">

                    <select class="mt-3" name="rol" id="rolSelc" style="color: black;">
                        <option value="" disabled selected>Seleccione un Rol</option>
                        <!-- Mostrar roles en el Register -->
                        <?php while ($ro = $rs->fetch(\PDO::FETCH_ASSOC)) : ?>
                            <option value="<?php echo $ro['id']; ?>"><?php echo $ro['rol']; ?></option>
                        <?php endwhile; ?>
                    </select>

                    <!--<label for=""><h6>Clase Asignada</h6></label>-->
                    <select id="classAsignada" name="materias">
                        <option disabled selected value="">Seleccione una Clase</option>
                        <!-- Mostrar materias en el Crear -->
                        <?php while ($row = $result->fetch(\PDO::FETCH_ASSOC)) : ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['materia']; ?></option>
                        <?php endwhile; ?>
                    </select>


                </div>
                <div class="mt-2 d-flex justify-content-end">
                    <button type="button" class="btn btn-secondary me-3" id="close">Close</button>
                    <button type="submit" class="btn btn-primary me-3" id="submitButton">Crear</button>
                </div>
            </form>
    </div>

    <!-- Edit -->
    <div class="edit" id="editTe">
            <h4 class="ms-3 mt-3 mb-3">Editar Maestro</h4>
            <form action="../index.php?controller=AuthController&action=edit" method="post">
                <div class="formuCre">
                    <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">

                    <label class="d-inline" for="">
                        <h6>Nombre(s)</h6>
                    </label>
                    <input class="inpAdd mb-2" type="text" name="name" value="<?php echo $usuario['name']; ?>">


                    <label class="d-inline" for="">
                        <h6>Apellidos(S)</h6>
                    </label>
                    <input class="inpAdd mb-2" type="text" name="surname">

                    <label class="d-inline" for="">
                        <h6></h6>Correo
                    </label>
                    <input class="inpAdd mb-2" type="email" name="email">

                    <label class="d-inline" for="">
                        <h6></h6>Contraseña
                    </label>
                    <input class="inpAdd mb-2" type="password" name="password" placeholder="*****">

                    <label class="d-inline" for="">
                        <h6>Dirección</h6>
                    </label>
                    <input class="inpAdd mb-2" type="text" name="address">

                    <label class="d-inline" for="">
                        <h6>Fecha de Nacimiento</h6>
                    </label>
                    <input class="inpAdd mb-2" type="date" name="date">

                    <!-- Roles Edit -->
                    <select class="mt-3" name="rolEdit" id="rolSelcEdit" style="color: black;">
                        <option value="" disabled selected>Seleccione un Rol</option>
                        <!-- Mostrar roles en el Edit -->
                        <?php while ($roEdit = $rsEdit->fetch(\PDO::FETCH_ASSOC)) : ?>
                            <option value="<?php echo $roEdit['id']; ?>"><?php echo $roEdit['rol']; ?></option>
                        <?php endwhile; ?>
                    </select>


                    <!-- Materias Edit -->
                    <select id="classEdit" name="materiasEdit">
                        <option disabled selected value="">Seleccione una Clase</option>
                        <!-- Mostrar materias en el Edit -->
                        <?php while ($rowEdit = $resultEdit->fetch(\PDO::FETCH_ASSOC)) : ?>
                            <option value="<?php echo $rowEdit['id']; ?>"><?php echo $rowEdit['materia']; ?></option>
                        <?php endwhile; ?>
                    </select>

                </div>
                <div class="mt-2 d-flex justify-content-end">
                    <button class="btn btn-secondary me-3" type="button" >Close</button>
                    <button class="btn btn-primary me-3" type="submit">Edit</button>
                </div>
            </form>
    </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

    <script src="../Scripts/toggleTeacher.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</body>

</html>


