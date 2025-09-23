<?php
session_start();
include 'configuracion/procesos/mostrar_gral.php';

$lg = $_SESSION['login'];
$nombre = $_SESSION['nombre'];
$tipo_usuario = $_SESSION['tipo_usuario'];

if ($lg == '') {
  echo "<script>alert('Debe ingresar un Usuario!');
    document.location.href='inicio.php';</script>\n";
} else {

  ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Menu</title>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.dimensions.js"></script>
<script type="text/javascript" src="js/jquery.positionBy.js"></script>
<script type="text/javascript" src="js/jquery.bgiframe.js"></script>
<script type="text/javascript" src="js/jquery.jdMenu.js"></script>
<script type="text/javascript" language="javascript" src="js/no_f5.js"></script>

<link rel="stylesheet" href="css/jquery.jdMenu.css" type="text/css" />

<style type="text/css">
<!--
body {
	background-color: #FFFFFF;
}
-->
</style></head>
<script language= "javascript">
function cambiar(pag){
//window.status = "Copyright 2011 - Secretaria Tecnica del SNCP";
//document.frames.hijo.location = pag + '.php';
var iframe = document.getElementById ('hijo'); 

iframe.src =  pag + '.php';

//this.hijo.src = 'login.php';
}

function cerrar(){

document.location.href='cerrar.php';

//this.hijo.src = 'login.php';
}

function mostrarest(){

window.status = "Copyright 2011 - Secretaria Tecnica del SNCP";
}
</script>
<body onload="javascript:mostrarest()" onKeyDown="javascript:no_f5(this)">

<div style="border: 1px #CCCCCC; ">
	<ul class="jd_menu">
		<li class="accessible"><a href="#" class="accessible">Usuario  &raquo;</a>
			<ul>
			 <?php if ($tipo_usuario == '1') {
			   mostrar_administrador(1);
			 }
  //no muestra regsitro de usuarios
  ?>
				<li><a href="javascript:cambiar('funciones/recupera_pass')" target="_self">Cambiar clave</a></li>
			  </ul>
	   </li>
	   <li class="accessible"><a href="#" class="accessible">Ficha Catastral  &raquo;</a>
			<ul  class="jd_menu_vertical">
				<li><a href="#" >Registrar Fichas Catastrales</a>
                    <ul>
                        <li><a href="javascript:cambiar('contexts/ficha_individual/FichaIndividual')" target="_self">Ficha Individual</a></li>
                         <!-- <li>-----------------------------------</li> -->
                        <li><a href="javascript:cambiar('fichaCotitularidad/nro_cotitular')" target="_self">Ficha Cotitularidad</a></li>	
                        <li><a href="javascript:cambiar('fichaActividadEconomica/nro_economica')" target="_self" align="right">Ficha Actividad Economica</a></li>
                        <li><a href="javascript:cambiar('fichaBienComun/nro_biencomun')" target="_self">Ficha Bien Comun</a></li>                            
                    </ul>
                </li>
                <!-- <li><a target="_self">------------------------------</a></li> -->
                <li><a href="javascript:cambiar('act_ficha')" target="_self">Modificar Fichas Catastrales</a></li>
			</ul>
		</li>
		<li class="accessible"><a href="#" class="accessible">Reportes  &raquo;</a>
			<ul>
			<?php if ($tipo_usuario == '1') {
			  mostrar_administrador(3);
			}
  //no muestra regsitro de usuarios
  ?>
				<li><a href="javascript:cambiar('edit_fichas')" target="_self">Impresión de Fichas</a></li>
                <li><a href="javascript:cambiar('reporte_antiguo')" target="_self">Reporte de Fichas Antiguas</a></li>
			</ul>
		</li>
		<?php if ($tipo_usuario == '1') {
		  mostrar_administrador(2);
		}
  //no muestra mantenimiento
  ?>
        <li ><a href="cerrar.php" target="_parent">Cerrar Sesion  &raquo;</a></li>
                    <div align="right"><img src="img/user/user.png" /><b> <?php echo "$nombre"; ?></b>&nbsp;</div>
        
	</ul>
</div>
<div >	
    <table>
        <tr>
            <td align="center">
                <iframe marginwidth=0 marginheight=0  id="hijo" src="form_inicio.php"  scrolling="auto"  frameborder="0" width='99%' height='95%' style="display:block;position:absolute;z-index:3;" align="middle" ></iframe>
            </td>
        </tr>
    </table>
</div>
</body>

</html>
<?php
}
?>
