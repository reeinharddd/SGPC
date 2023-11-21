<?php

session_start();

if (!isset($_SESSION['user_name'])) {
    header('location:../Alertas/warning.html');
    exit;
}

$current_page = basename($_SERVER['PHP_SELF']);
include "consultas.php";
$consultas = new Consultas();
$proyectos = $consultas->getProyectosTerminados();  

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGPC</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="icon" href="../img/Logo1.png" type="image/png">
</head>

<body>
    <?php
    include "plantillas/header.php";

    ?>
    <section>

        <?php
        include "plantillas/menu.php";
        ?>
        <main>

            <div class="project-list">
                <?php
                foreach ($proyectos as $proyecto) {

                    echo "<div class='project-box' onclick='redirectToTasks(" . $proyecto["idProyecto"] . ")'>";
                    echo "<div class='project-header'>";
                    echo "<div class='project-title'>" . $proyecto["nombre"] . "</div>";

                    $estadoClass = '';
                    switch ($proyecto['estado']) {
                        case 'ACT':
                            $estadoClass = 'active-state';
                            break;
                        case 'PEN':
                            $estadoClass = 'pending-state';
                            break;
                        case 'FIN':
                            $estadoClass = 'finished-state';
                            break;
                        case 'CAN':
                            $estadoClass = 'canceled-state';
                            break;
                        case 'RET':
                            $estadoClass = 'delayed-state';
                            break;
                    }

                    echo "<div class='project-info'>";
                    echo "<div class='project-state $estadoClass'>" . $proyecto['estado'] . "</div>";
                    echo "</div>";

                    echo "<div class='project-dates'>";
                    echo "<div class='project-date-label'>Fecha Inicio:</div>";
                    echo "<div class='project-date'>" . $proyecto['fechaInicio'] . "</div>";
                    echo "<div class='project-date-label'>Fecha Fin:</div>";
                    echo "<div class='project-date'>" . $proyecto['fechaFinal'] . "</div>";
                    echo "</div>";

                    echo "</div>";
                    echo "</div>";
                }
                ?>
            </div>

        </main>

    </section>
    <script>
    function redirectToTasks(idProyecto) {
        window.location.href = 'Proyectos.php?idProyecto=' + idProyecto;
    }
    </script>

</body>

</html>