<?php
session_start();

if (!isset($_SESSION['admin_name']) && !isset($_SESSION['arqui_name'])) {
    header('location:../../Alertas/warning.html');
}

include("../../conexion.php");
$conexion = new conexion();

if ($conexion->connect()) {
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['idTarea'])) {
        $idTarea = $_GET['idTarea'];

        $queryTarea = "SELECT * FROM Tarea WHERE idTarea = $idTarea";
        $resultTarea = $conexion->exeqSelect($queryTarea);

        if ($resultTarea->num_rows > 0) {
            $rowTarea = mysqli_fetch_array($resultTarea);
            $tituloTarea = $rowTarea['titulo'];
            $descripcionTarea = $rowTarea['descripcion'];
            $estadoTarea = $rowTarea['estado'];
            $idProyecto = $rowTarea['idProyecto'];

            $queryProyectoTarea = "SELECT * FROM ProyectoTarea WHERE idTarea = $idTarea";
            $resultProyectoTarea = $conexion->exeqSelect($queryProyectoTarea);

            if ($resultProyectoTarea->num_rows > 0) {
                $rowProyectoTarea = mysqli_fetch_array($resultProyectoTarea);
                $fechaInicioTarea = $rowProyectoTarea['fechaInicio'];
                $fechaFinalTarea = $rowProyectoTarea['fechaFinal'];

                $queryProyecto = "SELECT * FROM Proyecto WHERE idProyecto = $idProyecto";
                $resultProyecto = $conexion->exeqSelect($queryProyecto);

                if ($resultProyecto->num_rows > 0) {
                    $rowProyecto = mysqli_fetch_array($resultProyecto);
                    $nombreProyecto = $rowProyecto['nombre'];
                    $descripcionProyecto = $rowProyecto['descripcion'];
                    $ubicacionProyecto = $rowProyecto['ubicacion'];
                    $fechaInicioProyecto = $rowProyecto['fechaInicio'];
                    $fechaFinalProyecto = $rowProyecto['fechaFinal'];

                    echo "<h2>Detalles de la Tarea</h2>";
                    echo "<p><strong>Título:</strong> $tituloTarea</p>";
                    echo "<p><strong>Descripción:</strong> $descripcionTarea</p>";
                    echo "<p><strong>Estado:</strong> $estadoTarea</p>";
                    echo "<p><strong>Fecha de Inicio de la Tarea:</strong> $fechaInicioTarea</p>";
                    echo "<p><strong>Fecha de Finalización de la Tarea:</strong> $fechaFinalTarea</p>";
                    echo "<p><strong>Proyecto Asociado:</strong> $nombreProyecto</p>";
                    echo "<p><strong>Descripción del Proyecto:</strong> $descripcionProyecto</p>";
                    echo "<p><strong>Ubicación del Proyecto:</strong> $ubicacionProyecto</p>";
                    echo "<p><strong>Fecha de Inicio del Proyecto:</strong> $fechaInicioProyecto</p>";
                    echo "<p><strong>Fecha de Finalización del Proyecto:</strong> $fechaFinalProyecto</p>";

                    echo "<a href='../index.php'>Volver al Menú Principal</a><br>";
                    echo "<a href='agregarTarea.php?idProyecto=$idProyecto'>Registrar Otra Tarea</a>";
                } else {
                    echo "<p>No se encontró información del proyecto.</p>";
                }
            } else {
                echo "<p>No se encontró información de la relación entre la tarea y el proyecto.</p>";
            }
        } else {
            echo "<p>No se encontró la tarea.</p>";
        }
    } else {
        echo "<p>Parámetros incorrectos.</p>";
    }

    $conexion->close();
} else {
    echo "<p>Error en la conexión a la base de datos.</p>";
}