<?php

session_start();

require_once 'BC_verifica_ubigeo.php';
require_once 'BC_variables.php';
require_once 'BC_verificar_insertar.php';

//Se Obtienen PRINCIPALES ID
//---------------------------------------------------------------------------------------------------------------------------------
$TF = $_POST['tipo'];
$anio = date("Y");
$IDSector = $ubigeo.$dg_sector;
$IDManzana = $IDSector.$dg_manzana;
$IDLote = $IDManzana.$dg_lote;
$IDEdificacion = $IDLote.$dg_edificacion;
$IDHabUrb = $ubigeo.$upc_codhu;
$IDUniCat = $IDEdificacion.$dg_entrada.$dg_piso.$dg_unidad;
$IDFicha = $anio.$ubigeo.$TF.$numficha;
$NumFLote = $numflote1.'-'.$numflote2;
$cuc = $dg_cuc8.$dg_cuc4;
$declara = '('.$f_dni.') - '.$f_nom.', '.$f_paterno.' | '.$f_materno;

$IDUsuario = $_SESSION['id_usuario'];
//---------------------------------------------------------------------------------------------------------------------------------

/*
Tipo de funcion:
    1 titular
    2 supervisor
    3 tecnico
    4 verificador
    5 declarante
    6 litigante
    7 conductor
Tipo Persona:
    1 natural
    2 juridico
*/

//*********************************************************************************************************************************
//---------------------------------------------------------- MANZANAS -----------------------------------------------------
/*	echo "<script>alert('TF_MANZANA');</script>\n";*/
$Seleccion = "SELECT id_mzna FROM tf_manzanas WHERE id_mzna='$IDManzana'";
$Insercion = "INSERT INTO tf_manzanas VALUES('$IDManzana','$IDSector','$dg_manzana','$upc_mzna')";
ejecuta_consulta($Seleccion, $Insercion);

//----------------------------------------------------------- LOTES -----------------------------------------------------
/*echo "<script>alert('TF_LOTE');</script>\n";*/
$Seleccion = "SELECT id_lote FROM tf_lotes WHERE id_lote='$IDLote'";
$Insercion = "INSERT INTO tf_lotes VALUES('$IDLote','$IDManzana','$dg_lote','$upc_codhu','$upc_mzna',".
            "'$upc_lote','$upc_sublote','$dp_estructura','$dp_zonifica','$dg_cuc8','$upc_zse')";
ejecuta_consulta($Seleccion, $Insercion);

//------------------------------------------------------- EDIFICACIONES -----------------------------------------------------
/*echo "<script>alert('TF_EDIFICACI�N');</script>\n";*/
$Seleccion = "SELECT id_edificacion FROM tf_edificaciones WHERE id_edificacion='$IDEdificacion'";
$Insercion = "INSERT INTO tf_edificaciones VALUES('$IDEdificacion','$IDLote','$dg_edificacion','$upc_cmb_tipoedi',".
            "'$upc_nomedi','$dp_cmb_claspre')";
ejecuta_consulta($Seleccion, $Insercion);

//---------------------------------------------------------- VIAS -----------------------------------------------------
/*echo "<script>alert('TF_VIA');</script>\n";*/
//echo $nro_vias; echo ' ';
for ($i = 0;$i < $nro_vias;$i++) {
    $IDVia = $ubigeo.$upc_codvia[$i];
    $IDPuerta = $IDLote.$upc_codpue[$i].$i;
    //---------------------------------------------- VIAS HABILITACI�N URBANA --------------------------------------
    /*echo "<script>alert('TF_VIAS_HAB_URBA');</script>\n";*/
    $Seleccion = "SELECT id_hab_urba FROM tf_vias_hab_urba WHERE id_hab_urba='$IDHabUrb'".
                "AND id_via='$IDVia'";
    $Insercion = "INSERT INTO tf_vias_hab_urba VALUES('$IDHabUrb','$IDVia')";
    ejecuta_consulta($Seleccion, $Insercion);
    //----------------------------------------------------- PUERTAS ------------------------------
    /*echo "<script>alert('TF_PUERTAS');</script>\n";*/

    //echo $IDPuerta;

    $tipoPuerta = "SELECT codigo FROM tf_tablas, tf_tablas_codigos ".
                        "WHERE tf_tablas.id_tabla = tf_tablas_codigos.id_tabla ".
                        "AND tf_tablas.id_tabla = 'TPR' AND codigo='$upc_codpue[$i]'";
    $tpuerta = $BaseDato->Consultas($tipoPuerta);
    while ($row = pg_fetch_row($tpuerta)) {
        $tipoPuerta = trim($row[0]);
    }

    $Seleccion = "SELECT id_puerta FROM tf_puertas WHERE id_puerta='$IDPuerta'";
    $Insercion = "INSERT INTO tf_puertas VALUES('$IDPuerta','$IDLote','$upc_codpue[$i]',".
                "'$tipoPuerta','$upc_num[$i]','$upc_cond[$i]','$IDVia','$upc_certi[$i]')";
    ejecuta_consulta($Seleccion, $Insercion);
}

