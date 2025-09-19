<?php

require_once 'controller/I_verificar_insertar.php';

class UpdateInformacionComplementariaTable {

    function update($IDFicha, $ic_medidores, $ic_observacion, $ic_subdision,$ic_acumulacion,$ic_independizacion)
    {
        $Seleccion="SELECT c_id_uni_cat FROM tf_informacion_complementaria WHERE c_id_uni_cat='$IDFicha'";
        $Actualizacion="UPDATE tf_informacion_complementaria SET i_medidores='$ic_medidores', c_observaciones='$ic_observacion', i_subdivision = '$ic_subdision', i_acumulacion ='$ic_acumulacion' , i_independizacion = '$ic_independizacion' ". 
                         "WHERE c_id_uni_cat='$IDFicha'";
        $Insercion="INSERT INTO tf_informacion_complementaria VALUES('$IDFicha',$ic_medidores,'$ic_observacion','$ic_subdision','$ic_acumulacion','$ic_independizacion')";
        actualiza_inserta($Seleccion,$Actualizacion,$Insercion);
    }
}

?>