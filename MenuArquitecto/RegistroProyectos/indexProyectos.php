<?php

@include 'config.php';

session_start();
$current_page = basename($_SERVER['PHP_SELF']);
if (!isset($_SESSION['arqui_name'])) {
    header('location:../../Alertas/warning.html');
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestión de Proyectos</title>
    <link rel="stylesheet" href="../../css/proyectos.css" />
    <link rel="icon" href="../../img/Logo1.png" type="image/png">
</head>


<body>
    <?php
    include ('../plantillas/header.php');
    include('../plantillas/menu.php');
    ?>
    <main>
    <aside class="menu">
        <ul>
            <li <?php if ($current_page == 'index.php') echo 'class="current-page"'; ?>><a href="../index.php">Inicio</a>
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
        <h1>Crear Proyecto
        </h1>
        <form id="datos" method="post" action="addProyecto.php" class="colortexto">
            <br>

            <label class="project-name">Nombre del proyecto: * <input type="text" name="txtNombre" required placeholder="max. 100 caracteres"></label>
            <br>
            <label class="project-description">Descripción del proyecto: * <input type="text" name="txtDes" required placeholder="max. 200 caracteres"></label>
            <br>
            <label class="project-location">Ubicación del proyecto: * <input type="text" name="txtUbi" required placeholder="max. 100 caracteres"></label>
            <br>
            <label class="project-date">Fecha de inicio: *<input type="date" name="F-inicio" id="fechaInicio" required></label>
            <br>
            <label class="project-date">Fecha de finalización: *<input type="date" name="F-fin" id="fechaFin" required></label>
            <br>
            <label class="project-state">Estado del proyecto: *
                <select name="estado">
                    <?php
                    include '../../conexion.php';
                    $conexion = new conexion();
                    if ($conexion->connect()) {
                        $con = $conexion->getConexion();

                        $query = "SELECT * FROM Estado";
                        $resultado = $conexion->exeqSelect($query);
                        var_dump($resultado);

                        if ($resultado) {
                            while ($row = mysqli_fetch_array($resultado)) {
                                echo "<option value='" . $row['codigo'] . "'>" . $row['nombre'] . "</option>";
                            }
                        } else {
                            echo "Error en la consulta: " . mysqli_error($con);
                        }
                    } else {
                        echo "Error en la conexión: " . mysqli_error($con);
                    }
                    ?>
                </select>
            </label>
            <br>

            <input type="reset" value="Limpiar" class="details-button">
            <input type="submit" value="Crear" class="details-button">
        </form>
        <script>
            document.getElementById("datos").addEventListener("submit", function(event) {
                const fechaInicio = new Date(document.getElementById("fechaInicio").value +
                    "T00:00:00");
                const fechaFin = new Date(document.getElementById("fechaFin").value +
                    "T00:00:00");
                const fechaActual = new Date();

                if (fechaInicio <= fechaActual) {
                    alert("La fecha de inicio debe ser posterior al día actual.");
                    event.preventDefault();
                } else if (fechaFin < fechaInicio) {
                    alert("La fecha de fin debe ser posterior o igual a la fecha de inicio.");
                    event.preventDefault();
                }
            });
        </script>

    </main>
    </main>
</body>

</html>