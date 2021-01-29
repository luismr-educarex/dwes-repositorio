
<?php

class Paciente{

    private $nombre;
    private $dni;
    private $resultados;

    public function __construct($nombre, $dni, $resultados)
    {
        $this->nombre = $nombre;
        $this->dni = $dni;
        $this->resultados = $resultados;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getDni()
    {
        return $this->dni;
    }

    public function getResultados()
    {
        return $this->resultados;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setDni($dni)
    {
        $this->nombre = $dni;
    }

    public function setResultados($resultados)
    {
        $this->nombre = $resultados;
    }








}


?>