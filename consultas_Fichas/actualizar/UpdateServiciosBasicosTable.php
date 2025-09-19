<?php

require_once 'controller/I_verificar_insertar.php';

class UpdateServiciosBasicosTable {

    function update($IDFicha, $sb_luz,$sb_agua, $sb_telefono, $sb_desague, $sb_gas)
    {
        $Seleccion="SELECT c_id_uni_cat FROM tf_servicios_basicos WHERE c_id_uni_cat='$IDFicha'";
        $Actualizacion="UPDATE tf_servicios_basicos SET c_luz='$sb_luz',c_agua='$sb_agua',c_telefono='$sb_telefono',c_desague='$sb_desague', c_gas='$sb_gas' ".
                        "WHERE c_id_uni_cat='$IDFicha'";
	    $Insercion="INSERT INTO tf_servicios_basicos VALUES('$IDFicha',".
				   "$sb_luz,$sb_agua,$sb_telefono,$sb_desague,$sb_gas )";				
        actualiza_inserta($Seleccion,$Actualizacion,$Insercion);
	
    }
}

?>