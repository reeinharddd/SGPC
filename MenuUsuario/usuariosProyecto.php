<?php


$current_page = basename($_SERVER['PHP_SELF']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyectos</title>
    <link rel="stylesheet" href="../css/proyectos.css">
    <link rel="icon" href="../img/Logo1.png" type="image/png">
</head>

<body>

</body>
<?php
include "plantillas/header.php";
?>
<?php
$_SESSION['idProyecto'] = $_GET['idProyecto'];
include "plantillas/miniBar.php";
?>
<section>
    <?php include "plantillas/menu.php"; ?>
    <main>
        <div class="project-list">

            <?php
            echo "Usuarios";
            ?>

        </div>
    </main>
</section>