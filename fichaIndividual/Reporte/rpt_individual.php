<?php 
// para evitar este mensaje  A session had already been started
//session_start();

//header("Content-type: text/html; charset=utf-8");
include '../../funciones/kill_sesion.php'; //matamos sesiones existentes de codigo referencial
//include '../funciones/verifica_ubigeo.php'; //sesiones de UBIGEO
include '../../funciones/genera_dep.php';
include '../../configuracion/eventos.php';
include '../proceso_ind/I_combos_editados2.php';

include '../../configuracion/conexion.php';
include '../../configuracion/constantes.php';

 // $alm = new FichaI();
 // $model = new FichaIModel();
?>

<!-- CODIGO AGREGADO-->
<script type="text/javascript" language="javascript" src="../../js/datos_minimos_I.js"></script>
<script type="text/javascript" language="javascript" src="../../js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="../../js/jquery.addfield.js"></script>
<script type="text/javascript" language="javascript" src="../../js/funciones_validar.js"></script>
<script type="text/javascript" language="javascript" src="../../js/valida_clones.js"></script>
<script type="text/javascript" language="javascript" src="../../js/valida_campo.js"></script>
<script type="text/javascript" language="javascript" src="../../../js/valida_campos_titular.js"></script>
<script type="text/javascript" language="JavaScript" src="../../js/popcalendar.js"></script>
<script type="text/javascript" language="javascript" src="../../js/cascade.js" ></script>
<script type="text/javascript" language="javascript" src="../../js/mascara.js"></script>
<!--<script type="text/javascript" src="../js/no_f5.js"></script> -->
<script type="text/javascript" src="../../js/imprimir.js"></script>

<link href="../../css/estilo_formpdf.css" rel="stylesheet" type="text/css"/>
<link href="../../css/link.css" rel="stylesheet" type="text/css">
<link href="../../css/tabla.css" rel="stylesheet" type="text/css">
<link href="../../css/botones.css" rel="stylesheet" type="text/css">
<link href="../../css/combos.css" rel="stylesheet" type="text/css">
<link href="../../css/popcalendar.css" rel="stylesheet" type="text/css"> 

<head>	
	<style type="text/css" >
		
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
        .Estilo2 {font-size: 12px;
        font-weight: normal;
        font-family: arial;        
      }
        .Estilo9 {font-size: 9px}
        .Estilo10 {font-size: 8px}
        .Estilo11 {font-family: Verdana, Arial, Helvetica, sans-serif}
		
	</style>
