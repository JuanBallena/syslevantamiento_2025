<?php     
    class ConsultaController{
        
        private $model;
        
        public function __CONSTRUCT(){
            //$this->model = new Ficha_Individual();
        }
        
        public function Index(){
            require_once 'view/consulta_reporte.php';
        }
    }
