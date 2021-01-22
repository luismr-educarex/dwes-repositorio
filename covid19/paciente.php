<?php

require ("conexion.php");

class paciente{

    private $conexion = "";
    public $numero_pacientes = 0;

    function paciente()
    {
       $this->conexion = obtenerConexion();
       
    }

    function alta_paciente($nombre,$direccion){

        try {
           
            // preparar y vincular parámetros
            $stmt = $this->conexion->prepare("INSERT INTO Pacientes (nombre, direccion ) VALUES (:nombre, :direccion)");
             $stmt->bindParam(':nombre', $nombre_paciente);
             $stmt->bindParam(':direccion', $direccion_paciente);
         
            // establecemos los parámetros y ejecutamos para insertar
            $nombre_paciente = $nombre;
            $direccion_paciente = $direccion;

            $stmt->execute();
     
     } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
     }

    }

function listar_pacientes(){


    try {
        
        $stmt = $this->conexion->prepare("SELECT id, nombre, direccion FROM Pacientes");
        
        $stmt->execute();

    } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
    }
    return $stmt;

}

function modificar_paciente($id,$nombre,$direccion){

    
}


function borrar_paciente($id){

    try {
           
        // preparar y vincular parámetros
        $stmt = $this->conexion->prepare("DELETE FROM Pacientes WHERE id=:id");
        $stmt->bindParam(':id', $id_paciente);
        
        // establecemos los parámetros y ejecutamos para insertar
        $id_paciente = $id;
    
        $stmt->execute();
 
 } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
 }


    
}




   

}



?>