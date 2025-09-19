<?php  
include '../funciones/verifica_ubigeo.php';
include 'procesos/cmb_via.php';
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
<form id="newuser" name="newuser" method="post" action="procesos/grabar_via.php?pag=<?php echo $cad?>">
<table width="650" border="1" align="center" cellPadding="0" cellSpacing="0" bordercolor="#000000" class="myform">
    <tr>
        <td bgcolor="#0052A4" class="Titulo1"><div align="center" class="Estilo1">DATOS DE  V&Iacute;AS</div></td>
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
                    <td width="14%" class="etiqueta">C&Oacute;DIGO DE V&Iacute;A</td>
                    <td width="30%"><input name="codvia" type="text" size="7" maxlength="6" id="codvia" style="text-transform:uppercase" <?php echo $N.' '.$seis;?>></td>
                </tr>
               
                <tr>
                    <td height="24" class="etiqueta">&nbsp;</td>
                    <td height="24" class="etiqueta">TIPO DE V&Iacute;A</td>
                    <td><?php generaCombo(1); ?></td>
                </tr>
                <tr>
                  <td height="24" class="etiqueta">&nbsp;</td>
                  <td height="24" class="etiqueta">NOMBRE DE VÍA</td>
                  <td><p>
                    <input name="nomvia" type="text" size="40" id="nomvia" <?php echo $M;?>>
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