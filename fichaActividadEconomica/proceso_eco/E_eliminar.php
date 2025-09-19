<?php

/*echo "<script>alert('AQUI SE ELIMINA');</script>\n";*/

$Ejecucion="DELETE FROM tf_fichas_economicas WHERE id_ficha='$IDFicha'";
ejecuta_elimina($Ejecucion);

$Ejecucion="DELETE FROM tf_conductores WHERE id_ficha='$IDFicha'";
ejecuta_elimina($Ejecucion);

$Ejecucion="DELETE FROM tf_autorizaciones_anuncios WHERE id_ficha='$IDFicha'";
ejecuta_elimina($Ejecucion);

$Ejecucion="DELETE FROM tf_autorizaciones_funcionamiento WHERE id_ficha='$IDFicha'";
ejecuta_elimina($Ejecucion);

$Ejecucion="DELETE FROM tf_domicilio_titulares WHERE id_ficha='$IDFicha'";
ejecuta_elimina($Ejecucion);
//elimino las puertas en todas las fichas catastrales del mismo lote
/*$Ejecucion="DELETE FROM tf_ingresos WHERE id_puerta LIKE '%'||'$IDLote'||'%'";
ejecuta_elimina($Ejecucion);	
$Ejecucion="DELETE FROM tf_puertas WHERE id_puerta LIKE '%'||'$IDLote'||'%'";
ejecuta_elimina($Ejecucion);	
*/
$Ejecucion="DELETE FROM tf_fichas WHERE id_ficha='$IDFicha'";
ejecuta_elimina($Ejecucion);

/*echo "<script>alert('AQUI CULMINA LA ELIMINACION');</script>\n";	*/
?>