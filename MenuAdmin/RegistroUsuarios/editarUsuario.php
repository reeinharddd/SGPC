<?php

@include 'config.php';

session_start();
$current_page = basename($_SERVER['PHP_SELF']);
if (!isset($_SESSION['admin_name'])) {
    header('location:../../Alertas/warning.html');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestión de Proyectos</title>
    <link rel="stylesheet" href="../../css/proyectos.css" />
    <link rel="icon" href="../../img/Logo1.png" type="image/png">
</head>


<body>
     <?PHP
include "../plantillas/header.php";
include "../plantillas/menu.php";
?>
    <main><?php

            include '../../conexion.php';
            $conexion = new conexion();

            if ($conexion->connect()) {
                if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['idUsuario'])) {
                    $idUsuario = $_GET['idUsuario'];

                    $queryUsuario = "SELECT * FROM Usuario WHERE idUsuario = $idUsuario";
                    $resultUsuario = $conexion->exeqSelect($queryUsuario);

                    if ($resultUsuario->num_rows > 0) {
                        $rowUsuario = mysqli_fetch_array($resultUsuario);
                        $nombreUsuario = $rowUsuario['nombre'];
                        $apellidoPaterno = $rowUsuario['apellidoPat'];
                        $apellidoMaterno = $rowUsuario['apellidoMat'];
                        $telefonoUsuario = $rowUsuario['numTel'];
                        $emailUsuario = $rowUsuario['email'];
                        $tipoUsuario = $rowUsuario['idTipoUsuario'];
                        $contrasenaUsuario = $rowUsuario['contrasena'];

                        $queryTipoUsuario = "SELECT * FROM TipoUsuario";
                        $resultTipoUsuario = $conexion->exeqSelect($queryTipoUsuario);

                        echo "<h2>Editar Información de Usuario</h2>";
                        echo "<form action='guardarCambioUsuario.php' method='POST'>";
                        echo "<input type='hidden' name='idUsuario' value='$idUsuario'>";
                        echo "<label>Nombre: <input type='text' name='nombre' value='$nombreUsuario'></label><br>";
                        echo "<label>Apellido Paterno: <input type='text' name='apellidoPaterno' value='$apellidoPaterno'></label><br>";
                        echo "<label>Apellido Materno: <input type='text' name='apellidoMaterno' value='$apellidoMaterno'></label><br>";
                        echo "<label>Teléfono: <input type='text' name='telefono' value='$telefonoUsuario'></label><br>";
                        echo "<label>Email: <input type='text' name='email' value='$emailUsuario'></label><br>";
                        echo "<label>Contraseña: <input type='text' name='contrasena' value='$contrasenaUsuario'></label><br>";
                        echo "<label>Tipo de Usuario: ";
                        echo "<select name='tipoUsuario'>";
                        while ($rowTipoUsuario = mysqli_fetch_array($resultTipoUsuario)) {
                            $idTu = $rowTipoUsuario['idTu'];
                            $rol = $rowTipoUsuario['rol'];
                            echo "<option value='$idTu' " . ($tipoUsuario == $idTu ? 'selected' : '') . ">$rol</option>";
                        }
                        echo "</select></label><br>";
                        echo "<input type='submit' value='Guardar Cambios'>";
                        echo "</form>";
                    } else {
                        echo "<p>No se encontró el usuario.</p>";
                    }
                } else {
                    echo "<p>Parámetros incorrectos.</p>";
                }

                $conexion->close();
            } else {
                echo "<p>Error en la conexión a la base de datos.</p>";
            }
            ?>
    </main>
</body>

</html>