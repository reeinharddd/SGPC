<?php
function getTaskStateClass($estado)
{
    switch ($estado) {
        case 'ACT':
            return 'active-state';
        case 'PEN':
            return 'pending-state';
        case 'FIN':
            return 'finished-state';
        case 'CAN':
            return 'canceled-state';
        case 'RET':
            return 'delayed-state';
        default:
            return '';
    }
}

session_start();

if (!isset($_SESSION['admin_name'])) {
    header('location:../../Alertas/warning.html');
    exit;
}

$current_page = basename($_SERVER['PHP_SELF']);

include 'consultas.php';
$consultas = new Consultas();
$proyectos = $consultas->getProyectos();
if ($proyectos) {
    $proyecto = isset($_GET['idProyecto']) ? $_GET['idProyecto'] : null;

    if ($proyecto !== null) {
        $tareas = $consultas->getTareas($proyecto);
        $infoProyecto = $consultas->getInfoProyecto($proyecto);
        $primerasTareas = $consultas->obtenerPrimerasTareas($_SESSION['id'], $proyecto, 3);
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
    <link rel="stylesheet" href="../../css/proyectos.css">
    <link rel="icon" href="../../img/bricks.svg" type="image/svg+xml">
</head>

<body>
    <?php
    include "../plantillas/header.php";


    include "../plantillas/miniBar.php"
    ?> <section>

        <?php
        include "../plantillas/menu.php";
        ?>

        <main>
            <div class="project-banner">
                <div class="project-banner-overlay"></div>

                <h1><?php echo $infoProyecto['nombre']; ?></h1>
                <p><strong>Fecha de Inicio:</strong> <?php echo $infoProyecto['fechaInicio']; ?></p>
                <p><strong>Fecha Final:</strong> <?php echo $infoProyecto['fechaFinal']; ?></p>
                <p><strong>Estado:</strong> <?php echo $infoProyecto['estado']; ?></p>
                <p><strong>Ubicación:</strong> <?php echo $infoProyecto['ubicacion']; ?></p>
                <p><strong>Descripción:</strong> <?php echo $infoProyecto['descripcion']; ?></p>
            </div>

            <div class="project-list">
                <div class="left-section">
    <h2>Tareas Próximas</h2>

    <?php foreach ($primerasTareas as $tarea) : ?>
        <a href='detalleTarea.php?idTarea=<?= $tarea["idTarea"] ?>'
            class='upcoming-task <?= strtolower($tarea["estado"]) ?>-state-left'>
            <div class='task-info'>
                <div class='task-data'><?= $tarea["NombreTarea"] ?></div>
                <div class='task-data'>
                    <div class="fechas">
                        <span class="label">Fecha final:</span>
                        <?php if(isset($tarea["fechaFinal"])): ?>
                            <span class="date"><?= $tarea["fechaFinal"]; ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class='task-data'>
                    <span class='days-remaining'></span>
                    <span class='days-message'>días para la fecha final</span>
                </div>
                <div class='task-data'>
                    <span class='task-state <?= getTaskStateClass($tarea["estado"]) ?>'>
                        <?= $tarea["estado"] ?>
                    </span>
                </div>
            </div>
        </a>
    <?php endforeach; ?>
</div>







                <div class="right-section">
                    <h2>Todas las tareas</h2>
                    <ul class="task-list">
                        <?php
                        if (isset($tareas)) {
                            foreach ($tareas as $tarea) {
                                echo "<li class='task-item'>";
                                $idProyecto = $infoProyecto['idProyecto'];
;
                                echo "<a href='detalleTarea.php?idTarea=" . $tarea["idTarea"] . "' class='upcoming-task " . strtolower($tarea["estado"]) . "-state-left'>";


                                echo "<div class='task-header'>";
                                echo "<div class='task-name'>" . $tarea["NombreTarea"] . "</div>";
                                echo "<div class='task-description'>" . $tarea['DescripcionTarea'] . "</div>";
                                echo "<div class='task-state " . getTaskStateClass($tarea["estado"]) . "'>" .
                                    $tarea["estado"] . "</div>";
                                echo "</div>";
                                echo "</a>";
                                echo "</li>";
                            }
                        }
                        ?>
                    </ul>
                </div>



            </div>
        </main>

    </section>
   <script>
    document.addEventListener("DOMContentLoaded", function() {
        var upcomingTasks = document.querySelectorAll('.upcoming-task');

        upcomingTasks.forEach(function(task) {
            var dueDateElement = task.querySelector('.task-data:nth-child(2) .date');
            var daysRemainingElement = task.querySelector('.days-remaining');
            var daysMessageElement = task.querySelector('.days-message');
            var taskStatusElement = task.querySelector('.task-data:last-child');

            var dueDate = new Date(dueDateElement.textContent);
            var currentDate = new Date();

            var timeDifference = dueDate.getTime() - currentDate.getTime() + (24 * 60 * 60 * 1000) - 1;
            var daysRemaining = Math.floor(timeDifference / (1000 * 3600 * 24));

            daysRemainingElement.textContent = daysRemaining;

            if (daysRemaining <= 3) {
                daysRemainingElement.style.color = 'red';
                daysMessageElement.style.color = 'red';
            }

           
            if (daysRemaining < 0) {
                daysMessageElement.style.display = 'none';
            }
        });
    });
</script>




</body>

</html>