<?php

require_once './inserts/InsertManzanaTable.php';
require_once './inserts/InsertSectorTable.php';
require_once './inserts/InsertConstruccionTable.php';
require_once './inserts/InsertFichaTable.php';
require_once './inserts/InsertInformacionComplementariaTable.php';
require_once './inserts/InsertLoteTable.php';
require_once './inserts/InsertServiciosBasicosTable.php';
require_once './inserts/InsertUniCatTable.php';
require_once './inserts/InsertPuertaTable.php';
require_once './inserts/InsertFichaViaTable.php';
require_once './model/Fichas_Vias.php';
require_once './model/database_catastro.php';
require_once './model/constantes.php';

//$formData = file_get_contents("php://input", true);

$info = $_POST['dataPost'];
$dataPost = json_decode($info, true);

$ubigeo='130101';
$codigo='01';
$dis='01';
$f_fechatec = $dataPost['catastralTechnicalData']['fechaTecnico'];
$lote_antiguo= ltrim($dataPost['catastralReferenceCode']['codLote'], "0"); 
$cod_catastral=$dis.$dataPost['catastralReferenceCode']['codSector'].$dataPost['catastralReferenceCode']['codManzana'].$lote_antiguo;
$idSector= $ubigeo.$dataPost['catastralReferenceCode']['codSector'];
$idManzana= $idSector.$dataPost['catastralReferenceCode']['codManzana'];
$idLote=$idManzana.$dataPost['catastralReferenceCode']['codLote'];
$idEdificacion=$idLote.$dataPost['catastralReferenceCode']['codEdifica'];
$codHab = str_pad($dataPost['catastralPropertyLocation']['urbanAuthorizationName'], 5, "0", STR_PAD_LEFT);
$idHabUrb=$ubigeo.$codHab; 
$codUso=$dataPost['propertyDescription']['useAuthorizationName'];
$idUniCat=$idEdificacion.$dataPost['catastralReferenceCode']['codEntrada'].$dataPost['catastralReferenceCode']['codPiso'].$dataPost['catastralReferenceCode']['codUnidad'];
$idFicha=$idSector.$dataPost['catastralReferenceCode']['codManzana'].$dataPost['catastralReferenceCode']['codLote'].$dataPost['catastralReferenceCode']['codEdifica'].$dataPost['catastralReferenceCode']['codEntrada'].$dataPost['catastralReferenceCode']['codPiso'].$dataPost['catastralReferenceCode']['codUnidad'];
$Estado=$dataPost['catastralPropertyLocation']['idEstado'];
$id=$dataPost['catastralTechnicalData']['idTecnico'];
    

$insertSectorTable = new InsertSectorTable();
$insertSectorTable->insert(
    $idSector,
    $ubigeo,
    $dataPost['catastralReferenceCode']['codLote']
);

$insertManzanaTable = new InsertManzanaTable();
$insertManzanaTable->insert(
    $idManzana,
    $dataPost['catastralReferenceCode']['codManzana'], 
    $idSector, 
    $dataPost['catastralPropertyLocation']['mznaDist']
);

$insertLoteTable = new InsertLoteTable();
$insertLoteTable->insert(
    $idLote,
    $idManzana,
    $dataPost['catastralReferenceCode']['codLote'], 
    $dataPost['propertyDescription']['useAuthorizationName'],  
    $dataPost['catastralPropertyLocation']['mznaDist'],
    $dataPost['catastralPropertyLocation']['loteDist'],
    $dataPost['catastralPropertyLocation']['subloteDist']
);

$insertUniCatTable = new InsertUniCatTable();
$insertUniCatTable->insert(
    $idUniCat,
    $idLote,
    $dataPost['catastralReferenceCode']['codEntrada'], 
    $dataPost['catastralReferenceCode']['codPiso'],  
    $dataPost['catastralReferenceCode']['codUnidad'],
    $dataPost['catastralReferenceCode']['codEdifica']
);

