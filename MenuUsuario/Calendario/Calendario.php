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
    <title>Calendario Interactivo</title>
    <link rel="stylesheet" href="../../css/calendario.css">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="icon" href="../../img/Logo1.png" type = "image/png">
</head>
<body>
    <header class = "header">
        <div><img src="../../img/Logo1.png" alt="" width="100px" height="100px"></div>
        <input type="checkbox" id = "toggle">
        <label for="toggle"> <img src="../../img/menu.svg" alt="menu"></label>
        <nav class = "navigation">
          <ul>
            <li><a href="../index.php">Inicio</a></li>
            <li><a href="#">Proyectos</a>
                <ul>
                    <li><a href="../Proyectos.php">Proyectos vigentes</a></li>
                    <li><a href="../AllProyectos.php">Proyectos completados</a></li>
                </ul>
              </li>
              <li><a href="../Contactos.php">Contacto</a></li>
          </ul>
        </nav>
      </header>
      <div class = "hero">
        <div class="calendar">
        <div class="calendar-header">
            <button id="prevMonth">←</button>
            <span id="currentMonthYear">Octubre 2023</span>
            <button id="nextMonth">→</button>
        </div>
        <div class="calendar-body">
            <!-- Las fechas se insertarán con JavaScript -->
        </div>
    </div>
    
        <script src="script.js"></script></div>
</body>
</html>