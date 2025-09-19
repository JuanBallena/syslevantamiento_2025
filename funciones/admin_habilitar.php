
<?php
include '../configuracion/conexion.php';
include '../configuracion/constantes.php';

//$cadena=$_SERVER["QUERY_STRING"];
// echo $cadena;
$id_usuario=$_GET['id_usuario'];

$BaseDato=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);


$Consulta="UPDATE tf_usuarios SET estado='1' WHERE id_usuario='$id_usuario'";//declarar la consulta 


          $Resultado=$BaseDato->Consultas($Consulta);  
		  
		  if(pg_affected_rows($Resultado)>=0)//Si resulto almenos una fila afectada
    	  {
		  echo "<script>alert('Estado Actualizado!');
    document.location.href='administra_usuario.php';</script>\n";      
			  }
        

 
?>