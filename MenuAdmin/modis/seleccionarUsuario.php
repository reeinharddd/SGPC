<?php
@include 'config.php';

session_start();
$current_page = basename($_SERVER['PHP_SELF']);
if (!isset($_SESSION['admin_name'])) {
    header('location:../../Alertas/warning.html');
}
?>

<html>

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
    <main>
        <?php
        include("../../conexion.php");
        $conexion = new conexion();
        if ($conexion->connect()) {
            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['idProyecto'])) {
                $idProyecto = $_GET['idProyecto'];

                $queryUsuarios = "SELECT * FROM Usuario WHERE idUsuario NOT IN
            (SELECT idUsuario FROM UsuarioProyecto WHERE idProyecto = '$idProyecto')";
                $resultUsuarios = $conexion->exeqSelect($queryUsuarios);

                if ($resultUsuarios->num_rows > 0) {
                    echo "<h2>Selecciona Usuarios</h2>";
                    echo "<form method='post' action='asignarUsuario.php' onsubmit='return validarFormulario()'>";
                    while ($rowUsuario = mysqli_fetch_array($resultUsuarios)) {
                        $idUsuario = $rowUsuario['idUsuario'];
                        $nombreUsuario = $rowUsuario['nombre'];
                        $apellidoPat = $rowUsuario['apellidoPat'];
                        $apellidoMat = $rowUsuario['apellidoMat'];

                        // Mostrar la información completa del usuario
                        echo "<label><input type='checkbox' name='usuarios[]' value='$idUsuario'> $nombreUsuario $apellidoPat $apellidoMat</label><br>";
                    }
                    echo "<input type='hidden' name='idProyecto' value='$idProyecto'>";
                    echo "<input type='submit' value='Asignar Usuarios'>";
                    echo "</form>";
                } else {
                    echo "<p>No hay usuarios disponibles para asignar.</p>";
                }

                $conexion->close();
            } else {
                echo "<p>Parámetros incorrectos.</p>";
            }
        } else {
            echo "<p>Error en la conexión a la base de datos.</p>";
        }
        ?>
        <script>
            function validarFormulario() {
                var checkboxes = document.getElementsByName('usuarios[]');
                var selected = false;
                for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i].checked) {
                        selected = true;
                        break;
                    }
                }
                if (!selected) {
                    alert("Debes seleccionar al menos un usuario.");
                    return false;
                }
                return true;
            }
        </script>
    </main>
</body>

</html>
