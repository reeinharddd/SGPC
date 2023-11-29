<?php
include("Proyectos.php");

if (isset($_GET['idProyecto'])) {
    $idProyecto = $_GET['idProyecto'];

    $proyecto = new Proyecto();

    $detalleProyecto = $proyecto->obtenerDetallesProyecto($idProyecto);

    if ($detalleProyecto) {
        $nombre = $detalleProyecto['nombre'];
        $descripcion = $detalleProyecto['descripcion'];
        $ubicacion = $detalleProyecto['ubicacion'];
        $fechaInicio = $detalleProyecto['fechaInicio'];
        $fechaFinal = $detalleProyecto['fechaFinal'];
        $estado = $detalleProyecto['estado'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Proyecto</title>
</head>

<body>
<?php
include('../plantillas/header.php');
include('../plantillas/menu.php');
?>
<main>
    <h1>Detalles del Proyecto creado</h1>

    <p><strong>Nombre:</strong> <?= $nombre ?></p>
    <p><strong>Descripción:</strong> <?= $descripcion ?></p>
    <p><strong>Ubicación:</strong> <?= $ubicacion ?></p>
    <p><strong>Fecha de Inicio:</strong> <?= $fechaInicio ?></p>
    <p><strong>Fecha Final:</strong> <?= $fechaFinal ?></p>
    <p><strong>Estado:</strong> <?= $estado ?></p>


    <a href="../index.php">Terminar con la creación (Volver al index)</a>
    <br>
    <a href="agregarProyecto.php">Agregar otro proyecto?</a>
</main>
</body>

</html>
<?php
    } else {
        echo "No se encontraron detalles del proyecto.";
    }
} else {
    echo "ID de proyecto no proporcionado en la URL.";
}
?>