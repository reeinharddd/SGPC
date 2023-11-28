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
    <main class="main-section">
        <?php
    include("../../conexion.php");
    $conexion = new conexion();

    if ($conexion->connect()) {
        $idProyecto = $_GET['idProyecto'];
        $queryUsuariosAsignados = "SELECT u.*, t.rol as nombreTipoUsuario 
                           FROM Usuario u
                           INNER JOIN UsuarioProyecto up ON u.idUsuario = up.idUsuario
                           INNER JOIN TipoUsuario t ON u.idTipoUsuario = t.idTu
                           WHERE up.idProyecto = $idProyecto";
        $resultUsuariosAsignados = $conexion->exeqSelect($queryUsuariosAsignados);

        echo "<h1 class='assigned-users-title'>Usuarios Asignados al Proyecto</h1>";

        if ($resultUsuariosAsignados->num_rows > 0) {
            while ($rowUsuarioAsignado = mysqli_fetch_array($resultUsuariosAsignados)) {
                echo "<div class='user-details'>";
                echo "<p>ID: " . $rowUsuarioAsignado['idUsuario'] . "</p>";
                echo "<p>Nombre: " . $rowUsuarioAsignado['nombre'] . "</p>";
                echo "<p>Apellido Paterno: " . $rowUsuarioAsignado['apellidoPat'] . "</p>";
                echo "<p>Apellido Materno: " . $rowUsuarioAsignado['apellidoMat'] . "</p>";
                echo "<p>Teléfono: " . $rowUsuarioAsignado['numTel'] . "</p>";
                echo "<p>Email: " . $rowUsuarioAsignado['email'] . "</p>";
                echo "<p>Tipo Usuario: " . $rowUsuarioAsignado['nombreTipoUsuario'] . "</p>";
                echo "</div>";
                echo "<hr class='user-divider'>";
            }
        } else {
            echo "<p class='no-users-message'>No hay usuarios asignados al proyecto.</p>";
        }

        echo "<a href='../index.php' class='details-button'>Terminar</a>";
        echo "<a href='asignarTareas.php?idProyecto=$idProyecto' class='details-button'>Continuar</a>";

        $conexion->close();
    } else {
        echo "<p class='db-error-message'>Error en la conexión a la base de datos.</p>";
    }
    ?>
    </main>

</body>

</html>