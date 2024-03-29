<?php

@include 'config.php';

session_start();

if (!isset($_SESSION['admin_name'])) {
   header('location:../../Alertas/warning.html');
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial</title>
    <link rel="stylesheet" href="../../css/Historial.css">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="icon" href="../../img/Logo1.png" type="image/png">
</head>

<body>
    <?PHP
include "../plantillas/header.php";
include "../plantillas/menu.php";
?>
    <main>
        <?php
        include "../../conexion.php";
        $conexion = new conexion();
        if ($conexion->connect()) {
            $con = $conexion->getConexion();
            $sql = "SELECT * FROM Modificacion";
            $result = $conexion->exeqSelect($sql);
            if ($result) {
                echo "<table border='1' class = 'HistoryTable'>"; 
                echo "<tr><th>ID</th><th>Descripción</th><th>Fecha</th><th>Acción</th></tr>";
            
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>".$row["idModificacion"]."</td>";
                    echo "<td>".$row["descripcionModificacion"]."</td>";
                    echo "<td>".$row["fechaModificacion"]."</td>";
                    echo "<td>".$row["accion"]."</td>";
                    echo "</tr>";
                } 
                echo "</table>";
            }
        }
        ?>
    </main>
</body>

</html>