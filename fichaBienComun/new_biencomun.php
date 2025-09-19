<?php session_start();

include '../funciones/verifica_ubigeo.php'; //sesiones de UBIGEO
include '../funciones/genera_dep.php';
include '../configuracion/eventos.php';
include 'proceso_bc/BC_combos.php';

//si viene desde el el menu
$nro_ficha=$_GET['nro'];
$cod_ref=trim($_GET['cr']);


$Dep=$_SESSION['dep'];
$Pro=$_SESSION['pro'];
$Dis=$_SESSION['dis'];
$ubigeo=$_SESSION['ubigeo'];

//si existe
if(isset($_GET['menu']))
	$menu=1;
else $menu=0;

if(!isset($_SESSION['sector']))
{	
	$sw=0;
	$campo_3=substr($cod_ref,6,2); //sector
	$campo_4=substr($cod_ref,8,3);	//manzana
	$campo_5=substr($cod_ref,11,3);	//lote
	$campo_6=substr($cod_ref,14,2);
	$campo_7=substr($cod_ref,16,2);
	$campo_8=substr($cod_ref,18,2);
	$campo_9=substr($cod_ref,20,3);
	$campo_10=substr($cod_ref,23,1);
}
else
{ 	//viene directamente de INDIVIDUAL
	//existen sesiones de CODIGO REFERENCIAL
	$sw=1;	
	//$campo_1=$_SESSION['cuc8'];
	//$campo_2=$_SESSION['cuc4'];
	$campo_3=$_SESSION['sector'];
	$campo_4=$_SESSION['manzana'];
	$campo_5=$_SESSION['lote'];
	//$campo_6=$_SESSION['edifica'];
	//$campo_7=$_SESSION['entrada'];
	//$campo_8=$_SESSION['piso'];
	//$campo_9=$_SESSION['unidad'];
	//$campo_10=$_SESSION['dc'];
	
	//echo ' '.$l.' '.$campo_1.' '.$campo_2.' '.$campo_3.' '.$campo_4.' '.$campo_5.' '.$campo_6.' '.$campo_7.' '.$campo_8.' '.$campo_9.' '.$campo_10;
}

?>
<!-- CODIGO AGREGADO-->
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery.addfield.js"></script>
<script language="javascript" src="../js/funciones_validar.js"></script>
<script type="text/javascript" src="../js/valida_clones.js"></script>
<script type="text/javascript" src="../js/valida_campo.js"></script>
<script type="text/javascript" src="../js/valida_campos_titular.js"></script>
<script language="JavaScript"  src="../js/popcalendar.js"></script>
<script type="text/javascript" src="../js/cascade.js" ></script>
<script type="text/javascript" src="../js/mascara.js"></script>
<script type="text/javascript" src="../js/datos_minimos_BC.js"></script>
<script type="text/javascript" src="../js/no_f5.js"></script>

