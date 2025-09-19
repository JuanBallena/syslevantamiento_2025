<?php 

	$v=$_POST["v"];
	$tipo=substr($v,10,2); 
	include '../configuracion/conexion.php';
	include '../configuracion/constantes.php';

	$BaseDato=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);
	$BaseDato->conectar();

	$Consulta="SELECT id_ficha FROM tf_fichas WHERE id_ficha='$v' AND tipo_ficha = '$tipo'"; 
	$Busqueda = $BaseDato->Consultas($Consulta);

	//echo "TIPO: ".$tipo."<br>";
	//echo "CONULTA: ".$Consulta;

	$registro=pg_fetch_row($Busqueda);

	$xml="<?xml version='1.0' encoding='ISO-8859-1'?>";
	$xml.="<datos>";
	$xml.="<codigo><![CDATA[$registro[0]]]></codigo>";
	$xml.="</datos>";
	header("Content-type: text/xml");
	echo $xml;
?>