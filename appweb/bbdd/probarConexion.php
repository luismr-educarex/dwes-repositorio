<?php

/* Fijamos las constantes de la conexión al servidor MySQL.
   El nombre del servidor es el que admite por defecto el servidor
   local.*/
define("SERVIDOR", "localhost");
define("USUARIO", "root");
define("CLAVE", "");

obtenerConexionMysql();
obtenerConexionBD();
   

function obtenerConexionMysql() {
   

    $con=mysqli_connect(SERVIDOR,USUARIO,CLAVE) or die("Problemas con la conexión a la base de datos:".mysqli_connect_error()) ;

    echo "<p>Conexión realizada con mysqli";
    mysqli_set_charset($con,'utf8'); 
    return $con;
}

function obtenerConexionBD($BD='')
	{
		/* Intentamos establecer una conexión con el servidor.*/
		try {
			if ($BD==''){
                $conexion = new PDO("mysql:host=".SERVIDOR.";charset=utf8", USUARIO, CLAVE);
            }
			else{
                $conexion = new PDO("mysql:host=" . SERVIDOR . ";dbname=" . $BD.";charset=utf8", USUARIO, CLAVE);
            } 
			/* Establecemos atributos para configurar la conexión PDO*/ 
			$conexion->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "<p>Conexión realizada con PDO";
			return($conexion);
		} catch (PDOException $e) {
			die ("<p><H3>No se ha podido establecer la conexión.
                  <p>Compruebe si está activado el servidor de bases dedatos MySQL.</H3></p>\n <p>Error: ". $e->getMessage()."</p>\n");
			exit();
		} // end try
	}



?>