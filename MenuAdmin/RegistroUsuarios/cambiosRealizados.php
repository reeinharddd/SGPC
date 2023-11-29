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

        <h2>Cambios realizados correctamente</h2>
        <p>Los cambios en la información del usuario se guardaron correctamente.</p>

        <button><a href='mostrarUsuario.php'>Cambiar información de otro usuario</a></button>
        <button><a href='../index.php'>Ir al índice</a></button>
    </main>

</body>


</html>