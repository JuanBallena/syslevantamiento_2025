<script type="text/javascript" language="javascript" src="../js/cascade.js"></script>
<script type="text/javascript" language="javascript" src="../js/funciones_validar.js"></script>
<script type="text/javascript" language="javascript" src="../js/valida_mantenimientos.js"></script>
<link href="../css/combos.css" rel="stylesheet" type="text/css"/>
<link href="../css/estilo_form.css" rel="stylesheet" type="text/css">
<link href="../css/tabla.css" rel="stylesheet" type="text/css">
<link href="../css/botones.css" rel="stylesheet" type="text/css">

<?php 
  include '../configuracion/conexion.php';
  include '../configuracion/constantes.php';
  include '../funciones/genera_dep.php';
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
  "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
  <title>ST-SNCP SECRETARIA TÉCNICA</title>

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
<body>
  <br>
  <form id="institucion" name="institucion" method="post" onSubmit="return define_institucion()">
    <table width="650" border="1" align="center" cellPadding="0" cellSpacing="0" bordercolor="#000000" class="myform">
      <tr>
        <td bgcolor="#003366" ><div align="center" class="Estilo1">CONFIGURACI&Oacute;N DE LA INSTITUCI&Oacute;N</div></td>
      </tr>
   
      <tr>
        <td>
          <br>
          <table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
            <tr>
              <td>
	              <table width="769" border="0" align="center" cellPadding="0" cellSpacing="0" class="tabla">
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
               
                  <tr>
                    <td width="22%" height="24" class="etiqueta">NOMBRE DE INSTITUCI&Oacute;N</td>
                    <td width="52%"><input name="nombre" type="text" size="50" maxlength="50" id="nombre" onKeyPress="return letras(event)" onKeyUp="validar_todo_mayus(this)"></td>
                    <td width="26%" rowspan="7"><div align="center"><img src="../img/municipio.png" width="153" height="136"></div>                      <div align="center"></div>                      <div align="center"></div>                      <div align="center"></div>                      <div align="center"></div>                      <div align="center"></div>                      <div align="center"></div></td>
                  </tr>
               
                  <tr>
                    <td class="etiqueta" height="12">&nbsp;</td>
                    <td><p>&nbsp;</p>                  </td>
                  </tr>

                  <tr>
                  	<td height="24" class="etiqueta"><strong>ELIJA SU UBIGEO</strong></td>
                  	<td><p>Esta configuraci&oacute;n afectar&aacute; al M&oacute;dulo de Fichas</p></td>
                  </tr>

                  <tr>
					          <td class="etiqueta" height="24">DEPARTAMENTO</td>
                  	<td><p><?php generaDepartamento(); ?></p></td>
                  </tr>

                  <tr>
                  	<td class="etiqueta" height="24">PROVINCIA</td>
                  	<td>
                      <p>
                  	    <select disabled="disabled" name="provincias" id="provincias" onChange='cargaContenido2(this.id)'>
                          <?php //  <option value="0">Selecciona opci&oacute;n...</option>?>
                        </select>
                	    </p>
                    </td>
                  </tr>

                  <tr>
                  	<td><p><span class="etiqueta">DISTRITO</span></p></td>
                 	  <td>
                      <select  style="height:20" disabled="disabled" name="distritos" id="distritos">
                        <?php //  <option value="0">Selecciona opci&oacute;n...</option>?>
                      </select>
                    </td>
                  </tr>
                 
                  <tr>
                  	<td><div align="center"></div>               	  </td>
                    <td>
                      <div align="center"><br></div>
                      <div align="left">
                        <input class="booton" type="submit" value="Agregar" name="bAceptar"/>&nbsp;&nbsp;
                        <input class="booton" type="button" value="Cancelar" name="bCancelar" onClick="location='../form_inicio.php'"/><br>
                      </div>
                    </td>
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