<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idTarea = $_POST['idTarea'];
    $estadoSeleccionado = $_POST['estadoTarea'];

    include '../conexion.php';

    $conexion = new conexion();
    if ($conexion->connect()) {
        $query = "UPDATE Tarea SET estado = ? WHERE idTarea = ?";
        $stmt = $conexion->getConexion()->prepare($query);

        if ($stmt) {
            $stmt->bind_param("si", $estadoSeleccionado, $idTarea);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo '<script>window.history.back();</script>';
                exit();
            } else {
                echo "Error al actualizar el estado de la tarea.";
            }

            $stmt->close();
        } else {
            echo "Error en la preparación de la consulta.";
        }

        $conexion->close();
    } else {
        echo "Error de conexión.";
    }
}
?>