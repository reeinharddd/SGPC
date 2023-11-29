<?php
session_start();

if (!isset($_SESSION['admin_name']) && !isset($_SESSION['arqui_name'])) {
    header('location:../../Alertas/warning.html');
}

include("../../conexion.php");
$conexion = new conexion();

if ($conexion->connect()) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['usuarios']) && isset($_POST['idProyecto'])) {
        $idProyecto = $_POST['idProyecto'];
        $usuariosSeleccionados = $_POST['usuarios'];

        foreach ($usuariosSeleccionados as $idUsuario) {
            $queryInsertarUsuarioProyecto = "INSERT INTO UsuarioProyecto (idUsuario, idProyecto) 
                                            VALUES ('$idUsuario', '$idProyecto')";
            $resultUsuarioProyecto = $conexion->exeqInsert($queryInsertarUsuarioProyecto);

            if ($resultUsuarioProyecto < 0) {
                echo "Error al asignar usuario al proyecto: " . mysqli_error($conexion->getConexion());
            }
        }

        header("Location: mostrarAsignacion.php?idProyecto=$idProyecto");
        exit();
    } else {
        echo "Datos del formulario incompletos.";
    }

    $conexion->close();
} else {
    echo "Error en la conexión a la base de datos.";
}
?>