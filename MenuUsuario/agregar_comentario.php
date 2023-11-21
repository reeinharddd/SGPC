<?php
ob_start();
session_start();
include 'consultas.php';
$consultas = new Consultas();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $comentario = $_POST['comentario'];
    $idTarea = $_POST['idTarea'];
    $idUsuario = $_SESSION['id'];


    $fechaComentario = date("Y-m-d");
    $query = "INSERT INTO Comentario (descripcion, fechaComentario, idUsuario, idTarea) 
              VALUES ('$comentario', '$fechaComentario', $idUsuario, $idTarea)";



    $conexion = new conexion();
    if ($conexion->connect()) {
        $result = $conexion->exeqInsert($query);

        if ($result > 0) {
            echo '<script>window.history.back();</script>';

            exit();
        } else {
            echo "Error al agregar el comentario.";
        }

        $conexion->close();
    }
}
function obtenerIdProyecto($idTarea, $conexion)
{
    $query = "SELECT idProyecto FROM ProyectoTarea WHERE idTarea = $idTarea";
    $result = $conexion->exeqSelect($query);

    if ($result && $row = mysqli_fetch_assoc($result)) {
        return $row['idProyecto'];
    }

    return null;
}