<link href="../css/estilo_form.css" rel="stylesheet" type="text/css"/>
<link href="../css/link.css" rel="stylesheet" type="text/css">
<link href="../css/tabla.css" rel="stylesheet" type="text/css">
<link href="../css/botones.css" rel="stylesheet" type="text/css">
<link href="../css/combos.css" rel="stylesheet" type="text/css">
<link  href="../css/popcalendar.css" rel="stylesheet" type="text/css"> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<title>Ficha Catastral Urbana Individual / ST-SNCP SECRETARIA TÉCNICA</title>
<style type="text/css">
<!--
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
<body onLoad="javascript:ponerfoco_4()" onkeypress="javascript:if(event.keyCode==13)return false;" onKeyDown="javascript:no_f5(this);">
<div align="center">
<form  class="myform" name="datos" action="proceso_bc/BC_graba_biencomun.php"  method="post" onSubmit="return datos_minimos_biencomun()" autocomplete="off">
<!--<form  class="myform" name="datos" method="post" action="proceso_ind/I_graba_individual.php?pag=?php echo $cad;?>" onSubmit="return datos_minimos_individual()" autocomplete="off">!-->
<div align="center">
<table width="980px" border="1" align="center" cellPadding="0" cellSpacing="0" bordercolor="#000000">
    <tr>
      <td colspan="6" bgcolor="#0052A4" class="Titulo1"><div align="center" class="Estilo7">FICHA CATASTRAL URBANA BIENES COMUNES</div></td>
    </tr>
    <tr>
      <td colspan="6">
			<br>
		<table width="980px" border="0" cellpadding="0" cellspacing="0" class="tabla">
			<tr>
				<td width="192">&nbsp;</td>
				<td width="291"><div align="left">N&Uacute;MERO DE FICHA
				  <?php 
				  if(!isset($nro_ficha))//viene de individual
					 echo "<input type='text' class='casilla' name='numficha' id='numficha' value='' size='7' maxlength='7' ".$N.' '.$ev_1." />";
				  else	//viene del menu
					  echo "<input type='text' class='casilla' name='numficha' id='numficha' value='".$nro_ficha."' size='7' maxlength='7' readonly/>";
                ?>
				  </div></td>
				<td width="75">&nbsp;</td>
				<td width="181"><div align="left">N&Uacute;MERO DE FICHAS POR LOTE&nbsp;</div></td>
				<td width="241">
				  <input type="text" name="numflote1"value="" size="1" maxlength="2" id="numflote1" <?php echo $N;?>/>
				<input type="text" name="numflote2"  value="" size="1" maxlength="2" id="numflote2" <?php echo $N;?>/></td>
				
			</tr>
			<tr>
				<td colspan="6"><br>
					<div align="center">
					  <table width="943" border="0" align="center">
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
                                        <td colspan="4"><input name="dg_cuc8" type="text" id="dg_cuc8" size="8" maxlength="8" <?php echo $N;?> />
                                            <input name="dg_cuc4" type="text" size="2" maxlength="4" id="dg_cuc4" <?php echo $N;?> /></td>
                                        <td><div align="center"><img src="../img/casilla_azul/2.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                                        <td colspan="4">C&Oacute;DIGO HOJA CATASTRAL</td>
                                        <td colspan="2"><div align="right">
                                            <input name="dg_hojacatastral" type="text" id="dg_hojacatastral" size="8" maxlength="10" <?php echo $N;?> />
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
                                        <td width="6%" valign="bottom"><div align="left" class="Estilo10">
                                          <div align="center"><span class="Estilo11">&nbsp;&nbsp;DC</span></div>
                                        </div></td>
                                      </tr>
                                      <tr>
                                        <td height="24"><div align="center"><img src="../img/casilla_roja/3.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                                        <td height="24">C&Oacute;DIGO DE REFERENCIA CATASTRAL </td>
                                        <td><div align="center">
                                          <input name="dg_dep" class="2" type="text" id="dg_dep" value=<?php echo $Dep;?> size="2" maxlength="2" readonly />
                                        </div></td>
                                        <td><div align="center">
                                          <input name="dg_pro" type="text" class="2" id="dg_pro" value=<?php echo $Pro;?> size="2" maxlength="2" readonly />
                                        </div></td>
                                        <td><div align="center">
                                          <input name="dg_dis" class="2" type="text" id="dg_dis" value=<?php echo $Dis;?> size="2" maxlength="2"  readonly />
                                        </div></td>
                                        <?php 
										
											echo "<td><div align='center'>
                                              <input name='dg_sector' class='2' readonly type='text' id='dg_sector' size='2' value='".$campo_3."' maxlength='2' ".$N.' '.$DC.' '.$ev_2." />
                                            </div></td>
                                            <td><div align='center'>
                                              <input name='dg_manzana' type='text' readonly class='2' id='dg_manzana' size='2' value='".$campo_4."' maxlength='3' ".$N.' '.$DC." />
                                            </div></td>
                                            <td><div align='center'>
                                              <input name='dg_lote' type='text' readonly class='2' id='dg_lote' size='2' value='".$campo_5."' maxlength='3' ".$N.' '.$DC." />
                                            </div></td>";
										
										//echo $sw; 
										if($sw==0)
										{
											echo "<td><div align='center'>
											  <input name='dg_edificacion' readonly type='text' class='2' id='dg_edificacion' value='".$campo_6."' size='2' maxlength='2' ".$N.' '.$DC." />
											</div></td>
											<td><div align='center'>
											  <input name='dg_entrada' readonly type='text' class='2' id='dg_entrada' value='".$campo_7."'size='2' maxlength='2' ".$N.' '.$DC." />
											</div></td>
											<td><div align='center'>
											  <input name='dg_piso' readonly type='text' class='2' id='dg_piso' value='".$campo_8."'size='2' maxlength='2' ".$N.' '.$DC." />
											</div></td>
											<td><div align='center'>
											  <input name='dg_unidad' readonly type='text' class='2' id='dg_unidad' value='".$campo_9."'size='2' maxlength='3' ".$N.' '.$DC." />
											</div></td>
											<td><div align='center'>
											  <input name='dg_dc' readonly type='text' id='dg_dc' size='2' value='".$campo_10."' maxlength='1' ".$DC." />
											</div></td>";
                                      	}
										else
										{	?>
                                        <td><div align="center">
                                          <input name="dg_edificacion" type="text" class="2" id="dg_edificacion" size="2" maxlength="2" <?php echo $N.' '.$DC;?> />
                                        </div></td>
                                        <td><div align="center">
                                          <input name="dg_entrada" type="text" class="2" id="dg_entrada" size="2" maxlength="2" <?php echo $N.' '.$DC;?> />
                                        </div></td>
                                        <td><div align="center">
                                          <input name="dg_piso" type="text" class="2" id="dg_piso" size="2" maxlength="2" <?php echo $N.' '.$DC;?> />
                                        </div></td>
                                        <td><div align="center">
                                          <input name="dg_unidad" type="text" class="2" id="dg_unidad" size="2" maxlength="3" <?php echo $N.' '.$DC;?> />
                                        </div></td>
                                        <td><div align="center">
                                          <input name="dg_dc" type="text" id="dg_dc" size="2" maxlength="1" <?php echo $DC;?> />
                                        </div></td>
                                        <?php } ?>
                                      </tr>
                                      <tr>
                                        <td><div align="center"><img src="../img/casilla_azul/4.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                                        <td>C&Oacute;DIGO CONTRIBUYENTE DE RENTAS </td>
                                        <td colspan="3"><input name="dg_codcontribuyente" type="text" id="dg_codcontribuyente" onKeyUp="validar_todo_mayus(this)" size="8" maxlength="15" />                                        </td>
                                        <td><div align="center"></div></td>
                                        <td><div align="center"><img src="../img/casilla_azul/5.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                                        <td colspan="4">C&Oacute;DIGO PREDIAL DE RENTAS</td>
                                        <td>&nbsp;</td>
                                        <td><input name="dg_codpredial" type="text" id="dg_codpredial" onKeyUp="validar_todo_mayus(this)" size="8" maxlength="15" /></td>
                                        <td width="11%">&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td height="24">&nbsp;</td>
                                        <td height="24">&nbsp;</td>
                                        <td colspan="12"><input name="contador1" type="text" class="contador" id="contador1" value="0" size="2" maxlength="2"/>
                                            <input name="contador2" type="text" class="contador" id="contador2" value="0" size="2" maxlength="2"/>
                                            <input name="contador3" type="text" class="contador" id="contador3" value="0" size="2" maxlength="2"/>
                                            <input name="contador8" type="text" class="contador" id="contador8" value="0" size="2" maxlength="2"/>
                                            <input name="contador9" type="text" class="contador" id="contador9" value="0" size="2" maxlength="2"/>
                                            <input name="anio" type="text" class="contador" id="anio" value='<?php $anio=date("Y"); echo $anio;?>' size="4" maxlength="4"/>
                                            <input name="previo" type="text" class="contador" id="previo" size="25" maxlength="19"/>
                                        <input name="tipo" type="text" class="contador" id="tipo" size="2" maxlength="2"/>
                                        <input name="menu" type="text" class="contador" id="menu" value="<?php echo $menu;?>" size="2" maxlength="2"/></td>
                                      </tr>
                                    </table>
                                  </div></td>
                                </tr>
                              </table>
                          </div></td>
                          <td width="144"><div align="center"><img src="../img/SNCP.PNG" width="144" height="57" /></div></td>
                        </tr>
                      </table>
					  <br>				
				  </div></td>
			  </tr>
		</table> 
        <table width="960px" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
		  <tr>
			<td>
				<table width="960px" border="0" align="center" cellpadding="0" cellspacing="0" class="tabla">
                        <tr>
                            <td class="etiquetanegra" colspan="6" height="30">
                                &nbsp;<strong>UBICACI&Oacute;N DEL PREDIO CATASTRAL:</strong></td>
                        </tr>
                        <tr>
                          <td colspan="6" valign="top" align="center">
							<table width="940px" border="1" cellpadding="0" cellspacing="0" class="tabla">
                              <thead >
                                <tr class="principal" >
                                  <th width="20"><div align="center"><img src="../img/casilla_roja/7.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></th>
                                  <th width="51">C&Oacute;DIGO DE VIA</th>
                                  <th width="20"><div align="center"><img src="../img/casilla_azul/8.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></th>
                                  <th width="53">TIPO DE V&IacuteA </th>
                                  <th width="20"><div align="center"><img src="../img/casilla_azul/9.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></th>
                                  <th width="251">NOMBRE V&Iacute;A</th>
                                  <th width="20"><div align="center"><img src="../img/casilla_roja/10.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></th>
                                  <th width="87">TIPO PUERTA</th>
                                  <th width="20"><div align="center"><img src="../img/casilla_azul/11.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></th>
                                  <th width="69">N&ordm; MUNICIPAL</th>
                                  <th width="20"><div align="center"><img src="../img/casilla_azul/12.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></th>
                                  <th width="69">COND. N&Uacute;MERO </th>
                                  <th width="20"><div align="center"><img src="../img/casilla_azul/13.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></th>
                                  <th width="84">N&ordm; CERTIF.DE NUMERACI&Oacute;N </th>
                                  <th width="128" colspan="2" class="accion">ACCI&Oacute;N </th>
                                </tr>
                                <tr>
                                  <th class="celda" align="left" colspan="16">
                                  <div id="linea1_0" style="width:940px" >
                     			
                              <input name="upc_cod-0" type="text" class="input" id="upc_cod-0" style="width:75px"  onChange="pulsar_via(this)" maxlength="6"/>
                              <input class="input"  id="upc_tipo-0" name="upc_tipo-0" type="text" readonly style="width:70px"/>
                              <input class="input" id="upc_nom-0" name="upc_nom-0" type="text"  readonly="readonly" style="width:265px"/>
                              <?php generaCombo(25); ?>
                              <input name="upc_num-0" type="text" class="input" id="upc_num-0" style="width:85px" onKeyPress="return validar_numeros(event)" maxlength="20"/>
                              <?php generaCombo(36); ?>
                              <input name="upc_certi-0" type="text" class="input" id="upc_certi-0" style="width:100px" onKeyPress="return validar_numeros(event)" maxlength="10"/>
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="bt_plus" id="1" type="button" value="+" />
                                  </div></th>
                                </tr>
                              </thead>
                          </table><BR />		  </td>
					    </tr>
                                               <tr>
                            <td width="29" class="etiqueta" height="24">&nbsp;&nbsp;<img src="../img/casilla_azul/14.png" alt="Guardar estado?" width="17" height="16" border="0" /></td>
                            <td width="172" class="etiqueta">NOMBRE DE LA EDIFICACI&Oacute;N</td>
                          <td width="273"><input name="upc_nomedi" type="text" class="casillaLarga" value="" size="40" id="upc_nomedi" onKeyPress="return letras(event)" onKeyUp="validar_todo_mayus(this)"/></td>
							<td width="25" class="etiqueta" height="24"><div align="center"><img src="../img/casilla_azul/15.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                            <td width="180" class="etiqueta">TIPO DE EDIFICACI&Oacute;N</td>
                          <td width="281"><span class="etiqueta">
                            <?php generaCombo(1); ?>
                          </span></td>
                        </tr>
                        <tr>
                          <td height="24" class="etiqueta">&nbsp;&nbsp;<img src="../img/casilla_roja/18.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
                          <td height="24" class="etiqueta">C&OacuteDIGO H.U.</td>
                          <td>
                            <input name="upc_codhu" type="text" id="upc_codhu" onKeyPress="return validar_numeros(event)" size="4" maxlength="4" onChange="trae_HU1(this)">						  </td>
                          <td><div align="center"><img src="../img/casilla_azul/19.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                          <td>NOMBRE DE LA H.U.</td>
                          <td>
                            <input name="upc_nomhu" type="text" size="40" id="upc_nomhu" readonly>						  </td>
                        </tr>
                        <tr>
                            <td height="24" class="etiqueta">&nbsp;&nbsp;<img src="../img/casilla_azul/20.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
                            <td height="24" class="etiqueta">ZONA/SECTOR/ETAPA</td>
                            <td><input name="upc_zse" type="text" size="32" id="upc_zse" 
