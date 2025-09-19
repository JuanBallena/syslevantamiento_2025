<?php   
        require_once 'model/Manzanas_p.php';

    require_once 'model/Uni_Cat.php';
   
    require_once 'model/Fichas_p.php';

    require_once 'model/Servicios_Basicos.php';

    require_once 'model/Usos.php';
    require_once 'model/Multitabla.php';

    require_once 'model/Habilitacion_Urbana.php';
    require_once 'model/Puertas.php';
    require_once 'model/Vias.php';

    require_once 'model/TecnicoC.php'; 
    require_once 'model/Usuario.php'; 

    class ConsultaController{
        
        private $model;
        
        public function __CONSTRUCT(){
            
        }
        
        public function Index(){
            require_once 'view/consulta_reporte.php';
        }
    }
