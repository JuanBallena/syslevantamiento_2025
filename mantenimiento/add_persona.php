<?php  
include '../funciones/verifica_ubigeo.php';
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
<form id="newuser" name="newuser" method="post" action="procesos/grabar_persona.php?pag=<?php echo $cad?>">
<table width="650" border="1" align="center" cellPadding="0" cellSpacing="0" bordercolor="#000000" class="myform">
    <tr>
        <td bgcolor="#0052A4" class="Titulo1"><div align="center" class="Estilo1">DATOS DE PERSONAL </div></td>
    </tr>
 
    <tr>
        <td><br>
              <table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td>
	<table width="849" border="0" align="center" cellPadding="0" cellSpacing="0" class="tabla">
                <tr>
                    <td>&nbsp;</td>
                </tr>
               
                <tr>
                    <td width="20%" height="24" class="etiqueta">TIPO DOCUMENTO</td>
                    <td width="39%"><select name="tipodoc" id="tipodoc">
                      <option value="02">DNI</option>
                      <option value="08">LIBRETA MILITAR</option>
                    </select></td>
                    <td width="41%" rowspan="9"><div align="center"><img src="../img/PERSONAS.png" width="271" height="181"></div></td>
                </tr>
               
                <tr>
                    <td class="etiqueta" height="24">N&Uacute;MERO DE DOCUMENTO</td>
                    <td><input name="numdoc" type="text" size="13" maxlength="17" id="numdoc" style="text-transform:uppercase" onKeyPress="return validar_numeros(event)"></td>
                </tr>
                <tr>
                  <td class="etiqueta" height="24">NOMBRES</td>
                  <td><p>
                    <input name="nombre" type="text" size="40" id="nombre" onKeyPress="return letras(event)" onKeyUp="validar_todo_mayus(this)">
                  </p>                  </td>
                </tr>
                <tr>
                  <td class="etiqueta" height="24">APELLIDO PATERNO</td>
                  <td><p>
                    <input name="paterno" type="text" size="40" id="paterno" onKeyPress="return letras(event)" onKeyUp="validar_todo_mayus(this)">
                  </p>                  </td>
                </tr>
                <tr>
                  <td class="etiqueta" height="24">APELLIDO MATERNO</td>
                  <td><p>
                    <input name="materno" type="text" size="40" id="materno" onKeyPress="return letras(event)" onKeyUp="validar_todo_mayus(this)">
                  </p>                  </td>
                </tr>
                         <tr>
					<td class="etiqueta" height="12">&nbsp;</td>
               	  <td><p>&nbsp;</p></td>
                </tr>
                <tr>
                	<td class="etiqueta" height="12">FUNCI&Oacute;N</td>
               	  <td><p>
               	    <label>
               	    <select name="funcion" id="funcion">
               	      <option value="2">SUPERVISOR</option>
               	      <option value="3">T&Eacute;CNICO</option>
               	      <option value="4">VERIFICADOR</option>
             	      </select>
               	    </label>
               	  </p></td>
                </tr>
                 <tr>
                  <td class="etiqueta" height="15">&nbsp;</td>
                  <td><p>&nbsp;</p>                  </td>
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