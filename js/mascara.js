//---------------------------------------------------------
//LOAD DE INDIVIDUAL
function ponerfoco_1()
		{ 	//datos.tipo.value="01";
			document.getElementById("tipo").value='01';	
			
			document.getElementById("itc_cmb_ecivil").disabled=true;
			document.getElementById("itc_cmb_tipodoc1").disabled=true;	
			document.getElementById("itc_cmb_tipodoc2").disabled=true;
			document.getElementById("itc_cmb_perjur").disabled=true;
			document.getElementById("itc_cmb_condesptitu").disabled=true;
					
		} 
		
function edit_ponerfoco_1()
		{ 	//datos.tipo.value="01";
			document.getElementById("tipo").value='01';	
		} 

		
//LOAD DE COTITULAR
function ponerfoco_2()
	{ 
		document.getElementById("tipo").value='02';
	}

//LOAD DE ECONÓMICA
function ponerfoco_3()
	{ 
		document.getElementById("tipo").value='03';
	}

//LOAD DE BIEN COMÚN
function ponerfoco_4()
	{ 
		document.getElementById("tipo").value='04';
	}
//-----------------

function muestra_y_oculta()
{
	document.getElementById("capa_oculta1").style.display = "block";
	document.getElementById("capa_oculta2").style.display = "block";
	document.getElementById("capa_oculta3").style.display = "block";
	document.getElementById("cambiar").style.display = "none";
	document.getElementById("departamento").style.display = "none";
	document.getElementById("provincia").style.display = "none";
	document.getElementById("distrito").style.display = "none";
	return false;
}
	
function muestra_y_oculta_cot(e)
{
	//alert(e);
	document.getElementById("capa_oculta1_"+e).style.display = "block";
	document.getElementById("capa_oculta2_"+e).style.display = "block";
	document.getElementById("capa_oculta3_"+e).style.display = "block";
	document.getElementById("cambiar_"+e).style.display = "none";
	document.getElementById("departamento"+e).style.display = "none";
	document.getElementById("provincia"+e).style.display = "none";
	document.getElementById("distrito"+e).style.display = "none";
	return false;
}
//----------------------------------------------------------
function IsNumeric(valor) 
{ 
	var log=valor.length; var sw="S"; 
	for (x=0; x<log; x++) 
	{ v1=valor.substr(x,1); 
	v2 = parseInt(v1); 
	//Compruebo si es un valor numérico 
	if (isNaN(v2)) { sw= "N";} 
	} 
	if (sw=="S") {return true;} else {return false; } 
} 

var primerslap=false; 
var segundoslap=false; 
//----------------------------------------------------------
function formateafecha(fecha) 
{ 
	var long = fecha.length; 
	var dia; 
	var mes; 
	var ano; 
	if ((long>=2) && (primerslap==false)) { dia=fecha.substr(0,2); 
	if ((IsNumeric(dia)==true) && (dia<=31) && (dia!="00")) { fecha=fecha.substr(0,2)+"/"+fecha.substr(3,7); primerslap=true; } 
	else { fecha=""; primerslap=false;} 
	} 
	else 
	{ dia=fecha.substr(0,1); 
	if (IsNumeric(dia)==false) 
	{fecha="";} 
	if ((long<=2) && (primerslap=true)) {fecha=fecha.substr(0,1); primerslap=false; } 
	} 
	if ((long>=5) && (segundoslap==false)) 
	{ mes=fecha.substr(3,2); 
	if ((IsNumeric(mes)==true) &&(mes<=12) && (mes!="00")) { fecha=fecha.substr(0,5)+"/"+fecha.substr(6,4); segundoslap=true; } 
	else { fecha=fecha.substr(0,3);; segundoslap=false;} 
	} 
	else { if ((long<=5) && (segundoslap=true)) { fecha=fecha.substr(0,4); segundoslap=false; } } 
	
	if (long>=7) 
	{ 
		ano=fecha.substr(6,4); 
		if (IsNumeric(ano)==false) { fecha=fecha.substr(0,6); } 
		else { if (long==10){ if ((ano==0) || (ano<1900) || (ano>2100)) { fecha=fecha.substr(0,6); } } } 
	} 
	
	if (long>=10) 
	{ 
		fecha=fecha.substr(0,10); 
		dia=fecha.substr(0,2); 
		mes=fecha.substr(3,2); 
		ano=fecha.substr(6,4); 
		// Año no viciesto y es febrero y el dia es mayor a 28 
		if ( (ano%4 != 0) && (mes ==02) && (dia > 28) ) { fecha=fecha.substr(0,2)+"/"; } 
	} 
	return (fecha); 
}