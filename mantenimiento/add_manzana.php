<?php  
include '../funciones/verifica_ubigeo.php';
include '../configuracion/eventos.php';
include '../funciones/captura_pagina.php';
?>

<script type="text/javascript" language="javascript" src="../js/funciones_validar.js"></script>
<script type="text/javascript" src="../js/no_f5.js"></script>
<script type="text/javascript" src="../js/_codigoReferenciaCatastral.js"></script>
<script type="text/javascript" src="../contexts/ficha_individual/_helper.js"></script>
<script type="text/javascript" src="../contexts/ficha_individual/_dataSelect.js"></script>


<script> function cerrarse(){ window.close() } </script>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title> ST-SNCP SECRETARIA T�CNICA </title>
<link href="../css/estilo_form.css" rel="stylesheet" type="text/css">
<link href="../CSS/tabla.css" rel="stylesheet" type="text/css">
<link href="../CSS/botones.css" rel="stylesheet" type="text/css">
<script src="https://unpkg.com/@ruffle-rs/ruffle"></script>
<style type="text/css">
<!--
.Estilo1 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
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
<body onKeyDown="javascript:no_f5(this);">
  <object data="fuentes/introsis.swf" 
          type="application/x-shockwave-flash" 
          width="1200" height="600">
  </object>
<br>
<form id="newuser" name="newuser" method="post" action="procesos/grabar_manzana.php?pag=<?php echo $cad?>">
<table width="650" border="1" align="center" cellPadding="0" cellSpacing="0" bordercolor="#000000" class="myform">
    <tr>
        <td bgcolor="#0052A4" class="Titulo1"><div align="center" class="Estilo1">DATOS DE MANZANAS</div></td>
    </tr>
 
    <tr>
        <td><br>
              <table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td>
	<table width="99%" border="0" align="center" cellPadding="0" cellSpacing="0" class="tabla">
        <tr>
                    <td colspan="2">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td width="12%" rowspan="7"><div align="center"></div></td>
                    <td width="35%" rowspan="7"><img src="../img/vias.jpg" width="329" height="215"></td>
        </tr>
               
                <tr>
                    <td width="9%" height="24" class="etiqueta">&nbsp;</td>
                    <td width="14%" class="etiqueta">C&Oacute;DIGO DE MANZANA</td>
                    <td width="30%"><input name="codmanzana" type="text" size="7" maxlength="6" id="codmanzana" style="text-transform:uppercase" <?php echo $N.' '.$seis;?>></td>
                </tr>
               
               <div>
                <label class="">SECTOR</label>
                <div class="a-autocomplete">
                  <input
                    type="text"
                    class="a-input-text input-text-codigo-sector"
                    placeholder="Escriba"
                    tabindex="1"
                  />
                  <input type="hidden" name="codigo_sector" class="input-hidden-codigo-sector" />
                  <div
                    id="autocompletado-contenedor-sectores"
                    class="a-autocomplete__box none"
                    onmousedown="event.preventDefault()"
                  >
                    <ul
                      class="a-autocomplete__items cursor-pointer"
                      id="autocompletado-lista-sectores"
                    ></ul>
                  </div>
                </div>
              </div>

                <tr>
                  <td height="24" class="etiqueta">&nbsp;</td>
                  <td height="24" class="etiqueta">NRO MANZANA</td>
                  <td><p>
                    <input name="nromanzana" type="text" size="40" id="nromanzana" <?php echo $M;?>>
                  </p>                  </td>
                </tr>
                         <tr>
					<td height="12" colspan="2" class="etiqueta">&nbsp;</td>
               	  <td><p>&nbsp;</p></td>
                </tr>
                <tr>
                	<td height="12" colspan="2" class="etiqueta">&nbsp;</td>
               	  <td><p>&nbsp;</p></td>
                </tr>
               
               
                <tr>
                	<td colspan="2"><div align="center"></div></td>
                    <td><div align="center">
                      <input class="booton" type="submit" value="Agregar" name="bAceptar"/>
  &nbsp;&nbsp;
  <input class="booton" type="button" value="Cancelar" name="bCancelar" onClick="location='../form_inicio.php'"/>
                    </div>
                    <br></td>
                </tr>
            </table>
	</td>
  </tr>
</table>
              
          <br>

        </td>
    </tr>
</table>
</form>
</body>
</html>