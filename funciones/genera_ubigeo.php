<?php 

function generaDep($i)
{

	$BaseDato=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);
	$BaseDato->conectar();
	$Consulta="select codi_dep, descri from tf_ubigeos where codi_pro='00'"; 
	$consulta_provincia = $BaseDato->Consultas($Consulta);
	$BaseDato->desconectar();
	

	// Voy imprimiendo el primer select compuesto por departamentos
	echo "<select class='select' name='departamentos".$i."' id='departamentos".$i."' onChange='cargaContenido(this.id,".$i.")'>";
	echo "<option value='0'>Elige...</option>";
	while($registro=pg_fetch_row($consulta_provincia))
	{
		echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
	}
	echo "</select>";
}

?>