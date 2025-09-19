<?php

require_once 'controller/I_verificar_insertar.php';

class UpdateUniCatTable {

    function update($IDUniCat, $IDLote, $dg_entrada, $dg_piso,$dg_unidad,$dg_edificacion)
    {
        $Seleccion="SELECT c_id_uni_cat FROM tf_uni_cat WHERE c_id_uni_cat='$IDUniCat'";
        $Actualizacion="UPDATE tf_uni_cat SET c_codi_entrada='$dg_entrada', c_codi_piso='$dg_piso', c_codi_edif = '$dg_edificacion' ".
                        "WHERE c_id_uni_cat='$IDUniCat'";
	    $Insercion="INSERT INTO tf_uni_cat VALUES('$IDUniCat','$IDLote','$dg_entrada','$dg_piso',".
			        "'$dg_unidad','$dg_edificacion')";
        actualiza_inserta($Seleccion,$Actualizacion,$Insercion);
	
    }
}

?>