<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>SGPC</title>
    <link rel="stylesheet" href="../../css/plantillas.css">
    <link rel="icon" href="../../img/bricks.svg" type="image/svg+xml">
   

</head>

<body>
    <aside class="menu">

        <ul>
            <li <?php if ($current_page == 'index.php') echo 'class="current-page"'; ?>><a href="../app/index.php">Inicio</a>
            </li>
            <li><a href="../Calendario/Calendario.php">Calendario</a></li>
            <li role="separator"></li>

            <li class="active-tasks">
                <span class="menu-item">
                    Proyectos Activos
                    <img src="../plantillas/down-arrow.svg" alt="Flecha hacia abajo">
                </span>

                <ul class="task-list">
                    <?php
                    if (isset($proyectos) && is_array($proyectos)) {
                        foreach ($proyectos as $proyecto) {
                            echo "<li><a href='../app/Proyectos.php?idProyecto=" . $proyecto["idProyecto"] . "'>" . $proyecto["nombre"] . "</a></li>";
                        }
                    }
                    ?>
                </ul>
            </li>

            <li role="separator"></li>
            <li><a href="../app/proyectosTerminados.php">Proyectos Terminados</a></li>
            <li><a href="../../InicioSesion/logout.php">Cerrar Sesión</a></li>

        </ul>

    </aside>
</body>

</html>