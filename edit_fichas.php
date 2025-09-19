<?php
// se modificó para evitar undefined index
//$ficha=$_GET['ind'];
if (isset($_GET['ind']))
  {
    $ficha=$_GET['ind'];
  }


include 'funciones/kill_sesion.php'; //matamos sesiones existentes de codigo referencial
include("configuracion/conexion.php");
include("configuracion/constantes.php");
include 'configuracion/eventos.php';
include 'fichaindividual/proceso_ind/I_combos.php';
  
   /*echo "<script>alert('$ubigeo');</script>\n"; */


?>

<link href="css/combos.css" rel="stylesheet" type="text/css">

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>Búsqueda de Fichas Catastrales</title>
<!--<link href="css/estilo_form.css" rel="stylesheet" type="text/css"/>-->
      <link href="css/botones.css" rel="stylesheet" type="text/css"/>

      <script type="text/javascript" language="javascript" src="js/nueva_apertura.js"></script>
      <script type="text/javascript" language="javascript" src="js/funciones_validar.js"></script>
      <script type="text/javascript" language="javascript" src="js/edit_fichas.js"></script>
      <script type="text/javascript" language="javascript" src="js/no_f5.js"></script>

      <script src="http://ie7-js.googlecode.com/svn/version/xx.x/IE8.js" type="text/javascript"></script> 

      <style type="text/css">
      <!--
       .Estilo1 
       {
      	color: #FFFFFF;
      	font-size: 14px;
      	font-weight: bold;
       }
       .Estilo2 
       {
      	color: #0052A4;
      	font-weight: bold;
       }
       .Estilo3 
       {
    	  font-size: 14px
       }
       .Estilo4 
       {
        color: #0052A4; font-weight: bold; font-size: 14px; 
       }
      </style>
  </head>
