<?php session_start();
//header("Content-type: text/html; charset=utf-8");
include '../funciones/verifica_ubigeo.php'; //sesiones de UBIGEO
include '../funciones/genera_ubigeo.php';
include '../funciones/genera_dep.php';
include '../configuracion/eventos.php';
include 'proceso_cot/C_combos_editados.php';

?>
<script type="text/javascript" src="../js/mascara.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>
<script language="javascript" src="../js/funciones_validar.js"></script>
<script type="text/javascript" src="../js/valida_campo.js"></script>
<script type="text/javascript" src="../js/valida_campos_titular.js"></script>
<script language="JavaScript"  src="../js/popcalendar.js"></script>
<script type="text/javascript" src="../js/cascade_cotitular.js" ></script>
<script type="text/javascript" src="../js/datos_minimos_C.js"></script>
<!--<script type="text/javascript" src="../js/no_f5.js"></script>-->
<script type="text/javascript" src="../js/valida_clones.js"></script>
<script type="text/javascript" src="../js/imprimir.js"></script>

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
.Estilo1 {
	font-size: 12px;
	font-weight: bold;
	font-family: Calibri;
	font-style: italic;
	color: #FF0000;
}
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
<form  name="datos" method="post" >
<div align="center">
<?php
//RECOGE ID
	$IDFicha = $_GET[id];
	//echo $IDFicha;
	
	$BD=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);
	$BD->conectar();
	
	
	//TOTAL DE COTITULARES
	$Consulta0="SELECT p.tipo_persona, p.tipo_doc, p.nume_doc, p.nombres, p.ape_paterno, p.ape_materno, p.razon_social, ".
			"t.form_adquisicion, t.fecha_adquisicion, t.porc_cotitular, t.telf, t.anexo, t.fax, t.email, ".
			"t.codi_contribuyente, t.cond_titular, d.codi_via, d.tipo_via, d.nomb_via, d.nume_muni, ".
			"d.nomb_edificacion, d.nume_interior, ".
			"d.codi_hab_urba, d.nomb_hab_urba, d.sector, d.mzna, d.lote, d.sublote, d.codi_dep, ".
			"d.codi_pro, d.codi_dis, e.condicion, e.nume_resolucion, e.fecha_inicio, e.fecha_vencimiento ".
			"FROM tf_domicilio_titulares AS d INNER JOIN tf_personas AS p ON d.id_persona=p.id_persona ".
			"INNER JOIN tf_titulares AS t ON p.id_persona=t.id_persona ".
			"INNER JOIN tf_exoneraciones_titular AS e ON t.id_ficha=e.id_ficha AND t.id_persona=e.id_persona ".
			"WHERE t.id_ficha = '$IDFicha' ".
			"ORDER BY t.nume_titular";
			
	//-- DATOS GENERALES
	$Consulta1="SELECT f.id_ficha,f.nume_ficha,f.nume_ficha_lote, ".
			"f.dc,u.id_uni_cat,u.cuc, u.codi_hoja_catastral ".
			"FROM tf_uni_cat as u INNER JOIN tf_fichas as f ON u.id_uni_cat=f.id_uni_cat ".
			"WHERE f.id_ficha = '$IDFicha'";
			
	//EXONERACIONES
	$Consulta2="SELECT condicion, nume_resolucion, fecha_inicio, fecha_vencimiento ".
				"FROM tf_exoneraciones_titular  ".
				"WHERE id_ficha = '$IDFicha'";
			
				
	//-- IC : Informacion Complementaria
	$Consulta3="SELECT cond_declarante, esta_llenado, observaciones ".
				"FROM tf_fichas_cotitularidades ".
				"WHERE id_ficha = '$IDFicha'";
	
	//-- FIRMAS
	$Consulta4="SELECT declarante, fecha_declarante, supervisor, fecha_supervision, tecnico, fecha_levantamiento, ".
				"verificador, fecha_verificacion, nume_registro ".
				"FROM tf_fichas ".
				"WHERE id_ficha = '$IDFicha'";
				

	//-------------------------------------- Ejecutamos consultas
	$consulta_total= $BD->Consultas($Consulta0);
	$nro_titulares=pg_num_rows($consulta_total);
	//echo $nro_titulares;
	
	$consulta_dg= $BD->Consultas($Consulta1);

	$consulta_ex= $BD->Consultas($Consulta2);
	
	$consulta_ic= $BD->Consultas($Consulta3);
	$row3=pg_fetch_array($consulta_ic);
	
	$consulta_fi= $BD->Consultas($Consulta4);
	$row4=pg_fetch_array($consulta_fi);


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
      <td colspan="6" bgcolor="#0052A4" class="Titulo1"><div align="center" class="Estilo7"><span class="Estilo12">FICHA CATASTRAL URBANA COTITULARIDAD</span></div></td>
    </tr>
    <tr>
      <td colspan="6">
			<br>
		<table width="980px" border="0" cellpadding="0" cellspacing="0" class="tabla">
			<tr>
				<td width="192">&nbsp;</td>
				<td width="291"><div align="left">N&Uacute;MERO DE FICHA
               	  <input type='text' class='casilla' name='numficha' id='numficha' value='<?php echo $row1['nume_ficha']; ?>' size='7' maxlength='7' readonly/></td>
				<td width="75">&nbsp;</td>
				<td width="181"><div align="left">N&Uacute;MERO DE FICHAS POR LOTE&nbsp;</div></td>
				<td width="241"><input type="text" name="numflote1" value="<?php 
				  
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
				
				?>" size="1" maxlength="2" id="numflote2" <?php echo $N;?> /></td>
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
                                <input readonly name="dg_cuc8" type="text" id="dg_cuc8" size="8" maxlength="8" <?php echo $N;?> value="<?php echo substr($row1['cuc'],0,8); ?>"/>
                                <input readonly name="dg_cuc4" type="text" size="2" maxlength="4" id="dg_cuc4" <?php echo $N;?> value="<?php echo substr($row1['cuc'],8,4); ?>"/></td>
                                <td><div align="center"><img src="../img/casilla_azul/2.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                                <td colspan="4">C&Oacute;DIGO HOJA CATASTRAL</td>
                                <td colspan="2"><div align="right">
                                    <input readonly name="dg_hojacatastral" type="text" id="dg_hojacatastral" size="8" value="<?php echo trim($row1['codi_hoja_catastral']); ?>" maxlength="10" <?php echo $N;?> />
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
								
									echo "<td><input readonly name='dg_sector' class='2' type='text' id='dg_sector' size='2' value=".$campo_3." maxlength='2' ".$N.' '.$DC.' '.$ev_2."></td>";
									echo "<td><input readonly name='dg_manzana' type='text' class='2' id='dg_manzana' size='2' value=".$campo_4." maxlength='3' ".$N.' '.$DC."></td>";
									echo "<td><input readonly name='dg_lote' type='text' class='2' id='dg_lote' size='2' value=".$campo_5." maxlength='3' ".$N.' '.$DC."></td>";
									echo "<td><input readonly name='dg_edificacion' type='text' class='2' id='dg_edificacion' size='2' value=".$campo_6." maxlength='2' ".$N.' '.$DC."></td>";
									echo "<td><input readonly name='dg_entrada' type='text' class='2' id='dg_entrada' size='2' value=".$campo_7." maxlength='2' ".$N.' '.$DC."></td>";
									echo "<td><input readonly name='dg_piso' type='text' class='2' id='dg_piso' size='2' value=".$campo_8." maxlength='2' ".$N.' '.$DC."></td>";
									echo "<td><input readonly name='dg_unidad' type='text' class='2' id='dg_unidad' size='2' value=".$campo_9." maxlength='3' ".$N.' '.$DC."></td>";
									echo "<td><input readonly name='dg_dc' type='text' id='dg_dc' size='2' value=".$campo_10." maxlength='1' ".$DC."></td>";
                              
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
	$i=0;
	while($row2=pg_fetch_array($consulta_total))
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
										  <td><input name='dcc_porcentaje-".($i)."' type='text' value='".trim($row2['porc_cotitular'])."' size='8' id='dcc_porcentaje-".($i)."'".$N.$Decimal." /></td>
									</tr>                                  
                                    <tr>
                                        <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/4.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                        <td height='24' class='etiqueta'>CÓDIGO DEL CONTRIBUYENTE</td>
                                      <td width='281'><input name='dg_codcontribuyente-".($i)."' type='text' value='".trim($row2['codi_contribuyente'])."' size='8' id='dg_codcontribuyente-".($i)."' onkeyup='validar_todo_mayus(this)' /></td>
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
                                        <td height='24' class='etiqueta'><input type='text' class='casilla' name='itc_numdoc-".($i)."' id='itc_numdoc-".($i)."'  size='9' onkeypress='return validar_numeros(event)' "; if($row2['tipo_persona']=='1')
														{ echo "value='".trim($row2['nume_doc'])."'";}
														else{ echo " disabled='true'";} echo "/></td>
									</tr>
                                    <tr>
                                        <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/28.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                        <td height='24' class='etiqueta'><em>NOMBRES</em></td>
                                      <td height='24' class='etiqueta'><input name='itc_nombre_".($i)."' type='text' class='casillaLarga' value='".trim($row2['nombres'])."' size='32' id='itc_nombre_".($i)."' onkeypress='return letras(event)' onkeyup='validar_todo_mayus(this)' " ; if($row2['tipo_persona']=='2') { echo "disabled='true'"; } echo "/></td>
                                        <td height='24' class='etiqueta'>&nbsp;</td>
                                        <td height='24' class='etiqueta'>&nbsp;</td>
                                        <td height='24' class='etiqueta'>&nbsp;</td>
                                    </tr>
                                    <tr>
                                      <td height='12' class='etiqueta'><div align='center'><img src='../img/casilla_azul/29.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='12' class='etiqueta'><em>APELLIDO PATERNO</em></td>
                                      <td height='12' class='etiqueta'><input type='text' class='casilla' name='itc_paterno_".($i)."' value='".trim($row2['ape_paterno'])."' size='32' id='itc_paterno_".($i)."' onkeypress='return letras(event)' onkeyup='validar_todo_mayus(this)' " ; if($row2['tipo_persona']=='2') { echo "disabled='true'"; } echo "/></td>
                                      <td height='12' class='etiqueta'><div align='center'><img src='../img/casilla_azul/30.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='12' class='etiqueta'><em><em>APELLIDO MATERNO</em></em></td>
                                      <td height='12' class='etiqueta'><input type='text' class='casilla' name='itc_materno_".($i)."' value='".trim($row2['ape_materno'])."' size='40' id='itc_materno_".($i)."' onkeypress='return letras(event)' onkeyup='validar_todo_mayus(this)' " ; if($row2['tipo_persona']=='2') { echo "disabled='true'"; } echo "/></td>
                                    </tr>
                                    <tr>
                                      <td height='12' colspan='6' class='etiqueta'>&nbsp;</td>
                                    </tr>
                                    <tr>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/31.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>N&Uacute;MERO DE RUC</td>
                                      <td><input type='text' class='casilla' name='itc_ruc-".($i)."' "; if($row2['tipo_persona']=='2'){echo "value='".trim($row2['nume_doc'])."'";}	else{ echo " disabled='true' ";} echo " size='11' maxlength='11' id='itc_ruc-".($i)."' onKeyPress='return validar_numeros(event)' /></td>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/32.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>RAZON SOCIAL</td>
                                      <td><input name='itc_razsocial-".($i)."' type='text' class='casillaLarga' "; if($row2['tipo_persona']=='2'){echo "value='".trim($row2['razon_social'])."'";}	else{ echo " disabled='true' ";} echo " size='40' id='itc_razsocial-".($i)."' onkeyup='validar_todo_mayus(this)' /></td>
                                    </tr>
                                    <tr>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/47.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>FORMA DE ADQUISICI&Oacute;N</td>
                                      <td>"; echo generaCombo(39,$i);  echo "</td>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_roja/48.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>FECHA DE ADQUISICI&Oacute;N</td>
                                      <td><input name='ct_fechaadq_".($i)."' type='text' class='casillaFecha' id='ct_fechaadq_".($i)."' value='".trim($row2['fecha_adquisicion'])."' size='15' maxlength='10' ".$VF."/>
