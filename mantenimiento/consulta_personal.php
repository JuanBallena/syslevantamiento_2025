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

	$Consulta="SELECT id_persona, nume_doc, tipo_doc, tipo_persona, nombres, ape_paterno,ape_materno, tipo_persona_juridica, tipo_funcion, razon_social
  			   FROM tf_personas
  			   WHERE tipo_funcion in ('2','3','4')
  			   ORDER BY ape_paterno,ape_materno";

	$consulta_1= $BaseDato->Consultas($Consulta);
	$BaseDato->desconectar(); 

	//----------------------------------------------------------

?>

<div align='center'>

<table width='100%' border="0" bgcolor="#FFFFFF" cellspacing='3px' cellpadding="3">
	<thead> 
	 <tr><th colspan="4"><div align="center" class="Estilo7"><strong>PERSONAL</strong></div></th></tr>
     <tr bgcolor="#BFDFFF">
       
       
       <th  bgcolor="#0052A4"><div align="center" class="Estilo5">TIPO DOC.</div></th>
       <th  bgcolor="#0052A4"><div align="center" class="Estilo5">NUMERO</div></th>
  
       <th  bgcolor="#0052A4"><div align="center" class="Estilo6"><strong>APELLIDOS Y NOMBRES</strong></div>     </th>
	   <th  bgcolor="#0052A4"><div align="center" class="Estilo6"><strong>TIPO FUNC&Oacute;N</strong></div> </th>
       
       
    </tr>
    
   </thead>
   <tbody>
   <?php
	while($row1=pg_fetch_array($consulta_1))
	{ 	
	
	?>       <tr bgcolor="#BFDFFF">
  				
                <td><div class='Estilo7' align="center"><?php 
               		switch($row1['tipo_doc'])

						{	case '08':	echo "LIBRETA MILITAR";
									  	break;
							case '02':	echo "DNI";
										break;
							
						}

                ?></div></td>
                <td><div class='Estilo7' align="center"><?php echo $row1['nume_doc'];	?></div></td>
                
                <td><div class='Estilo7' align="left"><?php echo $row1['ape_paterno'].' '.$row1['ape_materno'].' '.$row1['nombres']; ; ?></div></td>
                
                <td><div class='Estilo7' align="center"><?php 
                	switch($row1['tipo_funcion'])

						{	case '2':	echo "SUPERVISOR";
									  	break;
							case '3':	echo "TECNICO";
										break;
							case '4':	echo "VERIFICADOR";
										break;
						}?></div></td>
                  				
  			</tr>
	
	<?php
	}
	


?>																																								
</div>																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																						