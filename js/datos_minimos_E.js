//---------------------------------------------------------- DATOS MINIMOS ECONOMICA ------------------------------
function datos_minimos_economica()
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
		
	
		var itc_1=document.getElementById("ic_cmb_tipocon");		
		
		var ct_1=document.getElementById("ic_cmb_condcon");
	
		var itc_3=document.getElementById("ic_cmb_tipoide");	
		
		var itc_4=document.getElementById("ic_nrodoc");		
		var itc_8=document.getElementById("ic_ruc");
		
		var itc_5=document.getElementById("ic_razsocial");			
		var itc_6=document.getElementById("ape_paterno");
		var itc_7=document.getElementById("ape_materno");
		var itc_10=document.getElementById("nombres");
		
		
	if(!document.getElementById("departamento"))
	{	
		var dftc_1=document.getElementById("departamentos");
		var dftc_2=document.getElementById("provincias");
		var dftc_3=document.getElementById("distritos");
	}
	else
	{
		var dftc_1=document.getElementById("departamento");
		var dftc_2=document.getElementById("provincia");
		var dftc_3=document.getElementById("distrito");
	}	
			
		var ic_1=document.getElementById("ic_cmb_estficha");
		
		var f_1=document.getElementById("f_cmb_tec");
		var f_2=document.getElementById("f_fechatec");
		
			
		//**************************************************************************************
		// sw : determina si pasa o no a la pregunta (0-> pasa --- 1 -> detiene el proceso)
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
		if(dg_4.value == '' || dg_4.value.length<2 || (dg_4.value) == 0)
			{alert('Ingrese codigo de Edificacion! - 2 digitos diferentes de cero');	sw=1;	dg_4.focus();	return false;}
		if(dg_5.value == '' || dg_5.value.length<2 || (dg_5.value) == 0)
			{alert('Ingrese codigo de Entrada! - 2 digitos diferentes de cero');		sw=1;	dg_5.focus();	return false;}
		if(dg_6.value == '' || dg_6.value.length<2 || (dg_6.value) == 0)
			{alert('Ingrese codigo de Piso! - 2 digitos diferentes de cero');			sw=1;	dg_6.focus();	return false;}
		if(dg_7.value == '' || dg_7.value.length<3 || (dg_7.value) == 0)
			{alert('Ingrese codigo de Unidad! - 3 digitos diferentes de cero');		sw=1;	dg_7.focus();	return false;}
		if(dg_8.value == ''){	alert('Ingrese codigo DC!');		sw=1;	dg_8;	}

	
if(allTrim(itc_1.value) == '' || allTrim(itc_1.value) == '0')
	{alert('Elija Tipo de Conductor!');	sw=1;	itc_1.focus();	return false;	}
else
{	
	//persona NATURAL
	if(allTrim(itc_1.value) == '1')
	  {
		if(allTrim(itc_3.value) == '' || allTrim(itc_3.value) == '0')
			{	alert('Elija el Tipo del Doc. de Identidad del Conductor!');	
				sw=1;	itc_3.focus();	return false;	
				}
		if(itc_4.value == '')
			{	alert('Ingrese el Numero del Doc. de Identidad del Conductor!');		
				sw=1;	itc_4.focus();	return false;	
				}
		if(itc_6.value == '')
			{	alert('Ingrese Ap. Paterno del Conductor!');		
				sw=1;	itc_6.focus();	return false;	
				}
		if(itc_7.value == '')
			{	alert('Ingrese Ap. Materno del Conductor!');		
				sw=1;	itc_7.focus();	return false;	
				}
		if(itc_10.value == '')
			{	alert('Ingrese Nombres del Conductor!');		
				sw=1;	itc_10.focus();	return false;	
				}
	  }//fin de si
	//persona JURiDICA
	else if(allTrim(itc_1.value) == '2')
	  {
		if(itc_8.value == '')
		{	
			alert('Ingrese Numero de RUC del Titular!');					
			sw=1;	itc_8.focus();	return false;	
			}
		if(itc_5.value == '')
		{	
			alert('Ingrese Raz. Social del Conductor!');	
			sw=1;	itc_5.focus();	return false;	
			}
		}
	else 
		{ alert("Elija un Tipo de Conductor!"); sw=1;	itc_1.focus();	return false;	
			}
}//	FIN DE ELSE -  Persona


		if(allTrim(ct_1.value) == '' || allTrim(ct_1.value) == '0'){	alert('Elija la condicion del Conductor!');	sw=1;	ct_1.focus();	return false;	}

		
		//Informacion Complementaria
		if(allTrim(ic_1.value) == '' || allTrim(ic_1.value) == '0'){	alert('Elija el Estado de Llenado de la Ficha!');	sw=1;	ic_1.focus();	return false;	}
		
		//Firma
		if(allTrim(f_1.value) == '' || allTrim(f_1.value) == '0'){alert('Elija la Identificacion del Técnico Catastral!');	sw=1;	f_1.focus();	return false;	}
		
		if(f_2.value == ''){	alert('Ingrese la Fecha de Levantamiento - Técnico!');	sw=1;	f_2.focus();	return false;	}

		//**********************************************************************************************************
		//alert(sw);
		existe_individual();	
				
		if (document.getElementById("bandera").value=='esc')
		{	return false;
			sw=1;
		}
		else
		{	sw=0;
		}
		
		//alert(sw);
		switch(sw)
		{
			case 0: //pasa
					break;
			case 1:	return false;
					break;
			
		}
		

		/*if(sw==1)
		{	
			return false;
		}
		else{
			pregunta();
			}*/
	
}