onKeyPress="return letras(event)" <?php echo $M;?>></td>
							<td><div align="center"><span class="etiqueta"><img src="../img/casilla_azul/21.png" alt="Guardar estado?" width="17" height="17" border="0" /></span></div></td>
                            <td><span class="etiqueta">MANZANA</span></td>
                            <td><input name="upc_mzna" type="text" size="4" maxlength="15" id="upc_mzna" <?php echo $M;?>></td>
                        </tr>      
                        <tr>
                            <td height="24" class="etiqueta">&nbsp;&nbsp;<img src="../img/casilla_azul/22.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
                            <td height="24" class="etiqueta">LOTE</td>
                            <td>
                                <input type="text" class="casilla" name="upc_lote" value="" size="4" maxlength="5" id="upc_lote" 
<?php echo $M;?>/></td>
                            <td><div align="center"><span class="etiqueta"><img src="../img/casilla_azul/23.png" alt="Guardar estado?" width="17" height="17" border="0" /></span></div></td>
                            <td><span class="etiqueta">SUB-LOTE</span></td>
                            <td><input type="text" class="casilla" name="upc_sublote"  value="" size="4" maxlength="4" id="upc_sublote" <?php echo $M;?> /></td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
				</table>
			</td>
		  </tr>
		</table>
			<table width="980px0" align="center" cellPadding="0" cellSpacing="0" class="clsTabla2">
            <tr>
                <td>              </td>
            </tr>
        </table>
			<br>
		<table width="960px" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td>
	<table width="950px" border="0" align="center" cellpadding="0" cellspacing="0" class="tabla">
                        <tr>
                            <td class="etiquetanegra" colspan="7" height="30">
                                &nbsp;<strong>DESCRIPCI&Oacute;N DEL--- PREDIO: --- bien comun</strong></td>
                        </tr>
                        <tr>
                            <td width="3%" class="etiqueta" height="24"><div align="center"><img src="../img/casilla_roja/54.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                            <td width="17%" class="etiqueta">CLASIFICACI&Oacute;N DEL PREDIO</td>
                            <td colspan="5"><?php generaCombo(12); ?></td>
              </tr>
                        <tr>
                            <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_roja/55.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                            <td height="24" class="etiqueta">PREDIO CATASTRAL EN</td>
                            <td width="28%"><?php generaCombo(13); ?></td>
                          <td width="4%" height="24" class="etiqueta"><div align="center"><img src="../img/casilla_roja/56.png" alt="Guardar estado?" width="17" height="17" border="0" /><img src="../img/casilla_azul/57.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                            <td width="17%" class="etiqueta">USO PREDIO CATASTRAL</td>
                            <td width="4%" class="etiqueta">&nbsp;</td>
                            <td width="27%"><?php generaCombo(14); ?></td>
              </tr>
                        <tr>
                            <td height="24" class="etiqueta">
                            <div align="center"><img src="../img/casilla_azul/58.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                            <td height="24" class="etiqueta">ESTRUCTURACI&Oacute;N</td>
                            <td>
                                <input name="dp_estructura" type="text" class="casillaLarga" id="dp_estructura" maxlength="30" <?php echo $M;?>/> </td>
                            <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/59.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                            <td height="24" class="etiqueta">ZONIFICACI&Oacute;N</td>
                            <td height="24" class="etiqueta">&nbsp;</td>
                            <td>
                                <input type="text" class="casillaLarga" name="dp_zonifica" value="" maxlength="30" id="dp_zonifica" <?php echo $M;?>/></td>
                        </tr>
                        <tr>
                            <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/60.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                            <td height="24" class="etiqueta">&Aacute;REA TERRENO T&Iacute;TULO</td>
                            <td>
                                <input type="text" class="casillaFecha" name="dp_areattitulo" value="" maxlength="10" id="dp_areattitulo"  <?php echo $N;?>/>
                          &nbsp;(M2)</td>
                            <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_roja/62.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                            <td height="24" class="etiqueta">&Aacute;REA TERRENO VERIFICADA</td>
                          <td height="24" class="etiqueta">&nbsp;</td>
                            <td><input type="text" class="casillaFecha" name="dp_areatverifica" maxlength="10" id="dp_areatverifica" <?php echo $N;?>/>                              &nbsp;(M2)</td>
                    </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="7" valign="top">
                               <table border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF" bgcolor="#ECE9D8" class="tabla">
                                    <thead>
                                        <tr class="principal">
                                            <th width="135">LINDEROS DE LOTE(ML)</th>
                                            <th width="30"><div align="center"><img src="../img/casilla_azul/63.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></th>
                                            <th width="114">MEDIDA EN CAMPO</th>
                                            <th width="30"><div align="center"><img src="../img/casilla_azul/64.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></th>
                                            <th width="114">MEDIDA SEG&Uacute;N T&Iacute;TULO</th>
                                            <th width="30"><div align="center"><img src="../img/casilla_azul/65.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></th>
                                            <th width="114">COLINDANCIAS EN CAMPO</th>
                                            <th width="30"><div align="center"><img src="../img/casilla_azul/66.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></th>
                                            <th width="114">COLINDANCIAS SEG&Uacute;N T&Iacute;TULO</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="normal">
                                            <td class="principal"><b>&nbsp;&nbsp;&nbsp;</b>FRENTE</td>
                                            <td colspan="2" align="center">
                                                <input type="text" class="casillaDatos" name="dp_medcam_fre"value="" maxlength="20" id="dp_medcam_fre" <?php echo $Ncoma;?>/> </td>
                                            <td colspan="2" align="center">
                                                <input type="text" class="casillaDatos" name="dp_medsegtitu_fre"value="" maxlength="20" id="dp_medsegtitu_fre" <?php echo $Ncoma;?>/></td>
                                            <td colspan="2" align="center">
                                                <input type="text" class="casillaDatos" name="dp_colcam_fre"value="" maxlength="20" id="dp_colcam_fre" <?php echo $M;?>/>  </td>
                                            <td colspan="2" align="center">
                                                <input type="text" class="casillaDatos" name="dp_colsegtitu_fre" value="" maxlength="20" id="dp_colsegtitu_fre" <?php echo $M;?>/> </td>
                                        </tr>
                                        <tr class="normal">
                                            <td class="principal"><b>&nbsp;&nbsp;&nbsp;</b>DERECHA</td>
                                            <td colspan="2" align="center">
                                                <input type="text" class="casillaDatos" name="dp_medcam_der" value="" maxlength="20" id="dp_medcam_der" <?php echo $Ncoma;?>/> </td>
                                            <td colspan="2" align="center"><input type="text" class="casillaDatos" name="dp_medsegtitu_der" value="" maxlength="20" id="dp_medsegtitu_der" <?php echo $Ncoma;?>/></td>
                                            <td colspan="2" align="center">
                                                <input type="text" class="casillaDatos" name="dp_colcam_der" value="" maxlength="20" id="dp_colcam_der" <?php echo $M;?>/> </td>
                                            <td colspan="2" align="center">
                                                <input type="text" class="casillaDatos" name="dp_colsegtitu_der" value="" maxlength="20" id="dp_colsegtitu_der" <?php echo $M;?>/> </td>
                                        </tr>
                                        <tr class="normal">
                                            <td class="principal"><b>&nbsp;&nbsp;&nbsp;</b>IZQUIERDA</td>
                                            <td colspan="2" align="center">
                                                <input type="text" class="casillaDatos" name="dp_medcam_izq" value="" maxlength="20" id="dp_medcam_izq" <?php echo $Ncoma;?>/> </td>
                                            <td colspan="2" align="center">
                                                <input type="text" class="casillaDatos" name="dp_medsegtitu_izq"  value="" maxlength="20" id="dp_medsegtitu_izq" <?php echo $Ncoma;?>/> </td>
                                            <td colspan="2" align="center">
                                                <input type="text" class="casillaDatos" name="dp_colcam_izq" value="" maxlength="20" id="dp_colcam_izq" <?php echo $M;?>/> </td>
                                            <td colspan="2" align="center">
                                                <input type="text" class="casillaDatos" name="dp_colsegtitu_izq" value="" maxlength="20" id="dp_colsegtitu_izq" <?php echo $M;?>/> </td>
                                        </tr>
                                        <tr class="normal">
                                            <td class="principal"><b>&nbsp;&nbsp;&nbsp;</b>FONDO</td>
                                            <td colspan="2" align="center">
                                                <input type="text" class="casillaDatos" name="dp_medcam_fon" value="" maxlength="20" id="dp_medcam_fon" <?php echo $Ncoma;?>/> </td>
                                            <td colspan="2" align="center">
                                                <input type="text" class="casillaDatos" name="dp_medsegtitu_fon" value="" maxlength="20" id="dp_medsegtitu_fon" <?php echo $Ncoma;?>/></td>
                                            <td colspan="2" align="center"><input type="text" class="casillaDatos" name="dp_colcam_fon" value="" maxlength="20" id="dp_colcam_fon" <?php echo $M;?>/></td>
                                            <td colspan="2" align="center">
                                                <input type="text" class="casillaDatos" name="dp_colsegtitu_fon" value="" maxlength="20" id="dp_colsegtitu_fon" <?php echo $M;?>/>  </td>
                                        </tr>
                                    </tbody>
                              </table>                            </td>
                        </tr>
            </table>
	<br>	</td>
  </tr>
