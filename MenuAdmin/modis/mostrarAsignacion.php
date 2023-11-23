<?php
session_start();

if (!isset($_SESSION['admin_name']) && !isset($_SESSION['arqui_name'])) {
    header('location:../../Alertas/warning.html');
}

include("../../conexion.php");
$conexion = new conexion();

if ($conexion->connect()) {
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['idProyecto'])) {
        $idProyecto = $_GET['idProyecto'];

        $queryProyecto = "SELECT * FROM Proyecto WHERE idProyecto = $idProyecto";
        $resultProyecto = $conexion->exeqSelect($queryProyecto);

        if ($resultProyecto->num_rows > 0) {
            $rowProyecto = mysqli_fetch_array($resultProyecto);
            $nombreProyecto = $rowProyecto['nombre'];

            echo "<h2>Detalles de la Asignación</h2>";
            echo "<p><strong>Proyecto:</strong> $nombreProyecto</p>";

            $queryUsuarios = "SELECT Usuario.* FROM Usuario 
                              INNER JOIN UsuarioProyecto ON Usuario.idUsuario = UsuarioProyecto.idUsuario
                              WHERE UsuarioProyecto.idProyecto = $idProyecto";
            $resultUsuarios = $conexion->exeqSelect($queryUsuarios);

            if ($resultUsuarios->num_rows > 0) {
                echo "<p><strong>Usuarios Asignados:</strong></p>";
                echo "<ul>";
                while ($rowUsuario = mysqli_fetch_array($resultUsuarios)) {
                    $nombreUsuario = $rowUsuario['nombre'];
                    echo "<li>$nombreUsuario</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>No hay usuarios asignados en esta operación.</p>";
            }

            echo "<a href='../index.php'>Volver al Menú Principal</a><br>";
            echo "<a href='seleccionarUsuario.php?idProyecto=$idProyecto'>Asignar Otros Usuarios</a>";

        } else {
            echo "<p>No se encontró el proyecto.</p>";
        }
    } else {
        echo "<p>Parámetros incorrectos.</p>";
    }

    $conexion->close();
} else {
    echo "<p>Error en la conexión a la base de datos.</p>";
}