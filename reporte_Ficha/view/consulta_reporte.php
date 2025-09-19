<?php 	
			
		require_once 'model/database_catastro.php';
		require_once 'model/database_fichaAntiguas.php';
		require_once 'model/constantes.php';
		require_once 'model/Fichas_p.php';
		require_once 'model/Usuario.php';
		require_once 'model/database.php';
		require_once 'model/Estado_Unidad.php';
		require_once 'model/Usos.php';
		require_once 'model/Habilitacion_Urbana.php';

	# Obtenemos EstadoUnidad
		$oEstado = new Estado_Unidad();
		$Estados = $oEstado ->ListarEstados();
	
	# Obtenemos EstadoUnidad
		$oHU = new Habilitacion_Urbana();
		$HUS = $oHU->Listar();
	
	# Obtenemos Usos    
		 $oUsos = new Usos();
		 $Usos = $oUsos->Listar();
	
	 # Obtenemos Usuario de la bdcatastro-postgresql
		 $oUsuario = new Usuario();
		 $Usuarios = $oUsuario->ComboUsuario();

		
?>
<!DOCTYPE html>
<html lang="es" class="no-js">
<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PLANDET | Reporte de Levantamiento Catastral</title>
	
	<meta name="description" content="Sistema web para Consultas de Fichas Catastrales"/>
	<meta name="author" content="Lorena Romero Bruno"/>
	<link rel="shortcut icon" href="assets/images/favicon.ico">
	
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="assets/css/estilos.css"/>
	<link rel="stylesheet" type="text/css" href="assets/css/individual.css"/>
	<script type="text/javascript" src="../js/funciones_validar.js"></script>
</head>
<body>
<div class="o-main">
	<form name="datos"  method="post" autocomplete="off" >
        <div class="o-form-container">
            <div class="a-text a-text--center a-text--lg">Reportes de Levantamiento Catastral</div>
            	<div class="m-form-section">
                    <div class="m-form-section__title">Por Referencia Catastral</div>

                        <div class="o-grid o-grid--14rem">
                            <div>
                                <label class="a-label">Sector</label>
                                <input 
                                    class="a-input-text" 
                                    type="text"
                                    value=""
                                    name= "dg_sector" 
                                    id="dg_sector"                                    
                                    >
                            </div>
                            <div>
                                <label class="a-label">Mz</label>
                                <input 
                                    class="a-input-text" 
                                    type="text"
                                    value=""
                                    name="dg_manzana"
                                    id="dg_manzana"                                    
                                >
							</div>
							<div>
								<td></td>								
								<label class="a-label"></label>	
								<button
                            		type="button"
									name="buscar_reporte_Referencia"
                            		class="a-btn a-btn--success"
                            		onclick="BuscarFichasReferencia()"                            
                        		>
                            		Exportar a Excel
                        		</button>																			
                            </div>
						</div>
                </div>                
				<div class="m-form-section">
                    <div class="m-form-section__title">Por Ubicación del Predio</div>
						<div class="o-grid o-grid__five-columns">
							<div class="o-grid__first-column">
								<label class="a-label">Estado Unidad Cat.</label>
								<select 
									class="a-input-text" 
									name="" 
									id="select-estados"                                 
									value="">
								</select>
							</div>
							<div class="o-grid__five-column">
								<label class="a-label">Nombre Habilitación Urbana</label>							
								<div class="a-autocomplete">
									<input
										type="text"
										style="width:600px;"
										value=""
										class="a-input-text"
										placeholder="Escribe"
										tabindex="1"
										onclick="onclickUrbanAuthorizationName()"
										onblur="onblurUrbanAuthorizationName()"
										onkeyup="onkeyupUrbanAuthorizationName(event)"
										id="urban-authorization-name-text"
									/>
									<input 
										type="hidden" 
										value=""
										id="urban-authorization-name-value" />
									<div 
										id="urban-authorization-name-options-container"
										class="a-autocomplete__box u-d-none"
										onmousedown="event.preventDefault()"
									>
										<ul class="a-autocomplete__items" id="urban-authorization-name-options">
										</ul>
									</div>
								</div>								
							</div>
							<div>							
									<label class="a-label"></label>																				
									<input 
										type="submit" 
										name="buscar_reporte_Ubicacion" 
										class="a-btn a-btn--success" 
										value="Exportar a Excel" 
										onclick="BuscarFichasUbicacion();"
									>
                            	</div>
                    </div>
                </div>
				<div class="m-form-section">
                    <div class="m-form-section__title">Por Descripción del Predio</div>
					<div class="o-grid o-grid__five-columns">
							<div class="o-grid__five-column">
								<label class="a-label">Uso del Predio Catastral</label>							
								<div class="a-autocomplete">
									<input
										type="text"
										style="width:600px;"
										value=""
										class="a-input-text"
										placeholder="Escribe"
										tabindex="1"
										onclick="onclickCatastralProperty()"
										onblur="onblurCatastralProperty()"
										onkeyup="onkeyupUsesAuthorizationName(event)"
										id="uses-authorization-name-text"
									/>
									<input 
										type="hidden" 
                                		value=""
                                		id="uses-authorization-name-value">
									<div 
										class="a-autocomplete__box u-d-none"
                                		id="uses-authorization-name-options-container"
                                		onmousedown="event.preventDefault()"
                           			>
									   <ul class="a-autocomplete__items" id="uses-authorization-name-options">
                                	   </ul>
									</div>
								</div>								
							</div>
							<div>							
									<label class="a-label"></label>																				
									<input 
										type="submit" 
										name="buscar_reporte_Descripcion" 
										class="a-btn a-btn--success" 
										value="Exportar a Excel" 
										onclick="BuscarFichasDescripcion();"
									>
                            	</div>
                    </div>
                </div>
				<div class="m-form-section">
                    <div class="m-form-section__title">Por Datos del Técnico Catastral</div>
                    <div class="o-grid o-grid__five-columns">                     
						<div>
                            <label class="a-label">Nombre Completo</label>
                            <select 
                                class="a-input-text" 
                                name="" 
                                id="select-nombreT" 
                                value="">
                            </select>
                        </div>                                           
                        <div>
                            <label class="a-label">Fecha Levantamiento</label>
                            <input 
                                class="a-input-text"                                 
                                type="date"
                                value=""
                                name="input-tc-fechaL"
                                id="input-tc-fechaL"                                
                            >
                        </div> 
						<div>							
							<label class="a-label"></label>																				
								<input 
									type="submit" 
									name="buscar_reporte_Tecnico" 
									class="a-btn a-btn--success" 
									value="Exportar a Excel" 
									onclick="BuscarFichasTecnico();"
								>
                        </div>                      
                    </div>
                </div>
		</div>
	</form>
