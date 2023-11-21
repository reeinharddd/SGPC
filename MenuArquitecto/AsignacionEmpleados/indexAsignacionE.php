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
        <title>Asignación de Empleados</title>
        <link rel="stylesheet" href="../../css/main.css" />
        <link rel="icon" href="../../img/Logo1.png" type="image/png">
    </head>
    <header class="header">
        <div class="logo">
            <img src="../../img/Logo1.png" alt="Logo de la empresa">
        </div>
        <div class="user-info">
        <h3>Asignación de Empleados</h3>
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
            <p>Ingrese el ID del empleado al que quiere asignar a un proyecto, utilizando el ID del proyecto.</p>
            <form method="post" action="addAsignarE.php" class="colortexto">
            <br>
                <label>ID Proyecto: *<input type="text" name="IDP"></label>
                <br>
                <label>ID Empleado: *<input type="text" name="IDU" required 
                placeholder="max. 40 caracteres"></label>
                <br>
                
                <input type="reset" value="Cancel">
                <input type="submit" value="Send">
            </form>
        </div>
        
    </body>
</html>