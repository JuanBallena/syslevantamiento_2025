<?php

require_once 'controller/I_verificar_insertar.php';

class InsertFichaViaTable {

    function insert($IDFicha, $IDVia)
    {
        $Seleccion="SELECT c_id_uni_cat FROM tf_ficha_vias WHERE c_id_uni_cat='$IDFicha'";
        $Insercion="INSERT INTO tf_ficha_vias VALUES('$IDFicha','$IDVia')";
        ejecuta_consulta($Seleccion,$Insercion);
        
        
    }
}

?>