</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js"></script>
    <script type="text/javascript" src="./js/catastral_property_location.js"></script>
    <script type="text/javascript" src="./js/property_description.js"></script>
    <script type="text/javascript" src="./js/catastral_technical_data.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/file-saver@2.0.5/src/FileSaver.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/babel-polyfill/6.26.0/polyfill.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.3.0/exceljs.min.js"></script>
	<script src="./js/excelGenerator.js"></script>


<script>

	async function BuscarFichasReferencia(){
         var sector=document.getElementById("dg_sector").value;
         var manzana = document.getElementById("dg_manzana").value;

        const formData = new FormData();
        formData.append('sector', sector);
        formData.append('manzana', manzana);
   
        if(sector!='' || manzana!='' )
	    {
            const response = await axios.post('rpt_porReferencia.php',formData );
			const fichas = response.data;

			console.log(fichas)

			generateExcel(fichas);

			/*for (const ficha of fichas) {
				
				console.log(ficha);
			}*/
            /*if (response.data == "ok")
                {
                    alert("Se ha descargado el archivo correctamente");
				}*/

        }
    }

	async function BuscarFichasUbicacion(){
         var estado= document.getElementById("select-estados").value;
         var hu = document.getElementById("urban-authorization-name-value").value;

        const formData = new FormData();
        formData.append('estado', estado);
        formData.append('hu', hu);
   
        if(unidad!='')
	    {
            const response = await axios.post('rpt_porUbicacion.php',formData );
            console.log(response);
            if (response.data == "ok")
                {
                    alert("Se ha descargado el archivo correctamente");
				}

        }
    }

	async function BuscarFichasDescripcion(){
         var uso=document.getElementById("uses-authorization-name-value").value;
 
        const formData = new FormData();
        formData.append('uso', uso);
   
        if(unidad!='')
	    {
            const response = await axios.post('rpt_porDescripcion.php',formData );
            console.log(response);
            if (response.data == "ok")
                {
                    alert("Se ha descargado el archivo correctamente");
				}

        }
    }

	async function BuscarFichasTecnico(){
         var nombre=document.getElementById("select-nombreT").value;
         var fecha = document.getElementById("input-tc-fechaL").value;

        const formData = new FormData();
        formData.append('nombre', nombre);
        formData.append('fecha', fecha);
   
        if(unidad!='')
	    {
            const response = await axios.post('rpt_porTecnico.php',formData );
            console.log(response);
            if (response.data == "ok")
                {
                    alert("Se ha descargado el archivo correctamente");
				}

        }
    }

	window.onload = () => {

		setUrbanAuthorizationNameValuesFromDatabase(<?php echo json_encode($HUS) ?>);
		setUsesAuthorizationNameValuesFromDatabase(<?php echo json_encode($Usos) ?>);

		createOptionsStateCatastralUnit_I(<?php echo json_encode($Estados) ?>);																														
		createUrbanAuthorizationNameOptions(<?php echo json_encode($HUS) ?>);
		createUsesAuthorizationNameOptions(<?php echo json_encode($Usos) ?>);
		createUsersptions(<?php echo json_encode($Usuarios) ?>);



	};
</script>
</body>