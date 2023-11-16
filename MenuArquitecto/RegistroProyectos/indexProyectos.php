<?php

@include 'config.php';

session_start();

if (!isset($_SESSION['admin_name']) && !isset($_SESSION['arqui_name']) ) {
    header('location:../../Alertas/warning.html');
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestión de Proyectos</title>
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="icon" href="../../img/Logo1.png" type="image/png">
</head>

<header class="header">
    <div class="logo">
        <img src="../../img/Logo1.png" alt="Logo de la empresa">
    </div>
    <div class="user-info">
        <img src="../../img/account-icon-user-icon-vector-graphics_292645-552.avif" alt="Nombre del usuario">
        <h3><?php echo $_SESSION['arqui_name']; ?> <p>Administrador</p>
        </h3>

    </div>
</header>

<body>

    <div class="hero">
        <h1 class="colortexto">Registro de Proyectos</h1>
        <form method="post" action="addProyecto.php" class="colortexto">
        <button><a href="../index.php">◄ Menú</a></button>
        <br>
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
                            echo "Error en la consulta: " . mysqli_error($con);
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
    </div>

</body>

</html>