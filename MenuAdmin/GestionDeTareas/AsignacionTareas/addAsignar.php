<?php
include('Asignar.php');
$Asigna = new Asignar();
$Asigna->setIdUsuario($_POST['IDU']);
$Asigna->setIdTarea($_POST['IDT']);
$Asigna->setAsignacion();
header('Location: ../../index.php');
?>