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

        // Ahora, para cada tarea, obtenemos información adicional
        foreach ($tareas as &$tarea) {
            // Obtén información adicional según sea necesario
            $usuarioAsignado = $consultas->getUsuarioAsignado($tarea['idTarea']);
            $comentarios = $consultas->getComentariosTarea($tarea['idTarea']);

            // Agrega la información adicional a la tarea
            $tarea['usuarioAsignado'] = $usuarioAsignado;
            $tarea['comentarios'] = $comentarios;
        }

        // Resto del código...
    } else {
        echo "No se encontró el proyecto.";
    }
} else {
    echo "No se encontraron proyectos.";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyectos</title>
    <link rel="stylesheet" href="../css/proyectos.css">
    <link rel="icon" href="../img/Logo1.png" type="image/png">
</head>

<body>
    <?php
    include "plantillas/header.php";
    include "plantillas/miniBar.php"
    ?>

    <section>
        <?php
        include "plantillas/menu.php";
        ?>

        <main>
            <div class="project-list">
                <div id="project-list">
                    <?php
                    foreach ($tareas as $tarea) {
                        echo '<div class="task-card">';
                        echo '<div class="task-title">' . $tarea['NombreTarea'] . '</div>';
                        echo '<div class="task-description">' . $tarea['DescripcionTarea'] . '</div>';
                        echo '<div class="task-status">' . $tarea['estado'] . '</div>';

                        // Integrar información adicional en la tarea
                        echo '<div class="task-info">';
                        echo '<p>Usuario Asignado: ' . $tarea['usuarioAsignado'] . '</p>';

                        // Si hay comentarios, mostrarlos
                        if (!empty($tarea['comentarios'])) {
                            echo '<div class="comments-section">';
                            echo '<p>Comentarios:</p>';
                            foreach ($tarea['comentarios'] as $comentario) {
                                echo '<div class="comment">';
                                echo '<p>' . $comentario['descripcion'] . '</p>';
                                echo '<p>Fecha: ' . $comentario['fechaComentario'] . '</p>';
                                echo '<p>Usuario: ' . $comentario['nombreUsuario'] . '</p>';
                                echo '</div>';
                            }
                            echo '</div>';
                        }

                        echo '</div>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </main>
    </section>
</body>

</html>