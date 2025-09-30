<?php require 'FichaIndividual.html'; ?>

<?php
// require_once '../_archivos_compartidos/obtenerTipoVia.php';

// require_once 'model/database.php';
// require_once 'model/database_catastro.php';
// require_once '../model/constantes.php';
// require_once '../model/Lotes.php';
// require_once '../model/LotesFicha.php';
// require_once '../model/Fichas.php';
// requir_once '../model/Catastro.php';
// require_once '../model/Fichas_Individuales.php';
// require_once    '../model/Usos.php';
// require_once '../model/TipoVia.php';
// require_once '../model/Habilitacion_Urbana.php';
// require_once '../model/Vias.php';
// require_once '../model/Usuario.php';
// require_once '../model/Estado_Unidad.php';
// require_once '../model/TipoCategoria.php';
// require_once '../model/TipoMaterial.php';e

// $Id_Lote = $_GET['Lote'];
// $Dep = '13';
// $Pro = '01';
// $Distrito = '01';
// $Edifica = '01';
// $Entrada = '01';
// $Piso = '01';
// $Unidad = '001';
// $Usuario = '70142734';
// # Obtenemos Catastro
// $oCatastro = new Catastro();
// $Catastro = $oCatastro->ObtenerCatastroxId($Id_Lote);
// # Obtenemos Habilitación Urbana de la Ubicación del Predio
// $oHU = new Habilitacion_Urbana();
// $HUS = $oHU->Listar();
// # Obtenemos Habilitación Urbana de la Ubicación del Predio
// $oHU = new Habilitacion_Urbana();
// $HU = $oHU->ObtenerUrbanizacion($Catastro->codurba);
// if(empty($HU)):
//     $HU = 1;
// endif;
// # Obtenemos Habilitación Urbana de la Ubicación del Predio
// $oVia = new Vias();
// $VIAS = $oVia->Listar();
// # Obtenemos Vias o Calles de la Ubicación del Predio
// $oVia = new Vias();
// $Via = $oVia->ObtenerVia($Catastro->codcalle);
// # Obtenemos EstadoUnidad
// $oEstado = new Estado_Unidad();
// $Estados = $oEstado ->ListarEstados();
// # Obtenemos TipoCategoria
// $oTipoCategoria = new TipoCategoria();
// $TipoCategorias = $oTipoCategoria ->ListarTipoCategoria();
// # Obtenemos TipoMaterial
// $oTipoMaterial = new TipoMaterial();
// $TipoMateriales = $oTipoMaterial ->ListarTipoMaterial();
// # Obtenemos Usuario de la bdcatastro-postgresql
// $oUsuario = new Usuario();
// $Usuario = $oUsuario->ObtenerUsuario($Usuario);
// $IdUsuario = $Usuario['c_id_usuario'];
// $Dni = $Usuario['c_usuario'];
// $Nombres = $Usuario['c_nombres'];


// $ApellidoP = $Usuario['c_ape_paterno'];
// $ApellidoM = $Usuario['c_ape_materno']; # Obtenemos Usos
// $oUsos = new Usos();
// $Usos = $oUsos->Listar(); # Obtenemos Lote de Ficha
// $oloteF = new LotesFicha();

// $loteF = $oloteF->ObtenerLote($Id_Lote);
// # Obtenemos Ficha
// $oFicha = new Fichas();
// $Ficha = $oFicha->ObtenerFicha($loteF->IdLote);
// # Obtenemos Ficha_Individual
// $oFicha_Individual = new Fichas_Individuales();
// $Ficha_Individual = $oFicha_Individual->ObtenerFichaIndividual($Ficha->Id_Ficha);
// # Obtenemos Usos
// $oUso = new Usos();
// $Uso = $oUso->ObtenerUso($Ficha_Individual->IdUso);
// if(empty($Uso)):

//     $Uso = 1;
// endif;
?>


<!-- <head> -->
   <!-- <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/> -->

