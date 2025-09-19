// JavaScript Document
function no_f5()
{	
	e= (window.event)? event : e;
	tecla= (e.keyCode)? e.keyCode: e.which;
	//var tecla=window.event.keyCode;
	if (tecla==116) 
	{
		//alert("F5 deshabilitado!"); 
		event.keyCode=0;
		event.returnValue=false;
	}
}