$chkLuzValue = $dataPost['basicServices']['chkLuz'] ? 1 : 0;
$chkAguaValue = $dataPost['basicServices']['chkAgua'] ? 1 : 0;
$chkTelefonoValue = $dataPost['basicServices']['chkTelefono'] ? 1 : 0;
$chkDesagueValue = $dataPost['basicServices']['chkDesague'] ? 1 : 0;
$chkGasValue = $dataPost['basicServices']['chkGas'] ? 1 : 0;

$insertServiciosBasicosTable = new InsertServiciosBasicosTable();
$insertServiciosBasicosTable->insert(
    $idFicha,
    $chkLuzValue, 
    $chkAguaValue,
    $chkTelefonoValue,
    $chkDesagueValue,
    $chkGasValue
);

$chkSubdivisionValue = $dataPost['additionlInformation']['chkSubdivision'] ? 1 : 0;
$chkAcumulacionValue = $dataPost['additionlInformation']['chkAcumulacion'] ? 1 : 0;
$chkIndependizacionValue = $dataPost['additionlInformation']['chkIndependizacion'] ? 1 : 0;

$insertInformacionComplementariaTable = new InsertInformacionComplementariaTable();
$insertInformacionComplementariaTable->insert(
    $idFicha,
    $dataPost['additionlInformation']['cantMed'], 
    $dataPost['observations']['observacion'], 
    $chkSubdivisionValue, 
    $chkAcumulacionValue,
    $chkIndependizacionValue
);
$insertConstruccionTable = new InsertConstruccionTable();
$insertConstruccionTable->insert(
    $idFicha.$codigo,
    $idFicha,
    $dataPost['building']['nroPiso'], 
    $dataPost['building']['codWallandColumns'],
    $dataPost['building']['codCeiling'],
    $dataPost['building']['codFloors'],
    $dataPost['building']['codDoorandWindow'],
    $dataPost['building']['codMaterial']
);

$path = $_FILES['file']['name'];
$ext = pathinfo($path, PATHINFO_EXTENSION);
$nombre_archivo = $idUniCat;
$ruta_imagen = './imagenes/'.$nombre_archivo.'.'.$ext;

if (move_uploaded_file($_FILES['file']['tmp_name'], $ruta_imagen))
{

    $insertFichaTable = new InsertFichaTable();
    $insertFichaTable->insert(
        $idUniCat,
        $idSector, 
        $dataPost['catastralPropertyLocation']['mznaDist'],
        $dataPost['catastralPropertyLocation']['loteDist'],
        $dataPost['catastralPropertyLocation']['subloteDist'],
        $dataPost['ubigeo']['idDepartamento'],
        $dataPost['ubigeo']['idProvincia'],
        '01',
        /*$dataPost['ubigeo']['idDistrito'],*/
        $idHabUrb,
        $dataPost['catastralPropertyLocation']['nroEtapa'],
        $id,
        $codUso,
        $cod_catastral,
        $dataPost['catastralPropertyLocation']['grupoHU'],     
        $Estado,
        $f_fechatec,  
        $idFicha.$codigo,
        $ruta_imagen,
        $dataPost['propertyDescription']['useReferencial'],
        $dataPost['catastralPropertyLocation']['urbanAuthorizationNombre']        
    );
}


foreach ($dataPost['catastralPropertyDoors'] as $via) 
{
    foreach ($via['doors'] as $door) 
    {          
        //$viaType = $via['viaType'] < 9 ? '0'.$via['viaType'] : $via['viaType'];

        $insertPuertaTable = new InsertPuertaTable();
        $insertPuertaTable->insert(
            $idLote.$door['doorType'].$via['viaType'],   
            $idLote,
            $door['doorType'], 
            $door['municipalNumber'],
            $via['viaType'],
            //$viaType,
            $idFicha,
            '0'.$via['viaName'],// codigo de la via
            $ubigeo.'0'.$via['viaName'],
            $via['viaNombre']
        );
    }
}

echo "ok";

?>