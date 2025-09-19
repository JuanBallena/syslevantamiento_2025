<?php

require_once 'controller/I_verificar_insertar.php';

class InsertServiciosBasicosTable {

    function insert($IDFicha, $sb_luz,$sb_agua, $sb_telefono, $sb_desague, $sb_gas)
    {
        $Seleccion="SELECT c_id_uni_cat FROM tf_servicios_basicos WHERE c_id_uni_cat='$IDFicha'";
	    $Insercion="INSERT INTO tf_servicios_basicos VALUES('$IDFicha',".
				   "$sb_luz,$sb_agua,$sb_telefono,$sb_desague,$sb_gas )";				
	    ejecuta_consulta($Seleccion,$Insercion);
	
    }
}

?>