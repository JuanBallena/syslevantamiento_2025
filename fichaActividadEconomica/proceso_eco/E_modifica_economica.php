<?php

session_start();

require_once 'E_verifica_ubigeo.php';
require_once 'E_variables.php';
require_once '../../funciones/verifica_inserta.php';


//Se Obtienen PRINCIPALES ID
//---------------------------------------------------------------------------------------------------------------------------------
//$TF='03';
$TF = $_POST['tipo'];
$anio = date("Y");
$tipo_conductor = $_POST['conductor'];

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



//*********************** ELIMINAMOS FICHA INDIVIDUAL EN SU CONJUNTO *******************

require 'E_eliminar.php';

//**************************************************************************************


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

//-------------------------------------------------------------- FICHA ECON�MICA ---------------------------------------------
/*echo "<script>alert('TF_FICHAS_ECONOMICAS');</script>\n";*/
$Seleccion = "SELECT id_ficha FROM tf_fichas_economicas WHERE id_ficha='$IDFicha'";
$Insercion = "INSERT INTO tf_fichas_economicas VALUES('$IDFicha','$ic_nomcom',$au_predcat,".
            "$au_viapub,$av_viapub,$au_bc,$av_bc,'$aae_nroexp','$aae_numlic','$aae_fecexp','$aae_fecven',".
            "'$aae_iniact','$ic_cmb_conddec','$ic_cmb_estficha','$ic_cmb_man','$ic_cmb_docpre',$av_predcat,".
            "'$observacion','$numficha')";
ejecuta_consulta($Seleccion, $Insercion);


//------------------------------------------------------- AUTORIZACIONES DE FUNCIONAMIENTO ------------------------------------
/*echo "<script>alert('TF_AUTORIZACIONES_FUNCIONAMIENTO');</script>\n";*/
for ($i = 0;$i < $nro_actividad;$i++) {
    if ($aa_codact[$i] != '0') {
        $Seleccion = "SELECT codi_actividad FROM tf_autorizaciones_funcionamiento WHERE codi_actividad ='$aa_codact[$i]' AND id_ficha='$IDFicha'";
        $Insercion = "INSERT INTO tf_autorizaciones_funcionamiento VALUES('$aa_codact[$i]','$IDFicha')";
        ejecuta_consulta($Seleccion, $Insercion);
    } else {
    }//nada
}

//-------------------------------------------------------------- AUTORIZA_ANUNCIOS ----------------------
/*echo "<script>alert('TF_AUTORIZA_ANUNCIOS');</script>\n";*/
for ($i = 0;$i < $nro_anu;$i++) {
    if ($aa_cmb_anuncio[$i] != '0') {
        //buscamos el �ltimo c�digo de la ficha
        $Consulta = "SELECT codi_autoriza FROM tf_autorizaciones_anuncios WHERE id_ficha='$IDFicha'".
                    " ORDER BY id_ficha, id_anuncio desc limit 1";
        $Busqueda = $BaseDato->Consultas($Consulta);
        $registro = pg_fetch_row($Busqueda);

        // se recupera el ultimo id
        $ultimoid = $registro[0];
        $ultimoid = $ultimoid + 1;
        $IDAnuncio = $IDFicha.$aa_cmb_anuncio[$i].(string)$ultimoid;
        /*$Seleccion="SELECT id_anuncio FROM tf_autorizaciones_anuncios WHERE id_ficha='$IDFicha'".
                    " AND codi_anuncio='$aa_cmb_anuncio[$i]' AND mep='$c_mep[$i]'";*/
        $Insercion = "INSERT INTO tf_autorizaciones_anuncios VALUES('$IDAnuncio','$IDFicha','$aa_cmb_anuncio[$i]',$ultimoid,".
                    "$aa_nrolad[$i],$aa_aaa[$i],$aa_ava[$i],'$aa_nroexp[$i]','$aa_nrolic[$i]','$aa_fecexp[$i]','$aa_fecven[$i]')";
        //ejecuta_consulta($Seleccion,$Insercion);
        //INSERTAMOS

        $Resultado = $BaseDato->Consultas($Insercion);
        if (pg_affected_rows($Resultado) >= 0) {//Si resulto al menos una fila afectada
            /*echo "<script>alert('Grabamos');</script>\n";*/
        }
    }

}

