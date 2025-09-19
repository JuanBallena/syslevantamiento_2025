
//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ VERIFICAMOS DATOS $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
function edit_fichas()
	{	
		var i; sw=0;
		var num=document.getElementById("numero").value;
		var ref=document.getElementById("referencia").value;
		var cuc1=document.getElementById("cuc8").value;
		var cuc2=document.getElementById("cuc4").value;		
		var estafi=document.getElementById("ic_cmb_estficha").value;

		var tipopu=document.getElementById("upc_pue-0").value;

		var predca=document.getElementById("dp_cmb_precat").value;
		var tipoti=document.getElementById("itc_cmb_tipotitu").value;
		var condti=document.getElementById("ct_cmb_condtitu").value;
		var claspr=document.getElementById("dp_cmb_claspre").value;
		var cuc=String(cuc1)+String(cuc2);

		var sec=document.getElementById("sector").value;
		var tipvia=document.getElementById("dftc_cmb_tipovia").value;
		var tiphu=document.getElementById("dftc_cmb_tipohab").value;

		//---------------------------------------------------------------
		//if ((!document.getElementById("forma1").disabled) && (!document.getElementById("forma11").disabled))
		/*if (!document.getElementById("forma1").disabled)
		
		 {
			alert("Elija una forma de búsqueda");
			return false;
		 }*/
	
		//---------------------------------------------------------------
		/*if (!document.getElementById("forma1").disabled) 
		 {
			if  (num=='') 
			  {
				alert("Ingrese número de ficha");
				return false;
			  }
		 }
		
		if (!document.getElementById("forma2").disabled) 
		 {
			if  (ref=='') 
			  {
				alert("Ingrese código de referencia");
				return false;
			  }
			else if(ref.length<22)
			  {
				alert('Ingrese correctamente el cód ref - 21 digitos');	
				return false;
			  }	
		 }	
	
		if (!document.getElementById("forma3").disabled) 
		 {
			if  (cuc1=='') 
			  {
				alert("Ingrese código único catastral");
				return false;
			  }
			else if ((cuc1.length<8)&& (cuc2.length<4)) 
			  {
				alert('Ingrese correctamente el primer CUC(8 digitos) y segundo CUC - 4 dígitos');	
				return false;
			  }
		 }

		 if (!document.getElementById("forma11").disabled) 
		 {
			if  (condti=='') 
			  {
				alert("Elija la condición del Titular");
				return false;
			  }
		 }
 */
		//--------------------------------------------------------------
	
    	for (i=0;i<document.envio.opt_fichas.length;i++)
		 {
	       //alert("contador: "+i);
		   if (document.envio.opt_fichas[i].checked)
	          {	
	          	sw=1; break;
			  }		  
    	 }
		//    alert(sw);
		if (sw==0)
			{
			  alert("Elija un Tipo de Ficha para continuar"); 
			  return false;
			}
		else if (document.envio.opt_fichas[i].value==1)	
		  {			  	
			if((document.getElementById("forma1").checked))
			  {
				document.envio.action="funciones/consulta_numero_2.php?nro="+num+"&tipo=01&edit=1&pdf=1";
			  }
			else if((document.getElementById("forma2").checked))
			  {
				document.envio.action="funciones/consulta_ref_2.php?nro="+ref+"&tipo=01&edit=1&pdf=1";
			  }

			else if((document.getElementById("forma3").checked))
			  {
				document.envio.action="funciones/consulta_cuc_2.php?nro="+cuc+"&tipo=01&edit=1&pdf=1";
			  }
			else if((document.getElementById("forma4").checked))
			  {
				document.envio.action="funciones/consulta_estafi.php?nro="+estafi+"&tipo=01&edit=1&pdf=1";
			  }
			else if((document.getElementById("forma5").checked))
			  {
				document.envio.action="funciones/consulta_tipvia.php?nro="+tipvia+"&tipo=01&edit=1&pdf=1";
			  }
			else if((document.getElementById("forma6").checked))
			  {
				document.envio.action="funciones/consulta_tipopu.php?nro="+tipopu+"&tipo=01&edit=1&pdf=1";
			  }
			else if((document.getElementById("forma7").checked))
			  {
				document.envio.action="funciones/consulta_tiphu.php?nro="+tiphu+"&tipo=01&edit=1&pdf=1";
			  } 
			else if((document.getElementById("forma8").checked))
			  {
				document.envio.action="funciones/consulta_claspr.php?nro="+claspr+"&tipo=01&edit=1&pdf=1";
			  }
			else if((document.getElementById("forma9").checked))
			  {
				document.envio.action="funciones/consulta_predca.php?nro="+predca+"&tipo=01&edit=1&pdf=1";
			  }			  
			else if((document.getElementById("forma10").checked))
			  {
				document.envio.action="funciones/consulta_tipotitu.php?nro="+tipoti+"&tipo=01&edit=1&pdf=1";
			  }  
			else if((document.getElementById("forma11").checked))
			  {
				document.envio.action="funciones/consulta_condtitu.php?nro="+condti+"&tipo=01&edit=1&pdf=1";
			  }
			  else if((document.getElementById("forma12").checked))
			  {
				document.envio.action="funciones/consulta_sector.php?nro="+sec+"&tipo=01&edit=1&pdf=1";
			  }
		  }
		else if(document.envio.opt_fichas[i].value==2) 
		  {	
			if((document.getElementById("forma1").checked))
			  {
				document.envio.action="funciones/consulta_numero_2.php?nro="+num+"&tipo=02&edit=1&pdf=1";
			  }
			else if((document.getElementById("forma2").checked))
			  {
				document.envio.action="funciones/consulta_ref_2.php?nro="+ref+"&tipo=02&edit=1&pdf=1";
			  }
			else if((document.getElementById("forma3").checked))
			  {
				document.envio.action="funciones/consulta_cuc_2.php?nro="+cuc+"&tipo=02&edit=1&pdf=1";
			  }
			else if((document.getElementById("forma4").checked))
			  {
				document.envio.action="funciones/consulta_estafi.php?nro="+estafi+"&tipo=02&edit=1&pdf=1";
			  } 
			else if((document.getElementById("forma5").checked))
			  {
				document.envio.action="funciones/consulta_tipvia.php?nro="+tipvia+"&tipo=02&edit=1&pdf=1";
			  }  
			else if((document.getElementById("forma7").checked))
			  {
				document.envio.action="funciones/consulta_tiphu.php?nro="+tiphu+"&tipo=02&edit=1&pdf=1";
			  }  
			else if((document.getElementById("forma12").checked))
			  {
				document.envio.action="funciones/consulta_sector.php?nro="+sec+"&tipo=02&edit=1&pdf=1";
			  }   
		  }
		else if(document.envio.opt_fichas[i].value==3) 
		  {	
			if((document.getElementById("forma1").checked))
			  {
				document.envio.action="funciones/consulta_numero_econo.php?nro="+num+"&tipo=03&edit=1&pdf=1";
			  }
			else if((document.getElementById("forma2").checked))
			  {
				document.envio.action="funciones/consulta_ref_econo.php?nro="+ref+"&tipo=03&edit=1&pdf=1";
			  }
			else if((document.getElementById("forma3").checked))
			  {
				document.envio.action="funciones/consulta_cuc_econo.php?nro="+cuc+"&tipo=03&edit=1&pdf=1";
			  }
			else if((document.getElementById("forma4").checked))
			  {
				document.envio.action="funciones/consulta_estafi.php?nro="+estafi+"&tipo=03&edit=1&pdf=1";
			  }  
			else if((document.getElementById("forma5").checked))
			  {
				document.envio.action="funciones/consulta_tipvia.php?nro="+tipvia+"&tipo=03&edit=1&pdf=1";
			  }
			  else if((document.getElementById("forma7").checked))
			  {
				document.envio.action="funciones/consulta_tiphu.php?nro="+tiphu+"&tipo=03&edit=1&pdf=1";
			  }  
			 else if((document.getElementById("forma12").checked))
			  {
				document.envio.action="funciones/consulta_sector.php?nro="+sec+"&tipo=03&edit=1&pdf=1";
			  }   
		  }
		else if(document.envio.opt_fichas[i].value==4) 
		  {		  	
			if((document.getElementById("forma1").checked))
			  {
				document.envio.action="funciones/consulta_numero_2.php?nro="+num+"&tipo=04&edit=1&pdf=1";
			  }
			else if((document.getElementById("forma2").checked))
			  {
				document.envio.action="funciones/consulta_ref_2.php?nro="+ref+"&tipo=04&edit=1&pdf=1";
			  }
			else if((document.getElementById("forma3").checked))
			  {
				document.envio.action="funciones/consulta_cuc_2.php?nro="+cuc+"&tipo=04&edit=1&pdf=1";
			  }
			else if((document.getElementById("forma4").checked))
			  {
				document.envio.action="funciones/consulta_estafi.php?nro="+estafi+"&tipo=04&edit=1&pdf=1";
			  } 
			else if((document.getElementById("forma5").checked))
			  {
				document.envio.action="funciones/consulta_tipvia.php?nro="+tipvia+"&tipo=04&edit=1&pdf=1";
			  }  
			else if((document.getElementById("forma6").checked))
			  {
				document.envio.action="funciones/consulta_tipopu.php?nro="+tipopu+"&tipo=04&edit=1&pdf=1";
			  }  
			else if((document.getElementById("forma7").checked))
			  {
				document.envio.action="funciones/consulta_tiphu.php?nro="+tiphu+"&tipo=04&edit=1&pdf=1";
			  }  
			else if((document.getElementById("forma8").checked))
			  {
				document.envio.action="funciones/consulta_claspr.php?nro="+claspr+"&tipo=04&edit=1&pdf=1";
			  }
			else if((document.getElementById("forma9").checked))
			  {
				document.envio.action="funciones/consulta_predca.php?nro="+predca+"&tipo=04&edit=1&pdf=1";
			  } 
			 else if((document.getElementById("forma12").checked))
			  {
				document.envio.action="funciones/consulta_sector.php?nro="+sec+"&tipo=04&edit=1&pdf=1";
			  }   
		  }
	}

