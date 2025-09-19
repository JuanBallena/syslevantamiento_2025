	
	//---------------------------------------------------------- DATOS MINIMOS INDIVIDUAL ------------------------------
	function datos_minimos_individual()
	{	
		var ubica;		
		
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
		
		var upc_1=document.getElementById("upc_cod-0");
		var upc_2=document.getElementById("upc_pue-0");
		var upc_3=document.getElementById("upc_codhu");
		
		var ct_1=document.getElementById("ct_cmb_condtitu");
		var ct_2=document.getElementById("ct_fechaadq");
		
		var itc_1=document.getElementById("itc_cmb_tipotitu");		
		var itc_2=document.getElementById("itc_cmb_ecivil");
		var itc_3=document.getElementById("itc_cmb_tipodoc1");	var itc_11=document.getElementById("itc_cmb_tipodoc2");
		var itc_4=document.getElementById("itc_numdoc1");		var itc_12=document.getElementById("itc_numdoc2");
		var itc_5=document.getElementById("itc_nombre1");		var itc_13=document.getElementById("itc_nombre2");
		var itc_6=document.getElementById("itc_paterno1");		var itc_14=document.getElementById("itc_paterno2");
		var itc_7=document.getElementById("itc_materno1");		var itc_15=document.getElementById("itc_materno2");
		
		var itc_8=document.getElementById("itc_ruc");
		var itc_9=document.getElementById("itc_itc_razsocial");
		var itc_10=document.getElementById("itc_cmb_perjur");
		

		if(!document.getElementById("departamento")){
			var dftc_1=document.getElementById("departamentos");
			var dftc_2=document.getElementById("provincias");
			var dftc_3=document.getElementById("distritos");
		}
		else{
			var dftc_1=document.getElementById("departamento");
			var dftc_2=document.getElementById("provincia");
			var dftc_3=document.getElementById("distrito");
		}

		var dp_1=document.getElementById("dp_cmb_claspre");
		var dp_2=document.getElementById("dp_cmb_precat");
		var dp_3=document.getElementById("dp_cmb_usoprecat");
		var dp_4=document.getElementById("dp_estructura");
		var dp_5=document.getElementById("dp_zonifica");
		
		var ic_1=document.getElementById("ic_cmb_estficha");
		
		var f_1=document.getElementById("f_cmb_tec");
		var f_2=document.getElementById("f_fechatec");
		
		/*alert(dftc_1.value);
		alert(dftc_2.value);
		alert(dftc_3.value);
		alert(dp_1.value);
		alert(dp_2.value);
		alert(dp_3.value);
		alert(f_1.value);*/
		//**************************************************************************************
		var sw=0;

		//Datos Generales
		if(pr_1.value == '' || pr_1.value.length<7 || (pr_1.value) == 0)
			{ alert('Ingrese Numero de Ficha! - 7 digitos diferentes de cero');			sw=1;	pr_1.focus();	return false;}
		if(dg_1.value == '' || dg_1.value.length<2 || (dg_1.value) == 0)
			{ alert('Ingrese codigo de Sector! - 2 digitos diferentes de cero');		sw=1;	dg_1.focus();	return false;}
		if(dg_2.value == '' || dg_2.value.length<3 || (dg_2.value) == 0)
			{ alert('Ingrese codigo de Manzana! - 3 digitos diferentes de cero'); 		sw=1;	dg_2.focus();	return false;}
		if(dg_3.value == '' || dg_3.value.length<3 || (dg_3.value) == 0)
			{ alert('Ingrese codigo de Lote! - 3 digitos diferentes de cero');			sw=1;	dg_3.focus();	return false;}
		if(dg_4.value == '' || dg_4.value.length<2 || (dg_4.value) == 0)
			{ alert('Ingrese codigo de Edificacion! - 2 digitos diferentes de cero');	sw=1;	dg_4.focus();	return false;}
		if(dg_5.value == '' || dg_5.value.length<2 || (dg_5.value) == 0)
			{ alert('Ingrese codigo de Entrada! - 2 digitos diferentes de cero');		sw=1;	dg_5.focus();	return false;}
		if(dg_6.value == '' || dg_6.value.length<2 || (dg_6.value) == 0)
			{ alert('Ingrese codigo de Piso! - 2 digitos diferentes de cero');			sw=1;	dg_6.focus();	return false;}
		if(dg_7.value == '' || dg_7.value.length<3 || (dg_7.value) == 0)
			{ alert('Ingrese codigo de Unidad! - 3 digitos diferentes de cero');		sw=1;	dg_7.focus();	return false;}
		if(dg_8.value == ''){	alert('Ingrese codigo DC!');		sw=1;	dg_8.focus();	return false;}

		//Ubicacion del Predio
		if(upc_1.value == '' || upc_1.value.length<6 || upc_1.value == 0){	
			alert('Ingrese un codigo de Via! - (6 digitos)');	
			sw=1;	
			upc_1.focus();
			return false;	
		}
			
		if(allTrim(upc_2.value) == '' || allTrim(upc_2.value) == '0')
		{	alert('Elija un Tipo de Puerta!');					sw=1;	upc_2.focus();	return false;	}
			
		if(upc_3.value == '' || upc_3.value.length<4 || upc_3.value == 0)
		{	alert('Ingrese codigo de Habilitacion Urbana! - (4 digitos)');	sw=1;	upc_3.focus();	return false;	}
		
		//Caracteristicas del Titular
		if(allTrim(ct_1.value) == '' || allTrim(ct_1.value) == '0'){	alert('Elija la condicion del Titular!');	sw=1;	ct_1.focus();	return false;	}
		//if (allTrim(ct_1.value) != '05')
			//if(ct_2.value == ''){	alert('Ingrese la Fecha de Adquisicion!');	sw=1;	ct_2.focus();	return false;	}
		
		//Identificacion del Titular Catastral
		//Si no esta seleccionado COTITULARIDAD
		if (allTrim(ct_1.value) != '05')
		{
			if(allTrim(itc_1.value) == '' || allTrim(itc_1.value) == '0'){
				alert('Elija Tipo de Titular!');	sw=1;	itc_1.focus();	return false;	
			}
			else{
				// Persona NATURAL
				if(allTrim(itc_1.value) == '1')
				{
					if(allTrim(itc_2.value) == '' || allTrim(itc_2.value) == '0'){ alert('Elija Estado Civil del Titular!');	sw=1;	itc_2.focus();	return false; }
					if(allTrim(itc_3.value) == '' || allTrim(itc_3.value) == '0'){ alert('Elija el Tipo del Doc. de Identidad del Titular!');  sw=1;	itc_3.focus();	return false; }
					if(itc_4.value == ''){	alert('Ingrese el Numero del Doc. de Identidad del Titular!');			sw=1;	itc_4.focus();	return false;	}
					if(itc_5.value == ''){	alert('Ingrese Nombres del Titular!');									sw=1;	itc_5.focus();	return false;	}
					if(itc_6.value == ''){	alert('Ingrese Apellido Paterno del Titular!');							sw=1;	itc_6.focus();	return false;	}
					if(itc_7.value == ''){	alert('Ingrese Apellido Materno Titular!');								sw=1;	itc_7.focus();	return false;	}
					
					//SI ESTA CASADO - CONVIVIENTE
					if(allTrim(itc_2.value) == '02' || allTrim(itc_2.value) == '05')
					{	
						if(allTrim(itc_11.value) == '' || allTrim(itc_11.value) == '0'){ alert('Elija el Tipo del Doc. de Identidad de Conyuge/Conviviente!');	sw=1;	itc_11.focus();	return false; }
						if(itc_12.value == ''){	alert('Ingrese el Numero del Doc. de Identidad de Conyuge/Conviviente!');		sw=1;	itc_12.focus();	return false;	}
						if(itc_13.value == ''){	alert('Ingrese Nombres de Conyuge/Conviviente!');								sw=1;	itc_13.focus();	return false;	}
						if(itc_14.value == ''){	alert('Ingrese Apellido Paterno de Conyuge/Conviviente!');						sw=1;	itc_14.focus();	return false;	}
						if(itc_15.value == ''){	alert('Ingrese Apellido Materno Conyuge/Conviviente!');							sw=1;	itc_15.focus();	return false;	}
					}
				}//fin de si
				
				// Persona JURiDICA
				else if(allTrim(itc_1.value) == '2')
				{
					if(itc_8.value == ''){	alert('Ingrese Numero de RUC del Titular!');					sw=1;	itc_8.focus();	return false;	}
					if(itc_9.value == ''){	alert('Ingrese la Razon Social del Titular!');					sw=1;	itc_9.focus();	return false;	}
					if(allTrim(itc_10.value) == ''){	alert('Elija Persona Juridica');					sw=1;	itc_10.focus();	return false;	}
				}
				else { 
					alert("Elija un Tipo de Titular!"); sw=1;	itc_1.focus();	return false;	
				}
			}//fin de else persona natural
		}
			
		//Domicilio Fiscal del Titular
		if(allTrim(dftc_1.value) == '' || allTrim(dftc_1.value) == '0'){alert('Elija Ubicacion del Domicilio Fiscal - Departamento!'); sw=1; dftc_1.focus(); return false;}
		if(allTrim(dftc_2.value) == '' || allTrim(dftc_2.value) == '0'){alert('Elija Ubicacion del Domicilio Fiscal - Provincia!');	sw=1;	dftc_2.focus(); return false;}
		if(allTrim(dftc_3.value) == '' || allTrim(dftc_3.value) == '0'){alert('Elija Ubicacion del Domicilio Fiscal - Distrito!');	sw=1;	dftc_3.focus(); return false;}

		//Descripcion del Predio
		if(allTrim(dp_1.value) == '' || allTrim(dp_1.value) == '0'){	alert('Elija la Clasificacion del Predio!');	sw=1;	dp_1.focus();	return false;	}
		if(allTrim(dp_2.value) == '' || allTrim(dp_2.value) == '0'){	alert('Elija la Ubicacion del Predio!');		sw=1;	dp_2.focus();	return false;	}
		if(allTrim(dp_3.value) == '' || allTrim(dp_3.value) == '0'){	alert('Elija codigo de Uso del Predio!');		sw=1;	dp_3.focus();	return false;	}
		//if(dp_4.value == ''){	alert('Ingrese la Estructuracion del Predio!');	sw=1;	dp_4.focus();	return false;	}
		//if(dp_5.value == ''){	alert('Ingrese la Zonificacion del Predio!');	sw=1;	dp_5.focus();	return false;	}

		//Informacion Complementaria
		if(allTrim(ic_1.value) == '' || allTrim(ic_1.value) == '0'){ alert('Elija el Estado de Llenado de la Ficha!');	sw=1;	ic_1.focus();	return false; }
		
		//Firma
		if(allTrim(f_1.value) == '' || allTrim(f_1.value) == '0'){ alert('Elija la Identificacion del Técnico Catastral!');	sw=1;	f_1.focus();	return false; }
		if(f_2.value == ''){ alert('Ingrese la Fecha de Levantamiento - Técnico!');	sw=1;	f_2.focus();	return false; }

		//**********************************************************************************************************
		if(sw==1){	
			return false;
		}
		else{
			pregunta();
		}
	}

	function pregunta(){
    if (confirm('¿Estas seguro de enviar este formulario?'))
	{ //pasa 

	}
	else
	{	//recuperamos el action del formulario
		document.datos.action="new_individual.php?ses=1";
	}
}