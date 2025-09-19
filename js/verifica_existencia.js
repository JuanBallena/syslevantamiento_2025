
//*********************************************************************************************************************************
//------------------------------------------------------COTITULAR--------------------------------------------------------------

function nro_cotitulares()
{	var directo=document.getElementById("directo").value;
	var nro_titulares=Number(document.getElementById("nro_titulares").value);

	//alert("Vamos directo? si=1 no =0 : "+ directo);
	//alert("Numero de Titulares: "+nro_titulares);
	
	//PARA AMBOS CASOS---------------------------------------
	if(Number(nro_titulares)<2) { alert('Ingrese Nro. de Titulares - (Minimo 2)'); document.getElementById("nro_titulares").focus(); return false;	 }
	else
	{
		//Verificamos si tiene que IR DIRECTO
		if(directo=='1')
		{	
			//VIENE DESDE INDIVIDUAL,  sólo mandamos el nro de titulares
			//location.href="../fichaCotitularidad/new_cotitular.php?titu="+nro_titulares;
			document.envio.action="../fichaCotitularidad/new_cotitular.php?titu="+nro_titulares;
		}
		else if (directo=='0')
			{	var sw=0;
				var nro_ficha=document.getElementById("nro_ficha").value;
				//alert(nro_ficha);
				
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
				
				//------------------NO VACIOS -------------------------------------------------
				if(dg_1.value == '' || dg_1.value.length<2 || parseInt(dg_1.value) == 0)
					{alert('Ingrese codigo de Sector! - 2 digitos');		sw=1;	dg_1.focus();	return false;}
				if(dg_2.value == '' || dg_2.value.length<3 || parseInt(dg_2.value) == 0)
					{alert('Ingrese codigo de Manzana! - 3 digitos'); 		sw=1;	dg_2.focus();	return false;}
				if(dg_3.value == '' || dg_3.value.length<3 || parseInt(dg_3.value) == 0)
					{alert('Ingrese codigo de Lote! - 3 digitos');			sw=1;	dg_3.focus();	return false;}
				if(dg_4.value == '' || dg_4.value.length<2 || parseInt(dg_4.value) == 0)
					{alert('Ingrese codigo de Edificacion! - 2 digitos');	sw=1;	dg_4.focus();	return false;}
				if(dg_5.value == '' || dg_5.value.length<2 || parseInt(dg_5.value) == 0)
					{alert('Ingrese codigo de Entrada! - 2 digitos');		sw=1;	dg_5.focus();	return false;}
				if(dg_6.value == '' || dg_6.value.length<2 || parseInt(dg_6.value) == 0)
					{alert('Ingrese codigo de Piso! - 2 digitos');			sw=1;	dg_6.focus();	return false;}
				if(dg_7.value == '' || dg_7.value.length<3 || parseInt(dg_7.value) == 0)
					{alert('Ingrese codigo de Unidad! - 3 digitos');		sw=1;	dg_7.focus();	return false;}
				if(dg_8.value == ''){	alert('Ingrese codigo DC!');		sw=1;	dg_8;	}
				
				//SOLO PARA NRO DE FICHA
				if(nro_ficha==''){ 		alert('Ingrese Nro. de Ficha'); document.getElementById("nro_ficha").focus(); return false;}
				if(nro_ficha.length<7){ alert('El campo debe contener 7 dígitos');document.getElementById("nro_ficha").focus();	document.getElementById("nro_ficha").select(); return false;}
				//---------------------------------------------------------------------------------------------------------------------------------
				
				//Veamos 
				//alert(sw);
				if(sw==1)
				{	//
					return false;
				}
				else
				{	
					//REGSITRO CORRECTO
					//obtenemos todo el cod. referencial para comprabar si existe ficha  individual con el mismo cod. referencial
					var cr=dep+pro+dis+dg_1.value+dg_2.value+dg_3.value+dg_4.value+dg_5.value+dg_6.value+dg_7.value+dg_8.value;
					//alert(cr);
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
								{	alert("No existe Ficha Individual que coincida con el Codigo Referencial");
									return false;
								}
								else //existe MÁS de UNA FICHA
								{	//pasa sólo en IE mas no con FIREFOX
									location.href="../fichaCotitularidad/new_cotitular.php?titu="+nro_titulares+"&nro="+nro_ficha+"&cr="+cr;
									//document.envio.action="../fichaCotitularidad/new_cotitular.php?titu="+nro_titulares+"&nro="+nro_ficha+"&cr="+cr;
								}
							}
						}
					//-------------------------------------------------------------------------------------------------------------------------
				}//FIN DE ELSE		
			}
		else {//no llega aqui
				}
	}
	
}//FIN DE FUNCION


