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
  

    <header class = "header">
      
      <div><img src="../img/Logo1.png" alt="" width="100px" height="100px"></div>
    
      <nav class = "navigation">
      <?php
    if (isset($_SESSION['user_name'])) {
      echo "<h1>Bienvenido usuario:" . $_SESSION['user_name'] . "</h1>";
    }else{
      header('location:../Alertas/warning.html');
    }
    
    ?>
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
    <section>
      <div class="welcome-and-projects">
      
      </div>
      <div class="project-list">
      <?php
      include "../conexion.php";

      $conexion = new conexion();
      if ($conexion->connect()){
        $con = $conexion->getConexion();
      $sql = "SELECT 
Proyectos.numProyecto,
      Proyectos.Nombre,
      Proyectos.Descripcion,
      Proyectos.Ubicacion,
      Proyectos.fechaInicio,
      Proyectos.fechaFinal,
      Proyectos.Estado
  FROM 
      Proyectos
  JOIN 
      USUARIO_PROYECTO
  ON 
      Proyectos.numProyecto = USUARIO_PROYECTO.Proyecto
  WHERE 
      USUARIO_PROYECTO.Usuario = '".$_SESSION['id']."'";

      $result = $conexion->exeqSelect($sql);

        if ($result) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='project-box'>";
            echo "<div class='project-info'>";
            echo "<h3>Nombre: " . $row["Nombre"] . "</h3>";
            echo "<p>Descripción: " . $row["Descripcion"] . "</p>";
            echo "<p>Ubicación: " . $row['Ubicacion'] . "</p>";
            echo "<p>Fecha Inicio: " . $row['fechaInicio'] . "</p>";
            echo "<p>Fecha Final: " . $row['fechaFinal'] . "</p>";
            echo "<p>Estado: " . $row['Estado'] . "</p>";
            echo "</div>";
            echo "<a href='Proyectos.php?data-numProyecto=" . $row["numProyecto"] . "' class='details-button'>Ver detalles</a>";
            echo "</div>";
        }
        echo "</div>";
    } else {
        echo "No se encontraron proyectos.";
    }
      }
      ?>
      </div>
    </section>
    <div class = "hero"></div>
  </body>
</html>
