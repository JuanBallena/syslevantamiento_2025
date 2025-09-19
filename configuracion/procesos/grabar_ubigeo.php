<?php session_start();
include_once("../../configuracion/conexion.php");
include("../../configuracion/constantes.php");

$nombre=$_POST['nombre'];
$Dep=$_POST['departamentos'];
$Pro=substr($_POST['provincias'],2,2);
$Dis=$_POST['distritos'];
	
$Ubigeo=$Dep.$Pro.$Dis;
$cuenta=strlen($Ubigeo);
	
$usuario=$_SESSION['usuario'];		
			
//echo $Ubigeo; echo "\n";  echo $cuenta; echo "\n";
$BaseDato=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);

if($nombre=='')	
{ echo "<script>alert('Debe ingresar nombre de la Institución!');</script>\n"; 
    echo "<html><head></head>".
		"<body onload=\"history.back()\">".
		"</body></html>";
	exit;
	}

elseif($cuenta<6)	
{ 	echo "<script>alert('Elija correctamente su Ubigeo!');</script>\n"; 
	echo "<html><head></head>".
		"<body onload=\"history.back()\">".
		"</body></html>";
	exit;
	}
else 
{	//------------------------------------------------------INSERTAMOS------------------------
	$Consulta="INSERT INTO tf_institucion VALUES('$Ubigeo','$nombre')"; //declarar la consulta 
    $Resultado=$BaseDato->Consultas($Consulta);      
    if(pg_affected_rows($Resultado)>=0)//Si resulto almenos una fila afectada
 	  {
	  	  	//actualizar id_usuario por el nuevo ubigeo
			$nuevo_id=$Ubigeo.'1';
			//echo $nuevo_id;
			$actualiza_admin="UPDATE tf_usuarios SET id_usuario='$nuevo_id' WHERE usuario='$usuario'"; 
			$Respuesta=$BaseDato->Consultas($actualiza_admin);      
			$ok=pg_fetch_row($Respuesta);
			
			echo "<script>alert('Ubigeo CORRECTO!');
			window.top.location.reload();
		    </script>\n";
		 	return 1;       
			  }
    else return 0;
}        
?>