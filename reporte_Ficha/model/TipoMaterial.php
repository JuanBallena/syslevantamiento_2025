<?php
require_once 'model/database_catastro.php';
require_once 'model/constantes.php';

class TipoMaterial
{
	private $BD;
	public $IdTipoMaterial;
	public $DesTipoMaterial;


	public function ListarTipoMaterial()
	{
			$BD = new BaseDeDatos(SERVIDOR, PUERTO, BD, USUARIO, CLAVE);   
			$BD->Conectar();	
			$consulta ="SELECT * FROM tf_tipo_material";
			$consulta_tipomaterial= $BD->Consultas($consulta);
			$materiales=pg_fetch_all($consulta_tipomaterial);
			if(!empty($materiales))
				return $materiales;
			else
				echo "";
	
	}

	public function ComboTipoMaterial()
	{
			$BD = new BaseDeDatos(SERVIDOR, PUERTO, BD, USUARIO, CLAVE);   
			$BD->Conectar();			
			$consulta ="SELECT i_cod_tip_material as codigo, i_cod_tip_material ||' - '|| c_des_tip_material as descrip FROM tf_tipo_material ";
			$consulta_tipoMaterial= $BD->Consultas($consulta);		
				echo "<select style= width:146px class='a-input-text' name= cmb_tipo_material id=cmb_tipo_material>";
				echo "<option value='0'>Seleccione</option>";
				while($registro=pg_fetch_assoc($consulta_tipoMaterial))
				{ 
					echo "<option value='".trim($registro['codigo'])."'>".trim($registro['descrip'])."</option>"; 
				}
					echo "</select>";	
	
	}

	public function ObtenerTipoMaterial($id)
	{
			$BD = new BaseDeDatos(SERVIDOR, PUERTO, BD, USUARIO, CLAVE);   
			$BD->Conectar();
			$Consulta="SELECT tm.i_cod_tip_material, tm.c_des_tip_material ".
					  "FROM tf_ficha f ".
					  "INNER JOIN tf_tipo_material tm ON f.i_cod_tip_material = tm.i_cod_tip_material ".
					  "WHERE c_id_uni_cat = '$id' ";
			$consulta_tipoMaterial= $BD->Consultas($Consulta);
			$materiales=pg_fetch_array($consulta_tipoMaterial);
			if(!empty($materiales))
				return $materiales;
			else
				echo "";
	}
}
?>