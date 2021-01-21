<?php
define("SERVIDOR", "localhost");
define("USUARIO", "root");
define("CLAVE", "");
define("BBDD", "miBBDD");


// Crear una conexion
// En la conexión, indicamos la base de datos que queremos utilizar.
$con = mysqli_connect(SERVIDOR, USUARIO, CLAVE, BBDD);
// Comprobar la conexión
if (!$con) {
  die("Error en la conexión: " . mysqli_connect_error());
}

$sql = "INSERT INTO Pacientes (nombre, direccion)
VALUES ('Tomás', 'Calle Flores,4');";
$sql .= "INSERT INTO Pacientes (nombre, direccion)
VALUES ('Susana', 'Calle Sol,3');";
$sql .= "INSERT INTO Pacientes (nombre, direccion)
VALUES ('Amparo', 'Calle Luna,55');";

if (mysqli_multi_query($con, $sql)) {
    echo "<p>Filas insertadas con éxito";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
  }


mysqli_close($con);


insertar_multiple();

function insertar_multiple(){

    try {
        $con = new PDO("mysql:host=".SERVIDOR.";dbname=".BBDD, USUARIO, CLAVE);
        // Establecemos el modo de error de PDO para que salten excepciones
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
        // iniciamos una transacción
        $con->beginTransaction();
        // Las sentencias SQL 
        $con->exec("INSERT INTO Pacientes2 (nombre, direccion)
        VALUES ('Tomás', 'Calle Flores,4')");
        $con->exec("INSERT INTO Pacientes2 (nombre, direccion)
        VALUES ('Susana', 'Calle Sol,4')");
        $con->exec("INSERT INTO Pacientes2 (nombre, direccion)
        VALUES ('Amparo', 'Calle Luna,4')");
      
        // commit the transaction
        $con->commit();
        echo "Nuevas filas insertadas correctamente";
      } catch(PDOException $e) {
        // roll back la transacción en caso de que se produzca un error.
        $con->rollback();
        echo "Error: " . $e->getMessage();
      }
      
      $con = null;
}

?>