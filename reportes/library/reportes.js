
	function BuscarFichas(){
		var conexion;

		//# Estado de lectura del codigo referencia catastral
		var BANDERA = 0;

		var SECTOR = document.getElementById("dg_sector").value;
		var MZ = document.getElementById("dg_manzana").value;
		var LOTE = document.getElementById("dg_lote").value;

		var CODIGO_CATASTRAL = SECTOR+MZ+LOTE;
		var PANEL_FICHAS_CATASTRALES = document.getElementById("Fichas_Encontradas");

		//console.log("El tamaño del CODIGO_CATASTRAL ingresado es de " + CODIGO_CATASTRAL.length + " caracteres");
		//console.log("Iniciamos el envio de datos con ajax...");

		if(window.XMLHttpRequest){
		// code for IE7+, Firefox, Chrome, Opera, Safari
		conexion = new XMLHttpRequest();
		}
		else{
			// code for IE6, IE5
			conexion = new ActiveXObject("Microsoft.XMLHTTP");
		}

		conexion.onreadystatechange=function(){
		  	if (conexion.readyState==4 && conexion.status==200){
		  		//console.log("Recepción de paquetes exitosa...");
		  		PANEL_FICHAS_CATASTRALES.innerHTML = conexion.responseText;
		  		//console.log("Se recibe: <br>"+conexion.responseText);
			}
		};

		conexion.open("POST","Busqueda.php",true);
		conexion.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    	conexion.send("CODIGO_CATASTRAL="+CODIGO_CATASTRAL);
	}