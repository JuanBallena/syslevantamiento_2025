<?php session_start();

//recibimos nombre de página para el caso de VERIFICACION E INSERCION
$ficha=$_GET['libre'];
$existe=$_GET['existe'];
//$cotitular=$_GET['cotitular'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php //echo "<meta http-equiv='refresh' content='1;url=http://".$_SERVER['HTTP_HOST']."/mofica/aperturas.php'/>"; ?>
<title>Apertura de Ficha</title>
<link href="css/estilo_form.css" rel="stylesheet" type="text/css"/>
<link href="css/botones.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="js/nueva_apertura.js"></script>
<script type="text/javascript" language="javascript" src="js/no_f5.js"></script>

<style type="text/css">
<!--
.Estilo1 {
	color: #FFFFFF;
	font-size: 14px;
	font-weight: bold;
}
-->
</style>
</head>

<?php echo "<body onload='javascript: return invisibles($ficha,$existe)' onKeyDown='javascript:no_f5(this);'><div align='center'>"; ?>

<form name="envio" method="post"  onSubmit="javascrip: return seleccionar_ficha()">
  <table width="50%" border="1" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td>
    <table class="myform" width="680" border="0" align="center">
    <tr>
      <td bgcolor="#0052A4"><div align="center">
        <p class="Estilo1">¿Desea aperturar Ficha?</p>
        </div></td>
    </tr>
    <tr>
      <td>        <p align="center">
          <label>
          		<!-- OCULTAMOS RADIO COTITULAR -->
	            <label id="individual" style="display:none">
                  <input type="radio" name="opt_fichas" value="1" id="opt_fichas_1" />
                  Ficha INDIVIDUAL</label>
                </label>
                                                
                <label id="economica" style="display:none">
                  <input type="radio" name="opt_fichas" value="2" id="opt_fichas_2" onfocus="" />
                   Ficha ECONÓMICA
                 </label>
                 
                 <label id="bien_comun" style="display:none">
                  <input type="radio" name="opt_fichas" value="3" id="opt_fichas_3" />
                   Ficha BIEN COMÚN
                 </label>
          <br />
      </p></td>
    </tr>
    <tr>
      <td><div align="center">
        <label>
        <input class="booton" type="submit" name="enviar" id="enviar" value="Aperturar" />
&nbsp;&nbsp;&nbsp;        </label>
        <label>
         <input class="booton" type="button" name="cancelar" id="cancelar" value="Cancelar"  onClick="location='fichaIndividual/new_individual.php'"/>
        </label>
      </div></td>
    </tr>
    <tr>
      <td>
     </td>
    </tr>
  </table>
    </td>
  </tr>
</table>
 </form>

</body></div>
</html>