//---------------------------------------------------- UNIDAD CATASTRAL -----------------------------------------------------
/*echo "<script>alert('TF_UNI_CAT');</script>\n";*/
$Seleccion = "SELECT id_uni_cat FROM tf_uni_cat WHERE id_uni_cat='$IDUniCat'";
$Insercion = "INSERT INTO tf_uni_cat VALUES('$IDUniCat','$IDLote','$IDEdificacion','$dg_entrada','$dg_piso',".
            "'$dg_unidad','$upc_cmb_tipoint','$cuc','','$dg_hojacatastral','$dg_codpredial','$upc_numint',".
            "'$dg_unicodpredial','$dg_codcontribuyente')";
ejecuta_consulta($Seleccion, $Insercion);

//---------------------------------------------------------- FICHA -----------------------------------------------------
/*echo "<script>alert('TF_FICHA');</script>\n";*/

/*echo $IDFicha.' ' ; echo $TF.' '; echo $numficha.' '; echo $IDLote.' '; echo $dg_dc.' ';
echo $NumFLote.' '; echo $declara.' '; echo $f_fechatec.' '; echo $f_cmb_sup.' '; echo $f_fechasup.' ';
echo $f_cmb_tec.' '; echo $f_fechatec.' '; echo $f_cmb_ver.' '; echo $f_fechaver.' ';
echo $IDUniCat.' '; echo $f_dni.' '; */
//Grabamos Ficha
$Seleccion = "SELECT id_ficha FROM tf_fichas WHERE id_ficha='$IDFicha'";
$Insercion = "INSERT INTO tf_fichas VALUES('$IDFicha','$TF','$numficha','$IDLote','$dg_dc','$NumFLote',".
            "'$declara','$f_fecha','$f_cmb_sup','$f_fechasup','$f_cmb_tec','$f_fechatec','$f_cmb_ver','$f_fechaver',".
            "'$f_numreg','$IDUniCat','$IDUsuario','$f_fecha_grabado',1)";
ejecuta_consulta($Seleccion, $Insercion);

//---------------------------------------------------------------- INGRESOS -------------------------------------------------
/*echo "<script>alert('TF_INGRESOS');</script>\n";*/
for ($i = 0;$i < $nro_vias;$i++) {
    $IDPuerta = $IDLote.$upc_codpue[$i].$i;
    $Seleccion = "SELECT id_ficha FROM tf_ingresos WHERE id_ficha='$IDFicha'".
                " AND id_puerta='$IDPuerta'";
    $Insercion = "INSERT INTO tf_ingresos VALUES('$IDFicha','$IDPuerta')";
    ejecuta_consulta($Seleccion, $Insercion);
}


//-------------------------------------------------------------- FICHA BIENES COMUNES ----------------------------------------
/*echo "<script>alert('TF_FICHAS_BIENES_COMUNES');</script>\n";*/


/*echo $IDFicha.'-'.$dp_cmb_precat.'-'.$dp_cmb_claspre.'-'.$dp_areattitulo.'-'.'0-'.$dp_areatverifica.'-';
echo $re_lotcol.'-'.$re_jarais.'-'.$re_areapub.'-'.$re_areaint.'-'.$ic_cmb_conddec.'-'.$ic_cmb_estficha.'-';
echo $ic_cmb_man.'-'.$observacion.'-'.$dp_cmb_usoprecat.'-'.$numficha;*/


$Seleccion = "SELECT id_ficha FROM tf_fichas_bienes_comunes WHERE id_ficha='$IDFicha'".
                " AND codi_uso='$dp_cmb_usoprecat'";
$Insercion = "INSERT INTO tf_fichas_bienes_comunes VALUES('$IDFicha','$dp_cmb_precat','$dp_cmb_claspre', ".
            "$dp_areattitulo,0,$dp_areatverifica,$re_lotcol,$re_jarais,$re_areapub,$re_areaint, ".
            "'$ic_cmb_conddec','$ic_cmb_estficha','$ic_cmb_man','$observacion','$dp_cmb_usoprecat','$numficha')";
ejecuta_consulta($Seleccion, $Insercion);

