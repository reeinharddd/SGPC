<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Usuarios - SGPC</title>
    <link rel="stylesheet" href="../../css/proyectos.css">
    <link rel="icon" href="../img/Logo1.png" type="image/png">
</head>

<body>
    <?php
    session_start();

    if (!isset($_SESSION['admin_name']) && !isset($_SESSION['arqui_name'])) {
        header('location:../../Alertas/warning.html');
    }

    include("../../conexion.php");
    $conexion = new conexion();

    if ($conexion->connect()) {
        $queryUsuarios = "SELECT * FROM Usuario";
        $resultUsuarios = $conexion->exeqSelect($queryUsuarios);

        if ($resultUsuarios->num_rows > 0) {
            echo "<h2>Selecciona Usuarios</h2>";
            echo "<form method='post' action='asignarUsuario.php'>";
            while ($rowUsuario = mysqli_fetch_array($resultUsuarios)) {
                $idUsuario = $rowUsuario['idUsuario'];
                $nombreUsuario = $rowUsuario['nombre'];

                echo "<label><input type='checkbox' name='usuarios[]' value='$idUsuario'> $nombreUsuario</label><br>";
            }
            echo "<input type='hidden' name='idProyecto' value='{$_GET['idProyecto']}'>";
            echo "<input type='submit' value='Asignar Usuarios'>";
            echo "</form>";
        } else {
            echo "<p>No hay usuarios registrados.</p>";
        }

        $conexion->close();
    } else {
        echo "<p>Error en la conexión a la base de datos.</p>";
    }
    ?>
</body>

</html>