<?php 
	$v=$_POST["v"];

	include '../configuracion/conexion.php';
	include '../configuracion/constantes.php';

	$BaseDato=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);
	$BaseDato->conectar();

	$Consulta="SELECT tipo_hab_urba ||' '|| nomb_hab_urba, codi_hab_urba FROM tf_hab_urbana WHERE codi_hab_urba='$v'"; 
	$Busqueda = $BaseDato->Consultas($Consulta);

	$registro=pg_fetch_row($Busqueda);

	$xml="<?xml version='1.0' encoding='ISO-8859-1'?>";
	$xml.="<datos>";
	$xml.="<nombre><![CDATA[$registro[0]]]></nombre>";
	$xml.="<codigo><![CDATA[$registro[1]]]></codigo>";
	$xml.="</datos>";
	header("Content-type: text/xml");
	echo $xml;
?>