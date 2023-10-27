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
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="../img/Logo1.png" type = "image/png">
  </head>
  <body>

    <header class = "header">
      <div><img src="../img/Logo1.png" alt="" width="100px" height="100px"></div>
      <input type="checkbox" id = "toggle">
      <label for="toggle"> <img src="../img/menu.svg" alt="menu"></label>
      <nav class = "navigation">
        <ul>
            <li><a href="ComCol.php">Comentarios y colaboración</a></li>
            <li><a href="#">Opciones</a>
                <ul>
                    <li><a href="RegistroProyectos/indexProyectos.php">Gestión de proyectos</a></li>
                    <ul>
                      <li><a href="#">Registrar proyecto</a></li>
                      <li><a href="#">Modificar proyecto</a></li>
                    </ul>
                    <li><a href="indexTareas.html">Gestión de Tareas</a></li>
                    <li><a href="RegistroUsuarios/register_form.php">Registrar Usuarios</a></li>
                    <li><a href="indexMNTREG.php">Mantenimiento de registros</a></li>
                </ul>
            </li>
            <li><a href="#">Contacto</a></li>
            <li><a href="../InicioSesion/logout.php">Cerrar sesion</a></li>
        </ul>
      </nav>
    </header>
    <div class = "hero"></div>
  </body>
</html>
