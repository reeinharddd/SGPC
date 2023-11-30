  <?php
  ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    session_start();

    if (!isset($_SESSION['admin_name']) ) {
        header('location:../../Alertas/warning.html');
        exit();
    }
    $current_page = $_SERVER['PHP_SELF'];


include("../../conexion.php");
$conexion = new conexion();

$mensaje_actualizacion = ""; 
if ($conexion->connect()) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idTarea']) && isset($_POST['titulo']) && isset($_POST['descripcion']) && isset($_POST['estado']) && isset($_POST['fechaInicio']) && isset($_POST['fechaFinal'])) {
        $idTarea = $_POST['idTarea'];
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $estado = $_POST['estado'];
        $fechaInicio = $_POST['fechaInicio'];
        $fechaFinal = $_POST['fechaFinal'];

        // Actualizar la tarea
        $queryActualizarTarea = "UPDATE Tarea 
                                 SET titulo = '$titulo', descripcion = '$descripcion', estado = '$estado'
                                 WHERE idTarea = $idTarea";
        $resultActualizarTarea = $conexion->exeqUpdate($queryActualizarTarea);

        // Actualizar ProyectoTarea
        $queryActualizarProyectoTarea = "UPDATE ProyectoTarea 
                                         SET fechaInicio = '$fechaInicio', fechaFinal = '$fechaFinal'
                                         WHERE idTarea = $idTarea";
        $resultActualizarProyectoTarea = $conexion->exeqUpdate($queryActualizarProyectoTarea);

        if ($resultActualizarTarea !== false && $resultActualizarProyectoTarea !== false) {
            if ($resultActualizarTarea > 0 || $resultActualizarProyectoTarea > 0) {
                $mensaje_actualizacion = "Actualización exitosa de la tarea.";
            } else {
                $mensaje_actualizacion = "Ningún cambio realizado en la tarea.";
            }
        } else {
            $mensaje_actualizacion = "Error en la actualización de la tarea: " . $conexion->getLastError();
        }


        $conexion->close();
    } else {
 //echo "Error en la conexión a la base de datos: " . $conexion->getLastError();    
 }
}


    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGPC - Modificar Tarea</title>
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="icon" href="../../img/Logo1.png" type="image/png">
</head>

<body>
  <?php
    include "../plantillas/header.php";
    include "../plantillas/menu.php";
    ?>
    <main> <?php
      if ($mensaje_actualizacion !== "") {
                echo '<p>' . $mensaje_actualizacion . '</p>';
            }  

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
                echo "<form id='modificarTareaForm' method='post' action=''>";
                echo "<label>Título: <input type='text' name='titulo' value='$tituloTarea'></label><br>";
                echo "<label>Descripción: <input type='text' name='descripcion' value='$descripcionTarea'></label><br>";
                echo "<select name='estado'>";
                 
                    $conexion = new conexion();
                    if ($conexion->connect()) {
                        $con = $conexion->getConexion();

                        $query = "SELECT * FROM Estado";
                        $resultado = $conexion->exeqSelect($query);

                        if ($resultado) {
                             while ($row = mysqli_fetch_array($resultado)) {
            $codigoEstado = $row['codigo'];
            $nombreEstado = $row['nombre'];

            // Verificar si es el estado actual y seleccionarlo
            $selected = ($estadoTarea == $codigoEstado) ? "selected" : "";

            echo "<option value='$codigoEstado' $selected>$nombreEstado</option>";
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
    </main>
</body>

</html>