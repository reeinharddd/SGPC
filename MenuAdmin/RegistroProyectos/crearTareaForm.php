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
    <link rel="stylesheet" href="../../css/proyectos.css" />

</head>

<body>
    <?PHP
include "../plantillas/header.php";
include "../plantillas/menu.php";
?>
    <main class="main-section">
        <?php
    if (isset($_GET['idUsuario']) && isset($_GET['idProyecto'])) {
        $idUsuario = $_GET['idUsuario'];
        $idProyecto = $_GET['idProyecto'];

        echo "<h2 class='create-task-title'>Crear Tarea para Usuario</h2>";
        echo "<form method='post' action='crearTareaProcesar.php' class='task-form'>";
        echo "<label>Título: <input type='text' name='titulo' required></label><br>";
        echo "<label>Descripción: <input type='text' name='descripcion' required></label><br>";
        echo "<label>Fecha de Inicio: <input type='date' name='fechaInicio' id='fechaInicio' required></label><br>";
        echo "<label>Fecha de Finalización: <input type='date' name='fechaFinal' id='fechaFinal' required></label><br>";
        echo "<input type='hidden' name='idUsuario' value='$idUsuario'>";
        echo "<input type='hidden' name='idProyecto' value='$idProyecto'>";
        echo "<input type='submit' value='Crear Tarea'>";
        echo "</form>";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $fechaInicio = $_POST['fechaInicio'];
            $fechaFinal = $_POST['fechaFinal'];
        

        echo "<script>
            document.querySelector('.task-form').addEventListener('submit', function (event) {
                const fechaInicio = new Date(document.getElementById('fechaInicio').value);
                const fechaFinal = new Date(document.getElementById('fechaFinal').value);
                const fechaActual = new Date();

                if (fechaInicio < fechaActual) {
                    alert('La fecha de inicio no puede ser anterior al día actual.');
                    event.preventDefault();
                } else if (fechaInicio < new Date('$fechaInicio')) {
                    alert('La fecha de inicio no puede ser anterior a la fecha de inicio del proyecto.');
                    event.preventDefault();
                } else if (fechaFinal < fechaInicio) {
                    alert('La fecha de finalización no puede ser anterior a la fecha de inicio.');
                    event.preventDefault();
                } else if (fechaFinal > new Date('$fechaFinal')) {
                    alert('La fecha de finalización no puede ser posterior a la fecha de finalización del proyecto.');
                    event.preventDefault();
                }
            });
        </script>";
        }
    } else {
        echo "<p class='error-message'>ID del usuario o del proyecto no proporcionado.</p>";
    }
    ?>
    </main>

</body>

</html>