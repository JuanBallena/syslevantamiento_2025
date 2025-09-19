<?php 
$v=$_POST["v"];

include '../configuracion/conexion.php';
include '../configuracion/constantes.php';

$BaseDato=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);
$BaseDato->conectar();

//verificamos q sea el codigo que elegimos
$Consulta="SELECT codi_sector FROM tf_sectores WHERE codi_sector='$v'"; 
$Busqueda = $BaseDato->Consultas($Consulta);
$registro=pg_fetch_row($Busqueda);
$contador=pg_num_rows($Busqueda);

//sacamos el PRIMER codigo de la tabla tf_sectores
$Consulta1="SELECT codi_sector FROM tf_sectores ORDER BY codi_sector asc limit 1"; 
$Busqueda1 = $BaseDato->Consultas($Consulta1);
$matriz1=pg_fetch_row($Busqueda1);
$registro[1]=$matriz1[0];
	
//sacamos el ÚLTIMO codigo de la tabla tf_sectores
$Consulta2="SELECT codi_sector FROM tf_sectores ORDER BY codi_sector desc limit 1"; 
$Busqueda2 = $BaseDato->Consultas($Consulta2);
$matriz2=pg_fetch_row($Busqueda2);
$registro[2]=$matriz2[0];

$xml="<?xml version='1.0' encoding='ISO-8859-1'?>";
$xml.="<datos>";
$xml.="<codigo><![CDATA[$registro[0]]]></codigo>";
$xml.="<primero><![CDATA[$registro[1]]]></primero>";
$xml.="<ultimo><![CDATA[$registro[2]]]></ultimo>";
$xml.="</datos>";

header("Content-type: text/xml");
echo $xml;

?>