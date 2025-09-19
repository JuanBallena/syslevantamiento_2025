<?php 
session_start();
include '../configuracion/conexion.php';
include '../configuracion/constantes.php';


$usu=$_POST["usuario"];
$clave= $_POST["clave"];
$nombres = $_POST["nombres"];
$apepat = $_POST["apepat"];
$apemat = $_POST["apemat"];
$email= $_POST["email"];
$tipousu= $_POST["tipousu"];
$fecIngreso= $_POST["fecIngreso"];
$fecCese= $_POST["fecCese"];
$preg= $_POST["pregunta"];
$rpta= $_POST["respuesta"];

$_SESSION["new_usuario"] = $usu;
$_SESSION["new_clave"] = $clave;
$_SESSION["nombres"] = $nombres;
$_SESSION["apepat"] = $apepat;
$_SESSION["apemat"] = $apemat;
$_SESSION["email"] = $email;
$_SESSION["tipousu"] = $tipousu;
$_SESSION["fecCese"] = $fecCese;
$_SESSION["fecIngreso"] = $fecIngreso;
$_SESSION["pregunta"] = $preg;
$_SESSION["respuesta"] = $rpta;

$BaseDato=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);
$BaseDato->conectar();

$Consulta="SELECT usuario FROM tf_usuarios WHERE usuario='$usu'"; 
$Busqueda = $BaseDato->Consultas($Consulta);

//$registro=pg_fetch_row($Busqueda);
$Nrows = pg_num_rows($Busqueda);
//echo "registro" . $registro['usuario'][0];
if($Nrows<1){
	// si no existe, agregar a variables de sesion.
	//$_SESSION["estado"] = $_POST["estado"];
	//echo $Nrows;
	 header("Location: ../configuracion/procesos/grabar_usuario.php");
}
else{
 	echo $Nrows;
 	
 	// si existe, retornar, para que se agregue un usuario distinto.
 	echo "<script>
 			alert('Nombre de usuario ya existente, ingresar nuevo!');
     		document.location.href='javascript:history.back(-1);';
     	  </script>\n"; 
}
?>