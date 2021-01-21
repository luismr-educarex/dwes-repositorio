<?php
class paciente {
		
		private $nombre_fichero = "pacientes.txt";
		// Variable que guarda el nº de pacientes del fichero
		public $numero_pacientes = 0;
		
		function paciente () //Esto es el constructor
      	{
      		// Creamos el fichero si no existe
      		if (!file_exists($this->nombre_fichero)){
      			$id_fichero=@fopen($this->nombre_fichero,"w") 
      				or die("<B>El fichero '$this->nombre_fichero' no se ha podido crear.</B><P>");
      			fclose($id_fichero);
      		}
          }
          
          // Añadir un paciente a la lista
    	function alta_paciente ($nombre, $direccion) {
    		// Primero leemos los pacientes para obtener así el nº de pacientes
    		$this->leer_pacientes();
    		// Abrimos el fichero de datos en modo añadir
    		$id_fichero = fopen($this->nombre_fichero,"a")
    				or die("<B>El fichero '$this->nombre_fichero' no se ha podido 
      								abrir.</B><P>");
			
    		$nume=$this->numero_pacientes;
    		// Creamos una matriz con los datos del nuevo paciente
    		$paciente = array("nume"=>$nume, "nombre"=>$nombre, "direccion"=>$direccion);
    		// Añadimos un intro y juntamos todos los datos de la matriz en una cadena separada por el carácter ~
			$paciente_str = "\n".implode("~", $paciente);
			// Añadimos la cadena anterior al fichero
			fputs($id_fichero, $paciente_str);
			// Cerramos el fichero de datos
	    	fclose($id_fichero);
        }
        
        // Función que lee los pacientes del fichero de datos
    	function leer_pacientes() {
    		// Abrimos el fichero en modo lectura	
    		$id_fichero = fopen($this->nombre_fichero,"r")
    				or die("<B>El fichero '$this->nombre_fichero' no se ha podido abrir.</B><P>");
    		// Vamos al principio del fichero
    		rewind($id_fichero);
    		// El nº de pacientes leídos es 0
    		$this->numero_pacientes=0;
    		// Definimos la matriz donde vamos a ir guardando los registros leídos del fichero
    		$pacientes= array();
    		// Mientras no estemos al final del fichero...
    		while (!feof($id_fichero))
    		{
    			// Obtenemos el contenido de la línea actual y nos movemos a la siguiente
        		$paciente_str = trim(fgets($id_fichero));
        		// Si la cadena leida <> vacío
        		if ($paciente_str!=""){
        			// Usamos explode para separar los datos de la cadena en una matriz y esta 
        			// matriz la añadimos con array_push a la matriz $pacientes
    				array_push($pacientes, explode("~", $paciente_str));
    				// Incrementamos el nº de pacientes
    				$this->numero_pacientes++;
				}
    		} // end while
    		// Cerramos el fichero
			fclose($id_fichero);
			// Devolvemos la matriz de datos
			return $pacientes;
    	}

}

?>