<?php
include("../../../conexion.php");
class Asignar extends conexion{

    private $idTarea;
    private $idUsuario;
    

    public function setIdUsuario($idUsuario){
        $this->idUsuario=$idUsuario;
    }
    
    public function setIdTarea($idTarea){
        $this->idTarea=$idTarea;
    }

    
    
    public function setAsignacion(){
        $query = "insert into usuariotarea (idUsuario, idTarea)
        values('".$this->idUsuario."', '".$this->idTarea."')";
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