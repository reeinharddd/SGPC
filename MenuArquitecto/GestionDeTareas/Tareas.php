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

    public function setIdProyecto($idProyecto){
        $this->idProyecto=$idProyecto;
    }

    public function setFullTarea(){
        $query = "insert into tarea (titulo, descripcion, estado, idProyecto)
        values ('".$this->nombre."', '".$this->descripcion."', '".$this->estado."', '".$this->idProyecto."')";
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