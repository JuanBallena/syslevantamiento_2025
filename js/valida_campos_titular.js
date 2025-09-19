//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& ELIMINAR ESPACIOS %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
function lTrim(sStr){
     while (sStr.charAt(0) == " ")
      sStr = sStr.substr(1, sStr.length - 1);
     return sStr;
    }
 
    function rTrim(sStr){
     while (sStr.charAt(sStr.length - 1) == " ")
      sStr = sStr.substr(0, sStr.length - 1);
     return sStr;
    }
 
    function allTrim(sStr){
     return rTrim(lTrim(sStr));
    }

//------------------------------------------- CONDICION TITULAR : COTITULARIDAD ------------------------------------------------
function cargar_condicion_titular(e)
{	
	// Obtengo el select
	var selectOrigen=document.getElementById(e);
	// Obtengo la opcion que el usuario selecciono
	var opcionSeleccionada=selectOrigen.options[selectOrigen.selectedIndex].value;
	// Quitamos los espacios
	opcionSeleccionada=allTrim(opcionSeleccionada);
	//alert(opcionSeleccionada);
	if(opcionSeleccionada=='05')
	{	//OCULTAMOS TABLA
		document.getElementById("oculta").style.display="none" ;
		document.getElementById("ct_fechaadq").disabled=true;
		document.getElementById("ct_cmb_formadq").disabled=true;
		document.getElementById("ct_numresexo").disabled=true;
		document.getElementById("ct_porcentaje").disabled=true;
		document.getElementById("ct_fechaini").disabled=true;
		document.getElementById("ct_fechafin").disabled=true;
	}
	else 
	{	//VISULIZAMOS TABLA
		document.getElementById("oculta").style.display="inline" ;
		document.getElementById("ct_fechaadq").disabled=false;
		document.getElementById("ct_cmb_formadq").disabled=false;
		document.getElementById("ct_numresexo").disabled=false;
		document.getElementById("ct_porcentaje").disabled=false;
		document.getElementById("ct_fechaini").disabled=false;
		document.getElementById("ct_fechafin").disabled=false;
	}
}

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& ACTIVA/DESACTIVA : PERSONA NATURAL %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