//********************************************************************************************************************************
//----------------------------------------------------------------- PERSONA Y CONDUCTOR --------------------------------

if ($tipo_conductor == 1) { // Natural TITULAR - INDIVIDUAL
    $ic_5 = $_POST['ic_cmb_tipoide'];
    $ic_1 = $_POST['ic_nrodoc'];

    $IDPersona = $ic_1.'7'.$tipo_conductor.$ic_5;

    $ic_2 = $_POST['itc_nombre'];
    $ic_3 = $_POST['itc_paterno'];
    $ic_4 = $_POST['itc_materno'];

    /*echo "<script>alert('Identificaci�n de Conductor - TF_PERSONAS');</script>\n";*/
    $Seleccion = "SELECT id_persona FROM tf_personas WHERE id_persona='$IDPersona'";
    $Insercion = "INSERT INTO tf_personas VALUES('$IDPersona','$ic_1','$ic_5',".
            "'$tipo_conductor','$ic_2','$ic_3','$ic_4','','7','')";
    ejecuta_consulta($Seleccion, $Insercion);

    //TF_CONDUCTOR natural propio
    /*echo "<script>alert('Identificaci�n de Conductor - TF_CONDUCTORES');</script>\n";*/
    $Seleccion = "SELECT id_ficha FROM tf_conductores WHERE id_ficha='$IDFicha'".
                " AND id_persona='$IDPersona'";
    $Insercion = "INSERT INTO tf_conductores VALUES('$IDFicha','$IDPersona','$dftc_fax','$dftc_telf','$dftc_anexo','$dftc_email',".
            "'$ic_cmb_condcon','')";
    ejecuta_consulta($Seleccion, $Insercion);
} elseif ($tipo_conductor == 2) { // jur�dico TITULAR - INDIVIDUAL
    $ic_6 = $_POST['ic_ruc'];

    $IDPersona = $ic_6.'7'.$tipo_conductor.'00';

    $ic_7 = $_POST['ic_razsocial'];

    /*echo "<script>alert('Identificaci�n de Titular Jur�dico - TF_PERSONAS');</script>\n";*/
    $Seleccion = "SELECT id_persona FROM tf_personas WHERE id_persona='$IDPersona'";
    $Insercion = "INSERT INTO tf_personas VALUES('$IDPersona','$ic_6','00',".
            "'$tipo_conductor','','','','','7','$ic_7')";
    ejecuta_consulta($Seleccion, $Insercion);

    //TF_CONDUCTOR juridico INDIVIDUAL
    /*echo "<script>alert('Identificaci�n de Conductor - TF_CONDUCTORES');</script>\n";*/
    $Seleccion = "SELECT id_ficha FROM tf_conductores WHERE id_ficha='$IDFicha'".
                " AND id_persona='$IDPersona'";
    $Insercion = "INSERT INTO tf_conductores VALUES('$IDFicha','$IDPersona','$dftc_fax','$dftc_telf','$dftc_anexo','$dftc_email',".
            "'$ic_cmb_condcon','$ic_ruc')";
    ejecuta_consulta($Seleccion, $Insercion);

} else {
    if ($ic_cmb_tipocon == '1') { //NATURAL PROPIO A FICHA
        $IDPersona = $ic_nrodoc.'7'.$ic_cmb_tipocon.$ic_cmb_tipoide;

        /*	echo $IDPersona.' '; echo $ic_nrodoc.' '; echo $ic_cmb_tipoide.' ';
            echo $ic_cmb_tipocon.' ';*/

        $Modifica = "UPDATE tf_personas SET nombres='$ic_nombres' , ape_paterno='$ic_ape_paterno', ".
            "ape_materno='$ic_ape_materno' ".
            "WHERE id_persona='$IDPersona'";

        ejecuta_actualiza($Modifica);

        /*echo "<script>alert('Identificaci�n del Conductor - TF_PERSONAS');</script>\n";*/
        $Seleccion = "SELECT id_persona FROM tf_personas WHERE id_persona='$IDPersona'";
        $Insercion = "INSERT INTO tf_personas VALUES('$IDPersona','$ic_nrodoc','$ic_cmb_tipoide',".
                "'$ic_cmb_tipocon','$ic_nombres','$ic_ape_paterno','$ic_ape_materno','','7','')";
        ejecuta_consulta($Seleccion, $Insercion);

        //TF_CONDUCTOR natural propio
        /*echo "<script>alert('Identificaci�n de Conductor - TF_CONDUCTORES');</script>\n";*/
        $Seleccion = "SELECT id_ficha FROM tf_conductores WHERE id_ficha='$IDFicha'".
                    " AND id_persona='$IDPersona'";
        $Insercion = "INSERT INTO tf_conductores VALUES('$IDFicha','$IDPersona','$dftc_fax','$dftc_telf','$dftc_anexo','$dftc_email',".
                "'$ic_cmb_condcon','')";
        ejecuta_consulta($Seleccion, $Insercion);


    } else { //JURIDICO PROPIO A FICHA
        $IDPersona = $ic_ruc.'1'.$ic_cmb_tipocon.'00';
        /*echo "<script>alert('Identificaci�n de Titular Jur�dico - TF_PERSONAS');</script>\n";*/

        $Modifica = "UPDATE tf_personas SET razon_social='$ic_razsocial' ".
            "WHERE id_persona='$IDPersona'";
        ejecuta_actualiza($Modifica);

        $Seleccion = "SELECT id_persona FROM tf_personas WHERE id_persona='$IDPersona'";
        $Insercion = "INSERT INTO tf_personas VALUES('$IDPersona','$ic_ruc','00',".
                "'$ic_cmb_tipocon','','','','$itc_cmb_perjur','7','$ic_razsocial')";
        ejecuta_consulta($Seleccion, $Insercion);

        //TF_CONDUCTOR jurudico propio
        /*echo "<script>alert('Identificaci�n de Conductor - TF_CONDUCTORES');</script>\n";*/
        $Seleccion = "SELECT id_ficha FROM tf_conductores WHERE id_ficha='$IDFicha'".
                    " AND id_persona='$IDPersona'";
        $Insercion = "INSERT INTO tf_conductores VALUES('$IDFicha','$IDPersona','$dftc_fax','$dftc_telf', ".
                "'$dftc_anexo','$dftc_email','$ic_cmb_condcon','$ic_ruc')";
        ejecuta_consulta($Seleccion, $Insercion);
    }
}


