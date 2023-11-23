<?php

@include 'config.php';

session_start();
$current_page = basename($_SERVER['PHP_SELF']);
if (!isset($_SESSION['admin_name'])) {
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
    <main>
        <?php include("../../conexion.php");
        $conexion = new conexion();
        if ($conexion->connect()) {
            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['idProyecto'])) {
                $idProyecto = $_GET['idProyecto'];

                $queryUsuarios = "SELECT * FROM Usuario WHERE idUsuario NOT IN
            (SELECT idUsuario FROM UsuarioProyecto WHERE idProyecto = '$idProyecto')";
                $resultUsuarios = $conexion->exeqSelect($queryUsuarios);

                if ($resultUsuarios->num_rows > 0) {
                    echo "<h2>Selecciona Usuarios</h2>";
                    echo "<form method='post' action='asignarUsuario.php' onsubmit='return validarFormulario()'>";
                    while ($rowUsuario = mysqli_fetch_array($resultUsuarios)) {
                        $idUsuario = $rowUsuario['idUsuario'];
                        $nombreUsuario = $rowUsuario['nombre'];

                        echo "<label><input type='checkbox' name='usuarios[]' value='$idUsuario'> $nombreUsuario</label><br>";
                    }
                    echo "<input type='hidden' name='idProyecto' value='$idProyecto'>";
                    echo "<input type='submit' value='Asignar Usuarios'>";
                    echo "</form>";
                } else {
                    echo "<p>No hay usuarios disponibles para asignar.</p>";
                }

                $conexion->close();
            } else {
                echo "<p>Parámetros incorrectos.</p>";
            }
        } else {
            echo "<p>Error en la conexión a la base de datos.</p>";
        }
        ?>
        <script>
            function validarFormulario() {
                var checkboxes = document.getElementsByName('usuarios[]');
                var selected = false;
                for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i].checked) {
                        selected = true;
                        break;
                    }
                }
                if (!selected) {
                    alert("Debes seleccionar al menos un usuario.");
                    return false;
                }
                return true;
            }
        </script>
    </main>
</body>

</html>