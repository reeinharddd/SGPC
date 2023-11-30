<?php
session_start();
$current_page = $_SERVER['PHP_SELF'];
if (!isset($_SESSION['admin_name']) && !isset($_SESSION['arqui_name'])) {
    header('location:../../Alertas/warning.html');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/addTarea.css" />
</head>

<body>
    <?php
    include "../plantillas/header.php";
    include "../plantillas/menu.php";
    ?>
    <main>
        <?php
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

                    $queryUsuariosProyecto = "SELECT u.*, t.rol as nombreTipoUsuario
                        FROM Usuario u
                        INNER JOIN UsuarioProyecto up ON u.idUsuario = up.idUsuario
                        INNER JOIN TipoUsuario t ON u.idTipoUsuario = t.idTu
                        WHERE up.idProyecto = $idProyecto
                        ORDER BY t.idTu";
                    $resultUsuariosProyecto = $conexion->exeqSelect($queryUsuariosProyecto);

                    if ($resultUsuariosProyecto->num_rows > 0) {
                        echo "<h2>Usuarios en el Proyecto: $nombreProyecto</h2>";
                        echo "<h3>Seleccione uno</h3>";

                        echo "<div class='proyecto-links'>";
                        $tipoUsuarioActual = "";
                        while ($rowUsuario = mysqli_fetch_array($resultUsuariosProyecto)) {
                            $idUsuario = $rowUsuario['idUsuario'];
                            $nombreUsuario = $rowUsuario['nombre'];
                            $apellidoPat = $rowUsuario['apellidoPat'];
                            $apellidoMat = $rowUsuario['apellidoMat'];
                            $numTel = $rowUsuario['numTel'];
                            $email = $rowUsuario['email'];
                            $nombreTipoUsuario = $rowUsuario['nombreTipoUsuario'];

                            if ($nombreTipoUsuario != $tipoUsuarioActual) {
                                echo "<hr>";
                                $tipoUsuarioActual = $nombreTipoUsuario;
                            }

                            echo "<a class='proyecto-link' href='crearTareaForm.php?idUsuario=$idUsuario&idProyecto=$idProyecto'>";
                            echo "<p class='proyecto-info'>ID: $idUsuario</p>";
                            echo "<p class='proyecto-info'>Nombre: $nombreUsuario $apellidoPat $apellidoMat</p>";
                            echo "<p class='proyecto-info'>Teléfono: $numTel</p>";
                            echo "<p class='proyecto-info'>Email: $email</p>";
                            echo "<p class='proyecto-info'>Tipo Usuario: $nombreTipoUsuario</p>";
                            echo "</a>";
                        }
                        echo "</div>";
                    } else {
                        echo "<p class='no-users-message'>No hay usuarios asignados al proyecto.</p>";
                    }
                } else {
                    echo "<p class='no-project-message'>No se encontró el proyecto.</p>";
                }

                $conexion->close();
            } else {
                echo "<p class='db-error-message'>Error en la conexión a la base de datos.</p>";
            }
        } else {
            echo "<p class='no-id-message'>ID del proyecto no proporcionado.</p>";
        }
        ?>
    </main>
</body>

</html>
