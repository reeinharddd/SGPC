<?php
session_start();

if (!isset($_SESSION['admin_name'])) {
    header('location:../../Alertas/warning.html');
    exit();
}

include("../../conexion.php");
$conexion = new conexion();

if ($conexion->connect()) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idTarea']) && isset($_POST['titulo']) && isset($_POST['descripcion']) && isset($_POST['estado']) && isset($_POST['fechaInicio']) && isset($_POST['fechaFinal'])) {
        $idTarea = $_POST['idTarea'];
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $estado = $_POST['estado'];
        $fechaInicio = $_POST['fechaInicio'];
        $fechaFinal = $_POST['fechaFinal'];

        $queryActualizarTarea = "UPDATE Tarea 
                                 SET titulo = '$titulo', descripcion = '$descripcion', estado = '$estado'
                                 WHERE idTarea = $idTarea";
        $resultActualizarTarea = $conexion->exeqUpdate($queryActualizarTarea);

        $queryActualizarProyectoTarea = "UPDATE ProyectoTarea 
                                         SET fechaInicio = '$fechaInicio', fechaFinal = '$fechaFinal'
                                         WHERE idTarea = $idTarea";
        $resultActualizarProyectoTarea = $conexion->exeqUpdate($queryActualizarProyectoTarea);

        if ($resultActualizarTarea && $resultActualizarProyectoTarea) {
            echo "Actualización exitosa de la tarea.";

            echo '<br><br><a href="../../index.php">Menu</a>';
        } else {
            echo '<br><br><a href="../../index.php">Menu</a>';
        }

        $conexion->close();
    } else {
        echo "Error en la conexión a la base de datos.";
    }
}
