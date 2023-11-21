<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idTarea = $_POST['idTarea'];

    include '../conexion.php';

    $conexion = new conexion();
    if ($conexion->connect()) {
        $query = "UPDATE Tarea SET estado = 'FIN' WHERE idTarea = $idTarea";
        $result = $conexion->exeqUpdate($query);

        if ($result > 0) {
            echo '<script>window.history.back();</script>';
            exit();
        } else {
            echo "Error al marcar la tarea como completa.";
        }
    } else {
        echo "Error de conexión.";
    }

    $conexion->close();
}