<?PHP session_start();
include 'verificar_ubigeo.php';
//recibimos nombre de página para el caso de VERIFICACION E INSERCION
$pagina=$_GET['pag'];

$Dep=$_SESSION['dep'];
$Pro=$_SESSION['pro'];
$Dis=$_SESSION['dis'];
$Ubigeo=$_SESSION['ubigeo'];

$tipo_persona='1';   //natural
$numdoc=$_POST['numdoc'];
$tipodoc=$_POST['tipodoc'];
$nombre=$_POST['nombre'];
$paterno=$_POST['paterno'];
$materno=$_POST['materno'];
$tipo_fun=$_POST['funcion'];
$IDPersona=$_POST['numdoc'].$tipo_fun.$tipo_persona.$_POST['tipodoc'];

if($numdoc=='')	
{ echo "<script>alert('Ingrese Número de Documento!');
    document.location.href='../add_persona.php';</script>\n";
	}
elseif($nombre=='')
{ echo "<script>alert('Ingrese Nombres!');
    document.location.href='../add_persona.php';</script>\n";
	}
elseif($paterno=='')
{ echo "<script>alert('Ingrese Apellido Paterno!');
    document.location.href='../add_persona.php';</script>\n";
	}
elseif($materno=='')
{ echo "<script>alert('Ingrese Apellido Materno!');
    document.location.href='../add_persona.php';</script>\n";
	}
else
{
	//CONSULTAS
	//----------------------------------------------------
	$Seleccion="SELECT id_persona FROM tf_personas WHERE id_persona='$IDPersona'";
	$Insercion="INSERT INTO tf_personas VALUES('$IDPersona','$numdoc','$tipodoc',".
		"'$tipo_persona','$nombre','$paterno','$materno','','$tipo_fun')";
	
	//VERIFICAMOS	
	$Busqueda=$BaseDato->Consultas($Seleccion);   
	$registros=pg_num_rows($Busqueda);
	
	if($registros>0 || $registros!='null')
	{	echo "<script>alert('Persona ya se encuentra registrado!');</script>\n"; 
		echo "<html><head></head><body onload=\"history.back()\"></body></html>";
		exit;
	}
	else{
		//INSERTAMOS 
		$Resultado=$BaseDato->Consultas($Insercion);      
		
		if(pg_affected_rows($Resultado)>=0)//Si resulto al menos una fila afectada
			  {	$cad1="<script>alert('Registro Exitoso!');document.location.href='../";
				$cad2=$pagina;
				$cad3="';</script>\n";
				$mensaje=$cad1.$cad2.$cad3;
				echo $mensaje; 
				return 1;       
				  }
		else
			 return 0;  
		} 
	unset($_SESSION['pagina']);      
}
?>