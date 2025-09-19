<?php 
session_start();

include_once("../conexion.php");
include("../constantes.php");

$BaseDato=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);
//Verificamos que exista la institucion
//----------------------------------------------------
$Consulta="SELECT id_institucion FROM tf_institucion";
$Resultado=$BaseDato->Consultas($Consulta);   
$registros=pg_num_rows($Resultado);

if($registros<=0 || $registros=='null')
{	echo "<script>alert('Debe registrar Institucion!');
    document.location.href='../../configuracion/define_ubigeo.php';</script>\n";
}
else{
	while($row=pg_fetch_array($Resultado))
	{	//obtenemos el UBIGEO	
		$dep=substr($row['id_institucion'],0,2);
		$pro=substr($row['id_institucion'],2,2);
		$dis=substr($row['id_institucion'],4,2);
		
		$_SESSION['dep']=$dep;
		$_SESSION['pro']=$pro;
		$_SESSION['dis']=$dis;
		$ubigeo=$dep.$pro.$dis;
		$_SESSION['ubigeo']=$ubigeo;
		
		//Completamos el registro
		actualizar();			
	}
}
$BaseDato->desconectar();

//------------------------------------------------------------------------------------------------------------------
function actualizar()
{	
	$usu=$_SESSION["new_usuario"];
	// echo $usu.' ';
	$clave=trim(md5(strtolower($_SESSION["new_clave"])));
	$nombres = $_SESSION["nombres"];
	$apepat = $_SESSION["apepat"];
	$apemat = $_SESSION["apemat"];
	$email= $_SESSION["email"];
	$tipousu= $_SESSION["tipousu"];
	$fecIngreso= $_SESSION["fecIngreso"];
	$fecCese= $_SESSION["fecCese"];
	$pregunta= $_SESSION["pregunta"];
	$respuesta= $_SESSION["respuesta"];
	$Ubigeo=$_SESSION['ubigeo'];
	
	// Se crea el estado desactivado (1)
	$estado = 1;
	
	$BaseDato=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);
	
	// Tomar el ultimo id_usuario creado.
	$BaseDato->conectar();
	
	$Consulta="select codi_usuario from tf_usuarios order by codi_usuario desc limit 1 "; 
	$Busqueda = $BaseDato->Consultas($Consulta);
	$registro=pg_fetch_row($Busqueda);
	
	// Se recupera el ultimo id
	$ultimoid = $registro[0]; 
	$BaseDato->desconectar();
	$ultimoid = $ultimoid +1;
	// insertar los campos del nuevo usuario a crear.
	
	$BaseDato->conectar();
	
	//creamos el ID Usuario, considerando el UBIGEO
	$IDUsuario=$Ubigeo.trim(strval($ultimoid));
	//echo $IDUsuario.' '.$ultimoid.' '.$usu.' '.$clave.' '.$nombres.' '.$apepat.' '.$apemat.' '.$email.' '.$fecIngreso.' '.$fecCese.' '.$tipousu.' '.$estado.' '.$pregunta.' '.$respuesta;
	
	$Consulta2="insert INTO tf_usuarios values ('$IDUsuario','$ultimoid','$usu','$clave',".
				"'$nombres','$apepat','$apemat','$email','$fecIngreso','$fecCese',$tipousu,'$estado',".
				"'$pregunta','$respuesta')"; 
	$Busqueda2 = $BaseDato->Consultas($Consulta2);
	
	$nrows=pg_num_rows($Busqueda);
	if($nrows=1){
		echo "<table  class='tabla' border='1' align='center'><tr><td colspan='2'  bgcolor='#0052A4' class='Titulo1'><div align='center' class='Estilo1'>Insercion exitosa</div></td></tr><tr><td colspan='2'>Se ingresaron los sgtes. parametros</td></tr><tr><td class='etiqueta'>Id Usuario</td><td class='etiqueta'>".$IDUsuario."</td></tr><tr><td class='etiqueta'>Usuario</td><td class='etiqueta'>".$usu."</td></tr><tr><td class='etiqueta'>Clave</td><td class='etiqueta'>".$clave."</td></tr><tr><td class='etiqueta'>Nombres</td><td class='etiqueta'>".$nombres."</td></tr><tr><td class='etiqueta'>Aplelido Paterno</td><td class='etiqueta'>".$apepat."</td></tr><tr><td class='etiqueta'>Apellido Materno</td><td class='etiqueta'>".$apemat."</td></tr><tr><td class='etiqueta'>E-Mail</td><td class='etiqueta'>".$email."</td></tr><tr><td class='etiqueta'>Tipo Usuario</td><td class='etiqueta'>".$tipousu."</td></tr><tr><td class='etiqueta'>Fecha ingreso</td><td class='etiqueta'>".$fecIngreso."</td></tr><tr><td class='etiqueta'>Fecha Cese</td><td class='etiqueta'>".$fecCese."</td></tr></table>";
	}
}

?>
</body>
</html>