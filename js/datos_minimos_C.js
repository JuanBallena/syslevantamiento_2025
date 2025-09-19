//---------------------------------------------------------- DATOS MINIMOS COTITULAR ------------------------------
function datos_minimos_cotitular()
	{			
		
		//Identificamos los campos minimos a grabar
		var pr_1=document.getElementById("numficha");
		
		var dg_1=document.getElementById("dg_sector");
		var dg_2=document.getElementById("dg_manzana");
		var dg_3=document.getElementById("dg_lote");
		var dg_4=document.getElementById("dg_edificacion");
		var dg_5=document.getElementById("dg_entrada");
		var dg_6=document.getElementById("dg_piso");
		var dg_7=document.getElementById("dg_unidad");
		var dg_8=document.getElementById("dg_dc");
		
		var ic_1=document.getElementById("ic_cmb_estficha");
		
		var f_1=document.getElementById("f_cmb_tec");
		var f_2=document.getElementById("f_fechatec");
		
		var total=parseInt(document.getElementById("total").value);
		//alert(total);
		var i;
		
		//array para titulares
		var itc_cmb_tipotitu = new Array(total);
		var dcc_porcentaje = new Array(total);
		var dg_codcontribuyente = new Array(total);
		var itc_cmb_tipodoc = new Array(total);
		var itc_numdoc = new Array(total);
		var itc_nombre = new Array(total);
		var itc_paterno = new Array(total);
		var itc_materno = new Array(total);
		var itc_ruc = new Array(total);
		var itc_razsocial = new Array(total);
		var ct_cmb_formadq = new Array(total);
		var ct_fechaadq = new Array(total);
		var departamentos = new Array(total);
		var provincias = new Array(total);
		var distritos = new Array(total);

		var porcentaje=0;
		
		for(i=0;i<total;i++)
		{
			itc_cmb_tipotitu[i]=document.getElementById("itc_cmb_tipotitu-"+i);
			dcc_porcentaje[i]=document.getElementById("dcc_porcentaje-"+i);
			dg_codcontribuyente[i]=document.getElementById("dg_codcontribuyente-"+i);
			itc_cmb_tipodoc[i]=document.getElementById("itc_cmb_tipodoc-"+i);
			itc_numdoc[i]=document.getElementById("itc_numdoc-"+i);
			itc_nombre[i]=document.getElementById("itc_nombre_"+i);
			itc_paterno[i]=document.getElementById("itc_paterno_"+i);
			itc_materno[i]=document.getElementById("itc_materno_"+i);
			itc_ruc[i]=document.getElementById("itc_ruc-"+i);
			itc_razsocial[i]=document.getElementById("itc_razsocial-"+i);
			ct_cmb_formadq[i]=document.getElementById("ct_cmb_formadq-"+i);
			ct_fechaadq[i]=document.getElementById("ct_fechaadq_"+i);
			
			if(!document.getElementById("departamento"+i))
			{
				departamentos[i]=document.getElementById("departamentos"+i);
				provincias[i]=document.getElementById("provincias"+i);
				distritos[i]=document.getElementById("distritos"+i);
			}
			else
			{
				departamentos[i]=document.getElementById("departamento"+i);
				provincias[i]=document.getElementById("provincia"+i);
				distritos[i]=document.getElementById("distrito"+i);
			}		
		}
		
	
	//**************************************************************************************
	var sw=0;
	//Datos Generales
	if(pr_1.value == '' || pr_1.value.length<7 || (pr_1.value) == 0)
			{alert('Ingrese Numero de Ficha! - 7 digitos diferentes de cero');			sw=1;	pr_1.focus();	return false;}
	if(dg_1.value == '' || dg_1.value.length<2 || (dg_1.value) == 0)
			{alert('Ingrese codigo de Sector! - 2 digitos diferentes de cero');		sw=1;	dg_1.focus();	return false;}
	if(dg_2.value == '' || dg_2.value.length<3 || (dg_2.value) == 0)
			{alert('Ingrese codigo de Manzana! - 3 digitos diferentes de cero'); 		sw=1;	dg_2.focus();	return false;}
	if(dg_3.value == '' || dg_3.value.length<3 || (dg_3.value) == 0)
			{alert('Ingrese codigo de Lote! - 3 digitos diferentes de cero');			sw=1;	dg_3.focus();	return false;}
	if(dg_4.value == '' || dg_4.value.length<2 || t(dg_4.value) == 0)
			{alert('Ingrese codigo de Edificacion! - 2 digitos diferentes de cero');	sw=1;	dg_4.focus();	return false;}
	if(dg_5.value == '' || dg_5.value.length<2 || (dg_5.value) == 0)
			{alert('Ingrese codigo de Entrada! - 2 digitos diferentes de cero');		sw=1;	dg_5.focus();	return false;}
	if(dg_6.value == '' || dg_6.value.length<2 || (dg_6.value) == 0)
			{alert('Ingrese codigo de Piso! - 2 digitos diferentes de cero');			sw=1;	dg_6.focus();	return false;}
	if(dg_7.value == '' || dg_7.value.length<3 || (dg_7.value) == 0)
			{alert('Ingrese codigo de Unidad! - 3 digitos diferentes de cero');		sw=1;	dg_7.focus();	return false;}
	if(dg_8.value == ''){	alert('Ingrese codigo DC!');		sw=1;	dg_8;	}

	//TITULARES
	for(i=0;i<total;i++)
		{	//alert("titular n° "+(i+1));
			//Identificacion del Titular Catastral
			
			//VALIDAMOS PORCENTAJES ---------------------------------------------------------
			if(allTrim(dcc_porcentaje[i].value) == ''){alert('Ingrese porcentaje del '+(i+1)+'° Titular!');	sw=1;	dcc_porcentaje[i].focus();	return false;	}
			else 
				{
					//Sumamos los porcentajes %	
					var flotante=parseFloat(dcc_porcentaje[i].value)
					
					porcentaje=parseFloat(porcentaje)+flotante;
					//alert(porcentaje);
					//si porcentaje es igual a 100
					if (parseFloat(porcentaje)==100) 
					{ 	//Número de Cotitular
						//alert(i+'-'+total);
						if(i==total-1)
							{ //llegó al final ES CORRECTO
								//alert("Porcentaje TOTAL: "+porcentaje);
							}
						else 
							{ //AUN NO LLEGA AL FINAL
								alert("el Porcentaje NO ESTÁ DISTRIBUIDO CORRECTAMENTE...Verifique!"); 
								sw=1;	dcc_porcentaje[0].focus();	dcc_porcentaje[0].select();return false; 
							}
						
								
					}//si es mayor
					else if (parseFloat(porcentaje)>100) 
						{	alert("el Porcentaje Total no puede execeder el 100%...Verifique!"); 
							sw=1;	dcc_porcentaje[0].focus();	dcc_porcentaje[i].select(); return false;}
					else if(i==total-1)
							{ //llegó al final PERO NO COMPLETA EL 100%
								alert("el Porcentaje Total no cumple el 100%...Verifique!"); 
								sw=1;	dcc_porcentaje[0].focus();	dcc_porcentaje[0].select();return false;
							}
						else { //AUN NO LLEGA AL FINAL
								 //continuamos calculando
							  }
				}
				
	
			//persona NATURAL--------------------------------- TIPO DE PERSONA ---------------
			if(allTrim(itc_cmb_tipotitu[i].value) == '1')
			  {	//alert("es natural");
				
				if(allTrim(itc_cmb_tipodoc[i].value) == '' || allTrim(itc_cmb_tipodoc[i].value) == '0')
							{alert('Elija el Tipo de Doc. de Identidad!');	sw=1;	itc_cmb_tipodoc[i].focus();	return false;	}	
				if(itc_numdoc[i].value == '')
				{	alert('Ingrese el Numero del Doc. de Identidad del Titular '+(i+1)+'° !');	
					sw=1;	itc_numdoc[i].focus();	return false;	}
				if(itc_nombre[i].value == '')
				{	alert('Ingrese Nombres del '+(i+1)+'° Titular!');		
					sw=1;	itc_nombre[i].focus();	return false;	}
				if(itc_paterno[i].value == '')
				{	alert('Ingrese Apellido Paterno del '+(i+1)+'° Titular!');					
					sw=1;	itc_paterno[i].focus();	return false;	}
				if(itc_materno[i].value == '')
				{	alert('Ingrese Apellido Materno '+(i+1)+'° Titular!');						
					sw=1;	itc_materno[i].focus();	return false;	}		
	 		  }
			//persona JURiDICA
			else if(allTrim(itc_cmb_tipotitu[i].value) == '2')
				  {	//alert("es juridico");
					if(itc_ruc[i].value == ''){	alert('Ingrese Numero de RUC del '+(i+1)+'° Titular!');				sw=1;	itc_ruc[i].focus();	return false;	}
					if(itc_razsocial[i].value == ''){	alert('Ingrese la Razon Social del '+(i+1)+'° Titular!');		sw=1;	itc_razsocial[i].focus();	return false;	}	
				  }
			else { alert("Elija un Tipo de Titular!"); sw=1;	itc_cmb_tipotitu[i].focus();	return false;	}
			//fin de persona natural
			//-----------------------------------------------------------------------------------
			
			//Fecha de adquisicion
			if(ct_fechaadq[i].value == ''){	alert('Ingresa fecha de Adquisición!'); sw=1; 	ct_fechaadq[i].focus(); return false;}
			
			
			//Domicilio Fiscal del Titular
			//alert("es domicilio");
			if(allTrim(departamentos[i].value) == '' || allTrim(departamentos[i].value) == '0')
				{alert('Elija Ubicacion del Domicilio Fiscal - Departamento!'); sw=1; 	departamentos[i].focus(); return false;}
			if(allTrim(provincias[i].value) == '' || allTrim(provincias[i].value) == '0')
				{alert('Elija Ubicacion del Domicilio Fiscal - Provincia!');	sw=1;	provincias[i].focus(); return false;}
			if(allTrim(distritos[i].value) == '' || allTrim(distritos[i].value) == '0')
				{alert('Elija Ubicacion del Domicilio Fiscal - Distrito!');		sw=1;	distritos[i].focus(); return false;}
			
			
		}//FIN DE FOR

	//Informacion Complementaria
	if(allTrim(ic_1.value) == '' || allTrim(ic_1.value) == '0'){	alert('Elija el Estado de Llenado de la Ficha!');	sw=1;	ic_1.focus();	return false;	}
		
	//Firma
	if(allTrim(f_1.value) == '' || allTrim(f_1.value) == '0'){alert('Elija la Identificacion del Técnico Catastral!');	sw=1;	f_1.focus();	return false;	}
	if(f_2.value == ''){	alert('Ingrese la Fecha de Levantamiento - Técnico!');	sw=1;	f_2.focus();	return false;	}

	//**********************************************************************************************************
		
	if(sw==1)
	{	
		return false;
	}
	else{
				
		//MANDAMOS?
		pregunta();
		}
	
}
//--------------------
function pregunta(){
    if (confirm('¿Estas seguro de enviar este formulario?'))
	{ //pasa 
		//respeta el action
	}
	else
	{	//recuperamos el action del formulario
		document.datos.action="nro_cotitular.php?";
	}
} 
//--------------------
function valida_codigo_referencial(cr)
{
  	var anio=document.getElementById("anio").value;
	var ubi=document.getElementById("ubigeo").value;
	var num=document.getElementById("numero").value;
	var tipo="02";
	
	var cod=anio+ubi+tipo+num;
//	alert(cod);
	var ajax=nuevoAjax();
    ajax.open("POST", "../valida/valida_numficha.php", true);
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("v="+cod);
	
    ajax.onreadystatechange=function()
    {
        if (ajax.readyState==4)
        {	
            var respuesta=ajax.responseXML;
            var valor=respuesta.getElementsByTagName("codigo")[0].childNodes[0].data;
	//		alert(valor);
			if (cod!=valor || valor==null || valor=="")
			{ 	
				document.getElementById("titulares").focus();
			}
			else
			{	alert("Número de Ficha ya existe");
				document.getElementById("numero").focus();
				document.getElementById("numero").value="";
				document.getElementById("numero").select();
   			}
        }
    }
}
//------------------- SETEO DE PORCENTAJE
