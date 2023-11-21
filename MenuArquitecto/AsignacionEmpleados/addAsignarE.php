<?php
include('AsignarE.php');
$AsignaE = new AsignarE();
$AsignaE->setIdUsuario($_POST['IDU']);
$AsignaE->setIdProyecto(['IDP']);
$AsignaE->setFullAsignacion();
header('Location: indexAsignacionE.php');
?>