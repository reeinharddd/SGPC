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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SGPC</title>
    <link rel="stylesheet" href="../css/main.css" />
    <link rel="icon" href="../img/Logo1.png" type = "image/png">
  </head>
  <body>
    <?php
    if (isset($_SESSION['user_name'])) {
      echo "<h1>Bienvenido usuario:" . $_SESSION['user_name'] . "</h1>";
    }else{
      header('location:../Alertas/warning.html');
    }
    
    ?>

    <header class = "header">
      <div><img src="../img/Logo1.png" alt="" width="100px" height="100px"></div>
      <input type="checkbox" id = "toggle">
      <label for="toggle"> <img src="../img/menu.svg" alt="menu"></label>
      <nav class = "navigation">
        <ul>
            <li><a href="#">Proyectos</a>
              <ul>
                <li><a href="Proyectos.php">Proyectos vigentes</a></li>
                <li><a href="AllProyectos.php">Proyectos completados</a></li>
              </ul>
            </li>
            <li><a href="Calendario/Calendario.php">Calendario</a></li>
            <li><a href="Contacto.php">Contacto</a></li>
            <li><a href="../InicioSesion/logout.php">Cerrar sesion</a></li>
        </ul>
      </nav>
    </header>
    <div class = "hero"></div>
  </body>
</html>