<body onKeyDown="javascript:no_f5(this);"><div align="center">
<form name="envio" method="post" onsubmit="javascrip: return edit_fichas()" target="filtro">
  <table width="1050px" border="1" cellpadding="0" cellspacing="0">
    <tr>
      <td>
        <table border="0" class="myform" >
          <tr>
            <td colspan="20" bgcolor="#0052A4"><div align="center">
              <p class="Estilo1">IMPRESI&OacuteN DE  FICHAS CATASTRALES</p></div>
            </td>
          </tr>
          <tr>
            <td height="23" colspan="10">
			        <div class="Estilo2">
                <div align="left">ELIJA FORMA DE BÚSQUEDA&nbsp;</div>
              </div>			
            </td>
          </tr>
          <tr>
            <td height="23" colspan="10">
              <div class="Estilo2">
                <div align="left">POR FICHA:</div>
              </div>      
            </td>
          </tr>
          <tr>
            <td width="32">
              <input type="checkbox" name="forma1" id="forma1" <?php echo $B;?>/></td>
            <td width="170">
              <div align="left">#  FICHA</div></td>
            <td width="105">
              <input name="numero" type="text" id="numero" size="5" onblur="ponerCeros(this)" maxlength="7" <?php echo $N;?>/></td>
            <td width="25" height="23">
              <input type="checkbox" name="forma2" id="forma2" <?php echo $B;?>/></td>
            <td width="204" height="23">
              <div align="left">CÓDIGO DE REFERENCIA</div></td>
            <td width="81">
              <input name="referencia" type="text" id="referencia" size="9" maxlength="23" <?php echo $N;?>/></td>
            <td width="32">
              <input type="checkbox" name="forma3" id="forma3" <?php echo $B;?>/></td>
            <td width="264">
              <div align="left">CÓDIGO ÚNICO CATASTRAL</div></td>
            <td width="49">
              <input name="cuc8" type="text" id="cuc8" size="7" maxlength="8" <?php echo $N;?>/></td>
            <td width="49">
              <input name="cuc4" type="text" id="cuc4" size="5" maxlength="4" <?php echo $N;?>/></td>
            <td width="32">
              <input type="checkbox" name="forma4" id="forma4" <?php echo $B;?>/></td>
            <td width="200">
              <div align="left">ESTADO DE LA FICHA</div></td>
            <td width="29%"><?php generaCombo(19); ?></td>
          </tr>
          <tr>
            <td height="23" colspan="10">
              <div class="Estilo2">
                <div align="left">POR UBICACIÓN DEL PREDIO:</div>
              </div>      
            </td>
          </tr>
          <tr>
            <td width="32">
              <input type="checkbox" name="forma5" id="forma5" <?php echo $B;?>/></td>
            <td width="100">
              <div align="left">TIPO DE VÍA</div></td>
            <td width="29%"><?php generaCombo(8); ?></td>
            <td width="25" height="23">
              <input type="checkbox" name="forma6" id="forma6" <?php echo $B;?>/></td>
            <td width="100" height="23">
              <div align="left">TIPO DE PUERTA</div></td>
            <td width="29%"><?php generaCombo(25); ?></td>
            <td width="32">
              <input type="checkbox" name="forma7" id="forma7" <?php echo $B;?>/></td>
            <td width="250">
              <div align="left">TIPO DE HABILITACIONES URBANAS</div></td>
            <td width="29%"><?php generaCombo(37); ?></td>
             <td width="32">
              <input type="checkbox" name="forma12" id="forma12" <?php echo $B;?>/></td>
            <td width="170">
              <div align="left"># SECTORES</div></td>
            <td width="49">
            <input name="sector" type="text" id="sector" size="9" maxlength="2" <?php echo $N;?>/></td>
         </tr>
         <tr>
            <td height="23" colspan="10">
              <div class="Estilo2">
                <div align="left">POR CARACTERÍSTICAS DEL PREDIO:</div>
              </div>      
            </td>
          </tr>
          <tr>
            <td width="32">
              <input type="checkbox" name="forma8" id="forma8" <?php echo $B;?>/></td>
            <td width="100">
              <div align="left">CLASIFICACIÓN DEL PREDIO</div></td>
            <td width="29%"><?php generaCombo(12); ?></td>
            <td width="25" height="23">
              <input type="checkbox" name="forma9" id="forma9" <?php echo $B;?>/></td>
            <td width="100" height="23">
              <div align="left">PREDIO CATASTRAL EN</div></td>
            <td width="29%"><?php generaCombo(13); ?></td>
          </tr>
          <tr>
            <td height="23" colspan="10">
              <div class="Estilo2">
                <div align="left">POR TITULAR CATASTRAL:</div>
              </div>      
            </td>
          </tr>
          <tr>
            <td width="32">
              <input type="checkbox" name="forma10" id="forma10" <?php echo $B;?>/></td>
            <td width="100">
              <div align="left">TIPO DE TITULAR</div></td>
            <td width="29%"><?php generaCombo(3); ?></td>
            <td width="25" height="23">
              <input type="checkbox" name="forma11" id="forma11" <?php echo $B;?>/></td>
            <td width="100" height="23">
              <div align="left">CONDICIÓN DEL TTITULAR</div></td>
            <td width="29%"><?php generaCombo(9); ?></td>
          </tr>
          <tr>
            <td height="23" colspan="10">
              <div class="Estilo2">
                <div align="left">ELIJA TIPO DE FICHA &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>
              </div>
            </td>
          </tr>
          <tr>
            <td colspan="10">          
              <p align="center"><label> </label>
                <label id="individual" style="display:inline">
                  <input type="radio" name="opt_fichas" value="1" id="opt_fichas_0" />Ficha INDIVIDUAL</label>
                <label id="cotitular" style="display:inline">
                  <input type="radio" name="opt_fichas" value="2" id="opt_fichas_1" />Ficha COTITULAR </label>
                <label id="bienes_comunes" style="display:inline">
                  <input type="radio" name="opt_fichas" value="3" id="opt_fichas_3" />Ficha ECON&Oacute;MICA </label>
                <label id="economica" style="display:inline">
                  <input type="radio" name="opt_fichas" value="4" id="opt_fichas_4" />Ficha BIENES COMUNES</label>
                <br />
              </p>
            </td>
          </tr>
          <tr>
            <td colspan="10"><div align="center">
              <label>
                <input class="booton" type="submit" name="enviar" id="enviar" value="Buscar" />
                &nbsp;&nbsp;&nbsp;       
              </label>
              <label>
                <input class="booton" type="button" name="cancelar" id="cancelar" value="Cancelar"  onclick="location='form_inicio.php'"/>
              </label>
              </div>
            </td>
          </tr>
          <tr>
            <td colspan="10">     </td>
          </tr>
          <tr>
            <td colspan="12">
              <div align="center">
                <br><iframe wmode="opaque" width="1050px" height="500px"  style="background-color:#FFFFFF" align="middle" name="filtro" scrolling="not" noresize="noresize" frameborder="0" id="filtro" title="principal"></iframe></div></td>
          </tr>
  	   </table>
      </td>
    </tr>
  </table>
</form>
</div>
</body>
</html>
