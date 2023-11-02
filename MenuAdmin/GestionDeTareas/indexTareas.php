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
            <button><b><a href="../index.php">Regresar al menú</a></b></button>
            <h1 class="colortexto">Registro de Tareas</h1>
            <form id="datos" method="post" action="addTarea.php" class="colortexto">
                
                <label>Código de la Tarea: *<input type="text" name="Cod" required 
                pattern="[A-Za-z\s']{2,50}" placeholder="max. 4 caracteres"></label>
                <br>
                <label>Nombre de la Tarea: *<input type="text" name="Nombre" required 
                pattern="[A-Za-z\s']{2,50}" placeholder="max. 40 caracteres"></label>
                <br>
                <label>Descripción de la Tarea: *<input type="text" name="Des" required 
                pattern="[A-Za-z\s']{2,50}" placeholder="max. 100 caracteres"></label>
                <br>
                <label>Fecha de inicio: *<input type="date" name="F-inicio" id="fechaInicio" required></label>
                <br>
                <label>Fecha de finalización: *<input type="date" name="F-fin" id="fechaFin" required></label>
                <br>
                <label>Estado de la Tarea: *<input type="text" name="estado" required 
            pattern="[A-Za-z\s']{2,50}" placeholder="max. 5 caracteres"></label>
        
                <input type="reset" value="Cancel">
                <input type="submit" value="Send">
            </form>
            <script>
            document.getElementById("datos").addEventListener("submit", function(event) {
            const fechaInicio = new Date(document.getElementById("fechaInicio").value);
            const fechaFin = new Date(document.getElementById("fechaFin").value);
            const fechaActual = new Date();

            if (fechaInicio < fechaActual) {
                alert("La fecha de inicio no puede ser anterior al día actual.");
                event.preventDefault();
            } else if (fechaFin < fechaInicio) {
                alert("La fecha de fin no puede ser anterior a la fecha de inicio.");
                event.preventDefault();
            }
            });
            </script>
        </div>
        
    </body>
</html>