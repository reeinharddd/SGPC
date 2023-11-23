<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGPC - Agregar Tarea</title>
    <link rel="stylesheet" href="../../../css/main.css">
    <link rel="icon" href="../../../img/Logo1.png" type="image/png">
</head>

<body>
    <div class="hero">
        <?php
        session_start();

        if (!isset($_SESSION['admin_name']) && !isset($_SESSION['arqui_name'])) {
            header('location:../../Alertas/warning.html');
        }

        include("../../../conexion.php");
        $conexion = new conexion();

        if ($conexion->connect()) {
            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['idProyecto'])) {
                $idProyecto = $_GET['idProyecto'];

                $queryProyecto = "SELECT * FROM UsuarioTarea WHERE idUsuario = $idProyecto";
                $resultProyecto = $conexion->exeqSelect($queryProyecto);

                if ($resultProyecto->num_rows > 0) {
                    $rowProyecto = mysqli_fetch_array($resultProyecto);
                    $nombreProyecto = $rowProyecto['idUsuario'];
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
            <button><b><a href="../../index.php">◄ Menú</a></b></button>
            <br>
            <h2>Agregar Tarea al Usuario: <?php echo $nombreProyecto; ?></h2>
            <label>Título: <input type="text" name="titulo" required></label><br>
            <label>Descripción: <input type="text" name="descripcion" required></label><br>
            <label>Fecha de Inicio: <input type="date" name="fechaInicio" required></label><br>
            <label>Fecha de Finalización: <input type="date" name="fechaFinal" required></label><br>

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
    </div>
</body>

</html>