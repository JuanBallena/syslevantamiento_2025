<?php session_start();
//header("Content-type: text/html; charset=utf-8");
include '../funciones/verifica_ubigeo.php'; //sesiones de UBIGEO
include '../funciones/genera_dep.php';
include '../configuracion/eventos.php';
include 'proceso_eco/E_combos_editados.php';

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
<script type="text/javascript" src="../js/datos_minimos_E.js"></script>
<!--<script type="text/javascript" src="../js/no_f5.js"></script> -->
<script type="text/javascript" src="../js/verifica_existencia.js"></script>

<link href="../css/estilo_form.css" rel="stylesheet" type="text/css"/>
<link href="../css/link.css" rel="stylesheet" type="text/css">
<link href="../css/tabla.css" rel="stylesheet" type="text/css">
<link href="../css/botones.css" rel="stylesheet" type="text/css">
<link href="../css/combos.css" rel="stylesheet" type="text/css">
<link  href="../css/popcalendar.css" rel="stylesheet" type="text/css"> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<title>Ficha Catastral Urbana Actividad Económica/ ST-SNCP SECRETARIA TÉCNICA</title>
<style type="text/css">
<!--
.Estilo1 {
	font-size: 12px;
	font-weight: bold;
	font-family: Calibri;
	font-style: italic;
	color: #FF0000;
}
.Estilo7 {
	color: #FFFFFF;
	font-size: 16px;
	font-weight: bold;
}
.Estilo10 {font-size: 8px}
.Estilo11 {font-family: Verdana, Arial, Helvetica, sans-serif}
-->
</style>
</head>
<body onLoad="javascript:ponerfoco_3()" onkeypress="javascript:if(event.keyCode==13)return false;" onKeyDown="javascript:no_f5(this);">
<div align="center">
<form  class="myform" name="datos" action="proceso_eco/E_modifica_economica.php"  method="post" onSubmit="javascript:return datos_minimos_economica();" autocomplete="off">
<!--<form  class="myform" name="datos" method="post" action="proceso_ind/I_graba_individual.php?pag=?php echo $cad;?>" onSubmit="return datos_minimos_individual()" autocomplete="off">!-->
<div align="center">
<?php
//RECOGE ID
	$IDFicha = $_GET[id];
	//echo $IDFicha;
	$BD=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);
	$BD->conectar();
	
	//CONSULTAS POR CADA BLOQUE
	//-- DATOS GENERALES
	$Consulta1="SELECT f.id_ficha,f.nume_ficha,f.nume_ficha_lote, ".
			"f.dc,u.id_uni_cat,u.cuc, u.codi_hoja_catastral ".
			"FROM tf_uni_cat as u INNER JOIN tf_fichas as f ON u.id_uni_cat=f.id_uni_cat ".
			"WHERE f.id_ficha = '$IDFicha'";

	//-- IC
	$Consulta2="SELECT c.cond_conductor, p.nume_doc, p.tipo_doc, p.tipo_persona, p.tipo_funcion, p.nombres, ".
				"p.ape_paterno, p.ape_materno, p.razon_social, c.nume_ruc ".
				"FROM tf_conductores AS c INNER JOIN tf_personas AS p ON c.id_persona=p.id_persona ".
				"WHERE c.id_ficha = '$IDFicha'";

	//-- DFTC
	$Consulta3="SELECT c.telefono, c.anexo, c.fax, c.email, d.codi_via, d.tipo_via, d.nomb_via, d.nume_muni, ".
				"d.nomb_edificacion, d.nume_interior, d.codi_hab_urba, d.nomb_hab_urba, d.sector, d.mzna, d.lote, ".
				"d.sublote, d.codi_dep, d.codi_pro, d.codi_dis ".
				"FROM tf_conductores AS c INNER JOIN tf_personas AS p ON c.id_persona=p.id_persona ".
				"INNER JOIN tf_domicilio_titulares AS d ON p.id_persona=d.id_persona ".
				"WHERE d.id_ficha = '$IDFicha'";

	//-- AMF
	$Consulta4="SELECT codi_actividad FROM tf_autorizaciones_funcionamiento WHERE id_ficha = '$IDFicha'";
	
	//-- AA
	$Consulta5="SELECT id_anuncio, codi_anuncio, codi_autoriza, nume_lados, area_autorizada, area_verificada, ".
			"nume_expediente, nume_licencia, fecha_expedicion, fecha_vencimiento ".
			"FROM tf_autorizaciones_anuncios WHERE id_ficha = '$IDFicha'";
			
	//-- Area Actividad Economica - Vigencia de Autorización (amf)
	$Consulta6="SELECT nomb_comercial, pred_area_autor, viap_area_autor, viap_area_verif, bc_area_autor, ".
				"bc_area_verif, nume_expediente, nume_licencia, fecha_expedicion, fecha_vencimiento, ".
				"inic_actividad, cond_declarante, esta_llenado, mantenimiento, docu_presentado, pred_area_verif, ".
				"observaciones, nume_ficha ".
				"FROM tf_fichas_economicas ".
				"WHERE id_ficha = '$IDFicha'";
				
	//-- IC : Informacion Complementaria
	$Consulta7="SELECT cond_declarante, esta_llenado, docu_presentado,esta_llenado, mantenimiento, observaciones ".
				"FROM tf_fichas_economicas ".
				"WHERE id_ficha = '$IDFicha'";
	
	//-- FIRMAS
	$Consulta8="SELECT declarante, fecha_declarante, supervisor, fecha_supervision, tecnico, fecha_levantamiento, ".
				"verificador, fecha_verificacion, nume_registro ".
				"FROM tf_fichas ".
				"WHERE id_ficha = '$IDFicha'";
				

	//-------------------------------------- Ejecutamos consultas
	$consulta_dg= $BD->Consultas($Consulta1);
	
	$consulta_ic= $BD->Consultas($Consulta2);
	$row2=pg_fetch_array($consulta_ic);
	
	$consulta_dftc= $BD->Consultas($Consulta3);
	$row3=pg_fetch_array($consulta_dftc);
	
	
	$consulta_amf= $BD->Consultas($Consulta4);
	$nro_amf=pg_num_rows($consulta_amf);
	$nro_amf=$nro_amf-1;
	//asigno valor real a un contador
	$con_amf=$nro_amf;
	//reemplazo de ser necesario caso: (-1)
	if ($nro_amf<0) $nro_amf=0;
	
	$consulta_aa= $BD->Consultas($Consulta5);
	$nro_aa=pg_num_rows($consulta_aa);
	$nro_aa=$nro_aa-1;
	//asigno valor real a un contador
	$con_aa=$nro_aa;
	//reemplazo de ser necesario caso: (-1)
	if ($nro_aa<0) $nro_aa=0;
	
	$consulta_aae= $BD->Consultas($Consulta6);
	$row6=pg_fetch_array($consulta_aae);
	
	$consulta_ic= $BD->Consultas($Consulta7);
	$row7=pg_fetch_array($consulta_ic);
	
	$consulta_fi= $BD->Consultas($Consulta8);
	$row8=pg_fetch_array($consulta_fi);


	$BD->desconectar();

	while($row1=pg_fetch_array($consulta_dg))
			{  

	$cod_ref=$row1['id_uni_cat'];
	
	$Dep=substr($cod_ref,0,2);
	$Pro=substr($cod_ref,2,2);
	$Dis=substr($cod_ref,4,2);
	$ubigeo=substr($cod_ref,0,6);
	
	$campo_3=substr($cod_ref,6,2);
	$campo_4=substr($cod_ref,8,3);
	$campo_5=substr($cod_ref,11,3);
	$campo_6=substr($cod_ref,14,2);
	$campo_7=substr($cod_ref,16,2);
	$campo_8=substr($cod_ref,18,2);
	$campo_9=substr($cod_ref,20,3);
	$campo_10=$row1['dc'];
?>

<table width="980px" border="1" align="center" cellPadding="0" cellSpacing="0" bordercolor="#000000">
    <tr>
      <td colspan="6" bgcolor="#0052A4" class="Titulo1"><div align="center" class="Estilo7">FICHA CATASTRAL URBANA ACTIVIDAD ECON&Oacute;MICA</div></td>
    </tr>
    <tr>
      <td colspan="6"><table width="980px" border="0" cellpadding="0" cellspacing="0" class="tabla">
			<tr>
				<td width="980"><br>
					<div align="center">
					  <table width="980px" border="0" cellpadding="0" cellspacing="0" class="tabla">
			<tr>
				<td width="192">&nbsp;</td>
				<td width="291" class="link"><div align="left">N&Uacute;MERO DE FICHA
				  <input type="text" class="casilla" name="numficha" id="numficha" size="7" maxlength="7" <?php echo $N.' '.$ev_1;?> value="<?php echo $row1['nume_ficha']; ?>"/></div></td>
				<td width="75">&nbsp;</td>
				<td width="181"><div align="left">N&Uacute;MERO DE FICHAS POR LOTE&nbsp;</div></td>
				<td width="241"><input type="text" name="numflote1"value="<?php 
				  
				  $cadena=trim($row1['nume_ficha_lote']);
				  $maximo = strlen($cadena);

				  $cadena_fin = "-";
				  $total = 0;
 				  $total2 = strpos($cadena,$cadena_fin);
				  $total3 = ($maximo - $total2 - 1);
				  $f1 = substr ($cadena,$total,-$total3);
				  $maximo = strlen($f1);
				  $f1 = substr ($f1,0,$maximo-1);
				  				
				  echo $f1;?>" size="1" maxlength="2" id="numflote1" <?php echo $N;?>/>
			    <input type="text" name="numflote2"  value="<?php 
				  $cadena=trim($row1['nume_ficha_lote']);
				  $maximo = strlen($cadena);
				  $cadena_comienzo = "-";
				  $total = strpos($cadena,$cadena_comienzo);
 				  $f2 = substr ($cadena,$total+1,$maximo);
				  echo $f2;
				
				?>" size="1" maxlength="2" id="numflote2" <?php echo $N;?>/></td>
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
                                <td colspan="4"><input name="dg_cuc8" type="text" id="dg_cuc8" value="<?php echo substr($row1['cuc'],0,8); ?>" size="8" maxlength="8" <?php echo $N;?> />
                                    <input name="dg_cuc4" type="text" size="2" maxlength="4" value="<?php echo substr($row1['cuc'],8,4); ?>" id="dg_cuc4" <?php echo $N;?> /></td>
                                <td><div align="center"><img src="../img/casilla_azul/2.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                                <td colspan="4">C&Oacute;DIGO HOJA CATASTRAL</td>
                                <td colspan="2"><div align="right">
                                    <input name="dg_hojacatastral" type="text" id="dg_hojacatastral" size="8" value="<?php echo trim($row1['codi_hoja_catastral']); ?>" maxlength="10" <?php echo $N;?> />
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
								//Impresión de INPUTs 
								
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
                                <td height="24" colspan="13">
                                <?php
							$anio=date("Y");
							
         echo "<input name='contador1' type='text' class='contador' id='contador1' value='".($nro_amf)."' size='2' maxlength='2'/>
               <input name='contador2' type='text' class='contador' id='contador2' value='".($nro_aa)."' size='2' maxlength='2'/>
               <input name='anio' type='text' class='contador' id='anio' value='".$anio."' size='4' maxlength='4'/>
               <input name='previo' type='text' class='contador' id='previo'/>
               <input name='tipo' type='text' class='contador' id='tipo' size='2' maxlength='2'/>
			   
			<input name='conductor' type='text' class='contador' id='conductor' value='".$tipo_persona."' size='2' maxlength='2'/>";	?>
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
					  <br>				
				  </div></td>
			  </tr>
		</table> 
        <table width="960px" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
			<tr>
				<td>
				<table width="950PX" border="0" align="center" cellpadding="0" cellspacing="0" class="tabla">
                        <tr>
                            <td class="etiquetanegra" colspan="4" height="30">
                                &nbsp;<strong>IDENTIFICACI&Oacute;N DEL CONDUCTOR:</strong></td>
                        </tr>
                      
                        <tr id="personanatural"></tr>
                            <td colspan="4">
                            	<!-- "OCULTAMOS O VISUALIZAMOS SEGUN COTITULARIDAD"-->
								<table  id="oculta" width="100%" align="center" cellpadding="0" cellspacing="0" class="tabla">
                                    <tr>
                                      <td width="26" height="24" class="etiqueta"><div align="center"><img src="../img/casilla_roja/140.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                                      <td width="156" height="24" class="etiqueta">TIPO DOC. CONDUCTOR</td>
                                      <td width="281"><?php generaCombo(44); ?></td>
                                      <td width="29" height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/141.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                                      <td width="167" height="24" class="etiqueta">NOMBRE COMERCIAL</td>
                                      <td><span class="etiqueta">
                                        <input type="text" class="casilla" name="ic_nomcom" value="<?php echo trim($row6['nomb_comercial']); ?>" size="40" id="ic_nomcom" 
onkeypress="return letras(event)" onKeyUp="validar_todo_mayus(this)"/>
                                      </span></td>
								  </tr>
                                  
                                    <tr>
                                        <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/26.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                                        <td height="24" class="etiqueta">TIPO DOC. IDENTIDAD</td>
                                      <td width="281"><?php generaCombo(45); ?></td>
										<td width="29" height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/27.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                                        <td width="167" height="24" class="etiqueta">N&Uacute;MERO DE DOCUMENTO</td>
<td width="289"><span class="etiqueta">
                                   										
										<input type="text" class="casilla" name="ic_nrodoc" id="ic_nrodoc" value="<?php 
										if($row6['tipo_persona']=='1'){echo trim($row2['nume_doc']);}
										else{ echo '';} ?>" size="9" onKeyPress="return validar_numeros(event)"/>
                                        </span></td>
                                    </tr>
                                    <tr>
                                        <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/31.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                                        <td height="24" class="etiqueta">N° DE R.U.C.</td>
                                      <td height="24" class="etiqueta"><input type="text" class="casilla" name="ic_ruc" value="<?php echo trim($row2['nume_ruc']); ?>" size="20" maxlength="11" id="ic_ruc" onKeyPress="return validar_numeros(event)"/></td>
                                        <td height="24" class="etiqueta"><div align="center"></div></td>
                                        <td height="24" class="etiqueta"></td>
                                      <td height="24" class="etiqueta"></td>
									</tr>
                                    <tr>
                                      <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_roja/32.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                                      <td height="24" colspan="5" class="etiqueta">APELLIDOS Y NOMBRES O RAZ&Oacute;N SOCIAL DEL CONDUCTOR</td>
                                    </tr>
                                    <tr>
                                      <td height="24" class="etiqueta"></td>
                                      <td height="24" class="etiqueta"><em>AP. PATERNO Y  AP. MATERNO</em></td>
                                      <td height="24" colspan="2" class="etiqueta"><input name="ape_paterno" type="text" class="casillaLarga" value="<?php echo trim($row2['ape_paterno']); ?>" size="20" id="ape_paterno" onKeyUp="validar_todo_mayus(this)"/>
                                        <input name="ape_materno" type="text" class="casillaLarga" value="<?php echo trim($row2['ape_materno']); ?>" size="20" id="ape_materno" onKeyUp="validar_todo_mayus(this)"/></td>
                                      <td height="24" class="etiqueta"><em>NOMBRES</em></td>
                                      <td height="24" class="etiqueta"><input name="nombres" type="text" class="casillaLarga" value="<?php echo trim($row2['nombres']); ?>" size="40" id="nombres" onKeyUp="validar_todo_mayus(this)"/></td>
                                    </tr>
                                    <tr>
                                      <td height="24" class="etiqueta"></td>
                                      <td height="24" class="etiqueta"><em>RAZÓN SOCIAL</em></td>
                                      <td height="24" class="etiqueta"><input name="ic_razsocial" type="text" class="casillaLarga" value="<?php echo trim($row2['razon_social']); ?>" size="46" id="ic_razsocial" onKeyUp="validar_todo_mayus(this)"/></td>
                                      <td height="24" class="etiqueta"></td>
                                      <td height="24" class="etiqueta"></td>
                                      <td height="24" class="etiqueta"></td>
                                    </tr>
                                    <tr>
                                      <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_roja/142.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                                      <td height="24" class="etiqueta">CONDICIÓN DEL CONDUCTOR</td>
                                      <td><?php generaCombo(41); ?></td>
                                      <td height="24" class="etiqueta"></td>
                                      <td height="24" class="etiqueta"></td>
                                      <td></td>
                                    </tr>
								</table>
						      <br>
							</td>
						<tr id="personajuridica"></tr>
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
                            <td class="etiquetanegra" colspan="6" height="30">
                                &nbsp;<strong>DOMICILIO FISCAL DEL TITULAR CATASTRAL:                            </strong></td>
                        </tr>
                        <!-- EN CASO EL CONDUCTOR SEA EL MISMO TITULAR CATASTRAL-->
                        <tr>
                            <td width="26" class="etiqueta" height="24">
                              <div align="center"><img src="../img/casilla_roja/39.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                            <td width="157" class="etiqueta">DEPARTAMENTO</td>
                          <td width="282">
                          <div align="left" ><?php verifica_ubigeo('dep',3);?></div>
                        <div align="left" id="capa_oculta1" style="display: none; color: red;"><?php generaDepartamento(); ?></div>                          </td>
                          <td width="23"><div align="center"><img src="../img/casilla_roja/40.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                            <td width="200"><span class="etiqueta">PROVINCIA</span></td>
                            <td width="262">
                            <div align="left"><?php verifica_ubigeo('pro',3);?></div>
                            <div align="left" id="capa_oculta2" style="display: none; color: red"> 
								<select style="width:200px" class="select" disabled="disabled" name="provincias" id="provincias" onChange='cargaContenido2(this.id)'>
					  <?php echo  "<option value='0'>SELECCIONE ...</option>";?>
								</select>
						    </div>                                                     </td>
                </tr>
                        <tr>
                            <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_roja/41.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                          <td height="24" class="etiqueta">DISTRITO</td>
                            <td>
                            <div align="left"><?php verifica_ubigeo('dis',3);?></div>
                            <div align="left" id="capa_oculta3" style="display: none; color: red">
								<select style="width:200px" class="select" disabled="disabled" name="distritos" id="distritos">
					  <?php echo  "<option value='0'>SELECCIONE ...</option>";?>
								</select>
						    </div></td>
                            <td colspan="3"><span class="Estilo1" id="cambiar" onClick="javascript:return muestra_y_oculta();">Cambiar UBIGEO</span></td>
                        </tr> 
                       
                        	<tr>
                                <td width="26" height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/42.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                              <td width="157" height="24" class="etiqueta">TEL&Eacute;FONO</td>
                           
                          <td width="282">
                            <input type="text" class="casilla" name="dftc_telf" value="<?php echo trim($row3['telefono']);?>" size="10" maxlength="12" id="dftc_telf" onKeyUp="validar_todo_mayus(this)"/> </td>
                              <td width="23" height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/43.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                                <td width="200" height="24" class="etiqueta">ANEXO</td>
                                <td>
                                    <input type="text" class="casilla" name="dftc_anexo" value="<?php echo trim($row3['anexo']);?>" size="2" maxlength="8" id="dftc_anexo" onKeyUp="validar_todo_mayus(this)"/></td>
                            </tr>
                            <tr>
                                <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/44.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                              <td height="24" class="etiqueta">FAX</td>
                                <td>
                                    <input type="text" class="casilla" name="dftc_fax" value="<?php echo trim($row3['fax']);?>" size="10" maxlength="12" id="dftc_fax" /></td>
                                <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/45.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                                <td height="24" class="etiqueta">CORREO ELECTR&Oacute;NICO</td>
                                <td>
                                    <input name="dftc_email" type="text" class="casillaLarga" id="dftc_email" value="<?php echo trim($row3['email']);?>" size="40" onKeyUp="EmailCheck(this)"/>  </td>
                            </tr>
                            <tr>
                                <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/7.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                              <td height="24" class="etiqueta">C&Oacute;DIGO DE V&Iacute;A</td>
                                <td>
                                    <input type="text" class="casilla" name="dftc_codvia" value="<?php echo trim($row3['codi_via']);?>" size="5" maxlength="6" id="dftc_codvia" onChange="trae_via(this)"/></td>
                              <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/8.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                                <td height="24" class="etiqueta">TIPO DE V&Iacute;A</td>
                                <td><input class="input"  id="dftc_tipovia" name="dftc_tipovia" value="<?php echo trim($row3['tipo_via']);?>" type="text" size="5"  readonly/></td>
                  </tr>
                            <tr>
                                <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/9.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                              <td height="24" class="etiqueta">NOMBRE DE V&Iacute;A</td>
                                <td>
                                    <input name="dftc_nomvia" type="text" class="casillaLarga" value="<?php echo trim($row3['nomb_via']);?>" size="32" id="dftc_nomvia" readonly/> </td>
                                <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/11.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                                <td height="24" class="etiqueta">N&Uacute;MERO MUNICIPAL</td>
                                <td>
                                    <input type="text" class="casilla" name="dftc_nummuni" value="<?php echo trim($row3['nume_muni']);?>" size="5" maxlength="6" id="dftc_nummuni"/> </td>
                            </tr>
                            <tr>
                                <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/14.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                              <td height="24" class="etiqueta">NOMBRE DE EDIFICACI&Oacute;N</td>
                                <td>
                                    <input name="dftc_nomedi" type="text" class="casillaLarga" id="dftc_nomedi" value="<?php echo trim($row3['nomb_edificacion']);?>" size="32" <?php echo $M;?>/> </td>
                                <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/17.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                                <td height="24" class="etiqueta">N&Uacute;MERO INTERIOR</td>
                                <td>
                                    <input type="text" class="casilla" name="dftc_numint" value="<?php echo trim($row3['nume_interior']);?>" size="2" maxlength="4" id="dftc_numint"/>  </td>
                            </tr>
                            <tr>
                                <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/18.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                                <td height="24" class="etiqueta">C&Oacute;DIGO H.U.</td>
                                <td>
                                    <input type="text" class="casilla" name="dftc_codhu" value="<?php echo trim($row3['codi_hab_urba']);?>" size="2" maxlength="4" id="dftc_codhu" onChange="trae_HU2(this)"/></td>
                                <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/19.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                                <td height="24" class="etiqueta">NOMBRE DE LA H.U.</td>
                                <td>
                                    <input name="dftc_nomhu" type="text" class="casillaLarga" value="<?php echo trim($row3['nomb_hab_urba']);?>" size="40" id="dftc_nomhu" readonly/></td>
                            </tr>
                            <tr>
                                <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/20.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                                <td height="24" class="etiqueta">ZONA/SECTOR/ETAPA</td>
                                <td>
                                    <input type="text" class="casilla" name="dftc_zse" value="<?php echo trim($row3['sector']);?>" size="20" maxlength="20" id="dftc_zse" <?php echo $M;?>/> </td>
                                <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/21.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                                <td height="24" class="etiqueta">MANZANA</td>
                                <td>
                                    <input type="text" class="casilla" name="dftc_mzna" value="<?php echo trim($row3['mzna']);?>" size="2" maxlength="3" id="dftc_mzna" <?php echo $M;?>/></td>
                            </tr>
                            <tr>
                                <td height="26" class="etiqueta"><div align="center"><img src="../img/casilla_azul/22.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                                <td height="26" class="etiqueta">LOTE</td>
                                <td><input type="text" class="casilla" name="dftc_lote" value="<?php echo trim($row3['lote']);?>" size="2" maxlength="5" id="dftc_lote"/></td>
                                <td height="26" class="etiqueta"><div align="center"><img src="../img/casilla_azul/23.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                                <td height="26" class="etiqueta">SUB-LOTE</td>
                                <td>
                                    <input type="text" class="casilla" name="dftc_sublote" value="<?php echo trim($row3['sublote']);?>" size="2" maxlength="6" id="dftc_sublote" <?php echo $M;?>/></td>
                            </tr>
						
		                        <!--HASTA AQUI-->
          </table>
	<br>	</td>
  </tr>
</table>
			<br>
			<table width="980px" align="center" cellPadding="0" cellSpacing="0" class="clsTabla2">
            <tr>
                <td>              </td>
            </tr>
        </table>     
			<table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" class="clsTabla2">
              <tr>
                <td><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="tabla">
                    <tr>
                      <td class="etiquetanegra" colspan="6" height="30">&nbsp;<strong>AUTORIZACI&Oacute;N MUNICIPAL DE FUNCIONAMIENTO:</strong> </td>
                    </tr>
                    <tr>
                      <td colspan="6" valign="top"><table width="950px" border="1" align="center" cellpadding="0" cellspacing="0" class="tabla">
                        <thead>
                          <tr class="principal">
                            <th width="17"><div align="center"><img src="../img/casilla_roja/143.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></th>
                            <th width="50">CÓDIGO</th>
                            <th width="17"><img src="../img/casilla_azul/144.png" alt="Guardar estado?" width="17" height="16" border="0" /></th>
                            <th width="779">DESCRIPCIÓN DE LA ACTIVIDAD</th>
                            <th width="75">ACCI&Oacute;N</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr class="normal">
                            <td colspan="5" class="celda" align="left">
                            <?php            
			//---------------------------------------------------------------- ACTIVIDADES: AMF   
			if($con_amf<0) //no hay registros
			 {
			  $indice1=0;
				echo " <div id='linea6_0'>"; generaCombo(42); 
                echo "          &nbsp;&nbsp;
                                  <input class='bt_plus6' id='122' type='button' value='+' />
                       </div>";
				}
			else
				 {            
				  $indice1=0;
				  while($row4=pg_fetch_array($consulta_amf))
					{ 
					   echo " <div id='linea6_".$indice1."'>"; generaCombo(42); 
                       echo "          &nbsp;&nbsp;";
		
					  	if($indice1<$nro_amf)
						{ echo "<input class='bt_plus6' id='122' type='button' value='-' />"; }
						else 
						{ echo "<input class='bt_plus6' id='122' type='button' value='+' /> ";}
                        $indice1++; 
						echo "</div>";
					}
				} 
							?> </td>
                          </tr>
                        </tbody>
                      </table></td>
                    </tr>
                    <tr>
                      <td colspan="6" class="etiqueta">&nbsp;</td>
                    </tr>
                    <tr>
                      <td class="etiqueta" colspan="6">&nbsp;</td>
                    </tr>
                   
                    <tr>
                      <td colspan="6" class="etiquetanegra" height="24">&nbsp;<strong>&Aacute;REA DE LA ACTIVIDAD ECON&Oacute;MICA</strong></td>
                    </tr>
                    <tr>
                      <td colspan="6" valign="top"><table border="1" align="center" bordercolor="#ECE9D8" cellpadding="0" cellspacing="0"  class="tabla">
                          <thead>
                            <tr class="principal">
                              <th>&nbsp;</th>
                              <th>UBICACI&Oacute;N</th>
                              <th>PREDIO CATASTRAL</th>
                              <th>V&Iacute;A P&Uacute;BLICA</th>
                              <th>BIEN COM&Uacute;N</th>
                              <th>TOTAL</th>
                              <!--
                                            <th>TOTAL</th>
                                            -->
                            </tr>
                          </thead>
                          <tbody>
                            <tr class="normal">
                              <td class="principal"><div align="center"><img src="../img/casilla_azul/145.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                              <td class="principal"><div align="center"><b>&Aacute;REA AUTORIZADA</b></div></td>
                              <td align="center"><input style="text-align:center" name="au_predcat" type="text" id="au_predcat"  value="<?php echo trim($row6['pred_area_autor']); ?>" maxlength="10" <?php echo $Ncoma;?>/></td>
                              <td align="center"><input style="text-align:center" name="au_viapub" type="text" id="au_viapub" value="<?php echo trim($row6['viap_area_autor']); ?>" maxlength="10" <?php echo $Ncoma;?>/></td>
                              <td align="center"><input style="text-align:center" name="au_bc" type="text" id="au_bc" maxlength="10" value="<?php echo trim($row6['bc_area_autor']); ?>" <?php echo $Ncoma;?>/></td>
                              <td align="center"><input style="text-align:center" name="au_total" type="text" id="au_total" maxlength="10" value="<?php $total1=trim($row6['pred_area_autor'])+trim($row6['viap_area_autor'])+trim($row6['bc_area_autor']);
							  echo $total1; ?>" <?php echo $Ncoma;?>/></td>
                            </tr>
                            <tr class="normal">
                              <td class="principal"><div align="center"><img src="../img/casilla_azul/146.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                              <td class="principal"><div align="center"><b>&Aacute;REA VERIFICADA</b></div></td>
                              <td align="center"><input style="text-align:center" type="text"  name="av_predcat" value="<?php echo trim($row6['pred_area_verif']); ?>" maxlength="10" id="av_predcat" <?php echo $Ncoma;?>/>                              </td>
                              <td align="center"><input style="text-align:center" type="text" name="av_viapub" value="<?php echo trim($row6['viap_area_verif']); ?>" maxlength="10" id="av_viapub" <?php echo $Ncoma;?>/></td>
                              <td align="center"><input style="text-align:center" type="text"  name="av_bc" value="<?php echo trim($row6['bc_area_verif']); ?>" maxlength="10" id="av_bc" <?php echo $Ncoma;?>/></td>
                              <td align="center"><input style="text-align:center" name="av_total" type="text" id="av_total" maxlength="10" value="<?php $total2=trim($row6['pred_area_verif'])+trim($row6['viap_area_verif'])+trim($row6['bc_area_verif']);
							  echo $total2; ?>" <?php echo $Ncoma;?>/></td>
                            </tr>
                          </tbody>
                      </table></td>
                    </tr>
                    <tr>
                      <td class="etiqueta" colspan="6">&nbsp;</td>
                    </tr>
                    
                    <tr>
                      <td width="10%" class="etiqueta" height="24"><div align="center"><img src="../img/casilla_azul/147.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td width="10%" class="etiqueta">&nbsp;N&Uacute;MERO DE EXPEDIENTE</td>
                      <td width="320"><input  name="aae_nroexp" type="text" id="aae_nroexp" value="<?php echo trim($row6['nume_expediente']); ?>" maxlength="10" <?php echo $N;?>/>                      </td>
                      <td width="77" class="etiqueta" height="24"><div align="center"><img src="../img/casilla_azul/148.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td width="78" class="etiqueta">N&Uacute;MERO DE LICENCIA</td>
                      <td><input type="text" name="aae_numlic"  id="aae_numlic" value="<?php echo trim($row6['nume_licencia']); ?>" maxlength="10" <?php echo $N;?>/>                      </td>
                </tr>
                     <tr>
                      <td class="etiqueta" colspan="6">&nbsp;</td>
                    </tr>
                     <tr>
                      <td class="etiqueta" colspan="6">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="6" class="etiquetanegra" height="24">&nbsp;<strong>VIGENCIA DE AUTORIZACI&Oacute;N</strong></td>
                    </tr>
                    <tr>
                      <td width="10%" height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/149.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td width="10%" height="24" class="etiqueta">&nbsp;FECHA DE EXPEDICI&Oacute;N</td>
                      <td width="320"><input  name="aae_fecexp" id="aae_fecexp" type="text" value="<?php echo trim($row6['fecha_expedicion']); ?>" size="15" maxlength="10" <?php echo $VF;?>/>
                        &nbsp;<img src="../img/calendarIcon.gif" onClick="popUpCalendar(this, aae_fecexp, &quot;dd/mm/yyyy&quot;)"  style="cursor:pointer" width="16" height="16" border="0" title="Ingresar Fecha"/></td>
                      <td width="77" height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/150.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td width="78" height="24" class="etiqueta">FECHA DE VENCIMIENTO</td>
                      <td><input  name="aae_fecven"  id="aae_fecven" type="text" value="<?php echo trim($row6['fecha_vencimiento']); ?>" size="15" maxlength="10" <?php echo $VF;?>/>
                        &nbsp;<img src="../img/calendarIcon.gif" onClick="popUpCalendar(this, aae_fecven, &quot;dd/mm/yyyy&quot;)" style="cursor:pointer" width="16" height="16" border="0" title="Ingresar Fecha"/></td>
                    </tr>
                    <tr>
                      <td width="78" height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/151.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td width="77" height="24" class="etiqueta">&nbsp;INICIO DE ACTIVIDAD</td>
                      <td colspan="4"><input  name="aae_iniact"  id="aae_iniact" type="text" value="<?php echo trim($row6['inic_actividad']); ?>" size="15" maxlength="10" <?php echo $VF;?>/>
                        &nbsp;<img src="../img/calendarIcon.gif" onClick="popUpCalendar(this, aae_iniact, &quot;dd/mm/yyyy&quot;)"  style="cursor:pointer" width="16" height="16" border="0" title="Ingresar Fecha"/></td>
                    </tr>
                    <tr>
                      <td colspan="6">&nbsp;</td>
                    </tr>
                </table></td>
              </tr>
            </table>
			<br>
			<table width="960" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" class="clsTabla2">
              <tr>
                <td><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" class="tabla">
                    <tr>
                      <td class="etiquetanegra" colspan="4" height="30">&nbsp;AUTORIZACI&Oacute;N DE ANUNCIO: </td>
                    </tr>
                    <tr>
                      <td colspan="4" valign="top"><table width="99%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#ECE9D8" class="tabla">
                          <tr>
                            <td><div align="center"><img src="../img/casilla_azul/152.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                            <td><div align="center"><img src="../img/casilla_azul/153.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                            <td><div align="center"><img src="../img/casilla_azul/154.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                            <td><div align="center"><img src="../img/casilla_azul/155.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                            <td><div align="center"><img src="../img/casilla_azul/156.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                            <td><div align="center"><img src="../img/casilla_azul/157.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                            <td><div align="center"><img src="../img/casilla_azul/158.png" alt="Guardar estado?" width="17" height="16" border="0" /></div>
                            <div align="center"></div></td>
                            <td colspan="4"><div align="center"><strong>VIGENCIA DE AUTORIZACI&Oacute;N</strong></div></td>
                            <td colspan="2" rowspan="2"><div align="center"><strong>ACCI&Oacute;N</strong></div></td>
                          </tr>
                          <tr>
                            <td><div align="center"><strong>C&Oacute;DIGO</strong></div></td>
                            <td><div align="center"><strong>DESCRIPCI&Oacute;N TIPO DE ANUNCIO</strong></div></td>
                            <td><div align="center"><strong>N&ordm; DE LADOS</strong></div></td>
                            <td><div align="center"><strong>AREA AUTORIZADA DEL ANUNCIO (m2)</strong></div></td>
                            <td><div align="center"><strong>AREA VERIFICADA DEL ANUNCIO (m2)</strong></div></td>
                            <td><div align="center"><strong>N&ordm; EXPEDIENTE</strong></div></td>
                            <td><div align="center"><strong>N&ordm; LICENCIA</strong></div></td>
                            <td><div align="center"><span class="secundario"><strong><img src="../img/casilla_azul/159.png" alt="Guardar estado?" width="17" height="16" border="0" /></strong></span></div></td>
                            <td><div align="center"><span class="secundario"><strong>FECHA DE EXPEDICI&Oacute;n</strong></span></div></td>
                            <td><div align="center"><span class="secundario"><strong><img src="../img/casilla_azul/160.png" alt="Guardar estado?" width="17" height="16" border="0" /></strong></span></div></td>
                            <td><div align="center"><span class="secundario"><strong>FECHA DE VENCIMIENTO</strong></span></div></td>
                          </tr>
                          <tr>
                            <td colspan="13">
                             <?php            
			//---------------------------------------------------------------- ANUNCIOS  : AA
					if($con_aa<0) //no hay registros
					 {
					  $indice2=0;
				echo " <div id='linea7_0'  style='width:950'>"; generaCombo(43); 
				echo "   <input  name='aa_nrolad-0' type='text'  maxlength='2' id='aa_nrolad-0'  style='width:50px; text-align:center;' ".$N."/>
                         <input name='aa_aaa-0' type='text' value='' maxlength='10' id='aa_aaa-0' ".$Ncoma." style='width:140px; text-align:center;'/>
                         <input  class='input' name='aa_ava-0' type='text' id='aa_ava-0' ".$Ncoma." style='width:135px; text-align:center;'/>
                         <input  class='input' name='aa_nroexp-0' type='text' id='aa_nroexp-0' ".$N." style='width:75px; text-align:center;'/>
                         <input  class='input' name='aa_nrolic-0' type='text' id='aa_nrolic-0' ".$N." style='width:65px; text-align:center;'/>
                         <input  class='input' name='aa_fecexp-0' type='text' id='aa_fecexp-0' maxlength='10' ".$VF." style='width:110px'/>
                         <input  class='input' name='aa_fecven-0' type='text' id='aa_fecven-0' maxlength='10' ".$VF." style='width:120px'/>
                         <input class='bt_plus7' id='1' type='button' value='+' />
                        </div>";
						}
					else 
					{
					  $indice2=0;
					  while($row5=pg_fetch_array($consulta_aa))
						{ 
				echo " <div id='linea7_".$indice2."'  style='width:950'>"; generaCombo(43); 
				echo "   <input  name='aa_nrolad-".$indice2."' type='text' value='".trim($row5['nume_lados'])."' maxlength='2'  id='aa_nrolad-".$indice2."'  style='width:50px; text-align:center;' ".$N."/>
                         <input name='aa_aaa-".$indice2."' type='text' value='".trim($row5['area_autorizada'])."' maxlength='10'  id='aa_aaa-".$indice2."' ".$Ncoma." style='width:140px; text-align:center;'/>
                         <input  class='input' name='aa_ava-".$indice2."' type='text' value='".trim($row5['area_verificada'])."'  id='aa_ava-".$indice2."' ".$Ncoma." style='width:135px; text-align:center;'/>
                         <input  class='input' name='aa_nroexp-".$indice2."' type='text' value='".trim($row5['nume_expediente'])."' id='aa_nroexp-".$indice2."' ".$N." style='width:75px; text-align:center;'/>
                         <input  class='input' name='aa_nrolic-".$indice2."' type='text' value='".trim($row5['nume_licencia'])."' id='aa_nrolic-".$indice2."' ".$N." style='width:65px; text-align:center;'/>
                         <input  class='input' name='aa_fecexp-".$indice2."' type='text' value='".trim($row5['fecha_expedicion'])."' id='aa_fecexp-".$indice2."' maxlength='10' ".$VF." style='width:110px'/>
                         <input  class='input' name='aa_fecven-".$indice2."' type='text' value='".trim($row5['fecha_vencimiento'])."' id='aa_fecven-".$indice2."' maxlength='10' ".$VF." style='width:120px'/>";
						if($indice2<$nro_aa)
						{ echo "<input class='bt_plus7' id='1' type='button' value='-' />"; }
						else { echo "<input class='bt_plus7' id='1' type='button' value='+' /> ";}
			            echo "</div>";
						 $indice2++; 
						}
					}
							?>
							</td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td colspan="4">&nbsp;</td>
                    </tr>
                </table></td>
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
       <td width="4%" class="etiqueta" height="24"><div align="center"><img src="../img/casilla_azul/114.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
       <td width="17%" class="etiqueta">CONDICI&Oacute;N DE DECLARANTE</td>
       <td height="24"><?php generaCombo(18); ?></td>
       <td height="24"><div align="center"><img src="../img/casilla_azul/161.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
       <td height="24"><span class="etiquetanegra">&nbsp;DOCUMENTOS PRESENTADOS: </span></td>
       <td height="24"><span class="etiquetanegra">
         <?php generaCombo(46); ?>
       </span></td>
     </tr>
     <tr>
       <td colspan="6">&nbsp;</td>
     </tr>
     <tr>
       <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_roja/116.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
       <td height="24" class="etiqueta">ESTADO DE LA FICHA</td>
       <td width="29%"><?php generaCombo(19); ?></td>
       <td width="3%" height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/119.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
       <td width="18%" height="24" class="etiqueta">MANTENIMIENTO</td>
       <td width="29%"><?php generaCombo(20); ?></td>
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
                            <td colspan="3"><textarea name="observacion" rows="4" cols="65" <?php echo $M;?>><?php echo trim($row7['observaciones']); ?></textarea></td>
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
                   <?php 
				  $cadena=$row8['declarante'];
				  $maximo = strlen($cadena);
				  $cadena_comienzo = "(";
				  $cadena_fin = ")";
				  $total = strpos($cadena,$cadena_comienzo);
 				  $total2 = strpos($cadena,$cadena_fin);
				  $total3 = ($maximo - $total2 - 1);
				  $dni = substr ($cadena,$total,-$total3);
				  $maximo = strlen($dni);
				  $dni = substr ($dni,1,$maximo-2);
				//  echo $dni;
				  
				  $cadena_comienzo = "- ";
				  $cadena_fin = ",";
				  $total = strpos($cadena,$cadena_comienzo);
 				  $total2 = strpos($cadena,$cadena_fin);
				  $total3 = ($maximo - $total2 - 1);
				  $nombres = substr ($cadena,$total,-$total3);
				  $maximo = strlen($nombres);
				  $nombres = substr ($nombres,2,$maxino-2);
				//  echo $nombres;
				  
				  $maximo = strlen($cadena);
				  $cadena_comienzo = ", ";
				  $cadena_fin = " |";
				  $total = strpos($cadena,$cadena_comienzo);
 				  $total2 = strpos($cadena,$cadena_fin);
				  $total3 = ($maximo - $total2 - 2);
				  $paterno = substr ($cadena,$total,-$total3);
				  $maximo = strlen($paterno);
				  $paterno = substr ($paterno,2,$maximo-4);
				//  echo $paterno;
				  
				  $maximo = strlen($cadena);
				  $cadena_comienzo = "| ";
				  $total = strpos($cadena,$cadena_comienzo);
 				  $materno = substr ($cadena,$total+2,$maximo);
				//  echo $materno;			  
				  ?>                  
                  <tr>
                    <td rowspan="3" class="etiqueta">&nbsp;</td>
                    <td height="24" class="etiqueta">DNI</td>
                    <td width="237"><input type="text" class="casilla" name="f_dni" value="<?php echo $dni;?>" size="10" maxlength="8" id="f_dni" onKeyPress="return validar_numeros(event)"/></td>
                    <td width="209" class="etiqueta" height="24">NOMBRES</td>
                    <td><input name="f_nom" type="text" class="casillaLarga" value="<?php echo $nombres;?>" size="40" id="f_nom" onKeyPress="return letras(event)" onKeyUp="validar_todo_mayus(this)"/></td>
                  </tr>
                  <tr>
                    <td height="24" class="etiqueta">APELLIDO PATERNO</td>
                    <td width="237"><input name="f_paterno" type="text" class="casillaLarga" value="<?php echo $paterno;?>" size="32" id="f_paterno" onKeyPress="return letras(event)" onKeyUp="validar_todo_mayus(this)"/></td>
                    <td width="209" class="etiqueta" height="24">APELIDO MATERNO</td>
                    <td><input name="f_materno" type="text" class="casillaLarga" value="<?php echo $materno;?>" size="40" id="f_materno" onKeyPress="return letras(event)" onKeyUp="validar_todo_mayus(this)"/> </td>
                  </tr>
                  <tr>
                    <td height="24" class="etiqueta">FECHA</td>
                    <td colspan="3"><input name="f_fecha" type="text" class="casillaFecha" id="f_fecha" value="<?php 
					if($row8['fecha_declarante']=='31/12/1969')
					{ echo '';}
					else echo trim($row8['fecha_declarante']); ?>" size="15" maxlength="10" <?php echo $VF;?>/>
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
                    <td><input name="f_fechasup" type="text" class="casillaFecha" id="f_fechasup"  value="<?php 
					if($row8['fecha_supervision']=='31/12/1969')
					{ echo '';}
					else echo trim($row8['fecha_supervision']); ?>" size="15" maxlength="10" <?php echo $VF;?>/>
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
                    <td><input name="f_fechatec" type="text" class="casillaFecha" id="f_fechatec" value="<?php echo trim($row8['fecha_levantamiento']); ?>" size="15" maxlength="10"<?php echo $VF;?>/>
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
                    <td colspan="3"><input name="f_fechaver" type="text" class="casillaFecha" id="f_fechaver" value="<?php 
					if($row8['fecha_verificacion']=='31/12/1969')
					{ echo '';}
					else echo trim($row8['fecha_verificacion']); ?>" size="15" maxlength="10" <?php echo $VF;?>/>
                      &nbsp;<img src="../img/calendarIcon.gif" onClick="popUpCalendar(this, f_fechaver, &quot;dd/mm/yyyy&quot;)" style="cursor:pointer" width="16" height="16" border="0" title="Ingresar Fecha"/></td>
                  </tr>
                  <tr>
                    <td height="24" class="etiqueta">&nbsp;</td>
                    <td height="24" class="etiqueta">N&deg; REGISTRO</td>
                    <td colspan="3"><input type="text" class="casilla" name="f_numreg" value="<?php echo trim($row8['nume_registro']); ?>" size="15" maxlength="10" id="f_numreg"/></td>
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
<?php
 }			
?>
	<p align="center">
		<input name="bGuardar" type="submit" class="booton" value="Guardar Ficha" />
&nbsp;&nbsp;&nbsp;
		<input name="bCancelar" type="button" class="booton" value="Cancelar" onClick="location='../funciones/close.php'"/>
	</p>
	<input name='bandera' type='text' class='contador' id='bandera' size='2' maxlength='3'/><br>
</div>
</form>
</div>
</body>
</html>