//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ BLOQUEOS DE CHECK $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
function bloqueos(e)
	{
   		if(e.name=="forma1")
   		  { 
	   		document.getElementById("forma2").disabled=!document.getElementById("forma2").disabled
			document.getElementById("forma3").disabled=!document.getElementById("forma3").disabled			
			document.getElementById("forma4").disabled=!document.getElementById("forma4").disabled
			document.getElementById("forma5").disabled=!document.getElementById("forma5").disabled
			document.getElementById("forma6").disabled=!document.getElementById("forma6").disabled
			document.getElementById("forma7").disabled=!document.getElementById("forma7").disabled
			document.getElementById("forma8").disabled=!document.getElementById("forma8").disabled
			document.getElementById("forma9").disabled=!document.getElementById("forma9").disabled
			document.getElementById("forma10").disabled=!document.getElementById("forma10").disabled
			document.getElementById("forma11").disabled=!document.getElementById("forma11").disabled
			document.getElementById("forma12").disabled=!document.getElementById("forma12").disabled
			
			document.getElementById("referencia").value='';
			document.getElementById("cuc8").value='';
			document.getElementById("cuc4").value='';
			
			document.getElementById("referencia").disabled=!document.getElementById("referencia").disabled
			document.getElementById("cuc8").disabled=!document.getElementById("cuc8").disabled
			document.getElementById("cuc4").disabled=!document.getElementById("cuc4").disabled
			document.getElementById("ic_cmb_estficha").disabled=!document.getElementById("ic_cmb_estficha").disabled
			document.getElementById("upc_pue-0").disabled=!document.getElementById("upc_pue-0").disabled
			document.getElementById("dp_cmb_precat").disabled=!document.getElementById("dp_cmb_precat").disabled
			document.getElementById("itc_cmb_tipotitu").disabled=!document.getElementById("itc_cmb_tipotitu").disabled
			document.getElementById("ct_cmb_condtitu").disabled=!document.getElementById("ct_cmb_condtitu").disabled
			document.getElementById("dp_cmb_claspre").disabled=!document.getElementById("dp_cmb_claspre").disabled
			document.getElementById("dftc_cmb_tipovia").disabled=!document.getElementById("dftc_cmb_tipovia").disabled
			document.getElementById("dftc_cmb_tipohab").disabled=!document.getElementById("dftc_cmb_tipohab").disabled
			document.getElementById("sector").disabled=!document.getElementById("sector").disabled
			
			
			document.getElementById("numero").focus();
   		  }
   		if(e.name=="forma2")
   		 {  	 
	   		document.getElementById("numero").value='';
			document.getElementById("cuc8").value='';
			document.getElementById("cuc4").value='';
			
			document.getElementById("forma1").disabled=!document.getElementById("forma1").disabled
			document.getElementById("forma3").disabled=!document.getElementById("forma3").disabled
			document.getElementById("forma4").disabled=!document.getElementById("forma4").disabled
			document.getElementById("forma5").disabled=!document.getElementById("forma5").disabled
			document.getElementById("forma6").disabled=!document.getElementById("forma6").disabled
			document.getElementById("forma7").disabled=!document.getElementById("forma7").disabled
			document.getElementById("forma8").disabled=!document.getElementById("forma8").disabled
			document.getElementById("forma9").disabled=!document.getElementById("forma9").disabled
			document.getElementById("forma10").disabled=!document.getElementById("forma10").disabled
			document.getElementById("forma11").disabled=!document.getElementById("forma11").disabled
			document.getElementById("forma12").disabled=!document.getElementById("forma12").disabled

			document.getElementById("numero").disabled=!document.getElementById("numero").disabled
			document.getElementById("cuc8").disabled=!document.getElementById("cuc8").disabled
			document.getElementById("cuc4").disabled=!document.getElementById("cuc4").disabled
			document.getElementById("ic_cmb_estficha").disabled=!document.getElementById("ic_cmb_estficha").disabled
			document.getElementById("upc_pue-0").disabled=!document.getElementById("upc_pue-0").disabled
			document.getElementById("dp_cmb_precat").disabled=!document.getElementById("dp_cmb_precat").disabled
			document.getElementById("itc_cmb_tipotitu").disabled=!document.getElementById("itc_cmb_tipotitu").disabled
			document.getElementById("ct_cmb_condtitu").disabled=!document.getElementById("ct_cmb_condtitu").disabled
			document.getElementById("dp_cmb_claspre").disabled=!document.getElementById("dp_cmb_claspre").disabled
			document.getElementById("dftc_cmb_tipovia").disabled=!document.getElementById("dftc_cmb_tipovia").disabled
			document.getElementById("dftc_cmb_tipohab").disabled=!document.getElementById("dftc_cmb_tipohab").disabled
			document.getElementById("sector").disabled=!document.getElementById("sector").disabled
			
			document.getElementById("referencia").focus();
   		 }
	   if(e.name=="forma3")
	   	 {  	 
			document.getElementById("numero").value='';
			document.getElementById("referencia").value='';
			
			document.getElementById("forma1").disabled=!document.getElementById("forma1").disabled
			document.getElementById("forma2").disabled=!document.getElementById("forma2").disabled
			document.getElementById("forma4").disabled=!document.getElementById("forma4").disabled
			document.getElementById("forma5").disabled=!document.getElementById("forma5").disabled
			document.getElementById("forma6").disabled=!document.getElementById("forma6").disabled
			document.getElementById("forma7").disabled=!document.getElementById("forma7").disabled
			document.getElementById("forma8").disabled=!document.getElementById("forma8").disabled
			document.getElementById("forma9").disabled=!document.getElementById("forma9").disabled
			document.getElementById("forma10").disabled=!document.getElementById("forma10").disabled
			document.getElementById("forma11").disabled=!document.getElementById("forma11").disabled
			document.getElementById("forma12").disabled=!document.getElementById("forma12").disabled

			document.getElementById("numero").disabled=!document.getElementById("numero").disabled
			document.getElementById("referencia").disabled=!document.getElementById("referencia").disabled
			document.getElementById("ic_cmb_estficha").disabled=!document.getElementById("ic_cmb_estficha").disabled
			document.getElementById("upc_pue-0").disabled=!document.getElementById("upc_pue-0").disabled
			document.getElementById("dp_cmb_precat").disabled=!document.getElementById("dp_cmb_precat").disabled
			document.getElementById("itc_cmb_tipotitu").disabled=!document.getElementById("itc_cmb_tipotitu").disabled
			document.getElementById("ct_cmb_condtitu").disabled=!document.getElementById("ct_cmb_condtitu").disabled
			document.getElementById("dp_cmb_claspre").disabled=!document.getElementById("dp_cmb_claspre").disabled
			document.getElementById("dftc_cmb_tipovia").disabled=!document.getElementById("dftc_cmb_tipovia").disabled
			document.getElementById("dftc_cmb_tipohab").disabled=!document.getElementById("dftc_cmb_tipohab").disabled
			document.getElementById("sector").disabled=!document.getElementById("sector").disabled
			
			document.getElementById("cuc8").focus();
	     }
	    if(e.name=="forma4")
	   	 {  	 
			document.getElementById("numero").value='';
			document.getElementById("referencia").value='';
			document.getElementById("cuc8").value='';
			document.getElementById("cuc4").value='';

			document.getElementById("forma1").disabled=!document.getElementById("forma1").disabled
			document.getElementById("forma2").disabled=!document.getElementById("forma2").disabled
			document.getElementById("forma3").disabled=!document.getElementById("forma3").disabled
			document.getElementById("forma5").disabled=!document.getElementById("forma5").disabled
			document.getElementById("forma6").disabled=!document.getElementById("forma6").disabled
			document.getElementById("forma7").disabled=!document.getElementById("forma7").disabled
			document.getElementById("forma8").disabled=!document.getElementById("forma8").disabled
			document.getElementById("forma9").disabled=!document.getElementById("forma9").disabled
			document.getElementById("forma10").disabled=!document.getElementById("forma10").disabled
			document.getElementById("forma11").disabled=!document.getElementById("forma11").disabled
			document.getElementById("forma12").disabled=!document.getElementById("forma12").disabled

			document.getElementById("numero").disabled=!document.getElementById("numero").disabled
			document.getElementById("referencia").disabled=!document.getElementById("referencia").disabled	
			document.getElementById("cuc8").disabled=!document.getElementById("cuc8").disabled
			document.getElementById("cuc4").disabled=!document.getElementById("cuc4").disabled					
			document.getElementById("upc_pue-0").disabled=!document.getElementById("upc_pue-0").disabled
			document.getElementById("dp_cmb_precat").disabled=!document.getElementById("dp_cmb_precat").disabled
			document.getElementById("itc_cmb_tipotitu").disabled=!document.getElementById("itc_cmb_tipotitu").disabled
			document.getElementById("ct_cmb_condtitu").disabled=!document.getElementById("ct_cmb_condtitu").disabled
			document.getElementById("dp_cmb_claspre").disabled=!document.getElementById("dp_cmb_claspre").disabled
			document.getElementById("dftc_cmb_tipovia").disabled=!document.getElementById("dftc_cmb_tipovia").disabled
			document.getElementById("dftc_cmb_tipohab").disabled=!document.getElementById("dftc_cmb_tipohab").disabled
			document.getElementById("sector").disabled=!document.getElementById("sector").disabled
			
			document.getElementById("ic_cmb_estficha").focus();
	     }
	     if(e.name=="forma5")
	   	 {  	 
			document.getElementById("numero").value='';
			document.getElementById("referencia").value='';
			document.getElementById("cuc8").value='';
			document.getElementById("cuc4").value='';

			document.getElementById("forma1").disabled=!document.getElementById("forma1").disabled
			document.getElementById("forma2").disabled=!document.getElementById("forma2").disabled
			document.getElementById("forma3").disabled=!document.getElementById("forma3").disabled
			document.getElementById("forma4").disabled=!document.getElementById("forma4").disabled
			document.getElementById("forma6").disabled=!document.getElementById("forma6").disabled
			document.getElementById("forma7").disabled=!document.getElementById("forma7").disabled
			document.getElementById("forma8").disabled=!document.getElementById("forma8").disabled
			document.getElementById("forma9").disabled=!document.getElementById("forma9").disabled
			document.getElementById("forma10").disabled=!document.getElementById("forma10").disabled
			document.getElementById("forma11").disabled=!document.getElementById("forma11").disabled
			document.getElementById("forma12").disabled=!document.getElementById("forma12").disabled

			document.getElementById("numero").disabled=!document.getElementById("numero").disabled
			document.getElementById("referencia").disabled=!document.getElementById("referencia").disabled	
			document.getElementById("cuc8").disabled=!document.getElementById("cuc8").disabled
			document.getElementById("cuc4").disabled=!document.getElementById("cuc4").disabled					
			document.getElementById("ic_cmb_estficha").disabled=!document.getElementById("ic_cmb_estficha").disabled
			document.getElementById("dp_cmb_precat").disabled=!document.getElementById("dp_cmb_precat").disabled
			document.getElementById("itc_cmb_tipotitu").disabled=!document.getElementById("itc_cmb_tipotitu").disabled
			document.getElementById("ct_cmb_condtitu").disabled=!document.getElementById("ct_cmb_condtitu").disabled
			document.getElementById("dp_cmb_claspre").disabled=!document.getElementById("dp_cmb_claspre").disabled
			document.getElementById("upc_pue-0").disabled=!document.getElementById("upc_pue-0").disabled
			document.getElementById("dftc_cmb_tipohab").disabled=!document.getElementById("dftc_cmb_tipohab").disabled
			document.getElementById("sector").disabled=!document.getElementById("sector").disabled
			
			document.getElementById("dftc_cmb_tipovia").focus();
	     }
	     if(e.name=="forma6")
	   	 {  	 
			document.getElementById("numero").value='';
			document.getElementById("referencia").value='';
			document.getElementById("cuc8").value='';
			document.getElementById("cuc4").value='';

			document.getElementById("forma1").disabled=!document.getElementById("forma1").disabled
			document.getElementById("forma2").disabled=!document.getElementById("forma2").disabled
			document.getElementById("forma3").disabled=!document.getElementById("forma3").disabled
			document.getElementById("forma4").disabled=!document.getElementById("forma4").disabled
			document.getElementById("forma5").disabled=!document.getElementById("forma5").disabled
			document.getElementById("forma7").disabled=!document.getElementById("forma7").disabled
			document.getElementById("forma8").disabled=!document.getElementById("forma8").disabled
			document.getElementById("forma9").disabled=!document.getElementById("forma9").disabled
			document.getElementById("forma10").disabled=!document.getElementById("forma10").disabled
			document.getElementById("forma11").disabled=!document.getElementById("forma11").disabled
			document.getElementById("forma12").disabled=!document.getElementById("forma12").disabled

			document.getElementById("numero").disabled=!document.getElementById("numero").disabled
			document.getElementById("referencia").disabled=!document.getElementById("referencia").disabled	
			document.getElementById("cuc8").disabled=!document.getElementById("cuc8").disabled
			document.getElementById("cuc4").disabled=!document.getElementById("cuc4").disabled					
			document.getElementById("ic_cmb_estficha").disabled=!document.getElementById("ic_cmb_estficha").disabled
			document.getElementById("dp_cmb_precat").disabled=!document.getElementById("dp_cmb_precat").disabled
			document.getElementById("itc_cmb_tipotitu").disabled=!document.getElementById("itc_cmb_tipotitu").disabled
			document.getElementById("ct_cmb_condtitu").disabled=!document.getElementById("ct_cmb_condtitu").disabled
			document.getElementById("dp_cmb_claspre").disabled=!document.getElementById("dp_cmb_claspre").disabled
			document.getElementById("dftc_cmb_tipovia").disabled=!document.getElementById("dftc_cmb_tipovia").disabled
			document.getElementById("dftc_cmb_tipohab").disabled=!document.getElementById("dftc_cmb_tipohab").disabled
			document.getElementById("sector").disabled=!document.getElementById("sector").disabled
			document.getElementById("opt_fichas_1").disabled=!document.getElementById("opt_fichas_1").disabled
			document.getElementById("opt_fichas_3").disabled=!document.getElementById("opt_fichas_3").disabled

			document.getElementById("upc_pue-0").focus();
	     }
	     if(e.name=="forma7")
	   	 {  	 
			document.getElementById("numero").value='';
			document.getElementById("referencia").value='';
			document.getElementById("cuc8").value='';
			document.getElementById("cuc4").value='';

			document.getElementById("forma1").disabled=!document.getElementById("forma1").disabled
			document.getElementById("forma2").disabled=!document.getElementById("forma2").disabled
			document.getElementById("forma3").disabled=!document.getElementById("forma3").disabled
			document.getElementById("forma4").disabled=!document.getElementById("forma4").disabled
			document.getElementById("forma5").disabled=!document.getElementById("forma5").disabled
			document.getElementById("forma6").disabled=!document.getElementById("forma6").disabled
			document.getElementById("forma8").disabled=!document.getElementById("forma8").disabled
			document.getElementById("forma9").disabled=!document.getElementById("forma9").disabled
			document.getElementById("forma10").disabled=!document.getElementById("forma10").disabled
			document.getElementById("forma11").disabled=!document.getElementById("forma11").disabled
			document.getElementById("forma12").disabled=!document.getElementById("forma12").disabled

			document.getElementById("numero").disabled=!document.getElementById("numero").disabled
			document.getElementById("referencia").disabled=!document.getElementById("referencia").disabled	
			document.getElementById("cuc8").disabled=!document.getElementById("cuc8").disabled
			document.getElementById("cuc4").disabled=!document.getElementById("cuc4").disabled					
			document.getElementById("ic_cmb_estficha").disabled=!document.getElementById("ic_cmb_estficha").disabled
			document.getElementById("dp_cmb_precat").disabled=!document.getElementById("dp_cmb_precat").disabled
			document.getElementById("itc_cmb_tipotitu").disabled=!document.getElementById("itc_cmb_tipotitu").disabled
			document.getElementById("ct_cmb_condtitu").disabled=!document.getElementById("ct_cmb_condtitu").disabled
			document.getElementById("dp_cmb_claspre").disabled=!document.getElementById("dp_cmb_claspre").disabled
			document.getElementById("upc_pue-0").disabled=!document.getElementById("upc_pue-0").disabled
			document.getElementById("dftc_cmb_tipovia").disabled=!document.getElementById("dftc_cmb_tipovia").disabled
			document.getElementById("sector").disabled=!document.getElementById("sector").disabled
			
			document.getElementById("dftc_cmb_tipohab").focus();
	     }
	     if(e.name=="forma8")
	   	 {  	 
			document.getElementById("numero").value='';
			document.getElementById("referencia").value='';
			document.getElementById("cuc8").value='';
			document.getElementById("cuc4").value='';

			document.getElementById("forma1").disabled=!document.getElementById("forma1").disabled
			document.getElementById("forma2").disabled=!document.getElementById("forma2").disabled
			document.getElementById("forma3").disabled=!document.getElementById("forma3").disabled
			document.getElementById("forma4").disabled=!document.getElementById("forma4").disabled
			document.getElementById("forma5").disabled=!document.getElementById("forma5").disabled
			document.getElementById("forma6").disabled=!document.getElementById("forma6").disabled
			document.getElementById("forma7").disabled=!document.getElementById("forma7").disabled
			document.getElementById("forma9").disabled=!document.getElementById("forma9").disabled
			document.getElementById("forma10").disabled=!document.getElementById("forma10").disabled
			document.getElementById("forma11").disabled=!document.getElementById("forma11").disabled
			document.getElementById("forma12").disabled=!document.getElementById("forma12").disabled
			
			document.getElementById("numero").disabled=!document.getElementById("numero").disabled
			document.getElementById("referencia").disabled=!document.getElementById("referencia").disabled	
			document.getElementById("cuc8").disabled=!document.getElementById("cuc8").disabled
			document.getElementById("cuc4").disabled=!document.getElementById("cuc4").disabled					
			document.getElementById("ic_cmb_estficha").disabled=!document.getElementById("ic_cmb_estficha").disabled
			document.getElementById("dp_cmb_precat").disabled=!document.getElementById("dp_cmb_precat").disabled
			document.getElementById("itc_cmb_tipotitu").disabled=!document.getElementById("itc_cmb_tipotitu").disabled
			document.getElementById("ct_cmb_condtitu").disabled=!document.getElementById("ct_cmb_condtitu").disabled
			document.getElementById("upc_pue-0").disabled=!document.getElementById("upc_pue-0").disabled
			document.getElementById("dftc_cmb_tipovia").disabled=!document.getElementById("dftc_cmb_tipovia").disabled
			document.getElementById("dftc_cmb_tipohab").disabled=!document.getElementById("dftc_cmb_tipohab").disabled
			document.getElementById("sector").disabled=!document.getElementById("sector").disabled
			document.getElementById("opt_fichas_1").disabled=!document.getElementById("opt_fichas_1").disabled
			document.getElementById("opt_fichas_3").disabled=!document.getElementById("opt_fichas_3").disabled

			document.getElementById("dp_cmb_claspre").focus();
	     }
	     if(e.name=="forma9")
	   	 {  	 
			document.getElementById("numero").value='';
			document.getElementById("referencia").value='';
			document.getElementById("cuc8").value='';
			document.getElementById("cuc4").value='';

			document.getElementById("forma1").disabled=!document.getElementById("forma1").disabled
			document.getElementById("forma2").disabled=!document.getElementById("forma2").disabled
			document.getElementById("forma3").disabled=!document.getElementById("forma3").disabled
			document.getElementById("forma4").disabled=!document.getElementById("forma4").disabled
			document.getElementById("forma5").disabled=!document.getElementById("forma5").disabled
			document.getElementById("forma6").disabled=!document.getElementById("forma6").disabled
			document.getElementById("forma7").disabled=!document.getElementById("forma7").disabled
			document.getElementById("forma8").disabled=!document.getElementById("forma8").disabled
			document.getElementById("forma10").disabled=!document.getElementById("forma10").disabled
			document.getElementById("forma11").disabled=!document.getElementById("forma11").disabled
			document.getElementById("forma12").disabled=!document.getElementById("forma12").disabled
			
			document.getElementById("numero").disabled=!document.getElementById("numero").disabled
			document.getElementById("referencia").disabled=!document.getElementById("referencia").disabled	
			document.getElementById("cuc8").disabled=!document.getElementById("cuc8").disabled
			document.getElementById("cuc4").disabled=!document.getElementById("cuc4").disabled					
			document.getElementById("ic_cmb_estficha").disabled=!document.getElementById("ic_cmb_estficha").disabled
			document.getElementById("dp_cmb_claspre").disabled=!document.getElementById("dp_cmb_claspre").disabled
			document.getElementById("itc_cmb_tipotitu").disabled=!document.getElementById("itc_cmb_tipotitu").disabled
			document.getElementById("ct_cmb_condtitu").disabled=!document.getElementById("ct_cmb_condtitu").disabled
			document.getElementById("upc_pue-0").disabled=!document.getElementById("upc_pue-0").disabled
			document.getElementById("dftc_cmb_tipovia").disabled=!document.getElementById("dftc_cmb_tipovia").disabled
			document.getElementById("dftc_cmb_tipohab").disabled=!document.getElementById("dftc_cmb_tipohab").disabled
			document.getElementById("sector").disabled=!document.getElementById("sector").disabled
			document.getElementById("opt_fichas_1").disabled=!document.getElementById("opt_fichas_1").disabled
			document.getElementById("opt_fichas_3").disabled=!document.getElementById("opt_fichas_3").disabled

			document.getElementById("dp_cmb_precat").focus();
	     }
	     if(e.name=="forma10")
	   	 {  	 
			document.getElementById("numero").value='';
			document.getElementById("referencia").value='';
			document.getElementById("cuc8").value='';
			document.getElementById("cuc4").value='';

			document.getElementById("forma1").disabled=!document.getElementById("forma1").disabled
			document.getElementById("forma2").disabled=!document.getElementById("forma2").disabled
			document.getElementById("forma3").disabled=!document.getElementById("forma3").disabled
			document.getElementById("forma4").disabled=!document.getElementById("forma4").disabled
			document.getElementById("forma5").disabled=!document.getElementById("forma5").disabled
			document.getElementById("forma6").disabled=!document.getElementById("forma6").disabled
			document.getElementById("forma7").disabled=!document.getElementById("forma7").disabled
			document.getElementById("forma8").disabled=!document.getElementById("forma8").disabled
			document.getElementById("forma9").disabled=!document.getElementById("forma9").disabled
			document.getElementById("forma11").disabled=!document.getElementById("forma11").disabled
			document.getElementById("forma12").disabled=!document.getElementById("forma12").disabled
			
			document.getElementById("numero").disabled=!document.getElementById("numero").disabled
			document.getElementById("referencia").disabled=!document.getElementById("referencia").disabled	
			document.getElementById("cuc8").disabled=!document.getElementById("cuc8").disabled
			document.getElementById("cuc4").disabled=!document.getElementById("cuc4").disabled					
			document.getElementById("ic_cmb_estficha").disabled=!document.getElementById("ic_cmb_estficha").disabled
			document.getElementById("dp_cmb_claspre").disabled=!document.getElementById("dp_cmb_claspre").disabled
			document.getElementById("dp_cmb_precat").disabled=!document.getElementById("dp_cmb_precat").disabled
			document.getElementById("ct_cmb_condtitu").disabled=!document.getElementById("ct_cmb_condtitu").disabled
			document.getElementById("upc_pue-0").disabled=!document.getElementById("upc_pue-0").disabled
			document.getElementById("dftc_cmb_tipovia").disabled=!document.getElementById("dftc_cmb_tipovia").disabled
			document.getElementById("dftc_cmb_tipohab").disabled=!document.getElementById("dftc_cmb_tipohab").disabled
			document.getElementById("sector").disabled=!document.getElementById("sector").disabled
			document.getElementById("opt_fichas_3").disabled=!document.getElementById("opt_fichas_3").disabled
			document.getElementById("opt_fichas_4").disabled=!document.getElementById("opt_fichas_4").disabled

			document.getElementById("itc_cmb_tipotitu").focus();
	     }
	     if(e.name=="forma11")
	   	 {  	 
			document.getElementById("numero").value='';
			document.getElementById("referencia").value='';
			document.getElementById("cuc8").value='';
			document.getElementById("cuc4").value='';

			document.getElementById("forma1").disabled=!document.getElementById("forma1").disabled
			document.getElementById("forma2").disabled=!document.getElementById("forma2").disabled
			document.getElementById("forma3").disabled=!document.getElementById("forma3").disabled
			document.getElementById("forma4").disabled=!document.getElementById("forma4").disabled
			document.getElementById("forma5").disabled=!document.getElementById("forma5").disabled
			document.getElementById("forma6").disabled=!document.getElementById("forma6").disabled
			document.getElementById("forma7").disabled=!document.getElementById("forma7").disabled
			document.getElementById("forma8").disabled=!document.getElementById("forma8").disabled
			document.getElementById("forma9").disabled=!document.getElementById("forma9").disabled
			document.getElementById("forma10").disabled=!document.getElementById("forma10").disabled
			document.getElementById("forma12").disabled=!document.getElementById("forma12").disabled
			
			document.getElementById("numero").disabled=!document.getElementById("numero").disabled
			document.getElementById("referencia").disabled=!document.getElementById("referencia").disabled	
			document.getElementById("cuc8").disabled=!document.getElementById("cuc8").disabled
			document.getElementById("cuc4").disabled=!document.getElementById("cuc4").disabled					
			document.getElementById("ic_cmb_estficha").disabled=!document.getElementById("ic_cmb_estficha").disabled
			document.getElementById("dp_cmb_claspre").disabled=!document.getElementById("dp_cmb_claspre").disabled
			document.getElementById("dp_cmb_precat").disabled=!document.getElementById("dp_cmb_precat").disabled
			document.getElementById("itc_cmb_tipotitu").disabled=!document.getElementById("itc_cmb_tipotitu").disabled
			document.getElementById("upc_pue-0").disabled=!document.getElementById("upc_pue-0").disabled
			document.getElementById("dftc_cmb_tipovia").disabled=!document.getElementById("dftc_cmb_tipovia").disabled
			document.getElementById("dftc_cmb_tipohab").disabled=!document.getElementById("dftc_cmb_tipohab").disabled
			document.getElementById("sector").disabled=!document.getElementById("sector").disabled
			document.getElementById("opt_fichas_3").disabled=!document.getElementById("opt_fichas_3").disabled
			document.getElementById("opt_fichas_4").disabled=!document.getElementById("opt_fichas_4").disabled

			document.getElementById("ct_cmb_condtitu").focus();
	     }
	     if(e.name=="forma12")
	   	 {  	 
			document.getElementById("numero").value='';
			document.getElementById("referencia").value='';
			document.getElementById("cuc8").value='';
			document.getElementById("cuc4").value='';

			document.getElementById("forma1").disabled=!document.getElementById("forma1").disabled
			document.getElementById("forma2").disabled=!document.getElementById("forma2").disabled
			document.getElementById("forma3").disabled=!document.getElementById("forma3").disabled
			document.getElementById("forma4").disabled=!document.getElementById("forma4").disabled
			document.getElementById("forma5").disabled=!document.getElementById("forma5").disabled
			document.getElementById("forma6").disabled=!document.getElementById("forma6").disabled
			document.getElementById("forma7").disabled=!document.getElementById("forma7").disabled
			document.getElementById("forma8").disabled=!document.getElementById("forma8").disabled
			document.getElementById("forma9").disabled=!document.getElementById("forma9").disabled
			document.getElementById("forma10").disabled=!document.getElementById("forma10").disabled
			document.getElementById("forma11").disabled=!document.getElementById("forma11").disabled
			
			document.getElementById("numero").disabled=!document.getElementById("numero").disabled
			document.getElementById("referencia").disabled=!document.getElementById("referencia").disabled	
			document.getElementById("cuc8").disabled=!document.getElementById("cuc8").disabled
			document.getElementById("cuc4").disabled=!document.getElementById("cuc4").disabled					
			document.getElementById("ic_cmb_estficha").disabled=!document.getElementById("ic_cmb_estficha").disabled
			document.getElementById("dp_cmb_claspre").disabled=!document.getElementById("dp_cmb_claspre").disabled
			document.getElementById("dp_cmb_precat").disabled=!document.getElementById("dp_cmb_precat").disabled
			document.getElementById("itc_cmb_tipotitu").disabled=!document.getElementById("itc_cmb_tipotitu").disabled
			document.getElementById("upc_pue-0").disabled=!document.getElementById("upc_pue-0").disabled
			document.getElementById("dftc_cmb_tipovia").disabled=!document.getElementById("dftc_cmb_tipovia").disabled
			document.getElementById("dftc_cmb_tipohab").disabled=!document.getElementById("dftc_cmb_tipohab").disabled
			document.getElementById("ct_cmb_condtitu").disabled=!document.getElementById("ct_cmb_condtitu").disabled
			
			document.getElementById("sector").focus();
	     }
	}
		///////////////////////////////////////////////

	function ponerCeros(obj) 
	  {
	  	if (obj.value.length>0)
	  	 {
	  		while (obj.value.length<7)
	    	obj.value = '0'+obj.value;
		 }
	  }

	///////////////////////////////////////////////


