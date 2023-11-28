<?php
ob_start();
session_start();

if (!isset($_SESSION['admin_name'])) {
    header('location:../../Alertas/warning.html');
    exit;
}

$current_page = basename($_SERVER['PHP_SELF']);

include 'consultas.php';
$consultas = new Consultas();

$idTarea = isset($_GET['idTarea']) ? $_GET['idTarea'] : null;

$tareaSeleccionada = $consultas->getTareaPorId($idTarea);

if ($tareaSeleccionada) {
    $infoProyecto = $consultas->getInfoProyecto($tareaSeleccionada['idProyecto']);
    $usuarioAsignado = $consultas->getUsuarioAsignado($idTarea);
    $comentarios = $consultas->getComentariosTarea($idTarea);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGPC</title>
    <link rel="stylesheet" href="../../css/detalleTarea.css">
    <link rel="icon" href="../../img/Logo1.png" type="image/png">
</head>

<body>
    <?php
        include "../plantillas/header.php";
        include "../plantillas/menu.php";
        ?>

    <main>
        <div class="task-details">
            <div class="header-section">
                <h2><?= $tareaSeleccionada['NombreTarea']; ?></h2>
                <p class="date">
                    <strong>Fecha de Inicio:</strong>
                    <?= date("Y-m-d", strtotime($tareaSeleccionada['fechaInicio'])); ?>
                </p>
                <p class="date">
                    <strong>Fecha Final:</strong>
                    <?= ($tareaSeleccionada['fechaFinal'] !== null) ? date("Y-m-d", strtotime($tareaSeleccionada['fechaFinal'])) : 'Sin fecha final'; ?>
                </p>
                <form action="actualizar_estado.php" method="post" class="update-task-status-section">
                    <label for="estadoTarea">Estado:</label>
                    <select name="estadoTarea" id="estadoTarea">
                        <?php
                            $estados = $consultas->obtenerEstados(); 
                            foreach ($estados as $codigo => $nombre) {
                                echo '<option value="' . $codigo . '">' . $nombre . '</option>';
                            }
                          
                            ?>
                    </select>

                    <input type="hidden" name="idTarea" value="<?= $idTarea; ?>">
                    <input type="submit" value="Actualizar Estado" class="update-task-status-button">
                </form>
                <p class="status <?= $consultas->obtenerNombreEstado($tareaSeleccionada['estado']); ?>">
                    <strong>Estado:</strong> <?= $consultas->obtenerNombreEstado($tareaSeleccionada['estado']); ?>
                </p>

                <div class="divider"></div>

                <div class="project-description">
                    <p><?= $tareaSeleccionada['DescripcionTarea']; ?></p>
                </div>
            </div>
        </div>

        <div class="divider"></div>

        <?php if (!empty($comentarios)) : ?>
        <div class="comments-section">
            <h3>Comentarios:</h3>
            <?php foreach ($comentarios as $comentario) : ?>
            <div class="comment <?= ($comentario['nombreUsuario'] == 'nombreUsuarioActual') ? 'user-comment' : ''; ?>">
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
                <input type="hidden" name="idTarea" value="<?= $idTarea; ?>">
                <input type="submit" value="Enviar Comentario">
            </form>
        </div>
    </main>

</body>

</html>
<?php
} else {
    echo "No se encontró la tarea seleccionada.";
}
?>