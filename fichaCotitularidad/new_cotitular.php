<?php session_start();
//header("Content-type: text/html; charset=utf-8");
include '../funciones/verifica_ubigeo.php'; //sesiones de UBIGEO
include '../funciones/genera_ubigeo.php';
include '../configuracion/eventos.php';
include 'proceso_cot/C_combos.php';

//recibimos 
$nro_titulares=$_GET['titu'];
$nro_ficha=$_GET['nro'];
$cod_ref=trim($_GET['cr']);

$Dep=$_SESSION['dep'];
$Pro=$_SESSION['pro'];
$Dis=$_SESSION['dis'];
$Ubigeo=$_SESSION['ubigeo'];


if(!isset($_SESSION['sector']))
{	
	$sw=0;
	$campo_1='';
	$campo_2='';
	$campo_3=substr($cod_ref,6,2);
	$campo_4=substr($cod_ref,8,3);
	$campo_5=substr($cod_ref,11,3);
	$campo_6=substr($cod_ref,14,2);
	$campo_7=substr($cod_ref,16,2);
	$campo_8=substr($cod_ref,18,2);
	$campo_9=substr($cod_ref,20,3);
	$campo_10=substr($cod_ref,23,1);
	$campo_11='';
}
else
{ 	//viene directamente de INDIVIDUAL
	//existen sesiones de CODIGO REFERENCIAL
	$sw=1;	
	$campo_1=$_SESSION['cuc8'];
	$campo_2=$_SESSION['cuc4'];
	$campo_3=$_SESSION['sector'];
	$campo_4=$_SESSION['manzana'];
	$campo_5=$_SESSION['lote'];
	$campo_6=$_SESSION['edifica'];
	$campo_7=$_SESSION['entrada'];
	$campo_8=$_SESSION['piso'];
	$campo_9=$_SESSION['unidad'];
	$campo_10=$_SESSION['dc'];
	$campo_11=$_SESSION['hojacatastral'];
	//echo ' '.$l.' '.$campo_1.' '.$campo_2.' '.$campo_3.' '.$campo_4.' '.$campo_5.' '.$campo_6.' '.$campo_7.' '.$campo_8.' '.$campo_9.' '.$campo_10;
}
?>
<script type="text/javascript" src="../js/mascara.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>
<script language="javascript" src="../js/funciones_validar.js"></script>
<script type="text/javascript" src="../js/valida_campo.js"></script>
<script type="text/javascript" src="../js/valida_campos_titular.js"></script>
<script language="JavaScript"  src="../js/popcalendar.js"></script>
<script type="text/javascript" src="../js/cascade_cotitular.js" ></script>
<script type="text/javascript" src="../js/datos_minimos_C.js"></script>
<script type="text/javascript" src="../js/no_f5.js"></script>
<script type="text/javascript" src="../js/valida_clones.js"></script>

