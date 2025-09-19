<?php 
  //session_start();
  //header("Content-type: text/html; charset=utf-8");
  include '../funciones/kill_sesion.php'; //matamos sesiones existentes de codigo referencial
  include '../funciones/verifica_ubigeo.php'; //sesiones de UBIGEO
  include '../funciones/genera_dep.php';
  include '../configuracion/eventos.php';
  include 'proceso_ind/I_combos.php';

  $Dep=$_SESSION['dep'];
  $Pro=$_SESSION['pro'];
  $Dis=$_SESSION['dis'];
  $ubigeo=$_SESSION['ubigeo'];
  /*echo "<script>alert('$ubigeo');</script>\n"; */

  //CAPTURAMOS nombre de página para el caso de VERIFICACION E INSERCION
  //$_SESSION['pagina']=basename($_SERVER["PHP_SELF"]);
  //$cad=basename($_SESSION['pagina']);
  if(isset($_GET['ses'])) $sesion=$_GET['ses'];
  //matar SESIONES
?>

<!-- Código Agregado -->
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery.addfield.js"></script>
<script type="text/javascript" src="../js/popcalendar.js"></script>

<script type="text/javascript" src="../js/datos_minimos_I.js"></script>
<script type="text/javascript" src="../js/funciones_validar.js"></script>
<script type="text/javascript" src="../js/valida_clones.js"></script>
<script type="text/javascript" src="../js/valida_campo.js"></script>
<script type="text/javascript" src="../js/valida_campos_titular.js"></script>
<script type="text/javascript" src="../js/cascade.js" ></script>
<script type="text/javascript" src="../js/mascara.js"></script>
<script type="text/javascript" src="../js/no_f5.js"></script>

<link href="../css/popcalendar.css" rel="stylesheet" type="text/css">
<link href="../css/estilo_form.css" rel="stylesheet" type="text/css"/>
<link href="../css/link.css" rel="stylesheet" type="text/css">
<link href="../css/tabla.css" rel="stylesheet" type="text/css">
<link href="../css/botones.css" rel="stylesheet" type="text/css">
<link href="../css/combos.css" rel="stylesheet" type="text/css">

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Levantamiento de Informacion Catastral</title>
  <style type="text/css">
    <!--
    .Estilo7 {
    	color: #FFFFFF;
    	font-size: 16px;
    	font-weight: bold;
    }
    .Estilo9  {font-size: 9px}
    .Estilo10 {font-size: 8px}
    .Estilo11 {font-family: Verdana, Arial, Helvetica, sans-serif}
    -->
  </style>
