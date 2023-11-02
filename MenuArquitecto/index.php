<?php

@include 'config.php';

session_start();

if (!isset($_SESSION['arqui_name'])) {
   header('location:../Alertas/warning.html');
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Vista Arquitecto  </title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="icon" href="../img/Logo1.png" type = "image/png">
  </head>
  <body>
  <div class="usuario">
    <?php
    if (isset($_SESSION['arqui_name'])) {
      echo "<h1>Bienvenido Arquitecto:" . $_SESSION['arqui_name'] . "</h1>";
    }else{
      header('location:../Alertas/warning.html');
    }
    
    ?>
  </div>
    <header>
    
      <button><a href="../InicioSesion/logout.php">Cerrar sesion</a></button>
    </header>
    <div><h1>Bienvenido arquitecto!</h1></div>
    <link rel="icon" href="../img/Logo1.png" type = "image/png">
    <button><a href="GestionDeTareas/indexTareas.php">Asignar tareas</a></button>
    <button><a href="RegistroProyectos/indexProyectos.php">Registrar Proyectos</a></button>
    <div class = "hero"></div>
  </body>
</html>
