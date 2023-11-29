<?php
include("Proyectos.php");
$current_page = $_SERVER['PHP_SELF'];
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
            <link rel="stylesheet" href="../../css/proyectos.css" />

        </head>

        <body>
             <?PHP
include "../plantillas/header.php";
include "../plantillas/menu.php";
?>

            <main class="main-section">
                <h1>Detalles del Proyecto creado</h1>

                <p class="project-name"><strong>Nombre:</strong> <?= $nombre ?></p>
                <p class="project-description"><strong>Descripción:</strong> <?= $descripcion ?></p>
                <p class="project-location"><strong>Ubicación:</strong> <?= $ubicacion ?></p>
                <p class="project-date"><strong>Fecha de Inicio:</strong> <?= $fechaInicio ?></p>
                <p class="project-date"><strong>Fecha Final:</strong> <?= $fechaFinal ?></p>
                <p class="project-state"><strong>Estado:</strong> <?= $estado ?></p>

                <a href="../index.php" class="details-button">Terminar con la creación (Volver al index)</a>
                <a href="agregarUsuarios.php?idProyecto=<?= $idProyecto ?>" class="details-button">Continuar agregando usuarios
                    al proyecto</a>
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