<link href="../css/estilo_form.css" rel="stylesheet" type="text/css"/>
<link href="../css/link.css" rel="stylesheet" type="text/css">
<link href="../css/tabla.css" rel="stylesheet" type="text/css">
<link href="../css/botones.css" rel="stylesheet" type="text/css">
<link href="../css/combos.css" rel="stylesheet" type="text/css">
<link  href="../css/popcalendar.css" rel="stylesheet" type="text/css"> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<style type="text/css">
<!--
.Estilo12 {color: #FFFFFF}
-->
</style>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<title>Ficha Catastral Urbana Cotitulares / ST-SNCP SECRETARIA TÉCNICA</title>
<style type="text/css">
<!--
.Estilo6 {
	color: #FFFFFF;
	font-weight: bold;
}
.Estilo7 {
	color: #FFFFFF;
	font-size: 16px;
	font-weight: bold;
}
.Estilo9 {font-size: 9px}
.Estilo10 {font-size: 8px}
.Estilo11 {font-family: Verdana, Arial, Helvetica, sans-serif}
-->
</style>
</head>
<body onLoad="javascript:ponerfoco_2()" onkeypress="javascript:if(event.keyCode==13)return false;" onKeyDown="javascript:no_f5(this);">
<div align="center">
<form  class="myform" name="datos" action="proceso_cot/C_graba_cotitular.php"  method="post" onSubmit="return datos_minimos_cotitular()" autocomplete="off">
<!--<form  class="myform" name="datos" method="post" action="proceso_ind/I_graba_individual.php?pag=?php echo $cad;?>" onSubmit="return datos_minimos_individual()" autocomplete="off">!-->
<div align="center">
<table width="980px" border="1" align="center" cellPadding="0" cellSpacing="0" bordercolor="#000000">
    <tr>
      <td colspan="6" bgcolor="#0052A4" class="Titulo1"><div align="center" class="Estilo7"><span class="Estilo12">FICHA CATASTRAL URBANA COTITULARIDAD</span></div></td>
    </tr>
    <tr>
      <td colspan="6">
			<br>
		<table width="980px" border="0" cellpadding="0" cellspacing="0" class="tabla">
			<tr>
				<td width="192">&nbsp;</td>
				<td width="291"><div align="left">N&Uacute;MERO DE FICHA
                <?php 
				  if(!isset($nro_ficha))
					 echo "<input type='text' class='casilla' name='numficha' id='numficha' value='' size='7' maxlength='7' ".$N.' '.$ev_1." />";
				  else
					  echo "<input type='text' class='casilla' name='numficha' id='numficha' value='".$nro_ficha."' size='7' maxlength='7' readonly/>";
                ?>
			    </div></td>
				<td width="75">&nbsp;</td>
				<td width="181"><div align="left">N&Uacute;MERO DE FICHAS POR LOTE&nbsp;</div></td>
				<td width="241"><input type="text" name="numflote1"value="" size="1" maxlength="2" id="numflote1" <?php echo $N;?>/>
			    <input type="text" name="numflote2"  value="" size="1" maxlength="2" id="numflote2" <?php echo $N;?>/></td>
			</tr>
			<tr>
				
		    <td colspan="5">
					<br>
					<table width="960" border="0" align="center">
                  <tr>
                    <td width="146"><div align="center"><img src="../img/SNCP.PNG" width="144" height="57" /></div></td>
                    <td width="639"><div align="center">
                      <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
                        <tr>
                          <td><div align="center">
                            <table width="630" border="0" cellpadding="0" cellspacing="0" class="tabla" style="vertical-align:middle">
                              <tr>
                                <td colspan="16"><strong>DATOS GENERALES: </strong></td>
                              </tr>
                              <tr>
                                <td width="16%" height="24" valign="middle"><div align="center"><img src="../img/casilla_azul/1.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                                <td width="15%" valign="middle">C&Oacute;DIGO UNICO CATASTRAL - CUC </td>
                                <td colspan="4">
                                 <?php 
                                    echo "<input name='dg_cuc8' type='text' id='dg_cuc8' size='8' maxlength='8' ".$N." value='".$campo_1."' />
                                    <input name='dg_cuc4' type='text' size='2' maxlength='4' id='dg_cuc4' ".$N." value='".$campo_2."' />"
                                    ?>
                                    </td>
                                <td><div align="center"><img src="../img/casilla_azul/2.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                                <td colspan="4">C&Oacute;DIGO HOJA CATASTRAL</td>
                                <td colspan="2"><div align="right">
                                   <?php 
                                    echo "<input name='dg_hojacatastral' type='text' id='dg_hojacatastral' size='8' maxlength='10' ".$N." value='".$campo_11."'/>";
                                    ?> 
                                </div></td>
                              </tr>
                              <tr>
                                <td height="12" colspan="2">&nbsp;</td>
                                <td width="3%" valign="bottom"><div align="center" class="Estilo10"><span class="Estilo11">DPTO.</span></div></td>
                                <td width="3%" valign="bottom"><div align="center" class="Estilo10"><span class="Estilo11">PROV.</span></div></td>
                                <td width="6%" valign="bottom"><div align="center" class="Estilo10"><span class="Estilo11">DIST.</span></div></td>
                                <td width="11%" valign="bottom"><div align="center" class="Estilo10"><span class="Estilo11">SECTOR</span></div></td>
                                <td width="5%" valign="bottom"><div align="center" class="Estilo10"><span class="Estilo11">MANZANA</span></div></td>
                                <td width="3%" valign="bottom"><div align="center" class="Estilo10"><span class="Estilo11">LOTE</span></div></td>
                                <td width="4%" valign="bottom"><div align="center" class="Estilo10"><span class="Estilo11">EDIFICA</span></div></td>
                                <td width="5%" valign="bottom"><div align="center" class="Estilo10"><span class="Estilo11">ENTRADA</span></div></td>
                                <td width="8%" valign="bottom"><div align="center" class="Estilo10"><span class="Estilo11">PISO</span></div></td>
                                <td width="4%" valign="bottom"><div align="center" class="Estilo10"><span class="Estilo11">UNIDAD</span></div></td>
                                <td width="6%" valign="bottom"><div align="left" class="Estilo10"><span class="Estilo11">&nbsp;&nbsp;DC</span></div></td>
                              </tr>
                              <tr>
                                <td height="24"><div align="center"><img src="../img/casilla_roja/3.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                                <td height="24">C&Oacute;DIGO DE REFERENCIA CATASTRAL </td>
                                <td><div align="center">
                                  <input name="dg_dep" class="2" type="text" id="dg_dep" value="<?php echo $Dep;?>" size="2" maxlength="2" readonly="readonly" />
                                </div></td>
                                <td><div align="center">
                                  <input name="dg_pro" type="text" class="2" id="dg_pro" value="<?php echo $Pro;?>" size="2" maxlength="2" readonly="readonly" />
                                </div></td>
                                <td><div align="center">
                                  <input name="dg_dis" class="2" type="text" id="dg_dis" value="<?php echo $Dis;?>" size="2" maxlength="2"  readonly="readonly" />
                                </div></td>
                                <?php 
								//Impresión de INPUTs según sea llamada la ficha - CODIGO REFERENCIAL
								
									echo "<td><input name='dg_sector' class='2' type='text' id='dg_sector' size='2' value=".$campo_3." maxlength='2' ".$N.' '.$DC.' '.$ev_2."></td>";
									echo "<td><input name='dg_manzana' type='text' class='2' id='dg_manzana' size='2' value=".$campo_4." maxlength='3' ".$N.' '.$DC."></td>";
									echo "<td><input name='dg_lote' type='text' class='2' id='dg_lote' size='2' value=".$campo_5." maxlength='3' ".$N.' '.$DC."></td>";
									echo "<td><input name='dg_edificacion' type='text' class='2' id='dg_edificacion' size='2' value=".$campo_6." maxlength='2' ".$N.' '.$DC."></td>";
									echo "<td><input name='dg_entrada' type='text' class='2' id='dg_entrada' size='2' value=".$campo_7." maxlength='2' ".$N.' '.$DC."></td>";
									echo "<td><input name='dg_piso' type='text' class='2' id='dg_piso' size='2' value=".$campo_8." maxlength='2' ".$N.' '.$DC."></td>";
									echo "<td><input name='dg_unidad' type='text' class='2' id='dg_unidad' size='2' value=".$campo_9." maxlength='3' ".$N.' '.$DC."></td>";
									echo "<td><input name='dg_dc' type='text' id='dg_dc' size='2' value=".$campo_10." maxlength='1' ".$DC."></td>";
                              
                                ?>
                                <td width="11%">&nbsp;</td>
                              </tr>
                              <tr>
                                <td height="24">&nbsp;</td>
                                <td height="24" colspan="13"><input name="contador1" type="text" class="contador" id="contador1" value="0" size="2" maxlength="2"/>
                                    <input name="contador2" type="text" class="contador" id="contador2" value="0" size="2" maxlength="2"/>
                                    <input name="contador3" type="text" class="contador" id="contador3" value="0" size="2" maxlength="2"/>
                                    <input name="contador4" type="text" class="contador" id="contador4" value="0" size="2" maxlength="2"/>
                                    <input name="contador5" type="text" class="contador" id="contador5" value="0" size="2" maxlength="2"/>
                                    <input name="anio" type="text" class="contador" id="anio" value='<?php $anio=date("Y"); echo $anio;?>' size="4" maxlength="4"/>
                                    <input name="previo" type="text" class="contador" id="previo" maxlength="19"/>
                                    <input name="tipo" type="text" class="contador" id="tipo" size="2" maxlength="2"/>
                                    <input name="total" type="text" class="contador" id="total" value="<?php echo $nro_titulares;?>" size="2" maxlength="2"/>
                                    </td>
                                </tr>
                            </table>
                          </div></td>
                        </tr>
                      </table>
                    </div></td>
                    <td width="144"><div align="center"><img src="../img/SNCP.PNG" width="144" height="57" /></div></td>
                  </tr>
                </table>
				    <div align="center"><br>	 
		            </div></td>
			</tr>
		</table>
						        <!-- AQUI SE CREAN EL NÚMERO DE REGISTROS DE ACUERDO A NRO TITULARES -->
        <?php //
	for($i=0;$i<$nro_titulares;$i++) 
	{		
       echo "<table width='960px' border='1' align='center' cellpadding='0' cellspacing='0' bordercolor='#000000'>
			<tr>
				<td>
				<table width='950px' border='0' align='center' cellpadding='0' cellspacing='0' class='tabla'>
                   <tr><td class='etiquetanegra' colspan='4' height='30'>&nbsp;<strong>DATOS DEL COTITULAR CATASTRAL:</strong></td>
				   		 <td height='60'>&nbsp;</td>
                         <td height='60'>&nbsp;</td>
                         <td width='47'  height='50' background='../img/user/titular.png' ><div align='center' class='Estilo6' style='vertical-align:sub'>".($i+1)."</div></td>
				   </tr>
                   <tr id='personanatural'></tr>
                       <td colspan='4'>
							<table  id='ficha_nro-".($i)."' width='100%' align='center' cellpadding='0' cellspacing='0' class='tabla'>
                                <tr>
                                    	<td><div align='center'><img src='../img/casilla_azul/124.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td>NÚMERO DE COTITULAR</td>
                                        <td><input name='dcc_nro_cotitular-".($i)."' type='text' size='8' id='dcc_nro_cotitular-".($i)."' value='".($i+1)."' readonly onkeyup='validar_todo_mayus(this)' /></td>
                                        <td><div align='center'><img src='../img/casilla_azul/125.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                        <td>TOTAL DE COTITULARES</td>
                                        <td><input name='dcc_total_cotitular-".($i)."' type='text' size='8' id='dcc_total_cotitular-".($i)."' value='".$nro_titulares."' readonly onkeyup='validar_todo_mayus(this)' /></td>
                                </tr>
                                    <tr>
                                      <td width='26' height='24' class='etiqueta'><div align='center'><img src='../img/casilla_roja/126.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td width='156' height='24' class='etiqueta'>TIPO DE TITULAR</td>
                                      <td width='281'>"; echo generaCombo(38,$i); echo"</td>
                                      <td width='29' height='24' class='etiqueta'><div align='center'><img src='../img/casilla_roja/127.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td width='167' height='24' class='etiqueta'>% DEL COTITULAR</td>
                                      <td><input name='dcc_porcentaje-".($i)."' type='text' size='8' id='dcc_porcentaje-".($i)."'".$N.$Decimal." /></td>
									</tr>                                  
                                    <tr>
                                        <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/4.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                        <td height='24' class='etiqueta'>CÓDIGO DEL CONTRIBUYENTE</td>
                                      <td width='281'><input name='dg_codcontribuyente-".($i)."' type='text' size='8' id='dg_codcontribuyente-".($i)."' onkeyup='validar_todo_mayus(this)' /></td>
										<td width='29' height='24' class='etiqueta'>&nbsp;</td>
                                        <td width='167' height='24' class='etiqueta'>&nbsp;</td>
                                        <td width='289'>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/26.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                        <td height='24' class='etiqueta'><em>TIPO DOC. IDENTIDAD</em></td>
                                      <td height='24' class='etiqueta'>"; echo generaCombo(37,$i); echo "</td>
                                        <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/27.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                        <td height='24' class='etiqueta'><em>N&Uacute;MERO DE DOCUMENTO</em></td>
                                        <td height='24' class='etiqueta'><input type='text' class='casilla' name='itc_numdoc-".($i)."' id='itc_numdoc-".($i)."'  size='9' onkeypress='return validar_numeros(event)' disabled='true'/></td>
									</tr>
                                    <tr>
                                        <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/28.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                        <td height='24' class='etiqueta'><em>NOMBRES</em></td>
                                      <td height='24' class='etiqueta'><input name='itc_nombre_".($i)."' type='text' class='casillaLarga' value='' size='32' id='itc_nombre_".($i)."' onkeypress='return letras(event)' onkeyup='validar_todo_mayus(this)' disabled='true'/></td>
                                        <td height='24' class='etiqueta'>&nbsp;</td>
                                        <td height='24' class='etiqueta'>&nbsp;</td>
                                        <td height='24' class='etiqueta'>&nbsp;</td>
                                    </tr>
                                    <tr>
                                      <td height='12' class='etiqueta'><div align='center'><img src='../img/casilla_azul/29.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='12' class='etiqueta'><em>APELLIDO PATERNO</em></td>
                                      <td height='12' class='etiqueta'><input type='text' class='casilla' name='itc_paterno_".($i)."' value='' size='32' id='itc_paterno_".($i)."' onkeypress='return letras(event)' onkeyup='validar_todo_mayus(this)' disabled='true'/></td>
                                      <td height='12' class='etiqueta'><div align='center'><img src='../img/casilla_azul/30.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='12' class='etiqueta'><em><em>APELLIDO MATERNO</em></em></td>
                                      <td height='12' class='etiqueta'><input type='text' class='casilla' name='itc_materno_".($i)."' value='' size='40' id='itc_materno_".($i)."' onkeypress='return letras(event)' onkeyup='validar_todo_mayus(this)' disabled='true'/></td>
                                    </tr>
                                    <tr>
                                      <td height='12' colspan='6' class='etiqueta'>&nbsp;</td>
                                    </tr>
                                    <tr>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/31.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>N&Uacute;MERO DE RUC</td>
                                      <td><input type='text' class='casilla' name='itc_ruc-".($i)."' value='' size='11' maxlength='11' id='itc_ruc-".($i)."' onKeyPress='return validar_numeros(event)' disabled='true'/></td>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/32.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>RAZON SOCIAL</td>
                                      <td><input name='itc_razsocial-".($i)."' type='text' class='casillaLarga' value='' size='40' id='itc_razsocial-".($i)."' onkeyup='validar_todo_mayus(this)' disabled='true'/></td>
                                    </tr>
                                    <tr>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/47.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>FORMA DE ADQUISICI&Oacute;N</td>
                                      <td>"; echo generaCombo(39,$i);  echo "</td>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_roja/48.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>FECHA DE ADQUISICI&Oacute;N</td>
                                      <td><input name='ct_fechaadq_".($i)."' type='text' class='casillaFecha' id='ct_fechaadq_".($i)."' value='' size='15' maxlength='10' ".$VF."/>
&nbsp;<img src='../img/calendarIcon.gif' onclick='popUpCalendar(this, ct_fechaadq_".($i).", &quot;dd/mm/yyyy&quot;)' style='cursor:pointer' width='16' height='16' border='0' title='Ingresar Fecha'/></td>
                                    </tr>
                                    <tr>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/34.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>COND. ESP. DEL TITULAR</td>
                                      <td>"; echo generaCombo(40,$i); echo "</td>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/35.png' alt='Guardar estado?' width='17' height='17' border='0' disabled='true'/></div></td>
                                      <td height='24' class='etiqueta'>Nº RESOL. EXONERACION</td>
                                      <td><input type='text' class='casillaFecha' name='itc_numresexo-".($i)."' value='' size='9' maxlength='10' id='itc_numresexo-".($i)."' onkeyup='validar_todo_mayus(this)' disabled='true'/></td>
                                    </tr>
                                    <tr>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/37.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>INICIO EXONERACION</td>
                                      <td><input name='itc_fechainiexo_".($i)."' type='text' id='itc_fechainiexo_".($i)."' value='' size='15' maxlength='10' ".$VF." disabled='true'/>      <img src='../img/calendarIcon.gif' onClick='popUpCalendar(this, itc_fechainiexo_".($i).", &quot;dd/mm/yyyy&quot;)' style='cursor:pointer' width='16' height='16' border='0' title='Ingresar Fecha'/></td>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/38.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>FIN EXONERACION</td>
                                      <td><input name='itc_fechafinexo_".($i)."' type='text' id='itc_fechafinexo_".($i)."' value='' size='15' maxlength='10' ".$VF." disabled='true'/>      <img src='../img/calendarIcon.gif' onClick='popUpCalendar(this, itc_fechafinexo_".($i).", &quot;dd/mm/yyyy&quot;)' style='cursor:pointer' width='16' height='16' border='0' title='Ingresar Fecha'/></td>
                                    </tr>
                                    <tr>
                                      <td height='24' colspan='6' class='etiqueta'>&nbsp;</td>
                                    </tr>
                                    <tr>
                                      <td height='24' colspan='6' class='etiqueta'><span class='etiquetanegra'> &nbsp;<strong>DOMICILIO FISCAL DEL COTITULAR CATASTRAL: </strong></span></td>
                                    </tr>
                                    <tr>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_roja/39.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>DEPARTAMENTO</td>
                                      <td>"; echo generaDep($i); echo "</td>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_roja/40.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>PROVINCIA</td>
                                      <td><select class='select' disabled='disabled' name='provincias".($i)."' id='provincias".($i)."' onchange='cargaContenido2(this.id)'>
                                        
                                      </select></td>
                                    </tr>
                                    <tr>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_roja/41.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>DISTRITO</td>
                                      <td><select disabled='disabled' name='distritos".($i)."' id='distritos".($i)."'>
                                        
                                      </select></td>
                                      <td height='24' class='etiqueta'>&nbsp;</td>
                                      <td height='24' class='etiqueta'>&nbsp;</td>
                                      <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/42.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>TEL&Eacute;FONO</td>
                                      <td><input type='text' class='casilla' name='dftc_telf-".($i)."' value='' size='10' maxlength='12' id='dftc_telf-".($i)."' onkeyup='validar_todo_mayus(this)'/></td>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/43.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>ANEXO</td>
                                      <td><input type='text' class='casilla' name='dftc_anexo-".($i)."' value='' size='2' maxlength='8' id='dftc_anexo-".($i)."' onkeyup='validar_todo_mayus(this)'/></td>
                                    </tr>
                                    <tr>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/44.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>FAX</td>
                                      <td><input type='text' class='casilla' name='dftc_fax-".($i)."' value='' size='10' maxlength='12' id='dftc_fax-".($i)."' /></td>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/45.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>CORREO ELECTR&Oacute;NICO</td>
                                      <td><input name='dftc_email-".($i)."' type='text' class='casillaLarga' id='dftc_email-".($i)."' value='' size='40' onkeyup='EmailCheck(this)'/></td>
                                    </tr>
                                    <tr>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/7.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>C&Oacute;DIGO DE V&Iacute;A</td>
                                      <td><input type='text' class='casilla' name='dftc_codvia-".($i)."' value='' size='5' maxlength='6' id='dftc_codvia-".($i)."' onchange='trae_via(this)'/></td>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/8.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>TIPO DE V&Iacute;A</td>
                                      <td><input class='input'  id='dftc_tipovia-".($i)."' name='dftc_tipovia-".($i)."' type='text' size='5'  readonly/></td>
                                    </tr>
                                    <tr>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/9.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>NOMBRE DE V&Iacute;A</td>
                                      <td><input name='dftc_nomvia-".($i)."' type='text' class='casillaLarga'value='' size='32' id='dftc_nomvia-".($i)."' readonly/></td>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/11.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>N&Uacute;MERO MUNICIPAL</td>
                                      <td><input type='text' class='casilla' name='dftc_nummuni-".($i)."' value='' size='5' maxlength='6' id='dftc_nummuni-".($i)."'/></td>
                                    </tr>
                                    <tr>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/14.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>NOMBRE DE EDIFICACI&Oacute;N</td>
                                      <td><input name='dftc_nomedi-".($i)."' type='text' class='casillaLarga' id='dftc_nomedi-".($i)."' value='' size='32'/></td>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/17.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>N&Uacute;MERO INTERIOR</td>
                                      <td><input type='text' class='casilla' name='dftc_numint-".($i)."' value='' size='2' maxlength='4' id='dftc_numint-".($i)."'/></td>
                                    </tr>
                                    <tr>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/18.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>C&Oacute;DIGO H.U.</td>
                                      <td><input type='text' class='casilla' name='dftc_codhu-".($i)."' value='' size='2' maxlength='4' id='dftc_codhu-".($i)."' onchange='trae_HU2(this)'/></td>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/19.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>NOMBRE DE LA H.U.</td>
                                      <td><input name='dftc_nomhu-".($i)."' type='text' class='casillaLarga'value='' size='40' id='dftc_nomhu-".($i)."' readonly/></td>
                                    </tr>
                                    <tr>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/20.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>ZONA/SECTOR/ETAPA</td>
                                      <td><input type='text' class='casilla' name='dftc_zse-".($i)."' value='' size='20' maxlength='20' id='dftc_zse-".($i)."'/></td>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/21.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>MANZANA</td>
                                      <td><input type='text' class='casilla' name='dftc_mzna-".($i)."' value='' size='2' maxlength='3' id='dftc_mzna-".($i)."'/></td>
                                    </tr>
                                    <tr>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/22.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>LOTE</td>
                                      <td><input type='text' class='casilla' name='dftc_lote-".($i)."' value='' size='2' maxlength='5' id='dftc_lote-".($i)."'/></td>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/23.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>SUB-LOTE</td>
                                      <td><input type='text' class='casilla' name='dftc_sublote-".($i)."' value='' size='2' maxlength='6' id='dftc_sublote-".($i)."'/></td>
                                    </tr>
								</table>
						      <br>
							</td>
						<tr id='personajuridica'></tr>
		</table>
				</td>
			</tr>
										  <br>
		</table>";
        }
        ?> 
		<!-------- AQUI TERMINA EL BUCLE --------->
		<table width="980px0" align="center" cellPadding="0" cellSpacing="0" class="clsTabla2">
            <tr>
                <td>              </td>
            </tr>
        </table>
			<br>
			    
			<table width="960px" border="1" align="center" cellPadding="0" cellSpacing="0" bordercolor="#000000" class="clsTabla2">
   <tr>
     <td>
	 <table width="950px" border="0" align="center" cellpadding="0" cellspacing="0" class="tabla">
     <tr>
       <td class="etiquetanegra" colspan="6" height="30">&nbsp;<strong>INFORMACI&Oacute;N COMPLEMENTARIA: </strong></td>
     </tr>
     <tr>
       <td width="3%" class="etiqueta" height="24"><div align="center"><img src="../img/casilla_azul/114.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
       <td width="18%" class="etiqueta">CONDICI&Oacute;N DE DECLARANTE</td>
       <td width="28%" height="24"><?php generaCombo(18,0); ?></td>
       <td width="3%" height="24"><div align="center"><img src="../img/casilla_roja/116.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
       <td width="17%" height="24"><span class="etiqueta">ESTADO DE LA FICHA</span></td>
       <td width="31%" height="24"><?php generaCombo(19,0); ?></td>
     </tr>
     <tr>
       <td height="10" colspan="6" class="etiqueta">&nbsp;</td>
       </tr>
     <tr>
       <td colspan="6">&nbsp;</td>
     </tr>
     
   </table>
	 </td>
   </tr>
 </table>
			<br>
		<table width="960px" border="1" align="center" cellPadding="0" cellSpacing="0" bordercolor="#000000" class="clsTabla2">
      <tr>
         <td>
		 <table width="950px" border="0" align="center" cellpadding="0" cellspacing="0" class="tabla">
                        <tr>
                            <td class="etiquetanegra" colspan="4" height="30">
                                &nbsp;<strong>OBSERVACIONES:</strong></td>
                        </tr>
                        <tr>
                            <td width="20%" class="etiqueta" height="24">&nbsp;&nbsp;OBSERVACIONES</td>
                            <td colspan="3"><textarea name="observacion" rows="4" cols="65" <?php echo $M;?>> </textarea></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
            </table>
		 </td>
      </tr>
</table>
			<br>
        <table width="960px"  border="1" align="center" cellPadding="0"cellSpacing="0" bordercolor="#000000" class="clsTabla2">
            <tr>
                <td>
				<table width="950px" border="0" align="center" cellpadding="0" cellspacing="0" class="tabla">
                  <tr>
                    <td class="etiquetanegra" colspan="5" height="30">&nbsp;<strong>FIRMAS: </strong></td>
                  </tr>
                  <tr>
                    <td width="36" height="24" class="etiquetanegra"><div align="center"><img src="../img/casilla_azul/120.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                    <td width="153" class="etiquetanegra"><strong>DECLARANTE</strong></td>
                    <td class="etiquetanegra" height="24">&nbsp;</td>
                    <td class="etiquetanegra" height="24">&nbsp;</td>
                    <td width="315" height="24" class="etiquetanegra">&nbsp;</td>
                  </tr>
                  <tr>
                    <td rowspan="3" class="etiqueta">&nbsp;</td>
                    <td height="24" class="etiqueta">DNI</td>
                    <td width="276"><input type="text" class="casilla" name="f_dni" value="" size="10" maxlength="8" id="f_dni" onKeyPress="return validar_numeros(event)"/></td>
                    <td width="170" class="etiqueta" height="24">NOMBRES</td>
                    <td><input name="f_nom" type="text" class="casillaLarga"value="" size="40" id="f_nom" onKeyPress="return letras(event)" onKeyUp="validar_todo_mayus(this)"/></td>
                  </tr>
                  <tr>
                    <td height="24" class="etiqueta">APELLIDO PATERNO</td>
                    <td width="276"><input name="f_paterno" type="text" class="casillaLarga" value="" size="32" id="f_paterno" onKeyPress="return letras(event)" onKeyUp="validar_todo_mayus(this)"/></td>
                    <td width="170" class="etiqueta" height="24">APELIDO MATERNO</td>
                    <td><input name="f_materno" type="text" class="casillaLarga" value="" size="40" id="f_materno" onKeyPress="return letras(event)" onKeyUp="validar_todo_mayus(this)"/> </td>
                  </tr>
                  <tr>
                    <td height="24" class="etiqueta">FECHA</td>
                    <td colspan="3"><input name="f_fecha" type="text" class="casillaFecha" id="f_fecha" value="" size="15" maxlength="10" <?php echo $VF;?>/>
                      &nbsp;<img src="../img/calendarIcon.gif" onClick="popUpCalendar(this, f_fecha, &quot;dd/mm/yyyy&quot;)" style="cursor:pointer" width="16" height="16" border="0" title="Ingresar Fecha"/></td>
                  </tr>
                  <tr>
                    <td class="etiquetanegra" height="24"><div align="center"><img src="../img/casilla_azul/121.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                    <td class="etiquetanegra" height="24"><strong>SUPERVISOR</strong></td>
                    <td class="etiquetanegra" height="24">&nbsp;</td>
                    <td class="etiquetanegra" height="24">&nbsp;</td>
                    <td class="etiquetanegra" height="24">&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="24" class="etiqueta">&nbsp;</td>
                    <td height="24" class="etiqueta">NOMBRES Y APELLIDOS</td>
                    <td width="276"><?php generaCombo(21,0); ?></td>
                    <td width="170" class="etiqueta" height="24">FECHA</td>
                    <td><input name="f_fechasup" type="text" class="casillaFecha" id="f_fechasup"  value="" size="15" maxlength="10" <?php echo $VF;?>/>
                      &nbsp;<img src="../img/calendarIcon.gif" onClick="popUpCalendar(this, f_fechasup, &quot;dd/mm/yyyy&quot;)" style="cursor:pointer" width="16" height="16" border="0" title="Ingresar Fecha"/>					</td>
				  </tr>
                  <tr>
                    <td class="etiquetanegra" height="24"><div align="center"><img src="../img/casilla_roja/122.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                    <td class="etiquetanegra" height="24"><strong>T&Eacute;CNICO CATASTRAL</strong></td>
                    <td class="etiquetanegra" height="24">&nbsp;</td>
                    <td class="etiquetanegra" height="24">&nbsp;</td>
                    <td class="etiquetanegra" height="24">&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="24" class="etiqueta">&nbsp;</td>
                    <td height="24" class="etiqueta">NOMBRES Y APELLIDOS</td>
                    <td width="276"><?php generaCombo(22,0); ?></td>
                    <td width="170" class="etiqueta" height="24">FECHA</td>
                    <td><input name="f_fechatec" type="text" class="casillaFecha" id="f_fechatec"value="" size="15" maxlength="10"<?php echo $VF;?>/>
                      &nbsp;<img src="../img/calendarIcon.gif" onClick="popUpCalendar(this, f_fechatec, &quot;dd/mm/yyyy&quot;)" style="cursor:pointer" width="16" height="16" border="0" title="Ingresar Fecha"/></td>
                  </tr>
                  <tr>
                    <td class="etiquetanegra" height="24"><div align="center"><img src="../img/casilla_azul/123.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                    <td class="etiquetanegra" height="24"><strong>VERIFICADOR CATASTRAL</strong></td>
                    <td class="etiquetanegra" height="24">&nbsp;</td>
                    <td class="etiquetanegra" height="24">&nbsp;</td>
                    <td class="etiquetanegra" height="24">&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="24" class="etiqueta">&nbsp;</td>
                    <td height="24" class="etiqueta">NOMBRES Y APELLIDOS</td>
                    <td width="276"><?php generaCombo(23,0); ?></td>
                    <td width="170" class="etiqueta" height="24">FECHA</td>
                    <td colspan="3"><input name="f_fechaver" type="text" class="casillaFecha" id="f_fechaver"value="" size="15" maxlength="10" <?php echo $VF;?>/>
                      &nbsp;<img src="../img/calendarIcon.gif" onClick="popUpCalendar(this, f_fechaver, &quot;dd/mm/yyyy&quot;)" style="cursor:pointer" width="16" height="16" border="0" title="Ingresar Fecha"/></td>
                  </tr>
                  <tr>
                    <td height="24" class="etiqueta">&nbsp;</td>
                    <td height="24" class="etiqueta">N&deg; REGISTRO</td>
                    <td colspan="3"><input type="text" class="casilla" name="f_numreg" value="" size="15" maxlength="10" id="f_numreg"/></td>
                  </tr>
                  <tr>
                    <td colspan="2">&nbsp;</td>
                  </tr>
				</table>			  </td>
            </tr>
            
        </table>
        <br>      
	  </td>
    </tr>
</table>
	<p align="center"><input name="bGuardar" type="submit" class="booton" value="Guardar Ficha" />
		&nbsp;&nbsp;&nbsp;
		<input name="bCancelar" type="button" class="booton" value="Cancelar" onClick="location='../form_inicio.php'"/>
	</p>
	<br>
</div>
</form>
</div>
</body>
</html>