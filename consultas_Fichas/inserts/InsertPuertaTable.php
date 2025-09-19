<?php

require_once 'controller/I_verificar_insertar.php';

class InsertPuertaTable {

    function insert($IDPuerta, $IDLote, $TipoPuerta, $NumPuerta,$tipoVia,$idFicha,$codVia, $idVia, $nombreVia)
    {
		$Seleccion="SELECT c_id_puerta FROM tf_puertas WHERE c_id_puerta='$IDPuerta'";
		$Insercion="INSERT INTO tf_puertas VALUES('$IDPuerta','$IDLote','$TipoPuerta',".
				   "'$NumPuerta','$tipoVia','$idFicha','$codVia','$idVia', '$nombreVia')";
		ejecuta_consulta($Seleccion,$Insercion);
    }
}

?>