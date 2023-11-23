<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGPC - Proyectos</title>
    <link rel="stylesheet" href="../../../css/proyectos.css">
    <link rel="icon" href="../../img/Logo1.png" type="image/png">
</head>

<body>
<button><a href="../../index.php">Regresar al menu</a></button>
    <?php
    session_start();

    if (!isset($_SESSION['admin_name']) && !isset($_SESSION['arqui_name'])) {
        header('location:../../../Alertas/warning.html');
        exit();
    }

    include("../../../conexion.php");
    $conexion = new conexion();

    if ($conexion->connect()) {
        $queryProyectos = "SELECT DISTINCT idProyecto FROM UsuarioProyecto"; // Usar DISTINCT para evitar duplicados
        $resultProyectos = $conexion->exeqSelect($queryProyectos);

        if ($resultProyectos->num_rows > 0) {
            echo "<h2>Proyectos Activos</h2>";
            echo "<ul>";
            while ($rowProyecto = mysqli_fetch_array($resultProyectos)) {
                $idProyecto = $rowProyecto['idProyecto'];

                // Obtener el nombre del proyecto usando el idProyecto
                $queryNombreProyecto = "SELECT nombre FROM Proyecto WHERE idProyecto = $idProyecto";
                $resultNombreProyecto = $conexion->exeqSelect($queryNombreProyecto);

                if ($resultNombreProyecto->num_rows > 0) {
                    $nombreProyecto = mysqli_fetch_assoc($resultNombreProyecto)['nombre'];
                    echo "<li><a href='select2.php?idProyecto=$idProyecto'>$nombreProyecto</a></li>";
                } else {
                    echo "<li><a href='#'>Proyecto Desconocido</a></li>";
                }
            }
            echo "</ul>";
        } else {
            echo "<p>No hay proyectos activos.</p>";
        }

        $conexion->close();
    } else {
        echo "<p>Error en la conexión a la base de datos.</p>";
    }
    ?>
</body>

</html>