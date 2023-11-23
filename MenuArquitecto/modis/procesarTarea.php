<?php
session_start();

if (!isset($_SESSION['admin_name']) && !isset($_SESSION['arqui_name'])) {
    header('location:../../Alertas/warning.html');
}

include("../../conexion.php");
$conexion = new conexion();

if ($conexion->connect()) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['titulo']) && isset($_POST['descripcion']) && isset($_POST['estado']) && isset($_POST['idProyecto']) && isset($_POST['fechaInicio']) && isset($_POST['fechaFinal'])) {
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $estado = $_POST['estado'];
        $idProyecto = $_POST['idProyecto'];
        $fechaInicio = $_POST['fechaInicio'];
        $fechaFinal = $_POST['fechaFinal'];

        $queryInsertarTarea = "INSERT INTO Tarea (titulo, descripcion, estado, idProyecto) 
                               VALUES ('$titulo', '$descripcion', '$estado', '$idProyecto')";
        $resultTarea = $conexion->exeqInsert($queryInsertarTarea);

        if (!$resultTarea) {
            echo "Error al insertar tarea: " . mysqli_error($conexion->getConexion());
        } else {
            $idTarea = mysqli_insert_id($conexion->getConexion());

            $queryInsertarProyectoTarea = "INSERT INTO ProyectoTarea (idProyecto, idTarea, fechaInicio, fechaFinal) 
                                           VALUES ('$idProyecto', '$idTarea', '$fechaInicio', '$fechaFinal')";
            $resultProyectoTarea = $conexion->exeqInsert($queryInsertarProyectoTarea);

            if (!$resultProyectoTarea) {
                echo "<a href='../index.php'> Regresar al menu " . mysqli_error($conexion->getConexion());
            } else {
                echo "Inserción exitosa en Tarea y ProyectoTarea.";
            }
        }
    } else {
        echo "Datos del formulario incompletos.";
    }

    $conexion->close();
} else {
    echo "Error en la conexión a la base de datos.";
}