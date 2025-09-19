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

	$Consulta="SELECT id_via, nomb_via, tipo_via, codi_via, id_ubi_geo, fecha_via FROM tf_vias;";

	$consulta_1= $BaseDato->Consultas($Consulta);
	$BaseDato->desconectar(); 

	//----------------------------------------------------------

?>

<div align='center'>

<table width='100%' border="0" bgcolor="#FFFFFF" cellspacing='3px' cellpadding="3">
	<thead> 
	 <tr><th colspan="4"><div align="center" class="Estilo7"><strong>VIAS</strong></div></th></tr>
     <tr bgcolor="#BFDFFF">
       <th  bgcolor="#0052A4"><div align="center" class="Estilo5">C&Oacute;DIGO</div></th>

       <th  bgcolor="#0052A4"><div align="center" class="Estilo5">NOMBRE</div></th>
       <th  bgcolor="#0052A4"><div align="center" class="Estilo5">TIPO</div></th>
       
       <th  bgcolor="#0052A4"><div align="center" class="Estilo6"><strong>UBIGEO</strong></div> </th>
       
       
    </tr>
    
   </thead>
   <tbody>
   <?php
	while($row1=pg_fetch_array($consulta_1))
	{ 	
	
	?>       <tr bgcolor="#BFDFFF">
  				<td><div class='Estilo7' align="center"><?php echo $row1['codi_via']; ?></div></td>
              
                <td><div class='Estilo7' align="center"><?php echo $row1['nomb_via'];	?></div></td>
                
                <td><div class='Estilo7' align="center"><?php //echo $row1['tipo_via'];

                switch($row1['tipo_via'])

						{	case 'AL   ':	echo "AL - ALAMEDA";
									  	break;
							case 'AV   ':	echo "AV - AVENIDA";
										break;
							case 'CA   ':	echo "CA - CALLE";
										break;
							case 'CAM  ':	echo "CAM - CAMINO";
										break;
							case 'CTRA ':echo "CTRA - CARRETERA";
										break;
							case 'JR   ':	echo "JR - JIRON";
										break;
							case 'ML   ':	echo "ML - MALECON";
										break;										
							case 'PJE  ':	echo "PJE - PASAJE";
										break;
							case 'PRLG ':echo "PRLG - PROLONGACION";
										break;										
							case 'PS   ':	echo "PS - PASEO";
										break;																				
							case 'OJ   ':	echo "OJ - GGG";
										break;


						}  ?>
							
						</div></td>

                <td><div class='Estilo7' align="center"><?php echo $row1['id_ubi_geo']; ?></div></td>
                
             </tr>
	
	<?php
	}
	


?>																																								
</div>																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																						