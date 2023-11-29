<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['admin_name'])) {
    header('location:../../Alertas/warning.html');
    exit;
}

$current_page = basename($_SERVER['PHP_SELF']);
include 'consultas.php';
$consultas = new Consultas();

$idProyecto = $_GET['idProyecto'] ?? null;

if ($idProyecto !== null) {
    $arquitectos = $consultas->getUsuariosPorTipoYProyecto($idProyecto, 2);
    $usuariosNormales = $consultas->getUsuariosPorTipoYProyecto($idProyecto, 3);
} else {
    echo "No se encontró el proyecto.";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios del Proyecto</title>
    <link rel="stylesheet" href="../../css/proyectos.css">
    <link rel="icon" href="../../img/Logo1.png" type="image/png">
</head>

<body>
    <?php
    include "../plantillas/header.php";
    include "../plantillas/miniBar.php";
    ?>
    <section>
        <?php include "../plantillas/menu.php"; ?>
        <main>
            <div class="project-list">
                <div class="usuarios-section">
                    <h2>Arquitectos</h2>
                    <ul class="user-list">
                        <?php
                        foreach ($arquitectos as $arquitecto) {
                            echo "<li class='user-item'>";
                            echo "<div class='user-info'>";
                            echo "<div class='user-data'>" . $arquitecto['nombre'] . " " . $arquitecto['apellidoPat'] . " " . $arquitecto['apellidoMat'] . "</div>";
                            echo "<div class='user-data'>" . $arquitecto['email'] . "</div>";
                            echo "</div>";
                            echo "</li>";
                        }
                        ?>
                    </ul>
                </div>
                <div class="usuarios-section">
                    <h2>Usuarios Normales</h2>
                    <ul class="user-list">
                        <?php
                        foreach ($usuariosNormales as $usuarioNormal) {
                            echo "<li class='user-item'>";
                            echo "<div class='user-info'>";
                            echo "<div class='user-data'>" . $usuarioNormal['nombre'] . " " . $usuarioNormal['apellidoPat'] . " " . $usuarioNormal['apellidoMat'] . "</div>";
                            echo "<div class='user-data'>" . $usuarioNormal['email'] . "</div>";
                            echo "</div>";
                            echo "</li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </main>
    </section>
</body>

</html>