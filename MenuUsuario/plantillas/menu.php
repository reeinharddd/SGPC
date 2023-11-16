<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGPC</title>
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="icon" href="../img/Logo1.png" type="image/png">


</head>

<body>
    <aside class="menu">

        <ul>
            <li <?php if ($current_page == 'index.php') echo 'class="current-page"'; ?>><a href="index.php">Inicio</a>
            </li>
            <li><a href="Calendario/Calendario.php">Calendario</a></li>
            <li role="separator"></li>

            <li class="active-tasks">
                <span class="menu-item">
                    Proyectos Activos
                    <img src="https://cdn.icon-icons.com/icons2/2248/PNG/512/arrow_down_bold_circle_icon_135936.png"
                        alt="Flecha hacia abajo">
                </span>

                <ul class="task-list">
                    <?php
                    if (isset($proyectos) && is_array($proyectos)) {
                        foreach ($proyectos as $proyecto) {
                            echo "<li><a href='Proyectos.php?idProyecto=" . $proyecto["idProyecto"] . "'>" . $proyecto["nombre"] . "</a></li>";
                        }
                    }
                    ?>
                </ul>
            </li>

            <li role="separator"></li>
            <li><a href="#">Proyectos Terminados</a></li>
            <li><a href="../InicioSesion/logout.php">Cerrar Sesión</a></li>

        </ul>

    </aside>
</body>

</html>