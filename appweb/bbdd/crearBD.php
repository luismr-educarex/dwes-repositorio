<?php


define("SERVIDOR", "localhost");
define("USUARIO", "root");
define("CLAVE", "");


crearbasedatos();
crearbasedatos2();


function crearbasedatos(){


// Crear una conexion
$con = mysqli_connect(SERVIDOR, USUARIO, CLAVE);
// Comprobar la conexión
if (!$con) {
  die("Error en la conexión: " . mysqli_connect_error());
}

// Crear una base de datos
$sql = "CREATE DATABASE miBBDD";
if (mysqli_query($con, $sql)) {
  echo "<p>Base de datos creada con éxito";
} else {
  echo "<p>Error en la creación de la base de datos: " . mysqli_error($con);
}

//Cerrar la conexión
mysqli_close($con);


}

function crearbasedatos2(){

try {
  $con = new PDO("mysql:host=".SERVIDOR, USUARIO, CLAVE);
  // Establecemos el modo de error de PDO para que salten excepciones
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "CREATE DATABASE miBBDD2";
  // Se usa exec() porque no se devuelven resultados 
  $con->exec($sql);
  echo "<p>Base de datos creada con éxito<br>";
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

//Cerramos la conexión
$con = null;

}

?>