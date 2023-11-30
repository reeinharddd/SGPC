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
    <link rel="stylesheet" href="../../css/full.css" />
    <link rel="icon" href="../../img/Logo1.png" type="image/png">
</head>

<body>
    <?php
    include "../plantillas/header.php";
    include "../plantillas/menu.php";
    ?>

    <main >
            <h1>Crear Proyecto</h1>
            <h3>Complete el formulario a continuación:</h3>
        
        <div class="row body">
            <form id="datos" method="post" action="addProyecto.php">
                <ul>
                    <li>
                        <p>
                            <label for="txtNombre" class="left">Nombre del proyecto: *</label>
                            <input type="text" name="txtNombre" id="txtNombre" required placeholder="Máx. 100 caracteres" />
                        </p>
                        <p class="pull-right">
                            <label for="txtDes" class="right">Descripción del proyecto: *</label>
                            <input type="text" name="txtDes" id="txtDes" required placeholder="Máx. 200 caracteres" />
                        </p>
                    </li>
                    <li>
                        <p>
                            <label for="txtUbi">Ubicación del proyecto: *</label>
                            <input type="text" name="txtUbi" id="txtUbi" required placeholder="Máx. 100 caracteres" />
                        </p>
                    </li>
                    <li>
                        <p>
                            <label for="fechaInicio" class="left">Fecha de inicio: *</label>
                            <input type="date" name="F-inicio" id="fechaInicio" required />
                        </p>
                        <p class="pull-right">
                            <label for="fechaFin" class="right">Fecha de finalización: *</label>
                            <input type="date" name="F-fin" id="fechaFin" required />
                        </p>
                    </li>
                    <li>
                        <p>
                            <label for="estado">Estado del proyecto: *</label>
                            <select name="estado" id="estado">
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
                        </p>
                    </li>
                    <li>
                        <input class="btn btn-submit" type="reset" value="Limpiar" />
                        <input class="btn btn-submit" type="submit" value="Crear" />
                    </li>
                </ul>
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
        </div>
    </main>
</body>

</html>
