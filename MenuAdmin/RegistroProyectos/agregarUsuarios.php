<?php
session_start();
$current_page = $_SERVER['PHP_SELF'];

if (!isset($_SESSION['admin_name'])) {
    header('location:../../Alertas/warning.html');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/proyectos.css" />


</head>

<body>
    <?PHP
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
             $queryUsuariosAsignados = "SELECT idUsuario FROM UsuarioProyecto WHERE idProyecto = $idProyecto";
                $resultUsuariosAsignados = $conexion->exeqSelect($queryUsuariosAsignados);
                $usuariosAsignados = [];
                while ($rowAsignado = mysqli_fetch_array($resultUsuariosAsignados)) {
                    $usuariosAsignados[] = $rowAsignado['idUsuario'];
                }
            $queryProyecto = "SELECT * FROM Proyecto WHERE idProyecto = $idProyecto";
            $resultProyecto = $conexion->exeqSelect($queryProyecto);

            if ($resultProyecto->num_rows > 0) {
                $rowProyecto = $resultProyecto->fetch_assoc();
                $nombreProyecto = $rowProyecto['nombre'];

                  $queryUsuarios = "SELECT u.*, t.rol as nombreTipoUsuario
                                  FROM Usuario u
                                  INNER JOIN TipoUsuario t ON u.idTipoUsuario = t.idTu
                                  WHERE u.idTipoUsuario != 1";
                $resultUsuarios = $conexion->exeqSelect($queryUsuarios);

                if ($resultUsuarios->num_rows > 0) {
                    echo "<h1 class='project-title'>Agregar Usuarios al Proyecto: $nombreProyecto</h1>";
                    echo "<form action='procesarUsuarios.php' method='post'>";
                    echo "<input type='hidden' name='idProyecto' value='$idProyecto'>";
  $tipoUsuarioActual = "";
                    while ($rowUsuario = mysqli_fetch_array($resultUsuarios)) {
                        $idUsuario = $rowUsuario['idUsuario'];
                        $nombreUsuario = $rowUsuario['nombre'];
                        $apellidoPat = $rowUsuario['apellidoPat'];
                        $apellidoMat = $rowUsuario['apellidoMat'];
                        $numTel = $rowUsuario['numTel'];
                        $email = $rowUsuario['email'];
                        $nombreTipoUsuario = $rowUsuario['nombreTipoUsuario'];
                          if (!in_array($idUsuario, $usuariosAsignados)) {
                                if ($nombreTipoUsuario != $tipoUsuarioActual) {
                                    
                                    echo "<hr>";
                                    $tipoUsuarioActual = $nombreTipoUsuario;
                                }

                        echo "<label class='user-checkbox'><input type='checkbox' name='usuarios[]' value='$idUsuario'>
        $nombreUsuario $apellidoPat $apellidoMat - Teléfono: $numTel - Email: $email - Tipo Usuario:
        $nombreTipoUsuario</label><br>";
                    }
                    }
                    echo "<input type='submit' value='Agregar Usuarios' class='details-button'>";
                    echo "</form>";
                } else {
                    echo "<p class='no-users-message'>No hay usuarios disponibles.</p>";
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
     <script>
    function validarFormulario() {
        var checkboxes = document.querySelectorAll('input[name="usuarios[]"]:checked');
        var tipoUsuarioValido = false;

        for (var i = 0; i < checkboxes.length; i++) {
            var labelText = checkboxes[i].parentNode.textContent;

            if (labelText.includes("arquitecto") || labelText.includes("tipo 2")) {
                tipoUsuarioValido = true;
                break;
            }
        }

        if (checkboxes.length === 0 || !tipoUsuarioValido) {
            alert("Selecciona al menos un usuario y asegúrate de que al menos uno sea arquitecto o tipo 2.");
            return false;
        }

        return true;
    }
</script>
    </main>

</body>

</html>