<!-- </head> -->
<!-- <body>  -->
<!-- <div class="o-main"> -->
        <!-- <form name="datos"  onSubmit="subirImagen()"action="" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="o-form-container">
                <div class="a-text a-text--center a-text--lg">Levantamiento de información Catastral</div>
                <div class="m-form-section">
                    <div class="m-form-section__title">Ubigeo</div>

                    <div class="o-grid o-grid--14rem">
                        <div>
                            <label class="a-label">Departamento</label>
                            <input 
                                class="a-input-text" 
                                type="text"
                                value=""
                                placeholder="Escriba"
                                name= "input-department" 
                                id="input-department">
                        </div>
                        <div>
                            <label class="a-label">Provincia</label>
                            <input 
                                class="a-input-text" 
                                type="text"
                                value=""
                                placeholder="Escriba"
                                name="input-province"
                                id="input-province"
                                
                                >
                        </div>
                        <div>
                            <label class="a-label">Distrito</label>
                            <input 
                                class="a-input-text " 
                                type="text"
                                value=""
                                placeholder="Escriba"
                                name="input-distrit"
                                id="input-distrit">
                        </div>
                    </div>
                </div>

                <div class="m-form-section">
                    <div class="m-form-section__title">Código de Referencia Catastral</div>

                    <div class="o-grid o-grid--10rem">
                        <div>
                            <label class="a-label">Sector</label>
                            <input 
                                class="a-input-text"
                                placeholder="Escriba"
                                type="text"
                                value=""
                                name="input-sector"
                                id="input-sector">
                        </div>
                        <div>
                            <label class="a-label">Manzana</label>
                            <input 
                                class="a-input-text" 
                                type="text"
                                value=""
                                placeholder="Escriba"
                                name="input-manzana"
                                id="input-manzana">
                        </div>
                        <div>
                            <label class="a-label">Lote</label>
                            <input 
                                class="a-input-text" 
                                type="text"
                                value=""                                                       
                                placeholder="Escriba"
                                name="input-lote"
                                id="input-lote">
                        </div>
                        <div>
                            <label class="a-label">Edifica</label>
                            <input 
                                class="a-input-text " 
                                type="text"
                                value=""                 
                                placeholder="Escriba"
                                name="input-edifica"
                                id="input-edifica">
                        </div>
                        <div>
                            <label class="a-label">Entrada</label>
                            <input 
                                class="a-input-text " 
                                type="text"
                                value=""                      
                                placeholder="Escriba"
                                name="input-entrada"
                                id="input-entrada">
                        </div>
                        <div>
                            <label class="a-label">Piso</label>
                            <input 
                                class="a-input-text" 
                                type="text"
                                value=""
                                placeholder="Escriba"
                                name="input-piso"
                                id="input-piso">
                        </div>
                        <div>
                            <label class="a-label">Unidad</label>
                            <input 
                                class="a-input-text" 
                                type="text"
                                value=""
                                placeholder="Escriba"
                                name="input-unidad"
                                onchange="validaUnidad()"
                                id="input-unidad">
                        </div>
                    </div>
                </div>

                <div class="m-form-section">
                    <div class="m-form-section__title">Ubicación del Predio Catastral</div>

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
                        <div class="o-grid__second-column">
                            <label class="a-label">Nombre Habilitación Urbana</label>
                           
                            <div class="a-autocomplete">
                                <input
                                    type="text"
                                    value=""
                                    class="a-input-text"
                                    placeholder="Escriba"
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
                    </div>

                    <div class="o-grid o-grid--8rem">
                        <div>
                            <label class="a-label">Grupo HU</label>
                            <select 
                                class="a-input-text" 
                                name="select-grupoHU" 
                                id="select-grupoHU" 
										
                                onchange="onChangeGrupoHU()"
                            >
                                <option value= 0 selected>Seleccione</option>
                                <option value="01">Zona</option>
                                <option value="02">Sector</option>
                                <option value="03">Etapa</option>
                            </select>
                        </div>
                        <div>
                            <label class="a-label">Nro. Etapa</label>
                            <input 
                                class="a-input-text--disabled" 
                                type="number" 
                                value = 0                               
                                readonly
                                id="stage-number">
                        </div>
                        <div>
                            <label class="a-label">Manzana</label>
                            <input 
                                class="a-input-text" 
                                type="text"
                                placeholder="Escriba"
                                value=""
                                id="input-mzna-Dist">
                        </div>
                        <div>
                            <label class="a-label">Lote</label>
                            <input 
                                class="a-input-text" 
                                type="text"
                                placeholder="Escriba"
                                value=""
                                id="input-lote-Dist">
                        </div>
                        <div>
                            <label class="a-label">Sublote</label>
                            <input 
                                class="a-input-text" 
                                type="text"
                                placeholder="Escriba"
                                value=""
                                id="input-subLote-Dist">
                        </div>
                    </div>
                </div>

                <div class="m-form-section">
                    <div class="m-form-section__title">Puertas del Predio Catastral</div>

                    <div id="vias">
                         <div class="m-form-section u-relative" id="via0">
                            <div class="a-close-button is-danger-color" onclick="deleteVia(0)">
                                x
                            </div>
                            <div class="m-form-section__title">Via</div>

                            <div class="o-grid o-grid__five-columns">
                                <div class="o-grid__first-column">
                                    <label class="a-label">Tipo de Vía</label>
                                    <div class="a-autocomplete">
                                        <input type="hidden" id="via-type-value-0">
                                        <input
                                            type="text"
                                            class="a-input-text"
                                            placeholder="Escriba"
                                            tabindex="1"
                                            onclick="onclickViaType(0)"
                                            onblur="onblurViaType(0)"
                                            onkeyup="onkeyupViaType(event, 0)"
                                            id="via-type-text-0"
                                        />
                                        <div 
                                            class="a-autocomplete__box u-d-none"
                                            id="via-type-options-container-0"
                                            onmousedown="event.preventDefault()"
                                        >
                                            <ul class="a-autocomplete__items" 
                                                id="via-type-options-0">
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="o-grid__second-column">
                                    <label class="a-label">Nombre de Vía</label>
                                    <div class="a-autocomplete">
                                        <input type="hidden" id="via-name-value-0">
                                        <input
                                            type="text"
                                            class="a-input-text"
                                            placeholder="Escriba"
                                            tabindex="1"
                                            onclick="onclickViaName(0)"
                                            onblur="onblurViaName(0)"
                                            onkeyup="onkeyupViaName(event, 0)"
                                            id="via-name-text-0"
                                        />
                                        <div 
                                            class="a-autocomplete__box u-d-none"
                                            id="via-name-options-container-0"
                                            onmousedown="event.preventDefault()"
                                        >
                                            <ul class="a-autocomplete__items"
                                                id="via-name-options-0"
                                            >
                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="o-grid o-grid--14rem" id="doors-0">
								<div>
                                    <div class="o-container u-relative" id="door-00">
                                        <div class="a-close-button is-danger-color" onclick="deleteDoor(0, 0)">
                                            x
                                        </div>
                                        <div class="a-text--center">Puerta</div>
                                        <label class="a-label">Tipo</label>
                                        <select class="a-input-text" name="" id="door-type-00">
                                        </select>

                                        <label class="a-label">Nro. Municipal</label>
                                        <input 
                                            class="a-input-text" 
                                            type="text"
                                            id="municipal-number-00" />
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button 
                                    type="button"
                                    class="a-btn a-btn--secondary" 
                                    onclick="onclickAddDoor(0)">
                                    Añadir Puerta
                                </button>
                            </div>
                        </div>
                    </div>
                    <button 
                        type="button"
                        class="a-btn a-btn--secondary" 
                        onclick="onclickAddVia()">
                        Añadir Vía
                    </button>

                    <br>
                </div>

                <div class="m-form-section">
                    <div class="m-form-section__title">Descripción del Predio</div>
                    <div>
                            <label class="a-label">Referencial Uso</label>
                            <input 
                                class="a-input-text " 
                                type="text"
                                value=""                             
                                name="input-ref-uso"
                                id="input-ref-uso">
                    </div>
                    <div>
                        <label class="a-label">Uso del Predio Catastral</label>
                        <div class="a-autocomplete">
                            <input
                                type="text"
                                value = ""
                                class="a-input-text"
                                placeholder="Escriba"
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

                </div>

                <div class="m-form-section">
                    <div class="m-form-section__title">Servicios Básicos</div>

                    <div>
                        <input 
                            name="sb_luz" 
                            type="checkbox" 
                            id="sb_luz" 
                            >
                            <label class="a-label">Luz</label> <br>          
                        <input 
                            name="sb_agua" 
                            type="checkbox" 
                            id="sb_agua" 
                            >
                            <label class="a-label">Agua</label> <br>           
                        <input 
                            name="sb_telef" 
                            type="checkbox" 
                            id="sb_telefono" 
                            >
                            <label class="a-label">Telefono</label> <br>
                        <input 
                            name="sb_desague" 
                            type="checkbox" 
                            id="sb_desague" 
                            >
                            <label class="a-label">Desague</label> <br>
                        <input 
                            name="sb_gas" 
                            type="checkbox" 
                            id="sb_gas" 
                            >
                            <label class="a-label">Gas Natural</label>

                    </div>
                </div>

                <div class="m-form-section">
                    <div class="m-form-section__title">Construcciones</div>

                    <div class="o-grid o-grid--14rem">
                        <div>
                            <label class="a-label">Nro. de Piso</label>
                            <select 
                                class="a-input-text" 
                                name="select-nroPiso" 
                                id="select-nroPiso"
										
                            >
                                <option value=0 selected>Seleccione</option>                   
                                <option value=1>1 piso</option>
                                <option value=2>2 piso</option>
                                <option value=3>3 piso</option>
                                <option value=4>4 piso</option>
                                <option value=5>5 piso</option>
                                <option value=6>6 piso</option>
                                <option value=7>7 piso</option>
                                <option value=8>8 piso</option>
                                <option value=9>9 piso</option>
                                <option value=10>10 piso</option>
                                <option value=11>11 piso</option>
                                <option value=12>12 piso</option>
                            </select>
                        </div>
                        <div>
                            <label class="a-label">Muros y Columnas</label>
                            <select 
                                class="a-input-text" 
                                name="" 
                                id="select-walls-and-columns" 
                                value="">
                            </select>
                        </div>
                        <div>
                            <label class="a-label">Techos</label>
                            <select 
                                class="a-input-text" 
                                name="" 
                                id="select-ceilings" 
                                value="">
                            </select>
                        </div>
                        <div>
                            <label class="a-label">Puertas y Ventanas</label>
                            <select 
                                class="a-input-text" 
                                name="" 
                                id="select-doors-and-windows" 
                                value="">
                            </select>
                        </div>
                        <div>
                            <label class="a-label">Pisos</label>
                            <select 
                                class="a-input-text" 
                                name="" 
                                id="select-floors" 
                                value="">
                            </select>
                        </div>
                        <div>
                            <label class="a-label">Material Estruc Predominante</label>
                            <select 
                                class="a-input-text" 
                                name="" 
                                id="select-materials" 
                                value="">
                            </select>
                        </div>
                    </div>
                </div>

                <div class="m-form-section">
                    <div class="m-form-section__title">Información Complementaria</div>

                    <div class="o-grid o-grid__two-columns">
                        <div class="o-grid__first-column">
                            <label class="a-label">Cantidad de Medidores</label>
                            <input 
                                class="a-input-text" 
                                type="number"
                                name="input-cant_med"
                                id="input-cant_med"
                                value="0">
                        </div>
                        <div class="o-grid__second-column">
                            <label class="a-label">Posibles unidades</label>
                            <div>
                                <input 
                                    name="sb_sub" 
                                    type="checkbox" 
                                    id="sb_sub" 
                                >
                                <label class="a-label">Subdivisión</label> <br>

                                <input 
                                    name="sb_acu" 
                                    type="checkbox" 
                                    id="sb_acu" 
                                >
                                <label class="a-label">Acumulación</label> <br>

                                <input 
                                    name="sb_ind" 
                                    type="checkbox" 
                                    id="sb_ind" 
                                    >
                                <label class="a-label">Independización</label>
                            </div>
                        </div>
                    </div>
                </div>           
                <div class="m-form-section">
                    <div class="m-form-section__title">Imágenes adjuntas</div>
                    <br>
                    <input 
                        type="file" 
                        name="img_adj" 
                        id="img_adj"
                    >
                </div>
                                                        
                <div class="m-form-section">
                    <div class="m-form-section__title">Observaciones</div>

                    <textarea 
                        class="a-input-text"
                        name="input-observaciones" 
                        id="input-observaciones" 
                        cols="30" 
                        rows="5"
                    ></textarea>
                </div>

                <div class="m-form-section">
                    <div class="m-form-section__title">Datos del Técnico Catastral</div>

                    <div class="o-grid o-grid--10rem">
                        
                        <div>
                            <label class="a-label">Dni</label>
                            <input 
                                class="a-input-text a-input-text--disabled" 
                                type="text"
                                value=""
                                name="input-tc-dni"
                                id="input-tc-dni"
                                readonly
                                disabled>
                        </div>
                        <div>
                            <label class="a-label">Nombres</label>
                            <input 
                                class="a-input-text a-input-text--disabled" 
                                type="text"
                                value=""
                                name="input-tc-nombre"
                                id="input-tc-nombre"
                                readonly
                                disabled>
                        </div>
                        <div>
                            <label class="a-label">Apellido Paterno</label>
                            <input 
                                class="a-input-text a-input-text--disabled" 
                                type="text"
                                value=""
                                name="input-tc-apellidoP"
                                id="input-tc-apellidoP"
                                readonly
                                disabled>
                        </div>
                        <div>
                            <label class="a-label">Apellido Materno</label>
                            <input 
                                class="a-input-text a-input-text--disabled" 
                                type="text"
                                value=""
                                name="input-tc-apellidoM"
                                id="input-tc-apellidoM"
                                readonly
                                disabled>
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
                        <div type = "hidden">  
                            <label class="a-label">Usuario</label>                         
                            <input 
                                class="a-input-text a-input-text--disabled"                                
                                value=""
                                name="input-tc-id"
                                id="input-tc-id"
                                readonly
                                disabled>
                        </div>
                    </div>
                </div>

                <div class="o-button-group" id="buttons">
                    <div class="o-button-group__first">
                        <button class="a-btn a-btn--accent">
                            Cancelar
                        </button>
                    </div>
                    <div class="o-button-group__second">
                        <button
                            type="button"
                            class="a-btn a-btn--success"
                            onclick="saveForm()"                            
                        >
                            Grabar
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js"></script>

    <script type="text/javascript" src="./js/ubigeo.js"></script>
    <script type="text/javascript" src="./js/catastral_reference_code.js"></script>
    <script type="text/javascript" src="./js/catastral_property_location.js"></script>
    <script type="text/javascript" src="./js/catastral_property_doors.js"></script>
    <script type="text/javascript" src="./js/property_description.js"></script>
    <script type="text/javascript" src="./js/buildings.js"></script>
    <script type="text/javascript" src="./js/catastral_technical_data.js"></script>
    <script type="text/javascript" src="./js/basic_services.js"></script>
    <script type="text/javascript" src="./js/additional_information.js"></script>
    <script type="text/javascript" src="./js/attached_images.js"></script>
    <script type="text/javascript" src="./js/datos_minimos.js"></script>
																	   

  <script> 
    
    async function saveForm()
    {   
        var result = confirm("Esta seguro que desea guardar?");

        if (result == false) return;

        var dataVias = [];

        for (let index = 0; index < viasAcumulator.length; index++) 
        {    
            var via = {
                viaType: document.getElementById("via-type-value-" + index).value,
                viaTipo: document.getElementById("via-type-text-" + index).value,
                viaName: document.getElementById("via-name-value-" + index).value,
                viaNombre: document.getElementById("via-name-text-" + index).value,
                doors: []
            }

            var dataDoors = [];

            for (let indexDoor = 0; indexDoor <= viasAcumulator[index]['doors']; indexDoor++) 
            {    
                var door = {
                    doorType: document.getElementById("door-type-" + index + indexDoor).value,
                    municipalNumber: document.getElementById("municipal-number-" + index + indexDoor).value
                }

                dataDoors.push(door);
            }

            via.doors = dataDoors;
            dataVias.push(via);
        }

        let dataPost = {
            ubigeo: {
                idDepartamento:document.getElementById("input-department").value,
                idProvincia:document.getElementById("input-province").value,
                idDistrito:document.getElementById("input-distrit").value
            },
            catastralReferenceCode: {
                codSector:document.getElementById("input-sector").value,
                codManzana:document.getElementById("input-manzana").value,
                codLote:document.getElementById("input-lote").value,
                codEdifica:document.getElementById("input-edifica").value,
                codEntrada:document.getElementById("input-entrada").value,
                codPiso:document.getElementById("input-piso").value,
                codUnidad:document.getElementById("input-unidad").value
            },
            catastralPropertyLocation: {
                idEstado: document.getElementById("select-estados").value,
                urbanAuthorizationName: document.getElementById("urban-authorization-name-value").value,
                urbanAuthorizationNombre: document.getElementById("urban-authorization-name-text").value, 
                grupoHU: document.getElementById("select-grupoHU").value,
                nroEtapa: document.getElementById("stage-number").value,
                mznaDist: document.getElementById("input-mzna-Dist").value,
                loteDist: document.getElementById("input-lote-Dist").value,
                subloteDist: document.getElementById("input-subLote-Dist").value
            },
            catastralPropertyDoors: dataVias, //esto es un array
            propertyDescription: {
                useAuthorizationName: document.getElementById("uses-authorization-name-value").value,
                useReferencial : document.getElementById("input-ref-uso").value
            },
            basicServices: {
                chkLuz: document.getElementById("sb_luz").checked,
                chkAgua: document.getElementById("sb_agua").checked,
                chkTelefono: document.getElementById("sb_telefono").checked,
                chkDesague: document.getElementById("sb_desague").checked,
                chkGas: document.getElementById("sb_gas").checked,
                
            },
            building: {
                nroPiso: document.getElementById("select-nroPiso").value,
                codWallandColumns: document.getElementById("select-walls-and-columns").value,
                codCeiling: document.getElementById("select-ceilings").value,
                codFloors: document.getElementById("select-floors").value,
                codDoorandWindow: document.getElementById("select-doors-and-windows").value,
                codMaterial: document.getElementById("select-materials").value
            },
            additionlInformation: {
                cantMed: parseInt(document.getElementById("input-cant_med").value),
                chkSubdivision: document.getElementById("sb_sub").checked,                
                chkAcumulacion: document.getElementById("sb_acu").checked,
                chkIndependizacion: document.getElementById("sb_ind").checked

            },
            attachedImages: {            
                archivo: document.getElementById("img_adj").value
            },
            
            observations: {
                observacion: document.getElementById("input-observaciones").value
            },
            catastralTechnicalData: {
                idTecnico:document.getElementById("input-tc-id").value,
                nombreTecnico:document.getElementById("input-tc-nombre").value,
                apePaternoTecnico:document.getElementById("input-tc-apellidoP").value,
                apeMaternoTecnico:document.getElementById("input-tc-apellidoM").value,
                fechaTecnico:document.getElementById("input-tc-fechaL").value
            }            
            
        }

        datos_minimos(
            codSector=document.getElementById("input-sector"),
            codManzana=document.getElementById("input-manzana"),
            codLote=document.getElementById("input-lote"),
            codEdifica=document.getElementById("input-edifica"),
            codEntrada=document.getElementById("input-entrada"),
            codPiso=document.getElementById("input-piso"),
            codUnidad=document.getElementById("input-unidad"),
            idEstado= document.getElementById("select-estados"),
            urbanAuthorizationName= document.getElementById("urban-authorization-name-value"),
            grupoHU= document.getElementById("select-grupoHU"),
            nroEtapa= document.getElementById("stage-number"),
            mznaDist= document.getElementById("input-mzna-Dist"),
            loteDist= document.getElementById("input-lote-Dist"),
            useAuthorizationName= document.getElementById("uses-authorization-name-value"),
            useReferencial= document.getElementById("input-ref-uso"),
            nroPiso=document.getElementById("select-nroPiso"),
            codWallandColumns= document.getElementById("select-walls-and-columns"),
            codCeiling= document.getElementById("select-ceilings"),
            codFloors= document.getElementById("select-floors"),
            codDoorandWindow= document.getElementById("select-doors-and-windows"),
            codMaterial= document.getElementById("select-materials"),
            cantMed= document.getElementById("input-cant_med"),
            fechaTecnico=document.getElementById("input-tc-fechaL")                
        );

        let file =  document.getElementById("img_adj").files[0];

        const formData = new FormData();
        formData.append('file', file);
        formData.append('dataPost', JSON.stringify(dataPost));

        try {
            
            const response = await axios.post('saveForm.php', formData, { headers: { "Content-Type": "multipart/form-data" } });   
            console.log(response);
            if (response.data == "ok")
            {
                document.getElementById("buttons").style.display = "none";
                alert("Se ha guardado correctamente");


            }
            else {
                alert("Ha ocurrido un error");
            }

        } catch (error) {
            console.log(error);
            alert("Ha ocurrido un error");
        }        
    }

    async function validaUnidad(){
         var unidad=document.getElementById("input-unidad").value;
         var SECTOR = document.getElementById("input-sector").value;
         var MZ = document.getElementById("input-manzana").value;  
         var LOTE_c = document.getElementById("input-lote").value;
         var LOTE = LOTE_c.slice(1);
         var codCatastral = "01"+SECTOR+MZ+LOTE;

        const formData = new FormData();
        formData.append('unidad', unidad);
        formData.append('codCatastral', codCatastral);
   
        if(unidad!='')
	    {
            const response = await axios.post('validaUnidad.php',formData );
            console.log(response);
            if (response.data == "ok")
                {
                    alert("Ya existe la unidad para ese predio, favor de cambiarla");
					document.getElementById("input-unidad").value = '';
                }

        }
    }

    window.onload = () => {

        setUrbanAuthorizationNameValuesFromDatabase(<?php echo json_encode($HUS); ?>);
        setUsesAuthorizationNameValuesFromDatabase(<?php echo json_encode($Usos); ?>);

        createOptionsStateCatastralUnit_I(<?php echo json_encode($Estados); ?>);
																														   
        createUrbanAuthorizationNameOptions(<?php echo json_encode($HUS); ?>);
        createUsesAuthorizationNameOptions(<?php echo json_encode($Usos); ?>);
        createOptionsWallsAndColumns(null, <?php echo json_encode($TipoCategorias); ?>);																																
        createOptionsCeilings(null,<?php echo json_encode($TipoCategorias); ?>);
        createOptionsDoorsAndWindows(null,<?php echo json_encode($TipoCategorias); ?>);
        createOptionsFloors(null,<?php echo json_encode($TipoCategorias); ?>);
        createOptionsMaterials(null,<?php echo json_encode($TipoMateriales); ?>);

        loadInputValuesUbigeo(
            <?php echo json_encode($Dep); ?>,
            <?php echo json_encode($Pro); ?>,            
            <?php echo json_encode($Distrito); ?>
        );

        loadInputValuesCatastralReferenceCode({
            entrada:  <?php echo json_encode($Entrada); ?>,
            piso:     <?php echo json_encode($Piso); ?>,
            unidad:   <?php echo json_encode($Unidad); ?>,
            edifica:  <?php echo json_encode($Edifica); ?>,            
            district: <?php echo json_encode(substr($loteF->Id_Lote, 0, 2)); ?>,
            sector:   <?php echo json_encode(substr($loteF->Id_Lote, 2, 2)); ?>,
            manzana:  <?php echo json_encode(substr($loteF->Id_Lote, 4, 3)); ?>,
            lote:     <?php echo json_encode(substr($loteF->Id_Lote, 7, 2)); ?>
        });

        if((<?php echo json_encode($HU); ?>) != 1)
        {

        loadInputValuesCatastralPropertyLocation_I(<?php echo json_encode($HU); ?>);

        }

        if((<?php echo json_encode($Uso); ?>) != 1)
        {
            loadInputValuesPropertyDescription(<?php echo json_encode($Uso); ?>, null);	
        }        
        																		  

        loadInputValuesCatastralTechnicalData(            
            <?php echo json_encode($Dni); ?>,
            <?php echo json_encode($Nombres); ?>,
            <?php echo json_encode($ApellidoP); ?>,
            <?php echo json_encode($ApellidoM); ?>,
            <?php echo json_encode($IdUsuario); ?>
        );

        const values = [
            {
                text: 'Principal',
                value: '01'
            },
            {
                text: 'Secundaria',
                value: '02'
            },
            {
                text: 'Garage',
                value: '03'
            },
            {
                text: 'Estacionamiento',
                value: '04'
            }
        ];
        
        setDoorTypes(values);
 
    };
</script> -->
<!-- </body> -->