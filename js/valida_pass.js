//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ CONFIRMACION DE CLAVE $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
//verificamos que ambas coincidan
function conformidad_clave(e)
{
var i,v;

 i=e.value;
 v=document.getElementById("new_pass").value;
  if(i!=v)
 	{
	alert("No hay coincidencia!");
	document.getElementById("new_pass").focus();
	document.getElementById("new_pass").select();
 	}
}

//validamos nueva clave no vacia
function novaciopass(e)
{

if(e)
 {
	if(e.length < 6)
		{	alert('Ingrese minimo 6 caracteres');
			exit();
		}

	if(e.value.length<=0)
 	{
	// document.getElementById(i).style.visibility=v;
	alert("Ingrese una Constraseña");
	document.getElementById("new_pass").focus();
	document.getElementById("new_pass").select();
 	}
 }
}

//recuperando clave
function ValidarDatos()
	{	var a=document.getElementById("new_pass").value;
		var b=document.getElementById("ver_pass").value;
		var c=document.getElementById("pregunta").value;
		var d=document.getElementById("respuesta").value;
		var sw=0;
		if(a == '')
		{	alert('Ingrese Contraseña');
			sw=1;
			
		}
		if(a.length < 6)
		{	alert('Ingrese minimo 6 caracteres');
			sw=1;
			
		}

		if(a != b)
		{	alert('Clave y confirmacion no coinciden');
			sw=1;
		
		}

		if(c == '')
		{	alert('Ingrese una pregunta de seguridad');
			sw=1;
		
		}
		
		if(d == '')
		{	alert('Ingrese una respuesta');
			sw=1;
			
		}

		if(sw==1)
		{	document.getElementById("capa_oculta").style.display = "block";
			return false;
		}
		else{
			pregunta();
			}
	
}

function pregunta(){
    if (confirm('¿Estas seguro de enviar este formulario?'))
	{ //pasa}
	}
	else
	{	//recuperamos el action del formulario
		var id=document.getElementById("idusu").value;
		document.recupera.action="../funciones/recuperar_password.php?id="+id;
	}
} 
//--------------------------------------------------------------------------------------------------