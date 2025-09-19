<?php 
	# DOMPDF según el tipo de documento a imprimir o la cantidad puede ser muy exigente así que aumentamos la memoria disponible.
	ini_set("memory_limit","50M");

	# Checamos el directorio actual
	//echo getcwd() . "\n";

	# Cargamos la librería dompdf.
	//require_once("../../library/dompdf/dompdf_config.inc.php");
	require_once("library/dompdf/dompdf_config.inc.php");
	 
	# Contenido HTML del documento que queremos generar en PDF.
	ob_start();

	//echo "TIPO FICHA ES: ".$_REQUEST['Tipo'];

	require_once "view/Ficha/BienComun.php";
	//require_once "view/Ficha/Economica.php";
	 
	$html = ob_get_clean();

	# Instanciamos un objeto de la clase DOMPDF.
	$mipdf = new DOMPDF();

	# Definimos el tamaño y orientación del papel que queremos.
	//$mipdf ->set_paper('a4','landscape'); #horizontal
	$mipdf ->set_paper('A4','letter'); #vertical
	 
	# Cargamos el contenido HTML.
	$mipdf ->load_html(utf8_decode($html));
	 
	# Renderizamos el documento PDF.
	$mipdf ->render();
	 
	# Verificamos si no se han enviado "headers" anteriormente. 
	# Mostraremos la linea exacta que presenta el problema de darse el caso.
	$f;
	$l;
	if(headers_sent($f,$l))
	{
	    echo $f,'<br/>',$l,'<br/>';
	    die('Now detect line');
	}
	 
	# Enviamos el fichero PDF al navegador.
	$mipdf ->stream($_SESSION['Ficha'].'.pdf');#Descargar Pdf
	//$nombrearchivo="Ficha_Bienes_Comunes_".date("Y-m-d").".pdf";
	//$mipdf ->stream($nombrearchivo,array('Attachment'=>0));#Previzualizar

	if(isset($_SESSION['Ficha'])) unset($_SESSION['Ficha']);
    if(isset($_SESSION['Lote'])) unset($_SESSION['Lote']);
    if(isset($_SESSION['Tipo'])) unset($_SESSION['Tipo']);

	unset($html);
	unset($mipdf);

	exit();
?>