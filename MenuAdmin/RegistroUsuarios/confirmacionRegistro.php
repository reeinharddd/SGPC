<?php

@include 'config.php';

session_start();
$current_page = basename($_SERVER['PHP_SELF']);
if (!isset($_SESSION['admin_name'])) {
    header('location:../../Alertas/warning.html');
    
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestión de Proyectos</title>
    <link rel="stylesheet" href="../../css/proyectos.css" />
    <link rel="icon" href="../../img/Logo1.png" type="image/png">
</head>


<body>
    <?PHP
include "../plantillas/header.php";
include "../plantillas/menu.php";
?>
    <main>
        <?php


    if (isset($_SESSION['user_data'])) {
        $userData = $_SESSION['user_data'];
    
        echo 'Usuario registrado<br>';
        foreach ($userData as $key => $value) {
            echo $key . ': ' . $value . '<br>';
        }
            unset($_SESSION['user_data']);
    } else {
        echo 'No hay datos de usuario para mostrar';
        header('location:register_form.php');
    }
    
    
    ?>
        <button><a href="register_form.php">Registrar otro usuario</a></button>
        <button><a href="../base/index.php">Regresar al menu principal</a></button>
    </main>
</body>

</html>