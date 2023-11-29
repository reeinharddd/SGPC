<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGPC</title>
    <link rel="stylesheet" href="../../css/plantillas.css">
     <link rel="icon" href="../../img/bricks.svg" type="image/svg+xml"></head>

<body>
    <header class="header">
        <?php if (isset($_SESSION['arqui_name']) && $current_page !== 'index.php') : ?>
            <div class="back-link">
                <a href="javascript:history.go(-1);">
                    <img src="left-arrow.svg" alt="Flecha de regreso">
                </a>
            </div>
        <?php endif; ?>

       <div class="logo">
            <img src="../../img/bricks.svg" alt="Logo de la empresa">
            <span class="company-name">SGPC</span>

        </div>

        <div class="user-info">
            <img src="../img/account-icon-user-icon-vector-graphics_292645-552.avif" alt="Nombre del usuario">
            <h3><?php echo $_SESSION['arqui_name']; ?>
                <p>Arquitecto</p>
            </h3>
        </div>




    </header>
</body>