<?php session_start();
include '../configuracion/eventos.php';
include '../funciones/verifica_ubigeo.php'; //sesiones de UBIGEO

$Dep=$_SESSION['dep'];
$Pro=$_SESSION['pro'];
$Dis=$_SESSION['dis'];

if(isset($_GET['sw']))
	$sw='1'; //por el momento no entra
else $sw='0';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<title>Búsqueda de Fichas Catastrales</title>
<link href="../css/estilo_form.css" rel="stylesheet" type="text/css"/>
<link href="../css/tabla.css" rel="stylesheet" type="text/css">
<link href="../css/botones.css" rel="stylesheet" type="text/css"/>

<script type="text/javascript" language="javascript" src="../js/verifica_existencia.js"></script>
<script type="text/javascript" language="javascript" src="../js/funciones_validar.js"></script>
<script type="text/javascript" language="javascript" src="../js/valida_campo.js"></script>
<script type="text/javascript" src="../js/no_f5.js"></script>

<script src="http://ie7-js.googlecode.com/svn/version/xx.x/IE8.js" type="text/javascript"></script> 

<script type="text/javascript"> 
function redireccionar(sw){ 
  if (sw==1)
  	//alert("Debe ingresar Nro de Titulares");
	//BORRAR O BLOQUEAR LA LINEA SIGUIENTE EN EL CASO DE QUE SE AMARRE SI O SÍ AMBAS FICHAS IND-COT
	window.location="../fichaIndividual/new_individual.php"; 
  else 
  	{ 
		window.location="../fichaIndividual/new_individual.php"; 
		}
}  
//setTimeout ("redireccionar()", 5000); //tiempo expresado en milisegundos 
</script> 

