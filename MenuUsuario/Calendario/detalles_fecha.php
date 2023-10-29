<?php

@include 'config.php';

session_start();

if (!isset($_SESSION['user_name'])) {
   header('location:../../Alertas/warning.html');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Fecha</title>
</head>
<body>
    <a href="../../index.php">Regresar al menú</a>
    <h1>Detalles de la Fecha</h1>
    <p id="fechaSeleccionada">Cargando fecha...</p>

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const day = urlParams.get('day');
        const month = urlParams.get('month');
        const year = urlParams.get('year');

        document.getElementById('fechaSeleccionada').textContent = `Has seleccionado: ${day}/${month}/${year}`;
    </script>
</body>
</html>