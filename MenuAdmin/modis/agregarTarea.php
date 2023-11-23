<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGPC - Agregar Tarea</title>
    <link rel="stylesheet" href="../../css/main.css">
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
    <div class="hero">
        <?php
        session_start();

        if (!isset($_SESSION['admin_name']) && !isset($_SESSION['arqui_name'])) {
            header('location:../../Alertas/warning.html');
        }

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
            <button><b><a href="../index.php">◄ Menú</a></b></button>
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
    </div>
</body>

</html>