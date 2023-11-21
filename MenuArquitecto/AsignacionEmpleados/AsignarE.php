<?php
include ('../../conexion.php');
class AsignarE extends conexion {

    private $idUsuario;
    private $idProyecto;

    public function setidUsuario($idUsuario){
        $this->idUsuario = $idUsuario;
    }

    public function setidProyecto($idProyecto){
        $this->idProyecto = $idProyecto;
    }

    public function setFullAsignacion(){
        $query = "insert into UsuarioProyecto (idUsuario, idProyecto)
        values('".$this->idUsuario."', '".$this->idProyecto."')";
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