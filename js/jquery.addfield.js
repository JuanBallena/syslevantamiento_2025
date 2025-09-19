$(document).ready(function() {
	//ACA le asigno el evento click a cada boton de la clase bt_plus y llamo a la funcion addField
	//OJO lo instancia al leer el documento
	
		$(".bt_plus").each(function (el){
			$(this).bind("click",addField);
									 });
		$(".bt_plus2").each(function (e1){
			$(this).bind("click",addField2);
									 });
		$(".bt_plus3").each(function (e1){
			$(this).bind("click",addField3);
									 });
		$(".bt_plus4").each(function (e1){
			$(this).bind("click",addField4);
									 });
		$(".bt_plus5").each(function (e1){
			$(this).bind("click",addField5);
									 });
		$(".bt_plus6").each(function (e1){
			$(this).bind("click",addField6);
			});
		$(".bt_plus7").each(function (e1){
			$(this).bind("click",addField7);
									 });
		$(".bt_plus8").each(function (e1){
			$(this).bind("click",addField8);
									 });
		$(".bt_plus9").each(function (e1){
			$(this).bind("click",addField9);
			});
	});
//#################################################################################################################################
function addField()
{
	// ID del elemento div quitandole la palabra "linea1_" de delante. Pasi asi poder aumentar el número. Esta parte no es 
	//necesaria pero yo la utilizaba ya que cada campo de mi formulario tenia un autosuggest , así que dejo como seria por si a 
	//alguien le hace falta.
	var clickID = parseInt($(this).parent('div').attr('id').replace('linea1_',''));
	
	//controlamos la cantidad de registros DIV
	if(clickID==10) return false;
	
	// Genero el nuevo numero id
	var newID = (clickID+1);
	
	// Creo un clon del elemento div que contiene los campos de texto
	$newClone = $('#linea1_'+clickID).clone(true);
	
	//Le asigno el nuevo numero id
	$newClone.attr("id",'linea1_'+newID);
	
	//*******************************VERIFICAMOS INPUT VACIOS***************************************
	//var sw=0;
	var i=0; for (i=0;i<=4;i++) 
	{	//selecciono el nombre del elemento
		var cad=$newClone.children('input').eq(i).attr('name');
		//preguntamos si dato es = vacio
		if($newClone.children("input").eq(i).val()=='')	
		{	//alert("Ingrese datos en "+cad);
		}
		//else sw++;
		//if (i==4) break;
	}
	//*******************************VERIFICAMOS SELECT VACIOS***************************************
	//var sw=0;
	var j=0; for (j=0;j<=1;j++) 
	{	//selecciono el nombre del elemento
		var sel=$newClone.children('select').eq(j).attr('name');
		//alert(sel); //aki verifico que este correcto el nombre
		//preguntamos si dato es = vacio
		if($newClone.children("select").eq(j).val()=='')	
		{	//alert("Ingrese datos en "+sel);
		}	
	}
	//***********************************CREAMOS INPUT***********************************************
	//RECORREMOS EL DIV Y SUS INPUT
	var i=0; for (i=0;i<=4;i++) 
	{	//BORRO el valor de todos los campos input(OJO 4 = NRO DE INPUTS)
		$newClone.children("input").eq(i).val('');
		
		//selecciono el nombre del elemento
		var cad=$newClone.children('input').eq(i).attr('name');
		
		//sacamos el ultimo caracter y tomamos un nuevo nombre donde este incluido el "-"
		cad=cad.substring(0,cad.length-1); 
		//alert(cad);
		//Asigno nuevos id
		$newClone.children("input").eq(i).attr("id",cad+newID);
		//asignamos nuevo nombre al elemento
		$newClone.children("input").eq(i).attr("name",cad+newID);
	}
	//***********************************-CREAMOS SELECT**********************************************
	//RECORREMOS SELECT DEL DIV
	var j=0; for (j=0;j<=1;j++) 
	{	//BORRO el valor de todos los campos select(OJO 0-1 = NRO DE INPUTS)
		//$newClone.children('select').eq(j).val('');
		
		//selecciono el nombre del elemento
		var sel=$newClone.children('select').eq(j).attr('name');
		
		//sacamos el ultimo caracter y tomamos un nuevo nombre donde este incluido el "-"
		sel=sel.substring(0,sel.length-1); 
	//	alert(sel)
		//Asigno nuevos id
		$newClone.children('select').eq(j).attr('id',sel+newID);
		//asignamos nuevo nombre al elemento
		$newClone.children('select').eq(j).attr('name',sel+newID);
		
	}
	//*************************************BOTONES****************************************************
	//Cambio el signo "+" por el signo "-" y le quito el evento addfield - para tods los botones
	//VER DATA	$(".bt_plus").val('-'+sel+newID).unbind("click",addField);
	$(".bt_plus").val('-').unbind("click",addField);
	//$(".bt_plus").val('-').unbind("click",addField);
	
	//Ahora le asigno el evento delRow para que borre la fial en caso de hacer click
	$(".bt_plus").bind("click",delRow);
	
	//Inserto el div clonado y modificado despues del div original
	$newClone.insertAfter($('#linea1_'+clickID));	
	
	//Asigno objeto contador
	datos.contador1.value=newID;	

}//FIN SE addfield()
//--------------------------------------------------------------------------------------------------


