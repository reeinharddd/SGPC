<?php

@include 'config.php';

session_start();

if (!isset($_SESSION['user_name'])) {
   header('location:../Alertas/warning.html');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="icon" href="../img/Logo1.png" type = "image/png">
    <title>Proyectos completados</title>
</head>
<body class = "cuerpo">
    <a href="index.php">Regresar al menú</a>
    <br>
    En esta parte se visualizaran todos los proyectos que ya han sido completados.
</body>
</html>