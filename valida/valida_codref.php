<?php 
$v=substr(trim($_POST["v"]),0,23);
//$v=$_POST["v"];
$dc=substr(trim($_POST["v"]),23,1); 

include '../configuracion/conexion.php';
include '../configuracion/constantes.php';

$BaseDato=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);
$BaseDato->conectar();

$Consulta="SELECT id_ficha FROM tf_fichas WHERE id_uni_cat='$v' AND tipo_ficha = '01' AND dc='$dc'"; 
//$Consulta="SELECT id_ficha FROM tf_fichas WHERE id_uni_cat='$v'"; 
$Busqueda = $BaseDato->Consultas($Consulta);
$registros=pg_num_rows($Busqueda);
if($registros>0)//Si hay más de un regstro
  {
  	if($registros==1)
		$cantidad='1';
	else
	 	$cantidad='12';      
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