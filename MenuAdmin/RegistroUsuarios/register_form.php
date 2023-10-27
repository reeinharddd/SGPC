<?php

@include 'config.php';

session_start();

if (!isset($_SESSION['admin_name'])) {
   header('location:../../InicioSesion/index.html');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Registrar</title>

   <link rel="stylesheet" href="style.css">

</head>

<body>

   <div class="form-container">

      <form action="addUser.php" method="post" id = "form">
         <h3>Registrar</h3>

         <input id = "nombre"type="text" name="name" required pattern="[A-Za-z\s']{2,50}" placeholder="Nombre"><br>
         <input id = "apPat" type="text" name="apPat" required pattern="[A-Za-z\s']{2,50}" placeholder="Apellido paterno"><br>
         <input id = "apMat" type="text" name="apMat" required pattern="[A-Za-z\s']{2,50}" placeholder="Apellido materno"><br>
         <input id = "numero" type="text" name="numero" required pattern="[0-9-\s]{7,20}" placeholder="Telefono"><br>
         <input id = "email" type="email" name="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="Correo electronico"><br>
         <input id = "password" type="password" name="password" required
            pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&*!])[A-Za-z\d@#$%^&*!]{8,}$" placeholder="Contraseña"><br>
         <input type="password" name="cpassword" required
            pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&*!])[A-Za-z\d@#$%^&*!]{8,}$" placeholder="Confirmacion"><br>
         <select name="user_type"><br>
            <option value="1">Administrador</option>
            <option value="3">Arquitecto</option>
            <option value="2">Empleado</option>
         </select><br>
         <input type="submit" name="submit" value="Registrar" class="form-btn">
      </form>
   </div>

</body>

</html>