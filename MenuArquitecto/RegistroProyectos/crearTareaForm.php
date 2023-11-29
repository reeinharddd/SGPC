<?php
session_start();

if (!isset($_SESSION['admin_name']) && !isset($_SESSION['arqui_name'])) {
    header('location:../../Alertas/warning.html');
}

if (isset($_GET['idUsuario']) && isset($_GET['idProyecto'])) {
    $idUsuario = $_GET['idUsuario'];
    $idProyecto = $_GET['idProyecto'];

    echo "<h2>Crear Tarea para Usuario</h2>";
    echo "<form method='post' action='crearTareaProcesar.php'>";
    echo "<label>Título: <input type='text' name='titulo' required></label><br>";
    echo "<label>Descripción: <input type='text' name='descripcion' required></label><br>";
    echo "<label>Fecha de Inicio: <input type='date' name='fechaInicio' required></label><br>";
    echo "<label>Fecha de Finalización: <input type='date' name='fechaFinal' required></label><br>";
    echo "<input type='hidden' name='idUsuario' value='$idUsuario'>";
    echo "<input type='hidden' name='idProyecto' value='$idProyecto'>";
    echo "<input type='submit' value='Crear Tarea'>";
    echo "</form>";

    
} else {
    echo "ID del usuario o del proyecto no proporcionado.";
}
?>