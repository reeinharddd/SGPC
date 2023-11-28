<!-- modificarTarea.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGPC - Modificar Tarea</title>
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
        $idTarea = isset($_GET['idTarea']) ? $_GET['idTarea'] : null;
        $idProyecto = isset($_GET['idProyecto']) ? $_GET['idProyecto'] : null;

        if ($idTarea !== null) {
            // Obtener los detalles de la tarea y del proyectoTarea
            $queryDetallesTarea = "SELECT T.*, PT.fechaInicio, PT.fechaFinal
                                   FROM Tarea T
                                   INNER JOIN ProyectoTarea PT ON T.idTarea = PT.idTarea
                                   WHERE T.idTarea = $idTarea";
            $resultDetallesTarea = $conexion->exeqSelect($queryDetallesTarea);

            if ($resultDetallesTarea->num_rows > 0) {
                $rowTarea = mysqli_fetch_array($resultDetallesTarea);
                $tituloTarea = $rowTarea['titulo'];
                $descripcionTarea = $rowTarea['descripcion'];
                $estadoTarea = $rowTarea['estado'];
                $fechaInicio = $rowTarea['fechaInicio'];
                $fechaFinal = $rowTarea['fechaFinal'];
                // Añadir más campos según la estructura de tu base de datos

                // Aquí puedes mostrar un formulario con los detalles actuales de la tarea
                echo "<h2>Modificar Tarea: $tituloTarea</h2>";
                echo "<form id='modificarTareaForm' method='post' action='procesarModificacionTarea.php'>";
                echo "<label>Título: <input type='text' name='titulo' value='$tituloTarea'></label><br>";
                echo "<label>Descripción: <input type='text' name='descripcion' value='$descripcionTarea'></label><br>";
                echo "<select name='estado'>";
                    
                    include ('../../conexion.php');
                    $conexion = new conexion();
                    if ($conexion->connect()) {
                        $con = $conexion->getConexion();

                        $query = "SELECT * FROM Estado";
                        $resultado = $conexion->exeqSelect($query);
                        var_dump($resultado);

                        if ($resultado) {
                            while ($row = mysqli_fetch_array($resultado)) {
                                echo "<option value='" . $row['codigo'] . "'>" . $row['nombre'] . "</option>";
                            }
                        } else {
                            echo "Error en la consulta: " . mysqli_error($con);
                        }
                    } else {
                        echo "Error en la conexión: " . mysqli_error($con);
                    }
                    
                echo "</select>";
                echo "<br><label>Fecha de Inicio: <input type='date' name='fechaInicio' value='$fechaInicio'></label><br>";
                echo "<label>Fecha de Finalización: <input type='date' name='fechaFinal' value='$fechaFinal'></label><br>";
                // Añadir más campos según la estructura de tu base de datos
                echo "<input type='hidden' name='idProyecto' value='$idProyecto'>";

                echo "<input type='hidden' name='idTarea' value='$idTarea'>";
                echo "<input type='submit' value='Guardar Cambios'>";
                echo "</form>";
            } else {
                echo "<p>No se encontraron detalles de la tarea.</p>";
            }
        } else {
            echo "<p>Tarea no seleccionada.</p>";
        }

        $conexion->close();
    } else {
        echo "<p>Error en la conexión a la base de datos.</p>";
    }
    ?>
</body>

</html>