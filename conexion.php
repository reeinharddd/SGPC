<?php
class conexion
{
    private $HOST = "localhost";
    private $USER = "root";
    private $PASS = "";
    private $DB = "sgpc";
    private $CON;
    private $DATASET = "";


    public function connect()
    {
        $this->CON = mysqli_connect($this->HOST, $this->USER, $this->PASS, $this->DB);
        if (mysqli_connect_errno()) {
            echo "Error de conexión: " . mysqli_connect_error();
            return false;
        } else {
            return true;
        }
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getConexion() {
        return $this->CON;
    }

    public function exeqInsert($query)
    {
        if (mysqli_query($this->CON, $query) > 0) {
            $newid = mysqli_insert_id($this->CON);
            echo "Insercion Exitosa";
        } else {
            $newid = 0;
            echo "Error: " . $query . "<br>" ;
        }
        return $newid;

    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

   public function exeqSelect($query)
{
    try {
        $this->DATASET = mysqli_query($this->CON, $query);
        if ($this->DATASET) {
            return $this->DATASET;
        } else {
            throw new Exception("Error en la consulta: " . mysqli_error($this->CON));
        }
    } catch (Exception $e) {
        echo "Excepción: " . $e->getMessage();
        return 0;
    }
}



public function exeqUpdate($query)
{
    try {
        $result = mysqli_query($this->CON, $query);

        if ($result !== false) {
            $affectedRows = mysqli_affected_rows($this->CON);
            return $affectedRows;
        } else {
            throw new Exception("Error en la consulta de actualización: " . mysqli_error($this->CON));
        }
    } catch (Exception $e) {
        echo "Excepción: " . $e->getMessage();
        return 0;
    }
}
public function close()
    {
        if ($this->CON) {
            mysqli_close($this->CON);
        }
    }
    public function getLastError()
    {
        return mysqli_error($this->CON);
    }


}



///////////////////////////////////////////////////////////////////////////////////////////////////////////////

?>