<?php



function crear_monedero()
{

	$mi_monedero = new monedero;


	$fichero="monedero.txt";
	$id_fichero=@fopen($fichero,"r+")
	or die("<B>El fichero monedero.txt no se ha podido abrir.</B><P>");

	rewind($id_fichero);	
	while (!feof($id_fichero))
	{
	$linea=fgets($id_fichero,256);
	$datos = explode("~", $linea);
	  echo "<B>$datos[0]-$datos[1] </B><P>";
	  $mi_monedero->añadir_concepto($datos[1],$datos[2],$datos[3]);
	  //echo $linea;
	}//FIN WHILE


	//eliminar_linea_fichero($fichero, 2);


	rewind($id_fichero);
	$matriz=file($fichero);
	for ($i=0;$i<count($matriz);$i++)
	{
		print ("<B> Elemento $i:</B> $matriz[$i]<P>");
	}

	$mi_monedero-> listarConceptos();

	$mi_monedero-> buscarConceptos("Cena de sábado");

	fclose($id_fichero);
	
}

function eliminar_linea_fichero($file, $line) {
    
        // Preparo el array
        $arr = file($file);
        $arr = array_map('rtrim', $arr);
        
        // Selecciono la linea real
        $line = $line - 1;
        
        // Verifico que la linea exista
        if( isset($arr[$line]) ) {
        
            // Elimina la linea
            unset($arr[$line]);
            
            // Creo y guardo el array
            $new_arr = implode(' ', $arr);
            file_put_contents($file, $new_arr, LOCK_EX);
            
            return true;
        }
    
        return false;
}

function añadir_concepto_en_monedero($concepto,$fecha,$importe)
{

	$mi_monedero-> añadir_concepto($concepto,$fecha,$importe);
	$mi_monedero-> listarConceptos();

}





?>