</table>
			<br>
		<table width="960px" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td>
	<table width="950px" border="0" align="center" cellpadding="0" cellspacing="0" class="tabla">
                        <tr>
                            <td class="etiquetanegra" colspan="6" height="30">
                                &nbsp;<strong>SERVICIOS B&Aacute;SICOS: ---COMUNES</strong></td>
                        </tr>
                        <tr>
                            <td width="95" class="etiqueta" height="24"><div align="center"><img src="../img/casilla_azul/67.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                            <td width="95" class="etiqueta">LUZ</td>
                            <td width="268"><input name="sb_luz" type="checkbox" id="sb_luz" value="1"></td>
                            <td width="36" class="etiqueta" height="24"><div align="center"><img src="../img/casilla_azul/68.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                            <td width="170" class="etiqueta">AGUA</td>
                            <td width="286"><span class="etiqueta">
                              <input name="sb_agua" type="checkbox" id="sb_agua" value="1" />
                            </span></td>
                        </tr>
                        <tr>
                            <td width="95" height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/69.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                            <td width="95" height="24" class="etiqueta">TEL&Eacute;FONO</td>
                            <td width="268"><span class="etiqueta">
                              <input name="sb_telefono" type="checkbox" id="sb_telefono" value="1"/>
                            </span></td>
                            <td width="36" height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/70.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                            <td width="170" height="24" class="etiqueta">DESAGÜE</td>
                            <td><input name="sb_desague" type="checkbox" id="sb_desague" value="1" /></td>
                        </tr>
                        <tr>
                            <td width="95" height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/71.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                            <td width="95" height="24" class="etiqueta">Nº SUMINISTRO LUZ</td>
                          <td width="268"><input type="text" class="casillaDoc" name="sb_numsumluz" value="" maxlength="10" id="sb_numsumluz" <?php echo $M;?>/></td>
                            <td width="36" height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/72.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                            <td width="170" height="24" class="etiqueta">Nº CONTRATO AGUA</td>
                            <td><input type="text" class="casillaDoc" name="sb_numconagua"  value="" maxlength="10" id="sb_numconagua" <?php echo $M;?>/></td>
                        </tr>
                        <tr>
                            <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/73.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                            <td height="24" class="etiqueta">Nº TEL&Eacute;FONO</td>
                            <td colspan="4"><input type="text" class="casillaDoc" name="sb_numtelf"value="" maxlength="10" id="sb_numtelf" <?php echo $M;?>/></td>
                        </tr> 
            </table>
	<br>	</td>
  </tr>