//------------------------------------------------------------- DOMICILIO TITULARES ------------------------------------------
//preguntamos en el caso este activado la condicion COTITULARES
/*echo "<script>alert('TF_DOMICILIO_TITULARES');</script>\n";*/
$pr = substr($provincias, 2, 4);

$Seleccion = "SELECT id_ficha FROM tf_domicilio_titulares WHERE id_ficha='$IDFicha'".
                " AND id_persona='$IDPersona'";
$Insercion = "INSERT INTO tf_domicilio_titulares VALUES('$IDFicha','$IDPersona','$dftc_codvia','$dftc_tipovia',".
            "'$dftc_nomvia','$dftc_nummuni','$dftc_nomedi','$dftc_numint','$dftc_codhu','$dftc_nomhu','$dftc_zse','$dftc_mzna',".
            "'$dftc_lote','$dftc_sublote','$departamentos','$pr','$distritos')";
ejecuta_consulta($Seleccion, $Insercion);

/*echo "<script>alert('DATOS GRABADOS SATISFACTORIAMENTE');</script>\n";*/
//regresamos al nro_economica
echo "<meta http-equiv='refresh' content='1;url=http://".$_SERVER['HTTP_HOST']."/syslevantamiento/fichaActividadEconomica/edit_economica.php?id=".$IDFicha."'/>";
