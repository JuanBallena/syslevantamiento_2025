<?php 
//CAPTURAMOS nombre de página para el caso de VERIFICACION E INSERCION
$_SESSION['pagina']=basename($_SERVER["PHP_SELF"]);
$cad=basename($_SESSION['pagina']);
//echo $cad;
?>