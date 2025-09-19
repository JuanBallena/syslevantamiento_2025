<?php

require_once './actualizar/UpdateManzanaTable.php';
require_once './actualizar/UpdateSectorTable.php';
require_once './actualizar/UpdateConstruccionTable.php';
require_once './actualizar/UpdateFichaTable.php';
require_once './actualizar/UpdateInformacionComplementariaTable.php';
require_once './actualizar/UpdateLoteTable.php';
require_once './actualizar/UpdateServiciosBasicosTable.php';
require_once './actualizar/UpdateUniCatTable.php';
require_once './actualizar/UpdatePuertaTable.php';
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
    

$insertSectorTable = new UpdateSectorTable();
$insertSectorTable->update(
    $idSector,
    $ubigeo,
    $dataPost['catastralReferenceCode']['codLote']
);

$insertManzanaTable = new UpdateManzanaTable();
$insertManzanaTable->update(
    $idManzana,
    $dataPost['catastralReferenceCode']['codManzana'], 
    $idSector, 
    $dataPost['catastralPropertyLocation']['mznaDist']
);

$insertLoteTable = new UpdateLoteTable();
$insertLoteTable->update(
    $idLote,
    $idManzana,
    $dataPost['catastralReferenceCode']['codLote'], 
    $dataPost['propertyDescription']['useAuthorizationName'],  
    $dataPost['catastralPropertyLocation']['mznaDist'],
    $dataPost['catastralPropertyLocation']['loteDist'],
    $dataPost['catastralPropertyLocation']['subloteDist']
);

$insertUniCatTable = new UpdateUniCatTable();
$insertUniCatTable->update(
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

$insertServiciosBasicosTable = new UpdateServiciosBasicosTable();
$insertServiciosBasicosTable->update(
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

$insertInformacionComplementariaTable = new UpdateInformacionComplementariaTable();
$insertInformacionComplementariaTable->update(
    $idFicha,
    $dataPost['additionlInformation']['cantMed'], 
    $dataPost['observations']['observacion'], 
    $chkSubdivisionValue, 
    $chkAcumulacionValue,
    $chkIndependizacionValue
);
$insertConstruccionTable = new UpdateConstruccionTable();
$insertConstruccionTable->update(
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
$fecha =date('mdy');
$nombre_archivo = $idUniCat.$fecha ;
$ruta_imagen = './imagenes/'.$nombre_archivo.'.'.$ext;

if (move_uploaded_file($_FILES['file']['tmp_name'], $ruta_imagen))
{

    $insertFichaTable = new UpdateFichaTable();
    $insertFichaTable->update(
        $idUniCat,
        $idSector, 
        $dataPost['catastralPropertyLocation']['mznaDist'],
        $dataPost['catastralPropertyLocation']['loteDist'],
        $dataPost['catastralPropertyLocation']['subloteDist'],
        $dataPost['ubigeo']['idDepartamento'],
        $dataPost['ubigeo']['idProvincia'],
        '01',
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
    {        //aqui?si en el ultimo campo  
        //$viaType = $via['viaType'] < 9 ? '0'.$via['viaType'] : $via['viaType'];

        $insertPuertaTable = new UpdatePuertaTable();
        $insertPuertaTable->update(
            $idLote.$door['doorType'].$via['viaType'],   
            $idLote,
            $door['doorType'], 
            $door['municipalNumber'],
            $via['viaType'],
            //$viaType,
            $idFicha,
            '0'.$via['viaName'],
            $ubigeo.$via['viaName'],
            $via['viaNombre'],
            $door['codigoPuerta']
        );
    }
}

echo "ok";

?>