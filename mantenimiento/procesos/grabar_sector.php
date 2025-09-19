<?PHP session_start();
include 'verificar_ubigeo.php';
//recibimos nombre de página para el caso de VERIFICACION E INSERCION
$pagina=$_GET['pag'];

$Dep=$_SESSION['dep'];
$Pro=$_SESSION['pro'];
$Dis=$_SESSION['dis'];
$Ubigeo=$_SESSION['ubigeo'];

$ID=$Ubigeo.$_POST['codsector'];
$Codigo=$_POST['codsector'];	
$Nombre=$_POST['nomsector'];


if($Codigo=='')
{ echo "<script>alert('Debe ingresar Codigo de Sector!');
    document.location.href='../add_sector.php';</script>\n";
	}

elseif($Nombre=='')
{ echo "<script>alert('Debe ingresar un nombre al Sector!');
    document.location.href='../add_sector.php';</script>\n";
	}
else
{
	//CONSULTAS
	//----------------------------------------------------
	$Seleccion="SELECT codi_sector FROM tf_sectores WHERE codi_sector='$Codigo'";
	$Insercion="INSERT INTO tf_sectores VALUES('$ID','$Ubigeo','$Codigo','$Nombre')";
	include 'verificar_insertar.php';	
}            
?>