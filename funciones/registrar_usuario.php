<?php 
include '../configuracion/eventos.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title> ST-SNCP SECRETARIA TECNICA  - Registro de USUARIOS </title>

<script> function cerrarse(){ window.close() } </script>
<script language="JavaScript"  src="../js/popcalendar.js"></script>
<script language="JavaScript"  src="../js/funciones_validar.js"></script>
<script language="JavaScript"  src="../js/valida_usuario.js"></script>
<script language="JavaScript"  src="../js/mascara.js"></script>
<script type="text/javascript" src="../js/no_f5.js"></script>

<link href="../css/estilo_form.css" rel="stylesheet" type="text/css"/>
<link href="../css/link.css" rel="stylesheet" type="text/css">
<link  href="../css/popcalendar.css" rel="stylesheet" type="text/css">
<link href="../css/tabla.css" rel="stylesheet" type="text/css">
<link href="../css/botones.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.Estilo4 {color: #003998}
-->
</style>
</head>

<body onKeyDown="javascript:no_f5(this);" >
<br>
<table width="85%" border="1" align="center" cellPadding="0" cellSpacing="0" bordercolor="#000000" class="myform" >
    <tr>
        <td bgcolor="#0052A4" ><div align="center" class="encabezado">REGISTRO DE USUARIOS</div></td>
    </tr>

    <tr>
        <td><br>
          <form  class="myform" name="datos" method="post" action="../valida/valida_usuario.php" onSubmit="javascript:return valida_new_usuario();">
            <table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
              <tr>
                <td>
                    <table width="98%" align="center" cellPadding="0" cellSpacing="0" class="tabla">
                            <tr>
                                <td>&nbsp;</td>
                                <td colspan="2">&nbsp;</td>
                                <td width="19%">&nbsp;</td>
                                <td width="9%">&nbsp;</td>
                            </tr>
                            <tr>
                                <td width="28%" height="24" class="link Estilo4">USUARIO</td>
                                <td width="15%"><input name="usuario" type="text" size="15" maxlength="15" id="usuario" onBlur="javascript:valida_login();"/> </td>
                                <td width="29%"><input name="idusu" type="hidden" id="idusu" /></td>
                                <td rowspan="11"><div align="center"><img src="../img/icon_users.png" width="201" height="256"></div>                      <div align="center"></div></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td height="24" class="link Estilo4">CLAVE</td>
                                <td colspan="2">
                                    <input  name="clave" type="password" value="" size="45" ></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="etiqueta" height="24">NOMBRES</td>
                                <td colspan="2">
                                    <input  name="nombres" type="text" value="" size="45" <?php echo $M;?>/> </td>
                                <td>&nbsp;</td>
                            </tr>
                             <tr>
                                <td class="etiqueta" height="24">APELLIDO PATERNO</td>
                                <td colspan="2">
                                    <input  name="apepat" type="text" value="" size="45" <?php echo $M;?>/> </td>
                                <td>&nbsp;</td>
                            </tr>
                              <tr>
                                <td class="etiqueta" height="24">APELLIDO MATERNO</td>
                                <td colspan="2">
                                    <input  name="apemat" type="text" value="" size="45" <?php echo $M;?>/> </td>
                                <td>&nbsp;</td>
                            </tr>
                             <tr>
                                <td class="etiqueta" height="24">E-MAIL</td>
                                <td colspan="2">
                                    <input  name="email" type="text" value="" size="45" /> </td>
                                <td>&nbsp;</td>
                            </tr>
                             <tr>
                                <td class="etiqueta" height="30">TIPO DE USUARIO</td>
                                <td>
                                  <select id="tipousu" name="tipousu">
                                    <option value="1" selected>ADMINISTRADOR</option>
                                    <option value="2">TECNICO</option>
                                    <option value="3">DIGITADOR</option>
                                    <option value="4">VISUALIZADOR</option>
                                  </select> 
                                </td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                            <td class="tabla" height="24">FECHA DE INGRESO</td>
                               <td colspan="2">
                                        <input  name="fecIngreso" type="text" id="fecIngreso" value="" size="15" maxlength="10" <?php echo $VF;?>/>
                                        &nbsp;<img src="../img/calendarIcon.gif" onClick="popUpCalendar(this, fecIngreso, &quot;dd/mm/yyyy&quot;)" style="cursor:pointer" width="16" height="16" border="0" title="Ingresar Fecha"/></td>
                               <td>&nbsp;</td>
                            </tr>
                            <tr>
                            <td class="etiqueta" height="24">FECHA DE CESE</td>
            
                                   <td colspan="2">
                                            <input  name="fecCese" type="text" id="fecCese" value="" size="15" maxlength="10" <?php echo $VF;?>/>
                                            &nbsp;<img src="../img/calendarIcon.gif" onClick="popUpCalendar(this, fecCese, &quot;dd/mm/yyyy&quot;)" style="cursor:pointer" width="16" height="16" border="0" title="Ingresar Fecha"/></td>
                                   <td>&nbsp;</td>
                            </tr>
                             <tr>
                                <td height="20" align="center" class="link Estilo4"><div align="left">Pregunta de seguridad para restablecer la contrase&ntilde;a</div></td>
                                <td height="20" colspan="2" align="center"><div align="left">
                                  <input  name="pregunta" type="text" id="pregunta" value="" size="50" maxlength="10" <?php echo $M;?>/>
                                  <img src="../img/100px-Pregunta.png" width="18" height="18"></div></td>
                                <td height="20" align="center">&nbsp;</td>
                            </tr>
                            <tr >
                                <td>Respuesta</td>
                                <td colspan="2"><input  name="respuesta" type="text" id="respuesta" value="" size="50" maxlength="10" <?php echo $M;?>/></td>
                                <td>&nbsp;</td>
                            </tr>
                             <tr>
                              <td>&nbsp;</td>
                              <td colspan="2">&nbsp;</td>
                            </tr>
                            <tr>
                              <td><div align="center"></div></td>
                              <td colspan="2"><input name="bAceptar" type="submit" class="booton" value="Agregar" />
            &nbsp;&nbsp;
            <input name="bCancelar"  type="button" class="booton" value="Cancelar" onClick="location='../form_inicio.php'"/></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td colspan="2">&nbsp;</td>
                            </tr>
                    </table>
                </td>
              </tr>
            </table>
          </form>
		</td>
    </tr>
</table><br>
</body>
</html>