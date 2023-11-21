<?php
ob_start();
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
    $idProyecto = isset($_GET['idProyecto']) ? $_GET['idProyecto'] : null;

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
            $infoProyecto = $consultas->getInfoProyecto($proyecto);

            $usuarioAsignado = $consultas->getUsuarioAsignado($tareaSeleccionada['idTarea']);
            $comentarios = $consultas->getComentariosTarea($tareaSeleccionada['idTarea']);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGPC</title>
    <link rel="stylesheet" href="../css/detalleTarea.css">
    <link rel="icon" href="../img/Logo1.png" type="image/png">
</head>

<body>
    <?php

                include "plantillas/header.php";
                include "plantillas/menu.php";
                ?>
    <?php

                if ($tareaSeleccionada) {
                    $infoProyecto = $consultas->getInfoProyecto($tareaSeleccionada['idProyecto']);
                    $usuarioAsignado = $consultas->getUsuarioAsignado($tareaSeleccionada['idTarea']);
                    $comentarios = $consultas->getComentariosTarea($tareaSeleccionada['idTarea']);
                ?>
    <main>
        <form action="marcar_completa.php" method="post">
            <input type="hidden" name="idTarea" value="<?= $tareaSeleccionada['idTarea']; ?>">
            <input type="submit" value="Marcar como Completa">
        </form>
        <div class="task-details">
            <h2><?= $tareaSeleccionada['NombreTarea']; ?></h2>
            <p><strong>Fecha de Inicio:</strong> <?= date("Y-m-d", strtotime($tareaSeleccionada['fechaInicio'])); ?></p>
            <p><strong>Fecha Final:</strong>
                <?= ($tareaSeleccionada['fechaFinal'] !== null) ? date("Y-m-d", strtotime($tareaSeleccionada['fechaFinal'])) : 'Sin fecha final'; ?>
            </p>


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
            <?php else : ?>
            <p>No hay comentarios disponibles.</p>
            <?php endif; ?>
            <div class="add-comment-section">
                <h3>Agregar Comentario</h3>
                <form action="agregar_comentario.php" method="post">
                    <textarea name="comentario" placeholder="Escribe tu comentario aquí..." required></textarea>
                    <input type="hidden" name="idTarea" value="<?= $tareaSeleccionada['idTarea']; ?>">
                    <input type="submit" value="Enviar Comentario">
                </form>
            </div>
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