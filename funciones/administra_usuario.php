<?php session_start();
include '../configuracion/conexion.php';
include '../configuracion/constantes.php';
?>
<link rel="shortcut icon" href="sncp.ico" type="image/x-icon">
<link rel="icon" href="imagenes/sncp.ico" type="image/x-icon" />
<link rel="SNCP" href="imagenes/sncp.ico" />
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<style type="text/css">
<!--
.Estilo20 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>M�DULO DE CONSULTAS DE CUC ASIGNADOS / ST-SNCP</title>
<link href="../css/estilo_form.css" rel="stylesheet" type="text/css">
<link href="../css/tabla.css" rel="stylesheet" type="text/css">
<link href="../css/botones.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="../js/no_f5.js"></script>

<style type="text/css">
<!--
#Layer1 {
	position:absolute;
	left:299px;
	top:12px;
	width:84px;
	height:83px;
	z-index:1;
}
#Layer2 {
	position:absolute;
	left:358px;
	top:97px;
	width:1px;
	height:23px;
	z-index:2;
}
#Layer3 {
	position:absolute;
	left:212px;
	top:97px;
	width:256px;
	height:24px;
	z-index:3;
}
body {
	background-image: url(imagenes/filo.jpg);
}
#Layer4 {
	position:absolute;
	left:498px;
	top:432px;
	width:243px;
	height:56px;
	z-index:4;
	overflow: visible;
}
#Layer5 {
	position:absolute;
	left:845px;
	top:82px;
	width:28px;
	height:28px;
	z-index:4;
}
.Estilo17 {color: #003366; font-size: 10px; font-weight: bold; }
.Estilo18 {color: #003366; font-size: 9px;  }
.Estilo19 {font-size: 12px; color: #003366;}
-->
</style>
</head>

<body onKeyDown="javascript:no_f5(this);">
<div align="center">
  <table width="980" border="1" bgcolor="#FFFFFF" class="myform">
    <tr>
      <td class="" bgcolor="#0052A4"><div align="center" class="Estilo20">CONTROL DE USUARIOS</div></td>
    </tr>
    <tr>
      <td><div align="center">
        <table width="89%" height="106" border="0">
           <tr>
            
            <td width="665" valign="top">
			<?php

            //VALIDO SESION
            if (!isset($_SESSION['login'])) {
                echo "<script>alert('ACCESO RESTRINGIDO!');
   					 document.location.href='../index.php';</script>\n";
            } else {//esta logueado
            }

$BD = new BaseDeDato(SERVIDOR, PUERTO, BD, USUARIO, CLAVE);
$BD->conectar();
$Consulta = "SELECT * FROM tf_usuarios WHERE estado='0'";
$consulta_user = $BD->Consultas($Consulta);
$BD->desconectar();

?>
			
			<table width="900" border="0">
              <tr bgcolor="#BFDFFF">
                <td width="62"  align="center" class="Estilo17"><div align="center">ID</div></td>
                <td width="66" align="center" class="Estilo17"><div align="center">Usuario</div></td>
                <td width="60" align="center" class="Estilo17"><div align="center">Nombres</div></td>
                <td width="75" align="center" class="Estilo17"><div align="center">Ap. Paterno</div></td>
                <td width="60" align="center" class="Estilo17"><div align="center">Ap. Materno</div></td>
                <td width="60" align="center" class="Estilo17"><div align="center">E-mail</div></td>
                <td width="60" align="center" class="Estilo17"><div align="center">Tipo Usuario</div></td>
                <td width="50" align="center" class="Estilo17"><div align="center">Pregunta</div></td>
                <td width="75" align="center" class="Estilo17"><div align="center">Respuesta</div></td>
                <td width="113" align="center" class="Estilo17"><div align="center">ACTIVOS</div></td>
                <td width="43" align="center" class="Estilo17"><div align="center">Grabar ?</div></td>
              </tr>
              <tr><?php
 while ($row = pg_fetch_array($consulta_user)) {

     ?>
               <td ><input readonly="false" style="width:62px" class="Estilo18" type="text" name="email" value="<?php echo $row['id_usuario'];?>"/></td>
               <td><input readonly="false" style="width:66px" class="Estilo18" type="text" name="email" value="<?php echo $row['usuario'];?>"/></td>
               <td class="Estilo18"><input readonly="false" style="width:60px"class="Estilo18" type="text" name="email" value="<?php echo $row['nombres'];?>"/></td>
               <td><input readonly="false" style="width:75px"class="Estilo18" type="text" name="email" value="<?php echo $row['ape_paterno'];?>" /></td>
           <td><input readonly="false" style="width:60px" class="Estilo18" type="text" name="email" value="<?php echo $row['ape_materno'];?>"/></td>
               <td><input style="width:60px" readonly="false" class="Estilo18" type="text" name="email" value="<?php echo $row['email'];?>"/></td>
              <td><input readonly="false" style="width:60px" class="Estilo18" type="text" name="email" value="<?php echo $row['tipo_usuario'];?>"/></td>
             <td><input readonly="false" style="width:50px" class="Estilo18" type="text" name="email" value="<?php echo $row['pregunta'];?>"/></td>
               <td class="Estilo18"><input readonly="false" style="width:75px" class="Estilo18" type="text" name="email" value="<?php echo $row['respuesta'];?>"/></td>
               <td align="center"><?php $sexo1 = 'sexo'.$row['id_usuario'].'_1';
     $sexo2 = 'sexo'.$row['id_usuario'].'_2';
     $name = 'sexo'.$row['id_usuario'];
     /*  echo $sexo1;
      echo $sexo2;
      echo $name; */

     if ($row['estado'] == '0') {?>
  <label><input class="Estilo18" id="sexo<?php echo $row['id_usuario']?>_1" name="<?php echo $row['id_usuario']?>"  disabled="disabled" checked="checked" type="radio" value="1"/><span class="Estilo19">Act</span></label>
  <label><input type="radio" id="sexo<?php echo $row['id_usuario']?>_2" name="sexo<?php echo $row['id_usuario']?>" value="0" />
  		<span class="Estilo19">Des</span></label><?php
     } else {
         ?> 
<label><input class="Estilo18" name="sexo<?php echo $row['id_usuario']?>" id="sexo<?php echo $row['id_usuario']?>_1" type="radio" value="1" />
          <span class="Estilo19">Act</span></label>                                
<label><input type="radio" name="sexo<?php echo $row['id_usuario']?>" id="sexo<?php echo $row['id_usuario']?>_2"  value="1" disabled="disabled" checked="checked"/>
                                  <span class="Estilo19">Des</span></label>
                                  <?php } ?>                    </td><td><div align="center"><a href="admin_habilitar.php?id_usuario=<?php echo $row['id_usuario']; ?>"><img src="../img/onebit_12.png" alt="Guardar estado?" width="16" height="16" border="0"></a><a href="admin_habilitar.php?id_usuario=<?php echo $row['id_usuario']; ?>"></a></div></td>
              </tr>
              <?php
 }?>
            </table>
            </td>
          </tr>
		  <tr>
		  <?php
            $BD = new BaseDeDato(SERVIDOR, PUERTO, BD, USUARIO, CLAVE);
$BD->conectar();
$Consulta = "SELECT * FROM tf_usuarios WHERE estado='1'";
$consulta_user = $BD->Consultas($Consulta);
$BD->desconectar();

?>
			
			<table width="900" border="0">
              <tr bgcolor="#BFDFFF">
                <td width="62"  align="center" class="Estilo17"><div align="center">ID</div></td>
                <td width="66" align="center" class="Estilo17"><div align="center">Usuario</div></td>
                <td width="60" align="center" class="Estilo17"><div align="center">Nombres</div></td>
                <td width="75" align="center" class="Estilo17"><div align="center">Ap. Paterno</div></td>
                <td width="60" align="center" class="Estilo17"><div align="center">Ap. Materno</div></td>
                <td width="60" align="center" class="Estilo17"><div align="center">E-mail</div></td>
                <td width="60" align="center" class="Estilo17"><div align="center">Tipo Usuario</div></td>
                <td width="50" align="center" class="Estilo17"><div align="center">Pregunta</div></td>
                <td width="75" align="center" class="Estilo17"><div align="center">Respuesta</div></td>
                <td width="113" align="center" class="Estilo17"><div align="center">INACTIVOS</div></td>
                <td width="43" align="center" class="Estilo17"><div align="center">Grabar ?</div></td>
              </tr>
              <tr><?php
 while ($row = pg_fetch_array($consulta_user)) {

     ?>
               <td ><input readonly="false" style="width:62px" class="Estilo18" type="text" name="email" value="<?php echo $row['id_usuario'];?>"/></td>
               <td><input readonly="false" style="width:66px" class="Estilo18" type="text" name="email" value="<?php echo $row['usuario'];?>"/></td>
               <td class="Estilo18"><input readonly="false" style="width:60px"class="Estilo18" type="text" name="email" value="<?php echo $row['nombres'];?>"/></td>
               <td><input readonly="false" style="width:75px"class="Estilo18" type="text" name="email" value="<?php echo $row['ape_paterno'];?>"/></td>
           <td><input readonly="false" style="width:60px" class="Estilo18" type="text" name="email" value="<?php echo $row['ape_materno'];?>"/></td>
               <td><input readonly="false" style="width:60px" class="Estilo18" type="text" name="email" value="<?php echo $row['email'];?>"/></td>
              <td><input readonly="false" style="width:60px" class="Estilo18" type="text" name="email" value="<?php echo $row['tipo_usuario'];?>"/></td>
             <td><input readonly="false" style="width:50px" class="Estilo18" type="text" name="email" value="<?php echo $row['pregunta'];?>"/></td>
               <td class="Estilo18"><input readonly="false" style="width:75px" class="Estilo18" type="text" name="email" value="<?php echo $row['respuesta'];?>"/></td>
               <td align="center"><?php $sexo1 = 'sexo'.$row['id_usuario'].'_1';
     $sexo2 = 'sexo'.$row['id_usuario'].'_2';
     $name = 'sexo'.$row['id_usuario'];
     /*  echo $sexo1;
      echo $sexo2;
      echo $name; */

     if ($row['estado'] == '0') {?>
  <label><input class="Estilo18" id="sexo<?php echo $row['id_usuario']?>_1" name="<?php echo $row['id_usuario']?>" type="radio" value="1" checked="checked" /><span class="Estilo19">Act</span></label>
  <label><input type="radio" id="sexo<?php echo $row['id_usuario']?>_2" name="sexo<?php echo $row['id_usuario']?>" value="0" />
  		<span class="Estilo19">Des</span></label><?php
     } else {
         ?> 
<label><input class="Estilo18" name="sexo<?php echo $row['id_usuario']?>" id="sexo<?php echo $row['id_usuario']?>_1" type="radio" value="1"/>
          <span class="Estilo19">Act</span></label>                                
<label><input type="radio" name="sexo<?php echo $row['id_usuario']?>" id="sexo<?php echo $row['id_usuario']?>_2"  value="1" disabled="disabled" checked="checked"/>
                                  <span class="Estilo19">Des</span></label>
                                  <?php } ?>                  </td><td><div align="center"><a href="admin_habilita.php?id_usuario=<?php echo $row['id_usuario']; ?>"><img src="../img/onebit_12.png" alt="Guardar estado?" width="16" height="16" border="0"></a><a href="admin_habilita.php?id_usuario=<?php echo $row['id_usuario']; ?>"></a></div></td>
              </tr>
              <?php
 }?>
            </table>
		  </tr>
        </table>
        <p>
          <input class="booton" type="button" value="Salir" name="bCancelar" onClick="location='../form_inicio.php'"/>
          
        </p>
      </div></td>
    </tr>
    
  </table>
</div>
</body>
</html>
