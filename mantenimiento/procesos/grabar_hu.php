<?PHP session_start();
include("verificar_ubigeo.php");
//recibimos nombre de página para el caso de VERIFICACION E INSERCION
$pagina=$_GET['pag'];


$Dep=$_SESSION['dep'];
$Pro=$_SESSION['pro'];
$Dis=$_SESSION['dis'];
$Ubigeo=$_SESSION['ubigeo'];
	

$Codigo=$_POST['codhu'];
$tipohu=trim($_POST['cmb_tipohu']);
$Nombre=$_POST['nomhu'];


$ID=$Ubigeo.$_POST['codhu'];

//echo $Dep.''.$Pro.''.$Dis.''.$Ubigeo.''.$Nombre.''.$Codigo;
if($Codigo=='')	
{ echo "<script>alert('Debe ingresar Codigo de Habilitacion Urbana!');
    document.location.href='../add_hu.php';</script>\n";
	}

elseif($Nombre=='')
{ echo "<script>alert('Debe ingresar un Nombre a la Habilitación Urbana!');
    document.location.href='../add_hu.php';</script>\n";
	}
else
{ 	//CONSULTAS
	//----------------------------------------------------
	$Seleccion="SELECT codi_hab_urba FROM tf_hab_urbana WHERE codi_hab_urba='$Codigo'";
	$Insercion="INSERT INTO tf_hab_urbana VALUES('$ID','','$tipohu','$Nombre','$Codigo','$Ubigeo')";
	include 'verificar_insertar.php';	
}
?>