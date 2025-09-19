<?php 

include '../configuracion/conexion.php';
include '../configuracion/constantes.php';
?>
<style type="text/css">

table{
	border-collapse: collapse;
	margin:0 auto;
	padding:14px;
	
	}
.Estilo5 {color: #FFFFFF; font-weight: bold; font-family: Verdana; font-size: 12px; }
.Estilo6 {color: #FFFFFF; font-family: Verdana; font-size: 12px; }
.Estilo7 {color: #003366; font-family: Verdana; font-size: 12px; }

</style>
<?php 
   	//----------------------------------------------------------

	$BaseDato=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);
	$BaseDato->conectar();

	$Consulta="SELECT id_hab_urba, grup_urba, tipo_hab_urba, nomb_hab_urba, codi_hab_urba,id_ubi_geo FROM tf_hab_urbana";

	$consulta_1= $BaseDato->Consultas($Consulta);
	$BaseDato->desconectar(); 

	//----------------------------------------------------------

?>

<div align='center'>

<table width='100%' border="0" bgcolor="#FFFFFF" cellspacing='3px' cellpadding="3">
	<thead> 
	 <tr><th colspan="4"><div align="center" class="Estilo7"><strong>HABILITACIONES URBANAS</strong></div></th></tr>
     <tr bgcolor="#BFDFFF">
       <th  bgcolor="#0052A4"><div align="center" class="Estilo6"><strong>C&Oacute;DIGO</strong></div> </th>
       <th  bgcolor="#0052A4"><div align="center" class="Estilo6"><strong>NOMBRE</strong></div>     </th>
       <th  bgcolor="#0052A4"><div align="center" class="Estilo5">TIPO</div></th>
       <th  bgcolor="#0052A4"><div align="center" class="Estilo6"><strong>UBIGEO</strong></div></th>
       
    </tr>
    
   </thead>
   <tbody>
   <?php
	while($row1=pg_fetch_array($consulta_1))
	{ 	
	
	?>       <tr bgcolor="#BFDFFF">
  				<td><div class='Estilo7' align="center"><?php echo $row1['codi_hab_urba']; ?></div></td>
  				<td><div class='Estilo7' align="center"><?php echo $row1['nomb_hab_urba'];	?></div></td>
  				<td><div class='Estilo7' align="center"><?php echo $row1['tipo_hab_urba']; ?></div></td>
                <td><div class='Estilo7' align="center"><?php echo $row1['id_ubi_geo']; ?></div></td>
                  				
  			</tr>
	
	<?php
	}
	


?>																																								
</div>																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																						