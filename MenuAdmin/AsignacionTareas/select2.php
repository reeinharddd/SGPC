 <?php
    session_start();

    if (!isset($_SESSION['admin_name'])) {
        header('location:../../Alertas/warning.html');
        exit();
    }
     $current_page = basename($_SERVER['PHP_SELF']);
        
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGPC - Proyectos</title>
    <link rel="stylesheet" href="../../css/proyectos.css">
    <link rel="icon" href="../../img/Logo1.png" type="image/png">
</head>

<body>
   <?php

    include("../../conexion.php");
    include "../plantillas/header.php";
    include "../plantillas/menu.php";
    ?>
    <main>
        <?php
    $conexion = new conexion();

    if ($conexion->connect()) {
        $idProyecto = isset($_GET['idProyecto']) ? $_GET['idProyecto'] : null;

        if ($idProyecto !== null) {
            $queryUsuariosProyecto = "SELECT u.* FROM Usuario u
                INNER JOIN UsuarioProyecto up ON u.idUsuario = up.idUsuario
                WHERE up.idProyecto = $idProyecto";

            $resultUsuariosProyecto = $conexion->exeqSelect($queryUsuariosProyecto);

            if ($resultUsuariosProyecto->num_rows > 0) {
                echo "<h2>Usuarios en el Proyecto</h2>";
                 echo "<h3>Seleccione al usuario al que desea asignarle una tarea</h3>";
                
                echo "<ul>";
                while ($rowUsuario = mysqli_fetch_array($resultUsuariosProyecto)) {
                    $idUsuario = $rowUsuario['idUsuario'];
                    $nombreCompleto = $rowUsuario['nombre'] . ' ' . $rowUsuario['apellidoPat'] . ' ' . $rowUsuario['apellidoMat'];
                
                    echo "<li><a href='agregarTarea.php?idProyecto=$idProyecto&idUsuario=$idUsuario'>$nombreCompleto</a></li>";
                }
                echo "</ul>";
            } else {
                echo "<p>No hay usuarios asignados al proyecto.</p>";
            }
        } else {
            echo "<p>Proyecto no seleccionado.</p>";
        }

        $conexion->close();
    } else {
        echo "<p>Error en la conexión a la base de datos.</p>";
    }
    ?>
    </main>
</body>

</html>