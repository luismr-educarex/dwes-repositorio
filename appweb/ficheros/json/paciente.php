
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

    
}


?>