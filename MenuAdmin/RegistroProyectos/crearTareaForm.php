<?php
session_start();
$current_page = $_SERVER['PHP_SELF'];

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
    <link rel="stylesheet" href="../../css/full.css" />
</head>

<body>
    <?PHP
    include "../plantillas/header.php";
    include "../plantillas/menu.php";
    ?>
    <main class="main-section">
        <?php
        if (isset($_GET['idUsuario']) && isset($_GET['idProyecto'])) {
            $idUsuario = $_GET['idUsuario'];
            $idProyecto = $_GET['idProyecto'];

            include("../../conexion.php");
            $conexion = new conexion();

            if ($conexion->connect()) {
                $queryUsuario = "SELECT nombre, apellidoPat, apellidoMat FROM Usuario WHERE idUsuario = $idUsuario";
                $resultUsuario = $conexion->exeqSelect($queryUsuario);

                if ($resultUsuario->num_rows > 0) {
                    $rowUsuario = $resultUsuario->fetch_assoc();
                    $nombreCompletoUsuario = $rowUsuario['nombre'] . ' ' . $rowUsuario['apellidoPat'] . ' ' . $rowUsuario['apellidoMat'];

                    $queryProyecto = "SELECT fechaInicio, fechaFinal FROM Proyecto WHERE idProyecto = $idProyecto";
                    $resultProyecto = $conexion->exeqSelect($queryProyecto);

                    if ($resultProyecto->num_rows > 0) {
                        $rowProyecto = $resultProyecto->fetch_assoc();
                        $fechaInicioProyecto = $rowProyecto['fechaInicio'];
                        $fechaFinalProyecto = $rowProyecto['fechaFinal'];

                        echo "<h2 class='create-task-title'>Crear Tarea para Usuario: $nombreCompletoUsuario</h2>";
                        echo "<form method='post' action='crearTareaProcesar.php' class='task-form'>";
                        echo "<label class='proyecto-info'>Título (menos de 40 caracteres): <input type='text' name='titulo' maxlength='40' required></label><br>";
                        echo "<label class='proyecto-info'>Descripción (menos de 100 caracteres): <input type='text' name='descripcion' maxlength='100' required></label><br>";

                        echo "<label class='proyecto-info'>Fecha de Inicio: <input type='date' name='fechaInicio' id='fechaInicio' min='$fechaInicioProyecto' max='$fechaFinalProyecto' required></label><br>";

                        echo "<label class='proyecto-info'>Fecha de Finalización: <input type='date' name='fechaFinal' id='fechaFinal' min='$fechaInicioProyecto' max='$fechaFinalProyecto' required></label><br>";

                        echo "<input type='hidden' name='idUsuario' value='$idUsuario'>";
                        echo "<input type='hidden' name='idProyecto' value='$idProyecto'>";
                        echo "<input type='submit' value='Crear Tarea' class='details-button btn-submit'>";
                        echo "</form>";

                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            echo "<script>
                                    document.querySelector('.task-form').addEventListener('submit', function (event) {
                                        const fechaInicio = new Date(document.getElementById('fechaInicio').value).getTime();
                                        const fechaFinal = new Date(document.getElementById('fechaFinal').value).getTime();
                                        const fechaInicioProyecto = new Date('$fechaInicioProyecto' + 'T00:00:00').getTime();
                                        const fechaFinalProyecto = new Date('$fechaFinalProyecto' + 'T00:00:00').getTime();
                                        const fechaActual = new Date().getTime();

                                        if (fechaFinal < fechaInicioProyecto || fechaFinal > fechaFinalProyecto) {
                                            alert('La fecha de finalización debe estar entre la fecha de inicio del proyecto y la fecha de finalización del proyecto.');
                                            event.preventDefault();
                                        } else if (fechaFinal > fechaInicio) {
                                            alert('La fecha final debe ser posterior a la fecha de inicio.');
                                            event.preventDefault();
                                        } else if (fechaInicio < fechaInicioProyecto || fechaInicio > fechaActual || fechaInicio > fechaFinalProyecto || fechaFinal > fechaFinalProyecto) {
                                            alert('Las fechas de la tarea deben estar dentro del rango del proyecto y respetar los límites establecidos.');
                                            event.preventDefault();
                                        }
                                    });
                                </script>";
                        }
                    } else {
                        echo "<p class='error-message'>No se encontraron fechas para el proyecto.</p>";
                    }
                } else {
                    echo "<p class='error-message'>No se encontró el usuario.</p>";
                }
            } else {
                echo "<p class='error-message'>Error en la conexión a la base de datos.</p>";
            }
        } else {
            echo "<p class='error-message'>ID del usuario o del proyecto no proporcionado.</p>";
        }
        ?>
    </main>
</body>

</html>
