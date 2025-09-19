<?php

require_once 'controller/I_verificar_insertar.php';

class DeleteViaPuertaTable {

    function update($IDCodiPuerta)
    {
        $Ejecucion="DELETE FROM tf_puertas WHERE i_codi_puerta='$IDCodiPuerta'";
        ejecuta_elimina($Ejecucion);
    }
}

?>