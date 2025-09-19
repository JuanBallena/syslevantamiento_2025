function nuevoAjax()
{ 
	/* Crea el objeto AJAX. Esta funcion es generica para cualquier utilidad de este tipo, por
	lo que se puede copiar tal como esta aqui */
	var xmlhttp=false;
	try
	{
		// Creacion del objeto AJAX para navegadores no IE
		xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
	}
	catch(e)
	{
		try
		{
			// Creacion del objet AJAX para IE
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch(E)
		{
			if (!xmlhttp && typeof XMLHttpRequest!='undefined') xmlhttp=new XMLHttpRequest();
		}
	}
	return xmlhttp; 
}

//--------------------------------------------

function invisibles(x,y)
{	
	//alert(x+' '+y);
	x=parseInt(x)
	y=parseInt(y)

	if(x==1)//viene libre, por lo tanto podemos elegir otra ficha
		{	if(y==1)//existen más de dos individuales del mismo predio, por lo tanto podemos elegir 
				{	document.getElementById("economica").style.display = "block";
					document.getElementById("bien_comun").style.display = "block";
					
					
				}
			else
				{	//Cuando existe sólo una ficha individual/ o una en el caso que llegue desde ficha cotitular
					document.getElementById("economica").style.display = "block";
				}
			return false;
		}
}
//---------------------------------------------------------------------------------------------------------------------------------

function seleccionar_ficha()
{	
	var i;
    for (i=0;i<document.envio.opt_fichas.length;i++){
       //alert("contador: "+i);
	   if (document.envio.opt_fichas[i].checked)
          {	break;
			}  
    }
   
	if (document.envio.opt_fichas[i].value==1)	  document.envio.action="fichaIndividual/fichaIndividual.php";
	else if(document.envio.opt_fichas[i].value==2) 
	{	//Es ECONOMICA
		if (confirm('¿El Conductor, es el Titular Catastral?'))
		{ //no se envia nada
			document.envio.action="fichaActividadEconomica/new_economica.php?rpta='0'";
		}
		else
		{	//decimos que si
			document.envio.action="fichaActividadEconomica/new_economica.php?";
		}
	}
	else if(document.envio.opt_fichas[i].value==3) document.envio.action="fichaBienComun/new_biencomun.php?menu='1'";
	else {alert("Elija una ficha para continuar"); return false;}
}

