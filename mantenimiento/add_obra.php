<script type="text/javascript" language="javascript" src="../jquery/cascade.js"></script>
<script type="text/javascript" language="javascript" src="../jquery/funciones_validar.js"></script>
<script type="text/javascript" src="../js/no_f5.js"></script>
<?php 
include '../funciones/verifica_ubigeo.php';
include '../funciones/captura_pagina.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />

<title> ST-SNCP SECRETARIA TÉCNICA </title>
<script> function cerrarse(){ window.close() } </script>
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
<form id="newobra" name="newobra" method="post" action="procesos/grabar_obra.php?pag=<?php echo $cad?>">
<table width="650" border="1" align="center" cellPadding="0" cellSpacing="0" bordercolor="#000000" class="clsTabla2">
    <tr>
        <td bgcolor="#0052A4" class="Titulo1"><div align="center" class="Estilo1">OBRAS / INSTALACIONES</div></td>
    </tr>
 
    <tr>
        <td><br>
              <table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td>
	<table width="620" border="0" align="center" cellPadding="0" cellSpacing="0" class="tabla">
                <tr>
                    <td>&nbsp;</td>
                </tr>
               
                <tr>
                    <td width="33%" height="24" class="etiqueta">C&Oacute;DIGO OBRA / INSTALACION</td>
                    <td width="67%"><input name="codobra" type="text" size="4" maxlength="4" id="codobra" style="text-transform:uppercase" onKeyPress="return validar_numeros(event)"></td>
                </tr>
               
                
                <tr>
                  <td class="etiqueta" height="24">DESCRIPCI&Oacute;N</td>
                  <td><p>
                    <input name="descri" type="text" id="descri" onKeyUp="validar_todo_mayus(this)" size="40" maxlength="100">
                  </p>                  </td>
                </tr>
                <tr>
                	<td class="etiqueta" height="13">MATERIAL</td>
               	  <td><p>
               	    <input name="mate" type="text" id="mate" onKeyUp="validar_todo_mayus(this)" size="40" maxlength="100">
               	  </p></td>
                </tr>
                <tr>
					<td class="etiqueta" height="12">UNIDAD</td>
               	  <td><p>
               	    <input name="uni" type="text" id="uni" onKeyUp="validar_todo_mayus(this)" size="40" maxlength="100">
               	  </p></td>
                </tr>
                <tr>
                	<td class="etiqueta" height="12">&nbsp;</td>
               	  <td><p>&nbsp;</p></td>
                </tr>
                <tr>
                	<td colspan="2"><div align="center">
  <input class="booton" type="submit" value="Agregar" name="bAceptar"/>
  &nbsp;&nbsp;
                	  <input class="booton" type="button" value="Cancelar" name="bCancelar" onClick="location='../forminicial.php'"/>
              	  </div><BR></td>
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