<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pacientes Covid</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>


<?php
    require ("paciente.php");
    $paciente = new paciente();

    if(isset($_REQUEST["operacion"])){
        if($_REQUEST["operacion"]=="alta")
        {
            $paciente->alta_paciente($_POST["nombre"],$_POST["direccion"]);
            mostrarListado($paciente->listar_pacientes(),-1);
        }
        
        else if($_REQUEST["operacion"]=="editar"){
          mostrarListado($paciente->listar_pacientes(),$_REQUEST["nume"]);
        }
        /*
        else if($_REQUEST["operacion"]=="modificar"){
          echo "entra en modificar";
          echo $_POST["nume"].'-'.$_POST["nombre"].'-'.$_POST["direccion"];
          $paciente->modificar_paciente($_POST["nume"],$_POST["nombre"],$_POST["direccion"]);
        } */
        else if ($_REQUEST["operacion"]=="borrar") {
				$paciente->borrar_paciente($_REQUEST["nume"]);
        echo "<CENTER>Se ha borrado correctamente el paciente.</CENTER><P>";
        mostrarListado($paciente->listar_pacientes(),-1);
			}
      
    }  
    else
    {
      mostrarListado($paciente->listar_pacientes(),-1);
      
    }

    function mostrarListado($pacientes_array,$elemento){


      $html='<div class="container">
    <h2>Pacientes COVID</h2>           
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>NOMBRE PACIENTE</th>
          <th>DIRECCION</th>
        </tr>
      </thead>
      <tbody>';
      
          $fila="";
          foreach($pacientes_array as $paciente){


            if($elemento != $paciente['id']){
              $fila='<tr>
              <td>'.$paciente['id'].'</td>
              <td>'.$paciente['nombre'].'</td>
              <td>'.$paciente['direccion'].'</td>
              <td>'.'<a href="index.php?operacion=editar&nume='.$paciente['id'].'" class="btn btn-info" role="button">Modificar</a>'.'</td>
              <td>'.'<a href="index.php?operacion=borrar&nume='.$paciente['id'].'" class="btn btn-danger" role="button">Eliminar</a>'.'</td>
            </tr>';
            }else{
              $fila='<tr><form method="POST" class="form-inline" action="index.php?operacion=modificar">
              <td>'.$paciente['id'].'</td>
              <td><input type="text" class="form-control" id="nombre" value='.$paciente['nombre'].' name="nombre"></td>
              <td><input type="text" class="form-control" id="direccion" value='.$paciente['direccion'].' name="direccion"></td>
              <td>'.'<input type="submit" class="btn btn-info"  value="Grabar" />'.'</td>
              <td>'.'<a href="index.php" class="btn btn-danger" role="button">Cancelar</a>'.'</td>
              <input type="hidden" name="nume" value="'.$elemento.'" />
              
              </form>
            </tr>';
            }
            
  
            $html=$html.$fila;
  
          } //fin del bucle for
  
          $html=$html.'</tbody>
                        </table>
                      </div>';
  
          echo $html;
  
      }
  

   
    ?>

<div class="container">
  

  <form method="POST" class="form-inline" action="index.php?operacion=alta">
    <div class="form-group">
      <label for="nombre">Nombre:</label>
      <input type="text" class="form-control" id="nombre" placeholder="Introduzca el nombre" name="nombre">
    </div>
    <div class="form-group">
      <label for="direccion">Dirección:</label>
      <input type="text" class="form-control" id="direccion" placeholder="dirección" name="direccion">
    </div>
  
    <button type="submit" class="btn btn-default">Grabar</button>
  </form>
</div>

</body>
</html>