&nbsp;<img src='../img/calendarIcon.gif' onclick='popUpCalendar(this, ct_fechaadq_".($i).", &quot;dd/mm/yyyy&quot;)' style='cursor:pointer' width='16' height='16' border='0' title='Ingresar Fecha'/></td>
                                    </tr>
                                    <tr>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/34.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>COND. ESP. DEL TITULAR</td>
                                      <td>"; echo generaCombo(40,$i); echo "</td>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/35.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>Nº RESOL. EXONERACION</td>
                                      <td><input type='text' class='casillaFecha' name='itc_numresexo-".($i)."' value='".trim($row2['nume_resolucion'])."' size='9' maxlength='10' id='itc_numresexo-".($i)."' onkeyup='validar_todo_mayus(this)' /></td>
                                    </tr>
                                    <tr>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/37.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>INICIO EXONERACION</td>
                                      <td><input name='itc_fechainiexo_".($i)."' type='text' id='itc_fechainiexo_".($i)."' value='".trim($row2['fecha_inicio'])."' size='15' maxlength='10' ".$VF." />      <img src='../img/calendarIcon.gif' onClick='popUpCalendar(this, itc_fechainiexo_".($i).", &quot;dd/mm/yyyy&quot;)' style='cursor:pointer' width='16' height='16' border='0' title='Ingresar Fecha'/></td>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/38.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>FIN EXONERACION</td>
                                      <td><input name='itc_fechafinexo_".($i)."' type='text' id='itc_fechafinexo_".($i)."' value='".trim($row2['fecha_vencimiento'])."' size='15' maxlength='10' ".$VF." />      <img src='../img/calendarIcon.gif' onClick='popUpCalendar(this, itc_fechafinexo_".($i).", &quot;dd/mm/yyyy&quot;)' style='cursor:pointer' width='16' height='16' border='0' title='Ingresar Fecha'/></td>
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
                                      <td>  <div align='left' >"; verifica_ubigeo_cotitulares('dep',2,$i); echo"</div>
                        <div align='left' id='capa_oculta1_".($i)."' style='display: none; color: red;'>"; generaDep($i); echo "</div> </td>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_roja/40.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>PROVINCIA</td>
                                      <td>"; 
                           echo "<div align='left'>"; verifica_ubigeo_cotitulares('pro',2,$i); echo "</div>
                            <div align='left' id='capa_oculta2_".($i)."' style='display: none; color: red'><select class='select' disabled='disabled' name='provincias".($i)."' id='provincias".($i)."' onchange='cargaContenido2(this.id)'>
                                        
                                      </select></div></td>
                                    </tr>
                                    <tr>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_roja/41.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>DISTRITO</td>
                                      <td><div align='left'>"; verifica_ubigeo_cotitulares('dis',2,$i); echo "</div>
                            <div align='left' id='capa_oculta3_".($i)."' style='display: none; color: red'><select disabled='disabled' name='distritos".($i)."' id='distritos".($i)."'>
                                        
                                      </select></div></td>
									  
									  <td colspan='3'></td>
									  
                                      
                                    </tr>
                                    <tr>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/42.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>TEL&Eacute;FONO</td>
                                      <td><input type='text' class='casilla' name='dftc_telf-".($i)."' value='".trim($row2['telf'])."' size='10' maxlength='12' id='dftc_telf-".($i)."' onkeyup='validar_todo_mayus(this)'/></td>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/43.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>ANEXO</td>
                                      <td><input type='text' class='casilla' name='dftc_anexo-".($i)."' value='".trim($row2['anexo'])."' size='2' maxlength='8' id='dftc_anexo-".($i)."' onkeyup='validar_todo_mayus(this)'/></td>
                                    </tr>
                                    <tr>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/44.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>FAX</td>
                                      <td><input type='text' class='casilla' name='dftc_fax-".($i)."' value='".trim($row2['fax'])."' size='10' maxlength='12' id='dftc_fax-".($i)."' /></td>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/45.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>CORREO ELECTR&Oacute;NICO</td>
                                      <td><input name='dftc_email-".($i)."' type='text' class='casillaLarga' id='dftc_email-".($i)."' value='".trim($row2['email'])."' size='40' onkeyup='EmailCheck(this)'/></td>
                                    </tr>
                                    <tr>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/7.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>C&Oacute;DIGO DE V&Iacute;A</td>
                                      <td><input type='text' class='casilla' name='dftc_codvia-".($i)."' value='".trim($row2['codi_via'])."' size='5' maxlength='6' id='dftc_codvia-".($i)."' onchange='trae_via(this)'/></td>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/8.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>TIPO DE V&Iacute;A</td>
                                      <td><input class='input'  id='dftc_tipovia-".($i)."' name='dftc_tipovia-".($i)."' type='text' size='5'  value='".trim($row2['tipo_via'])."' disabled/></td>
                                    </tr>
                                    <tr>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/9.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>NOMBRE DE V&Iacute;A</td>
                                      <td><input name='dftc_nomvia-".($i)."' type='text' class='casillaLarga' value='".trim($row2['nomb_via'])."' size='32' id='dftc_nomvia-".($i)."' disabled/></td>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/11.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>N&Uacute;MERO MUNICIPAL</td>
                                      <td><input type='text' class='casilla' name='dftc_nummuni-".($i)."' value='".trim($row2['nume_muni'])."' size='5' maxlength='6' id='dftc_nummuni-".($i)."'/></td>
                                    </tr>
                                    <tr>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/14.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>NOMBRE DE EDIFICACI&Oacute;N</td>
                                      <td><input name='dftc_nomedi-".($i)."' type='text' class='casillaLarga' id='dftc_nomedi-".($i)."' value='".trim($row2['nomb_edificacion'])."' size='32'/></td>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/17.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>N&Uacute;MERO INTERIOR</td>
                                      <td><input type='text' class='casilla' name='dftc_numint-".($i)."' value='".trim($row2['nume_interior'])."' size='2' maxlength='4' id='dftc_numint-".($i)."'/></td>
                                    </tr>
                                    <tr>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/18.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>C&Oacute;DIGO H.U.</td>
                                      <td><input type='text' class='casilla' name='dftc_codhu-".($i)."' value='".trim($row2['codi_hab_urba'])."' size='2' maxlength='4' id='dftc_codhu-".($i)."' onchange='trae_HU2(this)'/></td>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/19.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>NOMBRE DE LA H.U.</td>
                                      <td><input name='dftc_nomhu-".($i)."' type='text' class='casillaLarga' value='".trim($row2['nomb_hab_urba'])."' size='40' id='dftc_nomhu-".($i)."' disabled/></td>
                                    </tr>
                                    <tr>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/20.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>ZONA/SECTOR/ETAPA</td>
                                      <td><input type='text' class='casilla' name='dftc_zse-".($i)."' value='".trim($row2['sector'])."' size='20' maxlength='20' id='dftc_zse-".($i)."'/></td>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/21.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>MANZANA</td>
                                      <td><input type='text' class='casilla' name='dftc_mzna-".($i)."' value='".trim($row2['mzna'])."' size='2' maxlength='3' id='dftc_mzna-".($i)."'/></td>
                                    </tr>
                                    <tr>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/22.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>LOTE</td>
                                      <td><input type='text' class='casilla' name='dftc_lote-".($i)."' value='".trim($row2['lote'])."' size='2' maxlength='5' id='dftc_lote-".($i)."'/></td>
                                      <td height='24' class='etiqueta'><div align='center'><img src='../img/casilla_azul/23.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>SUB-LOTE</td>
                                      <td><input type='text' class='casilla' name='dftc_sublote-".($i)."' value='".trim($row2['sublote'])."' size='2' maxlength='6' id='dftc_sublote-".($i)."'/></td>
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
        $i++;}
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
                            <td colspan="3"><textarea name="observacion" rows="4" cols="65" <?php echo $M;?>><?php echo trim($row3['observaciones']); ?></textarea></td>
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
				  $cadena=$row4['declarante'];
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
                    <td width="276"><input type="text" class="casilla" name="f_dni" value="<?php echo $dni;?>" size="10" maxlength="8" id="f_dni" onKeyPress="return validar_numeros(event)"/></td>
                    <td width="170" class="etiqueta" height="24">NOMBRES</td>
                    <td><input name="f_nom" type="text" class="casillaLarga" value="<?php echo $nombres;?>" size="40" id="f_nom" onKeyPress="return letras(event)" onKeyUp="validar_todo_mayus(this)"/></td>
                  </tr>
                  <tr>
                    <td height="24" class="etiqueta">APELLIDO PATERNO</td>
                    <td width="276"><input name="f_paterno" type="text" class="casillaLarga" value="<?php echo $paterno;?>" size="32" id="f_paterno" onKeyPress="return letras(event)" onKeyUp="validar_todo_mayus(this)"/></td>
                    <td width="170" class="etiqueta" height="24">APELIDO MATERNO</td>
                    <td><input name="f_materno" type="text" class="casillaLarga" value="<?php echo $materno;?>" size="40" id="f_materno" onKeyPress="return letras(event)" onKeyUp="validar_todo_mayus(this)"/> </td>
                  </tr>
                  <tr>
                    <td height="24" class="etiqueta">FECHA</td>
                    <td colspan="3"><input name="f_fecha" type="text" class="casillaFecha" id="f_fecha" value="<?php 
					if($row4['fecha_declarante']=='31/12/1969')
					{ echo '';}
					else echo trim($row4['fecha_declarante']); ?>" size="15" maxlength="10" <?php echo $VF;?>/>
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
                    <td><input name="f_fechasup" type="text" class="casillaFecha" id="f_fechasup"  value="<?php 
					if($row4['fecha_supervision']=='31/12/1969')
					{ echo '';}
					else echo trim($row4['fecha_supervision']); ?>" size="15" maxlength="10" <?php echo $VF;?>/>
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
                    <td><input name="f_fechatec" type="text" class="casillaFecha" id="f_fechatec" value="<?php echo trim($row4['fecha_levantamiento']); ?>" size="15" maxlength="10"<?php echo $VF;?>/>
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
                    <td colspan="3"><input name="f_fechaver" type="text" class="casillaFecha" id="f_fechaver" value="<?php 
					if($row4['fecha_verificacion']=='31/12/1969')
					{ echo '';}
					else echo trim($row4['fecha_verificacion']); ?>" size="15" maxlength="10" <?php echo $VF;?>/>
                      &nbsp;<img src="../img/calendarIcon.gif" onClick="popUpCalendar(this, f_fechaver, &quot;dd/mm/yyyy&quot;)" style="cursor:pointer" width="16" height="16" border="0" title="Ingresar Fecha"/></td>
                  </tr>
                  <tr>
                    <td height="24" class="etiqueta">&nbsp;</td>
                    <td height="24" class="etiqueta">N&deg; REGISTRO</td>
                    <td colspan="3"><input type="text" class="casilla" name="f_numreg" value="<?php echo trim($row4['nume_registro']); ?>" size="15" maxlength="10" id="f_numreg"/></td>
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
<?php
 }			
?>
	<p align="center">
	  <input name="btnimprimir" type="submit" class="booton" value="Imprimir Ficha" onClick="doPrint(this.form)"/>
		&nbsp;&nbsp;&nbsp;<input name="bCancelar" type="button" class="booton" value="Cancelar" onClick="location='../funciones/close.php'"/>
	</p>
	<br>
</div>
</form>
</div>
</body>
</html>