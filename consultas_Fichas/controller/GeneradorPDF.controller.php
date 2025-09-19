<?php
    require_once 'model/Lotes.php';

    require_once 'model/Uni_Cat.php';
    require_once 'model/Edificaciones.php';

    require_once 'model/Fichas.php';
    require_once 'model/Fichas_Bienes_Comunes.php';
    require_once 'model/Fichas_Cotitularidades.php';
    require_once 'model/Fichas_Economicas.php';
    require_once 'model/Fichas_Individuales.php';

    require_once 'model/Rentas.php';
    require_once 'model/Domicilio_Fiscal.php';
    require_once 'model/Sys_Direcciones.php';
    require_once 'model/Actividades.php';
    require_once 'model/Autorizaciones_Anuncios.php';
    require_once 'model/Autorizaciones_Funcionamiento.php';
    require_once 'model/Codigos_Instalaciones.php';
    require_once 'model/Instalaciones.php';
    require_once 'model/Servicios_Basicos.php';
    require_once 'model/Sunarp.php';
    require_once 'model/Construcciones.php';
    require_once 'model/Documentos_Adjuntos.php';
    require_once 'model/Exoneraciones_Predio.php';
    require_once 'model/Exoneraciones_Titular.php';
    require_once 'model/Notarias.php';
    require_once 'model/Recap_BBCC.php';
    require_once 'model/Recap_Edificio.php';
    require_once 'model/Registro_Legal.php';

    require_once 'model/Usos.php';
    require_once 'model/Multitabla.php';

    require_once 'model/Habilitacion_Urbana.php';
    require_once 'model/Manzanas.php';
    require_once 'model/Sectores.php';

    require_once 'model/Ingresos.php';
    require_once 'model/Puertas_por_Unidad.php';
    require_once 'model/Puertas.php';
    require_once 'model/Vias.php';

    require_once 'model/Linderos.php';
    require_once 'model/LinderoTramo.php';
    
    require_once 'model/Personas.php';
    require_once 'model/Conductores.php';
    require_once 'model/Titulares.php';
    require_once 'model/Litigantes.php';  

    require_once 'model/TecnicoC.php'; 
    require_once 'model/Usuario.php'; 
    require_once 'model/Personal.php'; 

    class GeneradorPDFController{
        
        private $model;
        
        public function __CONSTRUCT(){
            //$this->model = new Ficha_Individual();
        }
        
        public function Index(){

            $_SESSION['Lote'] = isset($_REQUEST['Lote']) ? $_REQUEST['Lote']:'';
            
            if(isset($_REQUEST['Ficha'])):   
                # [1] Por Ficha Especifica
                $_SESSION['Ficha'] = isset($_REQUEST['Ficha']) ? $_REQUEST['Ficha']:'';
                $_SESSION['Tipo'] = isset($_REQUEST['Tipo']) ? $_REQUEST['Tipo']:''; 

                if($_SESSION['Tipo'] == '01'):
                    //CrearIndividualPDF();
                    require_once 'view/Ficha/PDF_Individual.php';
                elseif($_SESSION['Tipo'] == '02'):
                    //CrearCotitularPDF();
                    require_once 'view/Ficha/PDF_Cotitular.php';
                elseif($_SESSION['Tipo'] == '03'):
                    //CrearEconomicaPDF();
                    require_once 'view/Ficha/PDF_Economica.php';
                else:
                    //CrearBienComunPDF();
                    require_once 'view/Ficha/PDF_BienComun.php';
                endif;
            else:
                # [2] Por Volumen
                if(strlen($_SESSION['Lote'])!=9):
                    //CrearPorVolumenPDF();
                    require_once 'view/Ficha/PDF_PorVolumen.php';
                # [3] Por Lote
                else:
                    //CrearPorLotePDF();
                    require_once 'view/Ficha/PDF_PorLote.php';
                endif;
            endif;
        }

        public static function CrearIndividualPDF(){
            require_once 'view/Ficha/PDF_Individual.php';
        }

        public function CrearEconomicaPDF(){
            require_once 'view/Ficha/PDF_Economica.php';
        }

        public function CrearCotitularPDF(){
            require_once 'view/Ficha/PDF_Cotitular.php';
        }

        public function CrearBienComunPDF(){
            require_once 'view/Ficha/PDF_BienComun.php';
        }

        public function CrearPorLotePDF(){
            require_once 'view/Ficha/PDF_PorLote.php';
        }

        public function CrearPorVolumenPDF(){
            require_once 'view/Ficha/PDF_PorVolumen.php';
        }
    }