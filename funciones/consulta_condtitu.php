<?php 

include '../configuracion/conexion.php';
include '../configuracion/constantes.php';
?>
<style type="text/css">
<!--
.Estilo5 {color: #FFFFFF; font-weight: bold; font-family: Verdana; font-size: 12px; }
.Estilo6 {color: #FFFFFF; font-family: Verdana; font-size: 12px; }
.Estilo7 {color: #000000; font-family: Verdana; font-size: 12px; }
-->
</style>
<?php
$condti=$_GET['nro'];
// $anio=$_GET['anio'];
// $ubigeo=$_SESSION['ubigeo'];
// $sector=trim($_GET['sector']);
// 	if($sector=='') $sector='%';
// $mzna=trim($_GET['mzna']);	
// 		if($mzna=='') $mzna='%';
// $lote=trim($_GET['lote']);	
// 		if($lote=='') $lote='%';
$tipo=$_GET['tipo'];	
$edit=$_GET['edit'];
$pdf=$_GET['pdf'];


	echo "<div align='center'>";
	echo "<table id='tabla' width='980px' border='0' >"
	?>
	<thead> 
     <tr>
       <th width="70px" rowspan="1" bgcolor="#0052A4"><div align="center" class="Estilo5">Ubigeo</div></th>
       <th width="70px" rowspan="1" bgcolor="#0052A4"><div align="center" class="Estilo5">N&uacute;mero</div></th>
       <th width="300px" rowspan="1" bgcolor="#0052A4"><div align="center" class="Estilo5">Datos del Titular</div></th>
       <th width="100px" rowspan="1" bgcolor="#0052A4"><div align="center" class="Estilo6"><strong>Tipo</strong></div>     </th>
	   <th width="160px" rowspan="1" bgcolor="#0052A4"><div align="center" class="Estilo6"><strong>C&oacute;digo</strong></div> </th>
       <th  width="100px" rowspan="1" bgcolor="#0052A4"><div align="center" class="Estilo6"><strong>Fecha</strong></div></th>
       <th  width="100px" rowspan="1" bgcolor="#0052A4"><div align="center" class="Estilo6"><strong>ACCI&Oacute;N</strong></div></th>
    </tr>
    
   </thead>
   <tbody>
   <?php 
   	//----------------------------------------------------------
	$BaseDato=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);
	$BaseDato->conectar();
	$Consulta="SELECT distinct f.id_uni_cat, f.tipo_ficha, f.nume_ficha, f.fecha_levantamiento, ".
			"p.ape_paterno||' '||p.ape_materno||' '||p.nombres as titular, t.nume_titular, f.id_ficha ".
			"FROM tf_fichas as f LEFT OUTER JOIN tf_titulares as t ON f.id_ficha = t.id_ficha ".
			"LEFT OUTER JOIN public.tf_personas as p ON t.id_persona = p.id_persona ".
			"WHERE t.cond_titular='$condti' ".
			"AND f.tipo_ficha='$tipo'".
			// "WHERE ((substring(f.id_uni_cat, 7, 2) LIKE '$sector') ".
			// 	"AND (substring(f.id_uni_cat, 9, 3) LIKE '$mzna') ".
			// 	"AND (substring(f.id_uni_cat, 12, 3) LIKE '$lote') ".
			// 	"AND (f.tipo_ficha='$tipo') ".
			// 	"AND (extract(year from f.fecha_levantamiento)='$anio')) ".
				"ORDER BY f.id_ficha, t.nume_titular";

	$consulta_1= $BaseDato->Consultas($Consulta);
	$BaseDato->desconectar(); 
	//----------------------------------------------------------
	$i = 0;
	$pinta=0;
	  
	  
	while($row1=pg_fetch_array($consulta_1))
	{ 	
	
	if($pinta%2==0)
	  	  {
		  $tag_fila = ($i % 2 == 0) ? '<tr bgcolor="#D8D8D8">' : '<tr bgcolor="#D8D8D8">';
    	  echo $tag_fila;
		  ?>          
  				<td><div class='Estilo7' align="center"><?php echo substr($row1['id_ficha'],4,6); ?></div></td>
                <td><div class='Estilo7' align="center"><?php echo $row1['nume_ficha']; ?></div></td>
                <td><div class='Estilo7' align="center"><?php echo $row1['titular']; ?></div></td>
                <td><div class='Estilo7' align="center">
				<?php 
						switch($row1['tipo_ficha'])
						{	case '01':	echo "Individual";
									  	break;
							case '02':	echo "Cotitular";
										break;
							case '03':	echo "Económica"; 
										break;
							case '04':	echo "Bienes Comunes"; 
										break;
						}
				?></div></td>
                <td><div class='Estilo7' align="center"><?php echo $row1['id_uni_cat']; ?></div></td>
                <td><div class='Estilo7' align="center"><?php echo $row1['fecha_levantamiento']; ?></div></td>
                <td><div class='Estilo7' align="center">
                <a target="_blank" href="
                <?php
                switch($row1['tipo_ficha'])
						{	case '01':	
										if($edit=='1')
											echo "../fichaIndividual/edit_individual.php?id=".$row1['id_ficha'];
										else	
											echo "../fichaIndividual/modifica_individual.php?id=".$row1['id_ficha'];
									  	break;
							case '02':	if($edit=='1')
											echo "../fichaCotitularidad/edit_cotitular.php?id=".$row1['id_ficha'];
										else
											echo "../fichaCotitularidad/modifica_cotitular.php?id=".$row1['id_ficha'];
										break;
							case '03':	if($edit=='1')
											echo "../fichaActividadEconomica/edit_economica.php?id=".$row1['id_ficha'];
										else
											echo "../fichaActividadEconomica/modifica_economica.php?id=".$row1['id_ficha'];
										break;
							case '04':	if($edit=='1')
											echo "../fichaBienComun/edit_biencomun.php?id=".$row1['id_ficha'];
										else
											echo "../fichaBienComun/modifica_biencomun.php?id=".$row1['id_ficha'];
										break;
						}
				?>">
                <img src="../img/editar.png" width="16" height="13" border="0" title="Editar Ficha"/></a>
                <a class="btn btn-warning" target="_blank" href="
                <?php
                switch($row1['tipo_ficha'])
						{	case '01':	
										if($pdf=='1')
											echo "../fichaIndividual/Reporte/pdf.php?id=".$row1['id_ficha'];
										else	
											echo "../fichaIndividual/modifica_individual.php?id=".$row1['id_ficha'];
									  	break;
							case '02':	if($pdf=='1')
											echo "../fichaCotitularidad/Reporte_cot/pdf.php?id=".$row1['id_ficha'];
										else
											echo "../fichaCotitularidad/modifica_cotitular.php?id=".$row1['id_ficha'];
										break;
							case '03':	if($pdf=='1')
											echo "../fichaCotitularidad/Reporte_eco/pdf.php?id=".$row1['id_ficha'];
										else
											echo "../fichaCotitularidad/modifica_economica.php?id=".$row1['id_ficha'];
										break;

							case '04':	if($pdf=='1')
											echo "../fichaBienComun/Reporte/pdf.php?id=".$row1['id_ficha'];
										else
											echo "../fichaBienComun/modifica_biencomun.php?id=".$row1['id_ficha'];
										break;
						}
				?>">
                  <img src="../img/pdf.png" width="16" height="13" border="0" title="Guardar en PDF"/></a></div></td>
		<?php 
	
		  }
	 else 
		  {
		  
	  	  $tag_fila = ($i % 2 == 0) ? '<tr bgcolor="#B7DBFF">' : '<tr bgcolor="#B7DBFF">';
    	  echo $tag_fila;
	   	  ?>          
  				<td><div class='Estilo7' align="center"><?php echo substr($row1['id_ficha'],4,6); ?></div></td>
                <td><div class='Estilo7' align="center"><?php echo $row1['nume_ficha']; ?></div></td>
                <td><div class='Estilo7' align="center"><?php echo $row1['titular']; ?></div></td>
                <td><div class='Estilo7' align="center">
				<?php 
						switch($row1['tipo_ficha'])
						{	case '01':	echo "Individual";
									  	break;
							case '02':	echo "Cotitular";
										break;
							case '03':	echo "Económica"; 
										break;
							case '04':	echo "Bienes Comunes"; 
										break;
						}
				?></div></td>
               <td><div class='Estilo7' align="center"><?php echo $row1['id_uni_cat']; ?></div></td>
                <td><div class='Estilo7' align="center"><?php echo $row1['fecha_levantamiento']; ?></div></td>
                <td><div class='Estilo7' align="center"><a target="_blank" href="
                <?php
                switch($row1['tipo_ficha'])
						{	case '01':	
										if($edit=='1')
											echo "../fichaIndividual/edit_individual.php?id=".$row1['id_ficha'];
										else	
											echo "../fichaIndividual/modifica_individual.php?id=".$row1['id_ficha'];
									  	break;
							case '02':	if($edit=='1')
											echo "../fichaCotitularidad/edit_cotitular.php?id=".$row1['id_ficha'];
										else
											echo "../fichaCotitularidad/modifica_cotitular.php?id=".$row1['id_ficha'];
										break;
							case '03':	if($edit=='1')
											echo "../fichaActividadEconomica/edit_economica.php?id=".$row1['id_ficha'];
										else
											echo "../fichaActividadEconomica/modifica_economica.php?id=".$row1['id_ficha'];
										break;
							case '04':	if($edit=='1')
											echo "../fichaBienComun/edit_biencomun.php?id=".$row1['id_ficha'];
										else
											echo "../fichaBienComun/modifica_biencomun.php?id=".$row1['id_ficha'];
										break;
						}
				?>"><img src="../img/editar.png" width="16" height="13" border="0" title="Editar Ficha"/></a>
                <a class="btn btn-warning" target="_blank" href="
                <?php
                switch($row1['tipo_ficha'])
						{	case '01':	
										if($pdf=='1')
											echo "../fichaIndividual/Reporte/pdf.php?id=".$row1['id_ficha'];
										else	
											echo "../fichaIndividual/modifica_individual.php?id=".$row1['id_ficha'];
									  	break;
							case '02':	if($pdf=='1')
											echo "../fichaCotitularidad/Reporte_cot/pdf.php?id=".$row1['id_ficha'];
										else
											echo "../fichaCotitularidad/modifica_cotitular.php?id=".$row1['id_ficha'];
										break;
							case '03':	if($pdf=='1')
											echo "../fichaCotitularidad/Reporte_eco/pdf.php?id=".$row1['id_ficha'];
										else
											echo "../fichaCotitularidad/modifica_economica.php?id=".$row1['id_ficha'];
										break;

							case '04':	if($pdf=='1')
											echo "../fichaBienComun/Reporte/pdf.php?id=".$row1['id_ficha'];
										else
											echo "../fichaBienComun/modifica_biencomun.php?id=".$row1['id_ficha'];
										break;
						}
				?>">
                  <img src="../img/pdf.png" width="16" height="13" border="0" title="Guardar en PDF"/></a></div></td>
		  <?php 
		  }//sin pintar
		 $pinta++;
  		 $i++;
		
	//echo 'Ficha Nro : '.$row1['nume_ficha']; 	echo "<br>";
	}
	echo "</div>";

?>