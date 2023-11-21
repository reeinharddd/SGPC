<?php
include("../../conexion.php");
class Asignar extends conexion{
    
    private $idProyecto;
    private $idTarea;
    private $fechaInicio;
    private $fechaFin;

    public function setIdProyecto($idProyecto){
        $this->idProyecto=$idProyecto;
    }
    
    public function setIdTarea($idTarea){
        $this->idTarea=$idTarea;
    }

    public function setFechaInicio($fechaInicio){
        $this->fechaInicio = $fechaInicio;
    }

    public function setFechaFin($fechaFin){
        $this->fechaFin = $fechaFin;
    }
    
    public function setAsignacion(){
        $query = "insert into proyectotarea (idProyecto, idTarea, fechaInicio, fechaFinal)
        values('".$this->idProyecto."', '".$this->idTarea."', '".$this->fechaInicio."', '".$this->fechaFin."')";
        $result = $this->connect();
        if ($result == true){
            echo "Insercion Exitosa";
            $newId = $this->exeqInsert($query);
        }
        else{
            echo "Algo salio mal";
            $newId = 0;
        }
        return $newId;
    }
}
?>