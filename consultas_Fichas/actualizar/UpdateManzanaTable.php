<?php

require_once 'controller/I_verificar_insertar.php';

class UpdateManzanaTable {

    function update($IDManzana, $dg_manzana, $IDSector, $upc_mzna)
    {
        $Seleccion="SELECT c_id_mzna FROM tf_manzanas WHERE c_id_mzna='$IDManzana'";
        $Actualizacion="UPDATE tf_manzanas SET c_nume_mzna='$upc_mzna' ".
                        "WHERE c_id_mzna='$IDManzana'";
        $Insercion="INSERT INTO tf_manzanas VALUES('$IDManzana','$IDSector','$dg_manzana','$upc_mzna')";
        actualiza_inserta($Seleccion,$Actualizacion,$Insercion);
    }
}

?>