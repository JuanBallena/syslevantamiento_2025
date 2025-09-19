<?php
//$ficha=$_GET['ind'];
include 'configuracion/eventos.php';
//include 'model/search_codigo_catrastral.php';
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="reportes/assets/images/favicon.ico">
<title>Búsqueda de Fichas Catastrales</title>
<link rel="stylesheet" type="text/css" href="reportes/assets/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="reportes/assets/css/estilos.css"/>
  
  <script type="text/javascript" src="js/funciones_validar.js"></script>

<script type="text/javascript" language="javascript" src="js/nueva_apertura.js"></script>
<script type="text/javascript" language="javascript" src="js/funciones_validar.js"></script>

<script type="text/javascript" language="javascript" src="js/no_f5.js"></script>
<script src="http://ie7-js.googlecode.com/svn/version/xx.x/IE8.js" type="text/javascript"></script> 

</head>
<body onKeyDown="javascript:no_f5(this);">

<div class="container">

  <header class="codrops-header">
      <h1 align="center">Sistema de Reportes para Fichas Catastrales 2006-2011</h1>
    </header>

<div class="content">
      <div class="component col-xs-12">
        <section class="row" id="Consulta_Lote">  

        <div align="center">
        <form name="envio" method="post" onsubmit="javascrip: return search_codigo_catrastral()" target="filtro">  
            
          <label class="col-xs-12 text-center" for="dg_sector">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DISTRITO&nbsp;&nbsp;&nbsp;
          SECTOR &nbsp;- &nbsp;&nbsp;MZ &nbsp;&nbsp;-&nbsp;&nbsp;LOTE - &nbsp;UNIDAD</label>  
          
          CÓDIGO CATASTRAL :&nbsp;&nbsp;          

          <input name="distrito" type="text" id="distrito" size="2" maxlength="2" value="01" align="center" />
          <input name="sector" type="text" id="sector" size="2" maxlength="2" <?php echo $N;?>/>
          <input name="mzna" type="text" id="mzna" size="3" maxlength="3" <?php echo $N;?>/>
          <input name="lote" type="text" id="lote" size="2" maxlength="2" <?php echo $N;?>/>
          <input name="unidad" type="text" id="unidad" size="3" maxlength="3" <?php echo $N;?>/>
    
          <label>
          <input class="booton" type="submit" name="enviar" id="enviar" value="Buscar"  />&nbsp;&nbsp;&nbsp;        </label>
            
          <a href="cascade_proceso.php" target="filtro"></a>
          
          <div align="center">
            <br>
            <iframe wmode="opaque" width="1028px" height="40000px" align="middle" name="filtro" scrolling="no" frameborder="0" id="filtro" title="principal">
            </iframe>
          </div>
  
 </form>
 </div>
 </div>
</body>

<script type="text/javascript">

function search_codigo_catrastral()
{ 
  var i; sw=0;
  var sector=document.getElementById("sector").value;
  var mzna=document.getElementById("mzna").value;
  var lote=document.getElementById("lote").value;
  var unidad=document.getElementById("unidad").value;

  document.envio.action="reportes/model/search_codigo_catastral.php?sector="+sector+"&mzna="+mzna+"&lote="+lote+"&unidad="+unidad;     
}

</script>

</html>