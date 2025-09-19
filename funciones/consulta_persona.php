<?php 
	$v=$_POST["v"];

	include '../configuracion/conexion.php';
	include '../configuracion/constantes.php';

	$BaseDato=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);
	$BaseDato->conectar();

	$Consulta="SELECT nume_doc, nombres, ape_paterno, ape_materno FROM tf_personas where nume_doc='$v'"; 
	$Busqueda = $BaseDato->Consultas($Consulta);

	$registro=pg_fetch_row($Busqueda);

	$xml="<?xml version='1.0' encoding='ISO-8859-1'?>";
	$xml.="<datos>";
	$xml.="<codigo><![CDATA[$registro[0]]]></codigo>";
	$xml.="<nombre><![CDATA[$registro[1]]]></nombre>";
	$xml.="<apellidopat><![CDATA[$registro[2]]]></apellidopat>";
	$xml.="<apellidomat><![CDATA[$registro[3]]]></apellidomat>";
	$xml.="</datos>";
	header("Content-type: text/xml");
	echo $xml;
?>