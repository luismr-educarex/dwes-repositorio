
<head>
  <title>DATOS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  
    
</head>

<?php


if(isset($_POST["fichero"]))
      $fichero = $_POST["fichero"]; 


//opción A
$dirpath = realpath(dirname(getcwd()));
$directorio = $dirpath."/ficheros/subidas/";
$ruta_fichero = $directorio . basename($_FILES["fichero"]["name"]);

//opción B
//$directorio = "/appweb/ficheros/subidas/";
//$ruta_fichero = $_SERVER['DOCUMENT_ROOT'].$directorio . basename($_FILES["fichero"]["name"]);


$uploadOk = 1;

$mensajeFichero="";

// Comprobar que el fichero ya existe
if (file_exists($ruta_fichero)) {
    $mensajeFichero.=crearMensajeInfo("El fichero ya existe");
    $uploadOk = 0;
}
// Comprobar el tamaño del fichero
if ($_FILES["fichero"]["size"] > 500000) {
    $mensajeFichero.=crearMensajeInfo("El fichero es demasiado grande");
    $uploadOk = 0;
}
// Comprobar que el fichero es tipo csv
$tipoFichero = strtolower(pathinfo($ruta_fichero,PATHINFO_EXTENSION));
if($tipoFichero != "csv") {
    $mensajeFichero.=crearMensajeInfo("Sólo están permitidos los ficheros csv");
    $uploadOk = 0;
}


// Se comprueba si se ha dado algún caso anterior de error.
if ($uploadOk == 0) {
     $mensaje ='<div class="w3-container w3-blue"><p>El fichero no ha sido subido</p></div>';
    $mensajeFichero.=$mensaje;
// Si todas las comprobaciones han ido bien, intenta subir el fichero.
} else {
    if (move_uploaded_file($_FILES["fichero"]["tmp_name"], $ruta_fichero)) {
         $mensaje ='<div class="w3-container w3-green"><p>El fichero '. basename( $_FILES["fichero"]["name"]). ' ha sido subido</p></div>';
        $mensajeFichero.=$mensaje;
    } else {
         $mensaje ='<div class="w3-container w3-red"><p>Error al subir el ficheros</p></div>';
          $mensajeFichero.=$mensaje;
    }
}

$fichero = fopen($ruta_fichero, "r") or die("No se puede abrir el fichero!");


 echo '<div class="container">
  <h1>Datos que se van a leer</h1>';

  echo $mensajeFichero;

  echo '
  <div class="text-right">
            <a href="formularioCargarHorarios.php" class="btn btn-warning" role="button">Volver</a>
  </div>';
  
 	
$datos=array(); 
//Abrimos nuestro archivo
//Lo recorremos
while (($fila = fgetcsv($fichero, ";")) == true) 
{   
  
  print_r($fila);
  echo '<br>';
  //echo "FILA:".$fila[0]."-".$fila[1]."-".$fila[2];
  //array_push($datos,$fila); 
  array_push($datos,explode(";",$fila[0]));
 
   
} // fin del bucle while que recorre las filas del fichero csv.
print_r($datos);
//Cerramos el archivo
fclose($fichero);


function crearMensajeInfo($contenidoMensaje){

    $mensaje ='<div class="w3-container w3-red"><p>'.$contenidoMensaje.'</p></div>';
    return $mensaje;

}

?>