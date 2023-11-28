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
    <link rel="stylesheet" href="../../css/proyectos.css" />
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
            $queryProyectos = "SELECT * FROM Proyecto";
            $resultProyectos = $conexion->exeqSelect($queryProyectos);

            if ($resultProyectos->num_rows > 0) {
                echo "<h2>Proyectos Activos</h2>";
                echo "<ul>";
                while ($rowProyecto = mysqli_fetch_array($resultProyectos)) {
                    $idProyecto = $rowProyecto['idProyecto'];
                    $nombreProyecto = $rowProyecto['nombre'];

                    echo "<li><a href='seleccionarUsuario.php?idProyecto=$idProyecto'>$nombreProyecto</a></li>";
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
    </main>
</body>

</html>