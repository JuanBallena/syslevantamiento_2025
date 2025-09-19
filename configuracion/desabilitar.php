<script language="javascript"> 
	/* Desactivar tecla F5 del navegador */
	document.onkeydown = function(){
		// F5  
		if(window.event && window.event.keyCode == 116){ 
			window.event.keyCode = 505;  
		} 

		if(window.event && window.event.keyCode == 505){  
			return false;     
		}  
	}  

	/* Verifica si para un boton esta deshabilitado el click drecho del mouse */
	document.onmousedown = function(){
		if (event.button==2) {
			alert ('Este boton esta deshabilitado..')
		}
	}
</script>