function cargar_tipo_persona(e)
{	
	//alert(e);
	// Obtengo el select
	var selectOrigen=document.getElementById(e);
	// Obtengo la opcion que el usuario selecciono
	var opcionSeleccionada=selectOrigen.options[selectOrigen.selectedIndex].value;
	// Quitamos los espacios
	opcionSeleccionada=allTrim(opcionSeleccionada);
	
	var tipo_ficha=document.getElementById("tipo").value;
	//alert(tipo_ficha);
	//aqui ontenemos el nombre del combo y su longitud -> se usará en COTITULARES
			//alert(selectOrigen.name);
			var cantidad=selectOrigen.name.length ;
			//alert(cantidad);
			//obtengo el valor del nro titular ejm: dcc_nro_cotitular-"0"
			var indice=selectOrigen.name.substring(cantidad-1,cantidad) 
			//alert(indice);
	
	switch(tipo_ficha)
	{ 
	
	
	case '01':	 //INDIVIDUAL
		if(opcionSeleccionada=='1')
		{
			//esta linea es para activar y desactivar sin condicion
			//document.getElementById("itc_cmb_ecivil").disabled=!document.getElementById("itc_cmb_ecivil").disabled
			document.getElementById("itc_cmb_ecivil").disabled=false;
			document.getElementById("itc_cmb_tipodoc1").disabled=false;
			document.getElementById("itc_numdoc1").disabled=false;
			document.getElementById("itc_nombre1").disabled=false;
			document.getElementById("itc_paterno1").disabled=false;
			document.getElementById("itc_materno1").disabled=false;
					
			document.getElementById("itc_ruc").disabled=true;
			document.getElementById("itc_razsocial").disabled=true;
			document.getElementById("itc_cmb_perjur").disabled=true;
			//limpiamos los 3
			document.getElementById("itc_ruc").value="";
			document.getElementById("itc_razsocial").value="";
			document.getElementById("itc_cmb_perjur").value="";
			
			document.getElementById("itc_cmb_condesptitu").disabled=false;
			document.getElementById("itc_numresexo").disabled=false;
			document.getElementById("itc_numbolpen").disabled=false;
			document.getElementById("itc_fechainiexo").disabled=false;
			document.getElementById("itc_fechafinexo").disabled=false;
			
			document.getElementById("itc_cmb_ecivil").focus();
		}
		else if(opcionSeleccionada=='2')
		{	
			/*document.getElementById("itc_ruc").style.borderColor="#000099";
			document.getElementById("itc_ruc").style.borderStyle = "solid";
			document.getElementById("itc_ruc").style.borderWidth = "1px";*/
			
			document.getElementById("itc_cmb_ecivil").disabled=true;
			document.getElementById("itc_nombre1").disabled=true;
			document.getElementById("itc_cmb_tipodoc1").disabled=true;
			document.getElementById("itc_numdoc1").disabled=true;
			document.getElementById("itc_nombre1").disabled=true;
			document.getElementById("itc_paterno1").disabled=true;
			document.getElementById("itc_materno1").disabled=true;
		
			document.getElementById("itc_cmb_ecivil").value="";
			document.getElementById("itc_cmb_tipodoc1").value="";
			document.getElementById("itc_numdoc1").value="";
			document.getElementById("itc_nombre1").value="";
			document.getElementById("itc_paterno1").value="";
			document.getElementById("itc_materno1").value="";
			
			
			document.getElementById("itc_ruc").disabled=false;
			document.getElementById("itc_razsocial").disabled=false;
			document.getElementById("itc_cmb_perjur").disabled=false;
			
			document.getElementById("itc_cmb_condesptitu").disabled=false;
			document.getElementById("itc_numresexo").disabled=false;
			document.getElementById("itc_numbolpen").disabled=true;
			document.getElementById("itc_numbolpen").value="";
			document.getElementById("itc_fechainiexo").disabled=false;
			document.getElementById("itc_fechafinexo").disabled=false;
			
			document.getElementById("itc_ruc").focus();
		}
		else
		{	//limpiamos todos
			document.getElementById("itc_cmb_ecivil").value="";
			document.getElementById("itc_cmb_tipodoc1").value="";
			document.getElementById("itc_numdoc1").value="";
			document.getElementById("itc_nombre1").value="";
			document.getElementById("itc_paterno1").value="";
			document.getElementById("itc_materno1").value="";
			document.getElementById("itc_cmb_tipodoc2").value="";
			document.getElementById("itc_numdoc2").value="";
			document.getElementById("itc_nombre2").value="";
			document.getElementById("itc_paterno2").value="";
			document.getElementById("itc_materno2").value="";
			document.getElementById("itc_ruc").value="";
			document.getElementById("itc_razsocial").value="";
			document.getElementById("itc_cmb_perjur").value="";
			document.getElementById("itc_cmb_condesptitu").value="";
			document.getElementById("itc_numresexo").value="";
			document.getElementById("itc_numbolpen").value="";
			document.getElementById("itc_fechainiexo").value="";
			document.getElementById("itc_fechafinexo").value="";
			
			//desactivo
			document.getElementById("itc_cmb_ecivil").disabled=true;
			document.getElementById("itc_cmb_tipodoc1").disabled=true;
			document.getElementById("itc_numdoc1").disabled=true;
			document.getElementById("itc_nombre1").disabled=true;
			document.getElementById("itc_paterno1").disabled=true;
			document.getElementById("itc_materno1").disabled=true;
			document.getElementById("itc_cmb_tipodoc2").disabled=true;
			document.getElementById("itc_numdoc2").disabled=true;
			document.getElementById("itc_nombre2").disabled=true;
			document.getElementById("itc_paterno2").disabled=true;
			document.getElementById("itc_materno2").disabled=true;
			document.getElementById("itc_ruc").disabled=true;
			document.getElementById("itc_razsocial").disabled=true;
			document.getElementById("itc_cmb_perjur").disabled=true;
			document.getElementById("itc_cmb_condesptitu").disabled=true;
			document.getElementById("itc_numresexo").disabled=true;
			document.getElementById("itc_numbolpen").disabled=true;
			document.getElementById("itc_fechainiexo").disabled=true;
			document.getElementById("itc_fechafinexo").disabled=true;
			
			
		}
			
			break;
	
	case '02': //COTITULAR
			//alert(indice);
			if(opcionSeleccionada=='1')
			{	
				document.getElementById("itc_cmb_tipodoc-"+indice).disabled=false;
				document.getElementById("itc_numdoc-"+indice).disabled=false;
				document.getElementById("itc_nombre_"+indice).disabled=false;
				document.getElementById("itc_paterno_"+indice).disabled=false;
				document.getElementById("itc_materno_"+indice).disabled=false;
				document.getElementById("ct_cmb_formadq-"+indice).disabled=false;
						
				document.getElementById("itc_ruc-"+indice).disabled=true;
				document.getElementById("itc_razsocial-"+indice).disabled=true;
				
				//limpiamos los 2
				document.getElementById("itc_ruc-"+indice).value="";
				document.getElementById("itc_razsocial-"+indice).value="";
		
				document.getElementById("itc_cmb_condesptitu-"+indice).disabled=false;
				document.getElementById("itc_numresexo-"+indice).disabled=false;
				document.getElementById("itc_fechainiexo_"+indice).disabled=false;
				document.getElementById("itc_fechafinexo_"+indice).disabled=false;
				
				document.getElementById("dcc_porcentaje-"+indice).focus();
			}
			else if(opcionSeleccionada=='2')
			{					
				document.getElementById("itc_cmb_tipodoc-"+indice).disabled=true;
				document.getElementById("itc_numdoc-"+indice).disabled=true;
				document.getElementById("itc_nombre_"+indice).disabled=true;
				document.getElementById("itc_paterno_"+indice).disabled=true;
				document.getElementById("itc_materno_"+indice).disabled=true;
				document.getElementById("ct_cmb_formadq-"+indice).disabled=false;
				
				document.getElementById("itc_cmb_tipodoc-"+indice).value="";
				document.getElementById("itc_numdoc-"+indice).value="";
				document.getElementById("itc_nombre_"+indice).value="";
				document.getElementById("itc_paterno_"+indice).value="";
				document.getElementById("itc_materno_"+indice).value="";
				
				
				document.getElementById("itc_ruc-"+indice).disabled=false;
				document.getElementById("itc_razsocial-"+indice).disabled=false;
				document.getElementById("itc_cmb_condesptitu-"+indice).disabled=false;
				document.getElementById("itc_numresexo-"+indice).disabled=false;
				document.getElementById("itc_fechainiexo_"+indice).disabled=false;
				document.getElementById("itc_fechafinexo_"+indice).disabled=false;
				
				document.getElementById("dcc_porcentaje-"+indice).focus();
			}
			else
			{	
				document.getElementById("itc_cmb_tipodoc-"+indice).disabled=true;
				document.getElementById("itc_numdoc-"+indice).value="";
				document.getElementById("itc_nombre_"+indice).value="";
				document.getElementById("itc_paterno_"+indice).value="";
				document.getElementById("itc_materno_"+indice).value="";
				document.getElementById("itc_ruc-"+indice).disabled=true;
				document.getElementById("itc_razsocial-"+indice).disabled=true;
				document.getElementById("ct_cmb_formadq-"+indice).disabled=true;
				document.getElementById("itc_cmb_condesptitu-"+indice).disabled=true;
				document.getElementById("itc_numresexo-"+indice).disabled=true;
				
				document.getElementById("itc_fechainiexo_"+indice).disabled=true;
				document.getElementById("itc_fechafinexo_"+indice).disabled=true;
				
				//limpiamos todos
				
				document.getElementById("itc_cmb_tipodoc-"+indice).value="";
				document.getElementById("itc_numdoc-"+indice).value="";
				document.getElementById("itc_nombre_"+indice).value="";
				document.getElementById("itc_paterno_"+indice).value="";
				document.getElementById("itc_materno_"+indice).value="";
				document.getElementById("itc_ruc-"+indice).value="";
				document.getElementById("itc_razsocial-"+indice).value="";
				
				document.getElementById("itc_cmb_condesptitu-"+indice).value="";
				document.getElementById("itc_numresexo-"+indice).value="";
				
				document.getElementById("itc_fechainiexo_"+indice).value="";
				document.getElementById("itc_fechafinexo_"+indice).value="";
			}
			break;
	
	case '03':
			break;
	
	}//fin de switch
}//fin de función

