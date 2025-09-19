<?php require_once("library/funciones_reporte.php"); ?>
<?php #echo getcwd(); ?>

<?php 
	if(isset($_POST['CODIGO_CATASTRAL'])) :

		require_once 'model/database.php';
		require_once 'model/Lotes.php';
	    require_once 'model/Fichas.php';

	    # Obtenemos los Lotes por Sector / Manzana / Lote
    	$oLotes = new Lotes();
    	$Lotes = $oLotes->ObtenerLotes($_POST['CODIGO_CATASTRAL']);
    	
    	// Validamos la existencia de Lotes
    	$NUMERO_LOTES = count($Lotes);
    	($NUMERO_LOTES != 0) ? $Bandera_Lotes=true : $Bandera_Lotes=false;

    	if($Bandera_Lotes):
    		if($NUMERO_LOTES > 1):
    			# Exportar por Volumen
				echo  ' <div class="panel-heading text-right">
							<a href="reportes/index.php?c=GeneradorPDF&a=Index&Lote='.$_POST['CODIGO_CATASTRAL'].'" class="btn btn-primary" role="button" target="_blank">Exportar Volumen a PDF</a>
							<hr>
						</div>';
			endif;

	    	$CONTADOR = 0;
	    	foreach ($Lotes as $lote):
	    		#Obtenemos las Fichas por Lote
	    		$oFichas = new Fichas();
	    		$Fichas = $oFichas->ObtenerFichas($lote->IdLote);
	    		// Validamos la existencia de Fichas
	    		$NUMERO_FICHAS = count($Fichas);
    			($NUMERO_FICHAS != 0) ? $Bandera_Fichas=true : $Bandera_Fichas=false;

    			$CONTADOR++;
?>

				<div class="panel panel-primary">
					<!-- Default panel contents -->
					<div class="panel-heading">
						<label>
							<div class="label_order label-blue"><?php echo $CONTADOR; ?></div>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LOTE CATASTRAL
							<?php echo $lote->Id_Lote; ?>
						</label>
						<a href="reportes/index.php?c=GeneradorPDF&a=Index&Lote=<?php echo $lote->Id_Lote;?>" class="btn btn-primary" role="button" target="_blank">Exportar Lote a PDF</a>
					</div>

					<!-- Table -->
					<table class="table">
						<thead>
							<tr>
				                <th class="text-center">CÓDIGO DE FICHA</th>
				                <th class="text-center">REFERENCIA UNIDAD CATASTRAL</th>
				                <th class="text-center">TIPO DE FICHA</th>
				                <th class="text-center">NRO DE FICHA</th>
								<th class="text-center">DESCARGA</th>
				            </tr>
			            </thead>
			            <tbody>
				            <?php if($Bandera_Lotes): ?>
			    			<?php 	foreach ($Fichas as $ficha): ?>
							<tr>
								<td class="text-center border-none"><?php echo $ficha->Id_Ficha; ?></td>
				                <td class="text-center border-none"><?php echo $ficha->IdUniCat; ?></td>
				                <td class="text-center border-none"><?php SelectorTipoFicha($ficha->Tip_Ficha); ?></td>
				                <td class="text-center border-none"><?php echo $ficha->Nro_Ficha; ?></td>
				                <td class="text-center border-none" style="padding:0;"><a href="reportes/index.php?c=GeneradorPDF&a=Index&Ficha=<?php echo $ficha->Id_Ficha; ?>&Tipo=<?php echo $ficha->Tip_Ficha; ?>&Lote=<?php echo $lote->Id_Lote;?>" target="_blank"><img src="reportes/assets/images/pdf.png" title="Descargar Ficha" height="28px" target="_blank"></a></td>
				            </tr>
							<?php 	endforeach; ?>
						</tbody>
							<?php else: ?>
								<h5>RESULTADO DE LA BUSQUEDA</h5>
								<div class="alert alert-warning alert-dismissable fade in">
									<button type="button" class="close" data-dismiss="alert">&times;</button>
									<strong>¡Importante!</strong> No se encontraron Fichas Catastrales.
								</div>
							<?php endif; ?>
				  	</table>
				</div>
	<?php   endforeach; ?>
	<?php else: ?>
				<h5>RESULTADO DE LA BUSQUEDA</h5>
				<div class="alert alert-danger alert-dismissible fade in" role="alert">
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				  <strong>¡Importante!</strong> No se encontraron Lotes Catastrales.
				</div>
	<?php endif; ?>
<?php else: ?>
		<h5>RESULTADO DE LA BUSQUEDA</h5>
		<div class="alert alert-danger alert-dismissable fade in">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>¡Importante!</strong> Ingrese el Código Catastral.
		</div>
<?php endif; ?>

<?php 
	if(isset($oLotes)) unset($oLotes);
	if(isset($Lotes)) unset($Lotes);
	
	if(isset($oFichas)) unset($oFichas);
	if(isset($Fichas)) unset($Fichas);
?>