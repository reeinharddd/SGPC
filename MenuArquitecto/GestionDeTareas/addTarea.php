<?php
include("Tareas.php");
$Mytarea = new Tareas();

$Mytarea->setTitulo($_POST['Nombre']);
$Mytarea->setDescripcion($_POST['Des']);
$Mytarea->setEstado($_POST['estado']);
$Mytarea->setFechaInicio($_POST['F-inicio']);
$Mytarea->setFechaFinal($_POST['F-fin']);
$Mytarea->setIdProyecto($_POST['IDtarea']);
$Mytarea->setFullTarea();
header('Location: indexTareas.php');
?>