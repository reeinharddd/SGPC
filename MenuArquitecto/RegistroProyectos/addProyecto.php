<?php
include("Proyectos.php");
$Myproyecto = new Proyecto();
$Myproyecto->setNombre($_POST['txtNombre']);
$Myproyecto->setDescripcion($_POST['txtDes']);
$Myproyecto->setubicacion($_POST['txtUbi']);
$Myproyecto->setFechaInicio($_POST['F-inicio']);
$Myproyecto->setFechaFinal($_POST['F-fin']);
$Myproyecto->setEstado($_POST['estado']);
$Myproyecto->setFullProyecto();
header('location: ../AsignacionTareasP/indexAsignacion.php')
?>