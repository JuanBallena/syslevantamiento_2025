<?php 
// para evitar este mensaje  A session had already been started
//session_start();

//header("Content-type: text/html; charset=utf-8");
include '../funciones/kill_sesion.php'; //matamos sesiones existentes de codigo referencial
//include '../funciones/verifica_ubigeo.php'; //sesiones de UBIGEO
include '../funciones/genera_dep.php';
include '../configuracion/eventos.php';
include 'proceso_ind/I_combos_editados.php';
?>

<!-- CODIGO AGREGADO-->
<script type="text/javascript" language="javascript" src="../js/datos_minimos_I.js"></script>
<script type="text/javascript" language="javascript" src="../js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="../js/jquery.addfield.js"></script>
<script type="text/javascript" language="javascript" src="../js/funciones_validar.js"></script>
<script type="text/javascript" language="javascript" src="../js/valida_clones.js"></script>
<script type="text/javascript" language="javascript" src="../js/valida_campo.js"></script>
<script type="text/javascript" language="javascript" src="../js/valida_campos_titular.js"></script>
<script type="text/javascript" language="JavaScript" src="../js/popcalendar.js"></script>
<script type="text/javascript" language="javascript" src="../js/cascade.js" ></script>
<script type="text/javascript" language="javascript" src="../js/mascara.js"></script>
<!--<script type="text/javascript" src="../js/no_f5.js"></script> -->
<script type="text/javascript" src="../js/imprimir.js"></script>

<link href="../css/estilo_form.css" rel="stylesheet" type="text/css"/>
<link href="../css/link.css" rel="stylesheet" type="text/css">
<link href="../css/tabla.css" rel="stylesheet" type="text/css">
<link href="../css/botones.css" rel="stylesheet" type="text/css">
<link href="../css/combos.css" rel="stylesheet" type="text/css">
<link href="../css/popcalendar.css" rel="stylesheet" type="text/css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
	<title>Ficha Catastral Urbana Individual / ST-SNCP SECRETARIA TÉCNICA</title>
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
		.Estilo9 {font-size: 9px}
		.Estilo10 {font-size: 8px}
		.Estilo11 {font-family: Verdana, Arial, Helvetica, sans-serif}
		-->
	</style>
</head>
<body onLoad="javascript:edit_ponerfoco_1()" onkeypress="javascript:if(event.keyCode==13)return false;" ><!-- en mascara.js-->
	<div align="center">
		<form  name="datos"   method="post" >
		<!--<form  class="myform" name="datos" method="post" action="proceso_ind/I_graba_individual.php?pag=?php echo $cad;?>" onSubmit="return datos_minimos_individual()" autocomplete="off">!-->
	<div align="center">

<table width="980px" border="0" cellpadding="0" cellspacing="0" class="tabla">
	<tr>
		<td colspan="16"><strong>B&UacuteSQUEDA DE C&OacuteDIGO CATASTRAL: </strong></td>
	</tr> 
	<tr>
		<td width="192">&nbsp;</td>
		<td width="291" class="link">
			<div align="left">C&OacuteDIGO CATASTRAL:
			  	<input type="text" class="casilla" name="codCata" id="codCata" size="9" maxlength="9" onKeyPress="return validar_numeros(event)"/>
			</div>
			<p align="center">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<div>
				<input name="bBuscar" type="submit" class="booton" onChange='valida_referenciacatastral();' value="Buscar Ficha" />
			</div>
			</p>
		</td>
	</tr>
