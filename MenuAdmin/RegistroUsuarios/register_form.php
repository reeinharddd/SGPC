<?php

@include '../../conexion.php';

session_start();

if (!isset($_SESSION['admin_name'])) {
   header('location:../index.html');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>

    <link rel="stylesheet" href="">
    <script>
    function formatPhoneNumber(input) {
        var phoneNumber = input.value.replace(/\D/g, '');

        var formattedPhoneNumber = phoneNumber.replace(/(\d{3})(\d{3})(\d{4})/, '$1-$2-$3');

        input.value = formattedPhoneNumber;
    }
    </script>

</head>

<body>

    <div class="form-container">

        <form action="addUser.php" method="POST" id="form">
            <button><b><a href="../index.php">Regresar al menú</a></b></button>
            <h2>Nuevo usuario</h2><br>

            <input id="nombre" type="text" name="name" required pattern="[A-Za-z\s']{2,50}" placeholder="Nombre"><br>
            <input id="apPat" type="text" name="apPat" required pattern="[A-Za-z\s']{2,50}"
                placeholder="Apellido paterno"><br>
            <input id="apMat" type="text" name="apMat" required pattern="[A-Za-z\s']{2,50}"
                placeholder="Apellido materno"><br>
            <input id="numero" type="text" name="numero" maxlength="10" required pattern="\d{3}-\d{3}-\d{4}"
                placeholder="Telefono (Formato" oninput="formatPhoneNumber(this)"><br>
            <input id="email" type="email" name="email" required pattern="[a-z0-9._%+-]+@SGPC\.mx$"
                placeholder="Correo electrónico"><br>
            <select name="user_type"><br>
                <option value="1">Administrador</option>
                <option value="3">Arquitecto</option>
                <option value="2">Empleado</option>
            </select><br>
            <input type="submit" name="submit" value="Registrar" class="form-btn" form="form">
        </form>
    </div>



</body>

</html>