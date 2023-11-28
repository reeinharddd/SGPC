<?php

@include 'config.php';

session_start();
$current_page = basename($_SERVER['PHP_SELF']);
if (!isset($_SESSION['admin_name'])) {
    header('location:../../Alertas/warning.html');
}
?>

<!DOCTYPE html>
<html lang="en">

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

        include '../../conexion.php';
        $conexion = new conexion();

        if ($conexion->connect()) {
            $queryUsuarios = "SELECT * FROM Usuario";
            $resultUsuarios = $conexion->exeqSelect($queryUsuarios);

            if ($resultUsuarios) {
                echo "<h2>Lista de Usuarios</h2>";
                echo "<ul>";
                while ($rowUsuario = mysqli_fetch_array($resultUsuarios)) {
                    $idUsuario = $rowUsuario['idUsuario'];
                    $nombreUsuario = $rowUsuario['nombre'];
                    $apellidoPaterno = $rowUsuario['apellidoPat'];
                    $apellidoMaterno = $rowUsuario['apellidoMat'];

                    echo "<li><a href='editarUsuario.php?idUsuario=$idUsuario'>$nombreUsuario $apellidoPaterno
                    $apellidoMaterno</a></li>";
                }
                echo "</ul>";
            } else {
                echo "Error en la consulta: " . mysqli_error($conexion->getConexion());
            }

            $conexion->close();
        } else {
            echo "Error en la conexión a la base de datos.";
        }
        ?>
    </main>
</body>

</html>