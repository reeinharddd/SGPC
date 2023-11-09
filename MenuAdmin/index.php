<?php

@include 'config.php';

session_start();

if (!isset($_SESSION['admin_name'])) {
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
    <div class="usuario">
    <?php
    if (isset($_SESSION['admin_name'])) {
      echo "<h1>Bienvenido administrador:" . $_SESSION['admin_name'] . "</h1>";
    }else{
      header('location:../Alertas/warning.html');
    }
    
    ?>
    </div>

    <header class = "header">
      <div><img src="../img/Logo1.png" alt="" width="100px" height="100px"></div>
      
      <label for="toggle"> <img src="../img/menu.svg" alt="menu"></label>
      <nav class = "navigation">
        <ul>
            <li><a href="ComCol.php">Comentarios y colaboración</a></li>
            <li><a href="#">Opciones</a>
                <ul>
                    <li><a href="RegistroProyectos/indexProyectos.php">Gestión de proyectos</a></li>
                    <li><a href="GestionDeTareas/indexTareas.php">Gestión de Tareas</a></li>
                    <li><a href="RegistroUsuarios/register_form.php">Registrar Usuarios</a></li>
                    <li><a href="indexMNTREG.php">Mantenimiento de registros</a></li>
                </ul>
            </li>
            <li><a href="../InicioSesion/logout.php">Cerrar sesion</a></li>
        </ul>
      </nav>
    </header>
    <div class = "hero"></div>
  </body>
</html>
