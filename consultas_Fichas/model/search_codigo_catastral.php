<?php 

include '../../configuracion/conexion.php';


$distrito='01';

$sector=trim($_GET['sector']);
	if($sector=='') $sector='%';

$mzna=trim($_GET['mzna']);	
		if($mzna=='') $mzna='%';
		
$lote=trim($_GET['lote']);	
		if($lote=='') $lote='%';
			
$unidad=trim($_GET['unidad']);
		if($unidad=='') $unidad='%';	

$cod_catastral=$distrito.$sector.$mzna.$lote.$unidad;


   	//----------------------------------------------------------
	$conn=conectarse();
	$sql="SELECT CodCata,PR_Predio_Contribuyente.NroFichaInspeccion as NumFicha, 
	 				PR_Predio.CodPredio as CodPredio,URBANIZACION.nombre as NombreUrba,
	 				VIA.nombvia as Nombrevia,
	 				PR_Predio.CodUrba,
	 				Manzana,
	 				Lote,
	 				PR_Predio.CodCalle,
	 				NumFinca,
	 				PR_Persona.NombreCompleto as NombrePropietario,
	 				AreaTerreno
	 				FROM PR_Predio,PR_Predio_Contribuyente,PR_Persona,URBANIZACION,VIA
	 				WHERE (CodCata  LIKE '$cod_catastral') AND 
	 					  (PR_Predio.CodPredio=PR_Predio_Contribuyente.CodPredio)AND
	 					  (PR_Predio_Contribuyente.CodContribuyente=PR_Persona.CodPersona)AND
	 					  (PR_Predio.CodUrba=URBANIZACION.codurba)AND
	 					  (PR_Predio.CodCalle=VIA.codcalle)
	 				ORDER BY CodCata";

	
 $stmt = sqlsrv_query($conn, $sql);

	 if( $stmt === false) {
    	
    	die( print_r( sqlsrv_errors(), true) );
		
        }


$CONTADOR=1;
?>
<!DOCTYPE html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="../assets/images/favicon.ico">
<title>Búsqueda de Fichas Catastrales</title>
<link href="css/estilo_form.css" rel="stylesheet" type="text/css"/>
<link href="css/botones.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../reportes/assets/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="../../reportes/assets/css/estilos.css"/>
  
<script type="text/javascript" src="../js/funciones_validar.js"></script>


<script src="http://ie7-js.googlecode.com/svn/version/xx.x/IE8.js" type="text/javascript"></script> 

</head>
	<div class="panel panel-primary">
					
					<div class="panel-heading">
						<label>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							
						</label>
						<?php 
/*						echo "<BR>";
echo "el sector es ".$sector;
echo "<BR>";
echo "el manzana es ".$mzna;
echo "<BR>";
echo "el lote es ".$lote;
echo "<BR>";
echo "el unidad es ".$unidad;
echo "<BR>";
$exportar_manzana_completa=0;
$exportar_lote_completo=0;*/

						if($sector!='%' AND $mzna!='%' AND $lote=='%' AND $unidad=='%'){

									//echo "entre en 1";
									$exportar_manzana_completa=1;
						?>
						<a href="<?php echo "../crearPDF_2000_mzna.php?CodCata=".$cod_catastral?>" class="btn btn-danger" role="button" target="_blank">Exportar MZ COMPLETA a PDF</a>

						<?php } 


						if($sector!='%' AND $mzna!='%' AND $lote!='%' AND $unidad=='%'){
						//echo "entre en 2";
									$exportar_lote_completo=1;
						?>
						<a href="<?php echo "../crearPDF_2000_mzna.php?CodCata=".$cod_catastral?>" class="btn btn-danger" role="button" target="_blank">Exportar LOTE COMPLETO a PDF</a>
						<?php } ?>					
					</div>

				
					<table class="table">
						<thead>
							<tr><th class="text-center">NUMERO</th>
				                <th class="text-center">CÓDIGO CATASTRAL</th>
				                <th class="text-center">PROPIETARIO</th>
				                <th class="text-center">MANZANA</th>
				                <th class="text-center">NRO DE FICHA</th>
								<th class="text-center">DESCARGA</th>
				            </tr>
			            </thead>
			            <tbody>
				            <?php while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ) { ?>
							<tr>
								<td class="text-center border-none"><?php echo $CONTADOR;?></td>
								<td class="text-center border-none"><?php echo $row['CodCata'];?></td>
				                <td class="text-left border-none"><?php echo $row['NombrePropietario'];?></td>
				                <td class="text-center border-none"><?php echo $row['Manzana'];?></td>
				                <td class="text-center border-none"><?php echo $row['NumFicha'];?></td>
<td class="text-center border-none">
<a href="<?php echo "../crearPDF_2000.php?CodPredio=".$row['CodPredio']."&CodCata=".$row['CodCata']?>" target="_blank"><img src="../assets/images/pdf.png" title="Descargar Ficha" height="28px" ></a></td>
				            </tr>
							<?php $CONTADOR++;

							}   sqlsrv_free_stmt($stmt);
								sqlsrv_close( $conn );

							?>
						</tbody>
						
				  	</table>
				</div> 
