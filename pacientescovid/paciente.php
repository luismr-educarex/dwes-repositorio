<?php



class paciente{

    private $nombre_fichero = "pacientes.txt";
    public $numero_pacientes = 0;

    function paciente()
    {
        if(!file_exists($this->nombre_fichero)){
            $id_fichero = fopen($this->nombre_fichero,"w")
            or die("El fichero".$this->nombre_fichero."no se ha podido crear</br>");
            fclose($id_fichero);
        }
       
    }

    function alta_paciente($nombre,$direccion){

        $id_fichero = fopen($this->nombre_fichero,"a")
        or die("El fichero".$this->nombre_fichero."no se ha podido abrir"."</br>");

        $this->listar_pacientes();

        $nume=$this->numero_pacientes;     
        
        $paciente = array("nume"=>$nume,"nombre"=>$nombre,"direccion"=>$direccion);

        $paciente_str = "\n".implode("#",$paciente);

        fputs($id_fichero,$paciente_str);

        fclose($id_fichero);
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