</table>
		<table width="980px" align="center" cellPadding="0" cellSpacing="0" class="clsTabla2">
            <tr>
                <td>              </td>
            </tr>
        </table>     
			<br>
		<table width="970px" border="1" align="center" cellPadding="0" cellSpacing="0" bordercolor="#000000" >
            <tr>
                <td>
                    <table width="950px" border="0" align="center" cellpadding="0" cellspacing="0" class="tabla">
                        <tr>
                            <td width="950" height="30" class="etiquetanegra">
                                &nbsp;<strong>CONSTRUCCIONES: -- COMUNES (Llenar una fila por cada piso, s&Oacute;tano o meszzanine)</strong></td>
                        </tr>
                        <tr>
                          <td valign="top">
                               
                                <table id="construccion" width="950px" border="1" align="center" cellpadding="0" cellspacing="0" class="tabla">
                                    <thead>
                                    <tr>
                                        <th width="7%" rowspan="2" scope="col"><p><img src="../img/casilla_azul/74.png" alt="Guardar estado?" width="17" height="16" border="0" /></p>                                        </th>
                                      <th width="9%" rowspan="2" scope="col"><p><img src="../img/casilla_azul/75.png" alt="Guardar estado?" width="17" height="16" border="0" /></p>                                      </th>
                                        
                                      <th width="5%" rowspan="2" scope="col"><img src="../img/casilla_azul/76.png" alt="Guardar estado?" width="17" height="16" border="0" /></th>
                                      <th width="5%" rowspan="2" scope="col"><img src="../img/casilla_azul/77.png" alt="Guardar estado?" width="17" height="16" border="0" /></th>
                                      <th width="5%" rowspan="2" scope="col"><img src="../img/casilla_azul/78.png" alt="Guardar estado?" width="17" height="16" border="0" /></th>
                                      <th colspan="7" scope="col"><span class="Estilo9">CATEGOR&Iacute;AS</span></th>
                                        <th colspan="2" scope="col"><span class="Estilo9">AREA CONSTRU&Iacute;DA (M2)</span></th>
                                        <th width="4%" rowspan="3" scope="col"><img src="../img/casilla_azul/88.png" alt="Guardar estado?" width="17" height="16" border="0" /></th>
                                      <th width="4%" colspan="2" rowspan="4" class="accion" scope="col">ACCI&Oacute;N</th>
                                      </tr>
                                    <tr>
                                        <th height="14" colspan="2"><span class="Estilo9">ESTRUCTURA</span></th>
                                        <th colspan="4"><span class="Estilo9">ACABADOS</span></th>
                                        <th width="9%" rowspan="2"><img src="../img/casilla_azul/85.png" alt="Guardar estado?" width="17" height="16" border="0" /></th>
                                      <th width="7%" rowspan="2"><img src="../img/casilla_azul/86.png" alt="Guardar estado?" width="17" height="16" border="0" /></th>
                                      <th width="7%" rowspan="2" ><img src="../img/casilla_azul/87.png" alt="Guardar estado?" width="17" height="16" border="0" /></th>
                                      </tr>
                                    <tr class="principal">
                                      <th width="70" rowspan="2" scope="col">N&ordm; PISO SOTANO MEZZANINE</th>
                                        <th width="90" rowspan="2" scope="col">FECHA CONSTRUCi&Oacute;N</th>
                                        <th width="50" rowspan="2" scope="col">MEP</th>
                                        <th width="50" rowspan="2" scope="col">ECS</th>
                                        <th width="50" rowspan="2" scope="col">ECC</th>
                                        <th width="80" height="20" class="secundario Estilo9"><img src="../img/casilla_azul/79.png" alt="Guardar estado?" width="17" height="16" border="0" /></th>
                                      <th width="70" class="secundario Estilo9"><img src="../img/casilla_azul/80.png" alt="Guardar estado?" width="17" height="16" border="0" /></th>
                                      <th width="60" class="secundario Estilo9"><img src="../img/casilla_azul/81.png" alt="Guardar estado?" width="17" height="16" border="0" /></th>
                                      <th width="60" class="secundario Estilo9"><img src="../img/casilla_azul/82.png" alt="Guardar estado?" width="17" height="16" border="0" /></th>
                                      <th width="60" class="secundario Estilo9"><img src="../img/casilla_azul/83.png" alt="Guardar estado?" width="17" height="16" border="0" /></th>
                                      <th width="6%" class="secundario Estilo9"><img src="../img/casilla_azul/84.png" alt="Guardar estado?" width="17" height="16" border="0" /></th>
                                    </tr>
                                    <tr class="principal">
                                      <th width="60" class="secundario Estilo9">MUROS Y COLUMNAS</th>
                                      <th width="60" class="secundario Estilo9">TECHOS</th>
                                      <th width="60" class="secundario Estilo9">PISOS</th>
                                      <th width="60" class="secundario Estilo9">PUERTAS Y VENTANAS</th>
                                      <th width="60" class="secundario Estilo9">REVEST.</th>
                                      <th width="60" class="secundario Estilo9">BA&Ntilde;OS</th>
                                      <th width="90"><span class="Estilo9">INST. EL&Eacute;CT. Y SANITARIAS</span></th>
                                      <th width="70"><span class="Estilo9">DECLARADA</span></th>
                                      <th width="70" ><span class="Estilo9">VERIFICADA</span></th>
                                      <th width="40" scope="col">UCA</th>
                                    </tr>
                                    <tr class="principal">
                                      <th  class="celda" align="left" colspan="17" scope="col">
                                      <div id="linea2_0"  style="width:950">
                                        <input  name="c_psm-0" type="text"  maxlength="2" id="c_psm-0"  style="width:65px"/>
                                        <input name="c_fecha-0" type="text" value="" maxlength="10" id="c_fecha-0" <?php echo $VF;?> style="width:85px"/>
                              <?php generaCombo(26); ?>&nbsp;<?php generaCombo(27); ?>&nbsp;<?php generaCombo(28); ?>
                              <input  class="input" name="c_myc-0" type="text" id="c_myc-0" maxlength="1" <?php echo $L;?> style="width:75px"/>
                              <input  class="input" name="c_t-0" type="text" id="c_t-0" maxlength="1" <?php echo $L;?> style="width:55px"/>
                              <input  class="input" name="c_p-0" type="text" id="c_p-0" maxlength="1" <?php echo $L;?> style="width:50px"/>
                              <input  class="input" name="c_pyv-0" type="text" id="c_pyv-0" maxlength="1" <?php echo $L;?> style="width:55px"/>
                              <input  class="input" name="c_r-0" type="text" id="c_r-0" maxlength="1" <?php echo $L;?> style="width:55px"/>
                              <input  class="input" name="c_b-0" type="text" id="c_b-0" maxlength="1" <?php echo $L;?> style="width:50px"/>
                              <input  class="input" name="c_ies-0" type="text" id="c_ies-0" <?php echo $L;?> style="width:85px"/>
                              <input  class="input" name="c_d-0" type="text" id="c_d-0" style="width:65px" <?php echo $N;?>/>
                              <input  class="input" name="c_v-0" type="text" id="c_v-0" style="width:65px" <?php echo $N;?>/>
                              <?php generaCombo(29); ?>
                              <input class="bt_plus2" id="1" type="button" value="+" />
                            </div></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>                                    
                          </table>                          </td>
                        </tr>
						<tr>
                            <td colspan="4">                            </td>
                        </tr>
                        <tr>
                            <td class="etiqueta">&nbsp;</td>
                        </tr>
                        
                  </table>
              <br></td>
            </tr>
        </table>
			<br>
        <table width="960px" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
		  <tr>
		    <td colspan="4" height="30"><span class="tabla">&nbsp;<strong>OBRAS COMPLEMENTARIAS / OTRAS INSTALACIONES:</strong></span></td>
            </tr>
                        <tr>
                          <td colspan="4" valign="top">
                          <table width="950px" border="1" align="left" cellpadding="0" cellspacing="0" 		
							class="tabla">
                            
                                <tr class="principal">
                                  <td width="48" ><div align="center"><img src="../img/casilla_azul/90.png" alt="Guardar estado?" width="17" height="16" border="0" />
                                    </th>
                                    
                                  </div>
                                  <td width="250" scope="col"><div align="center"><img src="../img/casilla_azul/91.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                                  <td width="102" scope="col"><div align="center"><img src="../img/casilla_plata/75.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                                  <td width="55" scope="col"><div align="center"><img src="../img/casilla_plata/76.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                                  <td width="55" scope="col"><div align="center"><img src="../img/casilla_plata/77.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                                  <td width="51" scope="col"><div align="center"><img src="../img/casilla_plata/78.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                                  <td colspan="3" scope="col"><div align="center"><strong>DIMENSIONES VERIFICADAS
                                  </th>
                                  </strong></div>
                                  <td width="68" scope="col"><div align="center"><img src="../img/casilla_azul/95.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                                  <td width="52" scope="col"><div align="center"><img src="../img/casilla_azul/96.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
								  <td width="41" scope="col"><div align="center"><img src="../img/casilla_plata/88.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                                  <td width="89" colspan="3" rowspan="3" class="accion" scope="col"><div align="center"><strong>ACCI&Oacute;N</strong></div></td>
                            </tr>
                                <tr class="principal">
                                  <th width="48" rowspan="2" >CODIGO</th>
                                  <th width="250" rowspan="2" scope="col">DESCRIPCI&Oacute;N</th>
                                  <th width="102" rowspan="2" scope="col">FECHA DE CONSTRUCCION</th>
                                  <th width="55" rowspan="2" scope="col">MEP</th>
                                  <th width="55" rowspan="2" scope="col">ECS</th>
                                  <th width="51" rowspan="2" scope="col">ECC</th>
                                  <th width="40" class="secundario"><img src="../img/casilla_azul/89.png" alt="Guardar estado?" width="17" height="16" border="0" /></th>
                                  <th width="41" class="secundario"><img src="../img/casilla_azul/89.png" alt="Guardar estado?" width="17" height="16" border="0" /></th>
                                  <th width="30" class="secundario"><img src="../img/casilla_azul/89.png" alt="Guardar estado?" width="17" height="16" border="0" /></th>
                                  <th width="68" rowspan="2" scope="col">PRODUCTO TOTAL</th>
                                  <th width="52" rowspan="2" scope="col">UNIDAD DE MEDIDA</th>
                                  <th width="41" rowspan="2" scope="col">UCA</th>
                            </tr>
                                <tr class="principal">
                                  <th class="secundario">LARGO</th>
                                  <th width="41" class="secundario">ANCHO</th>
                                  <th width="30" class="secundario">ALTO</th>
                            </tr>
                           
                              <tbody>
                            
                                <tr class="normal">
                                  <td colspan="15" class="celda" align="left">
                                  <div id="linea3_0" >
                              <input class="input" name="oc_cod-0" type="text" maxlength="2" id="oc_cod-0" onChange="pulsar_Obra(this)" style="width:45px"/>
                              <input class="input" name="oc_des-0" type="text" maxlength="50" id="oc_des-0" readonly="readonly" style="width:250px"/>
                              <input name="oc_fecha-0" type="text" class="input" id="oc_fecha-0" maxlength="10" <?php echo $VF;?> style="width:100px"/>
							  <?php generaCombo(30); ?>&nbsp;<?php generaCombo(31); ?>&nbsp;<?php generaCombo(32); ?>
                              
                              <input class="input" name="oc_lar-0" type="text" id="oc_lar-0" style="width:38px"/>
                              <input class="input" name="oc_anc-0" type="text" id="oc_anc-0" style="width:38px"/>
                              <input class="input" name="oc_alt-0" type="text" id="oc_alt-0" style="width:38px"/>
                              <input class="input" name="oc_pro-0" type="text" id="oc_pro-0" style="width:55px" />
                              <input name="oc_uni-0" type="text" class="input" id="oc_uni-0" maxlength="2" style="width:53px"/>
                              <?php generaCombo(33); ?>
                                 &nbsp;&nbsp; <input class="bt_plus3" id="12" type="button" value="+" />
                                  </div>                            </td>
                                </tr>
                              </tbody>
                            </table>
						  
		</td>
  </tr>
