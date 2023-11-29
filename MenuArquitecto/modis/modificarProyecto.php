<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGPC - Modificar Proyecto</title>
    <link rel="stylesheet" href="../../css/proyectos.css">
    <link rel="icon" href="../img/Logo1.png" type="image/png">
</head>

<body>
    <?php
    include('../plantillas/header.php');
    include('../plantillas/menu.php');
    ?>
    <main>
    <?php
    session_start();

    if (!isset($_SESSION['admin_name']) && !isset($_SESSION['arqui_name'])) {
        header('location:../../Alertas/warning.html');
    }

    include("../../conexion.php");
    $conexion = new conexion();

    if ($conexion->connect()) {
        if (isset($_GET['idProyecto'])) {
            $idProyecto = $_GET['idProyecto'];

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['ubicacion']) && isset($_POST['fechaInicio']) && isset($_POST['fechaFinal']) && isset($_POST['estado'])) {
                $nombre = $_POST['nombre'];
                $descripcion = $_POST['descripcion'];
                $ubicacion = $_POST['ubicacion'];
                $fechaInicio = $_POST['fechaInicio'];
                $fechaFinal = $_POST['fechaFinal'];
                $estado = $_POST['estado'];

                $queryActualizarProyecto = "UPDATE Proyecto 
                                            SET nombre='$nombre', descripcion='$descripcion', ubicacion='$ubicacion', fechaInicio='$fechaInicio', fechaFinal='$fechaFinal', estado='$estado'
                                            WHERE idProyecto=$idProyecto";
                $resultado = $conexion->exeqUpdate($queryActualizarProyecto);

                if ($resultado) {
                    echo "<p>Proyecto actualizado exitosamente.</p>";
                    
                } else {
                    echo "<p>Error al actualizar el proyecto: " . mysqli_error($conexion->getConexion()) . "</p>";
                }
            }

            $queryProyecto = "SELECT * FROM Proyecto WHERE idProyecto = $idProyecto";
            $resultProyecto = $conexion->exeqSelect($queryProyecto);

            if ($resultProyecto->num_rows > 0) {
                $rowProyecto = $resultProyecto->fetch_assoc();
                $nombreProyecto = $rowProyecto['nombre'];
                $descripcionProyecto = $rowProyecto['descripcion'];
                $ubicacionProyecto = $rowProyecto['ubicacion'];
                $fechaInicioProyecto = $rowProyecto['fechaInicio'];
                $fechaFinalProyecto = $rowProyecto['fechaFinal'];
                $estadoProyecto = $rowProyecto['estado'];

                echo "<a href='Proyectos.php'>Regresar atrás</a>";
                echo "<h2>Modificar Proyecto</h2>";
                echo "<form method='post'>";
                echo "<label>Nombre del Proyecto: <input type='text' name='nombre' value='$nombreProyecto' required></label><br>";
                echo "<label>Descripción del Proyecto: <input type='text' name='descripcion' value='$descripcionProyecto' required></label><br>";
                echo "<label>Ubicación del Proyecto: <input type='text' name='ubicacion' value='$ubicacionProyecto' required></label><br>";
                echo "<label>Fecha de Inicio: <input type='date' name='fechaInicio' value='$fechaInicioProyecto' required></label><br>";
                echo "<label>Fecha de Finalización: <input type='date' name='fechaFinal' value='$fechaFinalProyecto' required></label><br>";
                echo "<select name='estado'>";
                    
                    
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
                echo "<br><input type='submit' value='Guardar Cambios'>";
                
                echo "</form>";
                
            } else {
                echo "<p>No se encontró el proyecto.</p>";
            }
        } else {
            echo "<p>ID del proyecto no proporcionado.</p>";
        }

        $conexion->close();
    } else {
        echo "<p>Error en la conexión a la base de datos.</p>";
    }
    ?>
    </main>
</body>

</html>