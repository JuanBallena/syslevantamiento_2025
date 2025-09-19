<?php

session_start();
//require_once 'C_verificar_insertar.php';
require_once 'C_verifica_ubigeo.php';
//require_once 'I_verifica_ubigeo.php';
require_once 'C_variables.php';
//require_once 'I_verificar_insertar.php';
require_once '../../funciones/verifica_inserta.php';

/*$abc=$_SESSION['login'];
echo "<script>alert('$abc');</script>\n";*/

//Se Obtienen PRINCIPALES ID
//---------------------------------------------------------------------------------------------------------------------------------
//$TF='02';
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


//*********************** ELIMINAMOS FICHA INDIVIDUAL EN SU CONJUNTO *******************
require 'C_eliminar.php';
//**************************************************************************************

//---------------------------------------------------------------------------------------------------------------------------------
//CONTADOR DE INDIVIDUALES : C�digo Referencial -> hasta LOTE
$cod_ref = substr($IDUniCat, 0, 23);

if (!isset($_SESSION['nro_cotitulares'])) {	//si no existe lo creamos
    $_SESSION['nro_cotitulares'] = 1;

    $bc = 0;
    //verificamos si ya hay un c�digo referencial parecido para habilitar ficha econ�mica
    //VERIFICAMOS
    $Seleccion = "SELECT id_uni_cat FROM tf_fichas WHERE id_ficha LIKE '%'||'$ubigeo'||'01'||'%' AND id_uni_cat = '$cod_ref'";
    $Busqueda = $BaseDato->Consultas($Seleccion);
    $registros = pg_num_rows($Busqueda);

    if ($registros > 0 || $registros != 'null') {	//HAY FICHAS INDIVIDUALES
        /*echo "<script>alert('Ya existe '+$registros+' ficha individual');</script>\n";*/
        $_SESSION['nro_cotitulares'] = $_SESSION['nro_cotitulares'] + $registros;
        if ($_SESSION['nro_cotitulares'] >= 1) {
            $bc = 1;
        }
    } else {	//MATAMOS SESION nro de individuales
        unset($_SESSION['nro_cotitulares']);
    }

}

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

//-------------------------------------------------------------- FICHA COTITULAR --------------------------------------
/*echo "<script>alert('TF_FICHAS_COTITULARES');</script>\n";*/
$Seleccion = "SELECT id_ficha FROM tf_fichas_cotitularidades WHERE id_ficha='$IDFicha'";
$Insercion = "INSERT INTO tf_fichas_cotitularidades VALUES('$IDFicha','$ic_cmb_conddec','$ic_cmb_estficha','$observacion','$numficha')";
ejecuta_consulta($Seleccion, $Insercion);

