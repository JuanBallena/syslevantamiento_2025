<?php

require_once 'controller/I_verificar_insertar.php';

class InsertLoteTable {

    function insert($IDLote,$IDManzana, $dg_lote, $upc_codhu, $upc_mzna,$upc_lote,$upc_sublote)
    {
        $Seleccion="SELECT c_id_lote FROM tf_lotes WHERE c_id_lote='$IDLote'";
	    $Insercion="INSERT INTO tf_lotes VALUES('$IDLote','$IDManzana','$dg_lote','$upc_codhu','$upc_mzna',".
											    "'$upc_lote','$upc_sublote')";
	    ejecuta_consulta($Seleccion,$Insercion);
    }
}

?>