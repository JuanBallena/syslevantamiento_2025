<?php

require_once 'controller/I_verificar_insertar.php';

class InsertInformacionComplementariaTable {

    function insert($IDFicha, $ic_medidores, $ic_observacion, $ic_subdision,$ic_acumulacion,$ic_independizacion)
    {
        $Seleccion="SELECT c_id_uni_cat FROM tf_informacion_complementaria WHERE c_id_uni_cat='$IDFicha'";
        $Insercion="INSERT INTO tf_informacion_complementaria VALUES('$IDFicha',$ic_medidores,'$ic_observacion','$ic_subdision','$ic_acumulacion','$ic_independizacion')";
        ejecuta_consulta($Seleccion,$Insercion);
    }
}

?>