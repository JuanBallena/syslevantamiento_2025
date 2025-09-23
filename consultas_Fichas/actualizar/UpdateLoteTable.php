<?php

require_once 'controller/I_verificar_insertar.php';

class UpdateLoteTable
{
  public function update($IDLote, $IDManzana, $dg_lote, $upc_codhu, $upc_mzna, $upc_lote, $upc_sublote)
  {
    $Seleccion = "SELECT c_id_lote FROM tf_lotes WHERE c_id_lote='$IDLote'";
    $Actualizacion = "UPDATE tf_lotes SET c_id_hab_urba='$upc_codhu', c_mzna_dist='$upc_mzna', c_lote_dist = '$upc_lote', c_sub_lote_dist = '$upc_sublote' ".
                    "WHERE c_id_lote='$IDLote'";
    $Insercion = "INSERT INTO tf_lotes VALUES('$IDLote','$IDManzana','$dg_lote','$upc_codhu','$upc_mzna',".
                                            "'$upc_lote','$upc_sublote')";
    actualiza_inserta($Seleccion, $Actualizacion, $Insercion);

  }
}
