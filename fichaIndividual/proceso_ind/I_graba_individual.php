<?php

session_start();

require_once 'I_verifica_ubigeo.php';
require_once 'I_variables.php';
require_once 'I_verificar_insertar.php';

/*$abc=$_SESSION['login'];
echo "<script>alert('$abc');</script>\n";*/

//Llamamos USUARIO
//include '../../funciones/consulta_usuario.php';

//recibimos nombre de p�gina para el caso de VERIFICACION E INSERCION
//$ficha=$_GET['ficha'];

// NRO DE INDIVIDUALES INICIALIZAMOS EN CERO
$bc = 0;

//Se Obtienen PRINCIPALES ID
$TF = '01';
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

//CONTADOR DE INDIVIDUALES : C�digo Referencial -> hasta LOTE
$cod_ref = substr($IDUniCat, 0, 14);

if (!isset($_SESSION['nro_indivuales'])) {	//si no existe lo creamos
    $_SESSION['nro_indivuales'] = 1;
} else {	//YA EXISTE sesion
    //verificamos si ya hay un c�digo referencial parecido para sumar el contador de fichas individuales
    //VERIFICAMOS
    $Seleccion = "SELECT id_uni_cat FROM tf_fichas WHERE id_ficha LIKE '%'||'$ubigeo'||'01'||'%' AND id_uni_cat LIKE '$cod_ref'||'%'";
    $Busqueda = $BaseDato->Consultas($Seleccion);
    $registros = pg_num_rows($Busqueda);

    if ($registros > 0 || $registros != 'null') {	//HAY FICHAS INDIVIDUALES
        /*echo "<script>alert('Ya existen '+$registros+' fichas individuales con el mismo Codigo Referencial');</script>\n";*/
        $_SESSION['nro_indivuales'] = $_SESSION['nro_indivuales'] + $registros;
        if ($_SESSION['nro_indivuales'] >= 2) {
            $bc = 1;
        }
        //ya podemos aperturar una ficha BIEN COMUN
    } else {	//MATAMOS SESION nro de individuales
        unset($_SESSION['nro_indivuales']);
    }
}

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

//---------------------------------------------------------- MANZANAS -----------------------------------------------------
/*echo "<script>alert('TF_MANZANA');</script>\n";*/
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
//---------------------------------------------------------- INGRESOS ------------------------------------------------
/*echo "<script>alert('TF_INGRESOS');</script>\n";*/
for ($i = 0;$i < $nro_vias;$i++) {
    $IDPuerta = $IDLote.$upc_codpue[$i].$i;
    $Seleccion = "SELECT id_ficha FROM tf_ingresos WHERE id_ficha='$IDFicha'".
                " AND id_puerta='$IDPuerta'";
    $Insercion = "INSERT INTO tf_ingresos VALUES('$IDFicha','$IDPuerta')";
    ejecuta_consulta($Seleccion, $Insercion);
}

//----------------------------------------------------- EXONERACIONES DE PREDIO -----------------------------------------
if ($ct_cmb_condesppre != 0) {
    /*echo "<script>alert('TF_EXONERACIONES_PREDIO');</script>\n";*/
    $Seleccion = "SELECT id_ficha FROM tf_exoneraciones_predio WHERE id_ficha='$IDFicha'";
    $Insercion = "INSERT INTO tf_exoneraciones_predio VALUES('$IDFicha','$ct_cmb_condesppre','$ct_numresexo',".
                "$ct_porcentaje,'$ct_fechaini','$ct_fechafin')";
    ejecuta_consulta($Seleccion, $Insercion);
}

//--------------------------------------------------------- FICHA INDIVIDUAL ------------------------------------------------
/*echo "<script>alert('TF_FICHAS_INDIVIDUALES');</script>\n";*/
$Seleccion = "SELECT id_ficha FROM tf_fichas_individuales WHERE id_ficha='$IDFicha'".
                " AND codi_uso='$dp_cmb_usoprecat'";
