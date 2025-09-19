<?php 

function declarante()
{
	  $cadena=$row15['declarante'];
	  $maximo = strlen($cadena);
	  $cadena_comienzo = "(";
	  $cadena_fin = ")";
	  $total = strpos($cadena,$cadena_comienzo);
	  $total2 = strpos($cadena,$cadena_fin);
	  $total3 = ($maximo - $total2 - 1);
	  $dni = substr ($cadena,$total,-$total3);
	  $maximo = strlen($dni);
	  $dni = substr ($dni,1,$maximo-2);
	//  echo $dni;
	  
	  $cadena_comienzo = "- ";
	  $cadena_fin = ",";
	  $total = strpos($cadena,$cadena_comienzo);
	  $total2 = strpos($cadena,$cadena_fin);
	  $total3 = ($maximo - $total2 - 1);
	  $nombres = substr ($cadena,$total,-$total3);
	  $maximo = strlen($nombres);
	  $nombres = substr ($nombres,2,$maxino-2);
	//  echo $nombres;
				  
	  $maximo = strlen($cadena);
	  $cadena_comienzo = ", ";
	  $cadena_fin = " |";
	  $total = strpos($cadena,$cadena_comienzo);
	  $total2 = strpos($cadena,$cadena_fin);
	  $total3 = ($maximo - $total2 - 2);
	  $paterno = substr ($cadena,$total,-$total3);
	  $maximo = strlen($paterno);
	  $paterno = substr ($paterno,2,$maximo-4);
	//  echo $paterno;
				  
	  $maximo = strlen($cadena);
	  $cadena_comienzo = "| ";
	  $total = strpos($cadena,$cadena_comienzo);
	  $materno = substr ($cadena,$total+2,$maximo);
	//  echo $materno;			  
}


?>