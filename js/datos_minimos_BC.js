//---------------------------------------------------------- DATOS MINIMOS INDIVIDUAL ------------------------------
function datos_minimos_biencomun()
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
		
		var dp_1=document.getElementById("dp_cmb_claspre");
		var dp_2=document.getElementById("dp_cmb_precat");
		var dp_3=document.getElementById("dp_cmb_usoprecat");
		var dp_4=document.getElementById("dp_estructura");
		var dp_5=document.getElementById("dp_zonifica");
		var dp_6=document.getElementById("dp_areatverifica");
				
	//**********yop*****************************************************//
		//var g_1=document.getElementById("contador9").value;
		//var g_1=document.getElementById("contador9");
	//**********yop*****************************************************//
		var ic_1=document.getElementById("ic_cmb_estficha");
		
		var f_1=document.getElementById("f_cmb_tec");
		var f_2=document.getElementById("f_fechatec");
	
		var nf_1=document.getElementById("numflote1");
		var nf_2=document.getElementById("numflote2");
		
		
		//**************************************************************************************
		var sw=0;	

		//Datos Generales
		if((nf_1.value) > (nf_2.value))
			{alert('El numero de ficha por lote no debe ser mayor al numero total de fichas por lote!');	sw=1;	nf_1.focus();	return false;}
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
		if(dg_8.value == ''){	alert('Ingrese codigo DC!');		sw=1;	dg_8.focus();	return false;}

		//alert('estavia'+ upc_1.value +'fin');
				
		//Ubicacion del Predio
		if(upc_1.value == '' || upc_1.value.length<6 || upc_1.value == 0)

			{	alert('Ingrese un codigo de Via! - (6 digitos)');	
				sw=1;	
				upc_1.focus();	
				return false;	}

			
		if(allTrim(upc_2.value) == '' || allTrim(upc_2.value) == '0')
			{	alert('Elija un Tipo de Puerta!');					sw=1;	upc_2.focus();	return false;	}
			
		if(upc_3.value == '' || upc_3.value.length<4 || upc_3.value == 0)
			{	alert('Ingrese codigo de Habilitacion Urbana! - (4 digitos)');	sw=1;	upc_3.focus();	return false;	}
		

		//Descripcion del Predio
		if(allTrim(dp_1.value) == '' || allTrim(dp_1.value) == '0'){	alert('Elija la Clasificacion del Predio!');	sw=1;	dp_1.focus();	return false;	}
		if(allTrim(dp_2.value) == '' || allTrim(dp_2.value) == '0'){	alert('Elija la Ubicacion del Predio!');		sw=1;	dp_2.focus();	return false;	}
		if(allTrim(dp_3.value) == '' || allTrim(dp_3.value) == '0'){	alert('Elija codigo de Uso del Predio!');		sw=1;	dp_3.focus();	return false;	}
		//if(dp_4.value == ''){	alert('Ingrese la Estructuracion del Predio!');	sw=1;	dp_4.focus();	return false;	}
		//if(dp_5.value == ''){	alert('Ingrese la Zonificacion del Predio!');	sw=1;	dp_5.focus();	return false;	}
		if(dp_6.value == ''){	alert('Ingrese el Area del Terreno Verificado!');	sw=1;	dp_6.focus();	return false;	}
		

/*
		//MINIMO 2 REGISTROS en RECAP BC
		var cantidad=0;
		var total=0;
		
		for(i=0;i<=g_1;i++)
		{	
			var x=document.getElementById("rbc_numero-"+String(i)).value;
			var y=parseFloat(document.getElementById("rbc_porcentaje-"+String(i)).value);
			
			//alert("Numero: "+x+" - porcentaje: "+y);
			if(x.length>0) //hay dato, sumamos
				{	cantidad=cantidad+1;
					total=total+y;
				}
		}
		
		if(cantidad < 1)
		{	alert('Debe ingresar un  MINIMO de 2 Recapitulaciones de Bienes Comunes!');	
			sw=1;	document.getElementById("rbc_numero-0").focus();	return false;	
			}
		else if(total<100)
			{
				alert('El porcentaje Total NO puede ser MENOR al 100%, verifique!');	
				sw=1;	document.getElementById("rbc_porcentaje-0").focus();	return false;	
			}
		else if(total>100)
			{
				alert('El porcentaje Total NO puede ser MAYOR al 100%, verifique!');	
				sw=1;	document.getElementById("rbc_porcentaje-0").focus();	return false;	
			}
		else 
		{	//alert("Cantidad: "+cantidad+" - Total porcentaje: "+total);//OK
			}*/			

		//Informacion Complementaria
		if(allTrim(ic_1.value) == '' || allTrim(ic_1.value) == '0'){	alert('Elija el Estado de Llenado de la Ficha!');	sw=1;	ic_1.focus();	return false;	}
		
		//Firma
		if(allTrim(f_1.value) == '' || allTrim(f_1.value) == '0'){	alert('Elija la Identificacion del Técnico Catastral!');	sw=1;	f_1.focus();	return false;	}
		if(f_2.value == ''){	alert('Ingrese la Fecha de Levantamiento - Técnico!');	sw=1;	f_2.focus();	return false;	}

		//**********************************************************************************************************

		if(sw==1)
		{	
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

//************************yop********************************//
		//document.datos.action="new_individual.php?ses=1";
		document.datos.action="new_biencomun.php?ses=1";
		//document.datos.action="edit_economica.php?id="+ficha;
		//document.datos.action="nro_cotitular.php?";
//************************yop********************************//
	}
} 