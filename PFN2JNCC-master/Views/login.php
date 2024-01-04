<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Style Sheet CSS-->
    <link rel="stylesheet" href="../assets/loginStyles.css">

    <!-- Boostrap Styles-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Google Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    
    <title>Login</title>
</head>
<body class="d-flex justify-content-center" style="background-color: #fff5d2;" >
    <div class="d-inline" >
        <img src="../assets/logo.jpg" alt="University Logo" class="d-inline logo" >
    
    <form class="for" action="../index.php?controller=AuthController&action=login" method="post" >
        <label class="mb-3" for="">Bienvenido Ingresa con tu cuenta</label>

        <div class="position-relative">
        <input class="inp" type="email" name="email" id="email" placeholder="Email">
        <span class="material-symbols-outlined icons">mail</span>
        </div>

        <div class="position-relative">
        <input class="inp" type="password" name="password" id="password" placeholder="Password">
        <span class="material-symbols-outlined icons">lock</span>
        </div>

        <button type="submit" class="btn btn-primary btn">Ingresar</button>
    </form>
    
    </div>
    
    
</body>
</html>