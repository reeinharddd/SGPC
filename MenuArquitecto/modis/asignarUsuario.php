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

            if (!$resultUsuarioProyecto) {
                 mysqli_error($conexion->getConexion());
            }
        }

        echo "Usuarios asignados exitosamente al proyecto.";
        echo "<a href='../index.php'>Volver al menú☻";
    } else {
        echo "Datos del formulario incompletos.";
    }

    $conexion->close();
} else {
    echo "Error en la conexión a la base de datos.";
}
?>