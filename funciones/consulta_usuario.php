<?php session_start();

$lg=$_SESSION['usuario'];
/*echo "<script>alert('$ty');</script>\n";*/
$BaseDato=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);

//Verificamos que exista la institucion
//----------------------------------------------------
$Consulta="SELECT * FROM tf_usuarios WHERE usuario='$lg'";
$Resultado=$BaseDato->Consultas($Consulta);   
$registros=pg_num_rows($Resultado);

if($registros<=0 || $registros=='null')
{	echo "<script>alert('No existen Usuarios!');</script>\n";
}
else{
	while($row=pg_fetch_array($Resultado))
		{		
			$id=trim($row['id_usuario']);
			$_SESSION['id_usuario']=$id;
			echo "<script>alert('$id');</script>\n";
		}
	}
?>