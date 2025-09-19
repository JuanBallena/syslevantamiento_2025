// FUNCION PARA IMPRIMIR

function doPrint(theForm) {
var i;

for(i=0; i<theForm.elements.length; i++) {
// Agregar en esta lista de condiciones
// todos aquellos tipos de Input que se quieren ocultar
       if( (theForm.elements[i].type == "submit") ||(theForm.elements[i].type == "reset") ||(theForm.elements[i].type == "button") )
	   theForm.elements[i].style.visibility = 'hidden';
}
window.print();
	for(i=0; i<theForm.elements.length ; i++) {
		if( (theForm.elements[i].type == "submit") ||
		(theForm.elements[i].type == "reset") || (theForm.elements[i].type == "button") )
		theForm.elements[i].style.visibility = 'visible';
	} 
return false;

} 