//----------------------------------------------------------------- LINDEROS ------------------------------------------------
if ($dp_medcam_fre != '' || $dp_medsegtitu_fre != '' || $dp_colcam_fre != '' || $dp_colsegtitu_fre != '' ||
    $dp_medcam_der != '' || $dp_medsegtitu_der != '' || $dp_colcam_der != '' || $dp_colsegtitu_der != '' ||
    $dp_medcam_izq != '' || $dp_medsegtitu_izq != '' || $dp_colcam_izq != '' || $dp_colsegtitu_izq != '' |
    $dp_medcam_fon != '' || $dp_medsegtitu_fon != '' || $dp_colcam_fon != '' || $dp_colsegtitu_fon != '') {
    /*echo "<script>alert('TF_LINDEROS');</script>\n";*/
    $Seleccion = "SELECT id_ficha FROM tf_linderos WHERE id_ficha='$IDFicha'";
    $Insercion = "INSERT INTO tf_linderos VALUES('$IDFicha',".
                "'$dp_medcam_fre','$dp_medsegtitu_fre','$dp_colcam_fre','$dp_colsegtitu_fre',".
                "'$dp_medcam_der','$dp_medsegtitu_der','$dp_colcam_der','$dp_colsegtitu_der',".
                "'$dp_medcam_izq','$dp_medsegtitu_izq','$dp_colcam_izq','$dp_colsegtitu_izq',".
                "'$dp_medcam_fon','$dp_medsegtitu_fon','$dp_colcam_fon','$dp_colsegtitu_fon')";
    ejecuta_consulta($Seleccion, $Insercion);
}
//------------------------------------------------------------- SERVICIOS B�SICOS -------------------------------------------
/*echo "<script>alert('TF_SERVICIOS_BASICOS');</script>\n";*/
$Seleccion = "SELECT id_ficha FROM tf_servicios_basicos WHERE id_ficha='$IDFicha'";
$Insercion = "INSERT INTO tf_servicios_basicos VALUES('$IDFicha',".
            "'$sb_luz','$sb_agua','$sb_telefono','$sb_desague',".
            "'$sb_numsumluz','$sb_numtelf','$sb_numconagua')";
ejecuta_consulta($Seleccion, $Insercion);

//---------------------------------------------------------------- SUNARP ------------------------------------------------
if ($ipcrp_cmb_tipoparreg != 0) {
    /*echo "<script>alert('TF_SUNARP');</script>\n";*/
    $Seleccion = "SELECT id_ficha FROM tf_sunarp WHERE id_ficha='$IDFicha'";
    $Insercion = "INSERT INTO tf_sunarp VALUES('$IDFicha',".
                "'$ipcrp_cmb_tipoparreg','$ipcrp_numpar','$ipcrp_fojas','$ipcrp_asiento',".
                "'$ipcrp_fechains','$ipcrp_cmb_decfab','$ipcrp_asinfab','$ipcrp_fechinsfab')";
    ejecuta_consulta($Seleccion, $Insercion);
}
//------------------------------------------------------------- Registro Legal ------------------------------------------------
if ($d_cmb_nomnot != '0') {
    /*echo "<script>alert('TF_REGISTRO_LEGAL');</script>\n";*/
    $Seleccion = "SELECT id_ficha FROM tf_registro_legal WHERE id_ficha='$IDFicha'".
                    " AND id_notaria='$d_cmb_nomnot'";
    $Insercion = "INSERT INTO tf_registro_legal VALUES('$IDFicha',".
                "'$d_cmb_nomnot','$d_kardex','$d_fechaescpub')";
    ejecuta_consulta($Seleccion, $Insercion);
}
//-------------------------------------------------------------- CONSTRUCCIONES ------------------------------------------------
/*echo "<script>alert('TF_CONSTRUCCIONES');</script>\n";*/
for ($i = 0;$i < $nro_cons;$i++) {
    //buscamos el �ltimo c�digo de la ficha
    $Consulta = "SELECT codi_construccion FROM tf_construcciones WHERE id_ficha='$IDFicha'".
                " ORDER BY id_ficha, id_construccion desc limit 1";
    $Busqueda = $BaseDato->Consultas($Consulta);
    $registro = pg_fetch_row($Busqueda);

    // se recupera el ultimo id
    $ultimoid = $registro[0];
    $ultimoid = $ultimoid + 1;
    $IDConstruccion = $IDFicha.$c_psm[$i].(string)$ultimoid;

    $Insercion = "INSERT INTO tf_construcciones VALUES('$IDConstruccion','$IDFicha',$ultimoid,'$c_psm[$i]',".
                "'$c_fecha[$i]','$c_mep[$i]','$c_ecs[$i]','$c_ecc[$i]','$c_myc[$i]',".
                "'$c_t[$i]','$c_p[$i]','$c_pyv[$i]','$c_r[$i]','$c_b[$i]','$c_ies[$i]',$c_d[$i],$c_v[$i],'$c_uca[$i]')";

    //INSERTAMOS
    $Resultado = $BaseDato->Consultas($Insercion);
    if (pg_affected_rows($Resultado) >= 0) {//Si resulto al menos una fila afectada
        /*echo "<script>alert('Grabamos');</script>\n";*/

    }
}

