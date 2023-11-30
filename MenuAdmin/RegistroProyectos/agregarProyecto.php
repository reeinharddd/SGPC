<?php

@include 'config.php';

session_start();
$current_page = basename($_SERVER['PHP_SELF']);
if (!isset($_SESSION['admin_name'])) {
    header('location:../../Alertas/warning.html');
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestión de Proyectos</title>
    <link rel="stylesheet" href="../../css/proyectos.css" />
    <link rel="icon" href="../../img/Logo1.png" type="image/png">
</head>


<body>
    <?PHP
include "../plantillas/header.php";
include "../plantillas/menu.php";
?>


    <main>
<h1>Crear Proyecto
        </h1>
        <form id="datos" method="post" action="addUnProyecto.php" class="colortexto">
            <br>

            <label>Nombre del proyecto: * <input type="text" name="txtNombre" required
                    placeholder="max. 100 caracteres"></label>
            <br>
            <label>Descripción del proyecto: * <input type="text" name="txtDes" required
                    placeholder="max. 200 caracteres"></label>
            <br>
            <label>Ubicación del proyecto: * <input type="text" name="txtUbi" required
                    placeholder="max. 100 caracteres"></label>
            <br>
            <label class="project-date">Fecha de inicio: *<input type="date" name="F-inicio" id="fechaInicio" required></label>
            <br>
             <label class="project-date">Fecha de finalización: *<input type="date" name="F-fin" id="fechaFin" required></label>
            <br>
             <label class="project-state">Estado del proyecto: *
                <select name="estado">
                    <?php
                    include '../../conexion.php';
                    $conexion = new conexion();
                    if ($conexion->connect()) {
                        $con = $conexion->getConexion();

                        $query = "SELECT * FROM Estado";
                        $resultado = $conexion->exeqSelect($query);

                        if ($resultado) {
                            while ($row = mysqli_fetch_array($resultado)) {
                                 if ($row['codigo'] !== 'FIN' && $row['codigo'] !== 'CAN') {
                                echo "<option value='" . $row['codigo'] . "'>" . $row['nombre'] . "</option>";
                                 }
                            }
                            } else {
                                echo "Error en la consulta: " . mysqli_error($con);
                            }
                        } else {
                            echo "Error en la conexión: " . mysqli_error($con);
                        }
                        ?>
                </select>

            </label>
            <br>

            <input type="reset" value="Limpiar" class="details-button">
            <input type="submit" value="Crear" class="details-button">
        </form>
       <script>
            document.getElementById("datos").addEventListener("submit", function(event) {
                const fechaInicio = new Date(document.getElementById("fechaInicio").value +
                    "T00:00:00");
                const fechaFin = new Date(document.getElementById("fechaFin").value +
                    "T00:00:00");
                const fechaActual = new Date();

                if (fechaInicio <= fechaActual) {
                    alert("La fecha de inicio debe ser posterior al día actual.");
                    event.preventDefault();
                } else if (fechaFin < fechaInicio) {
                    alert("La fecha de fin debe ser posterior o igual a la fecha de inicio.");
                    event.preventDefault();
                }
            });
        </script>
    </main>

</body>

</html>