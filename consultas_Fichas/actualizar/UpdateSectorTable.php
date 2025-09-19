<?php

require_once 'controller/I_verificar_insertar.php';

class UpdateSectorTable {

    function update($IDLote, $ubigeo, $dg_sector)
    {
        $Seleccion="SELECT c_id_sector FROM tf_sectores WHERE c_id_sector='$IDLote'";
        $Actualizacion="UPDATE tf_sectores SET c_codi_sector='$dg_sector' , c_nomb_sector = '$dg_sector' ".
                        "WHERE c_id_sector='$IDLote'";
        $Insercion="INSERT INTO tf_sectores VALUES('$IDLote','$ubigeo','$dg_sector','$dg_sector')";
        ejecuta_consulta($Seleccion,$Insercion);
    }
}

?>