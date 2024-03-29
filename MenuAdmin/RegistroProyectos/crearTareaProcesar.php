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
    <main>
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
                $queryInsertarTarea = "INSERT INTO Tarea (titulo, descripcion, estado, idProyecto) 
                                   VALUES ('$titulo', '$descripcion', 'ACT', $idProyecto)";
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

                echo "<h1 class='details-title'>Detalles de la Tarea</h1>";
                echo "<p class='details-info'>Nombre de la Tarea: $nombreTarea</p>";
                echo "<p class='details-info'>Proyecto: $nombreProyecto</p>";
                echo "<p class='details-info'>Usuario: $nombreUsuario</p>";
                echo "<p class='details-info'>Título: $titulo</p>";
                echo "<p class='details-info'>Descripción: $descripcion</p>";
                echo "<p class='details-info'>Fecha de Inicio: $fechaInicio</p>";
                echo "<p class='details-info'>Fecha de Finalización: $fechaFinal</p>";

                echo "<a href='../base/index.php' class='details-button btn-reset'>Terminar</a>";
                echo "<a href='crearTareaForm.php?idUsuario=$idUsuario&idProyecto=$idProyecto' class='details-button btn-submit'>Asignar Otra Tarea</a>";
                echo "<a href='asignarTareas.php?idProyecto=$idProyecto' class='details-button btn-reset'>Elegir Otro Usuario</a>";

                exit();
            } else {
                echo "<p class='error-message'>Error en la conexión a la base de datos.</p>";
            }
        } else {
            echo "<p class='error-message'>Datos incorrectos o no proporcionados.</p>";
        }
        ?>
    </main>
</body>

</html>
