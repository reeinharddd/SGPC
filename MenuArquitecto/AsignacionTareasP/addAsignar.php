<?php
include('Asignar.php');
$Asigna = new Asignar();
$Asigna->setIdProyecto($_POST['IDU']);
$Asigna->setIdTarea($_POST['IDT']);
$Asigna->setFechaInicio($_POST['F-inicio']);
$Asigna->setFechaFin($_POST['F-fin']);
$Asigna->setAsignacion();
header('Location: indexAsignacion.php');
?>