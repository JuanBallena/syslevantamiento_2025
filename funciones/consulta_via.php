<?php 
$v=$_POST["v"];

include '../configuracion/conexion.php';
include '../configuracion/constantes.php';

$registro = array(0,0,0,0,0);

$BaseDato=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);
$BaseDato->conectar();

$Consulta="SELECT tipo_via, nomb_via, codi_via FROM tf_vias WHERE codi_via='$v'"; 
$Busqueda = $BaseDato->Consultas($Consulta);
$registro=pg_fetch_row($Busqueda);

/*
$Consulta1="SELECT codi_via FROM tf_vias ORDER BY codi_via asc limit 1"; 
$Busqueda1 = $BaseDato->Consultas($Consulta1);
$matriz1=pg_fetch_row($Busqueda1);
$registro[3]=$matriz1[0];

$Consulta2="SELECT codi_via FROM tf_vias ORDER BY codi_via desc limit 1"; 
$Busqueda2 = $BaseDato->Consultas($Consulta2);
$matriz2=pg_fetch_row($Busqueda2);
$registro[4]=$matriz2[0];
*/

$xml="<?xml version='1.0' encoding='ISO-8859-1'?>";
$xml.="<datos>";
$xml.="<tipo><![CDATA[$registro[0]]]></tipo>";
$xml.="<nombre><![CDATA[$registro[1]]]></nombre>";
$xml.="<codigo><![CDATA[$registro[2]]]></codigo>";
//$xml.="<primero><![CDATA[$registro[3]]]></primero>";
//$xml.="<ultimo><![CDATA[$registro[4]]]></ultimo>";
$xml.="</datos>";
header("Content-type: text/xml");
echo $xml;
?>