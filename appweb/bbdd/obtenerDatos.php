<?php
define("SERVIDOR", "localhost");
define("USUARIO", "root");
define("CLAVE", "");
define("BBDD", "miBBDD");

obtenerDatos();
echo '</br>';
echo '</br>';
obtenerDatos2();
echo '</br>';
echo '</br>';
obtenerDatos3();

function obtenerDatos(){
// Crear una conexion
// En la conexión, indicamos la base de datos que queremos utilizar.
$con = mysqli_connect(SERVIDOR, USUARIO, CLAVE, BBDD);
// Comprobar la conexión
if (!$con) {
  die("Error en la conexión: " . mysqli_connect_error());
}

$sql = "SELECT id, nombre, direccion FROM Pacientes";
$resultado = $con->query($sql);

if ($resultado->num_rows > 0) {
  // se muestra los datos de cada fila
  while($row = $resultado->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Nombre: " . $row["nombre"]. " - Direccion: " . $row["direccion"]. "<br>";
  }
} else {
  echo "No hay resultados";
}
$con->close();
}


function obtenerDatos2(){
   

        try {
            $con = new PDO("mysql:host=".SERVIDOR.";dbname=".BBDD, USUARIO, CLAVE);
            // Establecemos el modo de error de PDO para que salten excepciones
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $con->prepare("SELECT id, nombre, direccion FROM Pacientes2");
            
            $stmt->execute();

            foreach($stmt as $row){
                echo "paciente:".$row['id'] . " " .$row['nombre'] . " " . $row['direccion'] ;
                echo "<br/>";
              }


        } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        }
        $con = null;
        

}

function obtenerDatos3(){

    try {
        $con = new PDO("mysql:host=".SERVIDOR.";dbname=".BBDD, USUARIO, CLAVE);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
        $sql = "SELECT id, nombre, direccion FROM Pacientes";
        
        $result = $con->query($sql);
        //while ($row = $result->fetch(PDO::FETCH_ASSOC)){
        foreach($result as $row){
         echo $row['nombre'] . " " . $row['direccion'] ;
         echo "<br/>";

        }

      } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        }
  
        $con = null;
}

?>