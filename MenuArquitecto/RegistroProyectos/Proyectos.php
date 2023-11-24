<?php

@include 'config.php';

session_start();

if (!isset($_SESSION['arqui_name'])) {
    header('location:../Alertas/warning.html');
}
?>
<?php
include("../../conexion.php");
class Proyecto extends conexion
{

    private $nombre;
    private $descripcion;
    private $ubicacion;
    private $fechaInicio;
    private $fechaFinal;
    private $estado;

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function setubicacion($ubicacion)
    {
        $this->ubicacion = $ubicacion;
    }

    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;
    }

    public function setFechaFinal($fechaFinal)
    {
        $this->fechaFinal = $fechaFinal;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    public function setFullProyecto()
    {
        $query = "INSERT INTO Proyecto (nombre, descripcion, ubicacion, fechaInicio, fechaFinal, estado)  
          VALUES ('" . $this->nombre . "', 
                  '" . $this->descripcion . "',
                  '" . $this->ubicacion . "',
                  '" . $this->fechaInicio . "',
                  '" . $this->fechaFinal . "',
                  '" . $this->estado . "')";
        $result = $this->connect();
        if ($result) {
            echo "todo bien pa";
            $newId = $this->exeqInsert($query);
        } else {
            echo "algo salio mal";
            $newId = 0;
        }
        return $newId;
    }
    public function obtenerDetallesProyecto($idProyecto)
    {
        $conexion = new Conexion(); 

        if ($conexion->connect()) {
            $con = $conexion->getConexion();
            $query = "SELECT * FROM Proyecto WHERE idProyecto = ?";
            $stmt = $con->prepare($query);
            $stmt->bind_param("i", $idProyecto);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0) {
                $detallesProyecto = $result->fetch_assoc();
                return $detallesProyecto;
            } else {
                return null; 
            }

            $stmt->close();
        }

        $conexion->close();
        return null; 
    }
}
?>