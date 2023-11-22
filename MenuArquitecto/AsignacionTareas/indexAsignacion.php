<?php

@include 'config.php';

session_start();

if (!isset($_SESSION['arqui_name'])) {
   header('location:../../Alertas/warning.html');
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Asignación de Tareas</title>
        <link rel="stylesheet" href="../../css/main.css" />
        <link rel="icon" href="../../img/Logo1.png" type="image/png">
    </head>
    <header class="header">
        <div class="logo">
            <img src="../../img/Logo1.png" alt="Logo de la empresa">
        </div>
        <div class="user-info">
        <h3>Asignación de Tareas</h3>
        </div>
        <div class="user-info">
            <img src="../../img/account-icon-user-icon-vector-graphics_292645-552.avif" alt="Nombre del usuario">
            <h3><?php echo $_SESSION['arqui_name']; ?> <p>Arquitecto</p>
            </h3>

        </div>
    </header>
    
    <body>
        <div class="hero">
        <button><a href="../index.php">◄ Menú</a></button>
            <p>Ingrese el ID del empleado al que quiere asignar una tarea, utilizando el número de la tarea.</p>
            <form method="post" action="addAsignar.php" class="colortexto">
            <br>

                <label>ID Empleado: *<input type="text" name="IDU" required 
                placeholder="max. 40 caracteres"></label>
                <br>
                <label>Número Tarea: *<input type="text" name="IDT"></label>
                <br>
                <input type="reset" value="Cancel">
                <input type="submit" value="Send">
            </form>
        </div>
        
    </body>
</html>