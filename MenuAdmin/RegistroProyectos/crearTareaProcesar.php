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
    if (
        $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idUsuario']) && isset($_POST['idProyecto']) &&
        isset($_POST['titulo']) && isset($_POST['descripcion']) && isset($_POST['fechaInicio']) && isset($_POST['fechaFinal'])
    ) {

        $idUsuario = $_POST['idUsuario'];
        $idProyecto = $_POST['idProyecto'];
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $fechaInicio = $_POST['fechaInicio'];
        $fechaFinal = $_POST['fechaFinal'];

        include("../../conexion.php");
        $conexion = new conexion();

        if ($conexion->connect()) {
            $queryInsertarTarea = "INSERT INTO Tarea (titulo, descripcion, estado, idProyecto) 
                           VALUES ('$titulo', '$descripcion', 'ACT', $idProyecto)";
            $idTarea = $conexion->exeqInsert($queryInsertarTarea);

            if (!$idTarea) {
                echo "Error al insertar tarea: " . mysqli_error($conexion->getConexion());
            }

            $queryAsignarUsuario = "INSERT INTO UsuarioTarea (idUsuario, idTarea) 
                            VALUES ($idUsuario, $idTarea)";
            $conexion->exeqInsert($queryAsignarUsuario);

            $queryProyectoTarea = "INSERT INTO ProyectoTarea (idProyecto, idTarea, fechaInicio, fechaFinal) 
                           VALUES ($idProyecto, $idTarea, '$fechaInicio', '$fechaFinal')";
            $conexion->exeqInsert($queryProyectoTarea);

            $queryNombreTarea = "SELECT titulo FROM Tarea WHERE idTarea = $idTarea";
            $resultNombreTarea = $conexion->exeqSelect($queryNombreTarea);
            $nombreTarea = mysqli_fetch_assoc($resultNombreTarea)['titulo'];

            $queryNombreProyecto = "SELECT nombre FROM Proyecto WHERE idProyecto = $idProyecto";
            $resultNombreProyecto = $conexion->exeqSelect($queryNombreProyecto);
            $nombreProyecto = mysqli_fetch_assoc($resultNombreProyecto)['nombre'];

            $queryNombreUsuario = "SELECT nombre FROM Usuario WHERE idUsuario = $idUsuario";
            $resultNombreUsuario = $conexion->exeqSelect($queryNombreUsuario);
            $nombreUsuario = mysqli_fetch_assoc($resultNombreUsuario)['nombre'];

            echo "<h1>Detalles de la Tarea</h1>";
            echo "<p>Nombre de la Tarea: $nombreTarea</p>";
            echo "<p>Proyecto: $nombreProyecto</p>";
            echo "<p>Usuario: $nombreUsuario</p>";
            echo "<p>Título: $titulo</p>";
            echo "<p>Descripción: $descripcion</p>";
            echo "<p>Fecha de Inicio: $fechaInicio</p>";
            echo "<p>Fecha de Finalización: $fechaFinal</p>";

            echo "<a href='../index.php'>Terminar</a>";
            echo "<a href='crearTareaForm.php?idUsuario=$idUsuario&idProyecto=$idProyecto'>Asignar Otra Tarea</a>";
            echo "<a href='asignarTareas.php?idProyecto=$idProyecto'>Elegir Otro Usuario</a>";

            exit();
        } else {
            echo "Error en la conexión a la base de datos.";
        }
    } else {
        echo "Datos incorrectos o no proporcionados.";
    }
    ?>
    </main>

</body>

</html>