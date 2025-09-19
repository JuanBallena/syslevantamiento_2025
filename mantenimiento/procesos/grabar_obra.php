<?PHP session_start();
include("verifica_ubigeo.php");
//recibimos nombre de página para el caso de VERIFICACION E INSERCION
$pagina=$_GET['pag'];

$Dep=$_SESSION['dep'];
$Pro=$_SESSION['pro'];
$Dis=$_SESSION['dis'];
$Ubigeo=$_SESSION['ubigeo'];
	
$Codigo=$_POST['codobra'];
$Descri=$_POST['descri'];
$Materia=$_POST['mate'];
$Unidad=$_POST['uni'];

if($Codigo=='')	
{ echo "<script>alert('Debe ingresar un Codigo!');
    document.location.href='../add_obra.php';</script>\n";
	}
elseif($Descri=='')
{ echo "<script>alert('Debe ingresar una descripcion!');
    document.location.href='../add_obra.php';</script>\n";
	}
elseif($Materia=='')
{ echo "<script>alert('Debe ingresar tipo de Material!');
    document.location.href='../add_obra.php';</script>\n";
	}
elseif($Unidad=='')
{ echo "<script>alert('Debe ingresar la Unidad!');
    document.location.href='../add_obra.php';</script>\n";
	}
else
{ 	//CONSULTAS
	//----------------------------------------------------
	$Seleccion="SELECT codi_instalacion FROM tf_codigos_instalaciones WHERE codi_instalacion='$Codigo'";
	$Insercion="INSERT INTO tf_codigos_instalaciones VALUES('$Codigo','$Unidad','$Materia','$Descri')";
	include 'verificar/ver_insert.php';	
}
?>