function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
  		}
	}

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ PARA VIAS $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
function pulsar_via(e)
{
	var c=document.getElementById("contador1").value;
	//alert(c);
	if (c==0)
	{
		var cod=rellenar_ceros(document.getElementById("upc_cod-0").value,6);
		var campo0=document.getElementById("upc_cod-0");
		var campo1=document.getElementById("upc_tipo-0");
    	var campo2=document.getElementById("upc_nom-0");
		var campo_siguiente=document.getElementById("upc_pue-0");
	}
	else   
	{
		var cod=rellenar_ceros(document.getElementById("upc_cod-"+c).value,6);
		var campo0=document.getElementById("upc_cod-"+c);
    	var campo1=document.getElementById("upc_tipo-"+c);
    	var campo2=document.getElementById("upc_nom-"+c);
		var campo_siguiente=document.getElementById("upc_pue-"+c);
		//alert(cod);
	}
	
    var ajax=nuevoAjax();
    ajax.open("POST", "../funciones/consulta_via.php", true);
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("v="+cod);

	ajax.onreadystatechange=function()
    {
        if (ajax.readyState==4)
        {
            var respuesta=ajax.responseXML;
			var valor=respuesta.getElementsByTagName("codigo")[0].childNodes[0].data;
			//var primero=respuesta.getElementsByTagName("primero")[0].childNodes[0].data;
			//var ultimo=respuesta.getElementsByTagName("ultimo")[0].childNodes[0].data;
			
			//verificamos que exista
			if (cod==valor)
			{ 	
				campo0.value=cod;
				campo1.value=respuesta.getElementsByTagName("tipo")[0].childNodes[0].data;
	            campo2.value=respuesta.getElementsByTagName("nombre")[0].childNodes[0].data;
				campo_siguiente.focus();
			}
			else
			{	
				campo0.value=cod;
				alert("V�a no existe.");
				//alert("Via no existe, elija del rango: "+primero+" - "+ultimo+" (6 digitos)");
				campo0.value="";
				campo1.value="";
				campo2.value="";
				campo0.focus();
  			}
        }
	}
}

function trae_via(e)
{ 
  	var tipo_ficha=document.getElementById("tipo").value;
	//alert("Tipo de Ficha: "+tipo_ficha);
	
	var name=e.name; 
	var cantidad=name.length;
	//alert(cantidad);
	indice=name.slice (cantidad-1, cantidad);
	//alert('Nombre de objeto: '+name+' / Indice: '+indice);

  	switch(tipo_ficha)
	{
		case '02':
					var cod=rellenar_ceros(document.getElementById("dftc_codvia-"+indice).value,6);
					var campo0=document.getElementById("dftc_codvia-"+indice);
					var campo1=document.getElementById("dftc_tipovia-"+indice);
					var campo2=document.getElementById("dftc_nomvia-"+indice);
					var campo_siguiente=document.getElementById("dftc_nummuni-"+indice);
					//alert(cod);
					break;
		default:
					var cod=rellenar_ceros(document.getElementById("dftc_codvia").value,6);
					var campo0=document.getElementById("dftc_codvia");
					var campo1=document.getElementById("dftc_tipovia");
					var campo2=document.getElementById("dftc_nomvia");
					var campo_siguiente=document.getElementById("dftc_nummuni");
					//alert(cod);
					break;
	}//fin switch
	
	//alert("CODIGO DE VIA ES: "+cod);
	var ajax=nuevoAjax();
	ajax.open("POST", "../funciones/consulta_via.php", true);
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("v="+cod);
							
	ajax.onreadystatechange=function()
	{
		if (ajax.readyState==4)
		{
			var respuesta=ajax.responseXML;
			var valor=respuesta.getElementsByTagName("codigo")[0].childNodes[0].data;
			//var primero=respuesta.getElementsByTagName("primero")[0].childNodes[0].data;
			//var ultimo=respuesta.getElementsByTagName("ultimo")[0].childNodes[0].data;

			//alert("CODIGO VIA: "+cod+"\nVALOR: "+valor);
			
			//verificamos que exista
			if (cod==valor)
			{ 	
				campo0.value=cod;
				campo1.value=respuesta.getElementsByTagName("tipo")[0].childNodes[0].data;
				campo2.value=respuesta.getElementsByTagName("nombre")[0].childNodes[0].data;
				campo_siguiente.focus();
			}
			else
			{	
				campo0.value=cod;
				alert("V�a no existe.");
				//alert("V�a no existe, elija del rango: "+primero+" - "+ultimo);
				campo0.value="";
				campo1.value="";
				campo2.value="";
				campo0.focus();
			}
		}
	}
}