//-------------------------------------
function valida_nro_ficha_C(e)
{
  	var anio=document.getElementById("anio").value;
	var ubi=document.getElementById("ubigeo").value;
	var num=document.getElementById("nro_ficha").value;
	var tipo="02";
	
	var cod=anio+ubi+tipo+num;
//	alert(cod);
	var ajax=objetoAjax();
    ajax.open("POST", "../valida/valida_numficha.php", true);
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("v="+cod);
	
    ajax.onreadystatechange=function()
    {
        if (ajax.readyState==4)
        {	
            var respuesta=ajax.responseXML;
            var valor=respuesta.getElementsByTagName("codigo")[0].childNodes[0].data;
			//alert(valor);
			if (cod!=valor || valor==null || valor=="")
			{ 	
				document.getElementById("nro_titulares").focus();
			}
			else
			{	alert("Número de Ficha Cotitular ya existe");
				document.getElementById("nro_ficha").focus();
				document.getElementById("nro_ficha").value="";
				document.getElementById("nro_ficha").select();
				return false;
   			}
        }
    }
}

//********************************************************************************************************************************
//--------------------------------------------------ECONOMICA------------------------------------------------------------------

function verifica_economica()
{	var directo=document.getElementById("directo").value;
	
	//alert("Vamos directo? si=1 no =0 : "+ directo);
		
		//Verificamos si tiene que IR DIRECTO
		if(directo=='1')
		{	
			//no sucederá
		}
		else if (directo=='0')
			{	revisar();
			}
		else {//no llega aqui
				}
}//FIN DE FUNCION

//esta funcion es valida para tambien para la modificación
function revisar()
{
	var sw=0;
	var nro_ficha=document.getElementById("nro_ficha").value;
	//alert(nro_ficha);
				
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
				
	//------------------NO VACIOS ------------------------------------------------------------------------------------------
	if(dg_1.value == '' || dg_1.value.length<2 || parseInt(dg_1.value) == 0)
			{alert('Ingrese codigo de Sector! - 2 digitos');		sw=1;	dg_1.focus();	return false;}
	if(dg_2.value == '' || dg_2.value.length<3 || parseInt(dg_2.value) == 0)
			{alert('Ingrese codigo de Manzana! - 3 digitos'); 		sw=1;	dg_2.focus();	return false;}
	if(dg_3.value == '' || dg_3.value.length<3 || parseInt(dg_3.value) == 0)
			{alert('Ingrese codigo de Lote! - 3 digitos');			sw=1;	dg_3.focus();	return false;}
	if(dg_4.value == '' || dg_4.value.length<2 || parseInt(dg_4.value) == 0)
			{alert('Ingrese codigo de Edificacion! - 2 digitos');	sw=1;	dg_4.focus();	return false;}
	if(dg_5.value == '' || dg_5.value.length<2 || parseInt(dg_5.value) == 0)
			{alert('Ingrese codigo de Entrada! - 2 digitos');		sw=1;	dg_5.focus();	return false;}
	if(dg_6.value == '' || dg_6.value.length<2 || parseInt(dg_6.value) == 0)
			{alert('Ingrese codigo de Piso! - 2 digitos');			sw=1;	dg_6.focus();	return false;}
	if(dg_7.value == '' || dg_7.value.length<3 || parseInt(dg_7.value) == 0)
			{alert('Ingrese codigo de Unidad! - 3 digitos');		sw=1;	dg_7.focus();	return false;}
	if(dg_8.value == ''){	alert('Ingrese codigo DC!');		sw=1;	dg_8;	}
		
	//SOLO PARA NRO DE FICHA
	if(nro_ficha=='')
	{ 		
		alert('Ingrese Nro. de Ficha'); document.getElementById("nro_ficha").focus(); return false;}
		if(nro_ficha.length<7)
		{ 
			alert('El campo debe contener 7 dígitos');
			document.getElementById("nro_ficha").focus();	
			document.getElementById("nro_ficha").select(); return false;
			}
		//---------------------------------------------------------------------------------------------------------------------------------
		//Veamos 
		//alert(sw);
		if(sw==1)
		{	//
			return false;
		}
		else
		{	
			//REGISTRO CORRECTO?
			//obtenemos todo el cod. referencial para comprabar si existe ficha  individual con el mismo cod. referencial
			var cr=dep+pro+dis+dg_1.value+dg_2.value+dg_3.value+dg_4.value+dg_5.value+dg_6.value+dg_7.value+dg_8.value;
			//alert(cr);
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
						return false;
					}
				else 
				{	//pasa sólo en IE mas no con FIREFOX
					location.href="../fichaActividadEconomica/new_economica.php?nro="+nro_ficha+"&cr="+cr;
								//document.envio.action="../fichaCotitularidad/new_cotitular.php?titu="+nro_titulares+"&nro="+nro_ficha+"&cr="+cr;
					}
				}
			}						
			//-------------------------------------------------------------------------------------------
		}//FIN DE ELSE		
}



