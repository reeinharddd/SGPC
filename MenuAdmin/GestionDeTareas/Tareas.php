<?php
include("../../conexion.php");
class Tareas extends conexion{

    
    private $codigo;
    private $nombre;
    private $descripcion;
    private $fechaInicio;
    private $fechaFinal;
    private $estado;

    

    public function setCodigo($codigo){
        $this->codigo = $codigo;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }

    public function setEstado($estado){
        $this->estado = $estado;
    }

    public function setFullTarea(){
        $query = "insert into tareas (Codigo, Nombre, Descripcion, Estado) values ('".$this->codigo."', '".$this->nombre."', '".$this->descripcion."', '".$this->estado."')";
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