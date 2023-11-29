<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGPC - Agregar Tarea</title>
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="icon" href="../../img/Logo1.png" type="image/png">
</head>

<body>
    <?php
    include('../plantillas/header.php');
    include('../plantillas/menu.php');
    ?>
    <main>
    <div class="hero">
        <?php
        session_start();

        if (!isset($_SESSION['admin_name']) && !isset($_SESSION['arqui_name'])) {
            header('location:../Alertas/warning.html');
            exit();
        }

        include("../../conexion.php");
        $conexion = new conexion();

        if ($conexion->connect()) {
            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['idProyecto']) && isset($_GET['idUsuario'])) {
                $idProyecto = $_GET['idProyecto'];
                $idUsuario = $_GET['idUsuario'];
        
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
            <label>Título: <input type="text" name="titulo" required></label><br>
            <label>Descripción: <input type="text" name="descripcion" required></label><br>
            <label>Fecha de Inicio: <input type="date" name="fechaInicio" required></label><br>
            <label>Fecha de Finalización: <input type="date" name="fechaFinal" required></label><br>
            <input type="hidden" name="idUsuario" value="<?php echo $idUsuario; ?>">

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
    </main>
</body>

</html>