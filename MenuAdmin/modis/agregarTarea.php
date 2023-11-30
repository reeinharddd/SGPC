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
    <?PHP
include "../plantillas/header.php";
include "../plantillas/menu.php";
?>
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

            if ($rowProyecto['estado'] != 'RET') {
                echo "<label>Fecha de Inicio (debe ser después de $fechaInicioProyecto y $fechaHoy): <input type='date' name='fechaInicio' min='$fechaInicioProyecto' value='$fechaHoy' required></label><br>";
            } else {
                echo "<label>Fecha de Inicio: <input type='date' name='fechaInicio' min='$fechaHoy' required></label><br>";
            }
            ?>

            <?php
            $fechaFinProyecto = $rowProyecto['fechaFinal'];

            if ($rowProyecto['estado'] != 'RET') {
                echo "<label>Fecha de Finalización (debe ser después de $fechaHoy y antes de $fechaFinProyecto): <input type='date' name='fechaFinal' min='$fechaHoy' max='$fechaFinProyecto' required></label><br>";
            } else {
                echo "<label>Fecha de Finalización: <input type='date' name='fechaFinal' min='$fechaHoy'required></label><br>";
            }
            ?>

            <?php
            $queryEstados = "SELECT codigo, nombre FROM Estado WHERE nombre NOT IN ('FIN', 'CAN', 'NAN')";
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
