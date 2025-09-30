<?php
	//VERIFICAMOS	
	$Busqueda=$BaseDato->Consultas($Seleccion);  
  
  $registros=pg_num_rows($Busqueda);
  
	
	if($registros>0)
	{	
    // $filas = pg_fetch_all($Busqueda);
  // echo "<pre>";
  // print_r($filas);  
  // print_r($registros);
  // echo "</pre>";
    echo "<script>alert('Código ya existe!');</script>\n"; 
		echo "<html><head></head><body onload=\"history.back()\"></body></html>";
		exit;
	}
	else{
		//INSERTAMOS 
		$Resultado=$BaseDato->Consultas($Insercion);      
		
		if(pg_affected_rows($Resultado)>=0)//Si resulto al menos una fila afectada
			  {	$cad1="<script>alert('Registro Exitoso!');document.location.href='../";
				$cad2=$pagina;
				$cad3="';</script>\n";
				$mensaje=$cad1.$cad2.$cad3;
				echo $mensaje; 
				return 1;       
				  }
		else
			 return 0;  
		} 
	unset($_SESSION['pagina']);         

?>
