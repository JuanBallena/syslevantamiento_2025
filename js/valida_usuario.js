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

function valida_new_usuario()
{
	
	if(document.getElementById("usuario").value.length < 6 )
	{
	 alert ("Debe Ingresar Usuario mayor de 5 caracteres");
	 document.getElementById("usuario").focus();
	 return (false);
	}
	
	if(document.getElementById("clave").value.length < 6 )
	{
	 alert ("Debe Ingresar una Clave Segura");
	 document.getElementById("clave").focus();
	 return (false);
	}	
	
	if(document.getElementById("nombres").value.length < 3)
	{
	  alert("Debe Ingresar su Nombre");
	  document.getElementById("nombres").focus();
	return (false);
	}
	
	if(document.getElementById("apepat").value.length < 3 )
	{
	 alert ("Debe Ingresar su Apellido apepat");
	 document.getElementById("apepat").focus();
	 return (false);
	}
	
	if(document.getElementById("apemat").value.length < 3 )
	{
	 alert ("Debe Ingresar su Apellido apemat");
	 document.getElementById("apemat").focus();
	 return (false);
	}
	
	if ((document.datos.email.value.indexOf ('@', 0) == -1)||(document.datos.email.value.indexOf ('.', 0) == -1))
 	{ 
    	alert("Escriba una dirección de correo válida en el campo \"E-mail\"."); 
	    document.datos.email.focus();
	    return false; 
	  }
	
	if(document.getElementById("fecIngreso").value == '')
		{	alert('Ingrese Fecha de Ingreso');
			document.datos.fecIngreso.focus();
			return false; 
		}
		
		
	if(document.getElementById("fecCese").value == '')
		{	alert('Ingrese Fecha de Cese');
			document.datos.fecCese.focus();
			return false; 
		}
		
	if(document.getElementById("pregunta").value == '')
		{	alert('Ingrese una pregunta de seguridad');
			document.datos.pregunta.focus();
			return false; 
		}
	
	if(document.getElementById("respuesta").value == '')
		{	alert('Ingrese una respuesta');
			document.datos.respuesta.focus();
			return false; 
		}
		
		
	return (true);
}

function valida_login()
{
  		
	var cod=document.getElementById("usuario").value;
	//alert(cod);
	var ajax=objetoAjax();
    ajax.open("POST", "../funciones/valida_login.php", true);
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
			{ 	document.getElementById("clave").focus();
			}
			else
			{	alert("Usuario ya existe");
				document.getElementById("usuario").focus();
				document.getElementById("usuario").select();
   			}
        }
    }
}

