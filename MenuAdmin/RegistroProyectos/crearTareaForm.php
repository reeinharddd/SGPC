<?php
session_start();

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
    <header class="header">
        <?php if (isset($_SESSION['admin_name']) && $current_page !== 'index.php') : ?>
        <div class="back-link">
            <a href="javascript:history.go(-1);">
                <img src="../plantillas/left-arrow.svg" alt="Flecha de regreso">
            </a>
        </div>
        <?php endif; ?>

        <div class="logo">
            <img src="../../img/Logo1.png" alt="Logo de la empresa">
        </div>

        <div class="user-info">
            <img src="../../img/account-icon-user-icon-vector-graphics_292645-552.avif" alt="Nombre del usuario">
            <h3><?php echo $_SESSION['admin_name']; ?>
                <p>Administrador</p>
            </h3>
        </div>




    </header>
    <aside class="menu">
        <ul>
            <li <?php if ($current_page == 'index.php') echo 'class="current-page"'; ?>><a
                    href="../index.php">Inicio</a>
            </li>
            <li><a href="Calendario/Calendario.php">Calendario</a></li>

            <li class="active-tasks">
                <span class="menu-item">
                    Proyectos Activos
                    <img src="../plantillas/down-arrow.svg" alt="Flecha hacia abajo" alt="Flecha hacia abajo">
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
                    <img src="../plantillas/down-arrow.svg" alt="Flecha hacia abajo">
                </span>
                <ul class="task-list">
                    <li><a href="indexProyectos.php">Registro completo de proyectos</a></li>
                    <li><a href="agregarProyecto.php">Agregar un Proyecto</a></li>
                    <li><a href="../modis/Proyectos.php">Modificar un Proye/cto</a></li>
                    <li><a href="../modis/select.php">Agregar una Tarea a un Proyecto</a></li>
                    <li><a href="../modis/proye.php">Asignar un Usuario a un Proyecto</a></li>
                </ul>
            </li>

            <li class="active-tasks">
                <span class="menu-item">
                    Registro de Usuarios
                    <img src="../plantillas/down-arrow.svg" alt="Flecha hacia abajo">
                </span>
                <ul class="task-list">
                    <li><a href="../RegistroUsuarios/register_form.php">Registrar Usuarios</a></li>
                    <li><a href="../RegistroUsuarios/mostrarUsuario.php">Modificar la informacion de un usuario</a></li>
                </ul>
            </li>
            <li><a href="../proyectosTerminados.php">Proyectos Terminados</a></li>
            <li><a href="Historial/index.html">Historial</a></li>
            <li><a href="../../InicioSesion/logout.php">Cerrar sesion</a></li>
        </ul>
    </aside>
    <main class="main-section">
        <?php
    if (isset($_GET['idUsuario']) && isset($_GET['idProyecto'])) {
        $idUsuario = $_GET['idUsuario'];
        $idProyecto = $_GET['idProyecto'];

        echo "<h2 class='create-task-title'>Crear Tarea para Usuario</h2>";
        echo "<form method='post' action='crearTareaProcesar.php' class='task-form'>";
        echo "<label>Título: <input type='text' name='titulo' required></label><br>";
        echo "<label>Descripción: <input type='text' name='descripcion' required></label><br>";
        echo "<label>Fecha de Inicio: <input type='date' name='fechaInicio' id='fechaInicio' required></label><br>";
        echo "<label>Fecha de Finalización: <input type='date' name='fechaFinal' id='fechaFinal' required></label><br>";
        echo "<input type='hidden' name='idUsuario' value='$idUsuario'>";
        echo "<input type='hidden' name='idProyecto' value='$idProyecto'>";
        echo "<input type='submit' value='Crear Tarea'>";
        echo "</form>";

        echo "<script>
            document.querySelector('.task-form').addEventListener('submit', function (event) {
                const fechaInicio = new Date(document.getElementById('fechaInicio').value);
                const fechaFinal = new Date(document.getElementById('fechaFinal').value);
                const fechaActual = new Date();

                if (fechaInicio < fechaActual) {
                    alert('La fecha de inicio no puede ser anterior al día actual.');
                    event.preventDefault();
                } else if (fechaInicio < new Date('$fechaInicio')) {
                    alert('La fecha de inicio no puede ser anterior a la fecha de inicio del proyecto.');
                    event.preventDefault();
                } else if (fechaFinal < fechaInicio) {
                    alert('La fecha de finalización no puede ser anterior a la fecha de inicio.');
                    event.preventDefault();
                } else if (fechaFinal > new Date('$fechaFinal')) {
                    alert('La fecha de finalización no puede ser posterior a la fecha de finalización del proyecto.');
                    event.preventDefault();
                }
            });
        </script>";
    } else {
        echo "<p class='error-message'>ID del usuario o del proyecto no proporcionado.</p>";
    }
    ?>
    </main>

</body>

</html>