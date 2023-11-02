<?php

@include 'config.php';

session_start();

if (!isset($_SESSION['arqui_name'])) {
   header('location:../../Alertas/warning.html');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gestión de Tareas</title>
        <link rel="stylesheet" href="style.css">
        
    </head>
    
    <body>
        <div class="hero">
            <button><a href="../index.php">Regresar al menú</a></button>
            <h1 class="colortexto">Registro de Tareas</h1>
            <form method="post" action="addTarea.php" class="colortexto">
                
                <label>Código de la Tarea: *<input type="text" name="Cod"></label>
                <br>
                <label>Nombre de la Tarea: *<input type="text" name="Nombre"></label>
                <br>
                <label>Descripción de la Tarea: *<input type="text" name="Des"></label>
                <br>
                <label>Fecha de inicio: *<input type="date" name="F-inicio"></label>
                <br>
                <label>Fecha de finalización: *<input type="date" name="F-fin"></label>
                <br>
                <label>Estado de la Tarea: *<input type="text" name="estado"></label>
        
                <input type="reset" value="Cancel">
                <input type="submit" value="Send">
            </form>
        </div>
    </body>
</html>