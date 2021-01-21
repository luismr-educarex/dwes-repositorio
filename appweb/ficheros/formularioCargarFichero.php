<head>
  <title>CARGAR DATOS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    
   
    
</head>

<body>
    
<div class="container">
    <h2>Cargar el fichero</h2>


<form class="form-horizontal" action="cargarDatos2.php" method="post" enctype="multipart/form-data">
    
  <div class="form-group"> 
      
    <div class="file-field">
        <div class="float-left">
            
            <input type="file" name="fichero" size="200">
        
           
        </div>
    </div>  
   
      <button type="submit" class="btn btn-info">Leer fichero</button>
    </div>

</form>
<div class="text-right">
            <a href="cargarDatos.php" class="btn btn-warning" role="button">Volver</a>
  </div>
</div>
</body>
