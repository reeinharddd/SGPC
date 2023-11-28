<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGPC</title>
    <link rel="stylesheet" href="../../css/proyectos.css">
    <link rel="icon" href="../../img/Logo1.png" type="image/png">
</head>

<body>
    <header class="header">
        <?php $current_page = basename($_SERVER['PHP_SELF']);
        if (isset($_SESSION['user_name']) && $current_page !== 'index.php') : ?>
        <div class="back-link">
            <a href="javascript:history.go(-1);">
                <img src="../plantillas/left-arrow.svg" alt="Flecha de regreso">
            </a>
        </div>
        <?php endif; ?>

        <div class="logo">
            <img src="../../img/Logo1.png" alt="Logo de la empresa">
        </div>

        <div class="user-info">
            <img src="../../img/account-icon-user-icon-vector-graphics_292645-552.avif" alt="Nombre del usuario">
            <h3><?php echo $_SESSION['user_name']; ?>
                <p>Usuario</p>
            </h3>
        </div>


        <?php if ($current_page == 'index.php') : ?>
        <button class="about-button">¿Qué es esta aplicación?</button>
        <?php endif; ?>

    </header>
</body>