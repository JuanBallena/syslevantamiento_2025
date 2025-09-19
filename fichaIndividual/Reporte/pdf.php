<?php 

//echo getcwd();
# Cargamos la librería dompdf.
include('..\..\librerias\dompdf\dompdf_config.inc.php');
//echo getcwd();
# Contenido HTML del documento que queremos generar en PDF.
 ob_start();
//include('rpt_individual.php');
include('rpt_individual.php');
 
$html=ob_get_clean();
# Instanciamos un objeto de la clase DOMPDF.
$mipdf = new DOMPDF();
 
# Definimos el tamaño y orientación del papel que queremos.
# O por defecto cogerá el que está en el fichero de configuración.
//ini_set("memory_limit","32M");   

ini_set("memory_limit","80M");   

//$mipdf ->set_paper('a4','landscape'); #horizontal

$mipdf ->set_paper('a4','letter'); #vertical
 

////////////$paper_size = array(0,0,360,360);
////////////$mipdf ->set_paper($paper_size);


# Cargamos el contenido HTML.
$mipdf ->load_html($html);
 
# Renderizamos el documento PDF.
$mipdf ->render();
 
# Enviamos el fichero PDF al navegador.
//$mipdf ->stream('LISTA DE ALUMNOS.pdf');#Descargar Pdf
//$mipdf ->stream('REPORTE DE FICHAS INDIVIDUALES.pdf',array('Attachment'=>0));#Previzualizar
$mipdf ->stream('FicheroEjemplo.pdf');
//exit();
?>