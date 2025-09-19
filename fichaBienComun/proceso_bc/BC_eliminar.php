<?php

/*echo "<script>alert('AQUI SE ELIMINA');</script>\n";*/

$Ejecucion="DELETE FROM tf_instalaciones WHERE id_ficha='$IDFicha'";
ejecuta_elimina($Ejecucion);

$Ejecucion="DELETE FROM tf_construcciones WHERE id_ficha='$IDFicha'";
ejecuta_elimina($Ejecucion);

$Ejecucion="DELETE FROM tf_registro_legal WHERE id_ficha='$IDFicha'";
ejecuta_elimina($Ejecucion);

$Ejecucion="DELETE FROM tf_sunarp WHERE id_ficha='$IDFicha'";
ejecuta_elimina($Ejecucion);

$Ejecucion="DELETE FROM tf_servicios_basicos WHERE id_ficha='$IDFicha'";
ejecuta_elimina($Ejecucion);

$Ejecucion="DELETE FROM tf_linderos WHERE id_ficha='$IDFicha'";
ejecuta_elimina($Ejecucion);

$Ejecucion="DELETE FROM tf_fichas_bienes_comunes WHERE id_ficha='$IDFicha'";
ejecuta_elimina($Ejecucion);

$Ejecucion="DELETE FROM tf_ingresos WHERE id_puerta LIKE '%'||'$IDLote'||'%'";
ejecuta_elimina($Ejecucion);

$Ejecucion="DELETE FROM tf_fichas WHERE id_ficha='$IDFicha'";
ejecuta_elimina($Ejecucion);

/*echo "<script>alert('AQUI CULMINA LA ELIMINACION');</script>\n";*/	
?>