$Insercion = "INSERT INTO tf_fichas_individuales VALUES('$IDFicha','$dp_cmb_usoprecat','$dp_cmb_precat',".
            "'$dp_cmb_claspre',$dp_areatitulo,$dp_areadeclara,$dp_areaverifica,".
            "$c_terreleg,$c_terrfis,$c_consleg,$c_consfis,'$epc_opt_evalua',$epc_lotcol,$epc_areapub,$epc_jarais,$epc_areaint,".
            "'$ic_cmb_conddec','$ic_cmb_estficha',$ic_numhab,$ic_numfam,'$ic_cmb_man','$observacion','$numficha')";
ejecuta_consulta($Seleccion, $Insercion);

//----------------------------------------------------------------- LINDEROS ------------------------------------------------
//----------------------------------------------------------------- LINDEROS ------------------------------------------------

//substr("abcdef", 0, -1);  // devuelve "abcde"



if ($dp_medcam_fre != '' || $dp_medsegtitu_fre != '' || $dp_colcam_fre != '' || $dp_colsegtitu_fre != '' ||
        $dp_medcam_der != '' || $dp_medsegtitu_der != '' || $dp_colcam_der != '' || $dp_colsegtitu_der != '' ||
        $dp_medcam_izq != '' || $dp_medsegtitu_izq != '' || $dp_colcam_izq != '' || $dp_colsegtitu_izq != '' ||
        $dp_medcam_fon != '' || $dp_medsegtitu_fon != '' || $dp_colcam_fon != '' || $dp_colsegtitu_fon != '') {
    /*echo "<script>alert('TF_LINDEROS');</script>\n";*/

    $Seleccion_mpt = "SELECT id_ficha FROM mpt_linderos WHERE id_ficha='$IDFicha'";
    $Insercion_mpt = "INSERT INTO mpt_linderos VALUES('$IDFicha',".
                "'$dp_medcam_fre','$dp_medsegtitu_fre','$dp_colcam_fre','$dp_colsegtitu_fre',".
                "'$dp_medcam_der','$dp_medsegtitu_der','$dp_colcam_der','$dp_colsegtitu_der',".
                "'$dp_medcam_izq','$dp_medsegtitu_izq','$dp_colcam_izq','$dp_colsegtitu_izq',".
                "'$dp_medcam_fon','$dp_medsegtitu_fon','$dp_colcam_fon','$dp_colsegtitu_fon')";

    ejecuta_consulta($Seleccion_mpt, $Insercion_mpt);


    echo $dp_medcam_fre = substr($dp_medcam_fre, 0, 20);
    echo "<br>";
    echo $dp_medcam_der = substr($dp_medcam_der, 0, 20);
    echo "<br>";
    echo $dp_medcam_izq = substr($dp_medcam_izq, 0, 20);
    echo "<br>";
    echo $dp_medcam_fon = substr($dp_medcam_fon, 0, 20);

    echo "<br>";
    echo "<br>";

    echo $dp_medsegtitu_fre = substr($dp_medsegtitu_fre, 0, 20);
    echo "<br>";
    echo $dp_medsegtitu_der = substr($dp_medsegtitu_der, 0, 20);
    echo "<br>";
    echo $dp_medsegtitu_izq = substr($dp_medsegtitu_izq, 0, 20);
    echo "<br>";
    echo $dp_medsegtitu_fon = substr($dp_medsegtitu_fon, 0, 20);

    echo "<br>";
    echo "<br>";

    echo $dp_colcam_fre = substr($dp_colcam_fre, 0, 20);
    echo "<br>";
    echo $dp_colcam_der = substr($dp_colcam_der, 0, 20);
    echo "<br>";
    echo $dp_colcam_izq = substr($dp_colcam_izq, 0, 20);
    echo "<br>";
    echo $dp_colcam_fon = substr($dp_colcam_fon, 0, 20);

    echo "<br>";
    echo "<br>";

    echo $dp_colsegtitu_fre = substr($dp_colsegtitu_fre, 0, 20);
    echo "<br>";
    echo $dp_colsegtitu_der = substr($dp_colsegtitu_der, 0, 20);
    echo "<br>";
    echo $dp_colsegtitu_izq = substr($dp_colsegtitu_izq, 0, 20);
    echo "<br>";
    echo $dp_colsegtitu_fon = substr($dp_colsegtitu_fon, 0, 20);

    echo "<br>";
    echo "<br>";

    $Seleccion = "SELECT id_ficha FROM tf_linderos WHERE id_ficha='$IDFicha'";
    $Insercion = "INSERT INTO tf_linderos 
				
				(id_ficha,
				 fren_campo,fren_titulo,fren_colinda_campo,fren_colinda_titulo,
				 dere_campo,dere_titulo,dere_colinda_campo,dere_colinda_titulo,
				 izqu_campo,izqu_titulo,izqu_colinda_campo,izqu_colinda_titulo,
				 fond_campo,fond_titulo,fond_colinda_campo,fond_colinda_titulo)
				
				VALUES('$IDFicha',".
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

//------------------------------------------------------------- CONSTRUCCIONES ------------------------------------------------
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
    /*$Seleccion="SELECT id_construccion FROM tf_construcciones WHERE id_ficha='$IDFicha'".
                " AND nume_piso='$c_psm[$i]' AND mep='$c_mep[$i]'";*/
    $Insercion = "INSERT INTO tf_construcciones VALUES('$IDConstruccion','$IDFicha',$ultimoid,'$c_psm[$i]',".
                "'$c_fecha[$i]','$c_mep[$i]','$c_ecs[$i]','$c_ecc[$i]','$c_myc[$i]',".
                "'$c_t[$i]','$c_p[$i]','$c_pyv[$i]','$c_r[$i]','$c_b[$i]','$c_ies[$i]',$c_d[$i],$c_v[$i],'$c_uca[$i]')";
    //ejecuta_consulta($Seleccion,$Insercion);
    //INSERTAMOS
    $Resultado = $BaseDato->Consultas($Insercion);
    if (pg_affected_rows($Resultado) >= 0) {//Si resulto al menos una fila afectada
        /*echo "<script>alert('Grabamos');</script>\n";*/
    }
}

//-------------------------------------------------------------- INSTALACIONES ------------------------------------------------
/*echo "<script>alert('TF_INSTALACIONES');</script>\n";*/

//echo '<pre>';
//print_r("NRO DE OBRAS: <br>");
//print_r($nro_obra);
//print_r("<br>");
//echo '</pre>';

for ($i = 0;$i < $nro_obra;$i++) {
    //buscamos el �ltimo c�digo	de la ficha
    $Consulta = "SELECT codi_obra FROM tf_instalaciones WHERE id_ficha='$IDFicha'".
                " ORDER BY id_ficha, id_instalacion desc limit 1";
    $Busqueda = $BaseDato->Consultas($Consulta);
    $registro = pg_fetch_row($Busqueda);

    echo '<pre>';
    print_r("SELECCION: ");
    print_r($Consulta);
    print_r("<br>");
    print_r("BUSQUEDA: ");
    print_r($Busqueda);
    echo '</pre><br><br>';

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

    echo '<pre>';
    print_r("INSERCION: ");
    print_r($Insercion);
    print_r("<br>");
    print_r("RESULTADO: ");
    print_r($Resultado);
    echo '</pre><hr>';

    if (pg_affected_rows($Resultado) >= 0) {//Si resulto al menos una fila afectada
        /*echo "<script>alert('Grabamos');</script>\n";*/
    }
}

//----------------------------------------------------- DOCUMENTOS ADJUNTOS ------------------------------------------------
/*echo "<script>alert('TF_DOCUMENTOS_ADJUNTOS');</script>\n";*/
for ($i = 0;$i < $nro_docu;$i++) {
    //buscamos el �ltimo c�digo	de la ficha
    $Consulta = "SELECT codi_doc FROM tf_documentos_adjuntos WHERE id_ficha='$IDFicha'".
                " ORDER BY id_ficha, id_doc desc limit 1";
    $Busqueda = $BaseDato->Consultas($Consulta);
    $registro1 = pg_fetch_row($Busqueda);

    // se recupera el ultimo id
    $ultimoid = $registro1[0];
    $ultimoid = $ultimoid + 1;
    $IDDoc = $IDFicha.(string)$ultimoid;
    //echo $IDDoc.' '.$IDFicha.' '.$ultimoid;
    $Seleccion = "SELECT id_doc FROM tf_documentos_adjuntos WHERE id_ficha='$IDFicha'".
                " AND tipo_doc='$d_tipo[$i]' AND nume_doc='$d_nro[$i]'";
    $Insercion = "INSERT INTO tf_documentos_adjuntos VALUES($IDDoc,'$IDFicha',$ultimoid,'$d_tipo[$i]','$d_nro[$i]',".
                "$d_area[$i],'$d_fecha[$i]')";
    ejecuta_consulta($Seleccion, $Insercion);
}
// FIN DE FUNCION PRINCIPAL

if ($ct_cmb_condtitu != '05') {
    //--------------------------------------------- PERSONA Y TITULAR ----------------------------------------
    // Preguntamos en el caso este activado la condicion COTITULARES
    if ($itc_cmb_tipotitu == '1') {
        $IDPersona = $itc_numdoc1.'1'.$itc_cmb_tipotitu.$itc_cmb_tipodoc1;
        $IDPersona2 = $itc_numdoc2.'1'.'1'.$itc_cmb_tipodoc2;
        /*echo $IDPersona.' '; echo $itc_numdoc1.' '; echo $itc_cmb_tipodoc1.' ';
        echo $itc_cmb_tipotitu.' '; echo $itc_nombre1.' '; echo $itc_paterno1.' '; echo $itc_materno1.' ';
        echo $itc_cmb_perjur.' ';*/

        //primer titular
        /*echo "<script>alert('Identificaci�n de Titular 1 - TF_PERSONAS');</script>\n";*/
        $Seleccion = "SELECT id_persona FROM tf_personas WHERE id_persona='$IDPersona'";
        $Insercion = "INSERT INTO tf_personas VALUES('$IDPersona','$itc_numdoc1','$itc_cmb_tipodoc1',".
                "'$itc_cmb_tipotitu','$itc_nombre1','$itc_paterno1','$itc_materno1','','1','')";

        /*echo '<pre>';
        print_r("PERSONA 1: <br>");
        print_r($Seleccion);
        print_r("<br>");
        print_r($Insercion);
        print_r("<br>");
        echo '</pre>';*/

        ejecuta_consulta($Seleccion, $Insercion);

        /*echo "<script>alert('Identificaci�n de Titular 1 - TF_TITULARES');</script>\n";*/
        $Seleccion = "SELECT id_ficha FROM tf_titulares WHERE id_ficha='$IDFicha'".
                    " AND id_persona='$IDPersona'";
        $Insercion = "INSERT INTO tf_titulares VALUES('$IDFicha','$IDPersona','$ct_cmb_formadq','$ct_fechaadq',".
                "$ct_porcentaje,'$itc_cmb_ecivil','$dftc_fax','$dftc_telf','$dftc_anexo','$dftc_email','TITULAR N� 1',".
                "'','$ct_cmb_condtitu')";

        /*echo '<pre>';
        print_r("TITULAR 1: <br>");
        print_r($Seleccion);
        print_r("<br>");
        print_r($Insercion);
        print_r("<br>");
        echo '</pre>';*/

        ejecuta_consulta($Seleccion, $Insercion);

        //evitamos que grabe en caso de que halla s�lo un titular
        if ($itc_numdoc2 != '') {
            /*echo "<script>alert('Identificaci�n de Titular 2 - TF_PERSONAS');</script>\n";*/
            $Seleccion = "SELECT id_persona FROM tf_personas WHERE id_persona='$IDPersona2'";
            $Insercion = "INSERT INTO tf_personas VALUES('$IDPersona2','$itc_numdoc2','$itc_cmb_tipodoc2',".
                    "'$itc_cmb_tipotitu','$itc_nombre2','$itc_paterno2','$itc_materno2','','1','')";

            /*echo '<pre>';
            print_r("PERSONA 2: <br>");
            print_r($Seleccion);
            print_r("<br>");
            print_r($Insercion);
            print_r("<br>");
            echo '</pre>';*/
            ejecuta_consulta($Seleccion, $Insercion);

            /*echo "<script>alert('Identificaci�n de Titular 2 - TF_TITULARES');</script>\n";*/
            $Seleccion = "SELECT id_ficha FROM tf_titulares WHERE id_ficha='$IDFicha'".
                        " AND id_persona='$IDPersona2'";
            $Insercion = "INSERT INTO tf_titulares VALUES('$IDFicha','$IDPersona2','$ct_cmb_formadq','$ct_fechaadq',".
                    "$ct_porcentaje,'$itc_cmb_ecivil','$dftc_fax','$dftc_telf','$dftc_anexo','$dftc_email','TITULAR N� 2',".
                    "'','$ct_cmb_condtitu')";

            /*echo '<pre>';
            print_r("TITULAR 2: <br>");
            print_r($Seleccion);
            print_r("<br>");
            print_r($Insercion);
            print_r("<br>");
            echo '</pre>';*/
            ejecuta_consulta($Seleccion, $Insercion);
        }
    } else { //if($itc_cmb_tipotitu==2)
        $IDPersona = $itc_ruc.'1'.$itc_cmb_tipotitu.'00';
        /*echo "<script>alert('Identificaci�n de Titular Jur�dico - TF_PERSONAS');</script>\n";*/
        $Seleccion = "SELECT id_persona FROM tf_personas WHERE id_persona='$IDPersona'";
        $Insercion = "INSERT INTO tf_personas VALUES('$IDPersona','$itc_ruc','00',".
                "'$itc_cmb_tipotitu','','','','$itc_cmb_perjur','1','$itc_razsocial')";
        ejecuta_consulta($Seleccion, $Insercion);

        /*echo "<script>alert('Identificaci�n de Titular Jur�dico - TF_TITULARESS');</script>\n";*/
        $Seleccion = "SELECT id_ficha FROM tf_titulares WHERE id_ficha='$IDFicha'".
                    " AND id_persona='$IDPersona'";
        $Insercion = "INSERT INTO tf_titulares VALUES('$IDFicha','$IDPersona','$ct_cmb_formadq','$ct_fechaadq',".
                "'$ct_porcentaje','','$dftc_fax','$dftc_telf','$dftc_anexo','$dftc_email','',".
                "'$dg_codcontribuyente','$ct_cmb_condtitu')";
        ejecuta_consulta($Seleccion, $Insercion);
    }

    //----------------------------------------------------------- EXONERACIONES DE TITULAR ---------------------------------------
    //preguntamos en el caso este activado la condicion COTITULARES
    /*echo "<script>alert('TF_EXONERACIONES_TITULAR');</script>\n";*/
    $Seleccion = "SELECT id_ficha FROM tf_exoneraciones_titular WHERE id_ficha='$IDFicha'".
                    " AND id_persona='$IDPersona'";
    $Insercion = "INSERT INTO tf_exoneraciones_titular VALUES('$IDFicha','$IDPersona','$itc_cmb_condesptitu','$itc_numresexo',".
                "'$itc_numbolpen','$itc_fechainiexo','$itc_fechafinexo')";
    ejecuta_consulta($Seleccion, $Insercion);

    if ($itc_cmb_ecivil == '02' and $itc_numdoc2 != '') {
        //
        $Seleccion = "SELECT id_ficha FROM tf_exoneraciones_titular WHERE id_ficha='$IDFicha'".
                    " AND id_persona='$IDPersona2'";
        $Insercion = "INSERT INTO tf_exoneraciones_titular VALUES('$IDFicha','$IDPersona2','$itc_cmb_condesptitu','$itc_numresexo',".
                    "'$itc_numbolpen','$itc_fechainiexo','$itc_fechafinexo')";
        ejecuta_consulta($Seleccion, $Insercion);
    }

    //------------------------------------------------------------- DOMICILIO TITULARES -------------------------------------------
    //preguntamos en el caso este activado la condicion COTITULARES
    /*echo "<script>alert('TF_DOMICILIO_TITULARES');</script>\n";*/
    $pr = substr($provincias, 2, 4);

    $Seleccion = "SELECT id_ficha FROM tf_domicilio_titulares WHERE id_ficha='$IDFicha'".
                    " AND id_persona='$IDPersona'";
    $Insercion = "INSERT INTO tf_domicilio_titulares VALUES('$IDFicha','$IDPersona','$dftc_codvia','$dftc_tipovia',".
                "'$dftc_nomvia','$dftc_nummuni','$dftc_nomedi','$dftc_numint','$dftc_codhu','$dftc_nomhu','$dftc_zse','$dftc_mzna',".
                "'$dftc_lote','$dftc_sublote','$departamentos','$pr','$distritos')";
    ejecuta_consulta($Seleccion, $Insercion);

    //---------------------------------------------------------------- LITIGANTES -------------------------------------------------

    for ($i = 0;$i < $nro_liti;$i++) {
        if ($ic_tipo[$i] != '' and $ic_nro[$i] != '' and $ic_liti[$i] != '') {
            /*echo "<script>alert('Identificaci�n de Litigante - TF_PERSONA');</script>\n";*/
            $IDPersona3 = $ic_nro[$i].'6'.'1'.$ic_tipo[$i];

            $Seleccion = "SELECT id_persona FROM tf_personas WHERE id_persona='$IDPersona3'";
            $Insercion = "INSERT INTO tf_personas VALUES('$IDPersona3','$ic_nro[$i]','$ic_tipo[$i]',".
                    "'1','','','','','6','$ic_liti[$i]')";
            ejecuta_consulta($Seleccion, $Insercion);

            /*echo "<script>alert('Identificaci�n de TF_LITIGANTES');</script>\n";*/
            $Seleccion = "SELECT id_ficha FROM tf_litigantes WHERE id_ficha='$IDFicha'".
                        " AND id_persona='$IDPersona3'";
            $Insercion = "INSERT INTO tf_litigantes VALUES('$IDFicha','$IDPersona3','$ic_cod[$i]')";
            ejecuta_consulta($Seleccion, $Insercion);
        }
    }

    // Que valla a aperturas
    /*	echo "<script>document.location.href='../../aperturas.php?ficha=1&cotitular=05';</script>\n";*/
    //header("Location: ../../aperturas.php?ficha=1&cotitular=05");
    //header( "refresh:1;url=http://".$_SERVER['SERVER_NAME']."/sisfichas/aperturas.php?ficha=1&cotitular=05" );
    if ($bc == 1) {
        echo "<meta http-equiv='refresh' content='1;url=http://".$_SERVER['HTTP_HOST']."/syslevantamiento/new_apertura.php?libre=1&existe=1'/>";
    } else {
        echo "<meta http-equiv='refresh' content='1;url=http://".$_SERVER['HTTP_HOST']."/syslevantamiento/new_apertura.php?libre=1&existe=2'/>";
    }
    //libre=1 -> representa que estamos considerando que podemos elegir otra ficha
    //existe=1 -> representa la existencia de fichas individuales del mismo c�digo referencial
}// FIN DE FUNCION SECUNDARIA
else {
    //que vaya directo a ficha cotitular, sw=1 decimos que debe ir y bloquer� bot�n cancelar.
    /*echo "<script>document.location.href='../../fichaCotitularidad/fichaCotitularidad.php;</script>\n";	*/
    //header("Location: ../../fichaCotitularidad/fichaCotitularidad.php");

    // header( "refresh:1;url=http://".$_SERVER['SERVER_NAME']."/sisfichas/fichaCotitularidad/fichaCotitularidad.php" );
    echo "<meta http-equiv='refresh' content='1;url=http://".$_SERVER['HTTP_HOST']."/syslevantamiento/fichaCotitularidad/nro_cotitular.php?sw=1'/>";
}
