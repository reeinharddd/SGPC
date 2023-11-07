<?php
include("Tareas.php");
$Mytarea = new Tareas();

$Mytarea->setCodigo($_POST['Cod']);
$Mytarea->setNombre($_POST['Nombre']);
$Mytarea->setDescripcion($_POST['Des']);
$Mytarea->setEstado($_POST['estado']);
$Mytarea->setFullTarea();
header('Location: ../index.php');
?>