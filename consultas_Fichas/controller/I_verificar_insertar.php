<?php
	require_once 'model/database_catastro.php';
	require_once 'model/constantes.php';

function ejecuta_consulta($Seleccion,$Insercion)
{ 	
	$BaseDato=new BaseDeDatos(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);
	$BaseDato->Conectar();
	//VERIFICAMOS	
	$Busqueda=$BaseDato->Consultas($Seleccion);   
	$registros=pg_num_rows($Busqueda);
	
	if($registros>0 || $registros!='null')
	{	//NO GRABAMOS
		/*echo "<script>alert('No Grabamos');</script>\n";*/
	}
	else{
		//INSERTAMOS 
		$Resultado=$BaseDato->Consultas($Insercion);      
		/*echo "<script>alert('Grabamos');</script>\n";*/
		if(pg_affected_rows($Resultado)>=0)//Si resulto al menos una fila afectada
		{	
			return 1;       
		}
		else
			return 0;
	} 	
}

function ejecuta_elimina($Ejecucion)
{ 	
	$BD=new BaseDeDatos(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);
	//ELIMINAMOS
	$Resultado=$BD->Consultas($Ejecucion);      
	if(pg_affected_rows($Resultado)>=0)//Si resulto al menos una fila afectada
	  {	
		/*echo 'eliminado';*/
		return 1;       
	  }
	else
	  { 
		/*echo 'no se eliminó';   */  
		return 0;  
	  }
}

function ejecuta_actualiza($Modifica)
{ 	
	$BD=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);
	//ELIMINAMOS
	$Resultado=$BD->Consultas($Modifica);      
	if(pg_affected_rows($Resultado)>=0)//Si resulto al menos una fila afectada
	  {	
		return 1;       
	  }
	else
		return 0;  
}

function actualiza_inserta($Seleccion,$Actualizacion,$Insercion)
{ 	
	$BaseDato=new BaseDeDatos(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);
	//VERIFICAMOS	
	$Busqueda=$BaseDato->Consultas($Seleccion);   
	$registros=pg_num_rows($Busqueda);
	
	if($registros>0 || $registros!='null')
	{	//ACTUALIZAMOS
		$Resultado=$BaseDato->Consultas($Actualizacion); 
		/*echo "<script>alert('Actualizado');</script>\n";*/
		if(pg_affected_rows($Resultado)>=0)//Si resulto al menos una fila afectada
			  {	
				return 1;       
				  }
		else
			 return 0;  
		 	
	}
	else{
		//INSERTAMOS 
		$Resultado=$BaseDato->Consultas($Insercion);      
		/*echo "<script>alert('Grabamos');</script>\n";*/
		if(pg_affected_rows($Resultado)>=0)//Si resulto al menos una fila afectada
			  {	
				return 1;       
				  }
		else
			 return 0;  
		 } 	
}

?>
