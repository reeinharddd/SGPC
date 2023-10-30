<?php

@include 'config.php';

session_start();

if (!isset($_SESSION['admin_name'])) {
    header('location:../../Alertas/warning.html');
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <title>Gestión de Proyectos</title>
    <link rel="stylesheet" href="">
</head>

<body>

    <div class="hero">
        <a href="../index.php">Regresar al menú</a>
        <h1 class="colortexto">Registro de Proyectos</h1>
        <form method="post" action="addProyecto.php" class="colortexto">
            <label>Nombre del proyecto: * <input type="text" name="txtNombre"></label>
            <br>
            <label>Descripción del proyecto: * <input type="text" name="txtDes"></label>
            <br>
            <label>Ubicación del proyecto: * <input type="text" name="txtUbi"></label>
            <br>
            <label>Fecha de inicio: *<input type="date" name="F-inicio"></label>
            <br>
            <label>Fecha de finalización: *<input type="date" name="F-fin"></label>
            <br>
            <label>Estado del proyecto: *
                <select name="estado">
                    <?php
                    include '../../conexion.php';
                    $conexion = new conexion();
                    if ($conexion->connect()) {
                        $con = $conexion->getConexion();

                        $query = "SELECT * FROM Estado";
                        $resultado = $conexion->exeqSelect($query);
                        var_dump($resultado);

                        if ($resultado) {
                            while ($row = mysqli_fetch_array($resultado)) {
                                echo "<option value='" . $row['Codigo'] . "'>" . $row['nombre'] . "</option>";
                            }
                        } else {
                            echo "Erro en la consulta: " . mysqli_error($con);
                        }
                    } else {
                        echo "Error en la conexión: " . mysqli_error($con);
                    }
                    ?>
                </select>

            </label>
            <br>

            <input type="reset" value="Cancel">
            <input type="submit" value="Send">
        </form>
        <nav>
            <button>Roles y permisos</button>
        </nav>
    </div>

</body>

</html>