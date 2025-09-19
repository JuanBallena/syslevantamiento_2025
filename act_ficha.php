<?php

// $ficha=$_GET['ind'];
include 'configuracion/eventos.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Búsqueda de Fichas Catastrales</title>
<link href="css/estilo_form.css" rel="stylesheet" type="text/css"/>
<link href="css/botones.css" rel="stylesheet" type="text/css"/>

<script type="text/javascript" language="javascript" src="js/nueva_apertura.js"></script>
<script type="text/javascript" language="javascript" src="js/funciones_validar.js"></script>
<script type="text/javascript" language="javascript" src="js/modifica_ficha.js"></script>
<script type="text/javascript" language="javascript" src="js/no_f5.js"></script>
<script src="http://ie7-js.googlecode.com/svn/version/xx.x/IE8.js" type="text/javascript"></script> 
<script type="text/javascript" language="javascript" src="js/edit_fichas.js"></script>

<style type="text/css">
<!--
.Estilo1 {
	color: #FFFFFF;
	font-size: 14px;
	font-weight: bold;
}
.Estilo2 {
	color: #0052A4;
	font-weight: bold;
}
.Estilo3 {
	font-size: 14px
}
.Estilo4 {color: #0052A4; font-weight: bold; font-size: 14px; }
-->
</style>

</head>

<body onKeyDown="javascript:no_f5(this);"><div align="center">

<form name="envio" method="post" onsubmit="javascrip: return modificar_ficha()" target="filtro">
  <table width="1050px" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td>
    <table border="0" class="myform" >
        <tr>
          <td colspan="10" bgcolor="#0052A4"><div align="center">
            <p class="Estilo1">MODIFICACI&Oacute;N DE  FICHA CATASTRAL</p>
            </div></td>
        </tr>
        <tr>
           
        <td height="23" colspan="10">
			    <div class="Estilo2">
            <div align="left">ELIJA FORMA DE BÚSQUEDA&nbsp;:</div>
          </div>			
        </td>
      </tr>
        
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td height="23">&nbsp;</td>
          <td height="23">&nbsp;</td>
          <td>
            <input type="text" style="text-align:left;  border:#D7EBFF; background-color:#D7EBFF; color:#999999;" readonly="readonly" size="2" maxlength="4" value="Año"/>
            <input type="text" style="text-align:center;  border:#D7EBFF; background-color:#D7EBFF;" value="Sector" size="2" maxlength="2" />
            <input type="text" style="text-align:center;  border:#D7EBFF; background-color:#D7EBFF;" value="Mzna" size="3" maxlength="3" />
            <input type="text" style="text-align:center;  border:#D7EBFF; background-color:#D7EBFF;" value="Lote" size="2" maxlength="2" /></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>

        <tr>
            <td width="22"><input type="checkbox" name="forma1" id="forma1" <?php echo $B;?>/></td>
            <td width="118"><div align="left">NÚMERO DE FICHA</div></td>
            
<td width="133">
  <input name="numero" type="text" id="numero" size="5" maxlength="7" onblur="ponerCeros(this)" <?php echo $N;?>/>
</td>
            
            <td width="20" height="23"><input type="checkbox" name="forma2" id="forma2" <?php echo $B;?>/></td>
            <td width="165" height="23"><div align="left">CÓDIGO DE REFERENCIA</div></td>
            <td width="225">
              <input name="anio" type="text" id="anio" style="text-align:center; border:#D7EBFF; background-color:#D7EBFF; color:#999999;" readonly="readonly" size="2" maxlength="4" <?php echo $N;?> value="<?php	$anio=date("Y"); echo $anio;?>"/>
              <input name="sector" type="text" id="sector"  style="text-align:center" size="2" maxlength="2" <?php echo $N;?>/>
              <input name="mzna" type="text" id="mzna" style="text-align:center" size="3" maxlength="3" <?php echo $N;?>/>
              <input name="lote" type="text" id="lote" style="text-align:center" size="3" maxlength="3" <?php echo $N;?>/></td>
            <td width="22"><input type="checkbox" name="forma3" id="forma3" <?php echo $B;?>/></td>
            <td width="204"><div align="left">CÓDIGO ÚNICO CATASTRAL</div></td>
            <td width="45"><input name="cuc8" type="text" id="cuc8" size="6" maxlength="8" <?php echo $N;?>/></td>
            <td width="38"><input name="cuc4" type="text" id="cuc4" size="2" maxlength="4" <?php echo $N;?>/></td>
        </tr>
        
        <tr>
          <td height="23" colspan="10"><div class="Estilo2">
            <div align="left">ELIJA TIPO DE FICHA &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>
          </div></td>
          </tr>
        <tr>
          <td colspan="10"><p align="center"><label> </label>

            <label id="todas" style="display:inline"><input type="radio" name="opt_fichas" value="5" id="opt_fichas_todas"/>TODAS</label>
            <label id="individual" style="display:inline"><input type="radio" name="opt_fichas" value="1" id="opt_fichas_0"/>Ficha INDIVIDUAL</label>
            <label id="cotitular" style="display:inline"><input type="radio" name="opt_fichas" value="2" id="opt_fichas_1"/>Ficha COTITULAR </label>
            <label id="bienes_comunes" style="display:inline"><input type="radio" name="opt_fichas" value="3" id="opt_fichas_3" />
            Ficha ECON&Oacute;MICA</label>
            <label id="economica" style="display:inline"><input type="radio" name="opt_fichas" value="4" id="opt_fichas_4" />
            Ficha BIENES COMUNES</label><br/>
          </p></td>
        </tr>
        
        <tr>
        
        <td colspan="10">
            <div align="center">
              <label><input class="booton" type="submit" name="enviar" id="enviar" value="Buscar"/>&nbsp;&nbsp;&nbsp;</label>
              <label><input class="booton" type="button" name="cancelar" id="cancelar" value="Cancelar"  onclick="location='form_inicio.php'"/></label>
            </div>
          </td>
        </tr>
        
        <tr>

          <td colspan="10"></td>
        
        </tr>
        
        <tr>
          <td colspan="12"><a href="cascade_proceso.php" target="filtro"></a>
            <div align="center"><br>
                <iframe wmode="opaque" width="1028px" height="500px" style="background-color:#FFFFFF" align="middle" name="filtro" scrolling="yes" noresize="noresize" frameborder="0" id="filtro" title="principal"></iframe>
            </div>
          </td>
        </tr>

  	</table>
   
   </td>
  
  </tr>

</table>

</form>
</div>
</body>
</html>
