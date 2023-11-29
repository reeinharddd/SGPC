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
        include("../../conexion.php");
        $conexion = new conexion();

        if ($conexion->connect()) {
            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['idProyecto'])) {
                $idProyecto = $_GET['idProyecto'];

                $queryProyecto = "SELECT * FROM Proyecto WHERE idProyecto = $idProyecto";
                $resultProyecto = $conexion->exeqSelect($queryProyecto);

                if ($resultProyecto->num_rows > 0) {
                    $rowProyecto = mysqli_fetch_array($resultProyecto);
                    $nombreProyecto = $rowProyecto['nombre'];

                    echo "<h2>Detalles de la Asignación</h2>";
                    echo "<p><strong>Proyecto:</strong> $nombreProyecto</p>";

                    $queryUsuarios = "SELECT Usuario.* FROM Usuario
        INNER JOIN UsuarioProyecto ON Usuario.idUsuario = UsuarioProyecto.idUsuario
        WHERE UsuarioProyecto.idProyecto = $idProyecto";
                    $resultUsuarios = $conexion->exeqSelect($queryUsuarios);

                    if ($resultUsuarios->num_rows > 0) {
                        echo "<p><strong>Usuarios Asignados:</strong></p>";
                        echo "<ul>";
                        while ($rowUsuario = mysqli_fetch_array($resultUsuarios)) {
                            $nombreUsuario = $rowUsuario['nombre'];
                            echo "<li>$nombreUsuario</li>";
                        }
                        echo "</ul>";
                    } else {
                        echo "<p>No hay usuarios asignados en esta operación.</p>";
                    }

                    echo "<a href='../base/index.php'>Volver al Menú Principal</a><br>";
                    echo "<a href='seleccionarUsuario.php?idProyecto=$idProyecto'>Asignar Otros Usuarios</a>";
                } else {
                    echo "<p>No se encontró el proyecto.</p>";
                }
            } else {
                echo "<p>Parámetros incorrectos.</p>";
            }

            $conexion->close();
        } else {
            echo "<p>Error en la conexión a la base de datos.</p>";
        }
        ?>
    </main>
</body>

</html>