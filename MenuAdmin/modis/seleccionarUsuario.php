<?php
session_start();

if (!isset($_SESSION['admin_name']) && !isset($_SESSION['arqui_name'])) {
    header('location:../../Alertas/warning.html');
}

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

                echo "<label><input type='checkbox' name='usuarios[]' value='$idUsuario'> $nombreUsuario</label><br>";
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