//------------------------------------------ ESTADO CIVIL : CASADO ------------------------------------------------

function cargar_estado_civil(e)
{	
	// Obtengo el select
	var selectOrigen=document.getElementById(e);
	// Obtengo la opcion que el usuario selecciono
	var opcionSeleccionada=selectOrigen.options[selectOrigen.selectedIndex].value;
	// Quitamos los espacios
	opcionSeleccionada=allTrim(opcionSeleccionada);
	
	if(opcionSeleccionada=='01')
	{	
		document.getElementById("itc_cmb_tipodoc1").disabled=false;
		document.getElementById("itc_numdoc1").disabled=false;
		document.getElementById("itc_nombre1").disabled=false;
		document.getElementById("itc_paterno1").disabled=false;
		document.getElementById("itc_materno1").disabled=false;
		
		document.getElementById("itc_cmb_tipodoc2").value="";
		document.getElementById("itc_numdoc2").value="";
		document.getElementById("itc_nombre2").value="";
		document.getElementById("itc_paterno2").value="";
		document.getElementById("itc_materno2").value="";
		
		document.getElementById("itc_cmb_tipodoc2").disabled=true;
		document.getElementById("itc_numdoc2").disabled=true;
		document.getElementById("itc_nombre2").disabled=true;
		document.getElementById("itc_paterno2").disabled=true;
		document.getElementById("itc_materno2").disabled=true;
	}
	else if(opcionSeleccionada=='02' || opcionSeleccionada=='05')
	{	
		
		document.getElementById("itc_cmb_tipodoc2").disabled=false;
		document.getElementById("itc_numdoc2").disabled=false;
		document.getElementById("itc_nombre2").disabled=false;
		document.getElementById("itc_paterno2").disabled=false;
		document.getElementById("itc_materno2").disabled=false;
	}
	else
	{	
		document.getElementById("itc_cmb_tipodoc2").disabled=true;
		document.getElementById("itc_numdoc2").disabled=true;
		document.getElementById("itc_nombre2").disabled=true;
		document.getElementById("itc_paterno2").disabled=true;
		document.getElementById("itc_materno2").disabled=true;
		
		document.getElementById("itc_cmb_tipodoc1").value="";
		document.getElementById("itc_numdoc1").value="";
		document.getElementById("itc_nombre1").value="";
		document.getElementById("itc_paterno1").value="";
		document.getElementById("itc_materno1").value="";	
		
		document.getElementById("itc_cmb_tipodoc2").value="";
		document.getElementById("itc_numdoc2").value="";
		document.getElementById("itc_nombre2").value="";
		document.getElementById("itc_paterno2").value="";
		document.getElementById("itc_materno2").value="";	
	}
}