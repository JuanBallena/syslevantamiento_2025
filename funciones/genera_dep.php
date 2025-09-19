<?php 

function generaDepartamento()
{
	$BaseDato=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);
	$BaseDato->conectar();
	$Consulta="select codi_dep, descri from tf_ubigeos where codi_pro='00'"; 
	$consulta_provincia = $BaseDato->Consultas($Consulta);
	$BaseDato->desconectar();
	
	// Voy imprimiendo el primer select compuesto por departamentos
	echo "<select style='width:200px' class='select' name='departamentos' id='departamentos' onChange='cargaContenido(this.id)'>";
	echo "<option value='0'>Seleccione</option>";
	while($registro=pg_fetch_row($consulta_provincia))
	{
		echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
	}
	echo "</select>";
}

//-------------------------------------- VERIFICA UBIGEO (edicion de fichas)----------------------------------------------------
function verifica_ubigeo($lugar,$tipo_ficha)
{
	switch($tipo_ficha)
	{
		case 1:	
				global $row6;
				$midep=$row6['codi_dep'];
				$mipro=$row6['codi_pro'];
				$midis=$row6['codi_dis'];
				break;
		case 3:
				global $row3;
				$midep=$row3['codi_dep'];
				$mipro=$row3['codi_pro'];
				$midis=$row3['codi_dis'];
				break;
	}
	
	$BaseDato=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);
	$BaseDato->conectar();
	
	$Consulta1="SELECT descri FROM tf_ubigeos WHERE codi_dep='$midep' AND codi_pro='00' AND codi_dis='00'"; 
	$consulta = $BaseDato->Consultas($Consulta1);
	$extrae_dep=pg_fetch_row($consulta);
	
	$Consulta2="SELECT descri FROM tf_ubigeos WHERE codi_dep='$midep' AND codi_pro='$mipro' AND codi_dis='00'"; 
	$consulta = $BaseDato->Consultas($Consulta2);
	$extrae_pro=pg_fetch_row($consulta);
	
	$Consulta3="SELECT descri FROM tf_ubigeos WHERE codi_dep='$midep' AND codi_pro='$mipro' AND codi_dis='$midis'"; 
	$consulta = $BaseDato->Consultas($Consulta3);
	$extrae_dis=pg_fetch_row($consulta);
	
	$BaseDato->desconectar();
	// imprimiendo el select Tipo Institucion
	switch($lugar)
	{
		case 'dep': 
					echo "<select style='width:200px' class='select'  name='departamento' id='departamento'>";
					echo	  "<option value='".$midep."'>".$extrae_dep[0]."</option></select>";
					//echo $midep;
					break;
					
		case 'pro':
					echo "<select style='width:200px' class='select'  name='provincia' id='provincia'>";
					echo	  "<option value='".$midep.$mipro."'>".$extrae_pro[0]."</option></select>";
					//echo $midep.'-'.$mipro;
					break;

		case 'dis':
					echo "<select style='width:200px' class='select'  name='distrito' id='distrito'>";
					echo	  "<option value='".$midis."'>".$extrae_dis[0]."</option></select>";
					//echo $midis ;
					break;
	}
}

function verifica_ubigeo_cotitulares($lugar,$tipo_ficha,$id)
{
	switch($tipo_ficha)
	{
		case 2:
				global $row2;
				$midep=$row2['codi_dep'];
				$mipro=$row2['codi_pro'];
				$midis=$row2['codi_dis'];
				break;
	}
	
	$BaseDato=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);
	$BaseDato->conectar();
	
	$Consulta1="SELECT descri FROM tf_ubigeos WHERE codi_dep='$midep' AND codi_pro='00' AND codi_dis='00'"; 
	$consulta = $BaseDato->Consultas($Consulta1);
	$extrae_dep=pg_fetch_row($consulta);
	
	$Consulta2="SELECT descri FROM tf_ubigeos WHERE codi_dep='$midep' AND codi_pro='$mipro' AND codi_dis='00'"; 
	$consulta = $BaseDato->Consultas($Consulta2);
	$extrae_pro=pg_fetch_row($consulta);
	
	$Consulta3="SELECT descri FROM tf_ubigeos WHERE codi_dep='$midep' AND codi_pro='$mipro' AND codi_dis='$midis'"; 
	$consulta = $BaseDato->Consultas($Consulta3);
	$extrae_dis=pg_fetch_row($consulta);
	
	$BaseDato->desconectar();
	
	// imprimiendo el select Tipo Institucion
	switch($lugar)
	{
		case 'dep': 
					
					echo "<select style='width:200px' class='select'  name='departamento".$id."' id='departamento".$id."'>";
					echo	  "<option value='".$midep."'>".$extrae_dep[0]."</option></select>";
					//echo $midep;
					break;
					
		case 'pro':
					
					echo "<select style='width:200px' class='select'  name='provincia".$id."' id='provincia".$id."'>";
					echo	  "<option value='".$midep.$mipro."'>".$extrae_pro[0]."</option></select>";
					//echo $midep.'-'.$mipro;
					break;
		case 'dis':
					
					echo "<select style='width:200px' class='select'  name='distrito".$id."' id='distrito".$id."'>";
					echo	  "<option value='".$midis."'>".$extrae_dis[0]."</option></select>";
					//echo $midis ;
					break;
	}
}

?>