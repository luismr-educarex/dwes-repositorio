<?php

require_once "paciente.php";

$nombre = "Luis";
$dni = "33344433G";
$resultados =  array("resultado1"=>"+","resultado3"=>"+","resultado3"=>"-");

$paciente = new Paciente($nombre,$dni,$resultados);

$objetoJson =  json_encode($paciente);

echo $objetoJson;



?>