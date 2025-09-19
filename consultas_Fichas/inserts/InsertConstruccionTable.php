<?php

require_once 'controller/I_verificar_insertar.php';

class InsertConstruccionTable {

    function insert($IDConstruccion,$IDFicha, $dftc_nroPiso, $c_myc,$c_t,$c_p,$c_pyv,$c_mep)
    {
        $Seleccion="SELECT c_id_construccion FROM tf_construcciones WHERE c_id_uni_cat='$IDFicha'";
        $Insercion="INSERT INTO tf_construcciones VALUES('$IDConstruccion','$IDFicha','$dftc_nroPiso', ".
					"$c_myc,$c_t,$c_p,$c_pyv,$c_mep)";
        ejecuta_consulta($Seleccion,$Insercion);
    }
}

?>