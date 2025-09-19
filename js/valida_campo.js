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

//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ PARA SECTOR $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
function valida_sector(e)
{
  	//Si se ha enviado el comentario
	//Window.Growl('Example Window.Growl<br />2 seconds');
	var cod=document.getElementById("dg_sector").value;
	
    var ajax=objetoAjax();
    ajax.open("POST", "../valida/valida_sector.php", true);
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
			{ 	//alert(valor+" "+primero+" "+ultimo);
				document.getElementById("dg_manzana").focus();
			}
			else
			{	
				alert("Sector no existe, elija del rango: "+primero+" - "+ultimo);
				document.getElementById("dg_sector").focus();
				//datos.dg_sector.select();
				document.getElementById("dg_sector").value="";
				document.getElementById("dg_sector").select();
   			}
        }
    }
}

//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ REFERENCIA CATASTRAL $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
function valida_referenciacatastral(){
	var conexion;
	var codCata=document.getElementById("codCata").value;

	if(codCata!='')
	{
		//alert("Codigo Referencia Catastral: "+cod);
		conexion=objetoAjax();
		conexion.open("POST","../valida/valida_catastro.php",true);
		conexion.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    	conexion.send("v="+codCata);

		conexion.onreadystatechange=function(){
		  	if (conexion.readyState==4 && conexion.status==200){
		  		//console.log("Recepci�n de paquetes exitosa...");
		  		var valor = conexion.responseText;
		  		//alert("VALOR: "+valor);

		  		if (valor != '')
				{ 	
					//alert("Codigo Referencial Catastral EXISTE!!");
					document.getElementById("dg_lote").value = '';

				}
				else
				{	
					//alert("Codigo Referencial Catastral NO EXISTE!!");
					document.getElementById("dg_lote").value = '';
					document.getElementById("dg_manzana").value = '';
					document.getElementById("dg_sector").value = '';
					document.getElementById("dg_sector").focus();
	   			}
			}
		};
	}
}

//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ PARA FICHA $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
function valida_ficha(e)
{
  	var anio=document.getElementById("anio").value;
	var ubi=document.getElementById("dg_dep").value+document.getElementById("dg_pro").value+document.getElementById("dg_dis").value;
	var num=rellenar_ceros(e.value,7);
	//alert(anio);
	//alert(ubi);
	//alert(num);
	
	var tipo=document.getElementById("tipo").value;
	var cod=anio+ubi+tipo+num;
	//alert(cod);
	
	var ajax=objetoAjax();
    ajax.open("POST","../valida/valida_numficha.php",true);
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    ajax.send("v="+cod);
	
    datos.previo.value=cod;

    ajax.onreadystatechange=function()
    {
        if (ajax.readyState==4)
        {	
            var respuesta=ajax.responseXML;
            var valor=respuesta.getElementsByTagName("codigo")[0].childNodes[0].data;
			//alert(valor);
			if (cod!=valor || valor==null || valor=="")
			{ 	
				document.getElementById("numficha").value=num;
				document.getElementById("numflote1").focus();
				//alert("2222222222222");
			}
			else
			{	
				document.getElementById("numficha").value=num;
				alert("N�mero de Ficha ya existe");
				document.getElementById("numficha").focus();
				document.getElementById("numficha").value="";
				document.getElementById("numficha").select();
   			}
        }
    }
}

//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ PARA VACIOS $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
function novacio(e)
{
	var i;
	if(e)
	 {
	 //i=c.name+"obl";
	 i=e.name;
	 //alert(i);
		if(e.value.length<=0)
		{
			// document.getElementById(i).style.visibility=v;
			if(i=="numficha") 	 	campo=' - 7 caracteres';
			if(i=="dg_sector" || i=="dg_edificacion" || i=="dg_entrada" || i=="dg_piso") campo=' - 2 caracteres';
			if(i=="dg_manzana" || i=="dg_lote" || i=="dg_unidad") 	campo=' - 3 caracteres';

			alert("Ingrese un valor"+campo);
			document.getElementById(i).focus();
		}
 	}
}

//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ PARA DC $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
function calcula_dc(e)
{	
	var result=0;
	var dep=document.getElementById("dg_dep").value;
	var pro=document.getElementById("dg_pro").value;
	var dis=document.getElementById("dg_dis").value;
	var sec=document.getElementById("dg_sector").value;

	var mza=document.getElementById("dg_manzana").value;

	var lot=document.getElementById("dg_lote").value;
	var edi=document.getElementById("dg_edificacion").value;
	var ent=document.getElementById("dg_entrada").value;
	var pis=document.getElementById("dg_piso").value;	
	var uni=document.getElementById("dg_unidad").value;	
	
	var referencia=dep+pro+dis+sec+mza+lot+edi+ent+pis+uni;
	//alert(referencia);
	for (i=0;i<referencia.length;i++) 
	{
		//alert("digito: "+referencia.charAt(i));
		result = result + parseInt(referencia.charAt(i));
		if(result < 9){
			//pasa porque ya lo sumamos
		}
		else{
			//restamos
			result = result - 9;
		}
		//alert("resultado: "+result);	
	}
	
	document.getElementById("dg_dc").value=result;
}

//------------------------------------------------- BLOQUEO DE USO: SIN CONSTRUIR 070101 ------------------------------------------------
function cargar_bloqueo_construccion(e)
{	
	// Obtengo el select
	var selectOrigen=document.getElementById(e);
	// Obtengo la opcion que el usuario selecciono
	var opcionSeleccionada=selectOrigen.options[selectOrigen.selectedIndex].value;
	// Quitamos los espacios
	opcionSeleccionada=allTrim(opcionSeleccionada);
	//alert(opcionSeleccionada);
	if(opcionSeleccionada=='070101'){	
		//OCULTAMOS TABLA
		document.getElementById("construccion").style.display="none" ;
	}
	else{	
		//VISULIZAMOS TABLA
		document.getElementById("construccion").style.display="inline" ;
	}
}

//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ CONFIRMACION DE CLAVE $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
function conformidad_clave(e)
{
	var i,v;

	i=e.value;
	v=document.getElementById("new_pass").value;
  	
  	if(i!=v){
		alert("No hay coincidencia!");
		document.getElementById("new_pass").focus();
		document.getElementById("new_pass").select();
 	}
}

function novaciopass(e)
{
	if(e)
	{
		if(e.length < 6)
		{	
			alert('Ingrese minimo 6 caracteres');
			exit();
		}

		if(e.value.length<=0)
	 	{
			// document.getElementById(i).style.visibility=v;
			alert("Ingrese una Constrase�a");
			document.getElementById("new_pass").focus();
			document.getElementById("new_pass").select();
	 	}
 	}
}

//---------------------------------
function set_numero(e)
{
	var valor=Number(e.value);
	e.value=valor;
}

//--------------------------------
function set_decimal(e)
{
	var valor=(Math.floor((e.value)*100))/100;;
	e.value=valor;
}