</head>
<!--<head> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
        <style type="text/css"> 
            table { border-collapse: collapse; border: 1 #000000 solid; } 
            table td { border: 1 #000000 solid; } 
        </style> 
</head> -->

<?php
$IDFicha = $_GET['id'];
$BD=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);
$BD->conectar();

$Consulta1="SELECT   f.id_ficha,f.nume_ficha,f.nume_ficha_lote, ".
                    "f.dc,u.id_uni_cat,u.cuc, u.codi_hoja_catastral,u.codi_cont_rentas,u.codi_pred_rentas ".
                    "FROM tf_uni_cat as u INNER JOIN tf_fichas as f ON u.id_uni_cat=f.id_uni_cat ".
                    "WHERE f.id_ficha = '$IDFicha'";
//-- VIAS
$Consulta2="SELECT v.codi_via, v.tipo_via, v.nomb_via, p.id_puerta, p.nume_muni,p.cond_nume, p.nume_certificacion ".
                        "FROM tf_vias as v INNER JOIN tf_puertas as p ON v.id_via=p.id_via INNER JOIN tf_ingresos as i ON ".
                        "p.id_puerta=i.id_puerta INNER JOIN tf_fichas as f ON i.id_ficha=f.id_ficha ".
                        "WHERE f.id_ficha = '$IDFicha'";
            
//-- UPC
$Consulta3="SELECT e.nomb_edificacion, e.tipo_edificacion, u.tipo_interior, u.nume_interior, l.id_hab_urba, l.zona_dist, ".
                    "l.mzna_dist, l.lote_dist, l.sub_lote_dist, l.id_lote ".
                    "FROM tf_lotes as l  INNER JOIN tf_edificaciones as e ON l.id_lote=e.id_lote ".
                    "INNER JOIN tf_uni_cat as u ON e.id_edificacion=u.id_edificacion ".
                    "INNER JOIN tf_fichas as f ON u.id_uni_cat=f.id_uni_cat ".
                    "WHERE f.id_ficha = '$IDFicha'";
            
//-- CT     
$Consulta4_1="SELECT cond_titular, form_adquisicion, fecha_adquisicion FROM tf_titulares WHERE id_ficha = '$IDFicha' ".
                        "GROUP BY cond_titular, form_adquisicion, fecha_adquisicion";
$Consulta4_2="SELECT condicion, nume_resolucion, porcentaje, fecha_inicio, fecha_vencimiento ".
                        "FROM tf_exoneraciones_predio WHERE id_ficha = '$IDFicha'";

//-- ITC
$Consulta5="SELECT p.tipo_persona, p.tipo_doc, p.nume_doc, p.nombres, p.ape_paterno, p.ape_materno, p.tipo_persona_juridica,".
                        " p.razon_social, t.esta_civil ".
                        //, e.condicion, e.nume_resolucion, e.nume_boleta_pension, e.fecha_inicio, e.fecha_vencimiento ".
                        "FROM tf_personas as p INNER JOIN tf_titulares as t ON p.id_persona=t.id_persona ".
                        //"INNER JOIN tf_exoneraciones_titular as e ON t.id_ficha=e.id_ficha ".
                        "WHERE t.id_ficha = '$IDFicha' ORDER BY t.nume_titular";

$Consulta5_2="SELECT  e.condicion, e.nume_resolucion, e.nume_boleta_pension, e.fecha_inicio, e.fecha_vencimiento ".
                        "FROM tf_titulares as t ".
                        "INNER JOIN tf_exoneraciones_titular as e ON t.id_ficha=e.id_ficha ".
                        "WHERE t.id_ficha = '$IDFicha' ORDER BY t.nume_titular";

 //-- DFTC
$Consulta6="SELECT d.codi_via, d.tipo_via, d.nomb_via, d.nume_muni, d.nomb_edificacion, ".
                        "d.nume_interior, d.codi_hab_urba, d.nomb_hab_urba, d.sector, d.mzna, d.lote, d.sublote, ".
                        "d.codi_dep, d.codi_pro, d.codi_dis ".
                        "FROM  tf_personas AS p  INNER JOIN tf_domicilio_titulares AS d ON p.id_persona=d.id_persona ".
                        "WHERE d.id_ficha = '$IDFicha'";

$Consulta6_1="SELECT t.telf, t.anexo, t.fax, t.email ".     
                        "FROM tf_titulares AS t INNER JOIN tf_personas AS p ON t.id_persona=p.id_persona ".
                        "WHERE t.id_ficha = '$IDFicha'".
                        "and SUBSTRING(t.nume_titular,11,1)='1'";       
  
//-- DP
$Consulta7="SELECT e.clasificacion, fi.cont_en, fi.codi_uso, us.desc_uso, l.estructuracion, l.zonificacion, fi.area_titulo, ".
                        "fi.area_declarada, fi.area_verificada, fi.porc_bc_terr_legal, fi.porc_bc_terr_fisc, fi.porc_bc_const_legal, ".
                        "fi.porc_bc_const_fisc ".
                        "FROM tf_usos AS us INNER JOIN tf_fichas_individuales AS fi ON us.codi_uso=fi.codi_uso ".
                        "INNER JOIN tf_fichas AS f ON fi.id_ficha=f.id_ficha ".
                        "INNER JOIN  tf_uni_cat AS u ON f.id_uni_cat=u.id_uni_cat ".
                        "INNER JOIN tf_edificaciones AS e ON u.id_edificacion=e.id_edificacion ".
                        "INNER JOIN tf_lotes AS l ON e.id_lote=l.id_lote ".
                        "WHERE f.id_ficha = '$IDFicha'";
                                
  $Consulta7_1="SELECT fren_campo, fren_titulo, fren_colinda_campo, fren_colinda_titulo, dere_campo, dere_titulo, ".
                        "dere_colinda_campo, dere_colinda_titulo, izqu_campo, izqu_titulo, izqu_colinda_campo, izqu_colinda_titulo, ".
                        "fond_titulo, fond_campo, fond_colinda_campo, fond_colinda_titulo ".
                        "FROM tf_linderos ".
                        "WHERE id_ficha = '$IDFicha'";          

  //-- SB
  $Consulta8="SELECT * FROM tf_servicios_basicos ".
                        "WHERE id_ficha = '$IDFicha'";
            
  //-- C
  $Consulta9="SELECT nume_piso, fecha, mep, ecs, ecc, estr_muro_col, estr_techo, acab_piso, acab_puerta_ven, acab_revest, ".
                        " acab_bano, inst_elect_sanita, area_declarada, area_verificada, uca ".
                        "FROM tf_construcciones ".
                        "WHERE id_ficha = '$IDFicha' ".
                        "ORDER BY id_ficha, nume_piso";

  //-- I
  $Consulta10="SELECT codi_instalacion, fecha, mep, ecs, ecc, dime_largo, dime_ancho, dime_alto, prod_total, uni_med, uca ".
                        "FROM tf_instalaciones ".
                        "WHERE id_ficha = '$IDFicha' ".
                        "ORDER BY id_instalacion";

  //-- D
  $Consulta11="SELECT tipo_doc, nume_doc, fecha_doc, area_autorizada ".
                        "FROM tf_documentos_adjuntos ".
                        "WHERE id_ficha = '$IDFicha' ".
                        "ORDER BY id_doc";
    
  $Consulta11_1="SELECT id_notaria, kardex, fecha_escritura ".
                        "FROM tf_registro_legal ".
                        "WHERE id_ficha = '$IDFicha' ";
            
  //-- S
  $Consulta12="SELECT tipo_partida, nume_partida, fojas, asiento, fech_inscripcion, codi_decla_fabrica, asie_fabrica, ".
                        "fecha_fabrica ".
                        "FROM tf_sunarp ".
                        "WHERE id_ficha = '$IDFicha' ";
                        
  //-- EPC
  $Consulta13="SELECT evaluacion, en_colindante, en_jardin_aislamiento, en_area_publica, en_area_intangible, ".
                        "cond_declarante, esta_llenado, nume_habitantes, nume_familias, mantenimiento, observaciones ".
                        "FROM tf_fichas_individuales ".
                        "WHERE id_ficha = '$IDFicha' ";

  //-- litigante
  $Consulta14="SELECT p.tipo_doc, p.nume_doc, p.razon_social, li.codi_contribuye ".
                        "FROM tf_personas AS p INNER JOIN tf_litigantes AS li ON p.id_persona=li.id_persona ".
                        "WHERE li.id_ficha = '$IDFicha' AND p.tipo_funcion='6'";
                        
  //-- FIRMAS
  $Consulta15="SELECT declarante, fecha_declarante, supervisor, fecha_supervision, tecnico, fecha_levantamiento, ".
                        "verificador, fecha_verificacion, nume_registro ".
                        "FROM tf_fichas ".
                        "WHERE id_ficha = '$IDFicha'";

  //Departamento
  $Consulta16 = "SELECT  u.codi_dep, u.descri ".
                        "FROM tf_domicilio_titulares as t inner join tf_ubigeos as u on t.codi_dep=u.codi_dep ".
                        "WHERE t.id_ficha = '$IDFicha'";

  // Provincia
  $Consulta17 = "SELECT  u.codi_pro, u.descri ".
                        " FROM tf_domicilio_titulares as t inner join tf_ubigeos as u on t.codi_pro = u.codi_pro ".
                        " WHERE t.id_ficha = '$IDFicha' and u.codi_dep = (select codi_dep from tf_domicilio_titulares where id_ficha='$IDFicha')".
                        " and u.codi_pro = (select codi_pro from tf_domicilio_titulares where id_ficha='$IDFicha')".
                        " and u.codi_dis = (select codi_dis from tf_domicilio_titulares where id_ficha='$IDFicha')";
            
  // Distrito
  $Consulta18 = "SELECT  u.codi_dis, u.descri ".
                        " FROM tf_domicilio_titulares as t inner join tf_ubigeos as u on t.codi_dis = u.codi_dis ".
                        " WHERE t.id_ficha = '$IDFicha' and u.codi_dep = (select codi_dep from tf_domicilio_titulares where id_ficha='$IDFicha')".
                        " and u.codi_pro = (select codi_pro from tf_domicilio_titulares where id_ficha='$IDFicha')".
                        " and u.codi_dis = (select codi_dis from tf_domicilio_titulares where id_ficha='$IDFicha')";


$numficha= $BD->Consultas($Consulta1);
$row1=pg_fetch_array($numficha);


//ASIGNACIONES POR CADA BLOQUE
//row2
$consulta_vias= $BD->Consultas($Consulta2);             

$nro_upc=pg_num_rows($consulta_vias);
$nro_upc=$nro_upc-1;
//asigno valor real a un contador
$con_upc=$nro_upc;
//reemplazo de ser necesario caso: (-1)

if ($nro_upc<0) $nro_upc=0;
//row3 y row3_1
   $consulta_upc= $BD->Consultas($Consulta3);
   $row3=pg_fetch_array($consulta_upc);
   //*** comparamos el id_hab_urba
   $ubi=substr(trim($row3['id_lote']),0,6);
   $hu=trim($row3['id_hab_urba']);
   $cad=$ubi.$hu;
   //echo '-'.$cad.'-';
   $Consulta3_1="SELECT tipo_hab_urba, nomb_hab_urba FROM tf_hab_urbana WHERE id_hab_urba = '$cad'";
   $consulta_hu= $BD->Consultas($Consulta3_1);
   $row3_1=pg_fetch_array($consulta_hu);
            
//row4_1 y row4_2
$consulta_ct_1= $BD->Consultas($Consulta4_1);
$row4_1=pg_fetch_array($consulta_ct_1);
$consulta_ct_2= $BD->Consultas($Consulta4_2);
$row4_2=pg_fetch_array($consulta_ct_2);
            
//row5 y row5_1
$consulta_itc= $BD->Consultas($Consulta5);
$row5=pg_fetch_array($consulta_itc);
$row5_1=@pg_fetch_all($consulta_itc);
$consulta_itc_2= $BD->Consultas($Consulta5_2);
$row5_2=pg_fetch_array($consulta_itc_2);

//row6 y row6_1
$consulta_dftc= $BD->Consultas($Consulta6);
$row6=pg_fetch_array($consulta_dftc);
$consulta_tlf= $BD->Consultas($Consulta6_1);
$row6_1=pg_fetch_array($consulta_tlf);

//row7 y row7_1
$consulta_dp= $BD->Consultas($Consulta7);
$row7=pg_fetch_array($consulta_dp);
$consulta_dp_1= $BD->Consultas($Consulta7_1);
$row7_1=pg_fetch_array($consulta_dp_1);

//row8
$consulta_sb= $BD->Consultas($Consulta8);
$row8=pg_fetch_array($consulta_sb);

$consulta_c= $BD->Consultas($Consulta9);
$nro_c=pg_num_rows($consulta_c);
$nro_c=$nro_c-1;
//asigno valor real a un contador
$con_c=$nro_c;
//reemplazo de ser necesario caso: (-1)
if ($nro_c<0) $nro_c=0;
                $consulta_i= $BD->Consultas($Consulta10);
                $nro_i=pg_num_rows($consulta_i);
                $nro_i=$nro_i-1;
                //asigno valor real a un contador
                $con_i=$nro_i;
//reemplazo de ser necesario caso: (-1)
if ($nro_i<0) $nro_i=0;
                $consulta_d= $BD->Consultas($Consulta11);
                $nro_d=pg_num_rows($consulta_d);
                $nro_d=$nro_d-1;
                //asigno valor real a un contador
                $con_d=$nro_d;
//reemplazo de ser necesario caso: (-1)
if ($nro_d<0) $nro_d=0;
                //row11_1
                $consulta_n= $BD->Consultas($Consulta11_1);
                $row11_1=pg_fetch_array($consulta_n);
            
                //row12
                $consulta_s= $BD->Consultas($Consulta12);
                $row12=pg_fetch_array($consulta_s);
                
                //row13
                $consulta_epc= $BD->Consultas($Consulta13);
                $row13=pg_fetch_array($consulta_epc);
                
                //row16
                $consulta_dep= $BD->Consultas($Consulta16);
                $row16=pg_fetch_array($consulta_dep);
                $Departamento1= $row16['descri'];

                //row17
                $consulta_pro= $BD->Consultas($Consulta17);
                $row17=pg_fetch_array($consulta_pro);
                $Provincia1= $row17['descri'];

                //row18
                $consulta_dis= $BD->Consultas($Consulta18);
                $row18=pg_fetch_array($consulta_dis);
                $Distrito1= $row18['descri'];

                //row14
                $consulta_li= $BD->Consultas($Consulta14);
                $nro_li=pg_num_rows($consulta_li);
                $nro_li=$nro_li-1;
                //asigno valor real a un contador
                $con_li=$nro_li;
                //reemplazo de ser necesario caso: (-1)
            if ($nro_li<0) $nro_li=0;
            
                //row15
                $consulta_fi= $BD->Consultas($Consulta15);
                $row15=pg_fetch_array($consulta_fi);
?>

<body>
         
<table width="720px" border="0" align="center" cellPadding="0" cellSpacing="0" bordercolor="#000000" class="Estilo2">
 <tr><td colspan="6" bgcolor="#0052A4" align="center" class="Estilo7">FICHA CATASTRAL URBANA INDIVIDUAL</td></tr>
 <tr>
  <td colspan="6"><br>
   <table width="720px" border="0" cellpadding="0" cellspacing="0">
    <tr>
     <td width="5%">&nbsp;</td>     
     <td width="29%"  align="left">N&Uacute;MERO DE FICHA</td>
     <td align="left"><?php echo $row1['nume_ficha']; ?></td>                
     <td width="5%">&nbsp;</td>
     <td width="29%" align="left">N&Uacute;MERO DE FICHAS POR LOTE&nbsp;</td>
     <td align="left"><?php echo $row1['nume_ficha_lote']; ?></td>                
    </tr>
    <tr>
     <td colspan="6"><br>
      <div align="center">
       <table width="98%" border="0" align="center">
        <tr>
         <td width="10%" align="center"><img src="../../img/SNCP.PNG" width="72" height="28.5" /></td>
         <td width="75%">
          <div align="center">
           <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
            <tr>
             <td>
              <div align="center">
               <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tabla" style="vertical-align:middle">
                <tr><td colspan="16"><strong>DATOS GENERALES: </strong></td></tr>
                <tr>
                  <td width="10%" height="24" valign="middle" align="center"><img src="../../img/casilla_azul/1.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
                  <td width="15%" valign="middle">C&Oacute;DIGO UNICO CATASTRAL - CUC </td>
                  <td colspan="4"><?php echo substr($row1['cuc'],0,8); ?><?php echo substr($row1['cuc'],8,4); ?></td>
                  <td align="center"><img src="../../img/casilla_azul/2.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
                  <td colspan="4">C&Oacute;DIGO HOJA CATASTRAL</td>
                  <td colspan="2" align="right"><?php echo trim($row1['codi_hoja_catastral']); ?>
                </tr>
                <tr>
                  <td height="12" colspan="2">&nbsp;</td>
                  <td width="3%" valign="bottom" align="center" class="Estilo10">DPTO.</td>
                  <td width="3%" valign="bottom" align="center" class="Estilo10">PROV.</td>
                  <td width="6%" valign="bottom" align="center" class="Estilo10">DIST.</td>
                  <td width="11%" valign="bottom" align="center" class="Estilo10">SECTOR</td>
                  <td width="5%" valign="bottom" align="center" class="Estilo10">MANZANA</td>
                  <td width="3%" valign="bottom" align="center" class="Estilo10">LOTE</td>
                  <td width="4%" valign="bottom" align="center" class="Estilo10">EDIFICA</td>
                  <td width="5%" valign="bottom" align="center" class="Estilo10">ENTRADA</td>
                  <td width="8%" valign="bottom" align="center" class="Estilo10">PISO</td>
                  <td width="4%" valign="bottom" align="center" class="Estilo10">UNIDAD</td>
                  <td width="6%" valign="bottom" align="left" class="Estilo10">&nbsp;&nbsp;DC</td>
                </tr>
                <tr>
                  <td height="24" align="center"><img src="../../img/casilla_roja/3.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
                  <td height="24">C&Oacute;DIGO DE REFERENCIA CATASTRAL </td>
                  <td align="center"><?php echo substr($row1['id_ficha'],4,2); ?></td>
                  <td align="center"><?php echo substr($row1['id_ficha'],6,2); ?></td>
                  <td align="center"><?php echo substr($row1['id_ficha'],8,2); ?></td>
                  <td align="center"><?php echo substr($row1['id_uni_cat'],6,2); ?></td>
                  <td align="center"><?php echo substr($row1['id_uni_cat'],8,3); ?></td>
                  <td align="center"><?php echo substr($row1['id_uni_cat'],11,3); ?></td>
                  <td align="center"><?php echo substr($row1['id_uni_cat'],14,2); ?></td>
                  <td align="center"><?php echo substr($row1['id_uni_cat'],16,2); ?></td>
                  <td align="center"><?php echo substr($row1['id_uni_cat'],18,2); ?></td>
                  <td align="center"><?php echo substr($row1['id_uni_cat'],20,3); ?></td>
                  <td align="center"><?php echo $row1['dc']; ?></td>
                </tr>
                <tr>
                  <td align="center"><img src="../../img/casilla_azul/4.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
                  <td>C&Oacute;DIGO CONTRIBUYENTE DE RENTAS </td><td colspan="3"><?php echo trim($row1['codi_cont_rentas']); ?></td><td align="center"></td>
                  <td align="center"><img src="../../img/casilla_azul/5.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
                  <td colspan="4">C&Oacute;DIGO PREDIAL DE RENTAS</td><td>&nbsp;</td><td><?php echo trim($row1['codi_pred_rentas']); ?></td><td width="11%">&nbsp;</td>
                </tr>                                      
               </table>
              </div>                             
             </td>
            </tr>     
           </table>
          </div>                             
         </td> 
         <td width="10%" align="center"><img src="../../img/SNCP.PNG" width="72" height="28.5" /></td>
        </tr>
       </table>
      </div>                             
     </td>
    </tr> 
   </table>
  </td>
 </tr>
</table>

 <!--UBICACION DEL PREDIO CATASTRAL-->
 <table width="720px" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" >
  <tr>
   <td>

    <table width="720px" border="0" align="center" cellpadding="0" cellspacing="0" class="Estilo2">
     <tr><td class="etiquetanegra" colspan="14" height="30">&nbsp;<strong>UBICACI&Oacute;N DEL PREDIO CATASTRAL:</strong></td></tr>
     <tr>
      <td>
       <table align="center" width="710px" border="1" cellpadding="0" cellspacing="0" class="Estilo2">
        <thead >
         <tr class="principal">
          <th class="secundario Estilo9" width="2%" align="center"><img src="../../img/casilla_roja/7.png" alt="Guardar estado?" width="17" height="17" border="0" /></th>
          <th class="secundario Estilo9" width="6%">C&Oacute;DIGO DE VIA</th>
          <th class="secundario Estilo9" width="2%" align="center"><img src="../../img/casilla_azul/8.png" alt="Guardar estado?" width="17" height="17" border="0" /></th>
          <th class="secundario Estilo9" width="6%">TIPO DE V&Iacute;A </th>
          <th class="secundario Estilo9" width="2%" align="center"><img src="../../img/casilla_azul/9.png" alt="Guardar estado?" width="17" height="17" border="0" /></th>
          <th class="secundario Estilo9" width="30%">NOMBRE V&Iacute;A</th>
          <th class="secundario Estilo9" width="2%" align="center"><img src="../../img/casilla_roja/10.png" alt="Guardar estado?" width="17" height="17" border="0" /></th>
          <th class="secundario Estilo9" width="11%">TIPO PUERTA</th>
          <th class="secundario Estilo9" width="2%" align="center"><img src="../../img/casilla_azul/11.png" alt="Guardar estado?" width="17" height="17" border="0" /></th>
          <th class="secundario Estilo9" width="9%">N&ordm; MUNICIPAL</th>
          <th class="secundario Estilo9" width="2%" align="center"><img src="../../img/casilla_azul/12.png" alt="Guardar estado?" width="17" height="17" border="0" /></th>
          <th class="secundario Estilo9" width="9%">COND. N&Uacute;MERO </th>
          <th class="secundario Estilo9" width="2%" align="center"><img src="../../img/casilla_azul/13.png" alt="Guardar estado?" width="17" height="17" border="0" /></th>
          <th class="secundario Estilo9" width="11%">N&ordm; CERTIF.DE NUMERACI&Oacute;N </th>                      
         </tr>

         <tr>
          <td colspan="14" align="center">
          <?php   
          if($con_upc<0) //no hay registros
          {
          echo "<div id='linea1_0' style='width:100%'>";
          echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
          echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
          echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
          echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";                                                        
          echo "</div>";
          }
          else
          {
          //---------------------------------------------------------------- VIAS   
           $indice1=0;
           while($row2=pg_fetch_array($consulta_vias))
           {  
           echo "<div align='left' id='linea1_".$indice1."' style='width:100%'>";
           echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; echo $row2['codi_via'];
           echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; echo $row2['tipo_via'];
           echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; echo $row2['nomb_via'];
           echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; generaCombo(25);
           echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; echo $row2['nume_muni'];
           echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; generaCombo(36);
           echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; echo $row2['nume_certificacion'];
           echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
           echo "</div>";
           $indice1++; 
           }
          }        
          ?>
          </td>          
         </tr> 
        </thead>
       </table>
      </td>
     </tr>    
    </table>

    <table width="720px" align="center" class="Estilo2">   
     <tr>
          <td width="5%" class="etiqueta" height="14" align="center">&nbsp;&nbsp;<img src="../../img/casilla_azul/14.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
          <td width="15%" class="etiqueta">NOMBRE DE LA EDIFICACI&Oacute;N</td>
          <td width="34%"><?php echo trim($row3['nomb_edificacion']);?></td>
          <td width="5%" class="etiqueta" height="14" align="center"><img src="../../img/casilla_azul/15.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
          <td width="15%" class="etiqueta">TIPO DE EDIFICACI&Oacute;N</td>
          <td width="25%" ><?php generaCombo(1); ?></td>                                
     </tr>
     <tr>
          <td height="14" class="etiqueta" align="center">&nbsp;&nbsp;<img src="../../img/casilla_azul/16.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
          <td class="etiqueta">TIPO DE INTERIOR</td><td ><?php generaCombo(2); ?></td>
          <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/17.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
          <td class="etiqueta">N&Uacute;MERO DE INTERIOR</td><td ><?php echo trim($row3['nume_interior']); ?></td>
     </tr>
     <tr>
          <td height="14" class="etiqueta" align="center">&nbsp;&nbsp;<img src="../../img/casilla_roja/18.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
          <td class="etiqueta">C&Oacute;DIGO H.U.</td><td><?php echo trim($row3['id_hab_urba']); ?></td>
          <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/19.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
          <td class="etiqueta">NOMBRE DE LA H.U.</td><td><?php echo trim($row3_1['tipo_hab_urba']).' '.trim($row3_1['nomb_hab_urba']); ?></td>
     </tr>
     <tr>
          <td height="14" class="etiqueta" align="center">&nbsp;&nbsp;<img src="../../img/casilla_azul/20.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
          <td class="etiqueta">ZONA/SECTOR/ETAPA</td><td><?php echo trim($row3['zona_dist']); ?></td>
          <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/21.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
          <td class="etiqueta">MANZANA</td><td><?php echo trim($row3['mzna_dist']); ?></td>
     </tr>      
     <tr>
          <td height="14" class="etiqueta" align="center">&nbsp;&nbsp;<img src="../../img/casilla_azul/22.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
          <td class="etiqueta">LOTE</td><td><?php echo trim($row3['lote_dist']); ?></td>
          <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/23.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
          <td class="etiqueta">SUB-LOTE</td><td><?php echo trim($row3['sub_lote_dist']); ?></td>
     </tr>
    </table>   
   
   </td>
  </tr>
 </table>   


 <!--OK identificacion deltitular catastral -->  
 <table width="720px" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" class="Estilo2">
  <tr>
   <td>
    <table width="720px" border="0" align="center" cellpadding="0" cellspacing="0">
     <tr><td class="etiquetanegra" colspan="4" height="30">&nbsp;<strong>IDENTIFICACI&Oacute;N DEL TITULAR CATASTRAL:</strong></td></tr>
     <tr>
     <td colspan="4">                   
       <?php                      
        echo "
        <table  id='oculta' width='720px' align='center' cellpadding='0' cellspacing='0'>
         <tr>
          <td width='5%' height='14' class='etiqueta' align='center'><img src='../../img/casilla_roja/24.png'alt='Guardar estado?' width='17' height='17' border='0' /></td>
          <td width='15%' class='etiqueta'>TIPO DE TITULAR</td>
          <td width='34%'>"; echo generaCombo(3)."</td>
          <td width='5%' height='14' class='etiqueta' align='center'><img src='../../img/casilla_roja/25.png' alt='Guardar estado?' width='17' height='17' border='0' /></td>
          <td width='15%' class='etiqueta'>ESTADO CIVIL</td>
          <td width='25%'>"; echo generaCombo(5)."</td>
          </tr>
          <tr>
            <td height='14' class='etiqueta' align='center'><img src='../../img/casilla_roja/26.png' alt='Guardar estado?' width='17' height='17' border='0' /></td>
            <td class='etiqueta'>TIPO DOC. IDENTIDAD</td><td >"; echo generaCombo(4)."</td>
            <td height='14' class='etiqueta' align='center'><img src='../../img/casilla_roja/27.png' alt='Guardar estado?' width='17' height='17' border='0' /></td>";
            //ESTADO CIVIL
        echo "
            <td class='etiqueta'>N&Uacute;MERO DE DOCUMENTO</td><td>"; echo trim($row5_1[0]['nume_doc'])."</td>
           </tr>
           <tr>
            <td height='14' class='etiqueta' align='center'><img src='../../img/casilla_roja/28.png'alt='Guardar estado?' width='17' height='17' border='0' /></td>
            <td class='etiqueta'>NOMBRES</td><td>"; echo trim($row5_1[0]['nombres'])."</td>            
            <td height='14' colspan='2' class='etiqueta'>&nbsp;</td>
            <td height='14' class='etiqueta'>&nbsp;</td>
           </tr>
           <tr>
            <td height='14' class='etiqueta' align='center'><img src='../../img/casilla_roja/29.png' alt='Guardar estado?' width='17' height='17' border='0' /></td>
            <td class='etiqueta'>APELLIDO PATERNO</td><td>"; echo trim($row5_1[0]['ape_paterno'])."</td>                        
            <td height='14' class='etiqueta' align='center'><img src='../../img/casilla_roja/30.png' alt='Guardar estado?' width='17' height='17' border='0' /></td>
            <td class='etiqueta'>APELLIDO MATERNO</td><td>"; echo trim($row5_1[0]['ape_materno'])."</td>                        
           </tr>";

           //CONYUGE 
        echo 
          "<tr><td>&nbsp;</td></tr>
           <tr>
            <td height='14' class='etiqueta'>&nbsp;</td>
            <td class='etiqueta' colspan='5'><strong>DATOS DEL C&Oacute;NYUGE</strong></td>
            <td class='etiqueta'>&nbsp;</td>
            <td class='etiqueta'>&nbsp;</td>
            <td class='etiqueta'>&nbsp;</td>
            <td class='etiqueta'>&nbsp;</td>
           </tr>
           <tr><td>&nbsp;</td></tr>                        
           <tr>
            <td height='14' class='etiqueta' align='center'><img src='../../img/casilla_azul/26.png' alt='Guardar estado?' width='17' height='17' border='0' /></td>
            <td class='etiqueta'>TIPO DOC. IDENTIDAD</td><td>"; echo generaCombo(24)."</td>
            <td height='14' class='etiqueta' align='center'><img src='../../img/casilla_azul/27.png' alt='Guardar estado?' width='17' height='17' border='0' /></td>
            <td class='etiqueta'>N&Uacute;MERO DE DOCUMENTO</td><td>'"; if (trim($row5['esta_civil'])=='02'){ echo trim($row5_1[0]['nume_doc']);} else echo ''; echo "' </td>

           </tr>
           <tr>
            <td height='14' class='etiqueta' align='center'><img src='../../img/casilla_azul/28.png' alt='Guardar estado?' width='17' height='17' border='0' /></td>
            <td class='etiqueta'>NOMBRES</td><td>'"; if (trim($row5['esta_civil'])=='02') { echo trim($row5_1[0]['nombres']); } else echo ''; echo "' </td>
            <td height='14' colspan='2' class='etiqueta'>&nbsp;</td>
            <td>&nbsp;</td>
           </tr>
           <tr>
            <td height='14' class='etiqueta' align='center'><img src='../../img/casilla_azul/29.png' alt='Guardar estado?' width='17' height='17' border='0' /></td>
            <td class='etiqueta'>APELLIDO PATERNO</td><td>'"; if (trim($row5['esta_civil'])=='02'){ echo trim($row5_1[0]['ape_paterno']); }else echo '';echo "'</td> 
            <td height='14' class='etiqueta' align='center'><img src='../../img/casilla_azul/30.png' alt='Guardar estado?' width='17' height='17' border='0' /></td>
            <td class='etiqueta'>APELLIDO MATERNO</td><td>'"; if (trim($row5['esta_civil'])=='02'){ echo trim($row5_1[0]['ape_materno']); } else echo '';echo "' </td> 

           </tr>
           <tr><td height='14' colspan='6' class='etiqueta'>&nbsp;</td></tr>
           <tr>
            <td height='14' class='etiqueta' align='center'><img src='../../img/casilla_roja/31.png' alt='Guardar estado?' width='17' height='17' border='0' /></td>
            <td class='etiqueta'>N&Uacute;MERO DE RUC</td><td></td>
            <td height='14' class='etiqueta' align='center'><img src='../../img/casilla_roja/32.png' alt='Guardar estado?' width='17' height='17' border='0' /></td>
            <td height='14' class='etiqueta'>RAZON SOCIAL</td><td></td>
           </tr>
           <tr>
            <td height='14' class='etiqueta' align='center'><img src='../../img/casilla_roja/33.png' alt='Guardar estado?' width='17' height='17' border='0' /></td>
            <td class='etiqueta'>PERSONA JUR&Iacute;DICA</td><td>"; echo generaCombo(6)."</td>
            <td height='14' class='etiqueta' align='center'><img src='../../img/casilla_azul/34.png' alt='Guardar estado?' width='17' height='17' border='0' /></td>
            <td class='etiqueta'>COND. ESP. DEL TITULAR</td><td>"; echo generaCombo(7)."</td>
           </tr>
           <tr>
            <td height='14' class='etiqueta' align='center'><img src='../../img/casilla_azul/35.png' alt='Guardar estado?' width='17' height='17' border='0' /></td>
            <td class='etiqueta'>N&Uacute;M. RESOL. EXONERACION</td><td>'".trim($row5_2['nume_resolucion'])."'</td>                        
            <td height='14' class='etiqueta' align='center'><img src='../../img/casilla_azul/36.png' alt='Guardar estado?' width='17' height='17' border='0' /></td>
            <td class='etiqueta'>N&Uacute;M. BOL. PENSIONISTA</td><td>'".trim($row5_2['nume_boleta_pension'])."'</td>                                   
           </tr>
           <tr>
            <td height='14' class='etiqueta' align='center'><img src='../../img/casilla_azul/37.png' alt='Guardar estado?' width='17' height='17' border='0' /></td>
            <td class='etiqueta'>INICIO EXONERACION</td><td>'"; if (trim($row5_2['fecha_inicio'])=='31/12/1969'){ echo '' ;}else echo trim($row5_2['fecha_inicio']);echo "'</td>                            
            <td height='14' class='etiqueta' align='center'><img src='../../img/casilla_azul/38.png' alt='Guardar estado?' width='17' height='17' border='0' /></td>
            <td class='etiqueta'>FIN.EXONERACION</td><td>'"; if (trim($row5_2['fecha_vencimiento'])=='31/12/1969'){ echo '';} else echo trim($row5_2['fecha_vencimiento']); echo "'</td> 
           </tr>
          </table>";
          ?>
          
         </td>
        </tr>                  
       </table>
      </td>
     </tr>
 </table> 

 <!--OK domicilio fiscal del titular catastral-->
 
 <table width="720px" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" class="Estilo2">
 <tr>
  <td>
   <table width="720px" border="0" align="center" cellpadding="0" cellspacing="0" class="Estilo2">
    <tr><td class="etiquetanegra" colspan="6" height="30">&nbsp;<strong>DOMICILIO FISCAL DEL TITULAR CATASTRAL:</strong></td></tr>
    <tr>
      <td width="5%" class="etiqueta" height="14" align="center"><img src="../../img/casilla_roja/39.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
      <td width="15%" class="etiqueta">DEPARTAMENTO</td>      
      <td width="34%" ><?php echo $Departamento1; ?></td>
      <td width="5%" class="etiqueta" height="14" align="center"><img src="../../img/casilla_roja/40.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
      <td width="15%" class="etiqueta">PROVINCIA</td>
      <td width="25%" ><?php echo $Provincia1; ?></td>      
    </tr>
    <tr>
      <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_roja/41.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
      <td height="14" class="etiqueta">DISTRITO</td><td align="left" ><?php echo $Distrito1; ?></td></div></td>
      <td colspan="4"></td>
      <td>&nbsp;</td>
     </tr> 
     <tr>
      <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/42.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
      <td height="14" class="etiqueta">TEL&Eacute;FONO</td><td align="left" ><?php echo trim($row6_1['telf']);?></td>
      <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/43.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
      <td height="14" class="etiqueta">ANEXO</td><td align="left" ><?php echo trim($row6_1['anexo']);?></td>
     </tr>
     <tr>
      <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/44.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
      <td height="14" class="etiqueta">FAX</td><td align="left" ><?php echo trim($row6_1['fax']);?></td>
      <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/45.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
      <td height="14" class="etiqueta">CORREO ELECTR&Oacute;NICO</td><td align="left" ><?php echo trim($row6_1['email']);?></td>
     </tr>
     <tr>
      <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/7.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
      <td height="14" class="etiqueta">C&Oacute;DIGO DE V&Iacute;A</td><td align="left" ><?php echo trim($row6['codi_via']);?></td>
      <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/8.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
      <td height="14" class="etiqueta">TIPO DE V&Iacute;A</td><td align="left" ><?php echo trim($row6['tipo_via']);?></td>
     </tr>
     <tr>
      <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/9.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
      <td height="14" class="etiqueta">NOMBRE DE V&Iacute;A</td><td align="left" ><?php echo trim($row6['nomb_via']);?></td>
      <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/11.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
      <td height="14" class="etiqueta">N&Uacute;MERO MUNICIPAL</td><td align="left" ><?php echo trim($row6['nume_muni']);?></td>
     </tr>
     <tr>
      <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/14.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
      <td height="14" class="etiqueta">NOMBRE DE EDIFICACI&Oacute;N</td><td align="left" ><?php echo trim($row6['nomb_edificacion']);?></td>
      <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/17.png"alt="Guardar estado?" width="17" height="17" border="0" /></td>
      <td height="14" class="etiqueta">N&Uacute;MERO INTERIOR</td><td align="left" ><?php echo trim($row6['nume_interior']);?></td>
     </tr>
     <tr>
      <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/18.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
      <td height="14" class="etiqueta">C&Oacute;DIGO H.U.</td><td align="left" ><?php echo trim($row6['codi_hab_urba']);?></td>
      <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/19.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
      <td height="14" class="etiqueta">NOMBRE DE LA H.U.</td><td align="left" ><?php echo trim($row6['nomb_hab_urba']);?></td>
     </tr>
     <tr>
      <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/20.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
      <td height="14" class="etiqueta">ZONA/SECTOR/ETAPA</td><td align="left" ><?php echo trim($row6['sector']);?></td>
      <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/21.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
      <td height="14" class="etiqueta">MANZANA</td><td align="left" ><?php echo trim($row6['mzna']);?></td>
     </tr>
     <tr>
      <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/22.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
      <td height="14" class="etiqueta">LOTE</td><td align="left" ><?php echo trim($row6['lote']);?></td>
      <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/23.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
      <td height="14" class="etiqueta">SUB-LOTE</td><td align="left" ><?php echo trim($row6['sublote']);?></td>
     </tr>
    </table>
   </td>
  </tr>
 </table> 
    
 <!--OK caracteristicas de titularidad-->
 <table width="720px" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" class="Estilo2">
  <tr>
   <td>
    <table width="720px" border="0" align="center" cellpadding="0" cellspacing="0">
     <tr><td class="etiquetanegra" colspan="6" height="30">&nbsp;<strong>CARACTER&Iacute;STICAS DE LA TITULARIDAD: </strong></td></tr>
     <tr>
      <td width="5%" class="etiqueta" height="14" align="center"><img src="../../img/casilla_roja/46.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
      <td width="15%" class="etiqueta">CONDICI&Oacute;N DEL TITULAR</td>
      <td width="34%"><?php generaCombo(9); ?></td>
      <td width="5%" class="etiqueta" height="14" align="center"><img src="../../img/casilla_azul/47.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
      <td width="15%" class="etiqueta">FORMA DE ADQUISICI&Oacute;N</td>
      <td width="25%"><?php generaCombo(10); ?></td>
     </tr>
     <tr>
      <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/48.png" alt="Guardar estado?" width="17" height="17"border="0" /></td>
      <td class="etiqueta">FECHA DE ADQUISICI&Oacute;N</td><td><?php if (trim($row4_1['fecha_adquisicion'])=='31/12/1969'){ echo '';} else echo trim($row4_1['fecha_adquisicion']);?></td>                       
      <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/49.png" alt="Guardar estado?" width="17" height="17" border="0"/></td>
      <td class="etiqueta">COND. ESP. DEL PREDIO</td><td><?php generaCombo(11); ?></td>
     </tr>
     <tr>
      <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/50.png" alt="Guardar estado?" width="17" height="17" border="0"/></td>
      <td class="etiqueta">Nº RESOL. EXONERACION</td><td><?php echo trim($row4_2['nume_resolucion']); ?></td>
      <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/51.png" alt="Guardar estado?" width="17" height="17" border="0"/></td>
      <td class="etiqueta">PORCENTAJE</td><td><?php echo $row4_2['porcentaje']; ?>&nbsp;(%)</td>
     </tr>
     <tr>
      <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/52.png" alt="Guardar estado?" width="17" height="17" border="0"/></td>
      <td class="etiqueta">FECHA DE INICIO</td><td><?php if (trim($row4_2['fecha_inicio'])=='1970-01-01'){ echo '';} else echo trim($row4_2['fecha_inicio']);?></td>              
      <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/53.png" alt="Guardar estado?" width="17" height="17" border="0"/></td>
      <td class="etiqueta">FECHA DE VENCIMIENTO</td><td><?php if (trim($row4_2['fecha_vencimiento'])=='1970-01-01'){ echo '';} else echo $row4_2['fecha_vencimiento']; ?></td>                                          
     </tr>
    </table>
   </td>
  </tr>
 </table>
       
 <!--OK descripcion del predio-->
 <table width="720px" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" class="Estilo2">
 <tr>
  <td>
   <table width="720px" border="0" align="center" cellpadding="0" cellspacing="0" class="Estilo2">   
    <tr><td class="etiquetanegra" colspan="8" height="30"><strong>DESCRIPCI&Oacute;N DEL PREDIO: </strong></td></tr>     
    <tr>
      <td width="5%" class="etiqueta" height="14" align="center"><img src="../../img/casilla_roja/54.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
      <td width="15%"colspan="3" class="etiqueta">CLASIFICACI&Oacute;N DEL PREDIO</td>
      <td width="34%"><?php generaCombo(12); ?></td>
      <td width="5%" class="etiqueta" height="14" align="center"><img src="../../img/casilla_roja/55.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
      <td width="15%" class="etiqueta">PREDIO CATASTRAL EN</td>
      <td width="25%" colspan="2"><?php generaCombo(13); ?></td>
    </tr>   
    <tr>
       <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_roja/56.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
       <td width="18%" height="14" class="etiqueta">C&Oacute;D. DE USO</td>
       <td width="2%" class="etiqueta"><img src="../../img/casilla_azul/57.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
       <td height="14" colspan="6" class="etiqueta">USO PREDIO CATASTRAL (DESCRIPCI&Oacute;N)</td>
    </tr><br>
    <tr>
      <td height="14" class="etiqueta">&nbsp;</td>
      <td height="14" colspan="8" class="etiqueta"><?php generaCombo(14); ?></td>
    </tr>    
    <tr>
      <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/58.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
      <td colspan="3" class="etiqueta">ESTRUCTURACI&Oacute;N</td><td><?php echo trim($row7['estructuracion']);?></td>
      <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/59.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
      <td class="etiqueta">ZONIFICACI&Oacute;N</td><td height="14" class="etiqueta">&nbsp;</td><td ><?php echo trim($row7['zonificacion']);?></td>
    </tr>
    <tr>
      <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/60.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
      <td colspan="3" class="etiqueta">&Aacute;REA TERRENO T&Iacute;TULO</td><td><?php if ($row7['area_titulo']==0.00) echo ''; else echo trim($row7['area_titulo']);?>&nbsp;(M2)</td>
      <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/61.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
      <td class="etiqueta">&Aacute;REA TERRENO DECLARADA</td><td height="14" class="etiqueta">&nbsp;</td><td><?php if ($row7['area_declarada']==0.00) echo ''; else echo trim($row7['area_declarada']);?>&nbsp;(M2)</td>
    </tr>
    <tr>
      <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/62.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
      <td colspan="3" class="etiqueta">&Aacute;REA TERRENO VERIFICADA</td><td colspan="5"><?php if ($row7['area_verificada']==0.00) echo ''; else echo trim($row7['area_verificada']);?>&nbsp;(M2)</td>
    </tr>  
   </table>
  </td>
 </tr>
 </table>

 <table width="720px" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" class="Estilo2"> 
  <thead>
          <tr class="normal">
            <th width="19%">LINDEROS DE LOTE(ML)</th>
            <th width="2%" align="center" valign="center"><img src="../../img/casilla_azul/63.png" alt="Guardar estado?" width="17" height="17" border="0" /></th>
            <th width="23%">MEDIDA EN CAMPO</th>
            <th width="2%" align="center"><img src="../../img/casilla_azul/64.png" alt="Guardar estado?" width="17" height="17" border="0" /></th>
            <th width="23%">MEDIDA SEG&Uacute;N T&Iacute;TULO</th>
            <th width="2%" align="center"><img src="../../img/casilla_azul/65.png" alt="Guardar estado?" width="17" height="17" border="0" /></th>
            <th width="23%">COLINDANCIAS EN CAMPO</th>
            <th width="2%" align="center"><img src="../../img/casilla_azul/66.png" alt="Guardar estado?" width="17" height="17" border="0" /></th>
            <th width="23%">COLINDANCIAS SEG&Uacute;N T&Iacute;TULO</th>
          </tr>
        </thead>
        <tbody>
         <tr class="normal">
           <td class="principal"><b>&nbsp;&nbsp;&nbsp;</b>FRENTE</td>
           <td colspan="2" align="center"><?php echo trim($row7_1['fren_campo']); ?></td>
           <td colspan="2" align="center"><?php echo trim($row7_1['fren_titulo']); ?></td>
           <td colspan="2" align="center"><?php echo trim($row7_1['fren_colinda_campo']); ?></td>
           <td colspan="2" align="center"><?php echo trim($row7_1['fren_colinda_titulo']); ?></td>
          </tr>
          <tr class="normal">
           <td class="principal"><b>&nbsp;&nbsp;&nbsp;</b>DERECHA</td>
           <td colspan="2" align="center"><?php echo trim($row7_1['dere_campo']); ?></td>
           <td colspan="2" align="center"><?php echo trim($row7_1['dere_titulo']); ?></td>
           <td colspan="2" align="center"><?php echo trim($row7_1['dere_colinda_campo']); ?></td>
           <td colspan="2" align="center"><?php echo trim($row7_1['dere_colinda_titulo']); ?></td>
          </tr>
          <tr class="normal">
           <td class="principal"><b>&nbsp;&nbsp;&nbsp;</b>IZQUIERDA</td>
           <td colspan="2" align="center"><?php echo trim($row7_1['izqu_campo']); ?></td>
           <td colspan="2" align="center"><?php echo trim($row7_1['izqu_titulo']);?></td>
           <td colspan="2" align="center"><?php echo trim($row7_1['izqu_colinda_campo']);?></td>
           <td colspan="2" align="center"><?php echo trim($row7_1['izqu_colinda_titulo']); ?></td>
          </tr>
          <tr class="normal">
           <td class="principal"><b>&nbsp;&nbsp;&nbsp;</b>FONDO</td>
           <td colspan="2" align="center"><?php echo trim($row7_1['fond_titulo']); ?></td>
           <td colspan="2" align="center"><?php echo trim($row7_1['fond_campo']); ?></td>
           <td colspan="2" align="center"><?php echo trim($row7_1['fond_colinda_campo']); ?></td>
           <td colspan="2" align="center"><?php echo trim($row7_1['fond_colinda_titulo']); ?></td>
          </tr>
        </tbody>       
 </table>

 <!--OK servicios basicos-->   
 <table width="720px" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" class="Estilo2">
     <tr>
      <td>
       <table width="720px" border="0" align="center" cellpadding="0" cellspacing="0" class="Estilo2">
        <tr><td class="etiquetanegra" colspan="6" height="30">&nbsp;<strong>SERVICIOS B&Aacute;SICOS:</strong></td></tr>
        <tr>
         <td width="5%" class="etiqueta" height="14" align="center"><img src="../../img/casilla_azul/67.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
         <td width="15%" class="etiqueta">LUZ</td>
         <td width="34%" class="etiqueta"><?php if ($row8['luz']==1)  { echo '(X)';} else { echo '(_)';}?></td>
         <td width="5%" class="etiqueta" height="14" align="center"><img src="../../img/casilla_azul/68.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
         <td width="15%" class="etiqueta">AGUA</td>
         <td width="25%" class="etiqueta"><?php if ($row8['agua']==1) { echo '(X)';} else { echo '(_)';}?></td>
        </tr>
        <tr>
         <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/69.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
         <td class="etiqueta">TEL&Eacute;FONO</td><td class="etiqueta"><?php if ($row8['telefono']==1) echo '(X)'; else { echo '(_)';}?></td>
         <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/70.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
         <td class="etiqueta">DESAGUE</td><td class="etiqueta"><?php if ($row8['desague']==1) echo '(X)'; else { echo '(_)';}?></td>
        </tr>
        <tr>
         <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/71.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
         <td class="etiqueta">Nro. SUMINISTRO LUZ</td><td ><?php echo trim($row8['nume_sum_luz']); ?></td>
         <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/72.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
         <td class="etiqueta">Nro. CONTRATO AGUA</td><td><?php echo trim($row8['nume_contrato_agua']); ?></td>
        </tr>
        <tr>
          <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/73.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
          <td class="etiqueta">Nro. TEL&Eacute;FONO</td><td colspan="4"><?php echo trim($row8['nume_telefono']); ?></td>
        </tr> 
       </table>
      </td>
     </tr>
 </table> 

 <!--OK construcciones-->
 <table width="720px" border="0" align="center" cellPadding="0" cellSpacing="0" bordercolor="#000000" class="Estilo2" >
  <tr><td></td></tr> 
 </table>
 <table width="720px" border="0" align="center" cellpadding="0" cellspacing="0" class="Estilo2">
     <tr>
      <td colspan="2" valign="top">
       <table id="construccion" width="720px" border="1" align="center" cellpadding="0" cellspacing="0">
        <thead>
         <tr><td class="etiquetanegra" colspan="15" height="10">&nbsp;<strong>CONSTRUCCIONES:</strong></td></tr>
         <tr>
          <th class="secundario Estilo9" width="7%" rowspan="2" ><img src="../../img/casilla_azul/74.png" alt="Guardar estado?" width="17" height="17" border="0" /></th>
          <th class="secundario Estilo9" width="7%" rowspan="2" ><img src="../../img/casilla_azul/75.png" alt="Guardar estado?" width="17" height="17" border="0" /></th>
          <th class="secundario Estilo9" width="3%" rowspan="2" ><img src="../../img/casilla_azul/76.png" alt="Guardar estado?" width="17" height="17" border="0" /></th>
          <th class="secundario Estilo9" width="3%" rowspan="2" ><img src="../../img/casilla_azul/77.png" alt="Guardar estado?" width="17" height="17" border="0" /></th>
          <th class="secundario Estilo9" width="3%" rowspan="2" ><img src="../../img/casilla_azul/78.png" alt="Guardar estado?" width="17" height="17" border="0" /></th>
          <th class="secundario Estilo9"colspan="7" scope="col">CATEGOR&Iacute;AS</th>
          <th class="secundario Estilo9" colspan="2" scope="col">AREA CONSTRU&Iacute;DA (M2)</th>
          <th class="secundario Estilo9" width="28%" rowspan="3" ><img src="../../img/casilla_azul/88.png" alt="Guardar estado?" width="17" height="17" border="0" /></th>          
         </tr>
         <tr>
          <th height="14" colspan="2" class="secundario Estilo9">ESTRUCTURA</th>
          <th colspan="4" class="secundario Estilo9">ACABADOS</th>
          <th class="secundario Estilo9" width="7%" rowspan="2"><img src="../../img/casilla_azul/85.png" alt="Guardar estado?" width="17" height="17" border="0" /></th>
          <th class="secundario Estilo9" width="7%" rowspan="2"><img src="../../img/casilla_azul/86.png" alt="Guardar estado?" width="17" height="17" border="0" /></th>
          <th class="secundario Estilo9" width="7%" rowspan="2" ><img src="../../img/casilla_azul/87.png" alt="Guardar estado?" width="17" height="17" border="0" /></th>
         </tr>
         <tr >
          <th width="6%" class="secundario Estilo9" rowspan="2" >N&ordm; PISO SOTANO MEZZANINE</th>
          <th width="7%" class="secundario Estilo9" rowspan="2" >FECHA CONSTRUCi&Oacute;N</th>
          <th width="3%" class="secundario Estilo9" rowspan="2" >MEP</th>
          <th width="3%" class="secundario Estilo9" rowspan="2" >ECS</th>
          <th width="3%" class="secundario Estilo9" rowspan="2" >ECC</th>
          <th width="7%" class="secundario Estilo9" height="14"><img src="../../img/casilla_azul/79.png" alt="Guardar estado?" width="17" height="16" border="0" /></th>
          <th width="7%" class="secundario Estilo9"><img src="../../img/casilla_azul/80.png" alt="Guardar estado?" width="17" height="17" border="0" /></th>
          <th width="7%" class="secundario Estilo9"><img src="../../img/casilla_azul/81.png" alt="Guardar estado?" width="17" height="17" border="0" /></th>
          <th width="7%" class="secundario Estilo9"><img src="../../img/casilla_azul/82.png" alt="Guardar estado?" width="17" height="17" border="0" /></th>
          <th width="7%" class="secundario Estilo9"><img src="../../img/casilla_azul/83.png" alt="Guardar estado?" width="17" height="17" border="0" /></th>
          <th width="6%" class="secundario Estilo9"><img src="../../img/casilla_azul/84.png" alt="Guardar estado?" width="17" height="17" border="0" /></th>
         </tr>
         <tr >
          <th width="7%" class="secundario Estilo9">MUROS Y COLUMNAS</th>
          <th width="7%" class="secundario Estilo9">TECHOS</th>
          <th width="7%" class="secundario Estilo9">PISOS</th>
          <th width="7%" class="secundario Estilo9">PUERTAS Y VENTANAS</th>
          <th width="7%" class="secundario Estilo9">REVEST.</th>
          <th width="7%" class="secundario Estilo9">BA&Ntilde;OS</th>
          <th width="7%" class="secundario Estilo9">INST. EL&Eacute;CT. Y SANITARIAS</th>
          <th width="7%" class="secundario Estilo9">DECLARADA</th>
          <th width="7%" class="secundario Estilo9">VERIFICADA</th>
          <th width="6%" class="secundario Estilo9">UCA</th>
         </tr>
         <tr class="principal">
          <td  class="celda" align="left" colspan="15">
           <?php            
            //---------------------------------------------------------------- CONSTRUCCIONES   
           if($con_c<0) //no hay registros
           {
                     echo "<div id='linea2_0'  style='width:720px'>";
                     echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                     echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                     echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                     echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                     echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                     echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                     echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                     echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                     echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                     echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                     echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                     echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                     echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                     echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                     echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; 
                     echo "</div>";
              }   
              else
              { 
                 $indice2=0;
                  while($row9=pg_fetch_array($consulta_c))
                  {  
                    echo "<div id='linea2_".$indice2."'  style='width:720px'>";
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; echo trim($row9['nume_piso']);
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; echo $row9['fecha'];
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; echo trim($row9['mep']);
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; echo trim($row9['ecs']);
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; echo trim($row9['ecc']);
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; echo trim($row9['estr_muro_col']);
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; echo trim($row9['estr_techo']);
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; echo trim($row9['acab_piso']);
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; echo trim($row9['acab_puerta_ven']);
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; echo trim($row9['acab_revest']);
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; echo trim($row9['acab_bano']);
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; echo trim($row9['inst_elect_sanita']);
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; echo trim($row9['area_declarada']);
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; echo trim($row9['area_verificada']);
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; generaCombo(29);                 
                    echo "</div>";
                    $indice2++; 
                   }
                 }
                ?>
          </td>
         </tr>        
        </thead>                                 
       </table>                          
      </td>
     </tr>
 </table> 
   

 <table width="720px" border="1" align="center" cellPadding="0" cellSpacing="0" bordercolor="#000000" class="Estilo2" >
  <tr>
   <td> 
    <table width="720px" border="0" align="center" cellpadding="0" cellspacing="0" class="Estilo2">
     <tr class="principal">
      <td width="2%" height="14" class="etiquetanegra"><img src="../../img/casilla_azul/89.png" alt="Guardar estado?" width="17" height="16" border="0" /></td>
      <td width="10%" class="etiquetanegra"><strong>PORCENTAJE DE BIEN COM&Uacute;N</strong></td>
     </tr>
     <tr class="principal">
      <td width="10%" height="14" class="etiqueta">TERRENO LEGAL</td>
      <td width="40%"><?php if($row7['porc_bc_terr_legal']==0.00) { echo ''; } else echo trim($row7['porc_bc_terr_legal']); ?></td>
      <td width="10%" class="etiqueta">TERRENO F&Iacute;SICO</td>
      <td width="40%" class="tabla"><?php if($row7['porc_bc_terr_fisc']==0.00){ echo ''; } else echo trim($row7['porc_bc_terr_fisc']); ?></td>
     </tr>
     <tr class="principal">
      <td class="etiqueta">CONSTRUCCI&Oacute;N LEGAL</td><td><?php if($row7['porc_bc_const_legal']==0.00){ echo ''; } else echo trim($row7['porc_bc_const_legal']); ?></td>
      <td class="etiqueta">CONSTRUCCI&Oacute;N F&Iacute;SICA</td><td><?php if($row7['porc_bc_const_fisc']==0.00){ echo ''; } else echo trim($row7['porc_bc_const_fisc']); ?></td>
     </tr>
    </table>  
   </td>
  </tr> 
 </table> 

 <!--OK obras complementarias-->
 <table width="720px" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" class="Estilo2">
  <tr><td></td></tr> 
 </table>
 <table width="713px" border="1" align="center" cellpadding="0" cellspacing="0" class="Estilo2">
  <thead>
   <tr><td colspan="12" height="30">&nbsp;<strong>OBRAS COMPLEMENTARIAS / OTRAS INSTALACIONES:</strong></td></tr>
   <tr class="principal">
    <td class="secundario Estilo9" width="5.8%" align="center"><img src="../../img/casilla_azul/90.png" alt="Guardar estado?" width="17" height="16" border="0" /></td>
    <td class="secundario Estilo9" width="30%" scope="col" align="center"><img src="../../img/casilla_azul/91.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
    <td class="secundario Estilo9" width="12.53%" scope="col" align="center"><img src="../../img/casilla_azul/75.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
    <td class="secundario Estilo9" width="6.76%" scope="col" align="center"><img src="../../img/casilla_azul/76.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
    <td class="secundario Estilo9" width="6.76%" scope="col" align="center"><img src="../../img/casilla_azul/77.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
    <td class="secundario Estilo9" width="6.27%" scope="col" align="center"><img src="../../img/casilla_azul/78.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
    <td class="secundario Estilo9" width="9.3%" colspan="3" scope="col" align="center"><strong>DIMENSIONES VERIFICADAS</strong></div></td>
    <td class="secundario Estilo9" ="8.36%" scope="col" align="center"><img src="../../img/casilla_azul/95.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
    <td class="secundario Estilo9" width="6.39%" scope="col" align="center"><img src="../../img/casilla_azul/96.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
    <td class="secundario Estilo9" width="5.03%" scope="col" align="center"><img src="../../img/casilla_azul/88.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>         
   </tr>
   <tr class="principal">
    <th class="secundario Estilo9" width="5.8%" rowspan="2" scope="col">CODIGO</th>
    <th class="secundario Estilo9" ="30%" rowspan="2" scope="col">DESCRIPCI&Oacute;N</th>
    <th class="secundario Estilo9" width="12.24%" rowspan="2" scope="col">FECHA DE CONSTRUCCION</th>
    <th class="secundario Estilo9" ="6.6%" rowspan="2" scope="col">MEP</th>
    <th class="secundario Estilo9" width="6.6%" rowspan="2" scope="col">ECS</th>
    <th class="secundario Estilo9" width="6.12%" rowspan="2" scope="col">ECC</th>
    <th class="secundario Estilo9" width="3.3%" scope="col" class="secundario"><img src="../../img/casilla_azul/89.png" alt="Guardar estado?" width="17" height="17" border="0" /></th>
    <th class="secundario Estilo9" width="3.3%" scope="col"class="secundario"><img src="../../img/casilla_azul/89.png" alt="Guardar estado?" width="17" height="17" border="0" /></th>
    <th class="secundario Estilo9" width="3.3%" scope="col"class="secundario"><img src="../../img/casilla_azul/89.png" alt="Guardar estado?" width="17" height="17" border="0" /></th>
    <th class="secundario Estilo9" width="8.16%" rowspan="2" scope="col">PRODUCTO TOTAL</th>
    <th class="secundario Estilo9" width="6.24%" rowspan="2" scope="col">UNIDAD DE MEDIDA</th>
    <th class="secundario Estilo9" width="4.92%" rowspan="2" scope="col">UCA</th>
   </tr>                    
   <tr class="principal">
    <th class="secundario Estilo9" width="3.3%" scope="col" height="12">LARGO</th>
    <th class="secundario Estilo9" width="3.3%" scope="col" height="12">ANCHO</th>
    <th class="secundario Estilo9" width="3.3%" scope="col" height="12">ALTO</th>
   </tr>
  </thead>
  <tbody>
   <tr class="normal">
    <td colspan="12" align="left">  
     <?php            
      if($con_i<0) //no hay registros
      {        
        echo "<div id='linea3_0'  style='width:720px'>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";        
        echo "</div>";           
      }
      else
      {                      
         $indice3=0;
         while($row10=pg_fetch_array($consulta_i))
         { 
          $obra=trim($row10['codi_instalacion']);
          $Consulta10_1="SELECT desc_instalacion FROM tf_codigos_instalaciones WHERE codi_instalacion = '$obra'";
          $consulta_obra= $BD->Consultas($Consulta10_1);
          $row10_1=pg_fetch_array($consulta_obra);

          echo "<div id='linea3_".$indice3."' style='width:720px'>";
          echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; echo trim($row10['codi_instalacion']);
          echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; echo trim($row10_1['desc_instalacion']);
          echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; echo trim($row10['fecha']);
          echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; echo trim($row10['mep']);
          echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; echo trim($row10['ecs']);
          echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; echo trim($row10['ecc']);
          echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; echo trim($row10['dime_largo']);
          echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; echo trim($row10['dime_ancho']);
          echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; echo trim($row10['dime_alto']);
          echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; echo trim($row10['prod_total']);
          echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; echo trim($row10['uni_med']);
          echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; generaCombo(33); 
          echo "</div>";
          $indice3++; 
         }
      }                
     ?>
    </td>
   </tr>
  </tbody>            
 </table>         
 

 <!--OK DOCUMENTOS-->
 <table width="720px" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" class="Estilo2">
  <tr><td></td></tr> 
 </table>
 <table width="720px" border="0" align="center" cellpadding="0" cellspacing="0" class="Estilo2">
  <tr>
   <td colspan="2" valign="top">
    <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
     <thead>
      <tr><td class="etiquetanegra" colspan="8" height="30">&nbsp;<strong>DOCUMENTOS:</strong></td></tr>
      <tr class="secundario Estilo9">        
        <th width="5.7%"><img src="../../img/casilla_azul/97.png" alt="Guardar estado?" width="17" height="17" border="0" /></th>
        <th class="secundario Estilo9" width="34.1%">TIPO DE DOCUMENTO</th>
        <th width="3.7%"><img src="../../img/casilla_azul/98.png" alt="Guardar estado?" width="17" height="17" border="0" /></th>
        <th class="secundario Estilo9" width="11.9%">NRO. DE DOCUMENTO</th>
        <th width="3.7%"><img src="../../img/casilla_azul/99.png" alt="Guardar estado?" width="17" height="17" border="0" /></th>
        <th class="secundario Estilo9" width="14.7%">FECHA</th>
        <th width="3.7%"><img src="../../img/casilla_azul/100.png" alt="Guardar estado?" width="17" height="17" border="0" /></th>
        <th class="secundario Estilo9" width="22.5%">AREA AUTORIZADA</th>
      </tr>
     </thead>
     <tbody>
      <tr class="normal">
       <td colspan="8" class="celda" align="left">
       <?php   
        //---------------------------------------------------------------- DOCUMENTOS   
        if($con_d<0) //no hay registros
        {
         echo " <div id='linea4_0'style='width:720px'>";
         echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
         echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
         echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
         echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";         
         echo "</div>";   
        }
        else
        {         
         $indice4=0;
         while($row11=pg_fetch_array($consulta_d))
         {    
          echo "<div id='linea4_".$indice4."' style='width:720px'>";
          echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; generaCombo(34);           
          echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; echo trim($row11['nume_doc']);
          echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; echo trim($row11['fecha_doc']);
          echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; echo trim($row11['area_autorizada']);
          echo "</div>";
          $indice4++; 
         }
        }
       ?>  
       </td>
      </tr>
     </tbody>
    </table>                          
   </td>
  </tr> 
 </table>
  
 <table width="720px" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" class="Estilo2">
  <tr>
   <td>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="Estilo2">
     <tr><td colspan="8" class="etiquetanegra">&nbsp;&nbsp;<strong>REGISTRO NOTARIAL DE LA ESCRITURA P&Uacute;BLICA:</strong></td></tr>
     <tr>
      <td width="5%" class="etiqueta" height="14" align="center"><img src="../../img/casilla_azul/101.png" alt="Guardar estado?" width="17" height="16" border="0" /></td>
      <td width="15%" class="etiqueta">NOMBRE DE LA NOTARIA</td>
      <td width="31%"><?php generaCombo(15); ?></td>
     </tr>
     <tr>
      <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/102.png" alt="Guardar estado?" width="17" height="16" border="0" /></td>
      <td height="14" class="etiqueta">KARDEX</td>
      <td width="31%"><?php echo trim($row11_1['kardex']); ?>
      <td width="3%" class="etiqueta" height="14" align="center"><img src="../../img/casilla_azul/103.png" alt="Guardar estado?" width="17" height="16" border="0" /></td>
      <td width="16%" class="etiqueta">FECHA ESCRITURA P&Uacute;BLICA</td>
      <td width="30%" >"<?php echo trim($row11_1['fecha_escritura']); ?>
     </tr>
    </table>
   </td>
  </tr> 
 </table>

 <!--OK INSCRIPCIoN DEL PREDIO CATASTRAL EN EL REGISTRO DE PREDIOS -->
 <table width="720px" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" class="Estilo2">
     <tr>
      <td>
       <table width="720px" border="0" align="center" cellpadding="0" cellspacing="0" class="Estilo2">
        <tr><td class="etiquetanegra" colspan="6" height="30">&nbsp;<strong>INSCRIPCI&Oacute;N DEL PREDIO CATASTRAL EN EL REGISTRO DE PREDIOS:</strong></td></tr>
        <tr>
         <td width="5%" class="etiqueta" height="14" align="center"><img src="../../img/casilla_azul/104.png" alt="Guardar estado?" width="17" height="16" border="0" /></td>
         <td width="15%" class="etiqueta">TIPO PARTIDA REGISTRAL</td>
         <td width="31%"><?php generaCombo(16); ?></td>
         <td width="3%" class="etiqueta" height="14" align="center"><img src="../../img/casilla_azul/105.png" alt="Guardar estado?" width="17" height="16" border="0" /></td>
         <td width="16%" class="etiqueta">N&Uacute;MERO</td>
         <td width="30%"><?php echo trim($row12['nume_partida']); ?></td>
        </tr>
        <tr>
         <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/106.png" alt="Guardar estado?" width="17" height="16" border="0" /></td>
         <td height="14" class="etiqueta">FOJAS</td><td><?php echo trim($row12['fojas']); ?></td>
         <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/107.png" alt="Guardar estado?" width="17" height="16" border="0" /></td>
         <td height="14" class="etiqueta">ASIENTO</td><td><?php echo trim($row12['asiento']); ?></td>
        </tr>
        <tr>
         <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/108.png" alt="Guardar estado?" width="17" height="16" border="0" /></td>
         <td height="14" class="etiqueta">FECHA INSCRIPCI&Oacute;N PREDIO</td>
         <td>
          <?php 
          if($row12['fech_inscripcion']=='31/12/1969')
          { echo '';}
            else echo trim($row12['fech_inscripcion']); ?>
          <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/109.png" alt="Guardar estado?" width="17" height="16" border="0" /></td>
          <td height="14" class="etiqueta">DECLARATORIA DE F&Aacute;BRICA</td><td><?php generaCombo(17); ?></td>
        </tr>
        <tr>
          <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/110.png" alt="Guardar estado?" width="17" height="16" border="0" /></td>
          <td height="14" class="etiqueta">AS. INS. DE F&Aacute;BRICA</td>
          <td><?php echo trim($row12['asie_fabrica']); ?></td>
          <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/111.png" alt="Guardar estado?" width="17" height="16" border="0" /></td>
          <td height="14" class="etiqueta">FECHA INSCRIPCI&Oacute;N F&Aacute;BRICA</td>
          <td>
           <?php  if($row12['fecha_fabrica']=='31/12/1969')
           { echo '';}
           else echo trim($row12['fecha_fabrica']); ?>
        </tr>       
       </table>
      </td>
     </tr>
 </table>
   
 <!--ok EVALUACION DEL PREDIO CATASTRAL --> 
<table width="720px" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" class="Estilo2">
 <tr>
  <td>
   <table width="720px" border="0" align="center" cellpadding="0" cellspacing="0" class="Estilo2">
    <tr><td colspan="6" class="etiquetanegra" height="30">&nbsp;<strong>EVALUACI&Oacute;N DEL PREDIO CATASTRAL</strong></td></tr>
    <tr>
     <td width="5%" height="14" class="etiquetanegra" align="center"><img src="../../img/casilla_azul/112.png" alt="Guardar estado?" width="17" height="16" border="0" /></td>
     <td height="14" colspan="4" class="etiquetanegra">&nbsp;EVALUACI&Oacute;N DEL PREDIO CATASTRAL:</td>
    </tr>
    <tr>
     <td colspan="1">&nbsp;</td> 
     <td colspan="2"><?php if(trim($row13['evaluacion'])=='01') { echo '(X)';} else { echo '(_)';}?> PREDIO CATASTRAL OMISO</td>
     <td colspan="3"><?php if(trim($row13['evaluacion'])=='02') { echo '(X)';} else { echo '(_)';}?> PREDIO CATASTRAL SUBVALUADO</td>
    </tr>
    <tr> 
     <td colspan="1">&nbsp;</td> 
     <td colspan="2"><?php if(trim($row13['evaluacion'])=='03') { echo '(X)';} else { echo '(_)';}?> PREDIO CATASTRAL SOBREVALUADO</td>
     <td colspan="3"><?php if(trim($row13['evaluacion'])=='04') { echo '(X)';} else { echo '(_)';}?> PREDIO CATASTRAL CONFORME</td>
    </tr>
    <tr>
     <td class="etiquetanegra" height="14" align="center"><img src="../../img/casilla_azul/113.png" alt="Guardar estado?" width="17" height="16" border="0" /></td>
     <td height="14" colspan="4" class="etiquetanegra">&nbsp;&Aacute;REA DE TERRENO INVADIDA (M2):</td>
    </tr>
    <tr>
     <td height="14" class="etiqueta">&nbsp;</td>
     <td width="24%" height="14" class="etiqueta">&nbsp;EN LOTE COLINDANTE</td>
     <td width="22%"><?php if($row13['en_colindante']==0.00){ echo '';}else echo trim($row13['en_colindante']); ?></td>
     <td width="19%" class="etiqueta" height="14">EN &Aacute;REA P&Uacute;BLICA</td>
     <td width="30%"><?php if($row13['en_jardin_aislamiento']==0.00){ echo '';}else echo trim($row13['en_jardin_aislamiento']); ?></td>
    </tr>
    <tr>
     <td height="14" class="etiqueta">&nbsp;</td>
     <td height="14" class="etiqueta">&nbsp;EN JARD&Iacute;N DE AISLAMIENTO</td>
     <td width="22%"><?php if($row13['en_area_publica']==0.00){ echo '';}else echo trim($row13['en_area_publica']); ?></td>
     <td width="19%" class="etiqueta" height="14">EN &Aacute;REA INTANGIBLE</td>
     <td ><?php if($row13['en_area_intangible']==0.00){ echo '';}else echo trim($row13['en_area_intangible']); ?></td>
    </tr>    
   </table> 
  </td>
 </tr>
</table>
 
 <!--ok informacioncomplementaria -->
 <table width="720px" border="1" align="center" cellPadding="0" cellSpacing="0" bordercolor="#000000" class="clsTabla2">
  <tr>
   <td>
    <table width="720px" border="0" align="center" cellpadding="0" cellspacing="0" class="Estilo2">
     <tr><td class="etiquetanegra" colspan="5" height="30">&nbsp;<strong>INFORMACI&Oacute;N COMPLEMENTARIA: </strong></td></tr>
     <tr>
         <td width="4%" class="etiqueta" height="14" align="center"><img src="../../img/casilla_azul/114.png" alt="Guardar estado?" width="17" height="16" border="0" /></td>
         <td width="17%" class="etiqueta">CONDICI&Oacute;N DE DECLARANTE</td>
         <td colspan="5"><?php generaCombo(18); ?></td>
     </tr>
     <tr><td height="10" colspan="5" class="etiqueta">&nbsp;</td></tr>
     <tr>
          <td height="14" class="etiquetanegra" align="center"><img src="../../img/casilla_azul/115.png" alt="Guardar estado?" width="17" height="16" border="0" /></td>
          <td colspan="5" class="etiquetanegra">&nbsp;IDENTIFICACI&Oacute;N DE LOS LITIGANTES: </td>
     </tr>
    </table> 
   </td>
  </tr>
 </table> 
 <table width="720px" border="0" align="center" cellPadding="0" cellSpacing="0" bordercolor="#000000" class="clsTabla2">
  <tr>
   <td colspan="5"> 
    <table width="720px" border="1" align="center" cellpadding="0" cellspacing="0" class="Estilo2">
     <thead>
      <tr class="secundario Estilo9">
       <th class="secundario Estilo9" width="25%">TIPO DE DOCUMENTO</th>
       <th class="secundario Estilo9" width="25%">Nro. DE DOCUMENTO</th>
       <th class="secundario Estilo9" width="25%">APELLIDOS Y NOMBRES DE LOS LITIGANTES</th>
       <th class="secundario Estilo9" width="25%">C&Oacute;DIGO DEL CONTRIBUYENTE</th>
      </tr>  
               
      <tr class="normal">
       <td colspan="4" align="left">
       <?php   
       //---------------------------------------------------------------- LITIGANTES   
       if($con_li<0) //no hay registros
       {
        echo " <div id='linea5_0'style='width:720px'>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";              
        echo "</div>";
       }
       else
       {        
        $indice5=0;
        while($row14=pg_fetch_array($consulta_li))
        { 
         echo "<div id='linea5_".$indice5."' style='width:720px'>";
         echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; generaCombo(35); 
         echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; echo trim($row14['nume_doc']);
         echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; echo trim($row14['razon_social']);
         echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; echo trim($row14['codi_contribuye']);
         echo "</div>";
         $indice5++; 
        }
       }
       ?> 
       </td>
      </tr>
     </thead>
    </table>              
   </td>
  </tr>
 </table> 
 <table width="720px" border="1" align="center" cellPadding="0" cellSpacing="0" bordercolor="#000000" class="clsTabla2">
  <tr>
    <td>
      <table width="720px" border="0" align="center" cellpadding="0" cellspacing="0" class="Estilo2">
        <tr>
         <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_roja/116.png" alt="Guardar estado?" width="17" height="16" border="0" /></td>
         <td height="14" class="etiqueta">ESTADO DE LA FICHA</td>
         <td width="29%"><?php generaCombo(19); ?></td>
         <td width="3%" height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/117.png" alt="Guardar estado?" width="17" height="16" border="0" /></td>
         <td width="18%" height="14" class="etiqueta">Nro. DE HABITANTES</td>
         <td width="29%"><?php if($row13['nume_habitantes']==0){ echo '';}else echo trim($row13['nume_habitantes']); ?></td>
        </tr>
        <tr>
         <td height="14" class="etiqueta" align="center"><img src="../../img/casilla_azul/118.png" alt="Guardar estado?" width="17" height="16" border="0" /></td>
         <td height="14" class="etiqueta">Nro. DE FAMILIAS</td><td><?php if($row13['nume_familias']==0){ echo '';}else echo trim($row13['nume_familias']); ?></td>
         <td align="center"><img src="../../img/casilla_azul/119.png" alt="Guardar estado?" width="17" height="16" border="0" /></td>
         <td class="etiqueta">MANTENIMIENTO</td><td><?php generaCombo(20); ?></td>
        </tr>
      </table> 
    </td>
  </tr>
</table>

 <!--ok OBSERVACIONES -->
 <table width="720px" border="1" align="center" cellPadding="0" cellSpacing="0" bordercolor="#000000" class="clsTabla2">
     <tr>
      <td>
       <table width="720px" border="0" align="center" cellpadding="0" cellspacing="0" class="Estilo2">
        <tr><td class="etiquetanegra" colspan="4" height="30">&nbsp;<strong>OBSERVACIONES:</strong></td></tr>
        <tr>
         <td width="20%" class="etiqueta" height="14">&nbsp;&nbsp;OBSERVACIONES</td>
         <td colspan="3"><?php echo trim($row13['observaciones']);?></td>
        </tr>        
       </table>
      </td>
     </tr>
 </table>

 <!--ok FIRMAS-->
 <table width="720px"  border="1" align="center" cellPadding="0"cellSpacing="0" bordercolor="#000000" class="clsTabla2">
     <tr>
      <td>
       <table width="720px" border="0" align="center" cellpadding="0" cellspacing="0" class="Estilo2">
        <tr><td height="30" class="etiquetanegra" colspan="5" >&nbsp;<strong>FIRMAS: </strong></td></tr>
        <tr>
         <td width="7.2%" height="14" class="etiquetanegra" align="center"><img src="../../img/casilla_azul/120.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
         <td width="30.2%" class="etiquetanegra" colspan="3"><strong>DECLARANTE</strong></td>
         <td height="14" class="etiquetanegra" >&nbsp;</td>
         <td height="14" class="etiquetanegra" >&nbsp;</td>
         <td width="62.6%" height="14" class="etiquetanegra">&nbsp;</td>
        </tr>
        <?php 
          $cadena=$row15['declarante'];
          $maximo = strlen($cadena);
          $cadena_comienzo = "(";
          $cadena_fin = ")";
          $total = strpos($cadena,$cadena_comienzo);
          $total2 = strpos($cadena,$cadena_fin);
          $total3 = ($maximo - $total2 - 1);
          $dni = substr ($cadena,$total,-$total3);
          $maximo = strlen($dni);
          $dni = substr ($dni,1,$maximo-2);
          $cadena_comienzo = "- ";
          $cadena_fin = ",";
          $total = strpos($cadena,$cadena_comienzo);
          $total2 = strpos($cadena,$cadena_fin);
          $total3 = ($maximo - $total2 - 1);
          $nombres = substr ($cadena,$total,-$total3);
          $maximo = strlen($nombres);
          // la variable $maxino no esta declarada, se cambió por $maximo
          $nombres = substr ($nombres,2,$maximo-2);
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
        ?>
        <tr>
           <td rowspan="3" class="etiqueta">&nbsp;</td>
           <td width="25%" class="etiqueta">DNI</td>
           <td width="25%"><?php echo $dni;?></td>
           <td width="25%" class="etiqueta" height="14">NOMBRES</td>
           <td width="25%"><?php echo $nombres;?></td>
        </tr>
        <tr>         
           <td class="etiqueta">APELLIDO PATERNO</td><td><?php echo $paterno;?></td>
           <td class="etiqueta" height="14">APELLIDO MATERNO</td><td><?php echo $materno;?></td>
        </tr>
        <tr>
           <td class="etiqueta">FECHA</td><td colspan="3"><?php if($row15['fecha_declarante']=='1970-01-01'){ echo '';} else echo trim($row15['fecha_declarante']); ?>
        </tr>
        <tr>
           <td class="etiquetanegra" height="14" align="center"><img src="../../img/casilla_azul/121.png" alt="Guardar estado?" width="17" height="16" border="0" /></td>
           <td class="etiquetanegra" colspan="3"><strong>SUPERVISOR</strong></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
        </tr>
        <tr>
           <td>&nbsp;</td>
           <td class="etiqueta">NOMBRES Y APELLIDOS</td><td><?php generaCombo(21); ?></td>
           <td class="etiqueta">FECHA</td><td><?php if($row15['fecha_supervision']=='1970-01-01'){ echo '';}else echo trim($row15['fecha_supervision']); ?></td>
        </tr>
        <tr>
           <td class="etiquetanegra" height="14" align="center"><img src="../../img/casilla_roja/122.png" alt="Guardar estado?" width="17" height="16" border="0" /></td>
           <td class="etiquetanegra" colspan="3"><strong>T&Eacute;CNICO CATASTRAL</strong></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>           
        </tr>
        <tr>
           <td>&nbsp;</td>
           <td class="etiqueta">NOMBRES Y APELLIDOS</td><td><?php generaCombo(22); ?></td>
           <td class="etiqueta">FECHA</td><td><?php echo trim($row15['fecha_levantamiento']); ?></td>
        </tr>
        <tr>
           <td class="etiquetanegra" height="14" align="center"><img src="../../img/casilla_azul/123.png" alt="Guardar estado?" width="17" height="16" border="0" /></td>
           <td class="etiquetanegra" colspan="3"><strong>VERIFICADOR CATASTRAL</strong></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>           
        </tr>
        <tr>
           <td>&nbsp;</td>
           <td class="etiqueta">NOMBRES Y APELLIDOS</td><td><?php generaCombo(23); ?></td>
           <td class="etiqueta">FECHA</td><td colspan="3"><?php if($row15['fecha_verificacion']=='1970-01-01'){ echo '';} else echo trim($row15['fecha_verificacion']); ?></td>
        </tr>
        <tr>
           <td>&nbsp;</td>
           <td height="14" class="etiqueta">N&deg; REGISTRO</td><td colspan="3"><?php echo trim($row15['nume_registro']); ?></td>
        </tr>        
       </table>
      </td>
     </tr>
 </table>      

    
</body> 