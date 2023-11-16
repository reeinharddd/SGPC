<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesion</title>
    <link rel="stylesheet" href="../css/inicioSesion.css">

</head>

<body>

    <div class="box">
        <span class="borderLine"></span>
        <form action="login.php" method="post" class="formulario">
            <a href="../index.html">Volver al menu principal</a>
            <?php
            session_start();
            include('user.php');
            if (isset($_SESSION['error']) && $_SESSION['error'] === true) {
                echo "<div class='error-message'>Email o Contraseña incorrecto</div>";
                unset($_SESSION['error']);
            }
            ?>
            <h2>Iniciar Sesion</h2>
            <div class="inputBox">
                <input type="email" name="email" required="required">
                <span>Email</span>
                <i></i>
            </div>
            <div class="inputBox">
                <input type="password" name="password" required="required">
                <span>Contrasena</span>
                <i></i>
            </div>
            <div class="links">

            </div>
            <input type="submit" value="Iniciar Sesion">
        </form>
    </div>
    </div>
</body>

</html>