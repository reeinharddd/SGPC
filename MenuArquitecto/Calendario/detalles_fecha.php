<?php

@include 'config.php';

session_start();

if (!isset($_SESSION['user_name'])) {
   header('location:../../Alertas/warning.html');
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/calendario.css">
    <link rel="stylesheet" href="../../css/main.css">
    <title>Detalles de la Fecha</title>
    </head>
    <body>
        <main>
            <div class="project-list">
                <?php
                include "../../conexion.php";

                $fechaSeleccionada = $_POST['fecha'];
                $conexion = new conexion();
                if ($conexion->connect()) {
                    $con = $conexion->getConexion();
                    $sql = "SELECT P.idProyecto, P.nombre, P.descripcion, P.ubicacion, P.fechaInicio, P.fechaFinal, P.estado 
                        FROM Proyecto P 
                        INNER JOIN UsuarioProyecto UP ON P.idProyecto = UP.idProyecto
                        WHERE P.fechaInicio <= '".$fechaSeleccionada."' AND P.fechaFinal >= '".$fechaSeleccionada."'";

                    $result = $conexion->exeqSelect($sql);
                    if ($result) {

                        while ($row = mysqli_fetch_assoc($result)) {

                            echo "<div class='project-box'>";

                            echo "<div class='project-header'>";
                            echo "<div class='project-number'>" . $row["idProyecto"] . "</div>";
                            echo "<div class='project-name'>" . $row["nombre"] . "</div>";
                            echo "<div class='project-location'>" . $row['ubicacion'] . "</div>";
                            echo "</div>";

                            echo "<div class='project-dates'>";
                            echo "<div class='project-date'>" . $row['fechaInicio'] . "</div>";
                            echo "<div class='project-state'>" . $row['estado'] . "</div>";
                            echo "<div class='project-date'>" . $row['fechaFinal'] . "</div>";
                            echo "</div>";

                            echo "<a href='../Proyectos.php?idProyecto=" . $row["idProyecto"] . "' class='details-button'>Ver detalles</a>";

                            echo "</div>";
                        }

                        echo "</div>";
                    } else {

                        echo "No se encontraron proyectos.";
                    }
                }
                ?>
            </div>
        </main>
    </body>
</html>