//----------------------------------------------------------------- PERSONA Y TITULAR -----------------------------------------
for ($i = 0;$i < $total;$i++) {

    if ($itc_cmb_tipotitu[$i] == '1') {
        $IDPersona = $itc_numdoc[$i].'1'.$itc_cmb_tipotitu[$i].$itc_cmb_tipodoc[$i];

        /*echo $IDPersona.' '; echo $itc_numdoc1.' '; echo $itc_cmb_tipodoc1.' ';
        echo $itc_cmb_tipotitu.' '; echo $itc_nombre1.' '; echo $itc_paterno1.' '; echo $itc_materno1.' ';
        echo $itc_cmb_perjur.' ';*/

        //cotitulares

        $Modifica = "UPDATE tf_personas SET nombres='$itc_nombre[$i]' , ape_paterno='$itc_nombre[$i]', ".
                "ape_materno='$itc_materno[$i]' ".
                "WHERE id_persona='$IDPersona'";

        ejecuta_actualiza($Modifica);

        /*echo "<script>alert('Identificaci�n de Titular - TF_PERSONAS');</script>\n";*/
        $Seleccion = "SELECT id_persona FROM tf_personas WHERE id_persona='$IDPersona'";
        $Insercion = "INSERT INTO tf_personas VALUES('$IDPersona','$itc_numdoc[$i]','$itc_cmb_tipodoc[$i]',".
                "'$itc_cmb_tipotitu[$i]','$itc_nombre[$i]','$itc_materno[$i]','$itc_paterno[$i]','','1','')";
        ejecuta_consulta($Seleccion, $Insercion);

        /*echo "<script>alert('Identificaci�n de Titular - TF_TITULARES');</script>\n";*/
        $Seleccion = "SELECT id_ficha FROM tf_titulares WHERE id_ficha='$IDFicha'".
                    " AND id_persona='$IDPersona'";
        $Insercion = "INSERT INTO tf_titulares VALUES('$IDFicha','$IDPersona','$ct_cmb_formadq[$i]','$ct_fechaadq[$i]',".
                "$dcc_porcentaje[$i],'','$dftc_fax[$i]','$dftc_telf[$i]','$dftc_anexo[$i]','$dftc_email[$i]','$dcc_nro_cotitular[$i]',".
                "'','')";
        ejecuta_consulta($Seleccion, $Insercion);
    } else { //if($itc_cmb_tipotitu[$i]==2)
        $IDPersona = $itc_ruc[$i].'1'.$itc_cmb_tipotitu[$i].'00';

        $Modifica = "UPDATE tf_personas SET razon_social='$itc_razsocial[$i]' ".
                    "WHERE id_persona='$IDPersona'";
        ejecuta_actualiza($Modifica);

        /*echo "<script>alert('Identificaci�n de Titular Jur�dico - TF_PERSONAS');</script>\n";*/
        $Seleccion = "SELECT id_persona FROM tf_personas WHERE id_persona='$IDPersona'";
        $Insercion = "INSERT INTO tf_personas VALUES('$IDPersona','$itc_ruc[$i]','00',".
                "'$itc_cmb_tipotitu[$i]','','','','','1','$itc_razsocial[$i]')";
        ejecuta_consulta($Seleccion, $Insercion);

        /*echo "<script>alert('Identificaci�n de Titular Jur�dico - TF_TITULARES');</script>\n";*/
        $Seleccion = "SELECT id_ficha FROM tf_titulares WHERE id_ficha='$IDFicha'".
                    " AND id_persona='$IDPersona'";
        $Insercion = "INSERT INTO tf_titulares VALUES('$IDFicha','$IDPersona','$ct_cmb_formadq[$i]','$ct_fechaadq[$i]',".
                "'$dcc_porcentaje[$i]','','$dftc_fax[$i]','$dftc_telf[$i]','$dftc_anexo[$i]','$dftc_email[$i]','$dcc_nro_cotitular[$i]',".
                "'$dg_codcontribuyente[$i]','')";
        ejecuta_consulta($Seleccion, $Insercion);
    }

    //----------------------------------------------------------- EXONERACIONES DE TITULAR ---------------------------------------
    /*echo "<script>alert('TF_EXONERACIONES_TITULAR');</script>\n";*/


    $Seleccion = "SELECT id_ficha FROM tf_exoneraciones_titular WHERE id_ficha='$IDFicha'".
                    " AND id_persona='$IDPersona'";
    $Insercion = "INSERT INTO tf_exoneraciones_titular VALUES('$IDFicha','$IDPersona','$itc_cmb_condesptitu[$i]','$itc_numresexo[$i]',".
                "'','$itc_fechainiexo[$i]','$itc_fechafinexo[$i]')";
    ejecuta_consulta($Seleccion, $Insercion);

    //------------------------------------------------------------- DOMICILIO TITULARES --------------------------------------
    //preguntamos en el caso este activado la condicion COTITULARES
    /*echo "<script>alert('TF_DOMICILIO_TITULARES');</script>\n";*/
    $pr = substr($provincias[$i], 2, 4);

    $Seleccion = "SELECT id_ficha FROM tf_domicilio_titulares WHERE id_ficha='$IDFicha'".
                    " AND id_persona='$IDPersona'";
    $Insercion = "INSERT INTO tf_domicilio_titulares VALUES('$IDFicha','$IDPersona','$dftc_codvia[$i]','$dftc_tipovia[$i]',".
    "'$dftc_nomvia[$i]','$dftc_nummuni[$i]','$dftc_nomedi[$i]','$dftc_numint[$i]','$dftc_codhu[$i]','$dftc_nomhu[$i]',".
    "'$dftc_zse[$i]','$dftc_mzna[$i]','$dftc_lote[$i]','$dftc_sublote[$i]','$departamentos[$i]','$pr','$distritos[$i]')";
    ejecuta_consulta($Seleccion, $Insercion);
}//FIN DE FOR - nro de titulares

echo "<meta http-equiv='refresh' content='1;url=http://".$_SERVER['HTTP_HOST']."/syslevantamiento/fichaCotitularidad/edit_cotitular.php?id=".$IDFicha."'/>";
