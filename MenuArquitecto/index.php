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
    <title>SGPC</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="icon" href="../img/Logo1.png" type = "image/png">
  </head>

  <header class="header">
    <div class="logo">
        <img src="../img/Logo1.png" alt="Logo de la empresa">
    </div>
    <div class="user-info">
        <h3>Página Principal</h3>
    </div>
    <div class="user-info">
        <img src="../img/account-icon-user-icon-vector-graphics_292645-552.avif" alt="Nombre del usuario">
        <h3><?php echo $_SESSION['arqui_name']; ?> <p>Arquitecto</p>
        </h3>

    </div>
</header>

  <body>
    <section>
      <aside class="menu">
        <ul>
          <li><a href="AsignacionTareas/indexAsignacion.php">Asignar tareas</a></li>
          <li><a href="AsignacionEmpleados/indexAsignacionE.php">Asignar empleados</a></li>
          <li><a href="GestionDeTareas/indexTareas.php">Registrar tareas</a></li>
          <li><a href="RegistroProyectos/indexProyectos.php">Registrar Proyectos</a></li>
          <li><a href="Historial/index.php">Historial</a></li>
          <li><a href="../InicioSesion/logout.php">Cerrar sesión</a></li>
        </ul>
      </aside>
    </section>
    <link rel="icon" href="../img/Logo1.png" type = "image/png">
    
    <div class = "hero"></div>
  </body>
</html>
