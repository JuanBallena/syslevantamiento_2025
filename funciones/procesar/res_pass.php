<?php 
include '../../configuracion/conexion.php';
include '../../configuracion/constantes.php';
$cad=$_GET['id'];
$newpass=md5(strtolower($_POST['new_pass']));
$pregunta=$_POST['pregunta'];
$respuesta=strtolower($_POST['respuesta']);
/*echo $cad;
echo $newpass;
echo $pregunta;
echo $respuesta;*/

$BD=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);
$BD->conectar();
$Consulta="UPDATE tf_usuarios SET clave='$newpass', pregunta='$pregunta', respuesta='$respuesta' ".
			"WHERE id_usuario='$cad'"; // actualizamos clave, pregunta y respuesta
$consulta_user= $BD->Consultas($Consulta);
$BD->desconectar();

echo "<script>alert('Su contraseña fue restablecida satisfactoriamente!');
    document.location.href='../../form_inicio.php';</script>\n";

?>
<body>
</body>
</html>
