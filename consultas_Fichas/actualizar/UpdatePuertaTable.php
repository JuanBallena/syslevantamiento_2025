<?php

require_once 'controller/I_verificar_insertar.php';

class UpdatePuertaTable {

    function update($IDPuerta, $IDLote, $TipoPuerta, $NumPuerta,$tipoVia,$idFicha,$codVia, $idVia, $nombreVia , $codi_puerta)
    {
		$Seleccion="SELECT c_id_puerta FROM tf_puertas WHERE c_id_puerta='$IDPuerta'";
		$Actualizacion="UPDATE tf_puertas SET c_id_puerta='$IDPuerta', i_tipo_puerta='$TipoPuerta',c_nume_muni='$NumPuerta', ".
						"c_tip_via='$tipoVia',c_cod_via='$codVia', c_id_via='$idVia' , c_nombre_via = '$nombreVia' ".
						"WHERE i_codi_puerta='$codi_puerta'";
		$Insercion="INSERT INTO tf_puertas VALUES('$IDPuerta','$IDLote','$TipoPuerta',".
				   "'$NumPuerta','$tipoVia','$idFicha','$codVia','$idVia')";
		actualiza_inserta($Seleccion,$Actualizacion,$Insercion);
    }
}

?>