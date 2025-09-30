<?php

require_once "./_DBPostgres.php";
require_once "./_CreateResponse.php";

header("Content-Type: application/json; charset=UTF-8");

try {
  $BD = new DBPostgres();
  $BD->conectar();

  // Verificamos que exista la institucion
$Consulta="SELECT id_institucion FROM tf_institucion";
$Resultado=$BD->Consultas($Consulta);   
$registros=pg_num_rows($Resultado);

if($registros<=0 || $registros=='null'){	
	echo "<script>alert('Debe registrar Institucion!');
    			document.location.href='../configuracion/define_ubigeo.php';</script>\n";
}
else{
	while($row=pg_fetch_array($Resultado))
	{		
		$dep=substr($row['id_institucion'],0,2);
		$pro=substr($row['id_institucion'],2,2);
		$dis=substr($row['id_institucion'],4,2);
		
		$_SESSION['dep']=$dep;
		$_SESSION['pro']=$pro;
		$_SESSION['dis']=$dis;
		$ubigeo=$dep.$pro.$dis;
		$_SESSION['ubigeo']=$ubigeo;
	}
}

  //createResponse(true, $estados);

} catch (Exception $e) {
  createResponse(false, [], $e->getMessage());
} finally {
  if (isset($BD)) {
    $BD->desconectar();
  }
}





