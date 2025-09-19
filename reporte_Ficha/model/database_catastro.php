<?php

   class  BaseDeDatos
   {
      private $Servidor;
      private $Puerto;
      private $Nombre;
      private $Usuario;
      private $Clave;
         
      public $c_id_uni_cat;
	  
      function __construct($Servidor,$Puerto,$Nombre,$Usuario,$Clave)
     	
      {
         $this->Servidor=$Servidor;
         $this->Puerto=$Puerto;
         $this->Nombre=$Nombre;
         $this->Usuario=$Usuario;
         $this->Clave=$Clave;
      }
      
      function Conectar()
      {
        $BaseDato=pg_connect("host=$this->Servidor port=$this->Puerto dbname=$this->Nombre user=$this->Usuario password=$this->Clave");
      
		//return $BaseDato;
         if ($BaseDato) 
            return $BaseDato;
         else 
            return 0; 
		}  
	  
      function Consultas($Consulta)
      {	 
         global $Resultado;

         $Valor=$this->Conectar();
         if(!$Valor)
            return 0; //Si no se pudo conectar
         else
         {
            //Valor es resultado de base de dato y Consulta es la Consulta a realizar
            $Resultado=pg_query($Valor,$Consulta);
            return $Resultado;// retorna si fue afectada una fila
         }
      }
   
      function desconectar()
		{
			pg_close();
		} 
   }


?>