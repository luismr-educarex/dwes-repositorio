<?php
define("SERVIDOR", "localhost");
define("USUARIO", "root");
define("CLAVE", "");
define("BBDD", "miBBDD");

insertar();
insertar2();


function insertar(){
// Crear una conexion
// En la conexión, indicamos la base de datos que queremos utilizar.
$con = mysqli_connect(SERVIDOR, USUARIO, CLAVE, BBDD);
// Comprobar la conexión
if (!$con) {
  die("Error en la conexión: " . mysqli_connect_error());
}

$sql = "INSERT INTO Pacientes (nombre, direccion)
VALUES ('Luis', 'Calle Palacio,34')";

if (mysqli_query($con, $sql)) {
  echo "<p>Nueva fila creada con éxito";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($con);
}

mysqli_close($con);
}

function insertar2(){

    try {
        $con = new PDO("mysql:host=".SERVIDOR.";dbname=".BBDD, USUARIO, CLAVE);
        // Establecemos el modo de error de PDO para que salten excepciones
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

       $sql = "INSERT INTO Pacientes2 (nombre, direccion)
       VALUES ('Luis', 'Calle Palacio,34')";
        // se usa exec() porque la sentencia no devuelve ningún valor
        $con->exec($sql);
        echo "<p>Nueva fila creada correctamente";
      } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
      }
      
      $con = null;
}

?>