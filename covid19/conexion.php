<?php

/* Fijamos las constantes de la conexión al servidor MySQL.
   El nombre del servidor es el que admite por defecto el servidor
   local.*/
define("SERVIDOR", "localhost");
define("USUARIO", "root");
define("CLAVE", "");
define("BBDD", "miBBDD");


function obtenerConexion()
	{
		
		try {
			
            $conexion = new PDO("mysql:host=" . SERVIDOR . ";dbname=" . BBDD.";charset=utf8", USUARIO, CLAVE);
			$conexion->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
		} catch (PDOException $e) {
			die ("<p><H3>No se ha podido establecer la conexión.
                  <p>Compruebe si está activado el servidor de bases dedatos MySQL.</H3></p>\n <p>Error: ". $e->getMessage()."</p>\n");
			exit();
        } 
        
        return($conexion);
	}



?>