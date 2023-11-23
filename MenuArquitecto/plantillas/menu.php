<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGPC</title>
    <link rel="stylesheet" href="../../css/proyectos.css">
    <link rel="icon" href="../img/Logo1.png" type="image/png">
</head>

<body>
    <aside class="menu">
        <ul>
            <li <?php if ($current_page == 'index.php') echo 'class="current-page"'; ?>><a href="../index.php">Inicio</a>
            </li>
            <li><a href="Calendario/Calendario.php">Calendario</a></li>

            <li class="active-tasks">
                <span class="menu-item">
                    Proyectos Activos
                    <img src="plantillas/down-arrow.svg" alt="Flecha hacia abajo" alt="Flecha hacia abajo">
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



            <li class="active-tasks">
                <span class="menu-item">
                    Gestion de Proyectos
                    <img src="plantillas/down-arrow.svg" alt="Flecha hacia abajo">
                </span>
                <ul class="task-list">
                    <li><a href="RegistroProyectos/indexProyectos.php">Registro completo de proyectos</a></li>
                    <li><a href="RegistroProyectos/agregarProyecto.php">Agregar un Proyecto</a></li>
                    <li><a href="modis/select.php">Agregar una Tarea a un Proyecto</a></li>
                    <li><a href="modis/proye.php">Asignar un Usuario a un Proyecto</a></li>
                    <li><a href="modis/seleccionarUsuario.php">Agregar una tarea a un Usuario</a></li>
                </ul>
            </li>

            
            <li><a href="proyectosTerminados.php">Proyectos Terminados</a></li>
            <li><a href="Historial/index.html">Historial</a></li>
            <li><a href="../InicioSesion/logout.php">Cerrar sesion</a></li>
        </ul>
    </aside>
</body>

</html>