function delRow() {
	// Funcion que destruye el elemento actual una vez echo el click
	$(this).parent('div').remove();
	//datos.contador1.value=datos.contador.value-1;
}

//#################################################################################################################################
//#################################################################################################################################
function addField2()
{
	var clickID = parseInt($(this).parent('div').attr('id').replace('linea2_',''));
	//alert(clickID);
	if(clickID==10) return false;
	var newID = (clickID+1);
	$newClone = $('#linea2_'+clickID).clone(true);
	$newClone.attr("id",'linea2_'+newID);

	//***********************************CREAMOS INPUT***********************************************
	var i=0; for (i=0;i<=10;i++) 
	{	$newClone.children("input").eq(i).val('');
		var cad=$newClone.children('input').eq(i).attr('name');
		//alert(cad);
		cad=cad.substring(0,cad.length-1); 
		//alert(cad);
		$newClone.children("input").eq(i).attr("id",cad+newID);
		$newClone.children("input").eq(i).attr("name",cad+newID);
	}
	//***********************************-CREAMOS SELECT**********************************************
	var j=0; for (j=0;j<=3;j++) 
	{	$newClone.children("select").eq(j).val('');
		var sel=$newClone.children('select').eq(j).attr('name');
		//alert(sel);
		sel=sel.substring(0,sel.length-1); 
		$newClone.children("select").eq(j).attr("id",sel+newID);
		$newClone.children("select").eq(j).attr("name",sel+newID);
	}
	//*************************************BOTONES****************************************************
	$(".bt_plus2").val('-').unbind("click",addField2);
	$(".bt_plus2").bind("click",delRow2);
	$newClone.insertAfter($('#linea2_'+clickID));	
	datos.contador2.value=newID;		   

}//FIN SE addfield()

function delRow2() {
	$(this).parent('div').remove();
}

//#################################################################################################################################
//#################################################################################################################################
function addField3()
{
	var clickID = parseInt($(this).parent('div').attr('id').replace('linea3_',''));
	if(clickID==10) return false;
	var newID = (clickID+1);
	$newClone = $('#linea3_'+clickID).clone(true);
	$newClone.attr("id",'linea3_'+newID);

	//***********************************CREAMOS INPUT***********************************************
	var i=0; for (i=0;i<=7;i++) 
	{	$newClone.children("input").eq(i).val('');
		var cad=$newClone.children('input').eq(i).attr('name');
		cad=cad.substring(0,cad.length-1); 
		$newClone.children("input").eq(i).attr("id",cad+newID);
		$newClone.children("input").eq(i).attr("name",cad+newID);
	}
	//***********************************-CREAMOS SELECT**********************************************
	var j=0; for (j=0;j<=3;j++) 
	{	$newClone.children("select").eq(j).val('');
		var sel=$newClone.children('select').eq(j).attr('name');
		sel=sel.substring(0,sel.length-1); 
		$newClone.children("select").eq(j).attr("id",sel+newID);
		$newClone.children("select").eq(j).attr("name",sel+newID);
	}
	//*************************************BOTONES****************************************************
	$(".bt_plus3").val('-').unbind("click",addField3);
	$(".bt_plus3").bind("click",delRow3);
	$newClone.insertAfter($('#linea3_'+clickID));	
	datos.contador3.value=newID;		   

}//FIN SE addfield()