//-------------------------------------
function valida_nro_ficha_E(e)
{
  	var anio=document.getElementById("anio").value;
	var ubi=document.getElementById("ubigeo").value;
	var num=document.getElementById("nro_ficha").value;
	var tipo="03";
	
	var cod=anio+ubi+tipo+num;
//	alert(cod);
	var ajax=objetoAjax();
    ajax.open("POST", "../valida/valida_numficha.php", true);
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("v="+cod);
	
    ajax.onreadystatechange=function()
    {
        if (ajax.readyState==4)
        {	
            var respuesta=ajax.responseXML;
            var valor=respuesta.getElementsByTagName("codigo")[0].childNodes[0].data;
			//alert(valor);
			if (cod!=valor || valor==null || valor=="")
			{ 	
				//document.getElementById("enviar").focus(); //PASE
			}
			else
			{	alert("Número de Ficha Economica ya existe");
				document.getElementById("nro_ficha").focus();
				document.getElementById("nro_ficha").value="";
				document.getElementById("nro_ficha").select();
				return false;
   			}
        }
    }
}

//********************************************************************************************************************************
//--------------------------------------------------BIEN COMUN------------------------------------------------------------------

//-------------------------------------
function valida_nro_ficha_BC(e)
{
  	var anio=document.getElementById("anio").value;
	var ubi=document.getElementById("ubigeo").value;
	var num=document.getElementById("nro_ficha").value;
	var tipo="04";
	
	var cod=anio+ubi+tipo+num;
//	alert(cod);
	var ajax=objetoAjax();
    ajax.open("POST", "../valida/valida_numficha.php", true);
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("v="+cod);
	
    ajax.onreadystatechange=function()
    {
        if (ajax.readyState==4)
        {	
            var respuesta=ajax.responseXML;
            var valor=respuesta.getElementsByTagName("codigo")[0].childNodes[0].data;
			//alert(valor);
			if (cod!=valor || valor==null || valor=="")
			{ 	
				//document.getElementById("enviar").focus(); //PASE
			}
			else
			{	alert("Número de Ficha Bien Común ya existe");
				document.getElementById("nro_ficha").focus();
				document.getElementById("nro_ficha").value="";
				document.getElementById("nro_ficha").select();
				return false;
   			}
        }
    }
}

