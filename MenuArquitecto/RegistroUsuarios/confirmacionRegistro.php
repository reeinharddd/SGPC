<?php

@include '../../conexion.php';

session_start();

if (!isset($_SESSION['admin_name'])) {
   header('location:../index.html');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    session_start();

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
    <button><a href="../index.php">Regresar al menu principal</a></button>

</html>