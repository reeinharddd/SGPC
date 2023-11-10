<?php
include('conexion.php');

class user extends conexion
{
    private $userId;
    private $nombre;
    private $apPat;
    private $apMat;
    private $numTel;
    private $email;
    private $contra;
    private $tipoUsuario;

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

    }
  
    public function getNombre()
    {
        return $this->nombre;
    }

    public function setApPat($apPat)
    {
        $this->apPat = $apPat;

    }

    public function getApPat()
    {
        return $this->apPat;
    }

    public function setApMat($apMat)
    {
        $this->apMat = $apMat;

    }
    public function getApMat()
    {
        return $this->apMat;

    }

    public function getNumTel()
    {
        return $this->numTel;
    }

    public function setNumTel($numTel)
    {
        $this->numTel = $numTel;

    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

    }

    public function getContra()
    {
        return $this->contra;
    }

    public function setContra($contra)
    {
        $this->contra = $contra;

    }

    public function getTipoUsuario()
    {
        return $this->tipoUsuario;
    }

    public function setTipoUsuario($tipoUsuario)
    {
        $this->tipoUsuario = $tipoUsuario;

    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setNewUser()
    {
        $query = "INSERT INTO Usuario (nombre, apellidoPat, apellidoMat, numTel,  
        email, contrasena, idTipoUsuario)
VALUES ('" . $this->nombre ."',
'" . $this->apPat ."',
'" . $this->apMat ."', 
'" . $this->numTel ."',
'" . $this->email ."',
'" . $this->contra ."',
" . $this->tipoUsuario .")";
        $result = $this->connect();
        if ($result) {
            $newid = $this->exeqInsert($query);
        } else {
            echo "algo salio mal 1";
            $newid = 0;
        }
        return $newid;
    }
  

    public function verificar($query){
        $result = $this->connect();
        if ($result) {
            $validacion = $this->exeqSelect($query);
        } else {
            echo "algo salio mal";
            $validacion = 0;
        }
        return $validacion;
    }
}