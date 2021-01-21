<?php
define("SERVIDOR", "localhost");
define("USUARIO", "root");
define("CLAVE", "");
define("BBDD", "miBBDD");

insertarPreparedStatement();


// Crear una conexion
// En la conexión, indicamos la base de datos que queremos utilizar.
$con = mysqli_connect(SERVIDOR, USUARIO, CLAVE, BBDD);
// Comprobar la conexión
if (!$con) {
  die("Error en la conexión: " . mysqli_connect_error());
}

// preparar y vincular 
$stmt = $con->prepare("INSERT INTO Pacientes (nombre, direccion ) VALUES (?, ?)");
$stmt->bind_param("ss", $nombre, $direccion);

// establecemos los parámetros y ejecutamos
$nombre = "José";
$direccion = "Plaza Italia,9";
$stmt->execute();

$nombre = "María";
$direccion = "Av. las acacias,45";
$stmt->execute();

$nombre = "Julia";
$direccion = "Calle Doritos,11";
$stmt->execute();

echo "Las filas se han insertado correctamente";

$stmt->close();
$con->close();


function insertarPreparedStatement(){

    try {
        $con = new PDO("mysql:host=".SERVIDOR.";dbname=".BBDD, USUARIO, CLAVE);
        // Establecemos el modo de error de PDO para que salten excepciones
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
        // preparar y vincular parámetros
        $stmt = $con->prepare("INSERT INTO Pacientes2 (nombre, direccion ) 
        VALUES (:nombre, :direccion)");
         $stmt->bindParam(':nombre', $nombre);
         $stmt->bindParam(':direccion', $direccion);
      
        // establecemos los parámetros y ejecutamos para insertar
        $nombre = "José";
        $direccion = "Plaza Italia,9";
        $stmt->execute();

        //insertaramos
        $nombre = "María";
        $direccion = "Av. las acacias,45";
        $stmt->execute();

        //insertaramos
        $nombre = "Julia";
        $direccion = "Calle Doritos,11";
        $stmt->execute();
      
        echo "Nuevas filas insertadas correctamente";
      } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
      $con = null;

}

?>