<?php
session_start();
$current_page = $_SERVER['PHP_SELF'];
if (!isset($_SESSION['admin_name']) && !isset($_SESSION['arqui_name'])) {
    header('location:../../Alertas/warning.html');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/proyectos.css" />

</head>

<body>
    <?PHP
include "../plantillas/header.php";
include "../plantillas/menu.php";
?>
    <main>
        <?php
        if (isset($_GET['idProyecto'])) {
            $idProyecto = $_GET['idProyecto'];

            include("../../conexion.php");
            $conexion = new conexion();

            if ($conexion->connect()) {
                $queryProyecto = "SELECT * FROM Proyecto WHERE idProyecto = $idProyecto";
                $resultProyecto = $conexion->exeqSelect($queryProyecto);

                if ($resultProyecto->num_rows > 0) {
                    $rowProyecto = $resultProyecto->fetch_assoc();
                    $nombreProyecto = $rowProyecto['nombre'];

                    $queryUsuariosProyecto = "SELECT u.*
        FROM Usuario u
        INNER JOIN UsuarioProyecto up ON u.idUsuario = up.idUsuario
        WHERE up.idProyecto = $idProyecto";
                    $resultUsuariosProyecto = $conexion->exeqSelect($queryUsuariosProyecto);

                    if ($resultUsuariosProyecto->num_rows > 0) {
                        echo "<h2>Usuarios en el Proyecto: $nombreProyecto</h2>";
                        echo "<h3>seleccione uno</h3>";
                       
                        echo "<ul>";
                        while ($rowUsuario = mysqli_fetch_array($resultUsuariosProyecto)) {
                            $idUsuario = $rowUsuario['idUsuario'];
                            $nombreUsuario = $rowUsuario['nombre'];

                            echo "<li><a href='crearTareaForm.php?idUsuario=$idUsuario&idProyecto=$idProyecto'>$nombreUsuario</a></li>";
                        }
                        echo "</ul>";
                    } else {
                        echo "No hay usuarios asignados al proyecto.";
                    }
                } else {
                    echo "No se encontró el proyecto.";
                }

                $conexion->close();
            } else {
                echo "Error en la conexión a la base de datos.";
            }
        } else {
            echo "ID del proyecto no proporcionado.";
        }
        ?>
    </main>
</body>

</html>