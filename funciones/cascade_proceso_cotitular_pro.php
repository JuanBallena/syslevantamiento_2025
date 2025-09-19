<link href="../CSS/combos.css" rel="stylesheet" type="text/css"/>
<meta http-equiv="content-Type" content="text/html; charset=UTF-8" /><style type="text/css">
<!--
.Estilo5 {color: #FFFFFF; font-weight: bold; font-family: Verdana; font-size: 09px; }
.Estilo6 {color: #FFFFFF; font-family: Verdana; font-size: 09px; }
.Estilo7 {color: #000000; font-family: Verdana; font-size: 09px; }
-->
</style>

<?php

$nro=$_GET['nro'];

// Array que vincula los IDs de los selects declarados en el HTML con el nombre de la tabla donde se encuentra su contenido
$listadoSelects=array(
"departamentos".$nro=>"lista_departamentos",
"provincias".$nro=>"lista_provincias",
"distritos".$nro=>"lista_distritos"
);

$selectDestino=$_GET["select"]; 
$opcionSeleccionada=$_GET["opcion"];

if(validaSelect($selectDestino) && validaOpcion($opcionSeleccionada))
{
		$tabla=$listadoSelects[$selectDestino];
	
		include '../configuracion/conexion.php';
		include '../configuracion/constantes.php';
	
		$BaseDato=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);
		$BaseDato->conectar();
		
		echo "<script>alert('$opcionSeleccionada');</script>\n";
		
		$Consulta="select codi_dep||''||codi_pro As codi, descri  from tf_ubigeos where codi_pro!='00' and codi_dis='00' and codi_dep ='$opcionSeleccionada'"; 
		$consulta_provincia = $BaseDato->Consultas($Consulta);
		
		
		$BaseDato->desconectar(); 
		
		// Comienzo a imprimir el select
		echo "<select class='select' name='".$selectDestino."' id='".$selectDestino."' onChange='cargaContenido2(this.id,".$nro.")' style='unicode-bidi:normal'>";
			
		echo "<option value='0'>Elige...</option>";
		 while($registro=pg_fetch_row($consulta_provincia))
		{
			// Convierto los caracteres conflictivos a sus entidades HTML correspondientes para su correcta visualizacion
			//$registro[1]=htmlentities($registro[1],	ISO8859-1);
			// Imprimo las opciones del select
			echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
		} 			
		//echo "</select>";
		?>
		<br>
		<?php
		
}

//funciones
function validaSelect($selectDestino)
{
	// Se valida que el select enviado via GET exista
	global $listadoSelects;
	if(isset($listadoSelects[$selectDestino])) return true;
	else return false;
}

function validaOpcion($opcionSeleccionada)
{
	// Se valida que la opcion seleccionada por el usuario en el select tenga un valor numerico
	if(is_string($opcionSeleccionada)) return true;
	else return false;
		
}


?>