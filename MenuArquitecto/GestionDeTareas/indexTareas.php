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
        <title>Gestión de Tareas</title>
        <link rel="stylesheet" href="../../css/main.css" />
        <link rel="icon" href="../../img/Logo1.png" type="image/png">
    </head>
    <header class="header">
        <div class="logo">
            <img src="../../img/Logo1.png" alt="Logo de la empresa">
        </div>
        <div class="user-info">
            <h3>Registro de tareas</h3>
        </div>
        <div class="user-info">
            <img src="../../img/account-icon-user-icon-vector-graphics_292645-552.avif" alt="Nombre del usuario">
            <h3><?php echo $_SESSION['arqui_name']; ?> <p>Arquitecto</p>
            </h3>

        </div>
    </header>
    
    <body>
        <div class="hero">
            
            <form method="post" action="addTarea.php" class="colortexto">
            <button><a href="../index.php">◄ Menú</a></button>
            <br>

                <label>Título de la Tarea: *<input type="text" name="Nombre" required 
                pattern="[A-Za-z\s']{2,50}" placeholder="max. 40 caracteres"></label>
                <br>
                <label>Descripción de la Tarea: *<input type="text" name="Des" required 
                pattern="[A-Za-z\s'´ ()''/,.#]{2,50}" placeholder="max. 100 caracteres"></label>
                <br>
                
                <label>Estado de la Tarea: *
                    <select name="estado">
                        <?php
                        include '../../conexion.php';
                        $conexion = new conexion();
                        if ($conexion->connect()) {
                            $con = $conexion->getConexion();

                            $query = "SELECT * FROM Estado";
                            $resultado = $conexion->exeqSelect($query);
                            var_dump($resultado);

                            if ($resultado) {
                                while ($row = mysqli_fetch_array($resultado)) {
                                    echo "<option value='" . $row['codigo'] . "'>" . $row['nombre'] . "</option>";
                                }
                            } else {
                                echo "Error en la consulta: " . mysqli_error($con);
                            }
                        } else {
                            echo "Error en la conexión: " . mysqli_error($con);
                        }
                        ?>
                    </select>
                </label>
                <br>
                <label>ID Proyecto: *<input type="number" name="IDtarea"></label>
                <input type="reset" value="Cancel">
                <br>
                <input type="submit" value="Send">
            </form>
           
        </div>
        
    </body>
</html>