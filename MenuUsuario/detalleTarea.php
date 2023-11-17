<?php
session_start();

if (!isset($_SESSION['user_name'])) {
    header('location:../Alertas/warning.html');
    exit;
}

$current_page = basename($_SERVER['PHP_SELF']);

include 'consultas.php';
$consultas = new Consultas();
$proyectos = $consultas->getProyectos();

if ($proyectos) {
    $proyecto = isset($_GET['idProyecto']) ? $_GET['idProyecto'] : null;
    $idProyecto = $_SESSION['idProyecto'];

    if ($proyecto !== null) {
        $tareas = $consultas->getTareas($proyecto);
        $idTarea = isset($_GET['idTarea']) ? $_GET['idTarea'] : null;
        $tareaSeleccionada = null;

        foreach ($tareas as $tarea) {
            if ($tarea['idTarea'] == $idTarea) {
                $tareaSeleccionada = $tarea;
                break;
            }
        }

        if ($tareaSeleccionada) {
            $usuarioAsignado = $consultas->getUsuarioAsignado($tareaSeleccionada['idTarea']);
            $comentarios = $consultas->getComentariosTarea($tareaSeleccionada['idTarea']);

           
?>
<!DOCTYPE html>
<html lang="en">

<head>
</head>

<body>
    <?php
                include "plantillas/header.php";
                include "plantillas/miniBar.php";
                include "plantillas/menu.php";

                if ($tareaSeleccionada) {
                    $infoProyecto = $consultas->getInfoProyecto($tareaSeleccionada['idProyecto']);
                    $usuarioAsignado = $consultas->getUsuarioAsignado($tareaSeleccionada['idTarea']);
                    $comentarios = $consultas->getComentariosTarea($tareaSeleccionada['idTarea']);
                ?>
    <main>
        <div class="task-details">
            <h2><?= $tareaSeleccionada['NombreTarea']; ?></h2>
            <p><strong>Proyecto:</strong> <?= $infoProyecto['nombre']; ?></p>
            <p><strong>Fecha de Inicio:</strong> <?= $tareaSeleccionada['fechaInicio']; ?></p>
            <p><strong>Fecha Final:</strong> <?= $tareaSeleccionada['fechaFinal']; ?></p>
            <p><strong>Estado:</strong> <?= $consultas->obtenerNombreEstado($tareaSeleccionada['estado']); ?></p>
            <p><strong>Descripción:</strong> <?= $tareaSeleccionada['DescripcionTarea']; ?></p>


            <?php if (!empty($comentarios)) : ?>
            <div class="comments-section">
                <p><strong>Comentarios:</strong></p>
                <?php foreach ($comentarios as $comentario) : ?>
                <div class="comment">
                    <p><?= $comentario['descripcion']; ?></p>
                    <p><strong>Fecha:</strong> <?= $comentario['fechaComentario']; ?></p>
                    <p><strong>Usuario:</strong> <?= $comentario['nombreUsuario']; ?></p>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </main>
    <?php
                } else {
                    echo "No se encontró la tarea seleccionada.";
                }
                ?>
</body>

</html>
<?php
        } else {
            echo "No se encontró la tarea seleccionada.";
        }
    } else {
        echo "No se encontró el proyecto.";
    }
} else {
    echo "No se encontraron proyectos.";
}
?>