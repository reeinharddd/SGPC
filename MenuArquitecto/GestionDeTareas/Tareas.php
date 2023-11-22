<?php
include("../../conexion.php");
class Tareas extends conexion{

    
    
    private $titulo;
    private $descripcion;
    private $fechaInicio;
    private $fechaFinal;
    private $estado;
    private $idProyecto;

    public function setTitulo($titulo){
        $this->titulo = $titulo;
    }

    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }

    public function setEstado($estado){
        $this->estado = $estado;
    }

    public function setFechaInicio($fechaInicio){
        $this->fechaInicio = $fechaInicio;
    }

    public function setFechaFinal($fechaFinal){
        $this->fechaFinal = $fechaFinal;
    }

    public function setIdProyecto($idProyecto){
        $this->idProyecto=$idProyecto;
    }

    public function setFullTarea(){
        $query = "insert into tarea (titulo, descripcion, estado, fechaInicio, fechaFinal, idProyecto)
        values ('".$this->titulo."',
        '".$this->descripcion."',
        '".$this->estado."',
        '".$this->fechaInicio."',
        '".$this->fechaFinal."',
        '".$this->idProyecto."')";
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