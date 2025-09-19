<?php

require_once 'controller/I_verificar_insertar.php';

class InsertUniCatTable {

    function insert($IDUniCat, $IDLote, $dg_entrada, $dg_piso,$dg_unidad,$dg_edificacion)
    {
        $Seleccion="SELECT c_id_uni_cat FROM tf_uni_cat WHERE c_id_uni_cat='$IDUniCat'";
	    $Insercion="INSERT INTO tf_uni_cat VALUES('$IDUniCat','$IDLote','$dg_entrada','$dg_piso',".
			   "'$dg_unidad','$dg_edificacion')";
	    ejecuta_consulta($Seleccion,$Insercion);
	
    }
}

?>