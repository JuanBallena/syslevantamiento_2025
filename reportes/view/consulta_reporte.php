<!DOCTYPE html>
<html lang="es" class="no-js">
<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PLANDET | Modulo para Reportes de Fichas Catastrales</title>
	
	<meta name="description" content="Sistema web para Reportes de Fichas Catastrales"/>
	<meta name="author" content="Danny Castillo Sánchez"/>
	<link rel="shortcut icon" href="reportes/assets/images/favicon.ico">
	
	<link rel="stylesheet" type="text/css" href="reportes/assets/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="reportes/assets/css/estilos.css"/>
	
	<script type="text/javascript" src="js/funciones_validar.js"></script>
</head>
<body>
	<div class="container">
		<!-- Top Navigation -->	
		<header class="codrops-header">
			<h1 align="center">Sistema de Reportes para Fichas Catastrales 2011-2016</h1>
		</header>

		<div class="content">
			<div class="component col-xs-12">
				<section class="row" id="Consulta_Lote">             
                    
					<div align="center">
						<label class="col-xs-12 text-center" for="dg_sector">CÓDIGO DE REFERENCIA CATASTRAL</label>
						<label class="col-xs-12 text-center" for="dg_sector">SECTOR - MZ - LOTE</label>

						<input name="dg_sector" type="text" class="2" id="dg_sector" size="2" maxlength="2" onchange='rellenar_campo(this,2); Validar_Sector();' onKeyPress="return validar_numeros(event);"/>
                    	<input name="dg_manzana" type="text" class="2" id="dg_manzana" size="3" maxlength="3" onChange='rellenar_campo(this,3);' onKeyPress="return validar_numeros(event);"/>
                    	<input name="dg_lote" type="text" class="2" id="dg_lote" size="2" maxlength="2" onChange='rellenar_campo(this,2);' onKeyPress="return validar_numeros(event);"/>

                    	<input type="submit" name="buscar_reporte" value="Buscar Ficha" onclick="BuscarFichas();">
                	</div>
					<!--<input class="col-xs-12 col-sm-2 text-center" type="text" id="cod_catastral" name="cod_catastral" placeholder="01-XX-YYY-ZZ" value="" maxlength="9" onkeyup="BuscarFichas();">-->
				</section>
				<br>
				<section class="row">
					<div id="Fichas_Encontradas" class="col-xs-12 col-sm-10 col-sm-offset-1">

					</div>
				</section>
				<br>
			</div>
		</div>
	</div>
</body>
</html>

<script type="text/javascript">
	function BuscarFichas(){
		var conexion;

		//# Estado de lectura del codigo referencia catastral
		var BANDERA = 0;

		var SECTOR = document.getElementById("dg_sector").value;
		var MZ = document.getElementById("dg_manzana").value;
		var LOTE = document.getElementById("dg_lote").value;

		var CODIGO_CATASTRAL = "01"+SECTOR+MZ+LOTE;
		var PANEL_FICHAS_CATASTRALES = document.getElementById("Fichas_Encontradas");

		//console.log("El tamaño del CODIGO_CATASTRAL ingresado es "+CODIGO_CATASTRAL+" de " + CODIGO_CATASTRAL.length + " caracteres");
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

		conexion.open("POST","busqueda.php",true);
		conexion.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    	conexion.send("CODIGO_CATASTRAL="+CODIGO_CATASTRAL);
	}

	function Validar_Sector(){
		var conexion;

		var SECTOR = document.getElementById("dg_sector").value;
		var MZ = document.getElementById("dg_manzana");

		//console.log("El Sector es "+SECTOR);
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
		  		if(conexion.responseText == "Registrado"){
		  			MZ.focus();
		  		}
		  		else{
		  			alert("Sector no existe");
					document.getElementById("dg_sector").focus();
					//datos.dg_sector.select();
					document.getElementById("dg_sector").value="";
					document.getElementById("dg_sector").select();
		  		}
		  		//console.log("Se recibe: "+conexion.responseText);
			}
		};

		conexion.open("POST","reportes/model/Sectores.php",true);
		conexion.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    	conexion.send("SECTOR="+SECTOR);
	}
</script>