function cambiar(pestannas,pestanna) {
    
    // Obtiene los elementos con los identificadores pasados.
    pestanna = document.getElementById(pestanna.id);
    listaPestannas = document.getElementById(pestannas.id);
    
    // Obtiene las divisiones que tienen el contenido de las pestañas.
    cpestanna = document.getElementById('c'+pestanna.id);
    listacPestannas = document.getElementById('contenido'+pestannas.id);
    
    i=0;
    // Recorre la lista ocultando todas las pestañas y restaurando el fondo 
    // y el padding de las pestañas.
    while (typeof listacPestannas.getElementsByTagName('div')[i] != 'undefined'){
        $(document).ready(function(){
            $(listacPestannas.getElementsByTagName('div')[i]).css('display','none');
            $(listaPestannas.getElementsByTagName('li')[i]).css('background','');
            $(listaPestannas.getElementsByTagName('li')[i]).css('padding-bottom','');
        });
        i += 1;
    }
 
    $(document).ready(function(){
        // Muestra el contenido de la pestaña pasada como parametro a la funcion,
        // cambia el color de la pestaña y aumenta el padding para que tape el  
        // borde superior del contenido que esta juesto debajo y se vea de este 
        // modo que esta seleccionada.
        $(cpestanna).css('display','');
        $(pestanna).css('background','dimgray');
        $(pestanna).css('padding-bottom','2px'); 
    });
 
}