//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ PARA OBRAS $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
function pulsar_Obra(e)
{
  var c=document.getElementById("contador3").value;
	if (c==0)
	{
		var cod=document.getElementById("oc_cod-0").value;
		var campo0=document.getElementById("oc_cod-0");
		var campo1=document.getElementById("oc_des-0");
		var campo_siguiente=document.getElementById("oc_fecha-0");
	}
	else   
	{
		var cod=document.getElementById("oc_cod-"+c).value;
		var campo0=document.getElementById("oc_cod-"+c);
    	var campo1=document.getElementById("oc_des-"+c);
		var campo_siguiente=document.getElementById("oc_fecha-"+c);
	}
	
    var ajax=nuevoAjax();
    ajax.open("POST", "../funciones/consulta_obra.php", true);
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("v="+cod);
            
    ajax.onreadystatechange=function()
    {
        if (ajax.readyState==4)
        {
            var respuesta=ajax.responseXML;
			var valor=respuesta.getElementsByTagName("codigo")[0].childNodes[0].data;
			var primero=respuesta.getElementsByTagName("primero")[0].childNodes[0].data;
			var ultimo=respuesta.getElementsByTagName("ultimo")[0].childNodes[0].data;
			
			if (cod==valor)
			{ 	campo1.value=respuesta.getElementsByTagName("descri")[0].childNodes[0].data;
				campo_siguiente.focus();
				
			}
			else
			{	alert("Obra/Instalaci�n no existe, elija del rango: "+primero+" - "+ultimo);
				campo0.focus();
				
  			}
            
            
        }
    }
}

//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ PARA H.Urbanas $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
function trae_HU1(e)
{
  	var cod=rellenar_ceros(document.getElementById("upc_codhu").value,4);
	var campo0=document.getElementById("upc_codhu");
	var campo1=document.getElementById("upc_nomhu");
	var campo_siguiente=document.getElementById("upc_zse");
	
    var ajax=nuevoAjax();
    ajax.open("POST", "../funciones/consulta_hu.php", true);
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    ajax.send("v="+cod);
            
    ajax.onreadystatechange=function()
    {
        if (ajax.readyState==4)
        {
            var respuesta=ajax.responseXML;
			var valor=respuesta.getElementsByTagName("codigo")[0].childNodes[0].data;
			
			if (cod==valor)
			{ 	
				campo0.value=cod;
				campo1.value=respuesta.getElementsByTagName("nombre")[0].childNodes[0].data;
				campo_siguiente.focus();
			}
			else
			{	
				alert("Hab. Urbana no existe ");
				campo0.value="";
				campo1.value="";
				campo0.focus();
  			}
        }
    }
}

