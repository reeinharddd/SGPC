<?php

@include '../../conexion.php';

session_start();

if (!isset($_SESSION['admin_name'])) {
    header('location:../../Alertas/warning.html');
    exit;
}

$current_page = $_SERVER['PHP_SELF'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestión de Proyectos</title>
    <link rel="stylesheet" href="../../css/proyectos.css" />
    <link rel="icon" href="../../img/Logo1.png" type="image/png">
    <script>
        function formatPhoneNumber(input) {
            var phoneNumber = input.value.replace(/\D/g, '');

            var formattedPhoneNumber = phoneNumber.replace(/(\d{3})(\d{3})(\d{4})/, '$1-$2-$3');

            input.value = formattedPhoneNumber;
        }
    </script>

</head>

<body>
  <?PHP
include "../plantillas/header.php";
include "../plantillas/menu.php";
?>
    <main>
        <div class="form-container">

            <form action="addUser.php" method="POST" id="form">
                <h2>Nuevo usuario</h2><br>

                <input id="nombre" type="text" name="name" required pattern="[A-Za-z\s']{2,50}" placeholder="Nombre"><br>
                <input id="apPat" type="text" name="apPat" required pattern="[A-Za-z\s']{2,50}" placeholder="Apellido paterno"><br>
                <input id="apMat" type="text" name="apMat" required pattern="[A-Za-z\s']{2,50}" placeholder="Apellido materno"><br>
                <input id="numero" type="text" name="numero" maxlength="10" required pattern="\d{3}-\d{3}-\d{4}" placeholder="Teléfono" oninput="formatPhoneNumber(this)"><br>
                <input id="email" type="email" name="email" required pattern="[a-z0-9._%+-]+@SGPC\.mx$" placeholder="Correo electrónico"><br>
                <select name="user_type"><br>
                    <option value="1">Administrador</option>
                    <option value="2">Arquitecto</option>
                    <option value="3">Empleado</option>
                </select><br>
                <input type="submit" name="submit" value="Registrar" class="form-btn" form="form">
            </form>
        </div>

    </main>

</body>

</html>