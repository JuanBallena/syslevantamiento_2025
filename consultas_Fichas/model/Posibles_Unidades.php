<?php
require_once 'model/database_catastro.php';
require_once 'model/constantes.php';
class Posibles_Unidades
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
    
	public function ObtenerPosiblesUnidades($id)
	{
			$BD=new BaseDeDatos(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);
			$BD->conectar();
			$Consulta="SELECT ic.c_id_uni_cat, i_medidores, c_observaciones, i_subdivision, i_acumulacion, i_independizacion ".
					  "FROM tf_informacion_complementaria ic ".
					  "INNER JOIN tf_ficha f ON f.c_id_uni_cat = ic.c_id_uni_cat ".
					  "WHERE ic.c_id_uni_cat = '$id'";					  				
			$consulta_posiblesU= $BD->Consultas($Consulta);
			$consulta_posiblesUnidades = pg_fetch_array($consulta_posiblesU);
			if(!empty($consulta_posiblesUnidades))
				return $consulta_posiblesUnidades;
			else
				echo '';			
	}
}
?>