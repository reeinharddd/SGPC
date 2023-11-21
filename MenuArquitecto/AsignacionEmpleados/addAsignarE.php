<?php
include('AsignarE.php');
$AsignaE = new AsignarE();
$AsignaE->setidUsuario($_POST['IDU']);
$AsignaE->setidProyecto(['IDP']);
$AsignaE->setFullAsignacion();
header('Location: indexAsignacionE.php');
?>