function delRow3() {
	$(this).parent('div').remove();
}

//#################################################################################################################################
//#################################################################################################################################
function addField4()
{
	var clickID = parseInt($(this).parent('div').attr('id').replace('linea4_',''));
	if(clickID==10) return false;
	var newID = (clickID+1);
	$newClone = $('#linea4_'+clickID).clone(true);
	$newClone.attr("id",'linea4_'+newID);

	//***********************************CREAMOS INPUT***********************************************
	var i=0; for (i=0;i<=2;i++) 
	{	$newClone.children("input").eq(i).val('');
		var cad=$newClone.children('input').eq(i).attr('name');
		cad=cad.substring(0,cad.length-1); 
		$newClone.children("input").eq(i).attr("id",cad+newID);
		$newClone.children("input").eq(i).attr("name",cad+newID);
	}
	//***********************************-CREAMOS SELECT**********************************************
	var j=0; for (j=0;j<=0;j++) 
	{	$newClone.children("select").eq(j).val('');
		var sel=$newClone.children('select').eq(j).attr('name');
		sel=sel.substring(0,sel.length-1); 
		$newClone.children("select").eq(j).attr("id",sel+newID);
		$newClone.children("select").eq(j).attr("name",sel+newID);
	}
	//*************************************BOTONES****************************************************
	$(".bt_plus4").val('-').unbind("click",addField4);
	$(".bt_plus4").bind("click",delRow4);
	$newClone.insertAfter($('#linea4_'+clickID));	
	datos.contador4.value=newID;		   

}//FIN SE addfield()

function delRow4() {
	$(this).parent('div').remove();
}

//#################################################################################################################################
//#################################################################################################################################
function addField5()
{
	var clickID = parseInt($(this).parent('div').attr('id').replace('linea5_',''));
	if(clickID==10) return false;
	var newID = (clickID+1);
	$newClone = $('#linea5_'+clickID).clone(true);
	$newClone.attr("id",'linea5_'+newID);

	//***********************************CREAMOS INPUT***********************************************
	var i=0; for (i=0;i<=2;i++) 
	{	$newClone.children("input").eq(i).val('');
		var cad=$newClone.children('input').eq(i).attr('name');
		cad=cad.substring(0,cad.length-1); 
		$newClone.children("input").eq(i).attr("id",cad+newID);
		$newClone.children("input").eq(i).attr("name",cad+newID);
	}
	//***********************************-CREAMOS SELECT**********************************************
	var j=0; for (j=0;j<=0;j++) 
	{	$newClone.children("select").eq(j).val('');
		var sel=$newClone.children('select').eq(j).attr('name');
		sel=sel.substring(0,sel.length-1); 
		$newClone.children("select").eq(j).attr("id",sel+newID);
		$newClone.children("select").eq(j).attr("name",sel+newID);
	}
	//*************************************BOTONES****************************************************
	$(".bt_plus5").val('-').unbind("click",addField5);
	$(".bt_plus5").bind("click",delRow5);
	$newClone.insertAfter($('#linea5_'+clickID));	
	datos.contador5.value=newID;		   

}//FIN SE addfield()

function delRow5() {
	$(this).parent('div').remove();
}

//#################################################################################################################################


//#################################################################################################################################
//#################################################################################################################################

																											//PARA FICHAS ECONOMICAS

function addField6()
{
	var clickID = parseInt($(this).parent('div').attr('id').replace('linea6_',''));
	if(clickID==30) return false;
	var newID = (clickID+1);
	$newClone = $('#linea6_'+clickID).clone(true);
	$newClone.attr("id",'linea6_'+newID);

	
	//***********************************-CREAMOS SELECT**********************************************
	var j=0; for (j=0;j<=0;j++) 
	{	$newClone.children("select").eq(j).val('');
		var sel=$newClone.children('select').eq(j).attr('name');
		sel=sel.substring(0,sel.length-1); 
		$newClone.children("select").eq(j).attr("id",sel+newID);
		$newClone.children("select").eq(j).attr("name",sel+newID);
	}
	//*************************************BOTONES****************************************************
	$(".bt_plus6").val('-').unbind("click",addField6);
	$(".bt_plus6").bind("click",delRow6);
	$newClone.insertAfter($('#linea6_'+clickID));	
	datos.contador1.value=newID;		   

}//FIN SE addfield()

