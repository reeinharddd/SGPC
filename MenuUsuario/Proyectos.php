<?php

@include 'config.php';

session_start();

if (!isset($_SESSION['user_name'])) {
    header('location:../Alertas/warning.html');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyectos</title>
    <link rel="stylesheet" href="../css/proyectos.css">
    <link rel="icon" href="../img/Logo1.png" type="image/png">
</head>
<header class="header">
    <div class="user-info">
        <a href="index.php" class="back-link">
            <img src="../img/left-arrow.svg" alt="Regresar">
        </a>
        <img src="../img/account-icon-user-icon-vector-graphics_292645-552.avif" alt="Nombre del usuario">
        <div>
            <h3><?php echo $_SESSION['user_name']; ?></h3>
            <p>Usuario</p>
        </div>
    </div>
    <div class="logo">
        <a href="../img/Logo1.png">
            <img src="../img/Logo1.png" alt="Logo de la empresa">
        </a>
    </div>
    <nav class="navigation">
        <ul>
            <li><a href="#">Proyectos</a></li>
            <li><a href="Calendario/Calendario.php">Calendario</a></li>
            <li><a href="Contacto.php">Contacto</a></li>
            <li><a href="../InicioSesion/logout.php">Cerrar sesión</a></li>
        </ul>
    </nav>
</header>

<section>
    <aside class="menu">
        <ul>
            <li><a href="#">Opción 1</a></li>
            <li><a href="#">Opción 2</a></li>
            <li><a href="#">Opción 3</a></li>
        </ul>
    </aside>

    <body class="cuerpo">

        <?php
        include "../conexion.php";
        $conexion = new conexion();
        if ($conexion->connect()) {
            $con = $conexion->getConexion();
            $proyecto = $_GET['idProyecto'];
            $usuario = $_SESSION['id'];

            $query = "SELECT T.titulo AS NombreTarea, T.descripcion AS DescripcionTarea, T.idTarea As idTarea FROM Proyecto P INNER JOIN UsuarioProyecto UP ON P.idProyecto = UP.idProyecto INNER JOIN UsuarioTarea UT ON UP.idUsuario = UT.idUsuario INNER JOIN Tarea T ON UT.idTarea = T.idTarea WHERE UT.idUsuario = $usuario AND P.idProyecto = $proyecto";

            $result = $conexion->exeqSelect($query);
            if ($result) {

                while ($row = mysqli_fetch_assoc($result)) {

                    echo "<div class='project-box'>";

                    echo "<div class='project-info'>";
                    echo "<h3>Nombre: " . $row["NombreTarea"] . "</h3>";
                    echo "<p>Descripción: " . $row["DescripcionTarea"] . "</p>";
                    echo "</div>";

                    echo "<a href='detalleTarea.php?idTarea=" . $row["idTarea"] . "&idProyecto=" .$proyecto. "' class='details-button'>Ver detalles</a>";

                    echo "</div>";
                }
            }
        }
        ?>
    </body>

</html>