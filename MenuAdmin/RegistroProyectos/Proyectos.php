
<?php

@include 'config.php';

session_start();

if (!isset($_SESSION['admin_name'])) {
   header('location:../Alertas/warning.html');
}
?>
<?php
include("../../conexion.php");
class Proyecto extends conexion{

    private $nombre;
    private $descripcion;
    private $ubicacion;
    private $fechaInicio;
    private $fechaFinal;
    private $estado;

    public function setNombre($nombre){
        $this->nombre=$nombre;
    }

    public function setDescripcion($descripcion){
        $this->descripcion=$descripcion;
    }

    public function setubicacion($ubicacion){
        $this->ubicacion=$ubicacion;
    }

    public function setFechaInicio($fechaInicio){
        $this->fechaInicio=$fechaInicio;
    }

    public function setFechaFinal($fechaFinal){
        $this->fechaFinal=$fechaFinal;
    }

    public function setEstado($estado){
        $this->estado=$estado;
    }

    public function setFullProyecto(){
        $query = "insert into Proyectos (Nombre, Descripcion, Ubicacion, fechaInicio, fechaFinal, Estado)
            values ('".$this->nombre."', '".$this->descripcion."', '".$this->ubicacion."', '".$this->fechaInicio."', '".$this->fechaFinal."', '".$this->estado."')";
            $result = $this->connect();
            if ($result){
                echo "todo bien pa";
                $newId = $this->exeqInsert($query);
            } else {
                echo "algo salio mal";
                $newId = 0;
            }
            return $newId;
    }
}
?>