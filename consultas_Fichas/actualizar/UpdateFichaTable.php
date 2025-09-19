<?php

require_once 'controller/I_verificar_insertar.php';

class UpdateFichaTable {

    function update($IDUniCat, $IDSector,$upc_mzna,$upc_lote,$upc_sublote,$dg_dep,$dg_pro,$dg_dis,
                    $IDHabUrb,$upc_num_etapa,$IDUsuario,$dp_codUso,$dg_codcatastral,$upc_zse,
                    $upc_estado_unidad,$fecha,$IDConstruccion,$ruta_imagen, $refUso, $nombreHU)
                   
    {
        $Seleccion="SELECT c_id_uni_cat FROM tf_ficha WHERE c_id_uni_cat='$IDUniCat'";
        $Actualizacion="UPDATE tf_ficha SET c_manzana='$upc_mzna', c_lote='$upc_lote', c_sublote='$upc_sublote', c_id_hab_urba='$IDHabUrb', ".
                        "i_num_etapa=$upc_num_etapa, c_id_usuario='$IDUsuario', c_codi_uso='$dp_codUso', c_tipozce='$upc_zse', i_cod_est_unid='$upc_estado_unidad', ".
                        "d_fecha='$fecha', c_id_construccion='$IDConstruccion', c_ruta_imagen='$ruta_imagen', c_referencial_uso='$refUso', c_nombre_hu='$nombreHU' ".
                        "WHERE c_id_uni_cat='$IDUniCat'";
	    $Insercion="INSERT INTO tf_ficha VALUES('$IDUniCat','$IDSector','$upc_mzna','$upc_lote','$upc_sublote',". 
			   "'$dg_dep','$dg_pro','$dg_dis','$IDHabUrb',$upc_num_etapa, '$IDUsuario','$dp_codUso',".
			   "'$dg_codcatastral','$upc_zse',$upc_estado_unidad,'$fecha','$IDConstruccion','$ruta_imagen','$refUso')";
        actualiza_inserta($Seleccion,$Actualizacion,$Insercion);
    }
}

?>