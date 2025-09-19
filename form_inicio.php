<?php
session_start();

// Limpiamos variables de sesión innecesarias
unset($_SESSION['nro_cotitulares'], $_SESSION['cuc8'], $_SESSION['cuc4'],
    $_SESSION['sector'], $_SESSION['manzana'], $_SESSION['lote'],
    $_SESSION['edifica'], $_SESSION['entrada'], $_SESSION['piso'],
    $_SESSION['unidad'], $_SESSION['ic_condicion'], $_SESSION['ic_estado'],
    $_SESSION['dc']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="iso-8859-1" />
  <title>Formulario</title>
  <!-- Ruffle para emular Flash -->
  <script src="https://unpkg.com/@ruffle-rs/ruffle"></script>
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      background: #f0f0f0;
    }
  </style>
</head>
<body>
  <!-- Animación SWF -->
  <object data="fuentes/introsis.swf" 
          type="application/x-shockwave-flash" 
          width="1200" height="600">
  </object>
</body>
</html>



<?php
// session_start();

//MATAMOS SESIONES DE CODIGO REFERENCIAL
// unset($_SESSION['nro_cotitulares']);
// unset($_SESSION['cuc8']);
// unset($_SESSION['cuc4']);
// unset($_SESSION['sector']);
// unset($_SESSION['manzana']);
// unset($_SESSION['lote']);
// unset($_SESSION['edifica']);
// unset($_SESSION['entrada']);
// unset($_SESSION['piso']);
// unset($_SESSION['unidad']);

// unset($_SESSION['ic_condicion']);
// unset($_SESSION['ic_estado']);
// unset($_SESSION['dc']);
?>
<!-- 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Formulario</title>
	<script src="js/AC_RunActiveContent.js" type="text/javascript"></script>
  <script src="https://unpkg.com/@ruffle-rs/ruffle"></script>

</head>

<body>
	<div align="center"> 
		<script type="text/javascript">
			AC_FL_RunContent('codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0','width','1200','height','600','src','archivo','quality','high','pluginspage','http://www.macromedia.com/go/getflashplayer','movie','fuentes/introsis','wmode','opaque' ); //end AC code
		</script> -->

    <!-- <object type="application/x-shockwave-flash" data="fuentes/introsis.swf" width="1200" height="600"></object> -->
		<!-- <noscript>
			<div align="center">
			  	<table width="100%" border="0">
				    <tr>
				      	<td>
					      	<div align="center">
						        <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="1200" height="600">
						          <param name="movie" value="fuentes/introsis.swf" />
						          <param name="quality" value="high" />
						          <param name="wmode" value="opaque"/>
						          <embed src="archivo.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="589" height="287"></embed>
						        </object>
					      	</div>
				      	</td>
				    </tr>
			  	</table>
			</div>
		</noscript>
	</div>
</body>
</html> -->