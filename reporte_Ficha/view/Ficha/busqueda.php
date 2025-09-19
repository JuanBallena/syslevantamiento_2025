<?php 	
	if(isset($_POST['CODIGO_CATASTRAL'])) :
		
		require_once 'model/Lotes.php';	
		require_once '../configuracion/Conexion_SIMTRUX.php';
		require_once 'model/database_catastro.php';
		require_once 'model/constantes.php';
		require_once 'model/Fichas_p.php';

		# Validar referencia catastral
		$oCODIGOS_REFERENCIA_CATASTRAL = new SIMTRUX_Catastro();
		$CODIGOS_REFERENCIA_CATASTRAL = $oCODIGOS_REFERENCIA_CATASTRAL->ObtenerCodigoReferenciaCatastral($_POST['CODIGO_CATASTRAL']);
		

	if(!empty($CODIGOS_REFERENCIA_CATASTRAL)):
			# Obtenemos los Lotes por Sector / Manzana / Lote
			$oLotes = new Lotes();
			$Lotes = $oLotes->ObtenerLotes($CODIGOS_REFERENCIA_CATASTRAL->cod_cata);
			// Validamos la existencia de Lotes
			$NUMERO_LOTES = count($Lotes);
			($NUMERO_LOTES != 0) ? $Bandera_Lotes=true : $Bandera_Lotes=false;
			
			if($Bandera_Lotes):
				$CONTADOR = 0;
				foreach ($Lotes as $lote):
					$CONTADOR++;
					#Validar si esta en la bd Postgresql
					$oFicha = new Fichas_p();
					$Ficha = $oFicha->ObtenerFichaNueva($CODIGOS_REFERENCIA_CATASTRAL->cod_cata);					

					if($Ficha != 0):						
						$PUnidades = $oFicha->ObtenerPosiblesUnidades($Ficha['c_id_uni_cat']);

						if($PUnidades != 0):
							$NUMERO_FICHAS = count($Ficha);	
							($NUMERO_FICHAS != 0) ? $Bandera_Fichas=true : $Bandera_Fichas=false;

							if($Bandera_Fichas > 1):
								$CONTADOR = 0;
								foreach ($Ficha as $ficha):
									$CONTADOR++;							

?>							
									<div class="panel panel-primary">					
										<div class="panel-heading">
											<label  class="a-label-text">							
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CODIGO UNIDAD CATASTRAL												
												<?php echo $ficha['c_id_uni_cat']; ?>
											</label>
												<a href="Individual_actualizar.php?Lote=<?php echo $lote->idlote;?>"class="btn btn-primary"   role="button" target="_blank">Agregar Unidades</a>				            															
															
										</div>
									</div>
								<?php   endforeach; ?>
							<?php else:?>
								<div class="panel panel-primary">					
										<div class="panel-heading">
											<label  class="a-label-text">							
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LOTE CATASTRAL										
												<?php echo $lote->idlote; ?>
											</label>
												<a href="Individual_unidad.php?Lote=<?php echo $lote->idlote;?>"class="btn btn-primary"   role="button" target="_blank">Agregar Unidades</a>				            															
															
										</div>
									</div>
							<?php endif; ?>
						<?php else:?>
							<div class="a-input-text--disabled">					
								<div class="panel-heading">
									<label>							
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LOTE CATASTRAL										
										<?php echo $lote->idlote; ?>
											<a href="Individual_actualizar.php?Lote=<?php echo $lote->idlote;?>" class="btn btn-primary" role="button" target="_blank">Editar Ficha Individual</a>				            															
									</label>						
								</div>
							</div>
						<?php endif; ?>
					<?php else:?>
						<div class="panel panel-primary">					
							<div class="panel-heading">
								<label class="a-label-text">							
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LOTE CATASTRAL								
									<?php echo $lote->idlote; ?>
										<a href="Individual2.php?Lote=<?php echo $lote->idlote;?>" class="btn btn-primary" role="button" target="_blank">Actualizar</a>				            															
								</label>						
							</div>
						</div>
					<?php endif; ?>
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
	  
	<?php else:
		$codCata = $_POST['CODIGO_CATASTRAL'];
		$oFicha = new Fichas_p();
		$Ficha = $oFicha->ObtenerFichaNueva_Principal($codCata);	
		//$fichaToEncode = json_encode($Ficha); 
		if($Ficha != 0):						
			$PUnidades = $oFicha->ObtenerPosiblesUnidades($Ficha['c_id_uni_cat']);
			if($PUnidades != 0):
				$NUMERO_FICHAS = $oFicha->ContarFilasFichas($codCata);

				if($NUMERO_FICHAS > 1):
					$CONTADOR = 0;
					$FichaUnidades = $oFicha->ObtenerFichaNueva_Busqueda($codCata);	
					foreach ($FichaUnidades as $ficha):
						$CONTADOR++;
															

?>							
						<div class="panel panel-primary">					
							<div class="panel-heading">
								<label  class="a-label-text">							
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CODIGO UNIDAD CATASTRAL												
									<?php echo $ficha['c_id_uni_cat']; ?>
								</label>
									<a href="Individual_actualizar_unidad.php?UniCat=<?php echo$ficha['c_id_uni_cat'];?>"class="btn btn-primary"   role="button" target="_blank">Editar Unidadess</a>				            															
												
							</div>
						</div>
					<?php   endforeach; ?>
				<?php else:?>
					<div class="panel panel-primary">					
							<div class="panel-heading">
								<label  class="a-label-text">							
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LOTE CATASTRAL										
									<?php echo $Ficha['c_codcatastral']; ?>
								</label>
									<a href="Individual_unidad.php?Lote=<?php echo$Ficha['c_codcatastral'];?>"class="btn btn-primary"   role="button" target="_blank">Agregar Unidades</a>				            															
												
							</div>
						</div>
				<?php endif; ?>
			<?php else:?>
				<div class="a-input-text--disabled">					
					<div class="panel-heading">
						<label>							
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LOTE CATASTRAL										
							<?php echo $Ficha['c_codcatastral']; ?>
								<a href="Individual_actualizar.php?Lote=<?php echo $ficha['c_codcatastral'];?>" class="btn btn-primary" role="button" target="_blank">Editar Ficha Individual</a>				            															
						</label>						
					</div>
				</div>
			<?php endif; ?>	
		<?php else: ?>	 
			<label>							
				<strong>¡Importante!</strong> No se encontro el Código Catastral.						
				<a href="Individual_nuevo.php?" class="btn btn-primary" role="button" target="_blank">Nuevo</a>				            															
		</label>
		<?php endif; ?>
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