</head>
<body onLoad="javascript:ponerfoco_1()" onkeypress="javascript:if(event.keyCode==13)return false;" onKeyDown="javascript:no_f5(this);"><!-- en mascara.js-->
  <div align="center">
    <form  class="myform" name="datos" action="proceso_ind/I_graba_individual.php" method="post" onSubmit="return datos_minimos_individual()" autocomplete="off">
      <div align="center">
        <table width="980px" border="1" align="center" cellPadding="0" cellSpacing="0" bordercolor="#000000">
          <tr>
            <td colspan="6" bgcolor="#0052A4" class="Titulo1"><div align="center" class="Estilo7">LEVANTAMIENTO DE INFORMACIÇN CATASTRAL</div></td>
          </tr>

          <tr>
            <td colspan="6"><br/>

            <!--- ENCABEZADO DE FICHA -->
        		<table width="980px" border="0" cellpadding="0" cellspacing="0" class="tabla">
              <tr>
                <td colspan="6"><br>
                  <div align="center">
                    <table width="943" border="0" align="center">
                      <tr>
                        <td width="146"><div align="center"><img src="../img/SNCP.PNG" width="144" height="57" /></div></td>
                        <td width="639">
                          <div align="center">
                            <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
                              <tr>
                                <td>
                                  <div align="center">
                                    <table width="630" border="0" cellpadding="0" cellspacing="0" class="tabla" style="vertical-align:middle">
                                      <tr><td colspan="16"><strong>BUSQUEDA DE FICHAS </strong></td></tr>
                                      <tr>
                                        <td width="16%" height="24" valign="middle"><div align="center"><img src="../img/casilla_azul/1.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                                        <td width="15%" valign="middle">Codigo Catastral: </td>
                                        <td colspan="4"><input name="dg_cuc8" type="text" id="dg_cuc8" size="9" maxlength="9" <?php echo $N;?> /></td>
                                        <td><div align="center"><img src="../img/casilla_azul/2.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                                        <td colspan="4">PROVINCIA</td>
                                        <td colspan="2"><div align="right"><input name="dg_hojacatastral" type="text" id="dg_hojacatastral" size="8" maxlength="10" <?php echo $N;?> /></div></td>
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
                        <td width="6%" valign="bottom"><div align="left" class="Estilo10"><div align="center"><span class="Estilo11">&nbsp;&nbsp;DC</span></div></div></td>
                      </tr>

  <tr>
    <td height="24"><div align="center"><img src="../img/casilla_roja/3.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
    <td height="24">CÓDIGO DE REFERENCIA CATASTRAL </td>
    <td><div align="center"><input name="dg_dep" class="2" type="text" id="dg_dep" value=<?php echo $Dep;?> size="2" maxlength="2" readonly /></div></td>
    <td><div align="center"><input name="dg_pro" type="text" class="2" id="dg_pro" value=<?php echo $Pro;?> size="2" maxlength="2" readonly /></div></td>
    <td><div align="center"><input name="dg_dis" class="2" type="text" id="dg_dis" value=<?php echo $Dis;?> size="2" maxlength="2" readonly/></div></td>
    <td><div align="center"><input name="dg_sector" class="2" type="text" id="dg_sector" size="2" maxlength="2" <?php echo $N.' '.$DC.' '.$ev_2?> /></div></td>
    <td><div align="center"><input name="dg_manzana" type="text" class="2" id="dg_manzana" size="2" maxlength="3" <?php echo $N.' '.$DC;?> onChange='javascript:rellenar_campo(this,3);valida_referenciacatastral();'/></div></td>
    <td><div align="center"><input name="dg_lote" type="text" class="2" id="dg_lote" size="2" maxlength="3" <?php echo $N.' '.$DC;?> onChange='rellenar_campo(this,3);valida_referenciacatastral();'/></div></td>
    <td><div align="center"><input name="dg_edificacion" type="text" class="2" id="dg_edificacion" size="2" maxlength="2" <?php echo $N.' '.$DC;?> onChange='javascript:rellenar_campo(this,2);'/></div></td>
    <td><div align="center"><input name="dg_entrada" type="text" class="2" id="dg_entrada" size="2" maxlength="2" <?php echo $N.' '.$DC;?> onChange='javascript:rellenar_campo(this,2);'/></div></td>
    <td><div align="center"><input name="dg_piso" type="text" class="2" id="dg_piso" size="2" maxlength="2" <?php echo $N.' '.$DC;?> onChange='javascript:rellenar_campo(this,2);'/></div></td>
    <td><div align="center"><input name="dg_unidad" type="text" class="2" id="dg_unidad" size="2" maxlength="3" <?php echo $N.' '.$DC;?> onChange='javascript:rellenar_campo(this,3);'/></div></td>
    <td><div align="center"><input name="dg_dc" type="text" id="dg_dc" size="2" maxlength="1" <?php echo $DC;?> /></div></td>
  </tr>

                                      <tr>
                                        <td><div align="center"><img src="../img/casilla_azul/4.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                                        <td>CÓDIGO CONTRIBUYENTE DE RENTAS </td>
                                        <td colspan="3"><input name="dg_codcontribuyente" type="text" id="dg_codcontribuyente" onKeyUp="validar_todo_mayus(this)" size="8" maxlength="15" /></td>
                                        <td><div align="center"></div></td>
                                        <td><div align="center"><img src="../img/casilla_azul/5.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                                        <td colspan="4">CÓDIGO PREDIAL DE RENTAS</td>
                                        <td>&nbsp;</td>
                                        <td><input name="dg_codpredial" type="text" id="dg_codpredial" onKeyUp="validar_todo_mayus(this)" size="8" maxlength="15" /></td>
                                        <td width="11%">&nbsp;</td>
                                      </tr>
                                      
                                      <!-- Datos Auxiliares -->            
                                      <tr>
                                        <td height="24">&nbsp;</td>
                                        <td height="24">&nbsp;</td>
                                        <td colspan="12">
                                          <input name="contador1" type="text" class="contador" id="contador1" value="0" size="2" maxlength="2"/>
                                          <input name="contador2" type="text" class="contador" id="contador2" value="0" size="2" maxlength="2"/>
                                          <input name="contador3" type="text" class="contador" id="contador3" value="0" size="2" maxlength="2"/>
                                          <input name="contador4" type="text" class="contador" id="contador4" value="0" size="2" maxlength="2"/>
                                          <input name="contador5" type="text" class="contador" id="contador5" value="0" size="2" maxlength="2"/>
                                          <input name="anio" type="text" class="contador" id="anio" value='<?php $anio=date("Y"); echo $anio;?>' size="4" maxlength="4"/>
                                          <input name="previo" type="text" class="contador" id="previo" size="25" maxlength="19"/>
                                          <input name="tipo" type="text" class="contador" id="tipo" size="2" maxlength="2"/>
                                        </td>
                                      </tr>
                                    </table>
                                  </div>
                                </td>
                              </tr>
                            </table>
                          </div>
                        </td>
                        <td width="144"><div align="center"><img src="../img/SNCP.PNG" width="144" height="57" /></div></td>
                      </tr>
                    </table>
                  <br>				
			            </div>
                </td>
              </tr>
            </table>
            <!--- FIN ENCABEZADO DE FICHA -->

            <!--- UBICACIÓN DEL PREDIO CATASTRAL -->
            <table width="960px" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
		          <tr>
                <td>
				          <table width="960px" border="0" align="center" cellpadding="0" cellspacing="0" class="tabla">
                    <tr>
                      <td class="etiquetanegra" colspan="6" height="30">&nbsp;<strong>UBICACIÓN DEL PREDIO CATASTRAL:</strong></td>
                    </tr>

                    <tr>
                      <td colspan="6" valign="top" align="center">
                        <table width="940px" border="1" cellpadding="0" cellspacing="0" class="tabla">
                          <thead>
                            <tr class="principal" >
                              <th width="20"><div align="center"><img src="../img/casilla_roja/7.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></th>
                              <th width="51">CÓDIGO DE VIA</th>
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
                              <th width="128" colspan="2" class="link">ACCI&Oacute;N </th>
                            </tr>
                            <tr>
                              <th class="celda" align="left" colspan="16">
                                <div id="linea1_0" style="width:940px" >
                                  <input name="upc_cod-0" type="text" class="input" id="upc_cod-0" style="width:75px"  onChange="pulsar_via(this)" maxlength="6"/>
                                  <input class="input"  id="upc_tipo-0" name="upc_tipo-0" type="text" readonly style="width:70px"/>
                                  <input class="input" id="upc_nom-0" name="upc_nom-0" type="text"  readonly="readonly" style="width:265px"/>
                                  <?php generaCombo(25); ?>
                                  <input name="upc_num-0" type="text" class="input" id="upc_num-0" style="width:85px" onKeyPress="return validar_alfanumerico(event)" maxlength="20"/>
                                  <?php generaCombo(36); ?>
                                  <input name="upc_certi-0" type="text" class="input" id="upc_certi-0" style="width:100px" onKeyPress="return validar_numeros(event)" maxlength="10"/>
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="bt_plus" id="1" type="button" value="+" />
                                </div>
                              </th>
                            </tr>
                          </thead>
                        </table><br/>
                      </td>
                    </tr>
                    
                    <tr>
                      <td width="29" class="etiqueta" height="24">&nbsp;&nbsp;<img src="../img/casilla_azul/14.png" alt="Guardar estado?" width="17" height="16" border="0" /></td>
                      <td width="172" class="etiqueta">NOMBRE DE LA EDIFICACI&Oacute;N</td>
                      <td width="273"><input name="upc_nomedi" type="text" class="casillaLarga" value="" size="40" id="upc_nomedi" onKeyPress="return letras(event)" onKeyUp="validar_todo_mayus(this)"/></td>
                      <td width="25" class="etiqueta" height="24"><div align="center"><img src="../img/casilla_azul/15.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td width="180" class="etiqueta">TIPO DE EDIFICACI&Oacute;N</td>
                      <td width="281"><span class="etiqueta"><?php generaCombo(1); ?></span></td>
                    </tr>

                    <tr>
                      <td height="24" class="etiqueta">&nbsp;&nbsp;<img src="../img/casilla_azul/16.png" alt="Guardar estado?" width="17" height="16" border="0" /></td>
                      <td height="24" class="etiqueta">TIPO DE INTERIOR</td>
                      <td><?php generaCombo(2); ?></td>
                      <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/17.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td height="24" class="etiqueta">N&Uacute;MERO DE INTERIOR</td>
                      <td><input type="text" class="casilla" name="upc_numint" value="" size="4" maxlength="4" id="upc_numint" onKeyPress="return validar_numeros(event)"/></td>
                    </tr>

                    <tr>
                      <td height="24" class="etiqueta">&nbsp;&nbsp;<img src="../img/casilla_roja/18.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
                      <td height="24" class="etiqueta">C&OacuteDIGO H.U.</td>
                      <td><input name="upc_codhu" type="text" id="upc_codhu" onKeyPress="return validar_numeros(event)" size="4" maxlength="4" onChange="trae_HU1(this)"></td>
                      <td><div align="center"><img src="../img/casilla_azul/19.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                      <td>NOMBRE DE LA H.U.</td>
                      <td><input name="upc_nomhu" type="text" size="40" id="upc_nomhu" readonly></td>
                    </tr>

                    <tr>
                      <td height="24" class="etiqueta">&nbsp;&nbsp;<img src="../img/casilla_azul/20.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
                      <td height="24" class="etiqueta">ZONA/SECTOR/ETAPA</td>
                      <td><input name="upc_zse" type="text" size="32" id="upc_zse" onKeyPress="return letras(event)" <?php echo $M;?>></td>
					            <td><div align="center"><span class="etiqueta"><img src="../img/casilla_azul/21.png" alt="Guardar estado?" width="17" height="17" border="0" /></span></div></td>
                      <td><span class="etiqueta">MANZANA</span></td>
                      <td><input name="upc_mzna" type="text" size="4" maxlength="15" id="upc_mzna" <?php echo $M;?>></td>
                    </tr>      

                    <tr>
                      <td height="24" class="etiqueta">&nbsp;&nbsp;<img src="../img/casilla_azul/22.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
                      <td height="24" class="etiqueta">LOTE</td>
                      <td><input type="text" class="casilla" name="upc_lote" value="" size="4" maxlength="5" id="upc_lote" <?php echo $M;?>/></td>
                      <td><div align="center"><span class="etiqueta"><img src="../img/casilla_azul/23.png" alt="Guardar estado?" width="17" height="17" border="0" /></span></div></td>
                      <td><span class="etiqueta">SUB-LOTE</span></td>
                      <td><input type="text" class="casilla" name="upc_sublote"  value="" size="4" maxlength="4" id="upc_sublote" <?php echo $M;?> /></td>
                    </tr>

                    <tr><td colspan="2">&nbsp;</td></tr>
				          </table>
                </td>
		          </tr>
		        </table>
            <br>
            <!--- FIN UBICACIÓN DEL PREDIO CATASTRAL -->
            
            <!--- IDENTIFICACIÓN DEL TITULAR -->
		        <table width="960px" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
              <tr>
				        <td>
				          <table width="950PX" border="0" align="center" cellpadding="0" cellspacing="0" class="tabla">
                    <tr>
                      <td class="etiquetanegra" colspan="4" height="30">&nbsp;<strong>IDENTIFICACI&Oacute;N DEL TITULAR CATASTRAL:</strong></td>
                    </tr>
                      
                    <tr id="personanatural"></tr>

                      <td colspan="4">
                  	    <!-- "OCULTAMOS O VISUALIZAMOS SEGUN COTITULARIDAD"-->
    	                  <table  id="oculta" width="100%" align="center" cellpadding="0" cellspacing="0" class="tabla">
                          <tr>
                            <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_roja/24.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                            <td height="24" class="etiqueta">TIPO DE TITULAR</td>
                            <td width="281"><?php generaCombo(3); ?></td>
                            <td width="29" height="24" class="etiqueta"><div align="center"><img src="../img/casilla_roja/25.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                            <td width="167" height="24" class="etiqueta">ESTADO CIVIL</td>
                            <td><?php generaCombo(5); ?></td>
    		                  </tr>
                        
                          <tr>
                            <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_roja/26.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                            <td height="24" class="etiqueta"><em>TIPO DOC. IDENTIDAD</em></td>
                            <td width="281"><?php generaCombo(4); ?></td>
    			                  <td width="29" height="24" class="etiqueta"><div align="center"><img src="../img/casilla_roja/27.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                            <td width="167" height="24" class="etiqueta"><em>N&Uacute;MERO DE DOCUMENTO</em></td>
                            <td width="289"><span class="etiqueta"><input type="text" class="casilla" name="itc_numdoc1" id="itc_numdoc1" size="9" onKeyPress="return validar_numeros(event)" disabled='true'/></span></td>
                          </tr>

                          <tr>
                            <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_roja/28.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                            <td height="24" class="etiqueta"><em>NOMBRES</em></td>
                            <td height="24" class="etiqueta">
                              <input name="itc_nombre1" type="text" class="casillaLarga"value="" size="32" id="itc_nombre1" onKeyPress="return letras(event)" onKeyUp="validar_todo_mayus(this)" disabled='true'/>
                            </td>
                            <td height="24" colspan="2" class="etiqueta">&nbsp;</td>
                            <td height="24" class="etiqueta">&nbsp;</td>
    		                  </tr>

                          <tr>
                            <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_roja/29.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                            <td height="24" class="etiqueta"><em>APELLIDO PATERNO</em></td>
                            <td height="24" class="etiqueta"><input type="text" class="casilla" name="itc_paterno1" value="" size="32" id="itc_paterno1" onKeyPress="return letras(event)" onKeyUp="validar_todo_mayus(this)" disabled='true'/></td>
                            <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_roja/30.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                            <td height="24" class="etiqueta"><em><em>APELLIDO MATERNO</em></em></td>
                            <td height="24" class="etiqueta"><input type="text" class="casilla" name="itc_materno1" value="" size="40" id="itc_materno1" onKeyPress="return letras(event)" onKeyUp="validar_todo_mayus(this)" disabled='true'/></td>
                          </tr>

                          <tr><td>&nbsp;</td></tr>

                          <tr>
                            <td height="15" class="etiqueta">&nbsp;</td>
                            <td height="15" class="etiqueta"><strong>DATOS DEL C&Oacute;NYUGE</strong></td>
                            <td height="15" class="etiqueta">&nbsp;</td>
                            <td height="15" class="etiqueta">&nbsp;</td>
                            <td height="15" class="etiqueta">&nbsp;</td>
                            <td height="15" class="etiqueta">&nbsp;</td>
                          </tr>

                          <tr><td>&nbsp;</td></tr>

                          <tr>
                            <td width="26" height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/26.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                            <td width="156" class="etiqueta"><em>TIPO DOC. IDENTIDAD</em></td>
                            <td><?php generaCombo(24); ?></td>
                            <td height="24" class="etiqueta"><div align="center"><em><img src="../img/casilla_azul/27.png" alt="Guardar estado?" width="17" height="17" border="0" /></em></div></td>
                            <td class="etiqueta"><em>N&Uacute;MERO DE DOCUMENTO</em></td>
                            <td><input type="text" class="casilla" name="itc_numdoc2" id="itc_numdoc2" value="" size="9" onKeyPress="return validar_numeros(event)" disabled='true'/></td>
                          </tr>

                          <tr>
                            <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/28.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                            <td height="24" class="etiqueta"><em>NOMBRES</em></td>
                            <td class="etiqueta"><input name="itc_nombre2" type="text" class="casillaLarga" value="" size="32" id="itc_nombre2" onKeyPress="return letras(event)" onKeyUp="validar_todo_mayus(this)" disabled='true'/></td>
                            <td height="24" colspan="2" class="etiqueta">&nbsp;</td>
                            <td>&nbsp;</td>
    		                  </tr>

                          <tr>
                            <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/29.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                            <td height="24" class="etiqueta"><em>APELLIDO PATERNO</em></td>
                            <td>
                              <span class="etiqueta">
                                <input type="text" class="casilla" name="itc_paterno2" value="" size="32" id="itc_paterno2" onKeyPress="return letras(event)" onKeyUp="validar_todo_mayus(this)" disabled='true'/>
                              </span>
                            </td>
                            <td height="24" class="etiqueta"><div align="center"><em><img src="../img/casilla_azul/30.png" alt="Guardar estado?" width="17" height="17" border="0" /></em></div></td>
                            <td height="24" class="etiqueta"><em>APELLIDO MATERNO</em></td>
                            <td>
                              <span class="etiqueta">
                                <input type="text" class="casilla" name="itc_materno2" value="" size="40" id="itc_materno2" onKeyPress="return letras(event)" onKeyUp="validar_todo_mayus(this)" disabled='true'/>
                              </span>
                            </td>
                          </tr>

                          <tr>
                            <td height="24" colspan="6" class="etiqueta">&nbsp;</td>
                          </tr>

                          <tr>
                            <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_roja/31.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                            <td height="24" class="etiqueta">N&Uacute;MERO DE RUC</td>
                            <td><input type="text" class="casilla" name="itc_ruc" value="" size="11" maxlength="11" id="itc_ruc" onKeyPress="return validar_numeros(event)" disabled='true'/></td>
                            <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_roja/32.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                            <td height="24" class="etiqueta">RAZON SOCIAL</td>
                            <td><input name="itc_razsocial" type="text" class="casillaLarga" value="" size="40" id="itc_razsocial" onKeyUp="validar_todo_mayus(this)" disabled='true'/></td>
                          </tr>

                          <tr>
                            <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_roja/33.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                            <td height="24" class="etiqueta">PERSONA JUR&Iacute;DICA</td>
                            <td><?php generaCombo(6); ?></td>
                            <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/34.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                            <td height="24" class="etiqueta">COND. ESP. DEL TITULAR</td>
                            <td><?php generaCombo(7); ?></td>
                          </tr>

                          <tr>
                            <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/35.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                            <td height="24" class="etiqueta">Nº RESOL. EXONERACION</td>
                            <td><input type="text" class="casillaFecha" name="itc_numresexo" value="" size="9" maxlength="10" id="itc_numresexo" onKeyUp="validar_todo_mayus(this)" disabled='true'/></td>
                            <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/36.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                            <td height="24" class="etiqueta">Nº BOL. PENSIONISTA</td>
                            <td><input type="text" class="casillaFecha" name="itc_numbolpen" value="" size="9" maxlength="10" id="itc_numbolpen" onKeyUp="validar_todo_mayus(this)" disabled='true'/></td>
                          </tr>

                          <tr>
                            <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/37.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                            <td height="24" class="etiqueta">INICIO EXONERACION</td>
                            <td><input name="itc_fechainiexo" type="text" id="itc_fechainiexo"value="" size="15" maxlength="10" <?php echo $VF;?> disabled='true'/>
                            <img src="../img/calendarIcon.gif" onClick="popUpCalendar(this, itc_fechainiexo, &quot;dd/mm/yyyy&quot;)" style="cursor:pointer" width="16" height="16" border="0" title="Ingresar Fecha"/></td>
                            <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/38.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                            <td height="24" class="etiqueta">FIN EXONERACION</td>
                            <td><input name="itc_fechafinexo" type="text" id="itc_fechafinexo"value="" size="15" maxlength="10" <?php echo $VF;?> disabled='true'/>
                            <img src="../img/calendarIcon.gif" onClick="popUpCalendar(this, itc_fechafinexo, &quot;dd/mm/yyyy&quot;)" style="cursor:pointer" width="16" height="16" border="0" title="Ingresar Fecha"/></td>
                          </tr>
    	                  </table><br>
                      </td>
						        
                    <tr id="personajuridica"></tr>
		              </table>
			          </td>
			        </tr>
		        </table>
            <!--- FIN IDENTIFICACIÓN DEL TITULAR -->
            
		        <table width="980px0" align="center" cellPadding="0" cellSpacing="0" class="clsTabla2">
              <tr>
                <td>              </td>
              </tr>
            </table><br>
		
            <!--- DOMICILIO FISCAL DEL TITULAR -->
            <table width="960px" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
              <tr>
                <td>
                  <table width="950px" border="0" align="center" cellpadding="0" cellspacing="0" class="tabla">
                    <tr>
                      <td class="etiquetanegra" colspan="6" height="30">&nbsp;<strong>DOMICILIO FISCAL DEL TITULAR CATASTRAL: </strong></td>
                    </tr>

                    <tr>
                      <td width="26" class="etiqueta" height="24"><div align="center"><img src="../img/casilla_roja/39.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                      <td width="157" class="etiqueta">DEPARTAMENTO</td>
                      <td width="282"><?php generaDepartamento(); ?></td>
                      <td width="23"><div align="center"><img src="../img/casilla_roja/40.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                      <td width="200"><span class="etiqueta">PROVINCIA</span></td>
                      <td width="262">
                        <div>
                          <label>
            								<select class="select" disabled="disabled" name="provincias" id="provincias" onChange='cargaContenido2(this.id)'>
            					       <?php //  <option value="0">Selecciona opci&oacute;n...</option>?>
            								</select>
                          </label>
          						  </div>                           
                      </td>
                    </tr>

                    <tr>
                      <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_roja/41.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                      <td height="24" class="etiqueta">DISTRITO</td>
                      <td colspan="4">
                        <div >
                          <label>
            								<select disabled="disabled" name="distritos" id="distritos">
            					      <?php //  <option value="0">Selecciona opci&oacute;n...</option>?>
            								</select>
                          </label>
            						</div>
                      </td>
                    </tr> 

                    <tr>
                      <td width="26" height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/42.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                      <td width="157" height="24" class="etiqueta">TEL&Eacute;FONO</td>
                      <td width="282"><input type="text" class="casilla" name="dftc_telf" value="" size="10" maxlength="12" id="dftc_telf" onKeyUp="validar_todo_mayus(this)"/></td>
                      <td width="23" height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/43.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                      <td width="200" height="24" class="etiqueta">ANEXO</td>
                      <td><input type="text" class="casilla" name="dftc_anexo" value="" size="2" maxlength="8" id="dftc_anexo" onKeyUp="validar_todo_mayus(this)"/></td>
                    </tr>

                    <tr>
                      <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/44.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                      <td height="24" class="etiqueta">FAX</td>
                      <td><input type="text" class="casilla" name="dftc_fax" value="" size="10" maxlength="12" id="dftc_fax" /></td>
                      <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/45.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                      <td height="24" class="etiqueta">CORREO ELECTR&Oacute;NICO</td>
                      <td><input name="dftc_email" type="text" class="casillaLarga" id="dftc_email" value="" size="40" onKeyUp="EmailCheck(this)"/></td>
                    </tr>

                    <tr>
                      <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/7.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                      <td height="24" class="etiqueta">C&Oacute;DIGO DE V&Iacute;A</td>
                      <td><input type="text" class="casilla" name="dftc_codvia" value="" size="5" maxlength="6" id="dftc_codvia" onChange="trae_via(this)"/></td>
                      <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/8.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                      <td height="24" class="etiqueta">TIPO DE V&Iacute;A</td>
                      <td><input class="input"  id="dftc_tipovia" name="dftc_tipovia" type="text" size="5" readonly/></td>
                    </tr>

                    <tr>
                      <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/9.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                      <td height="24" class="etiqueta">NOMBRE DE V&Iacute;A</td>
                      <td><input name="dftc_nomvia" type="text" class="casillaLarga"value="" size="32" id="dftc_nomvia" readonly/></td>
                      <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/11.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                      <td height="24" class="etiqueta">N&Uacute;MERO MUNICIPAL</td>
                      <td><input type="text" class="casilla" name="dftc_nummuni" value="" size="5" maxlength="6" id="dftc_nummuni"/> </td>
                    </tr>

                    <tr>
                      <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/14.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                      <td height="24" class="etiqueta">NOMBRE DE EDIFICACI&Oacute;N</td>
                      <td><input name="dftc_nomedi" type="text" class="casillaLarga" id="dftc_nomedi" value="" size="32" <?php echo $M;?>/> </td>
                      <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/17.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                      <td height="24" class="etiqueta">N&Uacute;MERO INTERIOR</td>
                      <td><input type="text" class="casilla" name="dftc_numint" value="" size="2" maxlength="4" id="dftc_numint"/>  </td>
                    </tr>

                    <tr>
                      <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/18.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                      <td height="24" class="etiqueta">C&Oacute;DIGO H.U.</td>
                      <td><input type="text" class="casilla" name="dftc_codhu" value="" size="2" maxlength="4" id="dftc_codhu" onChange="trae_HU2(this)"/></td>
                      <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/19.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                      <td height="24" class="etiqueta">NOMBRE DE LA H.U.</td>
                      <td><input name="dftc_nomhu" type="text" class="casillaLarga"value="" size="40" id="dftc_nomhu" readonly/></td>
                    </tr>

                    <tr>
                      <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/20.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                      <td height="24" class="etiqueta">ZONA/SECTOR/ETAPA</td>
                      <td><input type="text" class="casilla" name="dftc_zse" value="" size="20" maxlength="20" id="dftc_zse" <?php echo $M;?>/> </td>
                      <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/21.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                      <td height="24" class="etiqueta">MANZANA</td>
                      <td><input type="text" class="casilla" name="dftc_mzna" value="" size="2" maxlength="3" id="dftc_mzna" <?php echo $M;?>/></td>
                    </tr>

                    <tr>
                      <td height="26" class="etiqueta"><div align="center"><img src="../img/casilla_azul/22.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                      <td height="26" class="etiqueta">LOTE</td>
                      <td><input type="text" class="casilla" name="dftc_lote" value="" size="2" maxlength="5" id="dftc_lote"/></td>
                      <td height="26" class="etiqueta"><div align="center"><img src="../img/casilla_azul/23.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                      <td height="26" class="etiqueta">SUB-LOTE</td>
                      <td><input type="text" class="casilla" name="dftc_sublote" value="" size="2" maxlength="6" id="dftc_sublote" <?php echo $M;?>/></td>
                    </tr>
                  </table><br>	        
                </td>
              </tr>
            </table><br>
            <!--- FIN DOMICILIO FISCAL DEL TITULAR -->

			      <table width="960px" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
              <tr>
                <td>
                  <table width="950px" border="0" align="center" cellpadding="0" cellspacing="0" class="tabla">
                    <tr>
                      <td class="etiquetanegra" colspan="6" height="30">&nbsp;<strong>CARACTER&Iacute;STICAS DE LA TITULARIDAD: </strong></td>
                    </tr>

                    <tr>
                      <td width="3%" class="etiqueta" height="24"><div align="center"><img src="../img/casilla_roja/46.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                      <td width="17%" class="etiqueta">CONDICI&Oacute;N DEL TITULAR</td>
                      <td width="29%"><?php generaCombo(9); ?></td>
                      <td width="3%" class="etiqueta" height="24"><div align="center"><img src="../img/casilla_azul/47.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                      <td width="18%" class="etiqueta">FORMA DE ADQUISICI&Oacute;N</td>
                      <td width="30%"><?php generaCombo(10); ?></td>
                    </tr>

                    <tr>
                      <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/48.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                      <td height="24" class="etiqueta">FECHA DE ADQUISICI&Oacute;N</td>
                      <td><input name="ct_fechaadq" type="text" class="casillaFecha" id="ct_fechaadq" value="" size="15" maxlength="10" <?php echo $VF;?>/> &nbsp;<img src="../img/calendarIcon.gif" onClick="popUpCalendar(this, ct_fechaadq, &quot;dd/mm/yyyy&quot;)" style="cursor:pointer" width="16" height="16" border="0" title="Ingresar Fecha"/></td>
                      <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/49.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                      <td height="24" class="etiqueta">COND. ESP. DEL PREDIO</td>
                      <td><?php generaCombo(11); ?></td>
                    </tr>

                    <tr>
                      <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/50.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                      <td height="24" class="etiqueta">Nº RESOL. EXONERACION</td>
                      <td><input type="text" class="casilla" name="ct_numresexo" value="" size="20" maxlength="20" id="ct_numresexo"/></td>
                      <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/51.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                      <td height="24" class="etiqueta">PORCENTAJE</td>
                      <td><input type="text" class="casilla" name="ct_porcentaje" value="" size="3" maxlength="3" id="ct_porcentaje" <?php echo $N;?>/></td>
                    </tr>

                    <tr>
                      <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/52.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                      <td height="24" class="etiqueta">FECHA DE INICIO</td>
                      <td><input name="ct_fechaini" type="text" class="casillaFecha" id="ct_fechaini" value="" size="15" maxlength="10" <?php echo $VF;?>/>
                        &nbsp;<img src="../img/calendarIcon.gif" onClick="popUpCalendar(this, ct_fechaini, &quot;dd/mm/yyyy&quot;)" style="cursor:pointer" width="16" height="16" border="0" title="Ingresar Fecha"/></td>
                      <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/53.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                      <td height="24" class="etiqueta">FECHA DE VENCIMIENTO</td>
                      <td><input name="ct_fechafin" type="text" class="casillaFecha" id="ct_fechafin" value="" size="15" maxlength="10" <?php echo $VF;?>/>
                        &nbsp;<img src="../img/calendarIcon.gif" onClick="popUpCalendar(this, ct_fechafin, &quot;dd/mm/yyyy&quot;)" style="cursor:pointer" width="16" height="16" border="0" title="Ingresar Fecha"/></td>
                    </tr>
                  </table><br/>
                </td>
              </tr>
            </table>
			      <br>

		        <table width="960px" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
              <tr>
                <td>
                  <table width="950px" border="0" align="center" cellpadding="0" cellspacing="0" class="tabla">
                    <tr>
                        <td class="etiquetanegra" colspan="9" height="30">&nbsp;<strong>DESCRIPCI&Oacute;N DEL PREDIO: </strong></td>
                    </tr>

                    <tr>
                      <td width="3%" class="etiqueta" height="24"><div align="center"><img src="../img/casilla_roja/54.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                      <td colspan="3" class="etiqueta">CLASIFICACI&Oacute;N DEL PREDIO</td>
                      <td width="25%"><?php generaCombo(12); ?></td>
                      <td width="3%"><div align="center"><img src="../img/casilla_roja/55.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                      <td width="16%"><span class="etiqueta">PREDIO CATASTRAL EN</span></td>
                      <td colspan="2"><?php generaCombo(13); ?></td>
                    </tr>
                    
                    <tr>
                      <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_roja/56.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                      <td width="11%" height="24" class="etiqueta">C&Oacute;D. DE USO</td>
                      <td width="3%" class="etiqueta"><img src="../img/casilla_azul/57.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
                      <td height="24" colspan="6" class="etiqueta"><span class="etiqueta">USO PREDIO CATASTRAL (DESCRIPCI&Oacute;N)</span></td>
                    </tr>

                    <tr>
                      <td height="24" class="etiqueta">&nbsp;</td>
                      <td height="24" colspan="8" class="etiqueta"><?php generaCombo(14); ?></td>
                    </tr>

                    <tr>
                      <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/58.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                      <td height="24" colspan="3" class="etiqueta">ESTRUCTURACI&Oacute;N</td>
                      <td><input name="dp_estructura" type="text" class="casillaLarga" id="dp_estructura" maxlength="30" <?php echo $M;?>/> </td>
                      <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/59.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                      <td height="24" class="etiqueta">ZONIFICACI&Oacute;N</td>
                      <td width="3%" height="24" class="etiqueta">&nbsp;</td>
                      <td width="26%"><input type="text" class="casillaLarga" name="dp_zonifica" value="" maxlength="30" id="dp_zonifica" <?php echo $M;?>/></td>
                    </tr>

                    <tr>
                      <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/60.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                      <td height="24" colspan="3" class="etiqueta">&Aacute;REA TERRENO T&Iacute;TULO</td>
                      <td><input type="text" class="casillaFecha" name="dp_areatitulo" value="" maxlength="10" id="dp_areatitulo" <?php echo $N;?>/> &nbsp;(M2)</td>
                      <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/61.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                      <td height="24" class="etiqueta">&Aacute;REA TERRENO DECLARADA</td>
                      <td height="24" class="etiqueta">&nbsp;</td>
                      <td><input type="text" class="casillaFecha" name="dp_areadeclara" value="" maxlength="10" id="dp_areadeclara" <?php echo $N;?>/>nbsp;(M2)</td>
                    </tr>

                    <tr>
                      <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/62.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                      <td height="24" colspan="3" class="etiqueta">&Aacute;REA TERRENO VERIFICADA</td>
                      <td colspan="5"><input type="text" class="casillaFecha" name="dp_areaverifica" maxlength="10" id="dp_areaverifica" <?php echo $N;?>/> &nbsp;(M2)</td>
                    </tr>

                    <tr>
                      <td colspan="5">&nbsp;</td>
                    </tr>

                    <tr>
                      <td colspan="9" valign="top">
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
                              <td colspan="2" align="center"><input type="text" class="casillaDatos" name="dp_medcam_fre"value="" maxlength="50" id="dp_medcam_fre" <?php echo $Ncoma;?>/> </td>
                              <td colspan="2" align="center"><input type="text" class="casillaDatos" name="dp_medsegtitu_fre"value="" maxlength="50" id="dp_medsegtitu_fre" <?php echo $Ncoma;?>/></td>
                              <td colspan="2" align="center"><input type="text" class="casillaDatos" name="dp_colcam_fre"value="" maxlength="50" id="dp_colcam_fre" <?php echo $M;?>/>  </td>
                              <td colspan="2" align="center"><input type="text" class="casillaDatos" name="dp_colsegtitu_fre" value="" maxlength="50" id="dp_colsegtitu_fre" <?php echo $M;?>/> </td>
                            </tr>

                            <tr class="normal">
                              <td class="principal"><b>&nbsp;&nbsp;&nbsp;</b>DERECHA</td>
                              <td colspan="2" align="center"><input type="text" class="casillaDatos" name="dp_medcam_der" value="" maxlength="50" id="dp_medcam_der" <?php echo $Ncoma;?>/> </td>
                              <td colspan="2" align="center"><input type="text" class="casillaDatos" name="dp_medsegtitu_der" value="" maxlength="50" id="dp_medsegtitu_der" <?php echo $Ncoma;?>/></td>
                              <td colspan="2" align="center"><input type="text" class="casillaDatos" name="dp_colcam_der" value="" maxlength="50" id="dp_colcam_der" <?php echo $M;?>/> </td>
                              <td colspan="2" align="center"><input type="text" class="casillaDatos" name="dp_colsegtitu_der" value="" maxlength="50" id="dp_colsegtitu_der" <?php echo $M;?>/> </td>
                            </tr>

                            <tr class="normal">
                              <td class="principal"><b>&nbsp;&nbsp;&nbsp;</b>IZQUIERDA</td>
                              <td colspan="2" align="center"><input type="text" class="casillaDatos" name="dp_medcam_izq" value="" maxlength="50" id="dp_medcam_izq" <?php echo $Ncoma;?>/> </td>
                              <td colspan="2" align="center"><input type="text" class="casillaDatos" name="dp_medsegtitu_izq"  value="" maxlength="50" id="dp_medsegtitu_izq" <?php echo $Ncoma;?>/> </td>
                              <td colspan="2" align="center"><input type="text" class="casillaDatos" name="dp_colcam_izq" value="" maxlength="50" id="dp_colcam_izq" <?php echo $M;?>/> </td>
                              <td colspan="2" align="center"><input type="text" class="casillaDatos" name="dp_colsegtitu_izq" value="" maxlength="50" id="dp_colsegtitu_izq" <?php echo $M;?>/> </td>
                            </tr>

                            <tr class="normal">
                              <td class="principal"><b>&nbsp;&nbsp;&nbsp;</b>FONDO</td>
                              <td colspan="2" align="center"><input type="text" class="casillaDatos" name="dp_medcam_fon" value="" maxlength="50" id="dp_medcam_fon" <?php echo $Ncoma;?>/> </td>
                              <td colspan="2" align="center"><input type="text" class="casillaDatos" name="dp_medsegtitu_fon" value="" maxlength="50" id="dp_medsegtitu_fon" <?php echo $Ncoma;?>/></td>
                              <td colspan="2" align="center"><input type="text" class="casillaDatos" name="dp_colcam_fon" value="" maxlength="50" id="dp_colcam_fon" <?php echo $M;?>/></td>
                              <td colspan="2" align="center"><input type="text" class="casillaDatos" name="dp_colsegtitu_fon" value="" maxlength="50" id="dp_colsegtitu_fon" <?php echo $M;?>/>  </td>
                            </tr>
                          </tbody>
                        </table>                            
                      </td>
                    </tr>
                  </table><br>
                </td>
              </tr>
            </table><br>
            
            <!--  SERVICIOS BÁSICOS  -->
		        <table width="960px" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
              <tr>
                <td>
	                <table width="950px" border="0" align="center" cellpadding="0" cellspacing="0" class="tabla">
                    <tr>
                      <td class="etiquetanegra" colspan="6" height="30">&nbsp;<strong>SERVICIOS B&Aacute;SICOS:</strong></td>
                    </tr>

                    <tr>
                      <td width="95" class="etiqueta" height="24"><div align="center"><img src="../img/casilla_azul/67.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                      <td width="95" class="etiqueta">LUZ</td>
                      <td width="268"><input name="sb_luz" type="checkbox" id="sb_luz" value="1"></td>
                      <td width="36" class="etiqueta" height="24"><div align="center"><img src="../img/casilla_azul/68.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                      <td width="170" class="etiqueta">AGUA</td>
                      <td width="286"><span class="etiqueta"><input name="sb_agua" type="checkbox" id="sb_agua" value="1" /></span></td>
                    </tr>

                    <tr>
                      <td width="95" height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/69.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                      <td width="95" height="24" class="etiqueta">TEL&Eacute;FONO</td>
                      <td width="268"><span class="etiqueta"><input name="sb_telefono" type="checkbox" id="sb_telefono" value="1"/></span></td>
                      <td width="36" height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/70.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                      <td width="170" height="24" class="etiqueta">DESAGÜE</td>
                      <td><input name="sb_desague" type="checkbox" id="sb_desague" value="1"/></td>
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
                  </table><br>	
                </td>
              </tr>
            </table>

		        <table width="980px" align="center" cellPadding="0" cellSpacing="0" class="clsTabla2">
              <tr>
                <td>              </td>
              </tr>
            </table>
			       <br>

            <!--  CONSTRUCCIONES  -->
		        <table width="970px" border="1" align="center" cellPadding="0" cellSpacing="0" bordercolor="#000000" >
              <tr>
                <td>
                  <table width="950px" border="0" align="center" cellpadding="0" cellspacing="0" class="tabla">
                    <tr>
                      <td class="etiquetanegra" colspan="2" height="30">&nbsp;<strong>CONSTRUCCIONES: </strong></td>
                    </tr>

                    <tr>
                      <td colspan="2" valign="top">
                        <table id="construccion" width="950px" border="1" align="center" cellpadding="0" cellspacing="0" class="tabla">
                          <thead>
                            <tr>
                              <th width="7%" rowspan="2" scope="col"><p><img src="../img/casilla_azul/74.png" alt="Guardar estado?" width="17" height="16" border="0" /></p></th>
                              <th width="9%" rowspan="2" scope="col"><p><img src="../img/casilla_azul/75.png" alt="Guardar estado?" width="17" height="16" border="0" /></p></th>
                              <th width="5%" rowspan="2" scope="col"><img src="../img/casilla_azul/76.png" alt="Guardar estado?" width="17" height="16" border="0" /></th>
                              <th width="5%" rowspan="2" scope="col"><img src="../img/casilla_azul/77.png" alt="Guardar estado?" width="17" height="16" border="0" /></th>
                              <th width="5%" rowspan="2" scope="col"><img src="../img/casilla_azul/78.png" alt="Guardar estado?" width="17" height="16" border="0" /></th>
                              <th colspan="7" scope="col"><span class="Estilo9">CATEGOR&Iacute;AS</span></th>
                              <th colspan="2" scope="col"><span class="Estilo9">AREA CONSTRU&Iacute;DA (M2)</span></th>
                              <th width="4%" rowspan="3" scope="col"><img src="../img/casilla_azul/88.png" alt="Guardar estado?" width="17" height="16" border="0" /></th>
                              <th width="4%" colspan="2" rowspan="4" class="link" scope="col">ACCI&Oacute;N</th>
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
                              <th class="celda" align="left" colspan="17" scope="col">
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
                                  <input  class="input" name="c_d-0" type="text" id="c_d-0" style="width:65px" />
                                  <input  class="input" name="c_v-0" type="text" id="c_v-0" style="width:65px" />
                                  <?php generaCombo(29); ?>
                                  <input class="bt_plus2" id="1" type="button" value="+" />
                                </div>
                              </th>
                            </tr>
                          </thead>
                                    
                          <tbody>
                          </tbody>                                    
                        </table>                          
                      </td>
                    </tr>

						        <tr>
                      <td colspan="5">                            </td>
                    </tr>

                    <tr>
                      <td class="etiqueta" colspan="2">&nbsp;</td>
                    </tr>

                    <tr>
                      <td width="48" height="24" class="etiquetanegra"><div align="center"><img src="../img/casilla_azul/89.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td width="902" height="24" class="etiquetanegra"><strong>PORCENTAJE DE BIEN COM&Uacute;N</strong></td>
                    </tr>

                    <tr>
                      <td colspan="2">
                        <table width="99%" cellpadding="0" cellspacing="0" class="tabla">
                          <tr>
                            <td width="20%" height="24" class="etiqueta">&nbsp;&nbsp;&nbsp;TERRENO LEGAL</td>
                            <td width="25%"><input type="text" class="casilla" name="c_terreleg" value="" size="5" maxlength="5" id="c_terreleg" <?php echo $N;?>/></td>
                            <td width="25%" class="etiqueta">TERRENO F&Iacute;SICO</td>
                            <td class="tabla"><input type="text" class="casilla" name="c_terrfis"  value="" size="5" maxlength="5" id="c_terrfis" <?php echo $N;?>/> </td>
                          </tr>

                          <tr>
                            <td height="24" class="etiqueta">&nbsp;&nbsp;&nbsp;CONSTRUCCI&Oacute;N LEGAL</td>
                            <td width="320"><input type="text" class="casilla" name="c_consleg"  value="" size="5" maxlength="5" id="c_consleg" <?php echo $N;?>/>                                        </td>
                            <td width="155" class="etiqueta">CONSTRUCCI&Oacute;N F&Iacute;SICA</td>
                            <td class="tabla"><input type="text" class="casilla" name="c_consfis"  value="" size="5" maxlength="5" id="c_consfis" <?php echo $N;?>/> </td>
                          </tr>
                        </table> 
                      </td>
                    </tr>
                  </table><br>
                </td>
              </tr>
            </table>
			      <br>

            <!--  INSTALACIONES  -->
            <table width="960px" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
        		  <tr>
  		          <td colspan="4" height="30"><span class="tabla">&nbsp;<strong>OBRAS COMPLEMENTARIAS / OTRAS INSTALACIONES:</strong></span></td>
              </tr>

              <tr>
                <td colspan="4" valign="top">
                  <table width="960px" border="1" align="left" cellpadding="0" cellspacing="0" class="tabla">
                    <tr class="principal">
                      <td width="48" >
                        <div align="center">
                          <img src="../img/casilla_azul/90.png" alt="Guardar estado?" width="17" height="16" border="0" />
                          <!--</th> ***********-->
                                    
                        </div>
                      </td>

                    
                      <td width="250" scope="col"><div align="center"><img src="../img/casilla_azul/91.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td width="102" scope="col"><div align="center"><img src="../img/casilla_azul/75.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td width="55" scope="col"><div align="center"><img src="../img/casilla_azul/76.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td width="55" scope="col"><div align="center"><img src="../img/casilla_azul/77.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td width="51" scope="col"><div align="center"><img src="../img/casilla_azul/78.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td colspan="3" scope="col"><div align="center"><strong>DIMENSIONES VERIFICADAS
                        <!--</th> **************--></strong></div> </td>

                      <td width="68" scope="col"><div align="center"><img src="../img/casilla_azul/95.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td width="52" scope="col"><div align="center"><img src="../img/casilla_azul/96.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
								      <td width="41" scope="col"><div align="center"><img src="../img/casilla_azul/88.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td width="89" colspan="3" rowspan="3" class="link" scope="col"><div align="center"><strong>ACCI&Oacute;N</strong></div></td>
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
                          </div>                            
                        </td>
                      </tr>
                    </tbody>
                  </table> 
		            </td>
              </tr>
            </table>
			       <br>

		        <!--  DOCUMENTOS  -->
            <table width="960px" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
              <tr>
                <td>
	                <table width="960px" border="0" align="center" cellpadding="0" cellspacing="0" class="tabla">
                    <tr>
                      <td class="etiquetanegra" colspan="6" height="30">&nbsp;<strong>DOCUMENTOS:</strong></td>
                    </tr>

                    <tr>
                      <td colspan="6" valign="top">
                        <table width="960px" border="1" align="center" cellpadding="0" cellspacing="0" class="tabla">
                          <thead>
                            <tr class="principal">
                              <th width="44"><img src="../img/casilla_azul/97.png" alt="Guardar estado?" width="17" height="16" border="0" /></th>
                              <th width="308">TIPO DE DOCUMENTO</th>
                              <th width="25"><img src="../img/casilla_azul/98.png" alt="Guardar estado?" width="17" height="16" border="0" /></th>
                              <th width="101">Nº DE DOCUMENTO</th>
                              <th width="25"><img src="../img/casilla_azul/99.png" alt="Guardar estado?" width="17" height="16" border="0" /></th>
                              <th width="127">FECHA</th>
                              <th width="25"><img src="../img/casilla_azul/100.png" alt="Guardar estado?" width="17" height="16" border="0" /></th>
                              <th width="186">AREA AUTORIZADA</th>
                              <th width="89" colspan="2" class="link">ACCI&Oacute;N</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr class="normal">
                              <td colspan="10" class="celda" align="left">
                                <div id="linea4_0"><?php generaCombo(34); ?>
                                  <input class="input" name="d_nro-0" type="text" maxlength="19" id="d_nro-0" style="width:130px"/>
                                  <input class="input" name="d_fecha-0" type="text" maxlength="10" id="d_fecha-0" <?php echo $VF;?> style="width:155px"/>
                                  <input class="input" name="d_area-0" type="text" maxlength="7" id="d_area-0" style="width:205px" <?php echo $N;?>/>
                                  &nbsp;&nbsp;<input class="bt_plus4" id="12" type="button" value="+" />
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>						    
                      </td>
                    </tr>

                    <tr>
                      <td class="etiqueta" colspan="6">&nbsp;&nbsp;&nbsp;</td>
                    </tr>

                    <tr>
                      <td colspan="6" class="etiquetanegra" height="24">&nbsp;&nbsp;<strong>REGISTRO NOTARIAL DE LA ESCRITURA P&Uacute;BLICA:</strong></td>
                    </tr>

                    <tr>
                      <td width="5%" class="etiqueta" height="24"><div align="center"><img src="../img/casilla_azul/101.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td width="15%" class="etiqueta">NOMBRE DE LA NOTARIA</td>
                      <td colspan="4"><?php generaCombo(15); ?></td>
                    </tr>

                    <tr>
                      <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/102.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td height="24" class="etiqueta">KARDEX</td>
                      <td width="31%"><input type="text" class="casilla" name="d_kardex" value="" maxlength="20" id="d_kardex"/></td>
                      <td width="3%" class="etiqueta" height="24"><div align="center"><img src="../img/casilla_azul/103.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td width="16%" class="etiqueta">FECHA ESCRITURA P&Uacute;BLICA</td>
                      <td width="30%" ><input name="d_fechaescpub" type="text" class="casillaFecha" id="d_fechaescpub" value="" size="15" maxlength="10" <?php echo $VF;?>/>&nbsp;<img src="../img/calendarIcon.gif" onClick="popUpCalendar(this, d_fechaescpub, &quot;dd/mm/yyyy&quot;)" style="cursor:pointer" width="16" height="16" border="0" title="Ingresar Fecha"/></td>
                    </tr>

                    <tr>
                      <td colspan="6">&nbsp;</td>
                    </tr>
                  </table><br>	
                </td>
              </tr>
            </table>
			      <br>

		        <!--  INSCRIPCION DEL PREDIO CATASTRAL EN EL REGISTRO DE PREDIOS  -->
            <table width="960px" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
              <tr>
                <td>
            	    <table width="960px" border="0" align="center" cellpadding="0" cellspacing="0" class="tabla">
                    <tr>
                      <td class="etiquetanegra" colspan="6" height="30">&nbsp;<strong>INSCRIPCI&Oacute;N DEL PREDIO CATASTRAL EN EL REGISTRO DE PREDIOS:</strong></td>
                    </tr>

                    <tr>
                      <td width="5%" class="etiqueta" height="24"><div align="center"><img src="../img/casilla_azul/104.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td width="15%" class="etiqueta">TIPO PARTIDA REGISTRAL</td>
                      <td width="31%"><?php generaCombo(16); ?></td>
                      <td width="3%" class="etiqueta" height="24"><div align="center"><img src="../img/casilla_azul/105.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td width="16%" class="etiqueta">N&Uacute;MERO</td>
                      <td width="30%"><input type="text" class="casilla" name="ipcrp_numpar" value="" maxlength="18" id="ipcrp_numpar"/></td>
                    </tr>

                    <tr>
                      <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/106.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td height="24" class="etiqueta">FOJAS</td>
                      <td><input type="text" class="casilla" name="ipcrp_fojas" value="" maxlength="18" id="ipcrp_fojas"/></td>
                      <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/107.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td height="24" class="etiqueta">ASIENTO</td>
                      <td><input type="text" class="casilla" name="ipcrp_asiento" value="" maxlength="18" id="ipcrp_asiento"/></td>
                    </tr>

                    <tr>
                      <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/108.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td height="24" class="etiqueta">FECHA INSCRIPCI&Oacute;N PREDIO</td>
                      <td><input name="ipcrp_fechains" type="text" class="casillaFecha" id="ipcrp_fechains" value="" size="15" maxlength="10" <?php echo $VF;?>/>
                          &nbsp;<img src="../img/calendarIcon.gif" onClick="popUpCalendar(this, ipcrp_fechains, &quot;dd/mm/yyyy&quot;)" style="cursor:pointer" width="16" height="16" border="0" title="Ingresar Fecha"/></td>
                      <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/109.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td height="24" class="etiqueta">DECLARATORIA DE F&Aacute;BRICA</td>
                      <td><?php generaCombo(17); ?></td>
                    </tr>

                    <tr>
                      <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/110.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td height="24" class="etiqueta">AS. INS. DE F&Aacute;BRICA</td>
                      <td><input type="text" class="casilla" name="ipcrp_asinfab" value="" maxlength="18" id="ipcrp_asinfab"/></td>
                      <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/111.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td height="24" class="etiqueta">FECHA INSCRIPCI&Oacute;N F&Aacute;BRICA</td>
                      <td><input name="ipcrp_fechinsfab" type="text" class="casillaFecha" id="ipcrp_fechinsfab" value="" size="15" maxlength="10" <?php echo $VF;?>/>
                          &nbsp;<img src="../img/calendarIcon.gif" onClick="popUpCalendar(this, ipcrp_fechinsfab, &quot;dd/mm/yyyy&quot;)" style="cursor:pointer" width="16" height="16" border="0" title="Ingresar Fecha"/></td>
                    </tr>

                    <tr>
                      <td colspan="2">&nbsp;</td>
                    </tr>
                  </table><br>	
                </td>
              </tr>
            </table>
			      <br>

		        <!--  EVALUACIÓN DEL PREDIO CATASTRAL  -->
            <table width="960px" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
              <tr>
                <td>
	                <table width="960px" border="0" align="center" cellpadding="0" cellspacing="0" class="tabla">
                    <tr>
                      <td colspan="6" class="etiquetanegra" height="24">&nbsp;<strong>EVALUACI&Oacute;N DEL PREDIO CATASTRAL</strong></td>
                    </tr>

                    <tr>
                      <td width="5%" height="30" class="etiquetanegra"><div align="center"><img src="../img/casilla_azul/112.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td height="30" colspan="4" class="etiquetanegra">&nbsp;EVALUACI&Oacute;N DEL PREDIO CATASTRAL:</td>
                    </tr>

                    <tr>
                      <td colspan="5" class="etiqueta" align="center">
                        <p>
                          <label><input type="radio" name="opt_evalua" value="01" id="opt_evalua_0">
                            PREDIO CATASTRAL OMISO</label>
                          <label><input type="radio" name="opt_evalua" value="02" id="opt_evalua_1">
                            PREDIO CATASTRAL SUBVALUADO</label>
                          <label><input type="radio" name="opt_evalua" value="03" id="opt_evalua_2">
                            PREDIO CATASTARL SOBREVALUADO</label>
                          <label><input type="radio" name="opt_evalua" value="04" id="opt_evalua_3">
                            PREDIO CATASTRAL CONFORME</label>
                        </p>
                      </td>
                    </tr>
                        
                    <tr>
                      <td class="etiquetanegra" height="24"><div align="center"><img src="../img/casilla_azul/113.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td height="24" colspan="4" class="etiquetanegra">&nbsp;&Aacute;REA DE TERRENO INVADIDA (M2):</td>
                    </tr>

                    <tr>
                      <td height="24" class="etiqueta">&nbsp;</td>
                      <td width="24%" height="24" class="etiqueta">&nbsp;EN LOTE COLINDANTE</td>
                      <td width="22%"><input type="text" class="casilla" name="epc_lotcol" value="" size="5" maxlength="7" id="epc_lotcol" <?php echo $M;?>/></td>
                      <td width="19%" class="etiqueta" height="24">EN &Aacute;REA P&Uacute;BLICA</td>
                      <td width="30%"><input type="text" class="casilla" name="epc_areapub" value="" size="5" maxlength="7" id="epc_areapub" <?php echo $M;?>/> </td>
                    </tr>

                    <tr>
                      <td height="24" class="etiqueta">&nbsp;</td>
                      <td height="24" class="etiqueta">&nbsp;EN JARD&Iacute;N DE AISLAMIENTO</td>
                      <td width="22%"><input type="text" class="casilla" name="epc_jarais" value="" size="5" maxlength="7" id="epc_jarais" <?php echo $M;?>/></td>
                      <td width="19%" class="etiqueta" height="24">EN &Aacute;REA INTANGIBLE</td>
                      <td ><input type="text" class="casilla" name="epc_areaint"value="" size="5" maxlength="7" id="epc_areaint" <?php echo $M;?>/> </td>
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
          	      <table width="960px" border="0" align="center" cellpadding="0" cellspacing="0" class="tabla">
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
                      <td height="30" class="etiquetanegra"><div align="center"><img src="../img/casilla_azul/115.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td height="30" colspan="5" class="etiquetanegra">&nbsp;IDENTIFICACI&Oacute;N DE LOS LITIGANTES: </td>
                    </tr>
                    
                    <tr>
                      <td colspan="6" valign="top">
                        <table width="930px" border="1" align="center" cellpadding="0" cellspacing="0" class="tabla">
                          <thead><br>
                            <tr class="principal">
                              <th width="18%">TIPO DE DOCUMENTO</th>
                              <th width="15%">Nº DE DOCUMENTO</th>
                              <th width="36%">APELLIDOS Y NOMBRES DE LOS LITIGANTES</th>
                              <th width="22%">C&Oacute;DIGO DEL CONTRIBUYENTE</th>
                              <th colspan="2" class="link">ACCI&Oacute;N</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr class="normal">
                              <td colspan="6" align="left">
                                <div id="linea5_0">
                                  <?php generaCombo(35); ?>
                                  <input class="input" name="ic_nro-0" type="text"  maxlength="17" id="ic_nro-0" onKeyPress="return validar_numeros(event)" style="width:135px"/>
                                  <input class="input" name="ic_liti-0" type="text" maxlength="100" id="ic_liti-0" onKeyPress="return letras(event)" onKeyUp="validar_todo_mayus(this)" style="width:330px"/>
                                  <input class="input" name="ic_cod-0" type="text" maxlength="18" id="ic_cod-0" onKeyPress="return validar_numeros(event)" style="width:205px"/>
                                  <input class="bt_plus5" id="12" type="button" value="+" />
                                </div>                
                              </td>
                            </tr>
                          </tbody>
                        </table>	     
                      </td>
                    </tr>

                    <tr>
                      <td colspan="6">&nbsp;</td>
                    </tr>

                    <tr>
                      <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_roja/116.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td height="24" class="etiqueta">ESTADO DE LA FICHA</td>
                      <td width="29%"><?php generaCombo(19); ?></td>
                      <td width="3%" height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/117.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td width="18%" height="24" class="etiqueta">Nº DE HABITANTES</td>
                      <td width="29%"><input type="text" class="casilla" name="ic_numhab"value="" size="3" maxlength="3" id="ic_numhab" onKeyPress="return validar_numeros(event)"/></td>
                    </tr>

                    <tr>
                      <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/118.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td height="24" class="etiqueta">Nº DE FAMILIAS</td>
                      <td><input type="text" class="casilla" name="ic_numfam" value="" size="3" maxlength="3" id="ic_numfam" onKeyPress="return validar_numeros(event)"/></td>
                      <td><div align="center"><img src="../img/casilla_azul/119.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                      <td><span class="etiqueta">MANTENIMIENTO</span></td>
                      <td><?php generaCombo(20); ?></td>
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
        		      <table width="960px" border="0" align="center" cellpadding="0" cellspacing="0" class="tabla">
                    <tr>
                      <td class="etiquetanegra" colspan="4" height="30">&nbsp;<strong>OBSERVACIONES:</strong></td>
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
        		<br/>

            <table width="960px"  border="1" align="center" cellPadding="0"cellSpacing="0" bordercolor="#000000" class="clsTabla2">
              <tr>
                <td>
    				      <table width="960px" border="0" align="center" cellpadding="0" cellspacing="0" class="tabla">
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
                      <td width="237"><input type="text" class="casilla" name="f_dni" value="" size="10" maxlength="8" id="f_dni" onKeyPress="return validar_numeros(event)" onchange="trae_Persona(this)" /></td>
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
            <br/>
            </td>
          </tr>
        </table>

  	    <p align="center">
  		    <input name="bGuardar" type="submit" class="booton" value="Guardar Ficha" />&nbsp;&nbsp;&nbsp;
  		    <input name="bCancelar" type="button" class="booton" value="Cancelar" onClick="location='../form_inicio.php'"/>
  	    </p>
  	    <br>
      </div>
    </form>
  </div>
</body>
</html>