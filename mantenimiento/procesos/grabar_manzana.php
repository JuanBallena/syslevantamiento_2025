<?PHP session_start();
include 'verificar_ubigeo.php';
//recibimos nombre de p�gina para el caso de VERIFICACION E INSERCION
$pagina=$_GET['pag'];

$Sector=$_POST['codigo_sector'];  
$ID=$Sector.$_POST['codmanzana'];
$Codigo=$_POST['codmanzana'];
$Nro=$_POST['nromanzana'];
 
	
if($Codigo=='')	
{ echo "<script>alert('Debe ingresar Codigo de Manzana!');
    document.location.href='../add_manzana.php';</script>\n";
	}
elseif($Nombre=='')
{ echo "<script>alert('Debe ingresar un Nro de manzana!');
    document.location.href='../add_manzana.php';</script>\n";
	}
else
{
	//CONSULTAS
	//----------------------------------------------------
	$Seleccion="SELECT codi_mzna FROM tf_manzanas WHERE codi_mzna='$Codigo'";
	$Insercion="INSERT INTO tf_manzanas VALUES('$ID','$Sector','$Codigo','$Nro')";
	include 'verificar_insertar.php';	
}
?>