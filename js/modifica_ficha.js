	
//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ VERIFICAMOS DATOS $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
function modificar_ficha()
{	
	var i; sw=0; edit=0;
	var num=document.getElementById("numero").value;
	
	var anio=document.getElementById("anio").value;
	var sector=document.getElementById("sector").value;
	var mzna=document.getElementById("mzna").value;
	var lote=document.getElementById("lote").value;
	
	//alert(anio+'-'+sector+'-'+mzna+'-'+lote);
	
	var cuc1=document.getElementById("cuc8").value;
	var cuc2=document.getElementById("cuc4").value;
	var cuc=String(cuc1)+String(cuc2);
	//---------------------------------------------------------------
	if ((!document.getElementById("forma1").disabled) && (!document.getElementById("forma3").disabled)) 
		{
			alert("Elija una forma de búsqueda");
			return false;
		}
	
	//---------------------------------------------------------------
	if ((!document.getElementById("forma1").disabled) && num=='') 
		{
			alert("Ingrese número de ficha");
			document.getElementById("numero").focus();
			return false;
		}
		
	if ((!document.getElementById("forma2").disabled) && sector=='' && mzna=='' && lote=='') 
		{
			alert("Ingrese un código de referencia");
			document.getElementById("sector").focus();
			return false;
		}	
	
	if ((!document.getElementById("forma3").disabled) && cuc1=='') 
		{
			alert("Ingrese código único catastral");
			document.getElementById("cuc8").focus();
			return false;
		}
	//--------------------------------------------------------------
	
    for (i=0;i<document.envio.opt_fichas.length;i++)
	{
       //alert("contador: "+i);
	   if (document.envio.opt_fichas[i].checked)
          {	sw=1; break;
			}		  
    }
//    alert(sw);
	if (sw==0)
		{alert("Elija un Tipo de Ficha para continuar"); 
			return false;}

	else 

		if (document.envio.opt_fichas[i].value==1)	
		{		
			
			if((document.getElementById("forma1").checked))
			{
			document.envio.action="funciones/consulta_numero.php?nro="+num+"&tipo=01&edit="+edit;
			}

			else 

			if((document.getElementById("forma2").checked))
			{

			//alert('ingrese a consulta forma 2');
			//codigo referencia
			document.envio.action="funciones/consulta_ref.php?anio="+anio+"&sector="+sector+"&mzna="+mzna+"&lote="+lote+"&tipo=01";			
		
			}
			else 

				if((document.getElementById("forma3").checked))
				{
					document.envio.action="funciones/consulta_cuc.php?nro="+cuc+"&tipo=01";
				}
		}
	else 
		if(document.envio.opt_fichas[i].value==2) 
		{	
		if((document.getElementById("forma1").checked))
		{
			document.envio.action="funciones/consulta_numero.php?nro="+num+"&tipo=02";
		}
		else if((document.getElementById("forma2").checked))
		{
			//codigo referencia
			document.envio.action="funciones/consulta_ref.php?anio="+anio+"&sector="+sector+"&mzna="+mzna+"&lote="+lote+"&tipo=02";	
		}
		else if((document.getElementById("forma3").checked))
		{
			document.envio.action="funciones/consulta_cuc.php?nro="+cuc+"&tipo=02";
		}
	}
	else if(document.envio.opt_fichas[i].value==3) 
	{	
		if((document.getElementById("forma1").checked))
		{
			document.envio.action="funciones/consulta_numero.php?nro="+num+"&tipo=03";
		}
		else if((document.getElementById("forma2").checked))
		{
			//codigo referencia
			document.envio.action="funciones/consulta_ref.php?anio="+anio+"&sector="+sector+"&mzna="+mzna+"&lote="+lote+"&tipo=03";			
		}
		else if((document.getElementById("forma3").checked))
		{
			document.envio.action="funciones/consulta_cuc.php?nro="+cuc+"&tipo=03";
		}
	}
	else if(document.envio.opt_fichas[i].value==4) 
	{
		if((document.getElementById("forma1").checked))
		{
			document.envio.action="funciones/consulta_numero.php?nro="+num+"&tipo=04";
		}
		else if((document.getElementById("forma2").checked))
		{
			//codigo referencia
			document.envio.action="funciones/consulta_ref.php?anio="+anio+"&sector="+sector+"&mzna="+mzna+"&lote="+lote+"&tipo=04";				
		}
		else if((document.getElementById("forma3").checked))
		{
			document.envio.action="funciones/consulta_cuc.php?nro="+cuc+"&tipo=04";
		}
	}

    else if(document.envio.opt_fichas[i].value==5) 
	{	
	
	 if((document.getElementById("forma2").checked))
		{
			//codigo referencia
			document.envio.action="funciones/consulta_ref_todo.php?anio="+anio+"&sector="+sector+"&mzna="+mzna+"&lote="+lote+"&tipo=03";			
		}
		
	}
	
}

//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ BLOQUEOS DE CHEK $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
function bloqueos(e)
{
   if(e.name=="forma1")
   {  	 
   		document.getElementById("forma2").disabled=!document.getElementById("forma2").disabled
		document.getElementById("forma3").disabled=!document.getElementById("forma3").disabled
		

		document.getElementById("sector").value='';
		document.getElementById("mzna").value='';
		document.getElementById("lote").value='';
		
		document.getElementById("cuc8").value='';
		document.getElementById("cuc4").value='';
		
		
		document.getElementById("sector").disabled=!document.getElementById("sector").disabled
		document.getElementById("mzna").disabled=!document.getElementById("mzna").disabled
		document.getElementById("lote").disabled=!document.getElementById("lote").disabled
		
		document.getElementById("cuc8").disabled=!document.getElementById("cuc8").disabled
		document.getElementById("cuc4").disabled=!document.getElementById("cuc4").disabled
		
		document.getElementById("numero").focus();
   }
   if(e.name=="forma2")
   {  	 
   		document.getElementById("numero").value='';
		document.getElementById("cuc8").value='';
		document.getElementById("cuc4").value='';
		
		document.getElementById("forma1").disabled=!document.getElementById("forma1").disabled
		document.getElementById("forma3").disabled=!document.getElementById("forma3").disabled
		
		document.getElementById("numero").disabled=!document.getElementById("numero").disabled
		document.getElementById("cuc8").disabled=!document.getElementById("cuc8").disabled
		document.getElementById("cuc4").disabled=!document.getElementById("cuc4").disabled
		
		document.getElementById("sector").focus();
   }
   
   if(e.name=="forma3")
   {  	 
		document.getElementById("numero").value='';
		document.getElementById("sector").value='';
		document.getElementById("mzna").value='';
		document.getElementById("lote").value='';
		
		document.getElementById("forma1").disabled=!document.getElementById("forma1").disabled
		document.getElementById("forma2").disabled=!document.getElementById("forma2").disabled
		
		document.getElementById("numero").disabled=!document.getElementById("numero").disabled
		
		document.getElementById("sector").disabled=!document.getElementById("sector").disabled
		document.getElementById("mzna").disabled=!document.getElementById("mzna").disabled
		document.getElementById("lote").disabled=!document.getElementById("lote").disabled
		
		document.getElementById("cuc8").focus();
   }
	
}

