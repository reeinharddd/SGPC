<?php
class conexion
{
    private $HOST = "localhost";
    private $USER = "root";
    private $PASS = "";
    private $DB = "ProyectosConstructora";
    private $CON;
    private $DATASET = "";


    public function connect()
    {
     

        $this->CON = mysqli_connect($this->HOST, $this->USER, $this->PASS, $this->DB);
        if ($this->CON) {
           
            return true;
        } else {
            echo "Error de conexion";
            return false;
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

}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////

?>