function verifica_biencomun()
{	var directo=document.getElementById("directo").value;
	
	//alert("Vamos directo? si=1 no =0 : "+ directo);
		
		//Verificamos si tiene que IR DIRECTO
		if(directo=='1')
		{	
			//no sucederá
		}
		else if (directo=='0')
			{	var sw=0;
				var nro_ficha=document.getElementById("nro_ficha").value;
				//alert(nro_ficha);
				
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
				
				//------------------NO VACIOS -------------------------------------------------
				if(dg_1.value == '' || dg_1.value.length<2 || parseInt(dg_1.value) == 0)
					{alert('Ingrese codigo de Sector! - 2 digitos');		sw=1;	dg_1.focus();	return false;}
				if(dg_2.value == '' || dg_2.value.length<3 || parseInt(dg_2.value) == 0)
					{alert('Ingrese codigo de Manzana! - 3 digitos'); 		sw=1;	dg_2.focus();	return false;}
				if(dg_3.value == '' || dg_3.value.length<3 || parseInt(dg_3.value) == 0)
					{alert('Ingrese codigo de Lote! - 3 digitos');			sw=1;	dg_3.focus();	return false;}
				if(dg_4.value == '' || dg_4.value.length<2 || parseInt(dg_4.value) == 0)
					{alert('Ingrese codigo de Edificacion! - 2 digitos');	sw=1;	dg_4.focus();	return false;}
				if(dg_5.value == '' || dg_5.value.length<2 || parseInt(dg_5.value) == 0)
					{alert('Ingrese codigo de Entrada! - 2 digitos');		sw=1;	dg_5.focus();	return false;}
				if(dg_6.value == '' || dg_6.value.length<2 || parseInt(dg_6.value) == 0)
					{alert('Ingrese codigo de Piso! - 2 digitos');			sw=1;	dg_6.focus();	return false;}
				if(dg_7.value == '' || dg_7.value.length<3 || parseInt(dg_7.value) == 0)
					{alert('Ingrese codigo de Unidad! - 3 digitos');		sw=1;	dg_7.focus();	return false;}
				if(dg_8.value == ''){	alert('Ingrese codigo DC!');		sw=1;	dg_8;	}
				
				//SOLO PARA NRO DE FICHA
				if(nro_ficha==''){ 		alert('Ingrese Nro. de Ficha'); document.getElementById("nro_ficha").focus(); return false;}
				if(nro_ficha.length<7){ alert('El campo debe contener 7 dígitos');document.getElementById("nro_ficha").focus();	document.getElementById("nro_ficha").select(); return false;}
				//---------------------------------------------------------------------------------------------------------------------------------
				
				//Veamos 
				//alert(sw);
				if(sw==1)
				{	//
					return false;
				}
				else
				{	
					//REGISTRO CORRECTO?
					//obtenemos todo el cod. referencial para comprabar si existe 2 fichas  individuales con el mismo cod. referencial
					var cr=dep+pro+dis+dg_1.value+dg_2.value+dg_3.value;
					//alert(cr);
					var cod=dep+pro+dis+dg_1.value+dg_2.value+dg_3.value+dg_4.value+dg_5.value+dg_6.value+dg_7.value+dg_8.value;
					//--------------------------------------------VALIDA EXISTENCIA---------------------------------------------------------
					var ajax=objetoAjax();
						ajax.open("POST", "../valida/valida_existencia.php", true);
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
								{	alert("No existen (02) Fichas Individuales que coincidan con el Codigo Referencial");
									return false;
								}
								else 
								{	//pasa sólo en IE mas no con FIREFOX
									location.href="../fichaBienComun/new_biencomun.php?nro="+nro_ficha+"&cr="+cod;
									//document.envio.action="../fichaCotitularidad/new_cotitular.php?titu="+nro_titulares+"&nro="+nro_ficha+"&cr="+cr;
								}
							}
						}
					//-------------------------------------------------------------------------------------------------------------------------
				}//FIN DE ELSE		
			}
		else {//no llega aqui
				}
}//FIN DE FUNCION