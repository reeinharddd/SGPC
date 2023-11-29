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
        if ($this->CON) {
            return true;
        } else {
            return false;
        }
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function exeqInsert($query)
    {
        if (mysqli_query($this->CON, $query) > 0) {
            $newid = mysqli_insert_id($this->CON);
        } else {
            $newid = 0;
            echo "Error: " . $query . "<br>" . mysqli_error($this->CON);
        }
        return $newid;

    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function exeqSelect($query)
    {
        $this->DATASET = mysqli_query($this->CON, $query);
        if ($this->DATASET) {
            return $this->DATASET;
        } else {
            echo "algo fallo en la consulta" . mysqli_error($this->CON);
            return 0;
        }
    }
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////