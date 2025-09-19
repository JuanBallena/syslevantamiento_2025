<?php 

include("../../configuracion/conexion.php");
include("../../configuracion/constantes.php");

$BaseDato=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);

//Verificamos que exista la institucion
//----------------------------------------------------
$Consulta="SELECT id_institucion FROM tf_institucion";
$Resultado=$BaseDato->Consultas($Consulta);   
$registros=pg_num_rows($Resultado);

if($registros<=0 || $registros=='null')
{	echo "<script>alert('Debe registrar Institucion!');
    document.location.href='../mantenimientos/define_ubigeo.php';</script>\n";
}
else{
	while($row=pg_fetch_array($Resultado))
		{		
			$dep=substr($row['id_institucion'],0,2);
			$pro=substr($row['id_institucion'],2,2);
			$dis=substr($row['id_institucion'],4,2);
			
			$_SESSION['dep']=$dep;
			$_SESSION['pro']=$pro;
			$_SESSION['dis']=$dis;
			$ubigeo=$dep.$pro.$dis;
			$_SESSION['ubigeo']=$ubigeo;
		}
	}
?>