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
    <script>
    function mostrarAlerta(elemento, maximo) {
        if (elemento.value.length > maximo) {
            alert(`El campo no puede tener más de ${maximo} caracteres.`);
            elemento.value = elemento.value.substring(0, maximo);
        }
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
        

        include("../../conexion.php");
        $conexion = new conexion();

        if ($conexion->connect()) {
            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['idProyecto'])) {
                $idProyecto = $_GET['idProyecto'];

                $queryProyecto = "SELECT * FROM Proyecto WHERE idProyecto = $idProyecto";
                $resultProyecto = $conexion->exeqSelect($queryProyecto);

                if ($resultProyecto->num_rows > 0) {
                    $rowProyecto = mysqli_fetch_array($resultProyecto);
                    $nombreProyecto = $rowProyecto['nombre'];
                } else {
                    echo "<p>Proyecto no encontrado.</p>";
                    exit();
                }
            } else {
                echo "<p>Parámetros incorrectos.</p>";
                exit();
            }
        } else {
            echo "<p>Error en la conexión a la base de datos.</p>";
            exit();
        }
        ?>

        <form id="crearTareaForm" method="post" action="procesarTarea.php" class="colortexto">
            <br>
            <h2>Agregar Tarea al Proyecto: <?php echo $nombreProyecto; ?></h2>
            <label>Título (máximo 40 caracteres): <input type="text" name="titulo" maxlength="40"
                    oninput="mostrarAlerta(this, 40)" required></label><br>
            <label>Descripción (máximo 100 caracteres): <input type="text" name="descripcion" maxlength="100"
                    oninput="mostrarAlerta(this, 100)" required></label><br>

            <?php
            $fechaInicioProyecto = $rowProyecto['fechaInicio'];
            $fechaHoy = date('Y-m-d');
            echo "<label>Fecha de Inicio (debe ser después de $fechaInicioProyecto y $fechaHoy): <input type='date' name='fechaInicio' min='$fechaInicioProyecto' value='$fechaHoy' required></label><br>";
            ?>

            <?php
            $fechaFinProyecto = $rowProyecto['fechaFinal'];
            echo "<label>Fecha de Finalización (debe ser antes de $fechaFinProyecto): <input type='date' name='fechaFinal' max='$fechaFinProyecto' required></label><br>";
            ?>

            <?php
            $queryEstados = "SELECT codigo, nombre FROM Estado";
            $resultEstados = $conexion->exeqSelect($queryEstados);

            if ($resultEstados->num_rows > 0) {
                echo "<label>Estado: <select name='estado' required>";
                while ($rowEstado = mysqli_fetch_array($resultEstados)) {
                    $codigoEstado = $rowEstado['codigo'];
                    $nombreEstado = $rowEstado['nombre'];
                    echo "<option value='$codigoEstado'>$nombreEstado</option>";
                }
                echo "</select></label><br>";
            } else {
                echo "<p>No hay estados disponibles.</p>";
                exit();
            }
            ?>

            <input type="hidden" name="idProyecto" value="<?php echo $idProyecto; ?>">
            <input type="submit" value="Crear Tarea">
        </form>
    </main>
</body>

</html>