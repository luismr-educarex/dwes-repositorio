
<?php
define("SERVIDOR", "localhost");
define("USUARIO", "root");
define("CLAVE", "");
define("BBDD", "miBBDD");

creartabla();
creartabla2();


function creartabla(){
// Crear una conexion
// En la conexión, indicamos la base de datos que queremos utilizar.
$con = mysqli_connect(SERVIDOR, USUARIO, CLAVE, BBDD);
// Comprobar la conexión
if (!$con) {
  die("Error en la conexión: " . mysqli_connect_error());
}

// sql para crear la tabla
$sql = "CREATE TABLE Pacientes (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(30) NOT NULL,
    direccion VARCHAR(50)
    )";

if ($con->query($sql) === TRUE) {
  echo "<p>La tabla Pacientes se ha creado con éxito";
} else {
  echo "<p>Error al crear la tabla: " . $con->error;
}
// Cerramos la conexión
$con->close();
}

function creartabla2(){
 
try {
  $con = new PDO("mysql:host=".SERVIDOR.";dbname=".BBDD, USUARIO, CLAVE);
  // Establecemos el modo de error de PDO para que salten excepciones
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// sql para crear la tabla
$sql = "CREATE TABLE Pacientes2 (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(30) NOT NULL,
    direccion VARCHAR(50)
    )";

  // se usa exec() porque la sentencia no devuelve resultados
  $con->exec($sql);
  echo "<p>La tabla Pacientes2 fue creada con éxito";
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$con = null;

}


?>