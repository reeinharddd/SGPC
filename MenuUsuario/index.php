<?php
session_start();

if (!isset($_SESSION['user_name'])) {
    header('location:../Alertas/warning.html');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGPC</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="icon" href="../img/Logo1.png" type="image/png">
</head>

<body>
    <header class="header">
        <div class="logo">
            <img src="../img/Logo1.png" alt="Logo de la empresa">
        </div>
        <div class="user-info">
            <img src="../img/account-icon-user-icon-vector-graphics_292645-552.avif" alt="Nombre del usuario">
            <h3><?php echo $_SESSION['user_name']; ?> <p>Usuario</p>
            </h3>

        </div>
        <button class="about-button">¿Qué es esta aplicación?</button>



    </header>
    <section>
        <aside class="menu">
            <ul>
                <div class="head-menu">
                    <li><a href="#">Página Principal</a></li>
                    <li><a href="Calendario/Calendario.php">Calendario</a></li>
                </div>
                <li><a href="#">Tareas Activas</a></li>
                <li><a href="#">Tareas Terminadas</a></li>
                <li><a href="../InicioSesion/logout.php">Cerrar Sesión</a></li>
            </ul>
        </aside>
        <main>
            <div class="project-list">
                <?php
                include "../conexion.php";

                $conexion = new conexion();
                if ($conexion->connect()) {
                    $con = $conexion->getConexion();
                    $sql = "SELECT 
                                Proyectos.numProyecto,
                                Proyectos.Nombre,
                                Proyectos.Descripcion,
                                Proyectos.Ubicacion,
                                Proyectos.fechaInicio,
                                Proyectos.fechaFinal,
                                Proyectos.Estado
                            FROM 
                                Proyectos
                            JOIN 
                                USUARIO_PROYECTO
                            ON 
                                Proyectos.numProyecto = USUARIO_PROYECTO.Proyecto
                            WHERE 
                                USUARIO_PROYECTO.Usuario = '" . $_SESSION['id'] . "'";

                    $result = $conexion->exeqSelect($sql);

                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<div class='project-box'>";
                            echo "<div class='project-header'>";
                            echo "<div class='project-number'>" . $row["numProyecto"] . "</div>";
                            echo "<div class='project-name'>" . $row["Nombre"] . "</div>";
                            echo "<div class='project-location'>" . $row['Ubicacion'] . "</div>";
                            echo "</div>";
                            echo "<div class='project-dates'>";
                            echo "<div class='project-date'>" . $row['fechaInicio'] . "</div>";
                            echo "<div class='project-state'>" . $row['Estado'] . "</div>";
                            echo "<div class='project-date'>" . $row['fechaFinal'] . "</div>";
                            echo "</div>";
                            echo "<a href='Proyectos.php?data-numProyecto=" . $row["numProyecto"] . "' class='details-button'>Ver detalles</a>";
                            echo "</div>";
                        }
                        echo "</div>";
                    } else {
                        echo "No se encontraron proyectos.";
                    }
                }
                ?>
            </div>
        </main>
    </section>
    <div class="hero"></div>
</body>

</html>