<?PHP session_start();
include 'verificar_ubigeo.php';
//recibimos nombre de página para el caso de VERIFICACION E INSERCION
$pagina=$_GET['pag'];

$Dep=$_SESSION['dep'];
$Pro=$_SESSION['pro'];
$Dis=$_SESSION['dis'];
$Ubigeo=$_SESSION['ubigeo'];

$ID=$Ubigeo.$_POST['codvia'];
$Codigo=$_POST['codvia'];
$Nombre=$_POST['nomvia'];
$Tipo=$_POST['cmb_tipovia'];   
	
if($Codigo=='')	
{ echo "<script>alert('Debe ingresar Codigo de Via!');
    document.location.href='../add_via.php';</script>\n";
	}
elseif($Nombre=='')
{ echo "<script>alert('Debe ingresar un Nombre a la Via!');
    document.location.href='../add_via.php';</script>\n";
	}
else
{
	//CONSULTAS
	//----------------------------------------------------
	$Seleccion="SELECT codi_via FROM tf_vias WHERE codi_via='$Codigo'";
	$Insercion="INSERT INTO tf_vias VALUES('$ID','$Nombre','$Tipo',".
		"'$Codigo','$Ubigeo')";
	include 'verificar_insertar.php';	
}
?>