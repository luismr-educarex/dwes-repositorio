<?php

require ("conexion.php");

class paciente{

    private $conexion;
    public $numero_pacientes = 0;

    function paciente()
    {
        $this->conexion=obtenerConexionBD();
       
    }

    function alta_paciente($nombre,$direccion){

        try {
            
            // preparar y vincular 
            $stmt = $this->conexion->prepare("INSERT INTO Pacientes (nombre, direccion ) VALUES (:nombre, :direccion)");
            //$stmt = $this->conexion->prepare("INSERT INTO Pacientes (nombre, direccion ) VALUES (?, ?)");
            //$stmt->bind_param("ss", $nombre_paciente, $direccion_paciente); // NO FUNCIONA CON PDO
            $stmt->bindParam(1, $nombre_paciente);
            $stmt->bindParam(2, $direccion_paciente);
            $stmt->bindParam(':nombre', $nombre_paciente);
            $stmt->bindParam(':direccion', $direccion_paciente);

            // establecemos los parámetros y ejecutamos
            $nombre_paciente = $nombre;
            $direccion_paciente = $direccion;
            $stmt->execute();

           

        } catch (PDOException $e) {
			die ("<p><H3>No se ha podido establecer la conexión.
                  <p>Compruebe si está activado el servidor de bases dedatos MySQL.</H3></p>\n <p>Error: ". $e->getMessage()."</p>\n");
			exit();
        } 
    }

function listar_pacientes(){


    $id_fichero = fopen($this->nombre_fichero,"r")
        or die("El fichero".$this->nombre_fichero."no se ha podido abrir"."</br>");

    rewind($id_fichero);

    $this->numero_pacientes = 0;

    $pacientes = array();

    while (!feof($id_fichero))
    {
        // Obtenemos el contenido de la línea actual y nos movemos a la siguiente
        $paciente_str = trim(fgets($id_fichero));
        // Si la cadena leida <> vacío
        if ($paciente_str!=""){
            // Usamos explode para separar los datos de la cadena en una matriz y esta 
            // matriz la añadimos con array_push a la matriz $pacientes
            array_push($pacientes, explode("#", $paciente_str));
            // Incrementamos el nº de pacientes
            $this->numero_pacientes++;
        }
    } // end while
    
    fclose($id_fichero);

    return $pacientes;

}

function modificar_paciente($id,$nombre,$direccion){

    
}


function borrar_paciente($id){

    $pacientes = $this->listar_pacientes();

    $ficheroBasura = fopen("basura.tmp","w")
    or die("<B>El fichero 'basura.tmp' no se ha podido abrir.</B><P>");

    $j=0;

    for($i=0;$i<sizeof($pacientes);$i++){

        if($pacientes[$i][0]!=$id){
            $pacientes[$i][0]=$j;
            $paciente_str = implode("#",$pacientes[$i]);
            // Si estamos escribiendo el registro >0 entonces hay que añadir 
    		// un salto de línea para que el fichero quede bien
            if($j>0){
                fputs($ficheroBasura,"\n");
            }
            fputs($ficheroBasura,$paciente_str);
            $j+=1;
        }
    }

    fclose($ficheroBasura);
    unlink($this->nombre_fichero);
    rename("basura.tmp",$this->nombre_fichero);

    
}




   

}



?>