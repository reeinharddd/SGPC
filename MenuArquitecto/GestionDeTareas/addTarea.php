<?php
include("Tareas.php");
$Mytarea = new Tareas();

$Mytarea->setTitulo($_POST['Nombre']);
$Mytarea->setDescripcion($_POST['Des']);
$Mytarea->setEstado($_POST['estado']);
$Mytarea->setIdProyecto($_POST['IDtarea']);
$Mytarea->setFullTarea();
header('Location: ../index.php');
?>