</table>
			<br>
			<table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" class="clsTabla2">
              <tr>
                <td><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" class="tabla">
                    <tr>
                      <td class="etiquetanegra" colspan="4" height="30">&nbsp;<strong>RECAPITULACI&Oacute;N DE EDIFICIOS: </strong></td>
                    </tr>
                    <tr>
                      <td colspan="4" valign="top"><table width="99%" border="1" cellpadding="0" cellspacing="0" class="tabla">
                          <thead>
                            <tr class="principal">
                              <th><div align="center"><img src="../img/casilla_azul/128.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></th>
                              <th><div align="center"><img src="../img/casilla_azul/129.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></th>
                              <th><div align="center"><img src="../img/casilla_azul/130.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></th>
                              <th><div align="center"><img src="../img/casilla_azul/131.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></th>
                              <th><div align="center"><img src="../img/casilla_azul/132.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></th>
                              <th colspan="2" rowspan="2" class="accion">ACCI&Oacute;N</th>
                            </tr>
                            <tr class="principal">
                              <th><div align="center">EDIFICIO</div></th>
                              <th><div align="center">PORCENTAJE (%)</div></th>
                              <th><div align="center">ATC (M2)</div></th>
                              <th><div align="center">ACC (M2)</div></th>
                              <th><div align="center">AOIC (M2)</div></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr class="normal">
                              <td colspan="7" align="left">
                                  <div id="linea8_0">
                                  <input class="input" name="re_edi-0" type="text" maxlength="2" id="re_edi-0" <?php echo $N;?> style="width:140px"/>
                                  <input class="input" name="re_por-0" type="text" maxlength="8" id="re_por-0" <?php echo $N.' '.$Decimal;?> style="width:250px"/>
                                  <input class="input" name="re_atc-0" type="text" maxlength="19" id="re_atc-0" <?php echo $N.' '.$Decimal;?> style="width:128px"/>
                                <input class="input" name="re_acc-0" type="text" maxlength="10" id="re_acc-0" <?php echo $N.' '.$Decimal;?> style="width:128px"/>
                                      <input class="input" name="re_aoic-0" type="text" maxlength="7" id="re_aoic-0" style="width:155px" <?php echo $N.' '.$Decimal;?>/>
  &nbsp;&nbsp;
  <input class="bt_plus8" id="12" type="button" value="+" />
                                  </div>                              </td>
                            </tr>
                          </tbody>
                      </table></td>
                    </tr>
                    <tr>
                      <td class="etiqueta" colspan="4"></td>
                    </tr>
                    <tr>
                      <td class="etiqueta" colspan="4">&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="4%" height="24" class="etiquetanegra"><div align="center"><img src="../img/casilla_azul/113.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td width="88%" height="24" class="etiquetanegra">&nbsp;<strong>&Aacute;REA DE TERRENO INVADIDA EN M2</strong></td>
                      <td width="4%" height="24" class="etiquetanegra">&nbsp;</td>
                      <td width="4%" height="24" class="etiquetanegra">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="4"><table width="99%" cellpadding="0" cellspacing="0" class="tabla">
                          <tr>
                            <td width="25%" class="etiqueta" height="24">&nbsp;&nbsp;&nbsp;LOTE COLINDANTE</td>
                            <td width="25%"><input name="re_lotcol" type="text" id="re_lotcol" value="" size="5" maxlength="7"/></td>
                            <td width="22%" class="etiqueta" height="24">JARD&Iacute;N AISLAMIENTO</td>
                            <td><input name="re_jarais" type="text" id="re_jarais" value="" size="5" maxlength="7"/>                            </td>
                          </tr>
                          <tr>
                            <td width="155" class="etiqueta" height="24">&nbsp;&nbsp;&nbsp;&Aacute;REA P&Uacute;BLICA</td>
                            <td width="320"><input name="re_areapub" type="text" id="re_areapub" value="" size="5" maxlength="7"/></td>
                            <td width="155" class="etiqueta" height="24">&Aacute;REA INTANGIBLE</td>
                            <td><input name="re_areaint" type="text" id="re_areaint" value="" size="5" maxlength="7"/></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td colspan="4">&nbsp;</td>
                    </tr>
                </table></td>
              </tr>
            </table><br />
            <table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" class="clsTabla2">
              <tr>
                <td><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="tabla">
                    <tr>
                      <td class="etiquetanegra" colspan="2" height="30">&nbsp;<strong>RECAPITULACI&Oacute;N DE BIENES COMUNES:</strong></td>
                    </tr>
                    <tr>
                      <td colspan="2" valign="top"><table width="100%" border="1" cellpadding="0" cellspacing="0" class="tabla">
                          <thead>
                            <tr class="principal">
                              <th colspan="5"><div align="center"><img src="../img/casilla_azul/133.png" alt="Guardar estado?" width="17" height="16" border="0" /></div>                                <div align="center"></div>                                <div align="center"></div>                                <div align="center"></div>                                <div align="center"></div></th>
                              <th><div align="center"><img src="../img/casilla_azul/89.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></th>
                              <th><div align="center"><img src="../img/casilla_azul/134.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></th>
                              <th><div align="center"><img src="../img/casilla_azul/131.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></th>
                              <th><div align="center"><img src="../img/casilla_azul/132.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></th>
                              <th colspan="2" rowspan="2" class="accion">ACCI&Oacute;N</th>
                            </tr>
                            <tr class="principal">
                              <th><div align="center">N&Uacute;MERO</div></th>
                              <th><div align="center">EDIFICACI&Oacute;N</div></th>
                              <th><div align="center">ENTRADA</div></th>
                              <th><div align="center">PISO</div></th>
                              <th><div align="center">UNIDAD</div></th>
                              <th><div align="center">PORCENTAJE (%)</div></th>
                              <th><div align="center">ATC (M2)</div></th>
                              <th><div align="center">ACC (M2)</div></th>
                              <th><div align="center">AOIC (M2)</div></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr class="normal">
                              <td colspan="11" align="center"><div align="left">
                                  <div id="linea9_0">
                                    <input class="input" name="rbc_numero-0" type="text"  maxlength="17" id="rbc_numero-0" onKeyPress="return validar_numeros(event)" style="width:75px"/>
                                    <input class="input" name="rbc_edifica-0" type="text"  maxlength="2" id="rbc_edifica-0" onKeyPress="return validar_numeros(event)" style="width:125px"/>
                                    <input class="input" name="rbc_entrada-0" type="text"  maxlength="2" id="rbc_entrada-0" onKeyPress="return validar_numeros(event)" style="width:85px"/>
                                    <input class="input" name="rbc_piso-0" type="text"  maxlength="2" id="rbc_piso-0" onKeyPress="return validar_numeros(event)" style="width:42px"/>
                                    <input class="input" name="rbc_unidad-0" type="text"  maxlength="3" id="rbc_unidad-0" onKeyPress="return validar_numeros(event)" style="width:75px"/>
                                    <input class="input" name="rbc_porcentaje-0" type="text"  maxlength="17" id="rbc_porcentaje-0" onKeyPress="return validar_numeros(event)" <?php echo $Decimal; ?> style="width:155px"/>
                                    <input class="input" name="rbc_atc-0" type="text"  maxlength="17" id="rbc_atc-0" onKeyPress="return validar_numeros(event)" <?php echo $Decimal;?> style="width:85px"/>
                                    <input class="input" name="rbc_acc-0" type="text"  maxlength="17" id="rbc_acc-0" onKeyPress="return validar_numeros(event)" <?php echo $Decimal; ?> style="width:85px"/>
                                    <input class="input" name="rbc_aoic-0" type="text"  maxlength="17" id="rbc_aoic-0" onKeyPress="return validar_numeros(event)" <?php echo $Decimal; ?> style="width:95px"/>
                                    <input class="bt_plus9" id="12" type="button" value="+" />
                            </div>
                              </div></td>
                            </tr>
                          </tbody>
                      </table></td>
                    </tr>
                    <tr>
                      <td class="etiqueta" colspan="2"></td>
                    </tr>
                    <tr>
                      <td height="5" colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="25%">&nbsp;MANTENIMIENTO</td>
                      <td><?php generaCombo(20); ?></td>
                    </tr>
                    <tr>
                      <td colspan="2">&nbsp;</td>
                    </tr>
                </table></td>
              </tr>
            </table>
            <br>
            <table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" class="clsTabla2">
              <tr>
                <td><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="tabla">
                    <tr>
                      <td class="etiquetanegra" colspan="6" height="30">&nbsp;<strong>DOCUMENTOS Y DATOS REGISTRALES:</strong></td>
                    </tr>
                    <tr>
                      <td height="24" colspan="6" class="etiquetanegra">REGISTRO NOTARIAL DE LA ESCRITURA P&Uacute;BLICA</td>
                    </tr>
                    <tr>
                      <td width="3%" height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/101.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td width="22%" height="24" class="etiqueta">NOMBRE DE LA NOTARIA</td>
                      <td colspan="4"><?php generaCombo(15); ?></td>
                    </tr>
                    <tr>
                      <td width="3%" height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/102.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td width="22%" height="24" class="etiqueta">&nbsp;KARDEX</td>
                      <td width="25%"><input name="d_kardex" type="text" id="d_kardex" value="" maxlength="15"/></td>
                      <td width="3%" class="etiqueta" height="24"><div align="center"><img src="../img/casilla_azul/103.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td width="19%" class="etiqueta">FECHA ESCRITURA P&Uacute;BLICA</td>
                      <td width="28%" ><input  name="d_fechaescpub" type="text" id="d_fechaescpub" value="" size="15" maxlength="10"/>
                        &nbsp;<img src="../img/calendarIcon.gif" onClick="popUpCalendar(this, d_fechaescpub, &quot;dd/mm/yyyy&quot;)" style="cursor:pointer" width="16" height="16" border="0" title="Ingresar Fecha"/></td>
                    </tr>
                    <tr>
                      <td colspan="6">&nbsp;</td>
                    </tr>
                </table></td>
              </tr>
            </table>
            <br />
            <table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" class="clsTabla2">
              <tr>
                <td><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="tabla">
                    <tr>
                      <td class="etiquetanegra" colspan="6" height="30">&nbsp;<strong>INSCRIPCI&Oacute;N EN REGISTRO DE PREDIOS: </strong></td>
                    </tr>
                    <tr>
                      <td width="3%" class="etiqueta" height="24"><div align="center"><img src="../img/casilla_azul/104.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td width="22%" class="etiqueta">&nbsp;TIPO PARTIDA REGISTRAL</td>
                      <td width="25%"><?php generaCombo(16); ?></td>
                      <td width="3%" class="etiqueta" height="24"><div align="center"><img src="../img/casilla_azul/105.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td width="19%" class="etiqueta">N&Uacute;MERO</td>
                      <td width="28%"><input name="irp_numpar" type="text" id="irp_numpar" value="" maxlength="15"/>                      </td>
                    </tr>
                    <tr>
                      <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/106.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td height="24" class="etiqueta">&nbsp;FOJAS</td>
                      <td><input name="irp_fojas" type="text" id="irp_fojas" value="" maxlength="15"/></td>
                      <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/107.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td height="24" class="etiqueta">ASIENTO</td>
                      <td><input  name="irp_asiento" type="text" id="irp_asiento" value="" maxlength="15"/></td>
                    </tr>
                    <tr>
                      <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/108.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td height="24" class="etiqueta">&nbsp;FECHA INSCRIPCI&Oacute;N PREDIO</td>
                      <td><input  name="irp_fechains" type="text" id="irp_fechains" size="15" maxlength="10" ovalue=""/>
                        &nbsp;<img src="../img/calendarIcon.gif" onClick="popUpCalendar(this, irp_fechains, &quot;dd/mm/yyyy&quot;)" style="cursor:pointer" width="16" height="16" border="0" title="Ingresar Fecha"/></td>
                      <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/109.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td height="24" class="etiqueta">DECLARATORIA DE F&Aacute;BRICA</td>
                      <td><?php generaCombo(17); ?></td>
                    </tr>
                    <tr>
                      <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/110.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td height="24" class="etiqueta">&nbsp;AS. INS. DE F&Aacute;BRICA</td>
                      <td><input name="irp_asinfab" type="text" id="irp_asinfab" value="" maxlength="15"/></td>
                      <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/111.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td height="24" class="etiqueta">FECHA INSCRIPCI&Oacute;N F&Aacute;BRICA</td>
                      <td><input  name="irp_fechinsfab" type="text" id="irp_fechinsfab" value="" size="15" maxlength="10"/>
                        &nbsp;<img src="../img/calendarIcon.gif" onClick="popUpCalendar(this, irp_fechinsfab, &quot;dd/mm/yyyy&quot;)" style="cursor:pointer" width="16" height="16" border="0" title="Ingresar Fecha"/></td>
                    </tr>
                    <tr>
                      <td colspan="2">&nbsp;</td>
                    </tr>
                </table></td>
              </tr>
            </table><br />
		<table width="960px" border="1" align="center" cellPadding="0" cellSpacing="0" bordercolor="#000000" class="clsTabla2">
   <tr>
     <td>
	 <table width="950px" border="0" align="center" cellpadding="0" cellspacing="0" class="tabla">
     <tr>
       <td class="etiquetanegra" colspan="6" height="30">&nbsp;<strong>INFORMACI&Oacute;N COMPLEMENTARIA: </strong></td>
     </tr>
     <tr>
       <td width="4%" class="etiqueta" height="24"><div align="center"><img src="../img/casilla_azul/114.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
       <td width="17%" class="etiqueta">CONDICI&Oacute;N DE DECLARANTE</td>
       <td height="24" colspan="4"><?php generaCombo(18); ?></td>
       </tr>
     <tr>
       <td height="10" colspan="6" class="etiqueta">&nbsp;</td>
       </tr>
     <tr>
       <td colspan="6">&nbsp;</td>
     </tr>
     <tr>
       <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_roja/116.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
       <td height="24" class="etiqueta">ESTADO DE LA FICHA</td>
       <td width="29%"><?php generaCombo(19); ?></td>
       <td width="3%" height="24" class="etiqueta">&nbsp;</td>
       <td width="18%" height="24" class="etiqueta">&nbsp;</td>
       <td width="29%">&nbsp;</td>
     </tr>
     <tr>
       <td colspan="2">&nbsp;</td>
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
                    <td width="30" height="24" class="etiquetanegra"><div align="center"><img src="../img/casilla_azul/120.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                    <td width="159" class="etiquetanegra"><strong>DECLARANTE</strong></td>
                    <td class="etiquetanegra" height="24">&nbsp;</td>
                    <td class="etiquetanegra" height="24">&nbsp;</td>
                    <td width="315" height="24" class="etiquetanegra">&nbsp;</td>
                  </tr>
                  <tr>
                    <td rowspan="3" class="etiqueta">&nbsp;</td>
                    <td height="24" class="etiqueta">DNI</td>
                    <td width="237"><input type="text" class="casilla" name="f_dni" value="" size="10" maxlength="8" id="f_dni" onKeyPress="return validar_numeros(event)"/></td>
                    <td width="209" class="etiqueta" height="24">NOMBRES</td>
                    <td><input name="f_nom" type="text" class="casillaLarga"value="" size="40" id="f_nom" onKeyPress="return letras(event)" onKeyUp="validar_todo_mayus(this)"/></td>
                  </tr>
                  <tr>
                    <td height="24" class="etiqueta">APELLIDO PATERNO</td>
                    <td width="237"><input name="f_paterno" type="text" class="casillaLarga" value="" size="32" id="f_paterno" onKeyPress="return letras(event)" onKeyUp="validar_todo_mayus(this)"/></td>
                    <td width="209" class="etiqueta" height="24">APELIDO MATERNO</td>
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
                    <td width="237"><?php generaCombo(21); ?></td>
                    <td width="209" class="etiqueta" height="24">FECHA</td>
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
                    <td width="237"><?php generaCombo(22); ?></td>
                    <td width="209" class="etiqueta" height="24">FECHA</td>
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
                    <td width="237"><?php generaCombo(23); ?></td>
                    <td width="209" class="etiqueta" height="24">FECHA</td>
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
				</table>
			  </td>
            </tr>
        </table>
        <br>      
	  </td>
    </tr>
</table>
	<p align="center">
		<input name="bGuardar" type="submit" class="booton" value="Guardar Ficha" />
		&nbsp;&nbsp;&nbsp;
		<input name="bCancelar" type="button" class="booton" value="Cancelar" onClick="location='../form_inicio.php'"/>
	</p>
	<br>
</div>
</form>
</div>
</body>
</html>