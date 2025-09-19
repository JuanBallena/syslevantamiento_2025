<script type="text/javascript" language="javascript" src="../js/funciones_validar.js"></script>
<script type="text/javascript" language="javascript" src="../js/valida_mantenimientos.js"></script>
<script type="text/javascript" language="javascript" src="../js/cascade.js"></script>
<script type="text/javascript" src="../js/no_f5.js"></script>

<?php 
include '../funciones/verifica_ubigeo.php';
include '../funciones/genera_dep.php';
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
<body onKeyDown="javascript:no_f5(this);">
<br>
<form id="newuser" name="newuser" method="post" action="procesos/grabar_notaria.php?pag=<?php echo $cad?>"  onSubmit="return define_notaria()">
<table width="650" border="1" align="center" cellPadding="0" cellSpacing="0" bordercolor="#000000" class="myform">
    <tr>
        <td bgcolor="#0052A4" class="Titulo1"><div align="center" class="Estilo1">NOTARIAS</div></td>
    </tr>
 
    <tr>
        <td><br>
              <table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td>
	<table width="766" border="0" align="center" cellPadding="0" cellSpacing="0" class="tabla">
                <tr>
                    <td>&nbsp;</td>
                </tr>
               
                <tr>
                    <td width="25%" height="24" class="etiqueta">C&Oacute;DIGO DE NOTARIA</td>
                    <td width="41%"><input name="codnot" type="text" size="4" maxlength="5" id="codnot" style="text-transform:uppercase" onKeyPress="return validar_numeros(event)"></td>
                    <td width="34%" rowspan="6"><div align="center"><img src="../img/notaria.png" width="212" height="186"></div></td>
                </tr>
               
                
                <tr>
                  <td class="etiqueta" height="24">DESCRIPCI&Oacute;N</td>
                  <td><p>
                    <input name="nomnot" type="text" id="nomnot" onKeyUp="validar_todo_mayus(this)" size="40" maxlength="50">
                  </p>                  </td>
                </tr>
                <tr>
                	<td class="etiqueta" height="24">Departamento</td>
               	  <td><p>
               	    <?php generaDepartamento(); ?>
               	  </p></td>
                </tr>
                <tr>
					<td class="etiqueta" height="12">Provincia</td>
               	  <td><div >
               	    <label>
                    <select class="select" disabled="disabled" name="provincias" id="provincias" onChange='cargaContenido2(this.id)'>
                      <?php //  <option value="0">Selecciona opci&oacute;n...</option>?>
                    </select>
               	      </label>
               	  </div>               	  </td>
                </tr>
                <tr>
                	<td class="etiqueta" height="12">Distrito</td>
               	  <td><p>
               	    <select disabled="disabled" name="distritos" id="distritos">
                      <?php //  <option value="0">Selecciona opci&oacute;n...</option>?>
                    </select>
               	  </p></td>
                </tr>
                <tr>
                	<td><div align="center"></div>               	  </td>
                    <td><div align="center"><br>
                    </div>
                      <div align="leftr">
                        <input class="booton" type="submit" value="Agregar" name="bAceptar"/>
  &nbsp;&nbsp;
  <input class="booton" type="button" value="Cancelar" name="bCancelar" onClick="location='../form_inicio.php'"/>
  <br>
                    </div></td>
                </tr>
                <tr>
                  <td colspan="3">&nbsp;</td>
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