function trae_HU2(e)
{
  	var tipo_ficha=document.getElementById("tipo").value;
	//alert("Tipo de Ficha: "+tipo_ficha);
	
	var name=e.name; 
	var cantidad=name.length;
	//alert(cantidad);
	indice=name.slice (cantidad-1, cantidad);
	//alert('Nombre de objeto: '+name+' / Indice: '+indice);

	switch(tipo_ficha)
	{
		case '02':
					var cod=rellenar_ceros(document.getElementById("dftc_codhu-"+indice).value,4);
					
					var campo0=document.getElementById("dftc_codhu-"+indice);
					var campo1=document.getElementById("dftc_nomhu-"+indice);
					var campo_siguiente=document.getElementById("dftc_zse-"+indice);
					break;
					
		default:
					var cod=rellenar_ceros(document.getElementById("dftc_codhu").value,4);
					var campo0=document.getElementById("dftc_codhu");
					var campo1=document.getElementById("dftc_nomhu");
					var campo_siguiente=document.getElementById("dftc_zse");
					break;	
	}//fin switch
	
	var ajax=nuevoAjax();
    ajax.open("POST", "../funciones/consulta_hu.php", true);
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    ajax.send("v="+cod);
            
    ajax.onreadystatechange=function()
    {
        if (ajax.readyState==4)
        {
            var respuesta=ajax.responseXML;
			var valor=respuesta.getElementsByTagName("codigo")[0].childNodes[0].data;
			
			if (cod==valor)
			{ 	
				campo0.value=cod;
				campo1.value=respuesta.getElementsByTagName("nombre")[0].childNodes[0].data;
				campo_siguiente.focus();
			}
			else
			{	
				alert("Habilitacion Urbana no existe");
				campo0.value="";
				campo1.value="";
				campo0.focus();
  			}
        }
    } 
}

function trae_Persona(e)
{
	var conexion;

  	var NRO_DOCUMENTO=document.getElementById("f_dni").value;
	var campo0=document.getElementById("f_nom");
	var campo1=document.getElementById("f_paterno");
	var campo2=document.getElementById("f_materno");
	var campo_siguiente=document.getElementById("f_fecha");

	//alert("DNI: "+NRO_DOCUMENTO);
	
    conexion=objetoAjax();
    conexion.open("POST", "../funciones/consulta_persona.php",true);
    conexion.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    conexion.send("v="+NRO_DOCUMENTO);
            
    conexion.onreadystatechange=function(){
        if (conexion.readyState==4 && conexion.status==200){
            var respuesta=conexion.responseXML;
			var valor=respuesta.getElementsByTagName("codigo")[0].childNodes[0].data;

			/** Metodo trim() no es soportado para IE7 */
			//alert("VALOR: "+valor.trim());
			//alert("NRO_DOCUMENTO=["+NRO_DOCUMENTO+"] ; VALOR=["+valor.replace(/\s+/gi,'')+"]");
			
			if (NRO_DOCUMENTO==valor.replace(/\s+/gi,''))
			{ 	
				campo0.value=respuesta.getElementsByTagName("nombre")[0].childNodes[0].data;
				campo1.value=respuesta.getElementsByTagName("apellidopat")[0].childNodes[0].data;
				campo2.value=respuesta.getElementsByTagName("apellidomat")[0].childNodes[0].data;
				campo_siguiente.focus();
			}
        }
    };
}
//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ PARA H.Urbanas SIMTRUX $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
function trae_HU1(e)
{
  	var cod=rellenar_ceros(document.getElementById("upc_codhu").value,4);
	var campo0=document.getElementById("upc_codhu");
	var campo1=document.getElementById("upc_nomhu");
	var campo_siguiente=document.getElementById("upc_zse");
	
    var ajax=nuevoAjax();
    ajax.open("POST", "../funciones/consulta_hu_SIMTRUX.php", true);
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    ajax.send("v="+cod);
            
    ajax.onreadystatechange=function()
    {
        if (ajax.readyState==4)
        {
            var respuesta=ajax.responseXML;
			var valor=respuesta.getElementsByTagName("codigo")[0].childNodes[0].data;
			
			if (cod==valor)
			{ 	
				campo0.value=cod;
				campo1.value=respuesta.getElementsByTagName("nombre")[0].childNodes[0].data;
				campo_siguiente.focus();
			}
			else
			{	
				alert("Hab. Urbana no existe ");
				campo0.value="";
				campo1.value="";
				campo0.focus();
  			}
        }
    }
}