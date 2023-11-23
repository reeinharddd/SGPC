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
    <main>
        <?php
        if (isset($_GET['idProyecto'])) {
            $idProyecto = $_GET['idProyecto'];

            include("../../conexion.php");
            $conexion = new conexion();

            if ($conexion->connect()) {
                $queryProyecto = "SELECT * FROM Proyecto WHERE idProyecto = $idProyecto";
                $resultProyecto = $conexion->exeqSelect($queryProyecto);

                if ($resultProyecto->num_rows > 0) {
                    $rowProyecto = $resultProyecto->fetch_assoc();
                    $nombreProyecto = $rowProyecto['nombre'];

                    $queryUsuariosProyecto = "SELECT u.*
        FROM Usuario u
        INNER JOIN UsuarioProyecto up ON u.idUsuario = up.idUsuario
        WHERE up.idProyecto = $idProyecto";
                    $resultUsuariosProyecto = $conexion->exeqSelect($queryUsuariosProyecto);

                    if ($resultUsuariosProyecto->num_rows > 0) {
                        echo "<h2>Usuarios en el Proyecto: $nombreProyecto</h2>";
                        echo "<h3>seleccione uno</h3>";
                       
                        echo "<ul>";
                        while ($rowUsuario = mysqli_fetch_array($resultUsuariosProyecto)) {
                            $idUsuario = $rowUsuario['idUsuario'];
                            $nombreUsuario = $rowUsuario['nombre'];

                            echo "<li><a href='crearTareaForm.php?idUsuario=$idUsuario&idProyecto=$idProyecto'>$nombreUsuario</a></li>";
                        }
                        echo "</ul>";
                    } else {
                        echo "No hay usuarios asignados al proyecto.";
                    }
                } else {
                    echo "No se encontró el proyecto.";
                }

                $conexion->close();
            } else {
                echo "Error en la conexión a la base de datos.";
            }
        } else {
            echo "ID del proyecto no proporcionado.";
        }
        ?>
    </main>
</body>

</html>