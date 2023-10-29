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
    <title>Vista Arquitecto</title>
  </head>
  <body>
    <?php
    if (isset($_SESSION['arqui_name'])) {
      echo "<h1>Bienvenido Arquitecto:" . $_SESSION['arqui_name'] . "</h1>";
    }else{
      header('location:../Alertas/warning.html');
    }
    
    ?>
    <header>
      <a href="../InicioSesion/logout.php">Cerrar sesion</a>
    </header>
    <div><h1>Bienvenido arquitecto!</h1></div>
    <a href="GestionDeTareas/indexTareas.php">Asignar tareas</a>
  </body>
</html>
