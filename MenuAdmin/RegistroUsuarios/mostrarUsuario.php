<?php

session_start();

if (!isset($_SESSION['admin_name'])) {
    header('location:../index.html');
    exit;
}

include '../../conexion.php';
$conexion = new conexion();

if ($conexion->connect()) {
    $queryUsuarios = "SELECT * FROM Usuario";
    $resultUsuarios = $conexion->exeqSelect($queryUsuarios);

    if ($resultUsuarios) {
        echo "<h2>Lista de Usuarios</h2>";
        echo "<ul>";
        while ($rowUsuario = mysqli_fetch_array($resultUsuarios)) {
            $idUsuario = $rowUsuario['idUsuario'];
            $nombreUsuario = $rowUsuario['nombre'];
            $apellidoPaterno = $rowUsuario['apellidoPat'];
            $apellidoMaterno = $rowUsuario['apellidoMat'];

            echo "<li><a href='editarUsuario.php?idUsuario=$idUsuario'>$nombreUsuario $apellidoPaterno $apellidoMaterno</a></li>";
        }
        echo "</ul>";
    } else {
        echo "Error en la consulta: " . mysqli_error($conexion->getConexion());
    }

    $conexion->close();
} else {
    echo "Error en la conexión a la base de datos.";
}
?>