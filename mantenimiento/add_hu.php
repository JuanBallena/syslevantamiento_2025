<script type="text/javascript" language="javascript" src="../js/funciones_validar.js"></script>
<script type="text/javascript" language="javascript" src="../js/valida_mantenimientos.js"></script>
<script type="text/javascript" src="../js/no_f5.js"></script>
<?php 
include '../funciones/verifica_ubigeo.php';
include 'procesos/cmb_hu.php';
include '../configuracion/eventos.php';
include '../funciones/captura_pagina.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title> ST-SNCP SECRETARIA TÉCNICA </title>
<script> function cerrarse(){ window.close() } </script>
<link href="../css/estilo_form.css" rel="stylesheet" type="text/css">
<link href="../css/tabla.css" rel="stylesheet" type="text/css">
<link href="../css/botones.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.Estilo1 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>
</head>
<body onKeyDown="javascript:no_f5(this);" >
<br>
<form id="hu" name="hu" method="post" action="procesos/grabar_hu.php?pag=<?php echo $cad?>" onSubmit="return define_hu()">
<table width="650" border="1" align="center" cellPadding="0" cellSpacing="0" bordercolor="#000000" class="myform">
    <tr>
        <td bgcolor="#0052A4" class="Titulo1"><div align="center" class="Estilo1">HABILITACI&Oacute;N URBANA</div></td>
    </tr>
 
    <tr>
        <td><br>
              <table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td>
	<table width="98%" border="0" align="left" cellPadding="0" cellSpacing="0" class="tabla">
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td width="36%" rowspan="7"><div align="center"><img src="../img/hu.png" width="258" height="144"></div></td>
                </tr>
               
                <tr>
                    <td width="23%" height="24" class="etiqueta">C&Oacute;DIGO DE HABILITACI&Oacute;N URBANA</td>
                  <td width="41%"><input name="codhu" type="text" size="4" maxlength="4" id="codhu" style="text-transform:uppercase" <?php echo $N.' '.$cuatro;?>></td>
                </tr>
               
                
                <tr>
                  <td class="etiqueta" height="24">TIPO DE HABILITACI&Oacute;N URBANA</td>
                  <td><p>
                    <?php generaCombo(1); ?>
                  </p>                  </td>
                </tr>
                <tr>
                	<td class="etiqueta" height="13">NOMBRE DE HABILITACI&Oacute;N URBANA</td>
               	  <td><p>
               	    <input name="nomhu" type="text" id="nomhu" size="40" maxlength="100" <?php echo $M;?>>
               	  </p></td>
                </tr>
                <tr>
					<td class="etiqueta" height="12">&nbsp;</td>
               	  <td><p>&nbsp;</p></td>
                </tr>
                <tr>
                	<td class="etiqueta" height="12">&nbsp;</td>
               	  <td><p>&nbsp;</p></td>
                </tr>
                <tr>
                	<td><div align="center"></div><BR></td>
                    <td><input class="booton" type="submit" value="Agregar" name="bAceptar"/>
&nbsp;&nbsp;
<input class="booton" type="button" value="Cancelar" name="bCancelar" onClick="location='../form_inicio.php'"/></td>
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