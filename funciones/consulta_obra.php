<?php 
$v=$_POST["v"];

include '../configuracion/conexion.php';
include '../configuracion/constantes.php';

$BaseDato=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);
$BaseDato->conectar();

$Consulta="SELECT desc_instalacion, codi_instalacion FROM tf_codigos_instalaciones WHERE codi_instalacion='$v'"; 
$Busqueda = $BaseDato->Consultas($Consulta);
$registro=pg_fetch_row($Busqueda);

$Consulta1="SELECT codi_instalacion FROM tf_codigos_instalaciones ORDER BY codi_instalacion asc limit 1"; 
$Busqueda1 = $BaseDato->Consultas($Consulta1);
$matriz1=pg_fetch_row($Busqueda1);
$registro[2]=$matriz1[0];

$Consulta2="SELECT codi_instalacion FROM tf_codigos_instalaciones ORDER BY codi_instalacion desc limit 1"; 
$Busqueda2 = $BaseDato->Consultas($Consulta2);
$matriz2=pg_fetch_row($Busqueda2);
$registro[3]=$matriz2[0];


$xml="<?xml version='1.0' encoding='ISO-8859-1'?>";
$xml.="<datos>";
$xml.="<descri><![CDATA[$registro[0]]]></descri>";
$xml.="<codigo><![CDATA[$registro[1]]]></codigo>";
$xml.="<primero><![CDATA[$registro[2]]]></primero>";
$xml.="<ultimo><![CDATA[$registro[3]]]></ultimo>";
$xml.="</datos>";
header("Content-type: text/xml");
echo $xml;
?>