<style type="text/css">
<!--
.Estilo1 {
	color: #FFFFFF;
	font-size: 14px;
	font-weight: bold;
}
.Estilo5 {color: #0052A4}
-->
</style>
</head>
<body onKeyDown="javascript:no_f5(this);"><div align="center">
<form name="envio" method="post"  onsubmit="javascript: return verifica_biencomun();" autocomplete="off">
  <table width="980" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td>
    <table class="myform" width="680" border="0" >
        <tr>
          <td width="486" colspan="3" bgcolor="#0052A4"  align="center"><div align="center">
            <p class="Estilo1"> FICHA CATASTRAL BIEN COM&Uacute;N</p>
            </div></td>
        </tr>
        <tr>
            <td height="23" colspan="3"><div align="center">
              <input name="anio" type="text" class="contador" id="anio" value="<?php echo date("Y"); ?>" size="6" maxlength="6"/>
              <input name="ubigeo" type="text" class="contador" id="ubigeo" value="<?php echo $_SESSION['ubigeo'];?>" size="6" maxlength="6"/>
              <input name="directo" type="text" class="contador" id="directo" size="2" maxlength="1" value="<?php echo $sw;?>"/>
            </div></td>
        </tr>
         
        <tr>
            <td colspan="3" align="center">
             	<?php if(!isset($_GET['sw']))
					{	
						echo 
						"<table width='680' border='0' cellpadding='0' cellspacing='0' class='tabla'>
						<tr>
							<td height='12' colspan='2'>&nbsp;</td>
                                        <td width='6%' valign='bottom'><div align='center' class='Estilo10'><span class='Estilo11'>DPTO.</span></div></td>
                                        <td width='6%' valign='bottom'><div align='center' class='Estilo10'><span class='Estilo11'>PROV.</span></div></td>
                                        <td width='6%' valign='bottom'><div align='center' class='Estilo10'><span class='Estilo11'>DIST.</span></div></td>
                                        <td width='6%' valign='bottom'><div align='center' class='Estilo10'><span class='Estilo11'>SECTOR</span></div></td>
                                        <td width='6%' valign='bottom'><div align='center' class='Estilo10'><span class='Estilo11'>MANZANA</span></div></td>
                                        <td width='6%' valign='bottom'><div align='center' class='Estilo10'><span class='Estilo11'>LOTE</span></div></td>
                                        <td width='6%' valign='bottom'><div align='center' class='Estilo10'><span class='Estilo11'>EDIFICA</span></div></td>
                                        <td width='6%' valign='bottom'><div align='center' class='Estilo10'><span class='Estilo11'>ENTRADA</span></div></td>
                                        <td width='6%' valign='bottom'><div align='center' class='Estilo10'><span class='Estilo11'>PISO</span></div></td>
                                        <td width='6%' valign='bottom'><div align='center' class='Estilo10'><span class='Estilo11'>UNIDAD</span></div></td>
                                        <td width='6%' valign='bottom'><div align='left' class='Estilo10'>
                                          <div align='center'><span class='Estilo11'>&nbsp;&nbsp;DC</span></div>
                                        </div></td>
						</tr>
						 <tr>
						 	<td width='3%' height='24'><div align='center'><img src='../img/casilla_roja/3.png' width='17' height='17' border='0' /></div></td>
							<td width='13%' height='24'><div align='left'>CÓDIGO DE REFERENCIA CATASTRAL </div></td>
                                        <td><div align='center'>
                                          <input name='dg_dep' class='2' type='text' id='dg_dep' value='".$Dep."' size='2' maxlength='2' readonly />
                                        </div></td>
                                        <td><div align='center'>
                                          <input name='dg_pro' type='text' class='2' id='dg_pro' value='".$Pro."' size='2' maxlength='2' readonly />
                                        </div></td>
                                        <td><div align='center'>
                                          <input name='dg_dis' class='2' type='text' id='dg_dis' value='".$Dis."' size='2' maxlength='2'  readonly />
                                        </div></td>
                                        <td><div align='center'>
                                          <input name='dg_sector' class='2' type='text' id='dg_sector' size='2' maxlength='2' ".$N.' '.$DC.' '.$ev_2." />
                                        </div></td>
                                        <td><div align='center'>
                                          <input name='dg_manzana' type='text' class='2' id='dg_manzana' size='2' maxlength='3' ".$N.' '.$DC." />
                                        </div></td>
                                        <td><div align='center'>
                                          <input name='dg_lote' type='text' class='2' id='dg_lote' size='2' maxlength='3' ".$N.' '.$DC." />
                                        </div></td>
                                        <td><div align='center'>
                                          <input name='dg_edificacion' type='text' class='2' id='dg_edificacion' size='2' maxlength='2' ".$N.' '.$DC." />
                                        </div></td>
                                        <td><div align='center'>
                                          <input name='dg_entrada' value='99' type='text' class='2' id='dg_entrada' size='2' maxlength='2' ".$N.' '.$DC." readonly='readonly'/>
                                        </div></td>
                                        <td><div align='center'>
                                          <input name='dg_piso' value='99' type='text' class='2' id='dg_piso' size='2' maxlength='2' ".$N.' '.$DC." readonly='readonly'/>
                                        </div></td>
                                        <td><div align='center'>
                                          <input name='dg_unidad' value='999' type='text' class='2' id='dg_unidad' size='2' maxlength='3' ".$N.' '.$DC." readonly='readonly'/>
                                        </div></td>
                                        <td><div align='center'>
                                          <input name='dg_dc' type='text' id='dg_dc' size='2' maxlength='1' ".$DC." />
                                        </div></td>
						 </tr>
						 <tr><td>&nbsp;</td></tr>
						  <tr>
						    <td>&nbsp;</td>
						    <td><div align='left'>INGRESE N&Uacute;MERO DE FICHA</div></td>
						    <td colspan='11'><div align='left'>
                              <input  type='text' name='nro_ficha' id='nro_ficha' maxlength='7' size='7' style='text-align:center' onkeypress='javascript:return validar_numeros(event)' onchange='javascript:valida_nro_ficha_BC(this)' />
                            </div></td>
						  </tr>
						  
					</table>";
					}
						?>
              <div align="center"></div>
             </label>
             <div align="center"></div>
             <div align="center"></div>
             <label id="economica" style="display:block;"></label>
            <label>
            <div align="center"></div></td>
            </tr>
         
         
        <tr>
          <td colspan="3"><div align="center">
            <label>
            <input class="booton" type="submit" name="enviar" id="enviar" value="Continuar" />
    &nbsp;&nbsp;&nbsp;        </label>
            <label>
             <input class="booton" type="button" name="cancelar" id="cancelar" value="Cancelar"  onclick="javascript:redireccionar(<?php echo $sw;?>)"/>
            </label>
          </div></td>
        </tr>
        <tr>
          <td colspan="3">     </td>
        </tr>
        <tr>
        <td colspan="5"></td>
      </tr>
  	</table>
   </td>
  </tr>
</table>
 </form>
 </div>
</body>
</html>