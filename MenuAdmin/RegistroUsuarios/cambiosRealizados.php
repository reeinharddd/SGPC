<?php

session_start();

if (!isset($_SESSION['admin_name'])) {
    header('location:../index.html');
    exit;
}

echo "<!DOCTYPE html>";
echo "<html lang='en'>";
echo "<head>";
echo "<meta charset='UTF-8'>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<title>Cambios Realizados</title>";
echo "<link rel='stylesheet' href='../../css/main.css'>";
echo "<link rel='icon' href='../../img/Logo1.png' type='image/png'>";
echo "</head>";
echo "<body>";

echo "<h2>Cambios realizados correctamente</h2>";
echo "<p>Los cambios en la información del usuario se guardaron correctamente.</p>";

echo "<button><a href='mostrarUsuario.php'>Cambiar información de otro usuario</a></button>";
echo "<button><a href='../index.php'>Ir al índice</a></button>";

echo "</body>";
echo "</html>";