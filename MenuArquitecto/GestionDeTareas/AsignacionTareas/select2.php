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
    <?php
    session_start();

    if (!isset($_SESSION['admin_name']) && !isset($_SESSION['arqui_name'])) {
        header('location:../../../Alertas/warning.html');
    }

    include("../../../conexion.php");
    $conexion = new conexion();

    if ($conexion->connect()) {
        $queryProyectos = "SELECT * FROM UsuarioProyecto";
        $resultProyectos = $conexion->exeqSelect($queryProyectos);

        if ($resultProyectos->num_rows > 0) {
            echo "<h2>Número de empleado</h2>";
            echo "<ul>";
            while ($rowProyecto = mysqli_fetch_array($resultProyectos)) {
                $idUsuario = $rowProyecto['idUsuario'];
                

                echo "<li><a href='agregarTarea.php?idProyecto=$idUsuario'>$idUsuario</a></li>";
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