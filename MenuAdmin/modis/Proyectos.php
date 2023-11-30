<?php

@include 'config.php';

session_start();
$current_page = basename($_SERVER['PHP_SELF']);
if (!isset($_SESSION['admin_name'])) {
    header('location:../../Alertas/warning.html');
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestión de Proyectos</title>
    <link rel="stylesheet" href="../../css/Proyec.css" />
    <link rel="icon" href="../../img/Logo1.png" type="image/png">
</head>


<body>
     <?PHP
include "../plantillas/header.php";
include "../plantillas/menu.php";
?>
    <main>
        <?php

    if (!isset($_SESSION['admin_name']) && !isset($_SESSION['arqui_name'])) {
        header('location:../../Alertas/warning.html');
    }

    include("../../conexion.php");
    $conexion = new conexion();

    if ($conexion->connect()) {
        $queryProyectos = "SELECT * FROM Proyecto WHERE estado NOT IN ('FIN', 'CAN')";
        $resultProyectos = $conexion->exeqSelect($queryProyectos);

        if ($resultProyectos->num_rows > 0) {
            echo "<h2>Seleccione un Proyecto Activo</h2>";
             echo "<div class='project-list-container'>";
            while ($rowProyecto = mysqli_fetch_array($resultProyectos)) {
                $idProyecto = $rowProyecto['idProyecto'];
                $nombreProyecto = $rowProyecto['nombre'];

             
        echo "<div class='project-item'>";
        echo "<a href='modificarProyecto.php?idProyecto=$idProyecto'>";
        echo "<h3>$nombreProyecto</h3>";
        echo "</a>";
        echo "</div>";
            }
            echo "</div>";
        } else {
            echo "<p>No hay proyectos activos.</p>";
        }

        $conexion->close();
    } else {
        echo "<p>Error en la conexión a la base de datos.</p>";
    }
    ?>
    </main>
</body>

</html>