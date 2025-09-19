<?php

function generaCombo($num)
{	$BD=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);
	$BD->conectar();
		
	switch($num)
	{ 	
		case 1:
				$iden='HUR';
				$name='cmb_tipohu';
				$ancho='width:146px';
				break;
		
		}

		//relizamos consulta según las variables
		$Consulta="SELECT tf_tablas_codigos.codigo, tf_tablas_codigos.codigo ||' - '||  tf_tablas_codigos.desc_codigo FROM tf_tablas, tf_tablas_codigos WHERE tf_tablas.id_tabla = tf_tablas_codigos.id_tabla AND tf_tablas.id_tabla = '$iden'"; 
	$consulta_combo = $BD->Consultas($Consulta);
			
	echo "<select style='$ancho' class='combos' name='$name' id='$name'>";
	echo "<option value='0'>Seleccione</option>";
	while($registro=pg_fetch_row($consulta_combo))
		{ echo "<option value='".$registro[0]."'>".$registro[1]."</option>"; }
	echo "</select>";
}//fin generaCombo

//---------------------------------------------------------------------------
?>