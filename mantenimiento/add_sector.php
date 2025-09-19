<?php 
include '../funciones/verifica_ubigeo.php';
include '../funciones/genera_dep.php';
include '../configuracion/eventos.php';
include '../funciones/captura_pagina.php';
?>

<script type="text/javascript" language="javascript" src="../js/funciones_validar.js"></script>
<script type="text/javascript" src="../js/no_f5.js"></script>

<script> function cerrarse(){ window.close() } </script>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title> ST-SNCP SECRETARIA TÉCNICA </title>
<link href="../css/estilo_form.css" rel="stylesheet" type="text/css">
<link href="../CSS/tabla.css" rel="stylesheet" type="text/css">
<link href="../CSS/botones.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.Estilo1 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>
</head>
<body onKeyDown="javascript:no_f5(this);">
<br>
<form id="sector" name="sector" method="post" action="procesos/grabar_sector.php?pag=<?php echo $cad;?>">
<table width="650" border="1" align="center" cellPadding="0" cellSpacing="0" bordercolor="#000000" class="myform">
    <tr>
        <td bgcolor="#0052A4" class="Titulo1"><div align="center" class="Estilo1">SECTORES </div></td>
    </tr>
 
    <tr>
        <td><br>
              <table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td>
	<table width="801" border="0" align="center" cellPadding="0" cellSpacing="0" class="tabla">
                <tr>
                    <td>&nbsp;</td>
                </tr>
               
                <tr>
                    <td width="33%" height="24" class="etiqueta">C&Oacute;DIGO DE SECTOR</td>
                    <td width="67%"><input name="codsector" type="text" size="7" maxlength="2" id="codsector" style="text-transform:uppercase" <?php echo $N.' '.$dos;?>></td>
                    <td width="67%" rowspan="6"><div align="center"><img src="../img/sectores.png" width="264" height="174"></div></td>
                </tr>
               
                
                <tr>
                  <td class="etiqueta" height="24">NOMBRE DE SECTOR</td>
                  <td><p>
                    <input name="nomsector" type="text" size="40" id="nomsector" <?php echo $M;?>>
                  </p>                  </td>
                </tr>
                <tr>
                	<td class="etiqueta" height="12">&nbsp;</td>
               	  <td><p>&nbsp;</p></td>
                </tr>
                <tr>
                	<td class="etiqueta" height="13">&nbsp;</td>
               	  <td><p>&nbsp;</p></td>
                </tr>
                <tr>
                	<td ><p>&nbsp;</p></td>
               	    <td >&nbsp;</td>
           	    </tr>
               
                <tr>
                	<td><div align="center"></div></td>
                    <td><div align="left">
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