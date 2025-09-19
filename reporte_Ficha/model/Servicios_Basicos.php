<?php
require_once 'model/database_catastro.php';
require_once 'model/constantes.php';
class Servicios_Basicos
{
	private $pdo;

    public $Id_Ficha;
    public $Luz;
    public $Agua;
    public $Telefono;
    public $Desague;
    public $Nro_Sum_Luz;
    public $Nro_Contrato_Agua;
    public $Nro_Telefono;
    
	public function ObtenerServiciosBasicos($id)
	{
			$BD=new BaseDeDatos(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);
			$BD->conectar();
			$Consulta="SELECT sb.c_id_uni_cat, c_luz, c_agua, c_telefono, c_desague, c_gas ".
					  "FROM tf_servicios_basicos sb ".
					  "INNER JOIN tf_ficha f ON f.c_id_uni_cat = sb.c_id_uni_cat ".
					  "WHERE sb.c_id_uni_cat = '$id'";					  				
			$consulta_servicios= $BD->Consultas($Consulta);
			$consulta_servBasicos = pg_fetch_array($consulta_servicios);
			if(!empty($consulta_servBasicos))
				return $consulta_servBasicos;
			else
				echo '';			
	}
}
?>