<?php 
$v=$_POST["v"];

include '../configuracion/conexion.php';
include '../configuracion/constantes.php';

$BaseDato=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);
$BaseDato->conectar();

$Consulta="SELECT id_ficha FROM tf_fichas WHERE id_uni_cat LIKE '$v'||'%' AND tipo_ficha = '01'"; 

//$Consulta="SELECT id_ficha FROM tf_fichas WHERE id_uni_cat='$v'"; 
$Busqueda = $BaseDato->Consultas($Consulta);
$registros=pg_num_rows($Busqueda);
if($registros>1)//Si hay más de dos registros
  {
  	$cantidad='2';      
  }
else
  $cantidad='0';
 	
$xml="<?xml version='1.0' encoding='ISO-8859-1'?>";
$xml.="<datos>";
$xml.="<codigo><![CDATA[$cantidad]]></codigo>";
$xml.="</datos>";
header("Content-type: text/xml");
echo $xml;
?>