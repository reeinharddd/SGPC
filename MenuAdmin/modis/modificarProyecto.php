<?php

@include 'config.php';

session_start();
$current_page = basename($_SERVER['PHP_SELF']);
if (!isset($_SESSION['admin_name'])) {
    header('location:../../Alertas/warning.html');
    
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
        session_start();

        if (!isset($_SESSION['admin_name']) && !isset($_SESSION['arqui_name'])) {
            header('location:../../Alertas/warning.html');
        }

        include("../../conexion.php");
        $conexion = new conexion();

        if ($conexion->connect()) {
            if (isset($_GET['idProyecto'])) {
                $idProyecto = $_GET['idProyecto'];

                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['ubicacion']) && isset($_POST['fechaFinal']) && isset($_POST['estado'])) {
                    $nombre = $_POST['nombre'];
                    $descripcion = $_POST['descripcion'];
                    $ubicacion = $_POST['ubicacion'];
                    $fechaFinal = $_POST['fechaFinal'];
                    $estado = $_POST['estado'];

                    $queryFechaInicio = "SELECT fechaInicio FROM Proyecto WHERE idProyecto = $idProyecto";
                    $resultFechaInicio = $conexion->exeqSelect($queryFechaInicio);

                    if ($resultFechaInicio->num_rows > 0) {
                        $rowFechaInicio = $resultFechaInicio->fetch_assoc();
                        $fechaInicioProyecto = $rowFechaInicio['fechaInicio'];

                        if (strtotime($fechaFinal) < strtotime($fechaInicioProyecto)) {
                            echo "<p style='color: red;'>Error: La fecha de finalización no puede ser menor que la fecha de inicio.</p>";
                        } else {
                            $queryActualizarProyecto = "UPDATE Proyecto 
                                                    SET nombre='$nombre', descripcion='$descripcion', ubicacion='$ubicacion', fechaInicio='$fechaInicioProyecto', fechaFinal='$fechaFinal', estado='$estado'
                                                    WHERE idProyecto=$idProyecto";
                            $resultado = $conexion->exeqUpdate($queryActualizarProyecto);

                            if ($resultado) {
                                echo "<p>Proyecto actualizado exitosamente.</p>";
                            } else {
                                echo "<p>Error al actualizar el proyecto: " . mysqli_error($conexion->getConexion()) . "</p>";
                            }
                        }
                    }
                }

                $queryProyecto = "SELECT * FROM Proyecto WHERE idProyecto = $idProyecto";
                $resultProyecto = $conexion->exeqSelect($queryProyecto);

                if ($resultProyecto->num_rows > 0) {
                    $rowProyecto = $resultProyecto->fetch_assoc();
                    $nombreProyecto = $rowProyecto['nombre'];
                    $descripcionProyecto = $rowProyecto['descripcion'];
                    $ubicacionProyecto = $rowProyecto['ubicacion'];
                    $fechaInicioProyecto = $rowProyecto['fechaInicio'];
                    $fechaFinalProyecto = $rowProyecto['fechaFinal'];
                    $estadoProyecto = $rowProyecto['estado'];

                    echo "<h2>Modificar Proyecto</h2>";
                    echo "<form method='post'>";
                    echo "<label>Nombre del Proyecto: <input type='text' name='nombre' value='$nombreProyecto' required></label><br>";
                    echo "<label>Descripción del Proyecto: <input type='text' name='descripcion' value='$descripcionProyecto' required></label><br>";
                    echo "<label>Ubicación del Proyecto: <input type='text' name='ubicacion' value='$ubicacionProyecto' required></label><br>";

                    $fechaInicioFormateada = date("d/m/Y", strtotime($fechaInicioProyecto));
                    echo "<label>Fecha de Inicio: $fechaInicioFormateada</label>";
                    echo "<input type='hidden' name='fechaInicio' value='$fechaInicioProyecto'><br>";

                    echo "<label>Fecha de Finalización: <input type='date' name='fechaFinal' value='$fechaFinalProyecto' required></label><br>";

                    echo "<p style='color: red;'>Nota: La fecha de inicio no puede ser modificada.</p>";

                    echo "<label>Estado del Proyecto: ";
                    echo "<select name='estado'>";
                    $queryEstados = "SELECT codigo, nombre FROM Estado";
                    $resultEstados = $conexion->exeqSelect($queryEstados);
                    while ($rowEstado = mysqli_fetch_array($resultEstados)) {
                        $codigoEstado = $rowEstado['codigo'];
                        $nombreEstado = $rowEstado['nombre'];
                        $selected = ($codigoEstado == $estadoProyecto) ? "selected" : "";
                        echo "<option value='$codigoEstado' $selected>$nombreEstado</option>";
                    }
                    echo "</select></label><br>";

                    echo "<input type='submit' value='Guardar Cambios'>";
                    echo "</form>";
                } else {
                    echo "<p>No se encontró el proyecto.</p>";
                }
            } else {
                echo "<p>ID del proyecto no proporcionado.</p>";
            }

            $conexion->close();
        } else {
            echo "<p>Error en la conexión a la base de datos.</p>";
        }
        ?>
    </main>
</body>

</html>