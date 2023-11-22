<?php
session_start();

if (!isset($_SESSION['admin_name']) && !isset($_SESSION['arqui_name'])) {
    header('location:../../Alertas/warning.html');
}

if (isset($_GET['idProyecto'])) {
    $idProyecto = $_GET['idProyecto'];

    include("../../conexion.php");
    $conexion = new conexion();

    if ($conexion->connect()) {
        $queryProyecto = "SELECT * FROM Proyecto WHERE idProyecto = $idProyecto";
        $resultProyecto = $conexion->exeqSelect($queryProyecto);

        if ($resultProyecto->num_rows > 0) {
            $rowProyecto = $resultProyecto->fetch_assoc();
            $nombreProyecto = $rowProyecto['nombre'];

            $queryUsuarios = "SELECT u.*, t.rol as nombreTipoUsuario 
                              FROM Usuario u
                              INNER JOIN TipoUsuario t ON u.idTipoUsuario = t.idTu";
            $resultUsuarios = $conexion->exeqSelect($queryUsuarios);

            if ($resultUsuarios->num_rows > 0) {
                echo "<h1>Agregar Usuarios al Proyecto: $nombreProyecto</h1>";
                echo "<form action='procesarUsuarios.php' method='post'>";
                echo "<input type='hidden' name='idProyecto' value='$idProyecto'>";

                while ($rowUsuario = mysqli_fetch_array($resultUsuarios)) {
                    $idUsuario = $rowUsuario['idUsuario'];
                    $nombreUsuario = $rowUsuario['nombre'];
                    $apellidoPat = $rowUsuario['apellidoPat'];
                    $apellidoMat = $rowUsuario['apellidoMat'];
                    $numTel = $rowUsuario['numTel'];
                    $email = $rowUsuario['email'];
                    $nombreTipoUsuario = $rowUsuario['nombreTipoUsuario'];

                    echo "<label><input type='checkbox' name='usuarios[]' value='$idUsuario'> 
                          $nombreUsuario $apellidoPat $apellidoMat - Teléfono: $numTel - Email: $email - Tipo Usuario: $nombreTipoUsuario</label><br>";
                }

                echo "<input type='submit' value='Agregar Usuarios'>";
                echo "</form>";
            } else {
                echo "No hay usuarios disponibles.";
            }
        } else {
            echo "No se encontró el proyecto.";
        }

        $conexion->close();
    } else {
        echo "Error en la conexión a la base de datos.";
    }
} else {
    echo "ID del proyecto no proporcionado.";
}
?>