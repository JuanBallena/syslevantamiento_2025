<?php

require_once 'controller/I_verificar_insertar.php';

class UpdateConstruccionTable {

    function update($IDConstruccion,$IDFicha, $dftc_nroPiso, $c_myc,$c_t,$c_p,$c_pyv,$c_mep)
    {
        $Seleccion="SELECT c_id_construccion FROM tf_construcciones WHERE c_id_uni_cat='$IDFicha'";
        $Actualizacion="UPDATE tf_construcciones SET i_estr_muro_col='$c_myc', i_estr_techo='$c_t', i_acab_piso = '$c_p', i_acab_puerta ='$c_pyv' , i_mep = '$c_mep' ". 
                        "WHERE c_id_construccion='$IDConstruccion'";
        $Insercion="INSERT INTO tf_construcciones VALUES('$IDConstruccion','$IDFicha','$dftc_nroPiso', ".
                        "$c_myc,$c_t,$c_p,$c_pyv,$c_mep)";
        actualiza_inserta($Seleccion,$Actualizacion,$Insercion);
    }
}

?>