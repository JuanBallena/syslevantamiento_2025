<?php

function ejecuta_consulta($Seleccion,$Insercion)
{ 	

	$BaseDato=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);
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
?>
