<?php session_start();
//$cad='53';
$cad=$_SESSION["id_usuario"];
//echo $cad;
//echo $_SESSION["login"];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<link href="../css/botones.css" rel="stylesheet" type="text/css">
<link href="../CSS/estilo_form.css" rel="stylesheet" type="text/css"/>
<title>Reestablecer contrase&ntilde;a - SNCP</title>
<script type="text/javascript" src="../js/valida_pass.js"></script>
<script type="text/javascript" src="../js/no_f5.js"></script>

<style type="text/css">
<!--
.Estilo1 {
	color: #FFFFFF;
	font-weight: bold;
	font-size:14px;
}
.Estilo2 {color: #FF0000}
.Estilo4 {color: #003366}
-->
</style>
</head>

<body onKeyDown="javascript:no_f5(this);">
<div align="center">
  <p>&nbsp;</p>

<form  name="recupera" method="post" action="procesar/res_pass.php?id=<?php echo $cad;?>" onsubmit="return ValidarDatos()" >
<table width="650" border="2" align="center" cellPadding="0" cellSpacing="0" bordercolor="#000000" class="myform">
    <tr>
        <td bgcolor="#0052A4" class="Titulo1" height="30px"><div align="center" class="Estilo1">RESTABLECER CONTRASE&Ntilde;A</div></td>
    </tr>
 
    <tr>
        <td><table width="900px" border="0"  class="myform">
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td width="28%"><div align="right" class="Estilo1">
        <div align="left" class="Estilo4">Ingrese Nueva Contrase&ntilde;a  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</div>
      </div></td>
      <td width="48%"><label>
        <div align="left">
          <input type="password" name="new_pass" id="new_pass" onblur="javascript:novaciopass(this);"/>
          </div>
      </label></td>
      <td width="24%" rowspan="6"><div align="center"><img src="../img/seguridad.png" width="212" height="212" /></div></td>
    </tr>
    <tr>
      <td><div align="right" class="Estilo1">
        <div align="left" class="Estilo4">Confirmar Nueva Contrase&ntilde;a :</div>
      </div></td>
      <td><label>
        <div align="left">
          <input type="password" name="ver_pass" id="ver_pass" onblur="javascript:conformidad_clave(this);" />
          </div>
      </label></td>
      </tr>
    <tr>
      <td><div align="right" class="Estilo2">
        <div align="left" class="Estilo4">Ingrese una pregunta de seguridad para restablecer la contrase&ntilde;a.</div>
      </div></td>
      <td><label>
        <div align="left">
          <input name="pregunta" type="text" id="pregunta" size="50" />&nbsp;<span class="Estilo2">?</span>        </div>
      </label></td>
      </tr>
    <tr>
      <td class="Estilo2"><div align="left"><strong>Ingrese respuesta</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div></td>
      <td><label>
        <div align="left">
          <input name="respuesta" type="text" id="respuesta" size="50" />
          </div>
      </label></td>
      </tr>
    <tr>
      <td class="Estilo2">&nbsp;</td>
      <td>&nbsp;</td>
      </tr>
    <tr>
      <td class="Estilo2"><input name="idusu" type="hidden" id="idusu" value="<?php echo $cad?>" /></td>
      <td><div align="center">
        <input name="bGuardar" type="submit" class="booton" value="Actualizar" />
      &nbsp;&nbsp;&nbsp;
      <input name="bCancelar" type="button" class="booton" value="Cancelar" onclick="location='../form_inicio.php'"/>
      </div></td>
      </tr>
      <tr>
        <td colspan="8">
          <div align="center">
        <br>
          </div></td>
      </tr>
  </table>
   <br>

        </td>
    </tr>
</table>
  </form>
  	<div id="capa_oculta" style="display: none; color: red">
		**** Debe ingresar correctamente sus datos ***
	</div>
  <p>&nbsp;</p>
</div>
</body>
</html>
