<?php

require_once 'controller/I_verificar_insertar.php';

class InsertImagenTable {

    function insert($IDFicha, $nombre, $archivo_bytea,$mime,$size)
    {
        $Seleccion="SELECT c_id_uni_cat FROM tf_ficha_imagen WHERE c_id_uni_cat='$IDFicha'";
        $Insercion="INSERT INTO tf_ficha_imagen VALUES('$IDFicha','$nombre','$archivo_bytea','$mime','$size')";
        ejecuta_consulta($Seleccion,$Insercion);
    }
}

?>