function pregunta()
{
    if (confirm('¿Estas seguro de enviar este formulario?'))
	{ //pasa 
		
	}
	else
	{	//recuperamos el action del formulario
		document.datos.action="edit_economica.php?id="+ficha;
	}
} 

function existe_individual()
{
	var nro_ficha=document.getElementById("numficha").value;

	var anio=document.getElementById("anio").value;
	var tipo=document.getElementById("tipo").value;
	
	//Identificamos el CODIGO REFERENCIAL y POSTERIOR VALIDACION
	var dep=document.getElementById("dg_dep").value;		
	var pro=document.getElementById("dg_pro").value;		
	var dis=document.getElementById("dg_dis").value;
	
	var dg_1=document.getElementById("dg_sector");
	var dg_2=document.getElementById("dg_manzana");
	var dg_3=document.getElementById("dg_lote");
	var dg_4=document.getElementById("dg_edificacion");
	var dg_5=document.getElementById("dg_entrada");
	var dg_6=document.getElementById("dg_piso");
	var dg_7=document.getElementById("dg_unidad");
	var dg_8=document.getElementById("dg_dc");
	
	var cr=dep+pro+dis+dg_1.value+dg_2.value+dg_3.value+dg_4.value+dg_5.value+dg_6.value+dg_7.value+dg_8.value;
	var ficha=anio+dep+pro+dis+tipo+nro_ficha;

	//alert(cr);
	//alert(ficha);

	//--------------------------------------------VALIDA EXISTENCIA---------------------------------------
	var ajax=objetoAjax();
	ajax.open("POST", "../valida/valida_codref.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("v="+cr);
				
	ajax.onreadystatechange=function()
	{	
		if (ajax.readyState==4)
		{	
			var respuesta=ajax.responseXML;
			var valor=respuesta.getElementsByTagName("codigo")[0].childNodes[0].data;
			//alert(valor);
		
			if (valor=='0')
			{	
				alert("No existe Ficha Individual que coincida con el Codigo Referencial");
				document.datos.action="edit_economica.php?id="+ficha;

				document.getElementById("bandera").value='esc';	
			}
			else 
			{	//pasa sólo en IE mas no con FIREFOX
				document.getElementById("bandera").value='go';	
			}
			
			
		}
	}		
}

//*******************************************************************************************
//                                   PARA EDICION DE FICHA ECONOMICA
//*******************************************************************************************
function define_tipo(e)
{	
	var tipo=document.getElementById(e).value;
	//alert(tipo);
	document.getElementById("conductor").value=tipo;
	if (tipo==1)
		{
			document.getElementById("ic_nomcom").value='';
			document.getElementById("ic_nomcom").disabled=true;
			
			document.getElementById("ic_nrodoc").value='';
			document.getElementById("ic_nrodoc").disabled=false;
			
			document.getElementById("ic_ruc").value='';
			document.getElementById("ic_ruc").disabled=true;
			
			document.getElementById("ape_paterno").disabled=false;
			document.getElementById("ape_materno").disabled=false;
			document.getElementById("nombres").disabled=false;
			
			document.getElementById("ic_razsocial").disabled=true;
			
			document.getElementById("ic_cmb_tipoide").focus();	
		}
	else if(tipo==2)
		{
			document.getElementById("ic_ruc").disabled=false;

			document.getElementById("ic_nomcom").disabled=false;
			document.getElementById("ic_nomcom").focus();

			
			document.getElementById("ic_nrodoc").disabled=true;
			document.getElementById("ic_nrodoc").value='';
			
			document.getElementById("ic_cmb_tipoide").disabled=true;
			
			document.getElementById("ape_paterno").disabled=true;
			document.getElementById("ape_paterno").value='';
			document.getElementById("ape_materno").disabled=true;
			document.getElementById("ape_materno").value='';
			document.getElementById("nombres").disabled=true;
			document.getElementById("nombres").value='';
			
			document.getElementById("ic_razsocial").disabled=false;
			
		}
	else
		{
			document.getElementById("ic_nomcom").value='';
			document.getElementById("ic_nomcom").disabled=true;
			
			document.getElementById("ic_nrodoc").value='';
			document.getElementById("ic_nrodoc").disabled=true;
			
			document.getElementById("ic_ruc").value='';
			document.getElementById("ic_ruc").disabled=true;
			
			document.getElementById("ic_razsocial").value='';
			document.getElementById("ic_razsocial").disabled=true;
						
			document.getElementById("ape_paterno").disabled=true;
			document.getElementById("ape_paterno").value='';
			document.getElementById("ape_materno").disabled=true;
			document.getElementById("ape_materno").value='';
			document.getElementById("nombres").disabled=true;
			document.getElementById("nombres").value='';
			
		}
	
	}

function pasa_nrodoc(e)
{	
	var tipodoc=document.getElementById(e).value;
	//alert(tipodoc);
	tipo=document.getElementById("conductor").value;
	if (tipo==1)
		document.getElementById("ic_nrodoc").focus();	
}