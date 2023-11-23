<?php
include("../../conexion.php");
$conexion = new conexion();

if ($conexion->connect()) {
    $idProyecto = $_GET['idProyecto'];
    $queryUsuariosAsignados = "SELECT u.*, t.rol as nombreTipoUsuario 
                               FROM Usuario u
                               INNER JOIN UsuarioProyecto up ON u.idUsuario = up.idUsuario
                               INNER JOIN TipoUsuario t ON u.idTipoUsuario = t.idTu
                               WHERE up.idProyecto = $idProyecto";
    $resultUsuariosAsignados = $conexion->exeqSelect($queryUsuariosAsignados);

    echo "<h1>Usuarios Asignados al Proyecto</h1>";

    if ($resultUsuariosAsignados->num_rows > 0) {
        while ($rowUsuarioAsignado = mysqli_fetch_array($resultUsuariosAsignados)) {
            echo "<p>ID: " . $rowUsuarioAsignado['idUsuario'] . "</p>";
            echo "<p>Nombre: " . $rowUsuarioAsignado['nombre'] . "</p>";
            echo "<p>Apellido Paterno: " . $rowUsuarioAsignado['apellidoPat'] . "</p>";
            echo "<p>Apellido Materno: " . $rowUsuarioAsignado['apellidoMat'] . "</p>";
            echo "<p>Teléfono: " . $rowUsuarioAsignado['numTel'] . "</p>";
            echo "<p>Email: " . $rowUsuarioAsignado['email'] . "</p>";
            echo "<p>Tipo Usuario: " . $rowUsuarioAsignado['nombreTipoUsuario'] . "</p>";
            echo "------------------------";
        }
    } else {
        echo "No hay usuarios asignados al proyecto.";
    }

    echo "<a href='../index.php'>Terminar</a>";
    echo "<a href='asignarTareas.php?idProyecto=$idProyecto'>Continuar</a>";

    $conexion->close();
} else {
    echo "Error en la conexión a la base de datos.";
}