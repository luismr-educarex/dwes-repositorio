<?php

class monedero
{

private $conceptos = array();
private $balance= 0;
private $fichero = "monedero.txt";

function __construct()
{
	//$this->incluir_registros($concepto,$fecha,$importe);
}

function __destruct()
{
	//unset($this->registros);
}

function cargar_monedero()
{

	$id_fichero=@fopen($this->fichero,"r+")
	or die("<B>El fichero monedero.txt no se ha podido abrir.</B><P>");

	rewind($id_fichero);	

	//RECORREMOS EL FICHERO Y RECUPERAMOS LOS DATOS EN UN ARRRAY
	while (!feof($id_fichero))
	{
		$linea=fgets($id_fichero,256);
		$linea=trim($linea, " \t.");
		$linea=trim($linea, " \n.");
		$datos = explode("~", $linea);

		$this->añadir_concepto_array($datos[0],$datos[1],$datos[2],$datos[3]);
		
		$this->balance=$this->balance+$datos[3];
	}//FIN WHILE

	fclose($id_fichero);
	
}


function alta_concepto($concepto,$fecha,$importe)
{
	$indice=count($this->conceptos);

	$fecha = explode('/',$fecha);
	// mktime(hora,minutos,segundos,mes,dia,año);
	$fecha = mktime('1', '1', '1', $fecha[1],$fecha[0],$fecha[2]);

	$this->añadir_concepto_array($indice,$concepto,$fecha,$importe);

	$this->añadir_concepto_fichero($concepto,$fecha,$importe);


}

function añadir_concepto_array($indice,$concepto,$fecha,$importe)
{

	
	//Creamos un array que contiene los datos
	$datos= array("indice"=>$indice,"concepto"=>$concepto,"fecha"=>$fecha,"importe"=>$importe);
	//El array que contiene los datos lo almacenamos en el array que contiene los conceptos
	array_push($this->conceptos,$datos);

}

function modificar_array($indice,$concepto,$fecha,$importe){

    $fecha = explode('/',$fecha);
	// mktime(hora,minutos,segundos,mes,dia,año);
	$fecha = mktime('1', '1', '1', $fecha[1],$fecha[0],$fecha[2]);
	$datos = array("indice"=>$indice,"concepto"=>$concepto,"fecha"=>$fecha,"importe"=>$importe);
	$this->conceptos[$indice]=$datos;

}


function obtenerConceptos($ordenacion)
{
	if($ordenacion!=""){	
		foreach ($this->conceptos as $key => $row) {
				$aux[$key] = $row[$ordenacion];		
			} 
		array_multisort($aux, SORT_ASC, $this->conceptos);
	}
	
	return $this->conceptos;
	
}

function obtenerBalance()
{
	return $this->balance;	
}


function obtenerNumRegistros()
{
	return count($this->conceptos);	
}

function buscarConceptos($nombre)
{


	// Abrimos el fichero en modo lectura	
    		$id_fichero = @fopen($this->fichero,"r")
    				or die("<B>El fichero '$this->nombre_fichero' no se ha podido 
      							abrir.</B><P>");
    		rewind($id_fichero);
    		// Matriz con los resultados de la búsqueda
    		$contactos = array();
    		// Mientras el fichero no termine
    		while (!feof($id_fichero))
    		{
        		$contacto_str = trim(fgets($id_fichero));
        		if ($contacto_str!=""){
        			$contacto = explode("~", $contacto_str);
 
        			if ((stristr($contacto[1], $nombre)) || 
						(stristr($contacto[2], $nombre)))
        				array_push($contactos, array("concepto"=>$contacto[1],"fecha"=>$contacto[2],"importe"=>$contacto[3]));
				}
    		} // end for
    		// Cerramos e fichero
			fclose($id_fichero);
			// Devolvemos la matriz de datos
			$this->conceptos=$contactos;

	
}


function añadir_concepto_fichero($concepto,$fecha,$importe)
{

	$id_fichero=@fopen($this->fichero,"a+")
	or die("<B>El fichero monedero.txt no se ha podido abrir.</B><P>");

	$indice=count($this->conceptos)-1;
	
	//fputs($id_fichero, "\n".$indice."~".$concepto."~".$fecha."~".$importe);

	$nuevoConcepto = array("indice"=>$indice, "concepto"=>$concepto, "fecha"=>$fecha, "importe"=>$importe);
	$nuevoConcepto_str = "\n".implode("~", $nuevoConcepto);

	fputs($id_fichero, $nuevoConcepto_str);

	fclose($id_fichero);
	
}


function modificar($id_elemento,$nuevoConcepto,$nuevaFecha,$nuevoImporte)
{
	$this->modificar_array($id_elemento,$nuevoConcepto,$nuevaFecha,$nuevoImporte);
	$this->actualizar_fichero();
}

function actualizar_fichero()
{
			
      		$id_fichero_temp = @fopen("buzon.tmp","w")
      		or die("<B>El fichero 'buzon.tmp' no se ha podido abrir.</B><P>");
      		
      		$num_conceptos=sizeof($this->conceptos);
    		for ($i=0;$i<$num_conceptos;$i++)
    		{	
    			$concepto_str = implode("~", $this->conceptos[$i]);		
    			if ($i>0){
    				$concepto_str = "\n".$concepto_str;
    			} 
    			fputs($id_fichero_temp, $concepto_str);
    		} // end for
    		// Cerramos el fichero temporal
			fclose($id_fichero_temp);
			// Borramos fichero original de datos
			unlink($this->fichero);
			// Renombramos el fichero temporal al fichero de datos
			rename("buzon.tmp", $this->fichero);
}

function listar(){

	$lista = $this->conceptos;

	$listado="";

	$ind=0;
	foreach($lista as $concepto)
	{	
	if( (isset($_REQUEST["operacion"])) && ($_REQUEST["operacion"]=="modificarConcepto") && ($_REQUEST['id']==$ind)){
			$listado=$listado.'
			<TR>
			<form name="form3" method="post" action="index.php?ordena_por_campo=&buscar_texto=">
							  <input type="hidden" name="operacion" value="modifica">	
    						  <TD><input type="text" name="concepto" size="30" 
    						 		value = "'.$concepto['concepto'].'" maxlength="30"></TD>
							  <TD><input type="text" name="fecha" size="10" 
									value = "'.date("j/m/Y",$concepto['fecha']).'" maxlength="10"></TD>
							  <TD><input type="text" name="importe" size="8" 
									value = "'.$concepto['importe'].'" maxlength="8"></TD> 
							  <TD colspan="2">
								<INPUT type="hidden" NAME="id" value ="'.$ind.'">
								<INPUT TYPE="SUBMIT" NAME="modifica"  VALUE="Modificar"></TD>
						  </FORM>
		</TR>';
			
		
	}else{

		$listado=$listado.'
		<TR>
			<TD>'.$concepto['concepto'].'</TD><TD>'.date("j/m/Y",$concepto['fecha']).'</TD><TD>'.$concepto['importe'].'</TD>
			<TD>
				<TABLE border=1 CELLSPACING=0 CELLPADDING=3 bgcolor=black>
					<TR><TD bgcolor=#669900><FONT size =-1 face="arial, helvetica"><A href = "index.php?operacion=modificarConcepto&id='.$ind.'">Editar</A></FONT></TD>
					</TR>
				</TABLE>
			</TD>
			<TD>
				<TABLE border=1 CELLSPACING=0 CELLPADDING=3 bgcolor=black>
					<TR>
						<TD bgcolor=#669900>
							<FONT size =-1 face="arial, helvetica"><A href = "index.php?operacion=borrar&id='.$ind.'">Borrar</A></FONT>
						</TD>
					</TR>
				</TABLE>
			</TD>
		</TR>';

	}
		

		$ind++;
	}

	echo $listado;

}

function borrar($elemento){

	$this->borrar_concepto_array($elemento);
	$this->actualizar_fichero();	

}

function borrar_concepto_array($indice){

      		$num_conceptos=sizeof($this->conceptos);
      		$contador=0;
      		$arrayTmp=array();
    		for ($i=0;$i<$num_conceptos;$i++)
    		{	

    			if($this->conceptos[$i]["indice"]!=$indice)
    			{
    				$this->conceptos[$i]["indice"]=$contador;
    				array_push($arrayTmp,$this->conceptos[$i]);
    				$contador++;
    			}     			
    		} 

    		$this->conceptos=$arrayTmp;

}

}

?>