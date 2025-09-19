<?PHP session_start();
include("verificar_ubigeo.php");
//recibimos nombre de página para el caso de VERIFICACION E INSERCION
$pagina=$_GET['pag'];

$Codigo=strval($_POST['codnot']);	
$Nombre=$_POST['nomnot'];
$de=$_POST['departamentos'];
$pr=substr($_POST['provincias'],2,2);
$di=$_POST['distritos'];
$ubigeo=$de.$pr.$di;
$IDNotaria=$ubigeo.$Codigo;

if($Codigo=='')
{ echo "<script>alert('Debe ingresar un Codigo!'); 
    document.location.href='../add_notaria.php';</script>\n";
	}
elseif($Nombre=='')
{ echo "<script>alert('Debe ingresar un Nombre de Notaria');
    document.location.href='../add_notaria.php';</script>\n";
	}
elseif($de=='' || $de=='0' || $de==null)
{ echo "<script>alert('Seleccione departamento');
    document.location.href='../add_notaria.php';</script>\n";
	}
elseif($pr=='' || $pr=='0' || $pr==null)
{ echo "<script>alert('Seleccione provincia');
    document.location.href='../add_notaria.php';</script>\n";
	}
elseif($di=='' || $di=='0' || $di==null)
{ echo "<script>alert('Seleccione un distrito');
    document.location.href='../add_notaria.php';</script>\n";
	}
else
{
	//CONSULTAS
	//----------------------------------------------------
	$Seleccion="SELECT id_notaria FROM tf_notarias WHERE id_notaria='$Codigo'";
	$Insercion="INSERT INTO tf_notarias VALUES('$IDNotaria',$Codigo,'$Nombre','$ubigeo')";
	include 'verificar_insertar.php';	
}            
?>