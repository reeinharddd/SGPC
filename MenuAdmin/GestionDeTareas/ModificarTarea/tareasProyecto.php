<!-- tareasProyecto.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGPC - Tareas del Proyecto</title>
    <link rel="stylesheet" href="../../../css/main.css">
    <link rel="icon" href="../../../img/Logo1.png" type="image/png">
</head>

<body>
    <?php
    session_start();

    if (!isset($_SESSION['admin_name']) && !isset($_SESSION['arqui_name'])) {
        header('location:../../Alertas/warning.html');
        exit();
    }

    include("../../../conexion.php");
    $conexion = new conexion();

    if ($conexion->connect()) {
        $idProyecto = isset($_GET['idProyecto']) ? $_GET['idProyecto'] : null;

        if ($idProyecto !== null) {
            $queryTareas = "SELECT T.idTarea, T.titulo, T.descripcion, T.estado, PT.fechaInicio, PT.fechaFinal
                            FROM Tarea T
                            INNER JOIN ProyectoTarea PT ON T.idTarea = PT.idTarea
                            WHERE PT.idProyecto = $idProyecto";
            $resultTareas = $conexion->exeqSelect($queryTareas);

            if ($resultTareas->num_rows > 0) {
                echo "<h2>Todas las Tareas del Proyecto:</h2>";
                echo "<table border='1'>";
                echo "<tr><th>Título</th><th>Descripción</th><th>Estado</th><th>Fecha de Inicio</th><th>Fecha de Finalización</th><th>Acciones</th></tr>";
                while ($rowTarea = mysqli_fetch_array($resultTareas)) {
                    $idTarea = $rowTarea['idTarea'];
                    $tituloTarea = $rowTarea['titulo'];
                    $descripcionTarea = $rowTarea['descripcion'];
                    $estadoTarea = $rowTarea['estado'];
                    $fechaInicio = $rowTarea['fechaInicio'];
                    $fechaFinal = $rowTarea['fechaFinal'];

                    echo "<tr>";
                    echo "<td>$tituloTarea</td><td>$descripcionTarea</td><td>$estadoTarea</td><td>$fechaInicio</td><td>$fechaFinal</td>";
                    echo "<td><a href='modificarTarea.php?idTarea=$idTarea && idProyecto=$idProyecto'>Modificar</a></td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No hay tareas disponibles para este proyecto.</p>";
            }
        } else {
            echo "<p>Proyecto no seleccionado.</p>";
        }

        $conexion->close();
    } else {
        echo "<p>Error en la conexión a la base de datos.</p>";
    }
    ?>
</body>

</html>