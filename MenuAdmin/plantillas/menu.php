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
            <li <?php $current_page = basename($_SERVER['PHP_SELF']);
            if ($current_page == 'index.php') echo 'class="current-page"'; ?>><a href="../base/index.php">Inicio</a>
            </li>
            <li><a href="../Calendario/Calendario.php">Calendario</a></li>

         



            <li class="active-tasks">
                <span class="menu-item">
                    Gestion de Proyectos
                    <img src="../plantillas/down-arrow.svg" alt="Flecha hacia abajo">
                </span>
                <ul class="task-list">
                    <li><a href="../RegistroProyectos/indexProyectos.php">Registro completo de proyectos</a></li>
                    <li><a href="../RegistroProyectos/agregarProyecto.php">Agregar un Proyecto</a></li>
                    <li><a href="../modis/Proyectos.php">Modificar un Proyecto</a></li>
                    <li><a href="../modis/select.php">Agregar una Tarea a un Proyecto</a></li>
                    <li><a href="../modis/proye.php">Asignar un Usuario a un Proyecto</a></li>
                </ul>
            </li>
            <li class="active-tasks">
                <span class="menu-item">
                    Gestion de Tareas
                    <img src="../plantillas/down-arrow.svg" alt="Flecha hacia abajo">
                </span>
                <ul class="task-list">
                    <li><a href="../AsignacionTareas/select.php">Asignar Tarea a un usuario</a></li>
                    <li><a href="../ModificarTarea/menuProyectos.php">Modificar Tarea</a></li>
                </ul>
            </li>

            <li class=" active-tasks">
                <span class="menu-item">
                    Registro de Usuarios
                    <img src="../plantillas/down-arrow.svg" alt="Flecha hacia abajo">
                </span>
                <ul class="task-list">
                    <li><a href="../RegistroUsuarios/register_form.php">Registrar Usuarios</a></li>
                    <li><a href="../RegistroUsuarios/mostrarUsuario.php">Modificar la informacion de un
                            usuario</a></li>
                </ul>
            </li>
            <li><a href="../base/proyectosTerminados.php">Proyectos Terminados</a></li>
            <li><a href="../Historial/index.php">Historial</a></li>
            <li><a href="../../InicioSesion/logout.php">Cerrar sesion</a></li>
        </ul>
    </aside>
</body>

</html>