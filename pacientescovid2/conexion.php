<?php

/* Fijamos las constantes de la conexión al servidor MySQL.
   El nombre del servidor es el que admite por defecto el servidor
   local.*/
define("SERVIDOR", "localhost");
define("USUARIO", "root");
define("CLAVE", "");
define("BBDD", "miBBDD");


function obtenerConexionBD()
	{
		/* Intentamos establecer una conexión con el servidor.*/
		try {
            
            $conexion = new PDO("mysql:host=".SERVIDOR.";dbname=".BBDD, USUARIO, CLAVE);
            // Establecemos el modo de error de PDO para que salten excepciones
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
			
		} catch (PDOException $e) {
			die ("<p><H3>No se ha podido establecer la conexión.
                  <p>Compruebe si está activado el servidor de bases dedatos MySQL.</H3></p>\n <p>Error: ". $e->getMessage()."</p>\n");
			exit();
        } 
        
        return($conexion);
	}



?>