<?php
if (
    $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idUsuario']) && isset($_POST['idProyecto']) &&
    isset($_POST['titulo']) && isset($_POST['descripcion']) && isset($_POST['fechaInicio']) && isset($_POST['fechaFinal'])
) {

    $idUsuario = $_POST['idUsuario'];
    $idProyecto = $_POST['idProyecto'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $fechaInicio = $_POST['fechaInicio'];
    $fechaFinal = $_POST['fechaFinal'];

    include("../../conexion.php");
    $conexion = new conexion();

    if ($conexion->connect()) {
        $queryInsertarTarea = "INSERT INTO Tarea (titulo, descripcion, estado, fechaInicio, fechaFinal, idProyecto) 
                               VALUES ('$titulo', '$descripcion', 'ACT', '$fechaInicio', '$fechaFinal',  $idProyecto)";
        $idTarea = $conexion->exeqInsert($queryInsertarTarea);

        if (!$idTarea) {
            echo "Error al insertar tarea: " . mysqli_error($conexion->getConexion());
        }

        $queryAsignarUsuario = "INSERT INTO UsuarioTarea (idUsuario, idTarea) 
                                VALUES ($idUsuario, $idTarea)";
        $conexion->exeqInsert($queryAsignarUsuario);

        $queryProyectoTarea = "INSERT INTO ProyectoTarea (idProyecto, idTarea, fechaInicio, fechaFinal) 
                               VALUES ($idProyecto, $idTarea, '$fechaInicio', '$fechaFinal')";
        $conexion->exeqInsert($queryProyectoTarea);

        $queryNombreTarea = "SELECT titulo FROM Tarea WHERE idTarea = $idTarea";
        $resultNombreTarea = $conexion->exeqSelect($queryNombreTarea);
        $nombreTarea = mysqli_fetch_assoc($resultNombreTarea)['titulo'];

        $queryNombreProyecto = "SELECT nombre FROM Proyecto WHERE idProyecto = $idProyecto";
        $resultNombreProyecto = $conexion->exeqSelect($queryNombreProyecto);
        $nombreProyecto = mysqli_fetch_assoc($resultNombreProyecto)['nombre'];

        $queryNombreUsuario = "SELECT nombre FROM Usuario WHERE idUsuario = $idUsuario";
        $resultNombreUsuario = $conexion->exeqSelect($queryNombreUsuario);
        $nombreUsuario = mysqli_fetch_assoc($resultNombreUsuario)['nombre'];

        echo "<h1>Detalles de la Tarea</h1>";
        echo "<p>Nombre de la Tarea: $nombreTarea</p>";
        echo "<p>Proyecto: $nombreProyecto</p>";
        echo "<p>Usuario: $nombreUsuario</p>";
        echo "<p>Título: $titulo</p>";
        echo "<p>Descripción: $descripcion</p>";
        echo "<p>Fecha de Inicio: $fechaInicio</p>";
        echo "<p>Fecha de Finalización: $fechaFinal</p>";

        echo "<a href='../index.php'>Terminar</a>";
        echo "<a href='crearTareaForm.php?idUsuario=$idUsuario&idProyecto=$idProyecto'>Asignar Otra Tarea</a>";
        echo "<a href='asignarTareas.php?idProyecto=$idProyecto'>Elegir Otro Usuario</a>";

        exit();
    } else {
        echo "Error en la conexión a la base de datos.";
    }
} else {
    echo "Datos incorrectos o no proporcionados.";
}
?>