</table>
<?php
	include '../configuracion/conexion.php';	
	include '../configuracion/constantes.php';

		$CodCata = $_GET['codCata'];

		$BD=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);
		$BD->conectar();
		//CONSULTA SI EXISTE EL CODIGO CATASTRAL EN LA BD CATASTRO DE POSTGRESQL
		$ConsultaCatastral= "SELECT c_id_uni_cat from tf_ficha". 
							 "WHERE c_id_uni_cat = '$CodCata'";
		$rowConsultaCatastral=pg_fetch_array($ConsultaCatastral);
		$id_uni_cat=$rowConsultaCatastral['c_id_uni_cat'];
		if($id_uni_cat != '')//tiene uni_cat en la bd de catastro- postgresql
		{
		  //CONSULTAS EN LA BD CATASTRO
		}
		else // no tiene uni_cat en la bd de catastro- postgresql
		{ 
		  //CONSULTA EN LA BD SIMTRUX 

		}
	
	//CONSULTAS POR CADA BLOQUE

			//-- DATOS GENERALES
			$Consulta1="SELECT   f.id_ficha,f.nume_ficha,f.nume_ficha_lote, ".
					"f.dc,u.id_uni_cat,u.cuc, u.codi_hoja_catastral,u.codi_cont_rentas,u.codi_pred_rentas ".
					"FROM tf_uni_cat as u INNER JOIN tf_fichas as f ON u.id_uni_cat=f.id_uni_cat ".
					"WHERE f.id_ficha = '$IDFicha'";
			//-- VIAS
			$Consulta2="SELECT v.codi_via, v.tipo_via, v.nomb_via, t.desc_codigo, p.nume_muni,p.cond_nume, p.nume_certificacion ".
						"FROM tf_vias as v INNER JOIN tf_puertas as p ON v.id_via=p.id_via INNER JOIN tf_ingresos as i ON ".
						"p.id_puerta=i.id_puerta INNER JOIN tf_fichas as f ON i.id_ficha=f.id_ficha ".
						"INNER JOIN tf_tablas_codigos AS t on t.codigo=substr(p.id_puerta,15,1)".
						// "INNER JOIN tf_tablas_codigos AS t2 on t2.codigo=p.cond_nume ".
						"WHERE f.id_ficha = '$IDFicha' and t.id_tabla='TPR'";
			
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
			$Consulta5="SELECT p.tipo_persona, c.codigo ||' - '||  c.desc_codigo as descri, p.tipo_doc,p.nume_doc, p.nombres, p.ape_paterno, p.ape_materno, p.tipo_persona_juridica,".
						"p.razon_social, t.esta_civil ".
						"FROM tf_personas as p INNER JOIN tf_titulares as t ON p.id_persona=t.id_persona ".
						"INNER JOIN tf_tablas_codigos  c ON c.codigo = p.tipo_doc ".
						"WHERE t.id_ficha = '$IDFicha' and c.id_tabla='DOC' ORDER BY t.nume_titular";

			// $Consulta5_4="SELECT p.tipo_persona, c.codigo ||' - '||  c.desc_codigo as descri, p.nume_doc, p.nombres, p.ape_paterno, p.ape_materno ".
			// 			"FROM tf_personas as p INNER JOIN tf_titulares as t ON p.id_persona=t.id_persona ".
			// 			"INNER JOIN tf_tablas_codigos  c ON c.codigo = p.tipo_doc ".
			// 			"WHERE t.id_ficha = '$IDFicha' and c.id_tabla='DOC' and nume_titular='TITULAR N°2' ORDER BY t.nume_titular";


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
			$Consulta15="SELECT declarante,fecha_declarante,nume_registro,nume_ficha ".
						"FROM tf_fichas ".
						"WHERE id_ficha = '$IDFicha'";
			//Departamento
			$Consulta16 = "SELECT  u.codi_dep, u.descri ".
						"FROM tf_domicilio_titulares as t inner join tf_ubigeos as u on t.codi_dep=u.codi_dep ".
						"WHERE t.id_ficha = '$IDFicha' AND U.CODI_PRO='00' AND U.CODI_DIS='00'";

			// Provincia
			$Consulta17 = "SELECT  u.codi_pro, u.descri ".
						" FROM tf_domicilio_titulares as t inner join tf_ubigeos as u on t.codi_pro = u.codi_pro ".
						" WHERE t.id_ficha = '$IDFicha' and u.codi_dep = (select codi_dep from tf_domicilio_titulares where id_ficha='$IDFicha')".
						" and u.codi_pro = (select codi_pro from tf_domicilio_titulares where id_ficha='$IDFicha')".
						" and u.codi_dis = '00'";
			
			// Distrito
			$Consulta18 = "SELECT  u.codi_dis, u.descri ".
						" FROM tf_domicilio_titulares as t inner join tf_ubigeos as u on t.codi_dis = u.codi_dis ".
						" WHERE t.id_ficha = '$IDFicha' and u.codi_dep = (select codi_dep from tf_domicilio_titulares where id_ficha='$IDFicha')".
						" and u.codi_pro = (select codi_pro from tf_domicilio_titulares where id_ficha='$IDFicha')".
						" and u.codi_dis = (select codi_dis from tf_domicilio_titulares where id_ficha='$IDFicha')";
			//Supervisor
			$Consulta19 = "SELECT  nume_doc ||' - '|| nombres ||' '|| ape_paterno ||' '|| ape_materno AS descri,f.fecha_supervision ".
						  "FROM tf_fichas as f inner join tf_personas as p on p.id_persona = f.supervisor ".
						  "WHERE f.id_ficha = '$IDFicha'";
					
			//Tecnico
			$Consulta20 = "SELECT   nume_doc ||' - '|| nombres ||' '|| ape_paterno ||' '|| ape_materno AS descri,f.fecha_levantamiento ".
						  "FROM tf_fichas AS f inner join tf_personas AS p on p.id_persona = f.tecnico ".
						  "WHERE f.id_ficha = '$IDFicha'";
					
			//Verificador
			$Consulta21 = "SELECT  nume_doc ||' - '|| nombres ||' '|| ape_paterno ||' '|| ape_materno AS descri,f.fecha_verificacion ".
						  "FROM tf_fichas as f inner join tf_personas as p on p.id_persona = f.verificador ".
						  "WHERE f.id_ficha = '$IDFicha'";
			
		//ASIGNACIONES POR CADA BLOQUE
	//------------------------------------------
			$consulta_dg= $BD->Consultas($Consulta1);

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
				//echo $row3['tipo_edificacion'];

					$edifi=trim($row3['tipo_edificacion']);
					$Consulta3_2="SELECT desc_codigo from tf_tablas_codigos where id_tabla='TED' and codigo= '$edifi'";
					$consulta_edif= $BD->Consultas($Consulta3_2);
					$row3_2=pg_fetch_array($consulta_edif);
					$edificacion= $row3_2['desc_codigo'];
					
					$inte=trim($row3['tipo_interior']);
					// if ($edifi<>0)
					$Consulta3_3="SELECT desc_codigo from tf_tablas_codigos where id_tabla='TIN' and codigo= '$inte'";
					$consulta_inte= $BD->Consultas($Consulta3_3);
					$row3_3=pg_fetch_array($consulta_inte);
					$interior= $row3_3['desc_codigo'];
					
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
			$fechaadqui=trim($row4_1['fecha_adquisicion']);
			$foradq=trim($row4_1['form_adquisicion']);
			
			$condtit=trim($row4_1['cond_titular']);
			$Consulta4_1="SELECT desc_codigo from tf_tablas_codigos where id_tabla='CTT' and codigo= '$condtit'";
			$consulta_condicion= $BD->Consultas($Consulta4_1);
			$row4_1=pg_fetch_array($consulta_condicion);
			$contitular= $row4_1['desc_codigo'];

			$Consulta4_1_1="SELECT desc_codigo from tf_tablas_codigos where id_tabla='FAQ' and codigo= '$foradq'";
			$consulta_formadq= $BD->Consultas($Consulta4_1_1);
			$row4_1_1=pg_fetch_array($consulta_formadq);
			$formadq= $row4_1_1['desc_codigo'];

			$consulta_ct_2= $BD->Consultas($Consulta4_2);
			$row4_2=pg_fetch_array($consulta_ct_2);
			$nroresol=trim($row4_2['nume_resolucion']);
			$porcentaje=trim($row4_2['porcentaje']);
			$finicio=trim($row4_2['fecha_inicio']);
			$fvencimiento=trim($row4_2['fecha_vencimiento']);

			$condi=trim($row4_2['condicion']);
			$Consulta4_2="SELECT desc_codigo from tf_tablas_codigos where id_tabla='CEP' and codigo= '$condi'";
			$consulta_condi= $BD->Consultas($Consulta4_2);
			$row4_2=pg_fetch_array($consulta_condi);
			$conpredio= $row4_2['desc_codigo'];
					
			//row5 y row5_1
			$consulta_itc= $BD->Consultas($Consulta5);
			$row5=pg_fetch_array($consulta_itc);

			$row5_1=@pg_fetch_all($consulta_itc);

			$consulta_itc_2= $BD->Consultas($Consulta5_2);
			$row5_2=pg_fetch_array($consulta_itc_2);

			$tipoti=trim($row5['tipo_persona']);
			$Consulta5_1="SELECT desc_codigo from tf_tablas_codigos where id_tabla='TPE' and codigo= '$tipoti'";
			$consulta_tipoti= $BD->Consultas($Consulta5_1);
			$row5_5=pg_fetch_array($consulta_tipoti);
			$tiptitular= $row5_5['desc_codigo'];

			$estcivil=trim($row5['esta_civil']);
			$Consulta5_2="SELECT desc_codigo from tf_tablas_codigos where id_tabla='ECV' and codigo= '$estcivil'";
			$consulta_estcivil= $BD->Consultas($Consulta5_2);
			$row5_2=pg_fetch_array($consulta_estcivil);
			$estacivil= $row5_2['desc_codigo'];

			$perjuridica=trim($row5['tipo_persona_juridica']);
			$Consulta5_3="SELECT desc_codigo from tf_tablas_codigos where id_tabla='TPJ' and codigo= '$perjuridica'";
			$consulta_perjuridica= $BD->Consultas($Consulta5_3);
			$row5_3=pg_fetch_array($consulta_perjuridica);
			$perjur= $row5_3['desc_codigo'];

			$condjur=trim($row5_2['condicion']);
			$Consulta5_4="SELECT desc_codigo from tf_tablas_codigos where id_tabla='CET' and codigo= '$condjur'";
			$consulta_condjur= $BD->Consultas($Consulta5_4);
			$row5_4=pg_fetch_array($consulta_condjur);
			$condjuri= $row5_4['desc_codigo'];

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

			$claspred=trim($row7['clasificacion']);
			$Consulta7_3="SELECT desc_codigo from tf_tablas_codigos where id_tabla='CDP' and codigo= '$claspred'";
			$consulta_claspred= $BD->Consultas($Consulta7_3);
			$row7_3=pg_fetch_array($consulta_claspred);
			$clasificacion= $row7_3['desc_codigo'];

			$precat=trim($row7['cont_en']);
			$Consulta7_4="SELECT desc_codigo from tf_tablas_codigos where id_tabla='PEN' and codigo= '$precat'";
			$consulta_precat= $BD->Consultas($Consulta7_4);
			$row7_4=pg_fetch_array($consulta_precat);
			$prediocat= $row7_4['desc_codigo'];

			$usopred=trim($row7['codi_uso']);
			$Consulta7_5="SELECT codi_uso ||' - '|| desc_uso AS descri FROM tf_usos where codi_uso= '$usopred'";
			$consulta_usopred= $BD->Consultas($Consulta7_5);
			$row7_5=pg_fetch_array($consulta_usopred);
			$usopredio= $row7_5['descri'];
			
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
				$kardex=trim($row11_1['kardex']);
				$fescritura=trim($row11_1['fecha_escritura']);


				$notaria=trim($row11_1['id_notaria']);
				$Consulta11_1="SELECT nomb_notaria AS descri FROM tf_notarias where  id_notaria= '$notaria'";
				$consulta_notaria= $BD->Consultas($Consulta11_1);
				$row11_1=pg_fetch_array($consulta_notaria);
				$notaria= $row11_1['descri'];
			
				//row12
				$consulta_s= $BD->Consultas($Consulta12);
				$row12=pg_fetch_array($consulta_s);

				$tipart=trim($row12['tipo_partida']);
				$Consulta12_1="SELECT desc_codigo from tf_tablas_codigos where id_tabla='TPA' and codigo= '$tipart'";
				$consulta_partida= $BD->Consultas($Consulta12_1);
				$row12_1=pg_fetch_array($consulta_partida);
				$partida= $row12_1['desc_codigo'];

				$declara=trim($row12['codi_decla_fabrica']);
				$Consulta12_2="SELECT desc_codigo from tf_tablas_codigos where id_tabla='DFB' and codigo= '$declara'";
				$consulta_declara= $BD->Consultas($Consulta12_2);
				$row12_2=pg_fetch_array($consulta_declara);
				$declaratoria= $row12_2['desc_codigo'];
				
				//row13
				$consulta_epc= $BD->Consultas($Consulta13);
				$row13=pg_fetch_array($consulta_epc);

				$cond=trim($row13['cond_declarante']);
				$Consulta13_1="SELECT desc_codigo from tf_tablas_codigos where id_tabla='CDE' and codigo= '$cond'";
				$consulta_cond= $BD->Consultas($Consulta13_1);
				$row13_1=pg_fetch_array($consulta_cond);
				$condicion= $row13_1['desc_codigo'];
				
				$estf=trim($row13['esta_llenado']);
				$Consulta13_2="SELECT desc_codigo from tf_tablas_codigos where id_tabla='LLE' and codigo= '$estf'";
				$consulta_estado= $BD->Consultas($Consulta13_2);
				$row13_2=pg_fetch_array($consulta_estado);
				$estado= $row13_2['desc_codigo'];

				$mant=trim($row13['mantenimiento']);
				$Consulta13_3="SELECT desc_codigo from tf_tablas_codigos where id_tabla='MFI' and codigo= '$mant'";
				$consulta_mante= $BD->Consultas($Consulta13_3);
				$row13_3=pg_fetch_array($consulta_mante);
				$mantenimiento= $row13_3['desc_codigo'];


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

				$consulta_sup= $BD->Consultas($Consulta19);
				$row19=pg_fetch_array($consulta_sup);
				$supervisor1=$row19['descri'];
				$fechasup = $row19['fecha_supervision'];

				$consulta_tec= $BD->Consultas($Consulta20);
				$row20=pg_fetch_array($consulta_tec);
				$tecnico1=$row20['descri'];
				$fechatec = $row20['fecha_levantamiento'];

				$consulta_ver= $BD->Consultas($Consulta21);
				$row21=pg_fetch_array($consulta_ver);
				$verificador1=$row21['descri'];
				$fechaver = $row21['fecha_verificacion'];

				

	
	$BD->desconectar();
	

	while($row1=pg_fetch_array($consulta_dg))
	{     	  				
	?>
		<table width="980px" border="1" align="center" cellPadding="0" cellSpacing="0" bordercolor="#000000">
    	<tr>
      		<td colspan="6" bgcolor="#0052A4" class="Titulo1"><div align="center" class="Estilo7">LEVANTAMIENTO DE INFORMACI&OacuteN CATASTRAL</div></td>
    	</tr>
		<!--- BUSQUEDA DE CODIGO CATASTRAL -->
    	<tr>
      		<td colspan="6">
			<br>
				<table width="980px" border="0" cellpadding="0" cellspacing="0" class="tabla">
				<tr>
                    <td colspan="16"><strong>B&UacuteSQUEDA DE C&OacuteDIGO CATASTRAL: </strong></td>
                </tr> 
				<tr>
					<td width="192">&nbsp;</td>
					<td width="291" class="link">
						<div align="left">C&OacuteDIGO CATASTRAL:
				  			<input type="text" class="casilla" name="codCata" id="codCata" size="9" maxlength="9" onKeyPress="return validar_numeros(event)"/>
						</div>
						<p align="center">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<div>
							<input name="bBuscar" type="submit" class="booton" onChange='valida_referenciacatastral();' value="Buscar Ficha" />
						</div>
						</p>
					</td>
				</tr>
				<!--- CODIGO DE REFERENCIA CATASTRAL -->
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
                                        <td colspan="16"><strong>DATOS </strong></td>
                                    </tr>                                   
                                    <tr>
                                        <td height="12" colspan="2">&nbsp;</td>
                                        <td width="3%" valign="bottom">
                                        	<div align="center" class="Estilo10"><span class="Estilo11">DPTO.</span></div>
                                        </td>
                                        <td width="3%" valign="bottom">
                                        	<div align="center" class="Estilo10"><span class="Estilo11">PROV.</span></div>
                                        </td>
                                        <td width="6%" valign="bottom">
                                        	<div align="center" class="Estilo10"><span class="Estilo11">DIST.</span></div>
                                        </td>
                                        <td width="11%" valign="bottom">
                                        	<div align="center" class="Estilo10"><span class="Estilo11">SECTOR</span></div>
                                        </td>
                                        <td width="5%" valign="bottom">
                                        	<div align="center" class="Estilo10"><span class="Estilo11">MANZANA</span></div>
                                        </td>
                                        <td width="3%" valign="bottom">
                                        	<div align="center" class="Estilo10"><span class="Estilo11">LOTE</span></div>
                                        </td>
                                        <td width="4%" valign="bottom">
                                        	<div align="center" class="Estilo10"><span class="Estilo11">EDIFICA</span></div>
                                        </td>
                                        <td width="5%" valign="bottom">
                                        	<div align="center" class="Estilo10"><span class="Estilo11">ENTRADA</span></div>
                                        </td>
                                        <td width="8%" valign="bottom">
                                        	<div align="center" class="Estilo10"><span class="Estilo11">PISO</span></div>
                                        </td>
                                        <td width="4%" valign="bottom">
                                        	<div align="center" class="Estilo10"><span class="Estilo11">UNIDAD</span></div>
                                        </td>
                                        <td width="6%" valign="bottom">
                                        	<div align="left" class="Estilo10">
                                          		<div align="center"><span class="Estilo11">&nbsp;&nbsp;DC</span></div>
                                        	</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="24">
                                        	<div align="center"><img src="../img/casilla_roja/3.png" alt="Guardar estado?" width="17" height="17" border="0" /></div>
                                        </td>
                                        <td height="24">C&Oacute;DIGO DE REFERENCIA CATASTRAL </td>
                                        <td>
                                        	<div align="center">
                                          		<input name="dg_dep" class="2" type="text" id="dg_dep" value="<?php echo ($row1['id_ficha'],4,2); ?>" size="2" readonly />
                                        	</div>
                                        </td>
                                        <td>
                                        	<div align="center">
                                          		<input name="dg_pro" type="text" class="2" id="dg_pro" value="<?php echo ($row1['id_ficha'],6,2); ?>" size="2" readonly />
                                       		</div>
                                       	</td>
                                        <td>
                                        	<div align="center">
                                          		<input name="dg_dis" class="2" type="text" id="dg_dis" value="<?php echo ($row1['id_ficha'],8,2); ?>" size="2" readonly />
                                        	</div>
                                        </td>
                                        <td>
                                        	<div align="center">
                                         		<input name="dg_sector" class="2" type="text" id="dg_sector" value="<?php echo substr($row1['id_uni_cat'],6,2); ?>" size="2"<?php echo $N.' '.$DC.' '.$ev_2?>readonly />
                                        	</div>
                                        </td>
                                        <td>
                                        	<div align="center">
                                          		<input name="dg_manzana" type="text" class="2" id="dg_manzana" value="<?php echo substr($row1['id_uni_cat'],8,3); ?>" size="2" <?php echo $N.' '.$DC;?>readonly />
                                        	</div>
                                        </td>
                                        <td>
                                        	<div align="center">
                                          		<input name="dg_lote" type="text" class="2" id="dg_lote" value="<?php echo substr($row1['id_uni_cat'],11,3); ?>" size="2"  <?php echo $N.' '.$DC;?> readonly/>
                                        	</div>
                                        </td>
                                        <td>
                                        	<div align="center">
                                          		<input name="dg_edificacion" type="text" class="2" value="<?php echo substr($row1['id_uni_cat'],14,2); ?>" id="dg_edificacion" size="2" <?php echo $N.' '.$DC;?> readonly/>
                                        	</div>
                                        </td>
                                        <td>
                                        	<div align="center">
                                          		<input name="dg_entrada" type="text" class="2" value="<?php echo substr($row1['id_uni_cat'],16,2); ?>" id="dg_entrada" size="2"  <?php echo $N.' '.$DC;?>readonly />
                                        	</div>
                                        </td>
                                        <td>
                                        	<div align="center">
                                          		<input name="dg_piso" type="text" class="2" value="<?php echo substr($row1['id_uni_cat'],18,2); ?>" id="dg_piso" size="2" <?php echo $N.' '.$DC;?>readonly />
                                        	</div>
                                        </td>
                                        <td>
                                       		<div align="center">
                                          		<input name="dg_unidad" type="text" class="2" value="<?php echo substr($row1['id_uni_cat'],20,3); ?>" id="dg_unidad" size="2" <?php echo $N.' '.$DC;?>readonly />
                                        	</div>
                                        </td>
                                        <td>
                                        	<div align="center">
                                          		<input name="dg_dc" type="text" id="dg_dc" value="<?php echo $row1['dc']; ?>" size="2" <?php echo $DC;?> readonly/>
                                        	</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        	<div align="center"><img src="../img/casilla_azul/4.png" alt="Guardar estado?" width="17" height="17" 
                                        	border="0" /></div>
                                        </td>
                                        <td>C&Oacute;DIGO CONTRIBUYENTE DE RENTAS </td>
                                        <td colspan="3">
                                        	<input name="dg_codcontribuyente" type="text" id="dg_codcontribuyente" value="<?php echo trim($row1['codi_cont_rentas']); ?>" size="8" readonly/>
                                        </td>
                                        <td>
                                        	<div align="center"></div>
                                        </td>
                                        <td>
                                        	<div align="center"><img src="../img/casilla_azul/5.png" alt="Guardar estado?" width="17" height="17" border="0" /></div>
                                        </td>
                                        <td colspan="4">C&Oacute;DIGO PREDIAL DE RENTAS</td>
                                        <td>&nbsp;</td>
                                        <td>
                                        	<input name="dg_codpredial" value="<?php echo trim($row1['codi_pred_rentas']); ?>" type="text" id="dg_codpredial" readonly size="8"/>
                                        </td>
                                        <td width="11%">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td height="24">&nbsp;</td>
                                        <td height="24">&nbsp;</td>
                                        <td colspan="12">
                              			  <?php
											$anio=date("Y");
						    				echo "<input name='contador1' type='text' class='contador' id='contador1' value='".($nro_upc)."' size='2' />
								            	<input name='contador2' type='text' class='contador' id='contador2' value='".($nro_c)."' size='2' />
								            	<input name='contador3' type='text' class='contador' id='contador3' value='".($nro_i)."' size='2' />
								           		<input name='contador4' type='text' class='contador' id='contador4' value='".($nro_d)."' size='2' />
								            	<input name='contador5' type='text' class='contador' id='contador5' value='".($nro_li)."' size='2' />
								            	<input name='anio' type='text' class='contador' id='anio' value='".$anio."' size='4' />
								            	<input name='previo' type='text' class='contador' id='previo' size='25' />
								            	<input name='tipo' type='text' class='contador' id='tipo' size='2' />";
										  ?>
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
                                &nbsp;<strong>UBICACI&Oacute;N DEL PREDIO CATASTRAL:</strong>
                            </td>
                        </tr>
                        <tr>
                          	<td colspan="6" valign="top" align="center">
							   <table width="940px" border="1" cellpadding="0" cellspacing="0" class="tabla">
                              	 <thead >
                                	<tr class="principal" >
                                  		<th width="20">
                                  			<div align="center"><img src="../img/casilla_roja/7.png" alt="Guardar estado?" width="17" height="16" border="0" /></div>
	                                  	</th>
	                                  	<th width="51">C&Oacute;DIGO DE VIA</th>
	                                  	<th width="20">
	                                  		<div align="center"><img src="../img/casilla_azul/8.png" alt="Guardar estado?" width="17" height="16" border="0" /></div>
	                                  	</th>
	                                  	<th width="53">TIPO DE V&Iacute;A </th>
	                                  	<th width="20">
	                                  		<div align="center"><img src="../img/casilla_azul/9.png" alt="Guardar estado?" width="17" height="16" border="0" /></div>
	                                  	</th>
	                                  	<th width="251">NOMBRE V&Iacute;A</th>
	                                  	<th width="20">
	                                  		<div align="center"><img src="../img/casilla_roja/10.png" alt="Guardar estado?" width="17" height="16" border="0" /></div>
	                                  	</th>
	                                  	<th width="87">TIPO PUERTA</th>
	                                  	<th width="20">
	                                  		<div align="center"><img src="../img/casilla_azul/11.png" alt="Guardar estado?" width="17" height="16" border="0" /></div>
	                                  	</th>
	                                  	<th width="69">N&ordm; MUNICIPAL</th>
	                                  	<th width="20">
	                                  		<div align="center"><img src="../img/casilla_azul/12.png" alt="Guardar estado?" width="17" height="16" border="0" /></div>
	                                  	</th>
	                                  	<th width="69">COND. N&Uacute;MERO </th>
	                                  	<th width="20">
	                                  		<div align="center"><img src="../img/casilla_azul/13.png" alt="Guardar estado?" width="17" height="16" border="0" /></div>
	                                  	</th>
	                                  	<th width="84">N&ordm; CERTIF.DE NUMERACI&Oacute;N </th>
	                               
                                	</tr>
                            		<tr>
                                  		<th class="celda" align="left" colspan="16">
                      					  <?php            
											//---------------------------------------------------------------- VIAS   
											  if($con_upc<0) //no hay registros
												{
											 
												   echo "<div id='linea1_0' style='width:940px' >
													    <input name='upc_cod-0' type='text' readonly='readonly' class='input' id='upc_cod-0' style='width:115px'   value=''/>
													    <input class='input'  id='upc_tipo-0' name='upc_tipo-0' type='text' readonly style='width:100px' value=''/>
													    <input class='input' id='upc_nom-0' name='upc_nom-0' type='text'  readonly='readonly' style='width:225px' value=''/>
													    <input class='input' id='upc_puerta-0' name='upc_puerta-0' type='text'  readonly='readonly' style='width:115px' value=''/> 	
													    <input name='upc_num-0' type='text' class='input' id='upc_num-0' style='width:125px' value=''/>
													    <input class='input' id='upc_cond-0' name='upc_cond-0' type='text'  readonly='readonly' style='width:95px' value=''/> 
													    <input name='upc_cert-0' type='text' readonly='readonly' class='input' id='upc_cert-0' style='width:140px'  value=''/>
													    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
													
													echo "</div>";
											 
											 	}
											  else
											 	{
											   	  $indice1=0;
											   	  while($row2=pg_fetch_array($consulta_vias))
											   	  // $cond=trim($row2['cond_nume']);
											   		// if ($row2['cond_nume']=0)
											   		// {
											   		// 	$condnume='';
											   		// }
											   	// 	else 
											   	// 	{
													  // $Consulta2_10="SELECT desc_codigo from tf_tablas_codigos where id_tabla='CNP' and codigo= '$cond'";
													  // $consulta_cond= $BD->Consultas($Consulta2_10);
													  // $row2_1=pg_fetch_array($consulta_cond);
													  // $condnume= $row2_1['desc_codigo'];
												   //  }

												  {   
						                             echo "<div id='linea1_".$indice1."' style='width:940px' >
						                     			   <input name='upc_cod-".$indice1."'type='text'readonly='readonly' class='input'
						                     			    id='upc_cod-".$indice1."' style='width:100px'value='".$row2['codi_via']."'/>
						                     		
						                              	   <input class='input'  id='upc_tipo-".$indice1."' name='upc_tipo-".$indice1."' 
						                              	   type='text' readonly style='width:85px' value='".trim($row2['tipo_via'])."'/>
						                                   <input class='input' id='upc_nom-".$indice1."' name='upc_nom-".$indice1."' 
						                                   type='text'  readonly='readonly' style='width:300px' value='".trim($row2['nomb_via'])."'/>
						                                   &nbsp
						                              	   <input class='input' type='text'  id='upc_puerta' readonly  style='width:100px' value='".trim($row2['desc_codigo'])."'/>	
						                             	   <input class='input' id='upc_num-".$indice1."' name='upc_num-".$indice1."' 
						                                   type='text'  readonly='readonly' style='width:90px' value='".trim($row2['nume_muni'])."'/>
						                                   &nbsp
						                            	   <input class='input' type='text'  id='upc_puerta' readonly  style='width:103px' ";
						                            	      if($row2['cond_nume']>0) 
											 					 echo "value='".trim($row5_1[1]['descri'])."'";
										   					  else  
																  echo "value='' readonly ";				  
																  echo "size='10' readonly/>
						                             	   &nbsp
						                                   <input name='upc_certi-".$indice1."' type='text' readonly='readonly' class='input'id='upc_certi-".$indice1."' style='width:110px' value='".trim($row2['nume_certificacion'])."'/>
						                            	   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

											 //  if ($indice1<$nro_upc)
											 //   { 
												// 	echo "<input class='bt_plus' id='1' type='button' value='-' />"; }
											 //   else 
												//  { 
												// 	echo "<input class='bt_plus' id='1' type='button' value='+' />"; }
												//   	echo "</div>";
												$indice1++; 
												 }
												}
											 ?>
                                  		</th>
                                	</tr>
                              	   </thead>
                          		</table>
						  	   <BR />	
						  	</td>
					    </tr>
                        <tr>
                            <td width="29" class="etiqueta" height="24">&nbsp;&nbsp;
                            	<img src="../img/casilla_azul/14.png" alt="Guardar estado?" width="17" height="16" border="0" />
                            </td>
                            <td width="172" class="etiqueta">NOMBRE DE LA EDIFICACI&Oacute;N</td>
                          	<td width="273">
                          		<input name="upc_nomedi" type="text" class="casillaLarga" value="<?php echo trim($row3['nomb_edificacion']);?>" 	 size="40"  readonly/>
                          	</td>
							<td width="25" class="etiqueta" height="24">
								<div align="center"><img src="../img/casilla_azul/15.png" alt="Guardar estado?" width="17" height="16" border="0" />
								</div>
							</td>
                            <td width="180" class="etiqueta">TIPO DE EDIFICACI&Oacute;N</td>
         					<td width="29%"><input value= "<?php echo $edificacion; ?>"  readonly/></td>
							<td height="24" class="etiqueta">
								
							</td>
                      </span>
                    </td>
                        </tr>
                        <tr>
                            <td height="24" class="etiqueta">&nbsp;&nbsp;
                            	<img src="../img/casilla_azul/16.png" alt="Guardar estado?" width="17" height="16" border="0" />
                            </td>
                            <td height="24" class="etiqueta">TIPO DE INTERIOR</td>
                            <td width="29%"><input value= "<?php echo $interior; ?>"  readonly/></td>
							<td height="24" class="etiqueta">
								<div align="center"><img src="../img/casilla_azul/17.png" alt="Guardar estado?" width="17" height="16" border="0" />
								</div>
							</td>
                            <td height="24" class="etiqueta">N&Uacute;MERO DE INTERIOR</td>
                            <td>
                                <input type="text" class="casilla" name="upc_numint" value="<?php echo trim($row3['nume_interior']); ?>" size="4" id="upc_numint" readonly>
                            </td>
                        </tr>
                        <tr>
                          	<td height="24" class="etiqueta">&nbsp;&nbsp;
                          		<img src="../img/casilla_roja/18.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
                          	<td height="24" class="etiqueta">C&OacuteDIGO H.U.</td>
                          	<td>
                            	<input name="upc_codhu" type="text" id="upc_codhu" value="<?php echo trim($row3['id_hab_urba']); ?>" size="4"  readonly>
                            </td>
                          	<td>
                          		<div align="center"><img src="../img/casilla_azul/19.png" alt="Guardar estado?" width="17" height="17" border="0" />
                          		</div>
                          	</td>
                         	<td>NOMBRE DE LA H.U.</td>
                          	<td>
                            	<input name="upc_nomhu" type="text" size="40" id="upc_nomhu" value="<?php echo trim($row3_1['tipo_hab_urba']).' '.
                            	trim($row3_1['nomb_hab_urba']); ?>" readonly>
                           	</td>
                        </tr>
                        <tr>
                            <td height="24" class="etiqueta">&nbsp;&nbsp;
                            	<img src="../img/casilla_azul/20.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
                            <td height="24" class="etiqueta">ZONA/SECTOR/ETAPA</td>
                            <td>
                            	<input name="upc_zse" type="text" size="32" id="upc_zse" value="<?php echo trim($row3['zona_dist']); ?>"<?php echo $M;?>readonly>
                            </td>
							<td>
								<div align="center"><span class="etiqueta">
								<img src="../img/casilla_azul/21.png" alt="Guardar estado?" width="17" height="17" border="0" /></span></div>
							</td>
                            <td><span class="etiqueta">MANZANA</span></td>
                            <td>
                            	<input name="upc_mzna" type="text" size="4" id="upc_mzna" <?php echo $M;?> value="<?php echo trim($row3['mzna_dist']); 
                            	?>"readonly>
                            </td>
                        </tr>      
                        <tr>
                            <td height="24" class="etiqueta">&nbsp;&nbsp;
                            	<img src="../img/casilla_azul/22.png" alt="Guardar estado?" width="17" height="17" border="0" /></td>
                            <td height="24" class="etiqueta">LOTE</td>
                            <td>
                                <input type="text" class="casilla" name="upc_lote" value="<?php echo trim($row3['lote_dist']); ?>" size="4" 
                                id="upc_lote" <?php echo $M;?>/readonly>
                            </td>
                            <td><div align="center"><span class="etiqueta"><img src="../img/casilla_azul/23.png" alt="Guardar estado?" width="17" height="17" border="0" /></span></div></td>
                            <td><span class="etiqueta">SUB-LOTE</span></td>
                            <td><input type="text" class="casilla" name="upc_sublote"  value="<?php echo trim($row3['sub_lote_dist']); ?>" size="4" id="upc_sublote" <?php echo $M;?> readonly/></td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
				  </table>
			    </td>
		     </tr>
		  </table>
			<br>
	      <table width="960px" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
			 <tr>
				<td>
				   <table width="950PX" border="0" align="center" cellpadding="0" cellspacing="0" class="tabla">
                      <tr>
                        <td class="etiquetanegra" colspan="4" height="30">
                         &nbsp;
                           <strong>IDENTIFICACI&Oacute;N DEL TITULAR CATASTRAL:</strong>
                        </td>
                      </tr>
                      <tr id="personanatural"></tr>
                        <td colspan="4">
                         <!-- "OCULTAMOS O VISUALIZAMOS SEGUN COTITULARIDAD"-->
                          <?php 
						//SIEMPRE QUE NO HALLA COTITULARIDAD

						   if($condtit!='05') 
							{
							//SEGUN TIPO DE TITULAR
							  if($row5['tipo_persona']==1)		
							   {
								 echo "
								  <table  id='oculta' width='100%' align='center' cellpadding='0' cellspacing='0' class='tabla'>
                                    <tr>
	                                      <td height='24' class='etiqueta'><div align='center'>
	                                      	<img src='../img/casilla_roja/24.png'alt='Guardar estado?' width='17' height='17' border='0' /></div>
	                                      </td>
	                                      <td height='24' class='etiqueta'>TIPO DE TITULAR</td>
	                                      <td>
	                                      <input type='text' class='casilla' name='itc_tip1' id='itc_tip1' size='25' 
	                                      readonly value='".$tiptitular."' /></td>
	                                      <td width='29' height='24' class='etiqueta'><div align='center'>
	                                        <img src='../img/casilla_roja/25.png' alt='Guardar estado?' width='17' height='17' border='0' /></div>
	                                      </td>
	                                      <td width='167' height='24' class='etiqueta'>ESTADO CIVIL</td>
	                                      <td>
	                                      <input type='text' class='casilla' name='itc_estado1' id='itc_estado1' size='15' 
	                                      readonly value='".$estacivil."' /></td>
									</tr>
                                    <tr>
                                          <td height='24' class='etiqueta'><div align='center'>
                                            <img src='../img/casilla_roja/26.png' alt='Guardar estado?' width='17' height='17' border='0' /></div>
                                          </td>
                                          <td height='24' class='etiqueta'><em>TIPO DOC. IDENTIDAD</em></td>
                                          <td width='289'><span class='etiqueta'>
	                                         <input type='text' class='casilla' name='itc_numdoc1' id='itc_numdoc1' size='15' 
	                                         readonly value='".trim($row5_1[0]['descri'])."' /></span>
	                                      </td>
                                      	  <td width='29' height='24' class='etiqueta'><div align='center'>
										    <img src='../img/casilla_roja/27.png' alt='Guardar estado?' width='17' height='17' border='0' /></div>
										  </td>";
									
									//ESTADO CIVIL
									
										echo "
										  <td width='167' height='24' class='etiqueta'><em>N&Uacute;MERO DE DOCUMENTO</em></td>
	                                      <td width='289'><span class='etiqueta'>
	                                         <input type='text' class='casilla' name='itc_numdoc1' id='itc_numdoc1' size='9' 
	                                         readonly value='".trim($row5_1[0]['nume_doc'])."' /></span>
	                                      </td>
                                    </tr>
                                    <tr>
                                          <td height='24' class='etiqueta'><div align='center'>
                                          	<img src='../img/casilla_roja/28.png'alt='Guardar estado?' width='17' height='17' border='0' /></div>
                                          </td>
                                          <td height='24' class='etiqueta'><em>NOMBRES</em></td>
                                      	  <td height='24' class='etiqueta'>
                                        	<input name='itc_nombre1' type='text' class='casillaLarga' value='".trim($row5_1[0]['nombres'])."' 
                                        	size='32' id='itc_nombre1' readonly/>
                                          </td>
                                          <td height='24' colspan='2' class='etiqueta'>&nbsp;</td>
                                          <td height='24' class='etiqueta'>&nbsp;</td>
									</tr>
                                    <tr>
                                          <td height='24' class='etiqueta'><div align='center'>
                                          	<img src='../img/casilla_roja/29.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                          <td height='24' class='etiqueta'><em>APELLIDO PATERNO</em></td>
                                      	  <td height='24' class='etiqueta'>
                                            <input type='text' class='casilla' name='itc_paterno1' value='".trim($row5_1[0]['ape_paterno'])."'
                                            size='32' id='itc_paterno1' readonly/>
                                          </td>
                                          <td height='24' class='etiqueta'><div align='center'>
                                          	<img src='../img/casilla_roja/30.png' alt='Guardar estado?' width='17' height='17' border='0' /></div>
                                          </td>
                                          <td height='24' class='etiqueta'><em><em>APELLIDO MATERNO</em></em></td>
                                          <td height='24' class='etiqueta'>
                                        	<input type='text' class='casilla' name='itc_materno1' value='".trim($row5_1[0]['ape_materno'])."' 
                                        	size='40' id='itc_materno1' readonly/>
                                          </td>
                                   </tr>";

									//CONYUGE 
									echo "<tr><td>&nbsp;</td>
                                   </tr>
                                   <tr>
                                        <td height='15' class='etiqueta'>&nbsp;</td>
                                        <td height='15' class='etiqueta'><strong>DATOS DEL C&Oacute;NYUGE</strong></td>
                                      	<td height='15' class='etiqueta'>&nbsp;</td>
                                        <td height='15' class='etiqueta'>&nbsp;</td>
                                        <td height='15' class='etiqueta'>&nbsp;</td>
                                        <td height='15' class='etiqueta'>&nbsp;</td>
                                   </tr>
                                   <tr>
                                   		<td>&nbsp;</td>
                                   </tr>
                                   <tr>
                                      <td width='26' height='24' class='etiqueta'><div align='center'>
                                      	<img src='../img/casilla_azul/26.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td width='24' class='etiqueta'><em>TIPO DOC. IDENTIDAD</em></td>
         							  <td>
         							  	<input type='text' class='casilla' name='itc_tipodoc2' id='itc_tipodoc2' ";
										   if($row5['esta_civil']=='02') 
											  echo "value='".trim($row5_1[1]['descri'])."'";
										   else  
											  echo "value='' readonly ";				  
											  echo "size='15' readonly/></td>
         		         			  <td height='24' class='etiqueta'><div align='center'><em>
                                      	<img src='../img/casilla_azul/27.png' alt='Guardar estado?' width='17' height='17' border='0' /></em></div></td>
                                      <td class='etiqueta'><em>N&Uacute;MERO DE DOCUMENTO</em></td>
                                      <td> 
                                      	<input type='text' class='casilla' name='itc_numdoc2' id='itc_numdoc2' ";
										  if($row5['esta_civil']=='02') 
										  	echo "value='".trim($row5_1[1]['nume_doc'])."'";
										  else  
										  	echo "value='' readonly ";				  
											echo "size='9' readonly/></td>
                                   </tr>
                                   <tr>
                                      <td height='24' class='etiqueta'><div align='center'>
                                      	<img src='../img/casilla_azul/28.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'><em>NOMBRES</em></td>
                                      <td class='etiqueta'>
                                        <input name='itc_nombre2' type='text' class='casillaLarga' ";
											if($row5['esta_civil']=='02') 
												echo "value='".trim($row5_1[1]['nombres'])."'";
											else 
												echo "value='' readonly ";
												echo " size='32' id='itc_nombre2' readonly/>
									   </td>
                                       <td height='24' colspan='2' class='etiqueta'>&nbsp;</td>
                                       <td>&nbsp;</td>
								  </tr>
                                  <tr>
                                      <td height='24' class='etiqueta'><div align='center'>
                                      	  <img src='../img/casilla_azul/29.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'><em>APELLIDO PATERNO</em></td>
                                      <td>
                                       <span class='etiqueta'>
	                                       <input type='text' class='casilla' name='itc_paterno2' ";
											if($row5['esta_civil']=='02') 
												 echo "value='".trim($row5_1[1]['ape_paterno'])."'";
											else echo "value='' readonly ";
												 echo "' size='32' id='itc_paterno2' readonly/>
	                                    </span>
                                      </td>
                                      <td height='24' class='etiqueta'><div align='center'><em>
                                      	<img src='../img/casilla_azul/30.png' alt='Guardar estado?' width='17' height='17' border='0' /></em></div></td>
                                      <td height='24' class='etiqueta'><em>APELLIDO MATERNO</em></td>
                                      <td>
                                        <span class='etiqueta'>
                                          <input type='text' class='casilla' name='itc_materno2' ";
											if($row5['esta_civil']=='02')
												 echo "value='".trim($row5_1[1]['ape_materno'])."'";
											else echo "value='' readonly ";
												 echo "' size='40' id='itc_materno2' readonly/>
                                      	</span>
                                      </td>
                                  </tr>
                                  <tr>
                                     <td height='24' colspan='6' class='etiqueta'>&nbsp;</td>
                                  </tr>
                                  <tr>
                                     <td height='24' class='etiqueta'><div align='center'>
                                     	 <img src='../img/casilla_roja/31.png' alt='Guardar estado?' width='17' height='17' border='0' /></div>
                                     </td>
                                     <td height='24' class='etiqueta'>N&Uacute;MERO DE RUC</td>
                                     <td><input type='text' class='casilla' name='itc_ruc' value='' size='11' id='itc_ruc' READONLY/>
                                     </td>
                                     <td height='24' class='etiqueta'><div align='center'>
                                     	 <img src='../img/casilla_roja/32.png' alt='Guardar estado?' width='17' height='17' border='0' /></div>
                                     </td>
                                     <td height='24' class='etiqueta'>RAZON SOCIAL</td>
                                     <td><input name='itc_razsocial' type='text' class='casillaLarga' value='' size='40' id='itc_razsocial' READONLY/>
                                     </td>
                                  </tr>
                                  <tr>
                                     <td height='24' class='etiqueta'><div align='center'>
                                     	 <img src='../img/casilla_roja/33.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                     <td height='24' class='etiqueta'>PERSONA JUR&Iacute;DICA</td>
                                     <td>
                                          <input type='text' class='casilla' name='itc_perjur1' ";
											if($row5['tipo_persona']=='2')
												echo "value='".$perjur."'";
											else echo "value='' readonly ";
												 echo "' size='40' id='itc_perjur'onKeyPress='return letras(event)' 
												 onKeyUp='validar_todo_mayus(this)'/>
                                     </td>
                                     <td height='24' class='etiqueta'><div align='center'>
                                     	 <img src='../img/casilla_azul/34.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                     <td height='24' class='etiqueta'>COND. ESP. DEL TITULAR</td>
                                      <td>
                                     	  <input name='itc_condesp1' type='text' class='casillaLarga' value='".$condjuri."' 
                                     	  size='40' id='itc_condesp1' READONLY />
                                     </td>
                                  </tr>
                                  <tr>
                                     <td height='24' class='etiqueta'><div align='center'>
                                     	 <img src='../img/casilla_azul/35.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                     <td height='24' class='etiqueta'>Nº RESOL. EXONERACION</td>
                                     <td>
                                     	<input type='text' class='casillaFecha' name='itc_numresexo' 
                                     	value='".trim($row5_2['nume_resolucion'])."' size='9' READONLY id='itc_numresexo' /></td>
                                     <td height='24' class='etiqueta'><div align='center'>
                                     	<img src='../img/casilla_azul/36.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                     <td height='24' class='etiqueta'>Nº BOL. PENSIONISTA</td>
                                     <td><input type='text' class='casillaFecha' name='itc_numbolpen' value='".trim($row5_2['nume_boleta_pension'])."' size='9' READONLY id='itc_numbolpen' /></td>
                                  </tr>
                                  <tr>
                                     <td height='24' class='etiqueta'><div align='center'>
                                     	 <img src='../img/casilla_azul/37.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                     <td height='24' class='etiqueta'>INICIO EXONERACION</td>
                                     <td><input name='itc_fechainiexo' READONLY type='text' id='itc_fechainiexo' value='";
										  if (trim($row5_2['fecha_inicio'])=='1970-01-01')
										  	{ echo '' ;
											}
										  else echo trim($row5_2['fecha_inicio']);
										  	   echo "' size='15'/>
                                    
                                     <td height='24' class='etiqueta'><div align='center'>
                                     	  <img src='../img/casilla_azul/38.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                     <td height='24' class='etiqueta'>FIN EXONERACION</td>
                                     <td><input name='itc_fechafinexo' type='text' id='itc_fechafinexo' READONLY value='";
										  if (trim($row5_2['fecha_vencimiento'])=='1970-01-01')
										  	{ echo '';
											}
										  else echo trim($row5_2['fecha_vencimiento']);
										  	   echo "' size='15' />
                                      
                                  	</tr>
							      </table>";
									}
							   else //-------------------- CASO JURIDICO --------------------------------------------
							      {
									echo "
								  <table  id='oculta' width='100%' align='center' cellpadding='0' cellspacing='0' class='tabla'>
                                    <tr>
                                      <td height='24' class='etiqueta'><div align='center'>
                                      	  <img src='../img/casilla_roja/24.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'>TIPO DE TITULAR</td>
                                      	<td>
                                      	<input type='text' class='casilla' name='itc_tip1' id='itc_tip1'  readonly value='".$tiptitular."' /></td>
                                      <td width='29' height='24' class='etiqueta'><div align='center'>
                                          <img src='../img/casilla_roja/25.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td width='167' height='24' class='etiqueta'>ESTADO CIVIL</td>
                                      <td>
	                                      <input type='text' class='casilla' name='itc_estado1' id='itc_estado1' size='15' 
	                                      readonly value='".$estacivil."' /></td>
									</tr>
                                  
                                    <tr>
                                      <td height='24' class='etiqueta'><div align='center'>
                                      	  <img src='../img/casilla_roja/26.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'><em>TIPO DOC. IDENTIDAD</em></td>
                                       <td height='24' class='etiqueta'>
                                          <input name='itc_identidad1' type='text' class='casillaLarga' value='' readonly size='10' 
                                          id='itc_identidad1' /></td>

									  <td width='29' height='24' class='etiqueta'><div align='center'>
									  	  <img src='../img/casilla_roja/27.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>";
									
									//ESTADO CIVIL
									
									echo "
									  <td width='167' height='24' class='etiqueta'><em>N&Uacute;MERO DE DOCUMENTO</em></td>
                                      <td width='289'><span class='etiqueta'>
                                          <input type='text' class='casilla' name='itc_numdoc1' id='itc_numdoc1' size='9' 
                                          onKeyPress='return validar_numeros(event)' value='' readonly/>
                                        </span>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td height='24' class='etiqueta'><div align='center'>
                                      	  <img src='../img/casilla_roja/28.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'><em>NOMBRES</em></td>
                                      <td height='24' class='etiqueta'>
                                          <input name='itc_nombre1' type='text' class='casillaLarga' value='' readonly size='32' 
                                          id='itc_nombre1' onKeyPress='return letras(event)' onKeyUp='validar_todo_mayus(this)'/></td>
                                      <td height='24' colspan='2' class='etiqueta'>&nbsp;</td>
                                      <td height='24' class='etiqueta'>&nbsp;</td>
									</tr>
                                    <tr>
                                      <td height='24' class='etiqueta'><div align='center'>
                                      	  <img src='../img/casilla_roja/29.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'><em>APELLIDO PATERNO</em></td>
                                      <td height='24' class='etiqueta'>
                                          <input type='text' class='casilla' name='itc_paterno1' value='' readonly size='32' 
                                          id='itc_paterno1' onKeyPress='return letras(event)' onKeyUp='validar_todo_mayus(this)'/></td>
                                      <td height='24' class='etiqueta'><div align='center'>
                                      	  <img src='../img/casilla_roja/30.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'><em><em>APELLIDO MATERNO</em></em></td>
                                      <td height='24' class='etiqueta'>
                                          <input type='text' class='casilla' name='itc_materno1' value='' readonly size='40' 
                                          id='itc_materno1' onKeyPress='return letras(event)' onKeyUp='validar_todo_mayus(this)'/></td>
                                   </tr>";
									                                 
									 
									//CONYUGE 
								   echo "<tr><td>&nbsp;</td>
                                   </tr>
                                   <tr>
                                      <td height='15' class='etiqueta'>&nbsp;</td>
                                      <td height='15' class='etiqueta'><strong>DATOS DEL C&Oacute;NYUGE</strong></td>
                                      <td height='15' class='etiqueta'>&nbsp;</td>
                                      <td height='15' class='etiqueta'>&nbsp;</td>
                                      <td height='15' class='etiqueta'>&nbsp;</td>
                                      <td height='15' class='etiqueta'>&nbsp;</td>
                                   </tr>
                                   <tr><td>&nbsp;</td>
                                   </tr>
                                   <tr>
                                      <td width='26' height='24' class='etiqueta'><div align='center'>
                                      	  <img src='../img/casilla_azul/26.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td width='156' class='etiqueta'><em>TIPO DOC. IDENTIDAD</em></td>
                                      <td><input type='text' class='casilla' name='itc_numdoc2' id='itc_numdoc2' ";
											  if($row5['esta_civil']=='02') 
											  	echo "value='".trim($row5_1[1]['descri'])."'";
											  else  
											  	echo "value='' readonly ";
												echo " size='9'></td>
                                      <td height='24' class='etiqueta'><div align='center'><em>
                                      	  <img src='../img/casilla_azul/27.png' alt='Guardar estado?' width='17' height='17' border='0' /></em></div>
                                      </td>
                                      <td class='etiqueta'><em>N&Uacute;MERO DE DOCUMENTO</em></td>
                                      <td> 
                                      	  <input type='text' class='casilla' name='itc_numdoc2' id='itc_numdoc2' ";
											  if($row5['esta_civil']=='02') 
											  	echo "value='".trim($row5_1[1]['nume_doc'])."'";
											  else  
											  	echo "value='' readonly ";
												echo " size='9' onKeyPress='return validar_numeros(event)'/></td>
                                   </tr>
                                   <tr>
                                      <td height='24' class='etiqueta'><div align='center'>
                                      	  <img src='../img/casilla_azul/28.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'><em>NOMBRES</em></td>
                                      <td class='etiqueta'>
                                          <input name='itc_nombre2' type='text' class='casillaLarga' ";
											if($row5['esta_civil']=='02') 
												echo "value='".trim($row5_1[1]['nombres'])."'";
											else 
												echo "value='' readonly ";
												echo " size='32' id='itc_nombre2'onKeyPress='return letras(event)' 
													 onKeyUp='validar_todo_mayus(this)'/>                                      
									  </td>
                                      <td height='24' colspan='2' class='etiqueta'>&nbsp;</td>
                                      <td>&nbsp;</td>
								  </tr>
                                  <tr>
                                      <td height='24' class='etiqueta'><div align='center'>
                                      	  <img src='../img/casilla_azul/29.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                      <td height='24' class='etiqueta'><em>APELLIDO PATERNO</em></td>
                                      <td>
                                        <span class='etiqueta'>
                                          <input type='text' class='casilla' name='itc_paterno2' ";
											if($row5['esta_civil']=='02') 
												echo "value='".trim($row5_1[1]['ape_paterno'])."'";
											else echo "value='' readonly ";
												 echo "' size='32' id='itc_paterno2'onKeyPress='return letras(event)' 
												 	  onKeyUp='validar_todo_mayus(this)'/>
                                        </span>
                                      </td>
                                      <td height='24' class='etiqueta'><div align='center'><em>
                                      	  <img src='../img/casilla_azul/30.png' alt='Guardar estado?' width='17' height='17' border='0' /></em></div>
                                      </td>
                                      <td height='24' class='etiqueta'><em>APELLIDO MATERNO</em></td>
                                      <td><span class='etiqueta'>
                                          <input type='text' class='casilla' name='itc_materno2' ";
											if($row5['esta_civil']=='02')
												echo "value='".trim($row5_1[1]['ape_materno'])."'";
											else echo "value='' readonly ";
												 echo "' size='40' id='itc_materno2'onKeyPress='return letras(event)' 
												 onKeyUp='validar_todo_mayus(this)'/>
                                        </span>
                                      </td>
                                  </tr>
                                  <tr>
                                     <td height='24' colspan='6' class='etiqueta'>&nbsp;</td>
                                  </tr>
                                  <tr>
                                     <td height='24' class='etiqueta'><div align='center'>
                                     	  <img src='../img/casilla_roja/31.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                     <td height='24' class='etiqueta'>N&Uacute;MERO DE RUC</td>
                                     <td>
                                     	  <input type='text' class='casilla' name='itc_ruc' value='".trim($row5['nume_doc'])."' size='11' id='itc_ruc'
                                     	  READONLY/>
                                     </td>
                                     <td height='24' class='etiqueta'><div align='center'>
                                     	   <img src='../img/casilla_roja/32.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                     <td height='24' class='etiqueta'>RAZON SOCIAL</td>
                                     <td>
                                     	  <input name='itc_razsocial' type='text' class='casillaLarga' value='".trim($row5['razon_social'])."' 
                                     	  size='40' id='itc_razsocial' READONLY />
                                     </td>
                                  </tr>
                                  <tr>
                                     <td height='24' class='etiqueta'><div align='center'>
                                     	  <img src='../img/casilla_roja/33.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                     <td height='24' class='etiqueta'>PERSONA JUR&Iacute;DICA</td>
                                     <td>
                                          <input type='text' class='casilla' name='itc_perjur' ";
											if($row5['tipo_persona']=='2')
												echo "value='".$perjur."'";
											else echo "value='' readonly ";
												 echo "' size='40' id='itc_perjur'onKeyPress='return letras(event)' 
												 onKeyUp='validar_todo_mayus(this)'/>
                                     </td>
                                     <td height='24' class='etiqueta'><div align='center'>
                                     	  <img src='../img/casilla_azul/34.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                     <td height='24' class='etiqueta'>COND. ESP. DEL TITULAR</td>
                                     <td>
                                     	  <input name='itc_condesp' type='text' class='casillaLarga' value='".$condjuri."' 
                                     	  size='40' id='itc_condesp' READONLY />
                                     </td>
                                  </tr>
                                  <tr>
                                     <td height='24' class='etiqueta'><div align='center'>
                                     	  <img src='../img/casilla_azul/35.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                     <td height='24' class='etiqueta'>Nº RESOL. EXONERACION</td>
                                     <td>
                                     	  <input type='text' class='casillaFecha' name='itc_numresexo' value='".trim($row5_2['nume_resolucion'])."' 
                                     	  size='9' READONLY id='itc_numresexo' />
                                     </td>
                                     <td height='24' class='etiqueta'><div align='center'>
                                     	  <img src='../img/casilla_azul/36.png' alt='Guardar estado?' width='17' height='17' border='0' /></div>
                                     </td>
                                     <td height='24' class='etiqueta'>Nº BOL. PENSIONISTA</td>
                                     <td>
                                     	  <input type='text' class='casillaFecha' name='itc_numbolpen' value=''  size='9' id='itc_numbolpen'
                                      	  READONLY />
                                     </td>
                                   </tr>
                                   <tr>
                                     <td height='24' class='etiqueta'><div align='center'>
                                     	  <img src='../img/casilla_azul/37.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                     <td height='24' class='etiqueta'>INICIO EXONERACION</td>
                                     <td><input name='itc_fechainiexo' type='text' id='itc_fechainiexo' value='";
										  if (trim($row5_2['fecha_inicio'])=='31/12/1969')
										  	{ echo '';
											}
										  else echo trim($row5_2['fecha_inicio']);
										 	   echo "' size='15' readonly />
                                     
                                     <td height='24' class='etiqueta'><div align='center'>
                                     	  <img src='../img/casilla_azul/38.png' alt='Guardar estado?' width='17' height='17' border='0' /></div></td>
                                     <td height='24' class='etiqueta'>FIN EXONERACION</td>
                                     <td><input name='itc_fechafinexo' type='text' id='itc_fechafinexo' value='";
										  if (trim($row5_2['fecha_vencimiento'])=='31/12/1969')
										  	{ echo '';
											}
										  else echo trim($row5_2['fecha_vencimiento']);
										  	   echo "' size='15' READONLY />
	                               </tr>
							     </table>";
								}//fin_tipo persona
                              }//fin_si_condicion titular
                                ?>
						   <br>
						</td>
					   <tr id="personajuridica"></tr>
					</table>
				   </td>
			    </tr>
		    </table>
			<table width="980px0" align="center" cellPadding="0" cellSpacing="0" class="clsTabla2">
            <tr>
                <td></td>
            </tr>
           </table>
			<br>
		   <table width="960px" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  			<tr>
    			<td>
    
				   <table width="950px" border="0" align="center" cellpadding="0" cellspacing="0" class="tabla">
                     <tr>
                        <td class="etiquetanegra" colspan="6" height="30">
                         &nbsp;
                         	<strong>DOMICILIO FISCAL DEL TITULAR CATASTRAL:</strong>
                        </td>
                     </tr>
                     <tr>
                        <td width="26" class="etiqueta" height="24">
                            <div align="center"><img src="../img/casilla_roja/39.png" alt="Guardar estado?" width="17" height="17" border="0" /></div>
                        </td>
                        <td width="157" class="etiqueta">DEPARTAMENTO</td>
						<td width="29%"><input value= "<?php echo $Departamento1; ?>"  READONLY/></td>
                        </td>
                        <td width="23"><div align="center"><img src="../img/casilla_roja/40.png" alt="Guardar estado?" width="17" height="17" 
                        	border="0" /></div>
                        </td>
                        <td width="200"><span class="etiqueta">PROVINCIA</span></td>
						<td width="29%"><input value= "<?php echo $Provincia1; ?>"  READONLY/></td>
                          	</div> 
                        </td>
                	 </tr>
                     <tr>
                        <td height="24" class="etiqueta">
                        	<div align="center"><img src="../img/casilla_roja/41.png" alt="Guardar estado?" width="17" height="17" border="0" /></div>
                        </td>
                        <td height="24" class="etiqueta">DISTRITO</td>
						<td width="29%">
							<input value= "<?php echo $Distrito1; ?>"  READONLY/></td></div>
						</td>
                        <td colspan="2"></td>
                        <td>&nbsp;</td>
                     </tr> 
                     <tr>
                         <td width="26" height="24" class="etiqueta">
                         	 <div align="center"><img src="../img/casilla_azul/42.png" alt="Guardar estado?" width="17" height="17" border="0" /></div>
                         </td>
                         <td width="157" height="24" class="etiqueta">TEL&Eacute;FONO</td>
                      	 <td width="282">
                        	<input type="text" class="casilla" name="dftc_telf" value="<?php echo trim($row6_1['telf']);?>" size="10" id="dftc_telf" 
                        	readonly/> 
                         </td>
                         <td width="23" height="24" class="etiqueta">
                         	<div align="center"><img src="../img/casilla_azul/43.png" alt="Guardar estado?" 
                         	width="17" height="17" border="0" /></div>
                         </td>
                         <td width="200" height="24" class="etiqueta">ANEXO</td>
                         <td>
                             <input type="text" class="casilla" name="dftc_anexo" value="<?php echo trim($row6_1['anexo']);?>" size="2"  id="dftc_anexo" readonly/>
                         </td>
                      </tr>
                      <tr>
                         <td height="24" class="etiqueta">
                         	 <div align="center"><img src="../img/casilla_azul/44.png" alt="Guardar estado?" width="17" height="17" border="0" /></div>
                         </td>
                         <td height="24" class="etiqueta">FAX</td>
                         <td>
                              <input type="text" class="casilla" name="dftc_fax" value="<?php echo trim($row6_1['fax']);?>" size="10" readonly id="dftc_fax" />
                         </td>
                         <td height="24" class="etiqueta">
                         	  <div align="center"><img src="../img/casilla_azul/45.png" alt="Guardar estado?" width="17" height="17" border="0" /></div>
                         </td>
                         <td height="24" class="etiqueta">CORREO ELECTR&Oacute;NICO</td>
                         <td>
                              <input name="dftc_email" type="text" class="casillaLarga" id="dftc_email" value="<?php echo trim($row6_1['email']);?>"
                               size="40" readonly/>  
                         </td>
                      </tr>
                      <tr>
                         <td height="24" class="etiqueta">
                         	  <div align="center"><img src="../img/casilla_azul/7.png" alt="Guardar estado?" width="17" height="17" border="0" /></div>
                         </td>
                         <td height="24" class="etiqueta">C&Oacute;DIGO DE V&Iacute;A</td>
                         <td>
                              <input type="text" class="casilla" name="dftc_codvia" value="<?php echo trim($row6['codi_via']);?>" size="5"readonly 
                              id="dftc_codvia"/>
                         </td>
                         <td height="24" class="etiqueta">
                         	  <div align="center"><img src="../img/casilla_azul/8.png" alt="Guardar estado?" width="17" height="17" border="0" /></div>
                         </td>
                         <td height="24" class="etiqueta">TIPO DE V&Iacute;A</td>
                         <td>
                         	<input class="input"  id="dftc_tipovia" name="dftc_tipovia" value="<?php echo trim($row6['tipo_via']);?>" type="text" 
                         	size="5"  readonly/>
                         </td>
              		  </tr>
                      <tr>
                         <td height="24" class="etiqueta">
                         	 <div align="center"><img src="../img/casilla_azul/9.png" alt="Guardar estado?" width="17" height="17" border="0" /></div>
                         </td>
                         <td height="24" class="etiqueta">NOMBRE DE V&Iacute;A</td>
                         <td>
                             <input name="dftc_nomvia" type="text" class="casillaLarga" value="<?php echo trim($row6['nomb_via']);?>" size="45" 
                             id="dftc_nomvia" readonly/> 
                         </td>
                            <td height="24" class="etiqueta"><div align="center"><img src="../img/casilla_azul/11.png" alt="Guardar estado?" width="17" height="17" border="0" /></div>
                         </td>
                         <td height="24" class="etiqueta">N&Uacute;MERO MUNICIPAL</td>
                         <td>
                              <input type="text" class="casilla" name="dftc_nummuni" value="<?php echo trim($row6['nume_muni']);?>" size="5" readonly 
                              id="dftc_nummuni"/> 
                          </td>
                      </tr>
                      <tr>
                          <td height="24" class="etiqueta"><div align="center">
                          	   <img src="../img/casilla_azul/14.png" alt="Guardar estado?" width="17" height="17" border="0" /></div></td>
                          <td height="24" class="etiqueta">NOMBRE DE EDIFICACI&Oacute;N</td>
                          <td>
                               <input name="dftc_nomedi" type="text" class="casillaLarga" id="dftc_nomedi" value="<?php echo trim($row6['nomb_edificacion']);?>" size="32"readonly <?php echo $M;?>/>
                          </td>
                          <td height="24" class="etiqueta">
                          	   <div align="center"><img src="../img/casilla_azul/17.png"alt="Guardar estado?" width="17" height="17" border="0" /></div>
                          </td>
                          <td height="24" class="etiqueta">N&Uacute;MERO INTERIOR</td>
                          <td>
                              <input type="text" class="casilla" name="dftc_numint" value="<?php echo trim($row6['nume_interior']);?>" size="2" readonly id="dftc_numint"/>  
                          </td>
                      </tr>
                      <tr>
                          <td height="24" class="etiqueta">
                          	  <div align="center"><img src="../img/casilla_azul/18.png" alt="Guardar estado?" width="17" height="17" border="0" /></div>
                          </td>
                          <td height="24" class="etiqueta">C&Oacute;DIGO H.U.</td>
                          <td>
                              <input type="text" class="casilla" name="dftc_codhu" value="<?php echo trim($row6['codi_hab_urba']);?>" readonly size="2" id="dftc_codhu"/>
                          </td>
                          <td height="24" class="etiqueta">
                          	  <div align="center"><img src="../img/casilla_azul/19.png" alt="Guardar estado?" width="17" height="17" border="0" /></div>
                          </td>
                          <td height="24" class="etiqueta">NOMBRE DE LA H.U.</td>
                          <td>
                              <input name="dftc_nomhu" type="text" class="casillaLarga" value="<?php echo trim($row6['nomb_hab_urba']);?>" size="40" id="dftc_nomhu" readonly/>
                          </td>
                      </tr>
                      <tr>
                          <td height="24" class="etiqueta">
                          	  <div align="center"><img src="../img/casilla_azul/20.png" alt="Guardar estado?" width="17" height="17" border="0" /></div>
                          </td>
                          <td height="24" class="etiqueta">ZONA/SECTOR/ETAPA</td>
                          <td>
                              <input type="text" class="casilla" name="dftc_zse" value="<?php echo trim($row6['sector']);?>" size="20"  id="dftc_zse" 
                              <?php echo $M;?>readonly/> 
                          </td>
                          <td height="24" class="etiqueta">
                          	  <div align="center"><img src="../img/casilla_azul/21.png" alt="Guardar estado?" width="17" height="17" border="0" /></div>
                          </td>
                          <td height="24" class="etiqueta">MANZANA</td>
                          <td>
                               <input type="text" class="casilla" name="dftc_mzna" value="<?php echo trim($row6['mzna']);?>" size="2"readonly id="dftc_mzna" <?php echo $M;?>/>
                          </td>
                      </tr>
                      <tr>
                          <td height="26" class="etiqueta">
                          	  <div align="center"><img src="../img/casilla_azul/22.png" alt="Guardar estado?" width="17" height="17" border="0" /></div>
                          </td>
                          <td height="26" class="etiqueta">LOTE</td>
                          <td>
                          	  <input type="text" class="casilla" name="dftc_lote" value="<?php echo trim($row6['lote']);?>" size="2" readonly id="dftc_lote"/>
                          </td>
                          <td height="26" class="etiqueta">
                          	  <div align="center"><img src="../img/casilla_azul/23.png" alt="Guardar estado?" width="17" height="17" border="0" /></div>
                          </td>
                          <td height="26" class="etiqueta">SUB-LOTE</td>
                          <td>
                              <input type="text" class="casilla" name="dftc_sublote" value="<?php echo trim($row6['sublote']);?>" size="2"readonly id="dftc_sublote" <?php echo $M;?>/></td>
                       </tr>
          			</table>
		  		  <br> </td>
  			    </tr>
	        </table><br>
		    <table width="960px" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
                <tr>
                  <td>
                    <table width="950px" border="0" align="center" cellpadding="0" cellspacing="0" class="tabla">
                      <tr>
                          <td class="etiquetanegra" colspan="6" height="30">&nbsp;<strong>CARACTER&Iacute;STICAS DE LA TITULARIDAD: </strong></td>
                      </tr>
                      <tr>
                      	  <td width="3%" class="etiqueta" height="24">
                      	  	  <div align="center"><img src="../img/casilla_roja/46.png" alt="Guardar estado?" width="17" height="17" border="0" /></div>
                      	  </td>
                      	  <td width="17%" class="etiqueta">CONDICI&Oacute;N DEL TITULAR</td>
                      	   <td width="29%"><input value= "<?php echo $contitular?>"  readonly/></td>
                      	  <td width="3%" class="etiqueta" height="24">
                      	  	  <div align="center"><img src="../img/casilla_azul/47.png" alt="Guardar estado?" width="17" height="17" border="0" /></div>
                      	  </td>
                      	  <td width="18%" class="etiqueta">FORMA DE ADQUISICI&Oacute;N</td>
                      	  <td width="29%"><input value= "<?php echo $formadq?>"  readonly/></td>
                      </tr>
                      <tr>
                      	  <td height="24" class="etiqueta">
                      	       <div align="center"><img src="../img/casilla_azul/48.png" alt="Guardar estado?" width="17" height="17"border="0" /></div>
                      	  </td>
                      	  <td height="24" class="etiqueta">FECHA DE ADQUISICI&Oacute;N</td>
                      	  <td>
                      	  	 <input name="ct_fechaadq" value="<?php 
					  				if ($fechaadqui=='31/12/1969')
									  	{ echo '';
										}
									else echo $fechaadqui;?>" type="text" class="casillaFecha" id="ct_fechaadq" 
										 size="15" READONLY/> 
                  			</td>
                      	   <td height="24" class="etiqueta">
                      	   	   <div align="center"><img src="../img/casilla_azul/49.png" alt="Guardar estado?" width="17" height="17" border="0"/></div>
                      	   </td>
                      	   <td height="24" class="etiqueta">COND. ESP. DEL PREDIO</td>
                           <td width="29%"><input value= "<?php echo $conpredio?>"  readonly/></td>
                      </tr>
                      <tr>
                           <td height="24" class="etiqueta">
                               <div align="center"><img src="../img/casilla_azul/50.png" alt="Guardar estado?" width="17" height="17" border="0"/></div>
                           </td>
                      	   <td height="24" class="etiqueta">Nº RESOL. EXONERACION</td>
                      	   <td>
                      	   	   <input type="text" class="casilla" name="ct_numresol" value="<?php echo $nroresol?>"  size="20" READONLY id="ct_numresol"/>
                      	   </td>
                      	   <td height="24" class="etiqueta">
                      	   	   <div align="center"><img src="../img/casilla_azul/51.png" alt="Guardar estado?" width="17" height="17" border="0"/></div>
                      	   </td>
                      	   <td height="24" class="etiqueta">PORCENTAJE</td>
                      	   <td>
                      	   	   <input type="text" class="casilla" name="ct_porcentaje" value="<?php echo $porcentaje?>" size="3" READONLY id="ct_porcentaje" <?php echo $N;?>/>&nbsp;(%)
                      	   </td>
                      </tr>
                      <tr>
                      	   <td height="24" class="etiqueta">
                      	   	   <div align="center"><img src="../img/casilla_azul/52.png" alt="Guardar estado?" width="17" height="17" border="0"/></div>
                      	   </td>
                      	   <td height="24" class="etiqueta">FECHA DE INICIO</td>
                      	   <td>
                      	   	   <input name="ct_fechaini" type="text" class="casillaFecha" id="ct_fechaini" value="<?php 
					  				if ($finicio=='1969-12-31')
									  	{ echo '';
										}
								  else echo $finicio;?>" size="15" READONLY/>			
                    	   <td height="24" class="etiqueta">
                    	   	   <div align="center"><img src="../img/casilla_azul/53.png" alt="Guardar estado?" width="17" height="17" border="0"/></div>
                    	   </td>
                      	   <td height="24" class="etiqueta">FECHA DE VENCIMIENTO</td>
                           <td>
                           	   <input name="ct_fechafin" type="text" class="casillaFecha" id="ct_fechafin" value="<?php 
								   if ($fvencimiento=='1969-12-31')
												  	{ echo '';
													}
								   else echo $fvencimiento; ?>" size="15"READONLY />	
                     
                      </tr>
                    </table>
                    <br />
                  </td>
                </tr>
            </table>
		   <br>
	    <table width="960px" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  		 <tr>
          <td>
				<table width="950px" border="0" align="center" cellpadding="0" cellspacing="0" class="tabla">
                	<tr>
                  		 <td class="etiquetanegra" colspan="6" height="30">&nbsp;<strong>DESCRIPCI&Oacute;N DEL PREDIO: </strong> </td>                      
                	</tr>
					<tr>
                      	  <td>
                      	  	  <div align="center"><img src="../img/casilla_roja/54.png" alt="Guardar estado?" width="17" height="17" border="0" /></div>
                      	  </td>
                      	  <td class="etiqueta">CLASIFICACI&Oacute;N DEL PREDIO</td>
                      	   <td><input value= "<?php echo $clasificacion; ?>"  readonly/></td>
                      	  <td width="1%">
                      	  	  <div align="center"><img src="../img/casilla_azul/55.png" alt="Guardar estado?" width="17" height="17" border="0" /></div>
                      	  </td>
                          <td height="24" class="etiqueta">PREDIO CATASTRAL EN</td>
                      	  <td><input value= "<?php echo $prediocat; ?>"  readonly /></td> 
                   </tr>
                    <tr>
                      	  <td width="1%">
                      	       <div align="center"><img src="../img/casilla_azul/56.png" alt="Guardar estado?" width="17" height="17"border="0" /></div>
                      	  </td>
                      	  <td height="24" class="etiqueta">C&Oacute;D. DE USO</td>
                      	  <td><input type="hidden" value= "<?php echo $prediocat; ?>"  readonly/></td> 
                      	  <td>
                      	  	  <div align="center"><img src="../img/casilla_azul/57.png" alt="Guardar estado?" width="17" height="17" border="0" /></div>
                      	  </td>
                      	  <td height="24" class="etiqueta">USO PREDIO CATASTRAL (DESCRIPCI&Oacute;N)</td>
                      	  <!-- <td height="50" class="etiqueta">USO PREDIO CATASTRAL (DESCRIPCI&Oacute;N)</td> -->
                      	 
                    </tr>  

                    <tr>
                    	   <td height="15" width="100" class="etiqueta">&nbsp;</td>
                    	   <td width="15%"><input value= "<?php echo $usopredio; ?>"  readonly/></td>
                    </tr>


                           <td>
                      	   	   <div align="center"><img src="../img/casilla_azul/58.png" alt="Guardar estado?" width="17" height="17" border="0"/></div>
                      	   </td>
                      	   <td height="24" class="etiqueta">ESTRUCTURACI&Oacute;N</td>
                           <td width="29%"><input name="dp_estructura" type="text" value="<?php echo trim($row7['estructuracion']);?>" class="casillaLarga" id="dp_estructura" READONLY/> </td>
                           
                           <td>
                               <div align="center"><img src="../img/casilla_azul/59.png" alt="Guardar estado?" width="17" height="17" border="0"/></div>
                           </td>
                      	   <td height="24" class="etiqueta">ZONIFICACI&Oacute;N</td>
                      	   <td>
                      	   	   <input type="text" class="casillaLarga" name="dp_zonifica" value="<?php echo trim($row7['zonificacion']);?>" READONLY id="dp_zonifica"/>
                      	   </td>
                   
                     <tr>
                      	   <td>
                      	   	   <div align="center"><img src="../img/casilla_azul/60.png" alt="Guardar estado?" width="17" height="17" border="0"/></div>
                      	   </td>
                      	   <td height="24" class="etiqueta">&Aacute;REA TERRENO T&Iacute;TULO</td>
                      	   <td>
                      	   	    <input type="text" class="casillaFecha" name="dp_areatitulo" value="<?php 
									if ($row7['area_titulo']==0.00) echo '';
									else echo trim($row7['area_titulo']);?>" READONLY  id="dp_areatitulo"  <?php echo $N;?>/>
                          			&nbsp;(M2)
                      	   </td>

                      	   <td>
                      	   	   <div align="center"><img src="../img/casilla_azul/61.png" alt="Guardar estado?" width="17" height="17" border="0"/></div>
                      	   </td>
                      	   <td height="24" class="etiqueta">&Aacute;REA TERRENO DECLARADA</td>
                      	   <td  width="15%">
                      	   	   <input type="text" class="casillaFecha" name="dp_areadeclara" value="<?php 
								  if ($row7['area_declarada']==0.00) echo '';
								  else echo trim($row7['area_declarada']);?>"  id="dp_areadeclara" <?php echo $N;?>/>
                                  &nbsp;(M2)
                           </td>
                       </tr>	
                       <tr>		
                    	   <td>
                    	   	   <div align="center"><img src="../img/casilla_azul/62.png" alt="Guardar estado?" width="17" height="17" border="0"/></div>
                    	   </td>
                      	   <td height="24" class="etiqueta">&Aacute;REA TERRENO VERIFICADA</td>
                           <td>
                    		  <input type="text" class="casillaFecha" name="dp_areaverifica" value="<?php 
								   if ($row7['area_verificada']==0.00) echo '';
								   else echo trim($row7['area_verificada']);?>" READONLY id="dp_areaverifica" <?php echo $N;?>/>
                                   &nbsp;(M2)
                           </td>
                      </tr>  
                   <tr>
                      <td colspan="">&nbsp;</td>
                   </tr>
                   <tr>
                      <td colspan="9" valign="top">
                       <table border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF" bgcolor="#ECE9D8" class="tabla">
                          <thead>
                            <tr class="principal">
                               <th width="135">LINDEROS DE LOTE(ML)</th>
                               <th width="30">
                               		<div align="center"><img src="../img/casilla_azul/63.png" alt="Guardar estado?" width="17" height="17" border="0" /></div>
                               </th>
                               <th width="114">MEDIDA EN CAMPO</th>
                               <th width="30">
                               		<div align="center"><img src="../img/casilla_azul/64.png" alt="Guardar estado?" width="17" height="17" border="0" /></div>
                               </th>
                               <th width="114">MEDIDA SEG&Uacute;N T&Iacute;TULO</th>
                               <th width="30">
                               		<div align="center"><img src="../img/casilla_azul/65.png" alt="Guardar estado?" width="17" height="17" border="0" /></div>
                               </th>
                               <th width="114">COLINDANCIAS EN CAMPO</th>
                               <th width="30">
                               		<div align="center"><img src="../img/casilla_azul/66.png" alt="Guardar estado?" width="17" height="17" border="0" /></div>
                               </th>
                               <th width="114">COLINDANCIAS SEG&Uacute;N T&Iacute;TULO</th>
                             </tr>
                           </thead>
                          <tbody>
                            <tr class="normal">
                               <td class="principal"><b>&nbsp;&nbsp;&nbsp;</b>FRENTE</td>
                               <td colspan="2" align="center">
                                    <input type="text" class="casillaDatos" name="dp_medcam_fre" value="<?php echo trim($row7_1['fren_campo']); ?>" READONLY id="dp_medcam_fre" <?php echo $Ncoma;?>/> 
                               </td>
                               <td colspan="2" align="center">
                                    <input type="text" class="casillaDatos" name="dp_medsegtitu_fre" value="<?php echo trim($row7_1['fren_titulo']); ?>" READONLY id="dp_medsegtitu_fre" <?php echo $Ncoma;?>/>
                               </td>
                               <td colspan="2" align="center">
                                    <input type="text" class="casillaDatos" name="dp_colcam_fre" value="<?php echo trim($row7_1['fren_colinda_campo']); 
                                    ?>" READONLY id="dp_colcam_fre" <?php echo $M;?>/>  
                               </td>
                               <td colspan="2" align="center">
                                     <input type="text" class="casillaDatos" name="dp_colsegtitu_fre" 
                                     value="<?php echo trim($row7_1['fren_colinda_titulo']); ?>" READONLY id="dp_colsegtitu_fre" <?php echo $M;?>/> 
                               </td>
                            </tr>
                            <tr class="normal">
                               <td class="principal"><b>&nbsp;&nbsp;&nbsp;</b>DERECHA</td>
                               <td colspan="2" align="center">
                                      <input type="text" class="casillaDatos" name="dp_medcam_der" value="<?php echo trim($row7_1['dere_campo']); ?>" READONLY id="dp_medcam_der" <?php echo $Ncoma;?>/> 
                               </td>
                               <td colspan="2" align="center">
                               		<input type="text" class="casillaDatos" name="dp_medsegtitu_der" value="<?php echo trim($row7_1['dere_titulo']); ?>" READONLY id="dp_medsegtitu_der" <?php echo $Ncoma;?>/>
                               </td>
                               <td colspan="2" align="center">
                                    <input type="text" class="casillaDatos" name="dp_colcam_der" value="<?php echo trim($row7_1['dere_colinda_campo']); 
                                    ?>" READONLY id="dp_colcam_der" <?php echo $M;?>/> 
                               </td>
                               <td colspan="2" align="center">
                                    <input type="text" class="casillaDatos" name="dp_colsegtitu_der" 
                                    value="<?php echo trim($row7_1['dere_colinda_titulo']); ?>" READONLY id="dp_colsegtitu_der" <?php echo $M;?>/> 
                               </td>
                            </tr>
                            <tr class="normal">
                               <td class="principal"><b>&nbsp;&nbsp;&nbsp;</b>IZQUIERDA</td>
                               <td colspan="2" align="center">
                                     <input type="text" class="casillaDatos" name="dp_medcam_izq" value="<?php echo trim($row7_1['izqu_campo']); ?>" READONLY id="dp_medcam_izq" <?php echo $Ncoma;?>/> 
                               </td>
                               <td colspan="2" align="center">
                                     <input type="text" class="casillaDatos" name="dp_medsegtitu_izq" value="<?php echo trim($row7_1['izqu_titulo']);?>" READONLY id="dp_medsegtitu_izq" <?php echo $Ncoma;?>/> 
                               </td>
                               <td colspan="2" align="center">
                                     <input type="text"class="casillaDatos"name="dp_colcam_izq"value="<?php echo trim($row7_1['izqu_colinda_campo']);?>" READONLY id="dp_colcam_izq" <?php echo $M;?>/> 
                               </td>
                               <td colspan="2" align="center">
                                     <input type="text" class="casillaDatos" name="dp_colsegtitu_izq" 
                                     value="<?php echo trim($row7_1['izqu_colinda_titulo']); ?>" READONLY id="dp_colsegtitu_izq" <?php echo $M;?>/> 
                               </td>
                            </tr>
                            <tr class="normal">
                                <td class="principal"><b>&nbsp;&nbsp;&nbsp;</b>FONDO</td>
                              <td colspan="2" align="center">
<input type="text" class="casillaDatos" name="dp_medcam_fon" value="<?php echo trim($row7_1['fond_campo']); ?>" READONLY id="dp_medcam_fon" <?php echo $Ncoma;?>/> 
                                </td>
                                <td colspan="2" align="center">
<input type="text" class="casillaDatos" name="dp_medsegtitu_fon" value="<?php echo trim($row7_1['fond_titulo']); ?>"READONLY id="dp_medsegtitu_fon" <?php echo $Ncoma;?>/>
                                </td>
                            <td colspan="2" align="center">
<input type="text" class="casillaDatos" name="dp_colcam_fon" value="<?php echo trim($row7_1['fond_colinda_campo']); ?>" READONLY id="dp_colcam_fon" <?php echo $M;?>/></td>
                                <td colspan="2" align="center">
                                      <input type="text" class="casillaDatos" name="dp_colsegtitu_fon" 
                                      value="<?php echo trim($row7_1['fond_colinda_titulo']); ?>" READONLY id="dp_colsegtitu_fon" <?php echo $M;?>/>  
                                </td>
                            </tr>
                           </tbody>
                         </table>
                        </td>
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
                         		 &nbsp;<strong>SERVICIOS B&Aacute;SICOS:</strong>
                          </td>
                       </tr>
                       <tr>
                          <td width="95" class="etiqueta" height="24">
                          	<div align="center"><img src="../img/casilla_azul/67.png" alt="Guardar estado?" width="17" height="17" border="0" /></div>
                       	  </td>
                          <td width="95" class="etiqueta">LUZ</td>
                          <td width="268"><input name="sb_luz" type="checkbox" DISABLED id="sb_luz" value="1" <?php 
								if ($row8['luz']==1) echo "checked='checked'"; ?>>
						  </td>
                          <td width="36" class="etiqueta" height="24">
                       		<div align="center"><img src="../img/casilla_azul/68.png" alt="Guardar estado?" width="17" height="17" border="0" /></div>
                          </td>
                          <td width="170" class="etiqueta">AGUA</td>
                          <td width="286">
                          	<span class="etiqueta">
                            	<input name="sb_agua" type="checkbox" DISABLED id="sb_agua" value="1" <?php 
								 if ($row8['agua']==1) echo "checked='checked'"; ?>/>
                            </span>
                          </td>
                      </tr>
                      <tr>
                         <td width="95" height="24" class="etiqueta">
                         	<div align="center"><img src="../img/casilla_azul/69.png" alt="Guardar estado?" width="17" height="17" border="0" /></div>
                         </td>
                         <td width="95" height="24" class="etiqueta">TEL&Eacute;FONO</td>
                         <td width="268">
                         	<span class="etiqueta">
                            	<input name="sb_telefono" type="checkbox" DISABLED id="sb_telefono" value="1" <?php 
							   		if ($row8['telefono']==1) echo "checked='checked'"; ?>/>
                            </span>
                         </td>
                         <td width="36" height="24" class="etiqueta">
                         	<div align="center"><img src="../img/casilla_azul/70.png" alt="Guardar estado?" width="17" height="17" border="0" /></div>
                         </td>
                         <td width="170" height="24" class="etiqueta">DESAGÜE</td>
                         <td>
                         	<input name="sb_desague" type="checkbox" DISABLED id="sb_desague" value="1" <?php 
								if ($row8['desague']==1) echo "checked='checked'"; ?>/>
						 </td>
                      </tr>
                      <tr>
                         <td width="95" height="24" class="etiqueta">
                         	<div align="center"><img src="../img/casilla_azul/71.png" alt="Guardar estado?" width="17" height="17" border="0" /></div>
                         </td>
                         <td width="95" height="24" class="etiqueta">Nº SUMINISTRO LUZ</td>
                         <td width="268">
                         	<input type="text" class="casillaDoc" name="sb_numsumluz" value="<?php echo trim($row8['nume_sum_luz']); ?>" READONLY id="sb_numsumluz" <?php echo $M;?>/>
                         </td>
                         <td width="36" height="24" class="etiqueta">
                         	<div align="center"><img src="../img/casilla_azul/72.png" alt="Guardar estado?" width="17" height="17" border="0" /></div>
                         </td>
                         <td width="170" height="24" class="etiqueta">Nº CONTRATO AGUA</td>
                         <td>
                         	<input type="text" class="casillaDoc" name="sb_numconagua"  value="<?php echo trim($row8['nume_contrato_agua']); ?>" READONLY id="sb_numconagua" <?php echo $M;?>/>
                         </td>
                      </tr>
                      <tr>
                         <td height="24" class="etiqueta">
                         	<div align="center"><img src="../img/casilla_azul/73.png" alt="Guardar estado?" width="17" height="17" border="0" /></div>
                         </td>
                         <td height="24" class="etiqueta">Nº TEL&Eacute;FONO</td>
                         <td colspan="4">
                         	<input type="text" class="casillaDoc" name="sb_numtelf" value="<?php echo trim($row8['nume_telefono']); ?>" READONLY id="sb_numtelf" <?php echo $M;?>/>
                         </td>
                      </tr> 
            		</table>
	              <br>	</td>
  				</tr>
			</table>
			<table width="980px" align="center" cellPadding="0" cellSpacing="0" class="clsTabla2">
            	<tr>
                	<td></td>
            	</tr>
        	</table>     
				<br>
			<table width="970px" border="1" align="center" cellPadding="0" cellSpacing="0" bordercolor="#000000" >
            	<tr>
                   <td>
                    <table width="950px" border="0" align="center" cellpadding="0" cellspacing="0" class="tabla">
                      <tr>
                         <td class="etiquetanegra" colspan="2" height="30">
                            &nbsp;<strong>CONSTRUCCIONES: </strong></td>
                      </tr>
                      <tr>
                         <td colspan="2" valign="top">
                        	<table id="construccion" width="950px" border="1" align="center" cellpadding="0" cellspacing="0" class="tabla">
                              <thead>
                                <tr>
                                  <th width="7%" rowspan="2" scope="col"><p>
                                  	   <img src="../img/casilla_azul/74.png" alt="Guardar estado?" width="17" height="16" border="0" /></p>     
                                  </th>
                                  <th width="9%" rowspan="2" scope="col"><p>
                                  		<img src="../img/casilla_azul/75.png" alt="Guardar estado?" width="17" height="16" border="0" /></p>
                                  </th>
                                  <th width="5%" rowspan="2" scope="col">
                                  		<img src="../img/casilla_azul/76.png" alt="Guardar estado?" width="17" height="16" border="0" />
                                  </th>
                                  <th width="5%" rowspan="2" scope="col">
                                  		<img src="../img/casilla_azul/77.png" alt="Guardar estado?" width="17" height="16" border="0" />
                                  </th>
                                  <th width="5%" rowspan="2" scope="col">
                                  		<img src="../img/casilla_azul/78.png" alt="Guardar estado?" width="17" height="16" border="0" />
                                  </th>
                                  <th colspan="7" scope="col">
                                  		<span class="Estilo9">CATEGOR&Iacute;AS</span>
                                  </th>
                                  <th colspan="2" scope="col">
                                  		<span class="Estilo9">AREA CONSTRU&Iacute;DA (M2)</span>
                                  </th>
                                  <th width="4%" rowspan="3" scope="col">
                                  		<img src="../img/casilla_azul/88.png" alt="Guardar estado?" width="17" height="16" border="0" />
                                  </th>
                                  
                               </tr>
                               <tr>
                                  <th height="14" colspan="2">
                                  	  <span class="Estilo9">ESTRUCTURA</span>
                                  </th>
                                  <th colspan="4">
                                  	  <span class="Estilo9">ACABADOS</span>
                                  </th>
                                  <th width="9%" rowspan="2">
                                  		<img src="../img/casilla_azul/85.png" alt="Guardar estado?" width="17" height="16" border="0" />
                                  </th>
                                  <th width="7%" rowspan="2">
                                  		<img src="../img/casilla_azul/86.png" alt="Guardar estado?" width="17" height="16" border="0" />
                                  </th>
                                  <th width="7%" rowspan="2" >
                                  		<img src="../img/casilla_azul/87.png" alt="Guardar estado?" width="17" height="16" border="0" />
                                  </th>
                               </tr>
                               <tr class="principal">
                                  <th width="50" rowspan="2" scope="col">N&ordm; PISO SOTANO MEZZANINE</th>
                                  <th width="90" rowspan="2" scope="col">FECHA CONSTRUCi&Oacute;N</th>
                                  <th width="50" rowspan="2" scope="col">MEP</th>
                                  <th width="50" rowspan="2" scope="col">ECS</th>
                                  <th width="50" rowspan="2" scope="col">ECC</th>
                                  <th width="80" height="20" class="secundario Estilo9">
                                  		<img src="../img/casilla_azul/79.png" alt="Guardar estado?" width="17" height="16" border="0" />
                                  </th>
                                  <th width="70" class="secundario Estilo9">
                                  		<img src="../img/casilla_azul/80.png" alt="Guardar estado?" width="17" height="16" border="0" />
                                  </th>
                                  <th width="60" class="secundario Estilo9">
                                  		<img src="../img/casilla_azul/81.png" alt="Guardar estado?" width="17" height="16" border="0" />
                                  </th>
                                  <th width="60" class="secundario Estilo9">
                                  		<img src="../img/casilla_azul/82.png" alt="Guardar estado?" width="17" height="16" border="0" />
                                  </th>
                                  <th width="60" class="secundario Estilo9">
                                  		<img src="../img/casilla_azul/83.png" alt="Guardar estado?" width="17" height="16" border="0" />
                                  </th>
                                  <th width="6%" class="secundario Estilo9">
                                  		<img src="../img/casilla_azul/84.png" alt="Guardar estado?" width="17" height="16" border="0" />
                                  </th>
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
            			<?php            
					//---------------------------------------------------------------- CONSTRUCCIONES   
						   					if($con_c<0) //no hay registros
					 {
					echo "<div id='linea2_0'  style='width:950'>
								   	  <input  name='c_psm-0' type='text'  READONLY id='c_psm-0' value='' style='width:60px'/>
								      <input name='c_fecha-0' type='text' value=''  id='c_fecha-0' ".$VF." style='width:95px'/>
								      <input  name='c_mep-0' type='text'  READONLY id='c_mep-0' value='' style='width:45px'/>
								      <input  name='c_ecs-0' type='text'  READONLY id='c_ecs-0' value='' style='width:45px'/>
								      <input  name='c_ecc-0' type='text'  READONLY id='c_ecc-0' value='' style='width:45px'/>";

								echo"<input  class='input' name='c_myc-0' value='' type='text' id='c_myc-0' READONLY ".$L." style='width:65px'/>
								     <input  class='input' name='c_t-0' type='text' id='c_t-0' value=''  READONLY  style='width:60px'/>
								     <input  class='input' name='c_p-0' type='text' id='c_p-0' value='' READONLY".$L." style='width:60px'/>
								     <input  class='input' name='c_pyv-0' type='text' id='c_pyv-0' value='' READONLY ".$L." style='width:55px'/>
								     <input  class='input' name='c_r-0' type='text' id='c_r-0' value='' READONLY ".$L." style='width:55px'/>
								     <input  class='input' name='c_b-0' type='text' id='c_b-0' value='' READONLY ".$L." style='width:50px'/>
								     <input  class='input' name='c_ies-0' type='text' id='c_ies-0' ".$L." value='' style='width:75px'/>
								     <input  class='input' name='c_d-0' type='text' id='c_d-0' value='' style='width:75px' />
								     <input  class='input' name='c_v-0' type='text' id='c_v-0' value='' style='width:70px' />
                              		 <input  name='UCA-0' type='text'  READONLY id='UCA-0' value='' style='width:40px'/>";
                        
						
		                        echo "</div>";
					 		}		
						  else
					 		{            
							   $indice2=0;
							   while($row9=pg_fetch_array($consulta_c))
							{  
					echo "<div id='linea2_".$indice2."'  style='width:950'>
   							<input  name='c_psm-".$indice2."' type='text'id='c_psm-".$indice2."' value='".trim($row9['nume_piso'])."' style='width:65px'/>
   						   	<input name='c_fecha-' id='c_fecha' type='text'  value='";
   						   		if (trim($row9['fecha'])=='1969-12-31')
							  		{ echo '';
							  		}
							 	else echo trim($row9['fecha']);
								echo "' style='width:85px' readonly />
   						   	<input  name='c_mep1-".$indice2."' READONLY type='text'  READONLY id='c_mep1-".$indice2."' value='".
                            trim($row9['mep'])."' style='width:43px'/>  
							<input  name='c_ecs1-".$indice2."' READONLY type='text'  READONLY id='c_ecs1-".$indice2."' value='".
							trim($row9['ecs'])."'style='width:43px'/> 
							<input  name='c_ecc1-".$indice2."' READONLY type='text'  READONLY id='c_ecc1-".$indice2."' value='".
							trim($row9['ecc'])."'style='width:43px'/>  ";

					echo "<input class='input' READONLY name='c_myc-".$indice2."' value='".trim($row9['estr_muro_col'])."' type='text' 
						    id='c_myc-0".$indice2."' ".$L." style='width:75px'/>
						  <input READONLY name='c_t-0".$indice2."' type='text' id='c_t-0".$indice2."' value='".trim($row9['estr_techo'])."' style='width:65px'/>
						  <input  READONLY name='c_p-0".$indice2."' type='text' id='c_p-0".$indice2."' value='".trim($row9['acab_piso'])."'".$L." style='width:60px'/>
						  <input READONLY name='c_pyv-0".$indice2."' type='text' id='c_pyv-0".$indice2."' value='".trim($row9['acab_puerta_ven'])."'  ".$L." style='width:60px'/>
						  <input READONLY name='c_r-0".$indice2."' type='text' id='c_r-0".$indice2."' value='".trim($row9['acab_revest'])."'".$L." style='width:55px'/>
						  <input READONLY name='c_b-0".$indice2."' type='text' id='c_b-0".$indice2."' value='".trim($row9['acab_bano'])."'".$L." style='width:50px'/>
						  <input READONLY name='c_ies-0".$indice2."' type='text' id='c_ies-0".$indice2."' ".$L." value='".trim($row9['inst_elect_sanita'])."' style='width:85px'/>
						  <input READONLY name='c_d-0".$indice2."'type='text'id='c_d-0".$indice2."'value='".trim($row9['area_declarada'])."' style='width:65px' />
						  <input readonly name='c_v-0".$indice2."'type='text' id='c_v-0".$indice2."'value='".trim($row9['area_verificada'])."' style='width:65px' />
                          <input name='CON_UCA' type='text' id='CON_UCA'  value='";
							if (trim($row9['uca'])=='0')
							  { echo '';
							  }
							 else echo trim($row9['uca']);
								echo "' style='width:40px' readonly />";

                //                		if($indice2<$nro_c)
								 //  { echo  "<input class='bt_plus2' id='1' type='button' value='-' name='bt2' /> "; }
									// else { echo  "<input class='bt_plus2' id='1' type='button' value='+' /> "; }
         //                				   echo "</div>";
         //                         		  $indice2++; 
								  }
								}
						?>
                                
                                  </th>
                                </tr>
                              </thead>
                            <tbody>
                            </tbody>                                    
                          </table>                          
                         </td>
                        </tr>
						<tr>
                            <td colspan="5"></td>
                        </tr>
                        <tr>
                            <td class="etiqueta" colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td width="48" height="24" class="etiquetanegra">
                              <div align="center"><img src="../img/casilla_azul/89.png" alt="Guardar estado?" width="17" height="16" border="0" /></div>
                            </td>
                            <td width="902" height="24" class="etiquetanegra"><strong>PORCENTAJE DE BIEN COM&Uacute;N</strong></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                              <table width="99%" cellpadding="0" cellspacing="0" class="tabla">
                                <tr>
                                    <td width="20%" height="24" class="etiqueta">&nbsp;&nbsp;&nbsp;TERRENO LEGAL</td>
                                    <td width="25%">
                                        <input type="text" class="casilla" name="c_terreleg" value="<?php 
									       if($row7['porc_bc_terr_legal']==0.00)
									  			{ echo ''; }
									  	   else echo trim($row7['porc_bc_terr_legal']); ?>" size="5"  id="c_terreleg" <?php echo $N;?>/>
									</td>
                                    <td width="25%" class="etiqueta">TERRENO F&Iacute;SICO</td>
                                    <td class="tabla">
                                      	<input type="text" class="casilla" name="c_terrfis"  value="<?php 
									  		if($row7['porc_bc_terr_fisc']==0.00)
									  			{ echo ''; }
									  		else echo trim($row7['porc_bc_terr_fisc']); ?>" size="5"  id="c_terrfis" <?php echo $N;?>/> 
									</td>
                                </tr>
                                <tr>
                                    <td height="24" class="etiqueta">&nbsp;&nbsp;&nbsp;CONSTRUCCI&Oacute;N LEGAL</td>
                                    <td width="320">
                                        <input type="text" class="casilla" name="c_consleg"  value="<?php 
										  if($row7['porc_bc_const_legal']==0.00)
										  { echo ''; }
										  else echo trim($row7['porc_bc_const_legal']); ?>" size="5" id="c_consleg" <?php echo $N;?>/> 
									</td>
                                    <td width="155" class="etiqueta">CONSTRUCCI&Oacute;N F&Iacute;SICA</td>
                                    <td class="tabla">
                                        <input type="text" class="casilla" name="c_consfis"  value="<?php 
										  if($row7['porc_bc_const_fisc']==0.00)
										  { echo ''; }
										  else echo trim($row7['porc_bc_const_fisc']); ?>" size="5"  id="c_consfis" <?php echo $N;?>/> 
									</td>
                                </tr>
                              </table> 
                            </td>
                        </tr>
                     </table>
                   <br></td>
                </tr>
             </table>
			<br>
        	<table width="960px" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
		  		<tr>
		    	   <td colspan="4" height="30">
		    	   		<span class="tabla">&nbsp;<strong>OBRAS COMPLEMENTARIAS / OTRAS INSTALACIONES:</strong></span>
		    	   </td>
            	</tr>
                <tr>
                   <td colspan="4" valign="top">
                      <table width="960px" border="1" align="left" cellpadding="0" cellspacing="0" class="tabla">
                          <tr class="principal">
                             <td width="48" >
                                <div align="center"><img src="../img/casilla_azul/90.png" alt="Guardar estado?" width="17" height="16" border="0" />
                                    </th>
                                </div>
                             <td width="250" scope="col">
                                <div align="center">
                                	<img src="../img/casilla_azul/91.png" alt="Guardar estado?" width="17" height="16" border="0" />
                                </div>
                             </td>
                             <td width="102" scope="col">
                             	<div align="center">
                             		<img src="../img/casilla_azul/75.png" alt="Guardar estado?" width="17" height="16" border="0" /></div>
                             </td>
                             <td width="55" scope="col">
                             	<div align="center">
                             		<img src="../img/casilla_azul/76.png" alt="Guardar estado?" width="17" height="16" border="0" /></div>
                             </td>
                             <td width="55" scope="col">
                             	<div align="center">
                             		<img src="../img/casilla_azul/77.png" alt="Guardar estado?" width="17" height="16" border="0" /></div>
                             </td>
                             <td width="51" scope="col">
                             	<div align="center">
                             		<img src="../img/casilla_azul/78.png" alt="Guardar estado?" width="17" height="16" border="0" /></div>
                             </td>
                             <td colspan="3" scope="col"><div align="center"><strong>DIMENSIONES VERIFICADAS
                        </th>
                             </strong></div>
                             <td width="68" scope="col">
                             	<div align="center">
                             		<img src="../img/casilla_azul/95.png" alt="Guardar estado?" width="17" height="16" border="0" /></div>
                             </td>
                             <td width="52" scope="col">
                             	<div align="center">
                             		<img src="../img/casilla_azul/96.png" alt="Guardar estado?" width="17" height="16" border="0" /></div>
                             </td>
							 <td width="41" scope="col">
							 	<div align="center">
							 		<img src="../img/casilla_azul/88.png" alt="Guardar estado?" width="17" height="16" border="0" /></div>
							 </td>
                             
                             
                             </td>
                         </tr>
                         <tr class="principal">
                             <th width="48" rowspan="2" >CODIGO</th>
                             <th width="250" rowspan="2" scope="col">DESCRIPCI&Oacute;N</th>
                             <th width="102" rowspan="2" scope="col">FECHA DE CONSTRUCCION</th>
                             <th width="55" rowspan="2" scope="col">MEP</th>
                             <th width="55" rowspan="2" scope="col">ECS</th>
                             <th width="51" rowspan="2" scope="col">ECC</th>
                             <th width="40" class="secundario">
                             	<img src="../img/casilla_azul/89.png" alt="Guardar estado?" width="17" height="16" border="0" />
                             </th>
                             <th width="41" class="secundario">
                             	<img src="../img/casilla_azul/89.png" alt="Guardar estado?" width="17" height="16" border="0" />
                             </th>
                             <th width="30" class="secundario">
                             	<img src="../img/casilla_azul/89.png" alt="Guardar estado?" width="17" height="16" border="0" />
                             </th>
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
      						<?php            
					//---------------------------------------------------------------- INSTALACIONES   
								if($con_i<0) //no hay registros
					 			{
								echo "<div id='linea3_0' >
        							  <input class='input' readonly='readonly' name='oc_cod-0' type='text'  id='oc_cod-0' ' value='' style='width:50px'/>
        							  <input class='input' name='oc_des-0' type='text'  id='oc_des-0' readonly='readonly' value='' style='width:260px'/>
        							  <input name='oc_fecha-0' type='text' class='input' id='oc_fecha-0'  ".$VF." value=''  style='width:110px'/>	
        					  		  <input  name='c_mep1-0' type='text'  READONLY id='c_mep-0' value='' style='width:55px'/>
								      <input  name='c_ecs1-0' type='text'  READONLY id='c_ecs-0' value='' style='width:55px'/>
								      <input  name='c_ecc1-0' type='text'  READONLY id='c_ecc-0' value='' style='width:55px'/>";                           
							    echo "<input class='input' name='oc_lar-0' READONLY type='text' id='oc_lar-0' value='' style='width:60px'/>
							          <input class='input' name='oc_anc-0' READONLY type='text' id='oc_anc-0' value='' style='width:57px'/>
							          <input class='input' name='oc_alt-0' READONLY type='text' id='oc_alt-0' value='' style='width:55px'/>
							          <input class='input' name='oc_pro-0' READONLY type='text' id='oc_pro-0' value='' style='width:58px' />
							          <input name='oc_uni-0' type='text' READONLY class='input' id='oc_uni-0' value='' style='width:56px'/>
                              		  <input  name='UCA-1' type='text'  READONLY id='UCA-1' value='' style='width:40px'/>";
                        		echo  "&nbsp;&nbsp; ";
						
								
                        		echo "  </div>";					 
					 			}
								else
					 			{            
								   $indice3=0;
								   while($row10=pg_fetch_array($consulta_i))
									{ 
										//*** comparamos el codi_instalacion
										$obra=trim($row10['codi_instalacion']);
										$Consulta10_1="SELECT desc_instalacion FROM tf_codigos_instalaciones WHERE codi_instalacion = '$obra'";
										$consulta_obra= $BD->Consultas($Consulta10_1);
										$row10_1=pg_fetch_array($consulta_obra);
		
								//--------------------------------------------
								echo "<div id='linea3_".$indice3."' >
                              		 <input name='oc_cod-".$indice3."' type='text' READONLY id='oc_cod-".$indice3."'  value='".trim($row10
                              		 ['codi_instalacion'])."' style='width:45px'/>
                              		 <input name='oc_des-".$indice3."' type='text' id='oc_des-".$indice3."' 
                              		 readonly='readonly' value='".trim($row10_1['desc_instalacion'])."' style='width:260px'/>
                              		 <input name='oc_fecha-".$indice3."' type='text' id='oc_fecha-".$indice3."' READONLY ".$VF." value='".
                              		 trim($row10['fecha'])."' style='width:100px'/>	
                             		 <input  name='c_mep1-".$indice3."' READONLY type='text'  READONLY id='c_mep1-".$indice3."' value='".
                             		 trim($row10['mep'])."' style='width:55px'/>  
								   	 <input  name='c_ecs1-".$indice3."' READONLY type='text'  READONLY id='c_ecs1-".$indice3."' value='".
								   	 trim($row10['ecs'])."'style='width:55px'/> 
								   	 <input  name='c_ecc1-".$indice3."' READONLY type='text'  READONLY id='c_ecc1-".$indice3."' value='".
								   	 trim($row10['ecc'])."'style='width:55px'/>  ";
								   	  

   								echo "<input class='input' READONLY name='oc_lar-".$indice3."' type='text' id='oc_lar-".$indice3."' value='".trim($row10
   									 ['dime_largo'])."' style='width:55px'/>
         							 <input class='input' READONLY name='oc_anc-".$indice3."' type='text' id='oc_anc-".$indice3."' value='".trim($row10[
         							 'dime_ancho'])."' style='width:57px'/>
         							 <input class='input' READONLY name='oc_alt-".$indice3."' type='text' id='oc_alt-".$indice3."' value='".trim($row10[
         							 'dime_alto'])."' style='width:55px'/>
         							 <input class='input' READONLY name='oc_pro-".$indice3."' type='text' id='oc_pro-".$indice3."' value='".trim($row10[
         							 'prod_total'])."' style='width:58px' />
         							 <input name='oc_uni-".$indice3."' type='text' READONLY class='input' id='oc_uni-".$indice3."' value='".trim($row10[
         							 'uni_med'])."' style='width:57px'/>
                              		 <input name='CON_UCA' type='text' id='CON_UCA'  value='";
										if (trim($row10['uca'])=='0')
										  { echo '';
										  }
										 else echo trim($row10['uca']);
											echo "' style='width:40px' readonly />";

                        		echo  "&nbsp;&nbsp; ";
										if($indice3<$nro_i)
											{ 
											echo "<input class='input'  value='' style='width:0.5px'/>";
											}
										else { 
											// echo "<input class='bt_plus3' id='12' type='button' value='+' />";
										}
				                        // echo "  </div>";
				                        //          $indice3++; 
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
				  <br>
			  <table width="960px" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  				<tr>
    				<td>
						<table width="960px" border="0" align="center" cellpadding="0" cellspacing="0" class="tabla">
                        <tr>
                            <td class="etiquetanegra" colspan="6" height="30">
                                &nbsp;<strong>DOCUMENTOS:</strong></td>
                        </tr>
                        <tr>
                          <td colspan="6" valign="top">
                              
                                <table width="960px" border="1" align="center" cellpadding="0" cellspacing="0" class="tabla">
                                    <thead>
                                    <tr class="principal">
                                        <th width="44">
                                        	<img src="../img/casilla_azul/97.png" alt="Guardar estado?" width="17" height="16" border="0" />
                                        </th>
                                        <th width="308">TIPO DE DOCUMENTO</th>
                                      	<th width="25">
                                      		<img src="../img/casilla_azul/98.png" alt="Guardar estado?" width="17" height="16" border="0" />
                                      	</th>
                                      	<th width="101">Nº DE DOCUMENTO</th>
                                     	<th width="25">
                                     		<img src="../img/casilla_azul/99.png" alt="Guardar estado?" width="17" height="16" border="0" />
                                     	</th>
                                      	<th width="127">FECHA</th>
                                      	<th width="25">
                                      		<img src="../img/casilla_azul/100.png" alt="Guardar estado?" width="17" height="16" border="0" />
                                      	</th>
                                      	<th width="186">AREA AUTORIZADA</th>
                                                                    </tr>
                                 </thead>
                               <tbody>
                                      
                                   <tr class="normal">
                                     <td colspan="10" class="celda" align="left">
		 							  <?php            
									//---------------------------------------------------------------- DOCUMENTOS   
										if($con_d<0) //no hay registros
					 						{
									     		echo " <div id='linea4_0'>
									     				<input class='input' name='d_tip_docu-0' type='text'  id='tip_docu-0' value=''style='width:390px'/>  
									     		       <input class='input' name='d_nro-0' type='text'  id='d_nro-0' value=''style='width:150px'/> 
													   <input class='input' name='d_fecha-0' type='text' id='d_fecha-0' ".$VF." value='' style='width:167px'/> 
											  		   <input class='input' name='d_area-0' type='text'  id='d_area-0' value='' style='width:230px' ".$N." />
									  				   
									                   &nbsp;&nbsp;";
																  
												echo "</div>";	 
					 						}
										else
				 						{            
										  $indice4=0;
										  while($row11=pg_fetch_array($consulta_d))
										  $docum=trim($row11['tipo_doc']);
										  $Consulta11_3="SELECT desc_codigo from tf_tablas_codigos where id_tabla='TDC' and codigo= '$docum'";
										  $consulta_document= $BD->Consultas($Consulta11_3);
										  $row11_3=pg_fetch_array($consulta_document);
										  $documento= $row11_3['desc_codigo'];
										   {    
												echo " <div id='linea4_".$indice4."'>
													   <input class='input' name='ic_nro-".$indice4."' type='text'  id='ic_nro-".$indice4."' 
								      					style='width:400px' value='".$documento."'/>
												       <input class='input' name='d_nro-".$indice4."' type='text' READONLY  id='d_nro-".$indice4."' 
												       value='".trim($row11 ['nume_doc'])."' style='width:150px'/>
												       <input class='input' name='d_fecha-".$indice4."' type='text' READONLY id='d_fecha-".$indice4."' "
												       .$VF." value='".trim($row11['fecha_doc'])."' style='width:147px'/>
			  									  	   <input class='input' name='d_area-".$indice4."' type='text' READONLY id='d_area-".$indice4."' 
			  									  	   value='".trim($row11 ['area_autorizada'])."' style='width:230px' ".$N." />";
			                   					
													//  if($indice4<$nro_d)
													// 	{ echo "<input class='bt_plus4' id='12' type='button' value='-' />"; }
													// else { echo "<input class='bt_plus4' id='12' type='button' value='+' /> ";}
										   //         		   echo "</div>";
					        //                         $indice4++; 
										   }
					                    }
									 ?>   
                                    </td>
                                   </tr>
                                </tbody>
                              </table></td>
                           </tr>

                           <tr>
                                <td class="etiqueta" colspan="6">&nbsp;&nbsp;&nbsp;</td>
                           </tr>

                           <tr>
                            	<td colspan="6" class="etiquetanegra" height="24">&nbsp;&nbsp;
                            	   <strong>REGISTRO NOTARIAL DE LA ESCRITURA P&Uacute;BLICA:</strong>
                            	</td>
                           </tr>
                           <tr>
                            	<td width="5%" class="etiqueta" height="24">
                            		<div align="center">
                            			<img src="../img/casilla_azul/101.png" alt="Guardar estado?" width="17" height="16" border="0" /></div>
                            	</td>
                            	<td width="15%" class="etiqueta">NOMBRE DE LA NOTARIA</td>
                            	<td width="29%"><input value= "<?php echo $notaria; ?>"  readonly/></td>
              			   </tr>
                           <tr>
                            	<td height="24" class="etiqueta">
                            		<div align="center">
                            			<img src="../img/casilla_azul/102.png" alt="Guardar estado?" width="17" height="16" border="0" /></div>
                            	</td>
                            	<td height="24" class="etiqueta">KARDEX</td>
                            	<td width="31%">
                          			<input type="text" class="casilla" name="d_kardex" value="<?php echo $kardex; ?>" READONLY id="d_kardex" />
                          		</td>
                            	<td width="3%" class="etiqueta" height="24">
                            		<div align="center">
                            			<img src="../img/casilla_azul/103.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                            	<td width="16%" class="etiqueta">FECHA ESCRITURA P&Uacute;BLICA</td>
                          		<td width="30%" >
                                	<input name="d_fechaescpub" type="text" class="casillaFecha" id="d_fechaescpub" 
                                	value="<?php 
			                                	if($fescritura=='1970-01-01')
												{ echo '';}
												else echo $fescritura; ?>"  size="15" READONLY/>
							    </td>
                        	</tr>
                        	<tr>
                            	<td colspan="6">&nbsp;</td>
                        	</tr>
            			  </table>
					    <br>				</td>
  				      </tr>
				   </table>
			    <br>
		     <table width="960px" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  				<tr>
    				<td>
					   <table width="960px" border="0" align="center" cellpadding="0" cellspacing="0" class="tabla">
                          <tr>
                            <td class="etiquetanegra" colspan="6" height="30">
                                &nbsp;<strong>INSCRIPCI&Oacute;N DEL PREDIO CATASTRAL EN EL REGISTRO DE PREDIOS:</strong></td>
                          </tr>
                          <tr>
                            <td width="5%" class="etiqueta" height="24">
                            	<div align="center"><img src="../img/casilla_azul/104.png" alt="Guardar estado?" width="17" height="16" border="0" /></div>
                            </td>
                            <td width="15%" class="etiqueta">TIPO PARTIDA REGISTRAL</td>
                            <td width="29%"><input value= "<?php echo $partida; ?>"  readonly/></td>
                            <td width="3%" class="etiqueta" height="24"><div align="center"><img src="../img/casilla_azul/105.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
                            <td width="16%" class="etiqueta">N&Uacute;MERO</td>
                            <td width="30%">
                                <input type="text" class="casilla" name="ipcrp_numpar" value="<?php echo trim($row12['nume_partida']); ?>" READONLY id="ipcrp_numpar"/></td>
                          </tr>
                          <tr>
                            <td height="24" class="etiqueta">
                            	<div align="center">
                            		<img src="../img/casilla_azul/106.png" alt="Guardar estado?" width="17" height="16" border="0" /></div>
                            </td>
                            <td height="24" class="etiqueta">FOJAS</td>
                            <td>
                                <input type="text" class="casilla" name="ipcrp_fojas" value="<?php echo trim($row12['fojas']); ?>" READONLY id="ipcrp_fojas"/>  
                            </td>
                            <td height="24" class="etiqueta">
                            	<div align="center">
                            		<img src="../img/casilla_azul/107.png" alt="Guardar estado?" width="17" height="16" border="0" /></div>
                            </td>
                            <td height="24" class="etiqueta">ASIENTO</td>
                            <td>
                                <input type="text" class="casilla" name="ipcrp_asiento" value="<?php echo trim($row12['asiento']); ?>" READONLY id="ipcrp_asiento"/></td>
                          </tr>
                          <tr>
                            <td height="24" class="etiqueta">
                            	<div align="center">
                            		<img src="../img/casilla_azul/108.png" alt="Guardar estado?" width="17" height="16" border="0" /></div>
                            </td>
                            <td height="24" class="etiqueta">FECHA INSCRIPCI&Oacute;N PREDIO</td>
                          	<td>
                                <input name="ipcrp_fechains" type="text" class="casillaFecha" id="ipcrp_fechains" value="<?php 
									if($row12['fech_inscripcion']=='1970-01-01')
									{ echo '';}
									else echo trim($row12['fech_inscripcion']); ?>"  size="15" READONLY/>
                            <td height="24" class="etiqueta">
                            	<div align="center">
                            		<img src="../img/casilla_azul/109.png" alt="Guardar estado?" width="17" height="16" border="0" /></div>
                            </td>
                            <td height="24" class="etiqueta">DECLARATORIA DE F&Aacute;BRICA</td>
                            <td width="29%"><input value= "<?php echo $declaratoria; ?>"  readonly/></td>
              			  </tr>
                          <tr>
                            <td height="24" class="etiqueta">
                            	<div align="center">
                            		<img src="../img/casilla_azul/110.png" alt="Guardar estado?" width="17" height="16" border="0" /></div>
                            </td>
                            <td height="24" class="etiqueta">AS. INS. DE F&Aacute;BRICA</td>
                            <td>
                                <input type="text" class="casilla" name="ipcrp_asinfab" value="<?php echo trim($row12['asie_fabrica']); ?>" READONLY id="ipcrp_asinfab"/>
                            </td>
                            <td height="24" class="etiqueta">
                            	<div align="center">
                            		<img src="../img/casilla_azul/111.png" alt="Guardar estado?" width="17" height="16" border="0" /></div>
                            </td>
                            <td height="24" class="etiqueta">FECHA INSCRIPCI&Oacute;N F&Aacute;BRICA</td>
                            <td>
                                <input name="ipcrp_fechinsfab" type="text" class="casillaFecha" id="ipcrp_fechinsfab" value="<?php
									if($row12['fecha_fabrica']=='1970-01-01')
									{ echo '';}
									else echo trim($row12['fecha_fabrica']); ?>"  size="15" READONLY/>
										
                          <tr>
                            <td colspan="2">&nbsp;</td>
                          </tr>
                       </table>
				   <br>			</td>
 			   </tr>
		   </table>
			<br>
		   <table width="960px" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
              <tr>
   				 <td>
					<table width="960px" border="0" align="center" cellpadding="0" cellspacing="0" class="tabla">
                  <tr>
                      <td colspan="6" class="etiquetanegra" height="24">&nbsp;<strong>EVALUACI&Oacute;N DEL PREDIO CATASTRAL</strong></td>
                        </tr>
                        <tr>
                            <td width="5%" height="30" class="etiquetanegra">
                            	<div align="center">
                            		<img src="../img/casilla_azul/112.png" alt="Guardar estado?" width="17" height="16" border="0" /></div>
                            </td>
                            <td height="30" colspan="4" class="etiquetanegra">&nbsp;EVALUACI&Oacute;N DEL PREDIO CATASTRAL:</td>
                        </tr>
                        <tr>
                            <td colspan="5" class="etiqueta" align="center"><p>
                              <label>
                    			<input type="radio" name="opt_evalua" value="01" id="opt_evalua_0" 
									<?php if(trim($row13['evaluacion'])=='01') {echo "checked='checked'";} ?> >
							
                                PREDIO CATASTRAL OMISO</label>
                              <label>
                                <input type="radio" name="opt_evalua" value="02" id="opt_evalua_1"
                                	<?php if(trim($row13['evaluacion'])=='02') {echo "checked='checked'";} ?> >
                                PREDIO CATASTRAL SUBVALUADO</label>
                              <label>
                                <input type="radio" name="opt_evalua" value="03" id="opt_evalua_2"
                                	<?php if(trim($row13['evaluacion'])=='03') {echo "checked='checked'";} ?> >
                                PREDIO CATASTARL SOBREVALUADO</label>
                              <label>
                                <input type="radio" name="opt_evalua" value="04" id="opt_evalua_3"
                                	<?php if(trim($row13['evaluacion'])=='04') {echo "checked='checked'";} ?> >
                                PREDIO CATASTRAL CONFORME</label></p>                            </td>
                        </tr>
                        <tr>
                            <td class="etiquetanegra" height="24">
                            	<div align="center">
                            		<img src="../img/casilla_azul/113.png" alt="Guardar estado?" width="17" height="16" border="0" /></div>
                            </td>
                            <td height="24" colspan="4" class="etiquetanegra">&nbsp;&Aacute;REA DE TERRENO INVADIDA (M2):</td>
                        </tr>
                        <tr>
                            <td height="24" class="etiqueta">&nbsp;</td>
                            <td width="24%" height="24" class="etiqueta">&nbsp;EN LOTE COLINDANTE</td>
                            <td width="22%">
                          		<input type="text" class="casilla" name="epc_lotcol" value="<?php 
								  if($row13['en_colindante']==0.00)
								  { echo '';}
								  else echo trim($row13['en_colindante']); ?>" size="5" READONLY id="epc_lotcol" <?php echo $M;?>/></td>
                            <td width="19%" class="etiqueta" height="24">EN &Aacute;REA P&Uacute;BLICA</td>
                            <td width="30%">
                                <input type="text" class="casilla" name="epc_areapub" value="<?php 
								  if($row13['en_jardin_aislamiento']==0.00)
								  { echo '';}
								  else echo trim($row13['en_jardin_aislamiento']); ?>"  size="5" READONLY id="epc_areapub" <?php echo $M;?>/> </td>
                        </tr>
                        <tr>
                            <td height="24" class="etiqueta">&nbsp;</td>
                            <td height="24" class="etiqueta">&nbsp;EN JARD&Iacute;N DE AISLAMIENTO</td>
                            <td width="22%">
                                <input type="text" class="casilla" name="epc_jarais" value="<?php 
								  if($row13['en_area_publica']==0.00)
								  { echo '';}
								  else echo trim($row13['en_area_publica']); ?>" size="5" READONLY id="epc_jarais" <?php echo $M;?>/></td>
                            <td width="19%" class="etiqueta" height="24">EN &Aacute;REA INTANGIBLE</td>
                            <td >
                                <input type="text" class="casilla" name="epc_areaint" value="<?php 
								  if($row13['en_area_intangible']==0.00)
								  { echo '';}
								  else echo trim($row13['en_area_intangible']); ?>" size="5" READONLY id="epc_areaint" <?php echo $M;?>/> </td>
		                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
           		   </table>	</td>
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
       					  <td width="4%" class="etiqueta" height="24">
       					  	<div align="center">
       					  		<img src="../img/casilla_azul/114.png" alt="Guardar estado?" width="17" height="16" border="0" /></div>
       					  </td>
       					  <td width="17%" class="etiqueta">CONDICI&Oacute;N DE DECLARANTE</td>
       					  <td width="29%"><input value= "<?php echo $condicion; ?>"  readonly/></td>
       				  </tr>
     				  <tr>
       					  <td height="10" colspan="6" class="etiqueta">&nbsp;</td>
       				  </tr>
       				  <tr>
       					  <td height="30" class="etiquetanegra">
       					  	<div align="center">
       					  		<img src="../img/casilla_azul/115.png" alt="Guardar estado?" width="17" height="16" border="0" /></div>
       					  </td>
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
			              
           		  </thead>l
                <tbody>
		             <tr class="normal">
		               <td colspan="6" align="left">
	      			    <?php	
				//---------------------------------------------------------------- LITIGANTES   
						   if($con_li<0) //no hay registros
							  {
								echo "<div id='linea5_0'>
							          <input class='input' name='ic_liti-0' type='text'   id='ic_liti-0'  style='width:155px'/>
									  <input class='input' name='ic_nro-0' type='text'   id='ic_nro-0'  style='width:155px'/>
							          <input class='input' name='ic_liti-0' type='text' id='ic_liti-0' style='width:360px'/>
							          <input class='input' name='ic_cod-0' type='text' id='ic_cod-0'style='width:218px'/>
							         </div>";
							  }
						   else
							  {            
								$indice5=0;
								 while($row14=pg_fetch_array($consulta_li))
								 $docliti=trim($row14['tipo_doc']);
								 $Consulta14_3="SELECT desc_codigo from tf_tablas_codigos where id_tabla='DOC' and codigo= '$docliti'";
								 $consulta_docliti= $BD->Consultas($Consulta14_3);
								 $row14_3=pg_fetch_array($consulta_docliti);
								 $doclitigante= $row14_3['desc_codigo'];
							  { 
								echo "<div id='linea5_".$indice5."'> 
									 <input class='input' name='ic_nro-".$indice5."' type='text'  id='ic_nro-".$indice5."' 
								      style='width:155px' value='".$doclitigante."'/>
								     <input class='input' name='ic_nro-".$indice5."' type='text'  id='ic_nro-".$indice5."' 
								      style='width:155px' value='".trim($row14['nume_doc'])."'/>
								      <input class='input' name='ic_liti-".$indice5."' type='text' ' id='ic_liti-".$indice5."' 
								      value='".trim($row14['razon_social'])."' 
								      style='width:360px'/>
								      <input class='input' name='ic_cod-".$indice5."' type='text'  id='ic_cod-".$indice5."' 
								      style='width:218px' value='".trim($row14['codi_contribuye'])."' 
								      style='width:330px'/>";
								   //        if($indice5<$nro_li)
											// 	{ echo "<input class='bt_plus5' id='12' type='button' value='-' /> "; }
										 // else {echo "<input class='bt_plus5' id='12' type='button' value='+' />"; }
								   //            echo "</div>";
								   //          $indice5++; 
											  }
						  	  }
					    ?> 
                      </td>
                   </tr>
           		</tbody>
       		  </table>	     </td>
     		</tr>
     		<tr>
       		   <td colspan="6">&nbsp;</td>
     		</tr>
     		<tr>
       		  	<td height="24" class="etiqueta">
       		  	 	<div align="center"><img src="../img/casilla_roja/116.png" alt="Guardar estado?" width="17" height="16" border="0" /></div>
       		  	</td>
	       		<td height="24" class="etiqueta">ESTADO DE LA FICHA</td>
	       		<td width="29%"><input value= "<?php echo $estado; ?>"  readonly/></td>
	       		<td width="3%" height="24" class="etiqueta">
	       			<div align="center"><img src="../img/casilla_azul/117.png" alt="Guardar estado?" width="17" height="16" border="0" /></div></td>
	      	 	<td width="18%" height="24" class="etiqueta">Nº DE HABITANTES</td>
	       		<td width="29%"><input type="text" class="casilla" name="ic_numhab" value="<?php 
				   if($row13['nume_habitantes']==0)
				   { echo '';}
				   else echo trim($row13['nume_habitantes']); ?>" size="3" readonly  id="ic_numhab" />
				</td>
     		</tr>
     		<tr>
       			<td height="24" class="etiqueta">
       				<div align="center">
       					<img src="../img/casilla_azul/118.png" alt="Guardar estado?" width="17" height="16" border="0" /></div>
       			</td>
       			<td height="24" class="etiqueta">Nº DE FAMILIAS</td>
       			<td>
       				<input type="text" class="casilla" name="ic_numfam" value="<?php 
					   if($row13['nume_familias']==0)
					   { echo '';}
					   else echo trim($row13['nume_familias']); ?>" size="3" readonly id="ic_numfam" />
				</td>
       			<td>
       				<div align="center"><img src="../img/casilla_azul/119.png" alt="Guardar estado?" width="17" height="16" border="0" /></div>
       			</td>
       			<td><span class="etiqueta">MANTENIMIENTO</span></td>
       			<td width="29%"><input value= "<?php echo $mantenimiento; ?>"  readonly/></td>
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
                            <td class="etiquetanegra" colspan="4" height="30">
                                &nbsp;<strong>OBSERVACIONES:</strong></td>
                        </tr>
                        <tr>
                            <td width="20%" class="etiqueta" height="24">&nbsp;&nbsp;OBSERVACIONES</td>
                            <td colspan="3"><textarea name="observacion" READONLY rows="4" cols="65" <?php echo $M;?> ><?php echo trim($row13['observaciones']);?></textarea></td>
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
					<table width="960px" border="0" align="center" cellpadding="0" cellspacing="0" class="tabla">
                  		<tr>
                    		<td class="etiquetanegra" colspan="5" height="30">&nbsp;<strong>FIRMAS: </strong></td>
                  		</tr>
                  		<tr>
                    		<td width="36" height="24" class="etiquetanegra">
                    			<div align="center">
                    				<img src="../img/casilla_azul/120.png" alt="Guardar estado?" width="17" height="16" border="0" /></div>
                    		</td>
                    		<td width="153" class="etiquetanegra"><strong>DECLARANTE</strong></td>
                    		<td class="etiquetanegra" height="24">&nbsp;</td>
                    		<td class="etiquetanegra" height="24">&nbsp;</td>
                    		<td width="315" height="24" class="etiquetanegra">&nbsp;</td>
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
								//  echo $dni;
				  
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
							//  echo $materno;			  
				  		  ?>
                  		<tr>
		                    <td rowspan="3" class="etiqueta">&nbsp;</td>
		                    <td height="24" class="etiqueta">DNI</td>
		                    <td width="237">
		                    	<input type="text" class="casilla" name="f_dni" value="<?php echo $dni;?>" size="10" id="f_dni" READONLY/>
		                    </td>
		                    <td width="209" class="etiqueta" height="24">NOMBRES</td>
		                    <td>
		                    	<input name="f_nom" type="text" class="casillaLarga" value="<?php echo $nombres;?>" size="40" id="f_nom" READONLY/>
		                    </td>
		                </tr>
                  		<tr>
		                    <td height="24" class="etiqueta">APELLIDO PATERNO</td>
		                    <td width="237">
		                    	<input name="f_paterno" type="text" class="casillaLarga" value="<?php echo $paterno;?>" size="32" id="f_paterno" READONLY/>
		                    </td>
		                    <td width="209" class="etiqueta" height="24">APELIDO MATERNO</td>
		                    <td>
		                    	<input name="f_materno" type="text" class="casillaLarga" value="<?php echo $materno;?>" size="40" id="f_materno" READONLY/> 
		                    </td>
                  		</tr>
                  		<tr>
		                    <td height="24" class="etiqueta">FECHA</td>
		                    <td colspan="3"><input name="f_fecha" type="text" class="casillaFecha" id="f_fecha" value="<?php
		                    //SE MODIFICÓ LA FECHA DE 31/12/1969 A 1970-01-01 PORQUE ESA FECHA SALE EN LA CAJA DE TEXTO DE FECHA 
							if($row15['fecha_declarante']=='31/12/1969')
							  		{ echo ''; }
							 	else  echo trim($row15['fecha_declarante']); ?>" size="15" READONLY/>
		                </tr>
                  		<tr>
		                    <td class="etiquetanegra" height="24">
		                    	<div align="center">
		                    		<img src="../img/casilla_azul/121.png" alt="Guardar estado?" width="17" height="16" border="0" /></div>
		                    </td>
		                    <td class="etiquetanegra" height="24"><strong>SUPERVISOR</strong></td>
		                    <td class="etiquetanegra" height="24">&nbsp;</td>
		                    <td class="etiquetanegra" height="24">&nbsp;</td>
		                    <td class="etiquetanegra" height="24">&nbsp;</td>
                  		</tr>
                  		<tr>
		                    <td height="24" class="etiqueta">&nbsp;</td>
		                    <td height="24" class="etiqueta">NOMBRES Y APELLIDOS</td>
		                    <td width="237">
		                    	<input value= "<?php echo $supervisor1; ?>"  size="32" enabled/></td>
		                    <td width="5" class="etiqueta" height="24">FECHA</td>
		                    <td>
		                    	<input name="f_fechasup" type="text" class="casillaFecha" id="f_fechasup"  value="<?php 
				                    //SE MODIFICÓ LA FECHA DE 31/12/1969 A 1970-01-01 PORQUE ESA FECHA SALE EN LA CAJA DE TEXTO DE FECHA 
									if($row19['fecha_supervision']=='1970-01-01')
									{ echo '';}
									else echo trim($row19['fecha_supervision']); ?>" size="15" READONLY />
                  			</td>
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
		                    <td width="237">
		                    	<input value= "<?php echo $tecnico1; ?>"  size="32" enabled/></td>
		                    <td width="209" class="etiqueta" height="24">FECHA</td>
                    		<td>
                    			<input name="f_fechatec" type="text" class="casillaFecha" id="f_fechatec" value="<?php 
                    			if($row20['fecha_levantamiento']=='1970-01-01')
									{ echo '';}
									else echo trim($row20['fecha_levantamiento']); ?>" size="15" READONLY />
                    			
                    		</td>
                  		</tr>
                  		<tr>
                   			 <td class="etiquetanegra" height="24">
                   			 	<div align="center">
                   			 		<img src="../img/casilla_azul/123.png" alt="Guardar estado?" width="17" height="16" border="0" /></div>
                   			 </td>
                    		<td class="etiquetanegra" height="24"><strong>VERIFICADOR CATASTRAL</strong></td>
                    		<td class="etiquetanegra" height="24">&nbsp;</td>
                    		<td class="etiquetanegra" height="24">&nbsp;</td>
                    		<td class="etiquetanegra" height="24">&nbsp;</td>
                  		</tr>
                  		<tr>
		                    <td height="24" class="etiqueta">&nbsp;</td>
		                    <td height="24" class="etiqueta">NOMBRES Y APELLIDOS</td>
		                    <td width="237">
		                    	<input value= "<?php echo $verificador1; ?>"  size="32" enabled/></td>
		                    <td width="209" class="etiqueta" height="24">FECHA</td>
		                    <td colspan="3">
		                    	<input name="f_fechaver" type="text" class="casillaFecha" id="f_fechaver" value="<?php 
                    //SE MODIFICÓ LA FECHA DE 31/12/1969 A 1970-01-01 PORQUE ESA FECHA SALE EN LA CAJA DE TEXTO DE FECHA 
									if($row21['fecha_verificacion']=='1970-01-01')
									{ echo '';}
									else echo trim($row21['fecha_verificacion']); ?>" size="15" READONLY  />
         					</td>
                  		</tr>
                  		<tr>
		                    <td height="24" class="etiqueta">&nbsp;</td>
		                    <td height="24" class="etiqueta">N&deg; REGISTRO</td>
		                    <td colspan="3">
		                    	<input type="text" class="casilla" name="f_numreg" value="<?php echo trim($row15['nume_registro']); ?>" size="15" READONLY id="f_numreg"/>
		                    </td>
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
		<input name="bGuardar" type="submit" class="booton" value="Guardar Ficha" />&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;
		<input name="bCancelar" type="button" class="booton" value="Cancelar" onClick="location='../funciones/close.php'"/>
		&nbsp;&nbsp;&nbsp;
</div>
		
	</div>
</div>
	</p>
	<br>
</div>
</form>
</div>
</body>
</html>
