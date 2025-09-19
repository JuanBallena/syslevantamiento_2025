<?php

require_once 'controller/I_verificar_insertar.php';

class InsertFichaTable {

    function insert($IDUniCat, $IDSector,$upc_mzna,$upc_lote,$upc_sublote,$dg_dep,$dg_pro,$dg_dis,
                    $IDHabUrb,$upc_num_etapa,$IDUsuario,$dp_codUso,$dg_codcatastral,$upc_zse,
                    $upc_estado_unidad,$fecha,$IDConstruccion,$ruta_imagen, $refUso, $nombreHU)
                   
    {
        $Seleccion="SELECT c_id_uni_cat FROM tf_ficha WHERE c_id_uni_cat='$IDUniCat'";
	    $Insercion="INSERT INTO tf_ficha VALUES('$IDUniCat','$IDSector','$upc_mzna','$upc_lote','$upc_sublote',". 
			   "'$dg_dep','$dg_pro','$dg_dis','$IDHabUrb',$upc_num_etapa, '$IDUsuario','$dp_codUso',".
			   "'$dg_codcatastral','$upc_zse',$upc_estado_unidad,'$fecha','$IDConstruccion','$ruta_imagen','$refUso','$nombreHU')";
	    ejecuta_consulta($Seleccion,$Insercion);
    }
}

?>