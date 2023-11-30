<?php

session_start();

if (!isset($_SESSION['admin_name'])) {
    header('location:../index.html');
    exit;
}

include '../../conexion.php';
$conexion = new conexion();

if ($conexion->connect()) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idUsuario'])) {
        $idUsuario = $_POST['idUsuario'];
        $nombre = $_POST['nombre'];
        $apellidoPaterno = $_POST['apellidoPaterno'];
        $apellidoMaterno = $_POST['apellidoMaterno'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];
        $contrasena = $_POST['contrasena'];
        $tipoUsuario = $_POST['tipoUsuario'];

        $queryActualizarUsuario = "UPDATE Usuario
                                   SET nombre = '$nombre',
                                       apellidoPat = '$apellidoPaterno',
                                       apellidoMat = '$apellidoMaterno',
                                       numTel = '$telefono',
                                       email = '$email',
                                       contrasena = '$contrasena',
                                       idTipoUsuario = '$tipoUsuario'
                                   WHERE idUsuario = $idUsuario";

        $resultActualizarUsuario = $conexion->exeqUpdate($queryActualizarUsuario);
        if ($resultActualizarUsuario !== false) {
            if ($resultActualizarUsuario === 1) {
                header('location: cambiosRealizados.php');
                exit;
            } else {
                echo "<p>No se realizaron cambios en el usuario.</p>";
            }
        } else {
            echo "<p>Error al actualizar la información del usuario: " . $conexion->getLastError() . "</p>";

        }
    } else {
        echo "<p>Parámetros incorrectos.</p>";
    }
    $conexion->close();
} else {
    echo "<p>Error en la conexión a la base de datos.</p>";
}
