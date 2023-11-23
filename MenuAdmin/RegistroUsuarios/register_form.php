<?php

@include '../../conexion.php';

session_start();

if (!isset($_SESSION['admin_name'])) {
    header('location:../../Alertas/warning.html');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestión de Proyectos</title>
    <link rel="stylesheet" href="../../css/proyectos.css" />
    <link rel="icon" href="../../img/Logo1.png" type="image/png">
    <script>
        function formatPhoneNumber(input) {
            var phoneNumber = input.value.replace(/\D/g, '');

            var formattedPhoneNumber = phoneNumber.replace(/(\d{3})(\d{3})(\d{4})/, '$1-$2-$3');

            input.value = formattedPhoneNumber;
        }
    </script>

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
                    <li><a href="../RegistroProyectos/indexProyectos.php">Registro completo de proyectos</a></li>
                    <li><a href="../RegistroProyectos/agregarProyecto.php">Agregar un Proyecto</a></li>
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
        <div class="form-container">

            <form action="addUser.php" method="POST" id="form">
                <h2>Nuevo usuario</h2><br>

                <input id="nombre" type="text" name="name" required pattern="[A-Za-z\s']{2,50}" placeholder="Nombre"><br>
                <input id="apPat" type="text" name="apPat" required pattern="[A-Za-z\s']{2,50}" placeholder="Apellido paterno"><br>
                <input id="apMat" type="text" name="apMat" required pattern="[A-Za-z\s']{2,50}" placeholder="Apellido materno"><br>
                <input id="numero" type="text" name="numero" maxlength="10" required pattern="\d{3}-\d{3}-\d{4}" placeholder="Teléfono" oninput="formatPhoneNumber(this)"><br>
                <input id="email" type="email" name="email" required pattern="[a-z0-9._%+-]+@SGPC\.mx$" placeholder="Correo electrónico"><br>
                <select name="user_type"><br>
                    <option value="1">Administrador</option>
                    <option value="2">Arquitecto</option>
                    <option value="3">Empleado</option>
                </select><br>
                <input type="submit" name="submit" value="Registrar" class="form-btn" form="form">
            </form>
        </div>

    </main>

</body>

</html>