//-------------------------------------------------------------- INSTALACIONES ------------------------------------------------
/*echo "<script>alert('TF_INSTALACIONES');</script>\n";*/
for ($i = 0;$i < $nro_obra;$i++) {
    //buscamos el �ltimo c�digo	de la ficha
    $Consulta = "SELECT codi_obra FROM tf_instalaciones WHERE id_ficha='$IDFicha'".
                " ORDER BY id_ficha, id_instalacion desc limit 1";
    $Busqueda = $BaseDato->Consultas($Consulta);
    $registro = pg_fetch_row($Busqueda);

    // se recupera el ultimo id
    $ultimoid = $registro[0];
    $ultimoid = $ultimoid + 1;
    $IDInstalacion = $IDFicha.$oc_cod[$i].(string)$ultimoid;
    //	echo $IDInstalacion.' '.$IDFicha.' '.$ultimoid;
    $Insercion = "INSERT INTO tf_instalaciones VALUES('$IDInstalacion','$IDFicha','$oc_cod[$i]',$ultimoid,".
                "'$oc_fecha[$i]','$oc_mep[$i]','$oc_ecs[$i]','$oc_ecc[$i]',".
                "$oc_lar[$i],$oc_anc[$i],$oc_alt[$i],$oc_pro[$i],'$oc_uni[$i]','$oc_uca[$i]')";

    //INSERTAMOS
    $Resultado = $BaseDato->Consultas($Insercion);
    if (pg_affected_rows($Resultado) >= 0) {//Si resulto al menos una fila afectada
        /*echo "<script>alert('Grabamos');</script>\n";*/

    }
}

//------------------------------------------------------- RECAP EDIFICIO --------------------------------------
/*echo "<script>alert('TF_RECAP_EDIFICIO');</script>\n";*/
for ($i = 0;$i < $nro_edi;$i++) {
    if ($re_edi[$i] != '') {
        //buscamos el �ltimo c�digo	correlativo
        $Consulta = "SELECT id_recap FROM tf_recap_edificio WHERE id_ficha='$IDFicha'".
                    " ORDER BY id_ficha, edificio desc limit 1";
        $Busqueda = $BaseDato->Consultas($Consulta);
        $registro = pg_fetch_row($Busqueda);

        // se recupera el ultimo id
        $ultimoid = $registro[0];
        $ultimoid = $ultimoid + 1;

        $Seleccion = "SELECT id_ficha FROM tf_recap_edificio WHERE id_ficha='$IDFicha' AND edificio ='$re_edi[$i]'";
        $Insercion = "INSERT INTO tf_recap_edificio VALUES('$IDFicha','$re_edi[$i]',$re_por[$i],$re_atc[$i],$re_acc[$i],$re_aoic[$i],$ultimoid)";
        ejecuta_consulta($Seleccion, $Insercion);
    } else {
    }//nada
}


//------------------------------------------------------- RECAP BBCC --------------------------------------
/*echo "<script>alert('TF_RECAP_BBCC');</script>\n";*/
for ($i = 0;$i < $nro_bc;$i++) {
    if ($rbc_numero[$i] != '') {
        //buscamos el �ltimo c�digo	correlativo
        $Consulta = "SELECT nume_registro FROM tf_recap_bbcc WHERE id_ficha='$IDFicha'".
                    " ORDER BY id_ficha, nume_registro desc limit 1";
        $Busqueda = $BaseDato->Consultas($Consulta);
        $registro = pg_fetch_row($Busqueda);

        // se recupera el ultimo id
        $ultimoid = $registro[0];
        $ultimoid = $ultimoid + 1;

        $Seleccion = "SELECT id_ficha FROM tf_recap_bbcc WHERE id_ficha='$IDFicha' AND nume_registro ='$rbc_numero[$i]'";
        $Insercion = "INSERT INTO tf_recap_bbcc VALUES('$IDFicha','$rbc_edifica[$i]','$rbc_entrada[$i]','$rbc_piso[$i]','$rbc_unidad[$i]',".
                    "$rbc_porcentaje[$i],$rbc_atc[$i],$rbc_acc[$i],$rbc_aoic[$i],$ultimoid)";
        ejecuta_consulta($Seleccion, $Insercion);
    } else {
    }//nada
}
// FIN DE FUNCION PRINCIPAL

/*echo "<script>alert('DATOS GRABADOS SATISFACTORIAMENTE');</script>\n";*/
//regresamos al nro_economica
echo "<meta http-equiv='refresh' content='1;url=http://".$_SERVER['HTTP_HOST']."/syslevantamiento/fichaBienComun/nro_biencomun.php'/>";

//****************************************************************************************************************
