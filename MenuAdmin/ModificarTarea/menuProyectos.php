<!-- menuProyectos.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGPC - Menú de Proyectos</title>
    <link rel="stylesheet" href="../../css/Proyec.css">
    <link rel="icon" href="../../img/Logo1.png" type="image/png">
</head>
<?php
include "../../InicioSesion/login.php";
include "../plantillas/header.php";
include "../plantillas/menu.php";
?>
<body>
    <main>
    <?php
    if (!isset($_SESSION['admin_name']) && !isset($_SESSION['arqui_name'])) {
        header('location:../../Alertas/warning.html');
        exit();
    }

    $conexion = new conexion();

    if ($conexion->connect()) {
       $queryProyectos = "SELECT * FROM Proyecto WHERE estado NOT IN ('FIN', 'CAN')";
        $resultProyectos = $conexion->exeqSelect($queryProyectos);

        if ($resultProyectos->num_rows > 0) {
            echo "<h2>Seleccione un Proyecto:</h2>";
    echo "<div class='project-list-container'>";
            while ($rowProyecto = mysqli_fetch_array($resultProyectos)) {
                $idProyecto = $rowProyecto['idProyecto'];
                $nombreProyecto = $rowProyecto['nombre'];

               
        echo "<div class='project-item'>";
        echo "<a href='tareasProyecto.php?idProyecto=$idProyecto'>";
        echo "<h3>$nombreProyecto</h3>";
        echo "</a>";
        echo "</div>";
            }
    echo "</div>";
        } else {
            echo "<p>No hay proyectos disponibles.</p>";
        }

        $conexion->close();
    } else {
        echo "<p>Error en la conexión a la base de datos.</p>";
    }
    ?>
    </main>
</body>

</html>