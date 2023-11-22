<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idProyecto']) && isset($_POST['usuarios'])) {
    $idProyecto = $_POST['idProyecto'];
    $usuariosSeleccionados = $_POST['usuarios'];

    include("../../conexion.php");
    $conexion = new conexion();

    if ($conexion->connect()) {
        mysqli_begin_transaction($conexion->getConexion());

        try {
            $queryEliminar = "DELETE FROM UsuarioProyecto WHERE idProyecto = $idProyecto";
            $conexion->exeqUpdate($queryEliminar);

            foreach ($usuariosSeleccionados as $idUsuario) {
                $queryInsertar = "INSERT INTO UsuarioProyecto (idUsuario, idProyecto) VALUES ($idUsuario, $idProyecto)";
                $conexion->exeqInsert($queryInsertar);
            }

            mysqli_commit($conexion->getConexion());
            header("Location: usuariosAsignados.php?idProyecto=$idProyecto");
            exit();
        } catch (Exception $e) {
            mysqli_rollback($conexion->getConexion());
            echo "Error: " . $e->getMessage();
        }

        $conexion->close();
    } else {
        echo "Error en la conexión a la base de datos.";
    }
} else {
    echo "Datos incorrectos o no proporcionados.";
}
