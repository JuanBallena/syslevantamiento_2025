<?php

require_once 'controller/I_verificar_insertar.php';

class InsertManzanaTable {

    function insert($IDManzana, $dg_manzana, $IDSector, $upc_mzna)
    {
        $Seleccion="SELECT c_id_mzna FROM tf_manzanas WHERE c_id_mzna='$IDManzana'";
        $Insercion="INSERT INTO tf_manzanas VALUES('$IDManzana','$IDSector','$dg_manzana','$upc_mzna')";
        ejecuta_consulta($Seleccion,$Insercion);
    }
}

?>