function delRow6() {
	$(this).parent('div').remove();
}

//#################################################################################################################################

function addField7()
{
	var clickID = parseInt($(this).parent('div').attr('id').replace('linea7_',''));
	if(clickID==30) return false;
	var newID = (clickID+1);
	$newClone = $('#linea7_'+clickID).clone(true);
	$newClone.attr("id",'linea7_'+newID);

	//***********************************CREAMOS INPUT***********************************************
	var i=0; for (i=0;i<=6;i++) 
	{	$newClone.children("input").eq(i).val('');
		var cad=$newClone.children('input').eq(i).attr('name');
		cad=cad.substring(0,cad.length-1); 
		$newClone.children("input").eq(i).attr("id",cad+newID);
		$newClone.children("input").eq(i).attr("name",cad+newID);
	}
	//***********************************-CREAMOS SELECT**********************************************
	var j=0; for (j=0;j<=0;j++) 
	{	$newClone.children("select").eq(j).val('');
		var sel=$newClone.children('select').eq(j).attr('name');
		sel=sel.substring(0,sel.length-1); 
		$newClone.children("select").eq(j).attr("id",sel+newID);
		$newClone.children("select").eq(j).attr("name",sel+newID);
	}
	//*************************************BOTONES****************************************************
	$(".bt_plus7").val('-').unbind("click",addField7);
	$(".bt_plus7").bind("click",delRow7);
	$newClone.insertAfter($('#linea7_'+clickID));	
	datos.contador2.value=newID;		   

}//FIN SE addfield()

function delRow7() {
	$(this).parent('div').remove();
}

//#################################################################################################################################
//#################################################################################################################################
function addField8()
{
	var clickID = parseInt($(this).parent('div').attr('id').replace('linea8_',''));
	if(clickID==30) return false;
	var newID = (clickID+1);
	$newClone = $('#linea8_'+clickID).clone(true);
	$newClone.attr("id",'linea8_'+newID);

	//***********************************CREAMOS INPUT***********************************************
	var i=0; for (i=0;i<=4;i++) 
	{	$newClone.children("input").eq(i).val('');
		var cad=$newClone.children('input').eq(i).attr('name');
		cad=cad.substring(0,cad.length-1); 
		$newClone.children("input").eq(i).attr("id",cad+newID);
		$newClone.children("input").eq(i).attr("name",cad+newID);
	}
	//*************************************BOTONES****************************************************
	$(".bt_plus8").val('-').unbind("click",addField8);
	$(".bt_plus8").bind("click",delRow8);
	$newClone.insertAfter($('#linea8_'+clickID));	
	datos.contador8.value=newID;		   

}//FIN SE addfield()

function delRow8() {
	$(this).parent('div').remove();
}

//#################################################################################################################################
//#################################################################################################################################
function addField9()
{
	var clickID = parseInt($(this).parent('div').attr('id').replace('linea9_',''));
	if(clickID==30) return false;
	var newID = (clickID+1);
	$newClone = $('#linea9_'+clickID).clone(true);
	$newClone.attr("id",'linea9_'+newID);

	//***********************************CREAMOS INPUT***********************************************
	var i=0; for (i=0;i<=8;i++) 
	{	$newClone.children("input").eq(i).val('');
		var cad=$newClone.children('input').eq(i).attr('name');
		cad=cad.substring(0,cad.length-1); 
		$newClone.children("input").eq(i).attr("id",cad+newID);
		$newClone.children("input").eq(i).attr("name",cad+newID);
	}
	
	//*************************************BOTONES****************************************************
	$(".bt_plus9").val('-').unbind("click",addField9);
	$(".bt_plus9").bind("click",delRow9);
	$newClone.insertAfter($('#linea9_'+clickID));	
	datos.contador9.value=newID;		   

}//FIN SE addfield()

function delRow9() {
	$(this).parent('div').remove();
}