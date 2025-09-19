<?php require_once("library/funciones_reporte.php"); ?>
<?php 
    // echo "SESION LOTE: ".$_SESSION['Lote']."<br>";
    // echo "SESION FICHA: ".$_SESSION['Ficha']."<br>";
    // echo "SESION TIPO: ".$_SESSION['Tipo']."<br>";

    $Id_Lote = trim($_SESSION['Lote']);
    $Id_Ficha = trim($_SESSION['Ficha']);

    # Obtenemos Lote
    $olote = new Lotes();
    $lote = $olote->ObtenerLote($Id_Lote);

    # Obtenemos Ficha 
    $oFicha = new Fichas();
    $Ficha = $oFicha->ObtenerFicha($Id_Ficha);

    # Obtenemos Uni_Cat
    if(($Ficha->IdUniCat) != 0):
        $oUni_Cat = new Uni_Cat();
        $Uni_Cat = $oUni_Cat->ObtenerUnidadCatastral($Ficha->IdUniCat);
    endif;

    # Obtenemos Rentas
    if(!empty($Ficha)):
        $oRentas = new Rentas();
        $Rentas = $oRentas->ObtenerRenta($Id_Ficha);
    endif;

    # Obtenemos Edificacion
    if(!empty($Uni_Cat)):
        $oEdificacion = new Edificaciones();
        $Edificacion = $oEdificacion->ObtenerEdificacion($Uni_Cat->IdEdificacion);
    endif;

    # Obtenemos Habilitación Urbana de la Ubicación del Predio
    if(!empty($lote)):
        $oHU = new Habilitacion_Urbana();
        $HU = $oHU->ObtenerHU($lote->IdHU);
    endif;

    # Obtenemos Ficha_Individual
    if(!empty($Ficha)):
        $oFicha_Individual = new Fichas_Individuales();
        $Ficha_Individual = $oFicha_Individual->ObtenerFichaIndividual($Id_Ficha);
    endif;

    # Obtenemos Usos
    if(!empty($Ficha_Individual)):
        $oUso = new Usos();
        $Uso = $oUso->ObtenerUso($Ficha_Individual->IdUso);
    endif;

    # Obtenemos Los Ingresos al Predio
    if(!empty($Ficha_Individual)):
        $oIngresos = new Ingresos();
        $Ingresos = $oIngresos->ObtenerIngresos($Ficha_Individual->Id_Ficha);
    endif;
    
    # Obtenemos Las Puertas
    $Puertas = array();

    # Obtenemos Vías
    $Vias = array();

    # Obtenemos los Titulares
    if(!empty($Ficha_Individual)):
        $oTitulares = new Titulares();
        $Titulares = $oTitulares->ObtenerTitulares($Ficha_Individual->Id_Ficha);
    endif;

    # Obtenemos a las Personas
    $Personas = array();

    // Si existen Cotitulares o Litigantes
    // En existencia de Cotitulares, la Ficha Individual no tiene Titulares; por tanto "Nro_Titulares=0"
    if(!empty($Titulares)):
        if(($Titulares[0]->Condic_Titular != "05") || ($Titulares[0]->Condic_Titular != "06")):      

            foreach($Titulares as $titular):
                $opersona = new Personas();
                $persona = $opersona->ObtenerPersona($titular->IdPersona);
                array_push($Personas,$persona);
            endforeach;
        endif;
    endif;

    # Obtenemos la Exoneracion de Titular
    if(!empty($Personas)):
        $oExoneraciones_Titular = new Exoneraciones_Titular();
        $Exoneraciones_Titular = $oExoneraciones_Titular->ObtenerExoneracionTitular($Ficha_Individual->Id_Ficha,$Personas[0]->IdPersona);
    endif;

    # Obtenemos la Exoneracion de Predio
    if(!empty($Ficha_Individual)):
        $oExoneraciones_Predio = new Exoneraciones_Predio();
        $Exoneraciones_Predio = $oExoneraciones_Predio->ObtenerExoneracionPredio($Ficha_Individual->Id_Ficha);
    endif;

    # Obtenemos los Linderos
    if(!empty($Ficha)):
        $oLinderos = new Linderos();
        $Linderos = $oLinderos->ObtenerLinderos($Ficha->Id_Ficha);
    endif;
    
    # Obtenemos los LinderosTramo
    if(!empty($Ficha)):
        $oTramos = new LinderoTramo();
        $Tramos = $oTramos->ObtenerLinderosTramos($Ficha->Id_Ficha);
    endif;

        $TramoFrente = ''; $TramoDerecha = ''; $TramoIzquierda = ''; $TramoFondo = '';
        foreach ($Tramos as $tramo) :
            if($tramo->CFrente!=0){ ($TramoFrente=='') ? ($TramoFrente = $tramo->CFrente) : ($TramoFrente = $TramoFrente.' ; '.$tramo->CFrente);}
            if($tramo->CDerecha!=0){ ($TramoDerecha=='') ? ($TramoDerecha = $tramo->CDerecha) : ($TramoDerecha = $TramoDerecha.' ; '.$tramo->CDerecha);}
            if($tramo->CIzquierda!=0){ ($TramoIzquierda=='') ? ($TramoIzquierda = $tramo->CIzquierda) : ($TramoIzquierda = $TramoIzquierda.' ; '.$tramo->CIzquierda);}
            if($tramo->CFondo!=0){ ($TramoFondo=='') ? ($TramoFondo = $tramo->CFondo) : ($TramoFondo = $TramoFondo.' ; '.$tramo->CFondo);}
        endforeach;

    # Obtenemos Los Servicios Basicos
    if(!empty($Ficha)):
        $oServicios_Basicos = new Servicios_Basicos();
        $Servicios_Basicos = $oServicios_Basicos->ObtenerServiciosBasicos($Ficha->Id_Ficha);
    endif;
    
    # Obtenemos Las Construcciones
    if(!empty($Ficha)):
        $oConstrucciones = new Construcciones();
        $Construcciones = $oConstrucciones->ObtenerConstrucciones($Ficha->Id_Ficha);
    endif;

    # Obtenemos Las Instalaciones
    if(!empty($Ficha)):
        $oInstalaciones = new Instalaciones();
        $Instalaciones = $oInstalaciones->ObtenerInstalaciones($Ficha->Id_Ficha);
    endif;

    # Obtenemos Los Documentos Adjuntos
    if(!empty($Ficha)):
        $oDocumentos_Adjuntos = new Documentos_Adjuntos();
        $Documentos_Adjuntos = $oDocumentos_Adjuntos->ObtenerDocumentosAdjuntos($Ficha->Id_Ficha);
    endif;

    # Obtenemos el Registro Legal
    if(!empty($Ficha)):
        $oRegistro_Legal = new Registro_Legal();
        $Registro_Legal = $oRegistro_Legal->ObtenerRegistroLegal($Ficha->Id_Ficha);
    endif;

    # Obtenemos La Notaria
    if(!empty($Registro_Legal)):
        $oNotaria = new Notarias();
        $Notaria = $oNotaria->ObtenerNotaria($Registro_Legal->IdNotaria);
    endif;

    # Obtenemos Sunarp
    if(!empty($Ficha)):
        $oSunarp = new Sunarp();
        $Sunarp = $oSunarp->ObtenerSunarp($Ficha->Id_Ficha);
    endif;
    //echo('<pre>');var_dump($Documentos_Adjuntos);echo('</pre>');

    # Obtenemos Domicilio_Fiscal
    if(!empty($Ficha)):
        $oDomicilio_Fiscal = new Domicilio_Fiscal();
        $Domicilio_Fiscal = $oDomicilio_Fiscal->ObtenerDomicilioFiscal($Ficha->Id_Ficha);
    endif;

    # Obtenemos Sys_Direcciones
    if(!empty($Domicilio_Fiscal)):
        $oSys_Direccion = new Sys_Direcciones();
        $Sys_Direccion = $oSys_Direccion->ObtenerSysDireccion($Domicilio_Fiscal->IdDirecciones);
    endif;

        # Obtenemos Habilitacion_Urbana
        if(!empty($Sys_Direccion)):
            $oHabilitacion_Urbana = new Habilitacion_Urbana();
            $Habilitacion_Urbana = $oHabilitacion_Urbana->ObtenerHU($Sys_Direccion->IdHU);
        endif;

    # Obtenemos Litigantes
    if(!empty($Ficha)):
        $oLitigantes = new Litigantes();
        $Litigantes = $oLitigantes->ObtenerLitigantes($Ficha->Id_Ficha);
    endif;


    # Obtenemos Declarante
    if(!empty($Ficha)):
        $oDeclarante = new Personas();
        $Declarante = $oDeclarante->ObtenerPersona($Ficha->Declarante);
    endif;

    # Obtenemos Tecnico Catastral
    if(!empty($Ficha)):
        $oTecnicoC = new TecnicoC();
        $TecnicoC = $oTecnicoC->ObtenerTecnicoC($Ficha->Tecnico);
    endif;

    # Obtenemos Usuario
    if(!empty($Ficha)):
        $oUsuario = new Usuario();
        $Usuario = $oUsuario->ObtenerUsuario($Ficha->IdUsuario);
    endif;

        # Obtenemos Personal Digitador
        if(!empty($Usuario)):
            $oPersonal = new Personal();
            $Personal = $oPersonal->ObtenerPersonal($Usuario->IdPersonal);
        endif;
?>

<!--
<!DOCTYPE html>
<html lang="es">-->
<head>
    <meta charset="UTF-8">
    <title>Ficha Individual</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body> 
    <table id="NRO_FICHA" width="18%">
        <tr>
            <td colspan="3" class="text-left label_field">NÚMERO DE FICHA</td>
            <td colspan="2" class="text-center" ID="txtNroFicha" style="font-size:1.2em;font-weight:bold"><?php echo $Ficha->Nro_Ficha; ?></td>
        </tr>
    </table>

    <!-- 12 espacios-->
    <table id="CODIFICACION_FICHA" width="60%" style="margin:0 auto;">
        <caption><h2 class="text-center">FICHA CATASTRAL URBANA INDIVIDUAL</h2></caption>
        <tr>
            <td colspan="6" class="text-center label_field"><div class='label_order'>01</div>CODIGO UNICO CATASTRAL - CUC</td>
            <td colspan="6" class="text-center label_field"><div class='label_order'>02</div>CODIGO HOJA CATASTRAL</td>
        </tr> 
        <tr>
            <td colspan="4" class="text-center" ID="txtECodCata">&nbsp;<?php echo (isset($Uni_Cat))? $Uni_Cat->Cuc_Antecedente:'&nbsp;'; ?></td>
            <td colspan="2" class="text-center" ID="txtECUC">&nbsp;<?php echo (isset($Uni_Cat))? $Uni_Cat->Cuc:'&nbsp;'; ?></td>
            <td colspan="6" class="text-center" ID="txtECodHoja">&nbsp;<?php echo (isset($Uni_Cat))? $Uni_Cat->Codigo_Hoja_Cat:'&nbsp;'; ?></td>
        </tr>
        <tr>
            <td colspan="12" class="text-center label_field"><div class='label_order'>03</div>CODIGO DE REFERENCIA CATASTRAL</td>
        </tr>
        <tr>
            <td colspan="4" class="text-center label_field">UBIGEO</td>
            <td colspan="1" class="text-center label_field">SECTOR</td>
            <td colspan="1" class="text-center label_field">MANZANA</td>
            <td colspan="1" class="text-center label_field">LOTE</td>
            <td colspan="1" class="text-center label_field">EDIFICA</td>
            <td colspan="1" class="text-center label_field">ENTRADA</td>
            <td colspan="1" class="text-center label_field">PISO</td>
            <td colspan="1" class="text-center label_field">UNIDAD</td>
            <td colspan="1" class="text-center label_field">DC</td>
        </tr>
        <tr>
            <td colspan="4" class="text-center" id="txtubigeo"><?php echo substr($lote->Id_Lote,0,2); ?></td>
            <td colspan="1" class="text-center" id="txtsector"><?php echo substr($lote->Id_Lote,2,2); ?></td>
            <td colspan="1" class="text-center" id="txtmanzana"><?php echo substr($lote->Id_Lote,4,3); ?></td>
            <td colspan="1" class="text-center" id="txtlotedist"><?php echo substr($lote->Id_Lote,7,2); ?></td>
            <td colspan="1" class="text-center" id="txtedifica"><?php echo (!empty($Edificacion))? $Edificacion->Grupo_Edifica:'&nbsp;'; ?></td>
            <td colspan="1" class="text-center" id="txtentrada"><?php echo (isset($Uni_Cat))? $Uni_Cat->Cod_Entrada:'&nbsp;'; ?></td>
            <td colspan="1" class="text-center" id="txtpiso"><?php echo (isset($Uni_Cat))? $Uni_Cat->Cod_Piso:'&nbsp;'; ?></td>
            <td colspan="1" class="text-center" id="txtcodunidad"><?php echo (isset($Uni_Cat))? $Uni_Cat->Cod_Unidad:'&nbsp;'; ?></td>
            <td colspan="1" class="text-center" id="txtdc"><?php echo $Ficha->DC; ?></td>
        </tr>
        <tr>
            <td colspan="4" class="text-center label_field" width="30%"><div class='label_order'>04</div>&nbsp;&nbsp;CÓD. CONTRIBUYENTE DE RENTAS</td>
            <td colspan="4" class="text-center label_field" width="35%"><div class='label_order'>05</div>CÓD. PREDIAL DE RENTAS</td>
            <td colspan="4" class="text-center label_field"><div class='label_order'>06</div>&nbsp;&nbsp;&nbsp;UNIDAD ACUMULADORA A CODIGO PREDIAL DE RENTAS</td>
        </tr>
        <tr>
            <td colspan="4" class="text-center" ID="txtCodContribuye"><?php echo (!empty($Rentas))? $Rentas->CodContribuyente:'&nbsp;'; ?></td>
            <td colspan="4" class="text-center" ID="txtCodPRentas"><?php echo (!empty($Rentas))? $Rentas->CodPredial:'&nbsp;'; ?></td>
            <td colspan="4" class="text-center" ID="txtUniAcumulada"><?php echo (!empty($Rentas))? $Rentas->AcuCodPredial:'&nbsp;'; ?></td>
        </tr>
    </table>
    <br>

    <!-- 18 espacios-->
    <table id="UBICACION_PREDIO" width="100%">
        <caption style="text-left">UBICACIÓN DEL PREDIO CATASTRAL</caption>
        <tr>
            <td ID="Cod_Via" colspan="2" class="text-center label_field" width="14%"><div class='label_order'>07</div>CÓDIGO VÍA</td>

            <td ID="Tip_Via" colspan="2" class="text-center label_field" width="8%"><div class='label_order'>08</div>TIPO<br> DE VÍA</td>

            <td ID="Nom_Via" colspan="6" class="text-center label_field" width="25%"><div class='label_order'>09</div>NOMBRE DE VÍA</td>

            <td ID="Puerta" colspan="2" class="text-center label_field" width="15%"><div class='label_order'>10</div>TIPO<br> DE PUERTA</td>

            <td ID="NroMunicipal" colspan="2" class="text-center label_field" width="13%"><div class='label_order'>11</div>N° MUNICIPAL</td>

            <td ID="Condicion" colspan="2" class="text-center label_field" width="10%"><div class='label_order'>12</div>&nbsp;COND. NÚMER.</td>

            <td ID="Nro_Certificacion" colspan="2" class="text-center label_field" width="15%"><div class='label_order'>13</div>N° DE CER. DE NUMERACIÓN</td>
        </tr>
        <!-- INICIO DE BUCLE -->
        <?php if(!empty($Ingresos)): ?>
            <?php foreach($Ingresos as $ingreso): ?>
            <?php   $opuerta = new Puertas(); ?>
            <?php   $puerta = $opuerta->ObtenerPuerta($ingreso->IdPuerta); ?>
            <?php   $ovia = new Vias(); ?>
            <?php   $via = $ovia->ObtenerVia($puerta->IdVia); ?>
            <tr>
                <td colspan="2" style="text-align: center"><?php echo trim($via->Cod_Via); ?></td>
                <td colspan="2" style="text-align: center"><?php echo SelectorTipoVia($via->Tip_Via); ?></td>
                <td colspan="6" style="text-align: center"><?php echo trim($via->Nom_Via); ?></td>             
                <td colspan="2" style="text-align: center"><?php echo trim($puerta->Tip_Puerta); ?></td>
                <td colspan="2" style="text-align: center"><?php echo trim($puerta->Nro_Muni); ?></td>
                <td colspan="2" style="text-align: center"><?php echo trim($puerta->Condicion_Nro); ?></td>
                <td colspan="2" style="text-align: center"><?php echo trim($puerta->Nro_Certificacion); ?></td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="2" style="text-align: center">&nbsp;</td>
                <td colspan="2" style="text-align: center"></td>
                <td colspan="6" style="text-align: center"></td>             
                <td colspan="2" style="text-align: center"></td>
                <td colspan="2" style="text-align: center"></td>
                <td colspan="2" style="text-align: center"></td>
                <td colspan="2" style="text-align: center"></td>
            </tr>
        <?php endif; ?>
        <!-- FINAL DE BUCLE -->

        <tr width="100%">
            <!--<td colspan="1">14</td>-->
            <td colspan="3" class="text-center label_field" width="20%"><div class='label_order'>14</div>&nbsp;&nbsp;&nbsp;NOMBRE DE LA EDIFICACIÓN</td>
            <td colspan="4" class="text-center" width="25%"><?php echo (!empty($Edificacion))? trim($Edificacion->Nom_Edificacion):'&nbsp;'; ?></td>

            <!--<td colspan="1">15</td>-->
            <td colspan="2" class="text-center label_field" width="20%"><div class='label_order'>15</div>TIPO DE EDIFICACIÓN</td>
            <td colspan="1" class="text-center" width="5%"><?php echo (isset($Edificacion))? $Edificacion->Tip_Edificacion:'&nbsp;'; ?></td>

            <!--<td colspan="1">16</td>-->
            <td colspan="3" class="text-center label_field" width="10%"><div class='label_order'>16</div>TIPO DE INTERIOR</td>
            <td colspan="1" class="text-center" width="5%"><?php echo (isset($Uni_Cat))? $Uni_Cat->Tip_Interior:'&nbsp;'; ?></td>

            <!--<td colspan="1">17</td>-->
            <td colspan="3" class="text-center label_field" width="10%"><div class='label_order'>17</div>N° INTERIOR</td>
            <td colspan="1" class="text-center" width="5%"><?php echo (isset($Uni_Cat))? $Uni_Cat->Nro_Interior:'&nbsp;'; ?></td>
        </tr>

        <tr>
            <!--<td colspan="1">18</td>-->
            <td colspan="3" class="text-center label_field" width="20%"><div class='label_order'>18</div>CÓDIGO H.U.</td>
            <!--<td colspan="1">19</td>-->
            <td colspan="6" class="text-center label_field" width="50%"><div class='label_order'>19</div>NOMBRE DE LA HABILITACIÓN URBANA</td>
            <!--<td colspan="1">20</td>-->
            <td colspan="3" class="text-center label_field" width="15%"><div class='label_order'>20</div>ZONA/SECTOR/ETAPA</td>
            <!--<td colspan="1">21</td>-->
            <td colspan="2" class="text-center label_field" width="5%"><div class='label_order'>21</div>MANZANA</td>
            <!--<td colspan="1">22</td>-->
            <td colspan="2" class="text-center label_field" width="5%"><div class='label_order'>22</div>LOTE</td>
            <!--<td colspan="1">23</td>-->
            <td colspan="2" class="text-center label_field" width="5%"><div class='label_order'>23</div>SUB-LOTE</td>
        </tr>
        <tr>    
            <td colspan="3" class="text-center" width="20%"><?php echo (!empty($HU)) ? ($HU->Id_Hab_Urba) : '&nbsp;'; ?></td>
            <td colspan="6" class="text-center" width="50%"><?php echo (!empty($HU)) ? ($HU->Nom_Hab_Urba) : '&nbsp;'; ?></td>
            <td colspan="3" class="text-center" width="15%"><?php echo (!empty($HU)) ? ($HU->Grupo_Urba) : '&nbsp;'; ?></td>
            <td colspan="2" class="text-center" width="5%"><?php echo $lote->Mzna_Dist; ?></td>
            <td colspan="2" class="text-center" width="5%"><?php echo $lote->Lote_Dist; ?></td>
            <td colspan="2" class="text-center" width="5%"><?php echo $lote->Sub_Lote_Dist; ?></td>
        </tr>
    </table>
    <br>

    <!-- 16 espacios-->
    <table id="IDENTIFICACION_TITULAR" width="100%">
        <caption style="text-left">IDENTIFICACIÓN DEL TITULAR CATASTRAL</caption>
        <tr>
            <!--<td colspan="1">24</td>-->
            <td colspan="3" class="text-center label_field"><div class='label_order'>24</div>TIPO DE TITULAR</td>
            <td colspan="1" class="text-center"><?php echo (!empty($Personas))? $Personas[0]->Tip_Persona:'&nbsp;'; ?></td>
            <!--<td colspan="1">25</td>-->
            <td colspan="3" class="text-center label_field"><div class='label_order'>25</div>ESTADO CIVIL</td>
            <td colspan="1" class="text-center"><?php echo (!empty($Personas))? ((($Personas[0]->Tip_Persona)==1) ? ($Personas[0]->Estado_Civil):''):'&nbsp;'; ?></td>
            <td colspan="8" class="text-center bloque-nulo"> SOLTERO | CASADO | DIVORCIADO | VIUDO | CONVIVIENTE</td>
        </tr>

        <!-- INICIO DE BUCLE -->
        <?php foreach($Personas as $persona): ?>
        <tr>
            <!--<td colspan="1">26</td>-->
            <td colspan="3" class="text-center label_field"><div class='label_order'>26</div>TIPO DOC. IDENTIDAD</td>
            <td colspan="1" class="text-center"><?php echo (!empty($Personas))? ((($Personas[0]->Tip_Persona)==1) ? ($persona->Tip_Doc):''):''; ?></td>
            <!--<td colspan="1">27</td>-->
            <td colspan="3" class="text-center label_field"><div class='label_order'>27</div>N° DOC.</td> 
            <td colspan="1" class="text-center"><?php echo (!empty($Personas))? ((($Personas[0]->Tip_Persona)==1) ? ($persona->Nro_Doc):''):''; ?></td>
            <!--<td colspan="1">28</td>-->
            <td colspan="2" class="text-center label_field"><div class='label_order'>28</div>NOMBRES</td>
            <td colspan="6" class="text-center"><?php echo (!empty($Personas))? ((($Personas[0]->Tip_Persona)==1) ? ($persona->Nombres):''):''; ?></td>
        </tr>

        <tr>
            <!--<td colspan="1">29</td>-->
            <td colspan="8" class="text-center label_field"><div class='label_order'>29</div>APELLIDO PATERNO</td>
            <!--<td colspan="1">30</td>-->
            <td colspan="8" class="text-center label_field"><div class='label_order'>30</div>APELLIDO MATERNO</td> 
        </tr>
        <tr>
            <td colspan="8" class="text-center"><?php echo (!empty($Personas))? ((($Personas[0]->Tip_Persona)==1) ? ($persona->Ape_Paterno):''):''; ?></td>
            <td colspan="8" class="text-center"><?php echo (!empty($Personas))? ((($Personas[0]->Tip_Persona)==1) ? ($persona->Ape_Materno):''):''; ?></td>
        </tr>
        <?php endforeach; ?>
        <!-- FINAL DE BUCLE -->

        <tr>
            <!--<td colspan="1">31</td>-->
            <td colspan="2" class="text-center label_field"><div class='label_order'>31</div>N° DE R.U.C.</td>
            <td colspan="4" style="text-align: center"><?php echo (!empty($Personas))? ((($Personas[0]->Tip_Persona)==2) ? ($persona->Nro_Doc):''):'&nbsp;'; ?></td>
            <!--<td colspan="1">32</td>-->
            <td colspan="2" class="text-center label_field"><div class='label_order'>32</div>RAZÓN SOCIAL</td> 
            <td colspan="8" class="text-center"><?php echo (!empty($Personas))? ((($Personas[0]->Tip_Persona)==2) ? ($persona->Nombres):''):''; ?></td>
        </tr>

        <tr>
            <!--<td colspan="1">33</td>-->
            <td colspan="3" class="text-center label_field"><div class='label_order'>33</div>PERSONA JURÍDICA</td>
            <td colspan="1" style="text-align: center"><?php echo (!empty($Personas))? ((($Personas[0]->Tip_Persona)==2) ? ($persona->Tip_Persona_Juridica):''):'&nbsp;'; ?></td> 
            <!--<td colspan="1">34</td>-->
            <td colspan="5" class="text-center label_field"><div class='label_order'>34</div>COND. ESP. DEL TITULAR</td> 
            <td colspan="1" style="text-align: center"><?php echo (!empty($Titulares))? (($Titulares[0]->Condic_Titular != "05" || $Titulares[0]->Condic_Titular != "06") ? (!empty($Exoneraciones_Titular) ? $Exoneraciones_Titular->Condicion:''):''):'&nbsp;'; ?></td>
            <td colspan="6" class="bloque-nulo" style="text-align: center"></td>
        </tr>

        <tr>
            <!--<td colspan="1">35</td>-->
            <td colspan="3" class="text-center label_field"><div class='label_order'>35</div>N° DE RESOLUCIÓN<br> DE EXONERACIÓN</td>
            <td colspan="1" style="text-align: center"><?php echo (!empty($Titulares))? (($Titulares[0]->Condic_Titular != "05" || $Titulares[0]->Condic_Titular != "06") ? (!empty($Exoneraciones_Titular) ? $Exoneraciones_Titular->Nro_Resolucion:''):''):''; ?></td>
            <!--<td colspan="1">36</td>-->
            <td colspan="3" class="text-center label_field"><div class='label_order'>36</div>N° DE BOLETA<br> DE PENSIONISTA</td>
            <td colspan="1" style="text-align: center"><?php echo (!empty($Titulares))? (($Titulares[0]->Condic_Titular != "05" || $Titulares[0]->Condic_Titular != "06") ? (!empty($Exoneraciones_Titular) ? $Exoneraciones_Titular->Nro_Boleta_Pension:''):''):''; ?></td>
            <!--<td colspan="1">37</td>-->
            <td colspan="3" class="text-center label_field"><div class='label_order'>37</div>FECHA DE INICIO<br> DE LA EXONERACIÓN</td>
            <td colspan="1" style="text-align: center"><?php echo (!empty($Titulares))? (($Titulares[0]->Condic_Titular != "05" || $Titulares[0]->Condic_Titular != "06") ? (!empty($Exoneraciones_Titular) ? $Exoneraciones_Titular->Fecha_Inicio:''):''):''; ?></td>
            <!--<td colspan="1">38</td>-->
            <td colspan="3" class="text-center label_field"><div class='label_order'>38</div>FECHA DE VENCIMIENTO<br> DE LA EXONERACIÓN</td>
            <td colspan="1" style="text-align: center"><?php echo (!empty($Titulares))? (($Titulares[0]->Condic_Titular != "05" || $Titulares[0]->Condic_Titular != "06") ? (!empty($Exoneraciones_Titular) ? $Exoneraciones_Titular->Fecha_Vencimiento:''):''):''; ?></td>
        </tr>
    </table>
    <br>

    <!-- 21 espacios-->
    <table id="DOMICILIO_FISCAL_TITULAR" width="100%">
        <caption style="text-left">DOMICILIO FISCAL DEL TITULAR CATASTRAL</caption>
        <tr>
            <!--<td colspan="1">39</td>-->
            <td colspan="3" class="text-center label_field"><div class='label_order'>39</div><div class='label_order'>38</div>DEPARTAMENTO</td>
            <!--<td colspan="1">40</td>-->
            <td colspan="3" class="text-center label_field"><div class='label_order'>40</div>PROVINCIA</td>
            <!--<td colspan="1">41</td>-->
            <td colspan="3" class="text-center label_field"><div class='label_order'>41</div>DISTRITO</td>
            <!--<td colspan="1">42</td>-->
            <td colspan="3" class="text-center label_field"><div class='label_order'>42</div>TELÉFONO</td> 
            <!--<td colspan="1">43</td>-->
            <td colspan="3" class="text-center label_field"><div class='label_order'>43</div>ANEXO</td>
            <!--<td colspan="1">44</td>-->
            <td colspan="3" class="text-center label_field"><div class='label_order'>44</div>FAX</td> 
            <!--<td colspan="1">45</td>-->
            <td colspan="3" class="text-center label_field"><div class='label_order'>45</div>CORREO ELECTRÓNICO</td>
        </tr>
        <tr>
            <td colspan="3" class="text-center"><?php echo (!empty($Domicilio_Fiscal)) ? trim($Domicilio_Fiscal->Departamento):'&nbsp;'; ?></td>
            <td colspan="3" class="text-center"><?php echo (!empty($Domicilio_Fiscal)) ? trim($Domicilio_Fiscal->Provincia):'&nbsp;'; ?></td>
            <td colspan="3" class="text-center"><?php echo (!empty($Domicilio_Fiscal)) ? trim($Domicilio_Fiscal->Nombre_Distrito):'&nbsp;'; ?></td>
            <td colspan="3" class="text-center"><?php echo (!empty($Titulares)) ? trim($Titulares[0]->Telefono):'&nbsp;'; ?></td> 
            <td colspan="3" class="text-center"><?php echo (!empty($Titulares)) ? trim($Titulares[0]->Anexo):'&nbsp;'; ?></td>
            <td colspan="3" class="text-center"><?php echo (!empty($Titulares)) ? trim($Titulares[0]->Fax):'&nbsp;'; ?></td> 
            <td colspan="3" class="text-center"><?php echo (!empty($Titulares)) ? trim($Titulares[0]->Correo_Elect):'&nbsp;'; ?></td>
        </tr>

        <tr>
            <!--<td colspan="1">07</td>-->
            <td colspan="3" class="text-center label_field"><div class='label_order'>07</div>CÓDIGO DE VÍA</td>
            <!--<td colspan="1">08</td>-->
            <td colspan="3" class="text-center label_field"><div class='label_order'>08</div>TIPO DE VÍA</td>
            <!--<td colspan="1">09</td>-->
            <td colspan="5" class="text-center label_field"><div class='label_order'>09</div>NOMBRE DE VÍA</td>
            <!--<td colspan="1">11</td>-->
            <td colspan="3" class="text-center label_field"><div class='label_order'>11</div>N° MUNICIPAL</td> 
            <!--<td colspan="1">14</td>-->
            <td colspan="4" class="text-center label_field"><div class='label_order'>14</div>NOMBRE DE EDIFICACIÓN</td>
            <!--<td colspan="1">17</td>-->
            <td colspan="3" class="text-center label_field"><div class='label_order'>17</div>N° INTERIOR</td> 
        </tr>
        <tr>
            <td colspan="3" style="text-align: center"><?php echo (!empty($Domicilio_Fiscal)) ? trim($Domicilio_Fiscal->Cod_Via):'&nbsp;'; ?></td>
            <td colspan="3" style="text-align: center"><?php echo (!empty($Domicilio_Fiscal)) ? SelectorTipoVia($Domicilio_Fiscal->Tip_Via):'&nbsp;'; ?></td>
            <td colspan="5" style="text-align: center"><?php echo (!empty($Domicilio_Fiscal)) ? trim($Domicilio_Fiscal->Nombre_Via):'&nbsp;'; ?></td>
            <td colspan="3" style="text-align: center"><?php echo (!empty($Sys_Direccion)) ? trim($Sys_Direccion->Nro_Muni):'&nbsp;'; ?></td> 
            <td colspan="4" style="text-align: center"><?php echo (!empty($Edificacion))? trim($Edificacion->Nom_Edificacion):'&nbsp;'; ?></td>
            <td colspan="3" style="text-align: center"><?php echo (!empty($Sys_Direccion)) ? trim($Sys_Direccion->Nro_Interior):'&nbsp;'; ?></td>
        </tr>

        <tr>
            <!--<td colspan="1">18</td>-->
            <td colspan="3" class="text-center label_field"><div class='label_order'>18</div>CÓDIGO DE H.U.</td>
            <!--<td colspan="1">19</td>-->
            <td colspan="3" class="text-center label_field"><div class='label_order'>19</div>HABILITACIÓN URBANA</td>
            <!--<td colspan="1">20</td>-->
            <td colspan="5" class="text-center label_field"><div class='label_order'>20</div>ZONA / SECTOR / ETAPA</td>
            <!--<td colspan="1">21</td>-->
            <td colspan="3" class="text-center label_field"><div class='label_order'>21</div>MANZANA</td> 
            <!--<td colspan="1">22</td>-->
            <td colspan="4" class="text-center label_field"><div class='label_order'>22</div>LOTE</td>
            <!--<td colspan="1">23</td>-->
            <td colspan="3" class="text-center label_field"><div class='label_order'>23</div>SUBLOTE</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: center"><?php echo (!empty($Habilitacion_Urbana)) ? trim($Habilitacion_Urbana->Id_Hab_Urba):'&nbsp;'; ?></td>
            <td colspan="3" style="text-align: center"><?php echo (!empty($Habilitacion_Urbana)) ? trim($Habilitacion_Urbana->Nom_Hab_Urba):'&nbsp;'; ?></td>
            <td colspan="5" style="text-align: center"><?php echo (!empty($Habilitacion_Urbana)) ? trim($Habilitacion_Urbana->Grupo_Urba):'&nbsp;';?></td>
            <td colspan="3" style="text-align: center"><?php echo (!empty($Sys_Direccion)) ? trim($Sys_Direccion->Mzna_Muni):'&nbsp;'; ?></td> 
            <td colspan="4" style="text-align: center"><?php echo (!empty($Sys_Direccion)) ? trim($Sys_Direccion->Lote_Muni):'&nbsp;'; ?></td>
            <td colspan="3" style="text-align: center"><?php echo (!empty($Sys_Direccion)) ? trim($Sys_Direccion->Sub_Lote_Muni):'&nbsp;'; ?></td>
        </tr>
    </table>
    <br>

    <!-- 16 espacios-->
    <table id="CARACTERISTICAS_TITULARIDAD" width="100%">
        <caption style="text-left">CARACTERISTICAS DE LA TITULARIDAD</caption>
        <tr>
            <td class="text-center label_field"><div class='label_order'>46</div>CONDICIÓN DEL TITULAR</td>
            <td class="text-center"><?php echo (!empty($Titulares))? ($Titulares[0]->Condic_Titular):''; ?></td>
            <td colspan="6" class="bloque-nulo">PROPIETARIO UNICO | SUCESIÓN INTESTADA | POSEEDOR | ... | OTROS</td>
        </tr>

        <tr>
            <td class="text-center label_field"><div class='label_order'>47</div>FORMA DE ADQUISIÓN</td>
            <td class="text-center"><?php echo (!empty($Titulares))? trim($Titulares[0]->Forma_Adquisicion):''; ?></td>
            <td width="18%" class="text-center label_field"><div class='label_order'>48</div>FECHA DE ADQUISIÓN</td>
            <td width="8%"><?php echo (!empty($Titulares))? trim($Titulares[0]->Fecha_Adquisicion):''; ?></td>
            <td colspan="4" class="bloque-nulo">COMPRA VENTA | ANTICIPO | TESTAMENTO DONACION |..</td>
        </tr>

        <tr>
            <td width="25%" class="text-center label_field"><div class='label_order'>49</div>CONDICIÓN ESPECIAL DEL PREDIO</td>
            <td width="4%"></td>
            <td colspan="6" class="bloque-nulo text-center">MONUMENTOS HISTORICOS | PREDIO RUSTICO | SISTEMA DE AYUDA | OTROS</td>
        </tr>

        <tr>
            <td colspan="1" class="text-center label_field"><div class='label_order'>50</div>N° RESOLUCIÓN DE<br> EXONERACIÓN DEL PREDIO</td>
            <td colspan="1" width="4%" class="text-center"></td>
            <!--<td colspan="1">51</td>-->
            <td colspan="1" class="text-center label_field"><div class='label_order'>51</div>PORCENTAJE</td>
            <td colspan="1" class="text-center"></td>
            <!--<td colspan="1">52</td>-->
            <td width="12%" class="text-right label_field"><div class='label_order'>52</div>FECHA DE INICIO&nbsp;&nbsp;</td>
            <td width="8%" class="text-center"></td>
            <!--<td colspan="1">53</td>-->
            <td width="16%" class="text-right label_field"><div class='label_order'>53</div>FECHA DE VENCIMIENTO&nbsp;&nbsp;</td>
            <td width="8%" class="text-center"></td>
        </tr>
    </table>
    <br>

    <!-- 18 espacios-->
    <table id="DESCRIPCION_PREDIO" width="100%">
        <caption style="text-left">DESCRIPCIÓN DEL PREDIO</caption>
        <tr>
            <!--<td colspan="1">54</td>-->
            <td colspan="5" class="text-center label_field"><div class='label_order'>54</div>CLASIFICACIÓN DEL PREDIO</td>
            <td colspan="1"><?php echo (!empty($Ficha_Individual)) ? ($Ficha_Individual->Clasificacion):'&nbsp;'; ?></td>
            <td colspan="12" class="bloque-nulo" style="text-align: center">CASA-HABITACION | TIENDA-DEPOSITO-ALMACÉN | PREDIO EN EDIFICIO | OTROS </td>
        </tr>

        <tr>
            <!--<td colspan="1">55</td>-->
            <td colspan="5" class="text-center label_field"><div class='label_order'>55</div>PREDIO CATASTRAL EN</td>
            <td colspan="1"><?php echo (!empty($Ficha_Individual)) ? ($Ficha_Individual->Contenido_En):'&nbsp;'; ?></td>
            <td colspan="12" class="bloque-nulo" style="text-align: center">GALERIA | MERCADO | CAMPO FERIAL | CENTRO COMERCIAL | QUINTA | ...</td>
        </tr>

        <tr>
            <!--<td colspan="1">56</td>-->
            <td colspan="3" class="text-center label_field"><div class='label_order'>56</div>CÓDIGO DE USO</td>
            <!--<td colspan="1">57</td>-->
            <td colspan="8" class="text-center label_field"><div class='label_order'>57</div>USO DEL PREDIO CATASTRAL</td>
            <!--<td colspan="1">58</td>-->
            <td colspan="4" class="text-center label_field"><div class='label_order'>58</div>ESTRUCTURACIÓN</td>
            <!--<td colspan="1">59</td>-->
            <td colspan="3" class="text-center label_field"><div class='label_order'>59</div>ZONIFICACIÓN</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: center"><?php echo (!empty($Uso)) ? ($Uso->Cod_Uso):'&nbsp;'; ?></td> 
            <td colspan="8" style="text-align: center"><?php echo (!empty($Uso)) ? ($Uso->Desc_Uso):'&nbsp;'; ?></td> 
            <td colspan="4" style="text-align: center"><?php echo $lote->Estructuracion; ?></td>
            <td colspan="3" style="text-align: center"><?php echo $lote->Zonificacion; ?></td>
        </tr>

        <tr>
            <!--<td colspan="1">60</td>-->
            <td colspan="6" class="text-center label_field"><div class='label_order'>60</div>ÁREA DE TERRENO TITULO (M2)</td>
            <!--<td colspan="1">61</td>-->
            <td colspan="6" class="text-center label_field"><div class='label_order'>61</div>ÁREA DE TERRENO DECLARADO (M2)</td>
            <!--<td colspan="1">62</td>-->
            <td colspan="6" class="text-center label_field"><div class='label_order'>62</div>ÁREA DE TERRENO VERIFICADO (M2)</td>
        </tr>
        <tr>
            <td colspan="6" style="text-align: center"><?php echo (!empty($Ficha_Individual)) ? (float)($Ficha_Individual->Area_Titulo):'&nbsp;'; ?></td>  
            <td colspan="6" style="text-align: center"><?php echo (!empty($Ficha_Individual)) ? (float)($Ficha_Individual->Area_Declarada):'&nbsp;'; ?></td>   
            <td colspan="6" style="text-align: center"><?php echo (!empty($Ficha_Individual)) ? (float)($Ficha_Individual->Area_Verificada):'&nbsp;'; ?></td>
        </tr>

        <tr>
            <td colspan="4" class="text-left label_field">LINDEROS DE LOTE (ML)</td>
            <!--<td colspan="1">63</td>-->
            <td colspan="3" class="text-center label_field"><div class='label_order'>63</div>MEDIDA EN CAMPO</td>
            <!--<td colspan="1">64</td>-->
            <td colspan="3" class="text-center label_field"><div class='label_order'>64</div>MEDIDA SEGÚN TITULO</td>
            <!--<td colspan="1">65</td>-->
            <td colspan="4" class="text-center label_field"><div class='label_order'>65</div>COLINDANCIAS EN CAMPO</td>
            <!--<td colspan="1">66</td>-->
            <td colspan="4" class="text-center label_field"><div class='label_order'>66</div>COLINDANCIAS SEGUN TITULO</td>
        </tr>
        <tr>
            <td colspan="4" class="text-left label_field">FRENTE</td>
            <td colspan="3" style="text-align: center"><?php echo $TramoFrente; ?></td>
            <td colspan="3" style="text-align: center"></td>
            <td colspan="4" style="text-align: center"><?php echo (!empty($Linderos)) ? trim($Linderos->Frente_Colinda_Campo):'&nbsp;'; ?></td>
            <td colspan="4" style="text-align: center"></td>
        </tr>
        <tr>
            <td colspan="4" class="text-left label_field">DERECHA</td>
            <td colspan="3" style="text-align: center"><?php echo $TramoDerecha; ?></td>
            <td colspan="3" style="text-align: center"></td>
            <td colspan="4" style="text-align: center"><?php echo (!empty($Linderos)) ? trim($Linderos->Der_Colinda_Campo):'&nbsp;'; ?></td>
            <td colspan="4" style="text-align: center"></td>
        </tr>
        <tr>
            <td colspan="4" class="text-left label_field">IZQUIERDA</td>
            <td colspan="3" style="text-align: center"><?php echo $TramoIzquierda; ?></td>
            <td colspan="3" style="text-align: center"></td> 
            <td colspan="4" style="text-align: center"><?php echo (!empty($Linderos)) ? trim($Linderos->Izq_Colinda_Campo):'&nbsp;'; ?></td>
            <td colspan="4" style="text-align: center"></td>
        </tr>
        <tr>
            <td colspan="4" class="text-left label_field">FONDO</td>
            <td colspan="3" style="text-align: center"><?php echo $TramoFondo; ?></td>
            <td colspan="3" style="text-align: center"></td> 
            <td colspan="4" style="text-align: center"><?php echo (!empty($Linderos)) ? trim($Linderos->Fondo_Colinda_Campo):'&nbsp;'; ?></td>
            <td colspan="4" style="text-align: center"></td>
        </tr>
    </table>
    <br>

    <!-- 37 espacios-->
    <table id="SERVICIOS_BASICOS" width="100%">
        <caption class="text-left">SERVICIOS BÁSICOS</caption>
        <tr>
            <!--<td colspan="1">67</td>-->
            <td colspan="2" class="text-right label_field"><div class='label_order'>67</div>LUZ</td>
            <td colspan="1" style="text-align: center">
                <?php echo (!empty($Servicios_Basicos)) ? (($Servicios_Basicos->Luz == 1) ? 'SI':'NO'):''; ?>
            </td>
            <!--<td colspan="1">68</td>-->
            <td colspan="2" class="text-right label_field"><div class='label_order'>68</div>AGUA</td>
            <td colspan="1" style="text-align: center">
                <?php echo (!empty($Servicios_Basicos)) ? (($Servicios_Basicos->Agua == 1) ? 'SI':'NO'):''; ?>
            </td>
            <!--<td colspan="1">69</td>-->
            <td colspan="2" class="text-right label_field"><div class='label_order'>69</div>TELÉF.</td>
            <td colspan="1" style="text-align: center">
                <?php echo (!empty($Servicios_Basicos)) ? (($Servicios_Basicos->Telefono == 1) ? 'SI':'NO'):''; ?>
            </td>
            <!--<td colspan="1">70</td>-->
            <td colspan="3" class="text-right label_field"><div class='label_order'>70</div>DESAGUE</td>
            <td colspan="1" style="text-align: center">
                <?php echo (!empty($Servicios_Basicos)) ? (($Servicios_Basicos->Desague == 1) ? 'SI':'NO'):''; ?>
            </td>
            <!--<td colspan="1">71</td>-->
            <td colspan="6" class="text-right label_field"><div class='label_order'>71</div>N° SUM. LUZ</td>
            <td colspan="2" class="text-center"><?php echo (!empty($Servicios_Basicos)) ? ($Servicios_Basicos->Nro_Sum_Luz):'&nbsp;'; ?></td>
            <!--<td colspan="1">72</td>-->
            <td colspan="8" class="text-right label_field"><div class='label_order'>72</div>N° CONTRATO DE AGUA</td>
            <td colspan="2" class="text-center"><?php echo (!empty($Servicios_Basicos)) ? ($Servicios_Basicos->Nro_Contrato_Agua):'&nbsp;'; ?></td>
            <!--<td colspan="1">73</td>-->
            <td colspan="4" class="text-right label_field"><div class='label_order'>73</div>N° TELEFONO</td>
            <td colspan="2" class="text-center" width="8%"><?php echo (!empty($Servicios_Basicos)) ? ($Servicios_Basicos->Nro_Telefono):'&nbsp;'; ?></td>
        </tr>
    </table>
    <br>

    <!-- 57 espacios-->
    <table id="CONSTRUCCIONES" width="100%">
        <caption style="text-left">CONSTRUCCIONES</caption>
        <tr>
            <!--<td rowspan="3" colspan="1">74</td>-->
            <td rowspan="3" colspan="6" class="text-center label_field"><div class='label_order'>74</div>N° PISO SOTANO MEZZANINE</td>

            <!--<td rowspan="3" colspan="1">75</td>-->
            <td rowspan="3" colspan="5" class="text-center label_field"><div class='label_order'>75</div>FECHA DE CONSTRUC.</td>

            <!--<td rowspan="3" colspan="1">76</td>-->
            <td rowspan="3" colspan="3" class="text-center label_field"><div class='label_order'>76</div>MEP</td>

            <!--<td rowspan="3" colspan="1">77</td>-->
            <td rowspan="3" colspan="3" class="text-center label_field"><div class='label_order'>77</div>ECS</td>

            <!--<td rowspan="3" colspan="1">78</td>-->
            <td rowspan="3" colspan="3" class="text-center label_field"><div class='label_order'>78</div>ECC</td>

            <td colspan="28" class="text-center label_field">CATEGORÍAS</td>

            <td colspan="6" class="text-center label_field">ÁREA CONSTRUIDA (M2)</td>
            
            <!--<td rowspan="3" colspan="1">88</td>-->
            <td rowspan="3" colspan="3" class="text-center label_field"><div class='label_order'>88</div>UCA</td>
        </tr>
        <tr>
            <td colspan="8" class="text-center label_field">ESTRUCTURA</td>
            <td colspan="16" class="text-center label_field">ACABADOS</td>

            <!--<td rowspan="2" colspan="1">85</td>-->
            <td rowspan="2" colspan="4" class="text-center label_field"><div class='label_order'>85</div>INST. ELEC SANIT</td>

            <!--<td rowspan="2" colspan="1">86</td>-->
            <td rowspan="2" colspan="3" class="text-center label_field"><div class='label_order'>86</div>DECLARADA</td>

            <!--<td rowspan="2" colspan="1">87</td>-->
            <td rowspan="2" colspan="3" class="text-center label_field"><div class='label_order'>87</div>VERIFICADA</td>
        </tr>
        <tr>
            <!--<td colspan="1">79</td>-->
            <td colspan="4" class="text-center label_field"><div class='label_order'>79</div>MUR<br> &<br> COL</td>

            <!--<td colspan="1">80</td>-->
            <td colspan="4" class="text-center label_field"><div class='label_order'>80</div>TECHOS</td>

            <!--<td colspan="1">81</td>-->
            <td colspan="4" class="text-center label_field"><div class='label_order'>81</div>PISOS</td>

            <!--<td colspan="1">82</td>-->
            <td colspan="4" class="text-center label_field"><div class='label_order'>82</div>PU<br> &<br> VEN</td>
            
            <!--<td colspan="1">83</td>-->
            <td colspan="4" class="text-center label_field"><div class='label_order'>83</div>REVEST.</td>
            
            <!--<td colspan="1">84</td>-->
            <td colspan="4" class="text-center label_field"><div class='label_order'>84</div>BAÑOS</td>
        </tr>
        
        <!-- INICIO DE BUCLE -->
        <?php foreach($Construcciones as $construccion) : ?>
        <tr>
            <td colspan="6" class="text-center"><?php echo $construccion->Nro_Piso; ?></td>
            <td colspan="5" class="text-center"><?php echo $construccion->Mes.'/'.$construccion->Anio; ?></td>
            <td colspan="3" class="text-center"><?php echo $construccion->Mep; ?></td>
            <td colspan="3" class="text-center"><?php echo $construccion->Ecs; ?></td>
            <td colspan="3" class="text-center"><?php echo $construccion->Ecc; ?></td>
            
            <td colspan="4" style="text-align: center"><?php echo $construccion->Estru_Muro_Col; ?></td>
            <td colspan="4" style="text-align: center"><?php echo $construccion->Estru_Techo; ?></td>
            <td colspan="4" style="text-align: center"><?php echo $construccion->Acaba_Piso; ?></td>
            <td colspan="4" style="text-align: center"><?php echo $construccion->Acaba_Puerta_Ven; ?></td>
            <td colspan="4" style="text-align: center"><?php echo $construccion->Acaba_Revest; ?></td>
            <td colspan="4" style="text-align: center"><?php echo $construccion->Acaba_Bano; ?></td>
            <td colspan="4" style="text-align: center"><?php echo $construccion->Inst_Elect_Sanita; ?></td>

            <td colspan="3" style="text-align: center"><?php echo $construccion->Area_Declarada; ?></td>
            <td colspan="3" style="text-align: center"><?php echo $construccion->Area_Verificada; ?></td>

            <td colspan="3" class="text-center"><?php echo $construccion->Uca; ?></td>
        </tr>
        <?php endforeach; ?>
        <!-- FIN DE BUCLE -->

        <tr>
            <!--<td colspan="1">89</td>-->
            <td colspan="6" class="text-right label_field"><div class='label_order'>89</div>% BIEN COMÚN</td>
            <td colspan="5" class="text-center label_field">TERRENO</td>
            <td colspan="5" class="text-center label_field">CONSTRUC.</td>
            <td colspan="41" class="bloque-nulo" style="text-align: center">MEP:CONCRETO|LADRILLO|ADOBE(QUINCHA,MADERA)   ECS:MUY BUENO|BUENO|REGULAR|MALO   ECC:TERMINADO|EN CONSTRUCCION|..</td>
        </tr>
        <tr>
            <td colspan="6" class="text-center label_field">LEGAL</td>
            <td colspan="5" class="text-center"><?php echo (!empty($Ficha_Individual)) ? (float)($Ficha_Individual->Porc_BC_Terr_Legal) : '&nbsp;'; ?>%</td>
            <td colspan="5" class="text-center"><?php echo (!empty($Ficha_Individual)) ? (float)($Ficha_Individual->Porc_BC_Terr_Const) : '&nbsp;'; ?>%</td>
            <td colspan="41" class="bloque-nulo" style="text-align: center">MEP:CONCRETO|LADRILLO|ADOBE(QUINCHA,MADERA)   ECS:MUY BUENO|BUENO|REGULAR|MALO   ECC:TERMINADO|EN CONSTRUCCION|..</td>
        </tr>
        <tr>
            <td colspan="6" class="text-center label_field">FÍSICO</td>
            <td colspan="5" class="text-center"><?php echo (!empty($Ficha_Individual)) ? (float)($Ficha_Individual->Porc_BC_Fisc_Legal) : '&nbsp;'; ?>%</td>
            <td colspan="5" class="text-center"><?php echo (!empty($Ficha_Individual)) ? (float)($Ficha_Individual->Porc_BC_Fisc_Const) : '&nbsp;'; ?>%</td>
            <td colspan="41" class="bloque-nulo" style="text-align: center">MEP:CONCRETO|LADRILLO|ADOBE(QUINCHA,MADERA)   ECS:MUY BUENO|BUENO|REGULAR|MALO   ECC:TERMINADO|EN CONSTRUCCION|..</td>
        </tr>
    </table>
    <br>

    <!-- 60 espacios-->
    <table id="INSTALACIONES" width="100%">
        <caption class="text-left">OBRAS COMPLEMENTARIAS / OTRAS INSTALACIONES</caption>
        <tr>
            <!--<td colspan="1">90</td>-->
            <td colspan="5" class="text-right label_field" width="7%"><div class='label_order'>90</div>CÓDIGO</td>

            <!--<td colspan="1">91</td>-->
            <td colspan="9" class="text-center label_field"><div class='label_order'>91</div>DESCRIPCIÓN</td>

            <!--<td colspan="1">75</td>-->
            <td colspan="6" class="text-center label_field"><div class='label_order'>75</div>FECHA<br> CONST.</td>

            <!--<td colspan="1">76</td>-->
            <td colspan="4" class="text-center label_field"><div class='label_order'>76</div>MEP</td>

            <!--<td colspan="1">77</td>-->
            <td colspan="4" class="text-center label_field"><div class='label_order'>77</div>ECS</td>

            <!--<td colspan="1">78</td>-->
            <td colspan="4" class="text-center label_field"><div class='label_order'>78</div>ECC</td>

            <!--<td colspan="1">92</td>-->
            <td colspan="4" class="text-center label_field"><div class='label_order'>92</div>LARGO</td>

            <!--<td colspan="1">93</td>-->
            <td colspan="4" class="text-center label_field"><div class='label_order'>93</div>ANCHO</td>

            <!--<td colspan="1">94</td>-->
            <td colspan="4" class="text-center label_field"><div class='label_order'>94</div>ALTO</td>

            <!--<td colspan="1">95</td>-->
            <td colspan="6" class="text-center label_field"><div class='label_order'>95</div>PRODUCTO<br> TOTAL</td>

            <!--<td colspan="1">96</td>-->
            <td colspan="6" class="text-center label_field"><div class='label_order'>96</div>UNIDAD<br> DE MEDIDA</td>

            <!--<td colspan="1">88</td>-->
            <td colspan="4" class="text-center label_field"><div class='label_order'>88</div>UCA</td>
        </tr>
        
        <!-- INICIO DE BUCLE -->
        <?php if(!empty($Instalaciones)): ?>
        <?php   foreach($Instalaciones as $instalacion) : ?>
        <?php       $oCodigos_Instalaciones = new Codigos_Instalaciones(); ?>
        <?php       $Codigos_Instalaciones = $oCodigos_Instalaciones->ObtenerCodInstalacion($instalacion->IdCodInst); ?>
        <tr>
            <td colspan="5" class="text-center"><?php echo $Codigos_Instalaciones->Cod_Instalacion; ?></td>

            <td colspan="9" class="text-center"><?php echo $Codigos_Instalaciones->Desc_Instalacion.' '.$Codigos_Instalaciones->Material; ?></td>

            <td colspan="6" class="text-center"><?php echo $instalacion->Mes.'/'.$instalacion->Anio; ?></td>

            <td colspan="4" class="text-center"><?php echo $instalacion->Mep; ?></td>

            <td colspan="4" class="text-center"><?php echo $instalacion->Ecs; ?></td>

            <td colspan="4" class="text-center"><?php echo $instalacion->Ecc; ?></td>

            <td colspan="4" class="text-center"><?php echo $instalacion->Dimension_Largo; ?></td>

            <td colspan="4" class="text-center"><?php echo $instalacion->Dimension_Ancho; ?></td>

            <td colspan="4" class="text-center"><?php echo $instalacion->Dimension_Alto; ?></td>

            <td colspan="6" class="text-center"><?php echo $instalacion->Producto_Total; ?></td>

            <td colspan="6" class="text-center"><?php echo $Codigos_Instalaciones->Unidad; ?></td>

            <td colspan="4" class="text-center"><?php echo $instalacion->Uca; ?></td>
        </tr>
        <?php   endforeach; ?>
        <?php else: ?>
        <tr>
            <td colspan="5" class="text-center">&nbsp;</td>
            <td colspan="9" class="text-center"></td>
            <td colspan="6" class="text-center"></td>
            <td colspan="4" class="text-center"></td>
            <td colspan="4" class="text-center"></td>
            <td colspan="4" class="text-center"></td>
            <td colspan="4" class="text-center"></td>
            <td colspan="4" class="text-center"></td>
            <td colspan="4" class="text-center"></td>
            <td colspan="6" class="text-center"></td>
            <td colspan="6" class="text-center"></td>
            <td colspan="4" class="text-center"></td>
        </tr>
        <?php endif; ?>
        <!-- FINAL DE BUCLE -->
    </table>
    <br>

    <!-- 31 espacios-->
    <table id="DOCUMENTOS" width="70%">
        <caption style="text-left">DOCUMENTOS</caption>
        <tr>
            <!--<td colspan="1">97</td>-->
            <td colspan="4" class="text-center label_field"><div class='label_order'>97</div>TIPO DE DOCUMENTO</td>

            <!--<td colspan="1">98</td>-->
            <td colspan="11" class="text-center label_field"><div class='label_order'>98</div>N° DE DOCUMENTO</td>

            <!--<td colspan="1">99</td>-->
            <td colspan="7" class="text-center label_field"><div class='label_order'>99</div>FECHA</td>

            <!--<td colspan="1">100</td>-->
            <td colspan="9" class="text-center label_field"><div class='label_order'>100</div>ÁREA AUTORIZADA</td>
        </tr>

        <?php if (!empty($Documentos_Adjuntos)) { ?>
            <!-- INICIO DE BUCLE -->
            <?php foreach($Documentos_Adjuntos as $documento) : ?>
            <tr>
                <td colspan="4" class="text-center"><?php echo $documento->Tip_Doc; ?></td>

                <td colspan="11" class="text-center"><?php echo $documento->Nro_Doc; ?></td>

                <td colspan="7" class="text-center"><?php echo $documento->Fecha_Doc; ?></td>

                <td colspan="9" class="text-center"><?php echo $documento->Area_Autorizada; ?></td>
            </tr>
            <?php endforeach; ?>
            <!-- FINAL DE BUCLE -->
        <?php }else { ?>
            <tr>
                <td colspan="4" class="text-center">&nbsp;</td>

                <td colspan="11" class="text-center">&nbsp;</td>

                <td colspan="7" class="text-center">&nbsp;</td>

                <td colspan="9" class="text-center">&nbsp;</td>
            </tr>
        <?php } ?>

        <tr>
            <td rowspan="2" colspan="5" class="text-center label_field">REGISTRO NOTARIAL DE LA<br> ESCRITURA PÚBLICA</td>

            <!--<td colspan="1">101</td>-->
            <td colspan="14" class="text-center label_field"><div class='label_order'>101</div>NOMBRE DE LA NOTARÍA</td>

            <!--<td colspan="1">102</td>-->
            <td colspan="4" class="text-center label_field"><div class='label_order'>102</div>KARDEX</td>

            <!--<td colspan="1">103</td>-->
            <td colspan="8" class="text-center label_field"><div class='label_order'>103</div>FECHA DE<br> ESCRITURA PÚBLICA</td>
        </tr>
        <tr>
            <td colspan="14" class="text-center"><?php echo (!empty($Notaria)) ? ($Notaria->Nom_Notaria) : '&nbsp;'; ?></td>
            <td colspan="4" class="text-center"><?php echo (!empty($Registro_Legal)) ? ($Registro_Legal->Kardex) : '&nbsp;'; ?></td>
            <td colspan="8" class="text-center"><?php echo (!empty($Registro_Legal)) ? ($Registro_Legal->Fecha_Escritura) : '&nbsp;'; ?></td>
        </tr>
    </table>
    <br>

    <!-- 31 espacios-->
    <table id="INSCRIPCION_PREDIO" width="100%">
        <caption style="text-left">INSCRIPCIÓN DEL PREDIO CATASTRAL EN EL REGISTRO DE PREDIOS</caption>
        <tr>
            <!--<td colspan="1">104</td>-->
            <td colspan="6" class="text-center label_field"><div class='label_order'>104</div>TIPO PARTIDA<br> REGISTRAL</td>

            <!--<td colspan="1">105</td>-->
            <td colspan="11" class="text-center label_field"><div class='label_order'>105</div>NÚMERO</td>

            <!--<td colspan="1">106</td>-->
            <td colspan="7" class="text-center label_field"><div class='label_order'>106</div>FOJAS</td>

            <!--<td colspan="1">107</td>-->
            <td colspan="7" class="text-center label_field"><div class='label_order'>107</div>ASIENTO</td>

            <!--<td colspan="1">108</td>-->
            <td colspan="7" class="text-center label_field"><div class='label_order'>108</div>FECHA INSCRIPCIÓN<br> DEL PREDIO</td>

            <!--<td colspan="1">109</td>-->
            <td colspan="7" class="text-center label_field"><div class='label_order'>109</div>DECLARATORIA DE FÁBRICA</td>

            <!--<td colspan="1">110</td>-->
            <td colspan="7" class="text-center label_field"><div class='label_order'>110</div>AS. INSC.<br> DE FÁBRICA</td>

            <!--<td colspan="1">111</td>-->
            <td colspan="7" class="text-center label_field"><div class='label_order'>111</div>FECHA INSCRIPCIÓN<br> DE FÁBRICA</td>
        </tr>
        <tr>
            <td colspan="6" class="text-center"><?php echo (!empty($Sunarp)) ? ($Sunarp->Tipo_Partida) : '&nbsp;'; ?></td>

            <td colspan="11" class="text-center"><?php echo (!empty($Sunarp)) ? ($Sunarp->Nro_Partida) : '&nbsp;'; ?></td>

            <td colspan="7" class="text-center"><?php echo (!empty($Sunarp)) ? ($Sunarp->Fojas) : '&nbsp;'; ?></td>

            <td colspan="7" class="text-center"><?php echo (!empty($Sunarp)) ? ($Sunarp->Asiento) : '&nbsp;'; ?></td>

            <td colspan="7" class="text-center"><?php echo (!empty($Sunarp)) ? ($Sunarp->Fecha_Inscripcion) : '&nbsp;'; ?></td>

            <td colspan="7" class="text-center"><?php echo (!empty($Sunarp)) ? ($Sunarp->Cod_Decla_Fabrica) : '&nbsp;'; ?></td>

            <td colspan="7" class="text-center"><?php echo (!empty($Sunarp)) ? ($Sunarp->Asiento_Fabrica) : '&nbsp;'; ?></td>

            <td colspan="7" class="text-center"><?php echo (!empty($Sunarp)) ? ($Sunarp->Fecha_Fabrica) : '&nbsp;'; ?></td>
        </tr>
    </table>
    <br>

    <!-- 40 espacios-->
    <table id="EVALUACIÓN_PREDIO" width="100%">
        <caption style="text-left">EVALUACIÓN DEL PREDIO CATASTRAL</caption>
        <tr>
            <!--<td colspan="1">112</td>-->
            <td colspan="16" class="text-left label_field"><div class='label_order'>112</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;EVALUACIÓN DEL PREDIO CATASTRAL</td>

            <!--<td colspan="1">113</td>-->
            <td colspan="24" class="text-left label_field"><div class='label_order'>113</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ÁREA DE TERRENO INVADIDA (M2)</td>
        </tr>
        <tr>
            <td colspan="7" class="text-left label_field">PREDIO CATASTRAL OMISO</td>
            <td colspan="1" class="text-center"><?php echo (!empty($Ficha_Individual)) ? ((($Ficha_Individual->Evaluacion) == '01') ? 'X': '&nbsp;'):'&nbsp;'; ?></td>

            <td colspan="7" class="text-left label_field">PREDIO CATASTRAL SOBREVALUADO</td>
            <td colspan="1" class="text-center"><?php echo (!empty($Ficha_Individual)) ? ((($Ficha_Individual->Evaluacion) == '03') ? 'X': '&nbsp;'):'&nbsp;'; ?></td>

            <td colspan="8" class="text-left label_field">EN LOTE COLINDANTE</td>
            <td colspan="4" class="text-center"><?php echo (!empty($Ficha_Individual)) ? (float)($Ficha_Individual->En_Colindante):''; ?></td>

            <td colspan="8" class="text-left label_field">EN ÁREA PÚBLICA</td>
            <td colspan="4" class="text-center"><?php echo (!empty($Ficha_Individual)) ? (float)($Ficha_Individual->En_Area_Publica):''; ?></td>
        </tr>
        <tr>
            <td colspan="7" class="text-left label_field">PREDIO CATASTRAL SUBVALUADO</td>
            <td colspan="1" class="text-center"><?php echo (!empty($Ficha_Individual)) ? ((($Ficha_Individual->Evaluacion) == '02') ? 'X': '&nbsp;'):'&nbsp;'; ?></td>

            <td colspan="7" class="text-left label_field">PREDIO CATASTRAL CONFORME</td>
            <td colspan="1" class="text-center"><?php echo (!empty($Ficha_Individual)) ? ((($Ficha_Individual->Evaluacion) == '04') ? 'X': '&nbsp;'):'&nbsp;'; ?></td>

            <td colspan="8" class="text-left label_field">EN JARDÍN DE AISLAMIENTO</td>
            <td colspan="4" class="text-center"><?php echo (!empty($Ficha_Individual)) ? (float)($Ficha_Individual->En_Jardin_Aislamiento):''; ?></td>

            <td colspan="8" class="text-left label_field">EN ÁREA INTANGIBLE</td>
            <td colspan="4" class="text-center"><?php echo (!empty($Ficha_Individual)) ? (float)($Ficha_Individual->En_Area_Intangible):''; ?></td>
        </tr>
    </table>
    <br>

    <!-- 44 espacios-->
    <table id="INFORMACION_COMPLEMENTARIA" width="100%">
        <caption class="text-left">INFORMACIÓN COMPLEMENTARIA</caption>
        <tr>
            <!--<td colspan="1">114</td>-->
            <td colspan="8" class="text-left label_field"><div class='label_order'>114</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CONDICIÓN DE DECLARANTE</td>
            <td colspan="2"><?php echo (!empty($Ficha_Individual)) ? ($Ficha_Individual->Condicion_Declara):''; ?></td>
            <td colspan="34" class="text-center bloque-nulo">01 TITULAR CATASTRAL | 02 REPRESENTANTE LEGAL | 03 ARRENDATARIO | 04 FAMILIAR | 05 VECINO | 06 OTROS..................</td>
        </tr>

        <?php if (!empty($Litigantes)) :  ?>
        <tr>
            <!--<td colspan="1">115</td>-->
            <td colspan="44" class="text-left label_field"><div class='label_order'>115</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;IDENTIFICACIÓN DE LOS LITIGANTES</td>
        </tr>
        <tr>
            <td colspan="1" class="text-center label_field">TD</td>
            <td colspan="9" class="text-center label_field">N° DOCUMENTO</td>
            <td colspan="25" class="text-left label_field">APELLIDOS Y NOMBRES DE LOS LITIGANTES</td>
            <td colspan="9" class="text-center label_field">COD. CONTRIBUYENTE</td>
        </tr>
        <!-- INICIO DE BUCLE -->
        <?php   $ContadorLitigantes = 0; ?>

        <?php   foreach($Litigantes as $litigante) : ?>
        <?php       $oPersona = new Personas(); ?>
        <?php       $Persona = $oPersona->ObtenerPersona($litigante->IdPersona); ?>
        <?php       $ContadorLitigantes = $ContadorLitigantes+1; ?>
        <tr>
            <td colspan="1" class="text-center"><?php echo $ContadorLitigantes; ?></td>
            <td colspan="9" class="text-center"><?php echo (!empty($Persona)) ? ($Persona->Nro_Doc) : '&nbsp;'; ?></td>
            <td colspan="25" class="text-left"><?php echo (!empty($Persona)) ? ($Persona->Ape_Paterno.' '.$Persona->Ape_Materno.' '.$Persona->Nombres) : '&nbsp;'; ?></td>
            <td colspan="9" class="text-center"><?php echo $litigante->Cod_Contribuye; ?></td> 
        </tr>
        <?php   endforeach; ?>
        <?php endif;?>

        <tr>
            <!--<td colspan="1">116</td>-->
            <td colspan="10" class="text-left label_field"><div class='label_order'>116</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ESTADO DE LLENADO DE LA FICHA</td>
            <td colspan="1" class="text-center"><?php echo (!empty($Ficha_Individual)) ? ($Ficha_Individual->Estado_Llenado):''; ?></td>
            <!--<td colspan="1">117</td>-->
            <td colspan="10" class="text-left label_field"><div class='label_order'>117</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N° DE HABITANTES</td>
            <td colspan="1" class="text-center"><?php echo (!empty($Ficha_Individual)) ? ($Ficha_Individual->Nro_Habitantes):''; ?></td>
            <!--<td colspan="1">118</td>-->
            <td colspan="10" class="text-left label_field"><div class='label_order'>118</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N° DE FAMILIAS</td>
            <td colspan="1" class="text-center"><?php echo (!empty($Ficha_Individual)) ? ($Ficha_Individual->Nro_Familias):''; ?></td>
            <!--<td colspan="1">MANTENIMIENTO</td>-->
            <td colspan="10" class="text-left label_field">MANTENIMIENTO</td>
            <td colspan="1" class="text-center"><?php echo (!empty($Ficha_Individual)) ? ($Ficha_Individual->Mantenimiento):''; ?></td>
        </tr>
    </table>
    <br>

    <!-- 44 espacios-->
    <table id="OBSERVACIONES" width="100%">
        <caption class="text-left">OBSERVACIONES</caption>
        <tr>
            <td width="100%" style="text-justify"><?php echo (!empty($Ficha_Individual)) ? strtoupper($Ficha_Individual->Observaciones):''; ?><br></td>
        </tr>
    </table>
    <br>

    <!-- 44 espacios-->
    <table id="DECLARACION" width="100%">
        <caption class="text-left">DECLARACIONES</caption>
        <tr>
            <!--<td colspan="1">120</td>-->
            <td colspan="11" class="text-left label_field"><div class='label_order'>120</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FIRMA DEL DECLARANTE:&nbsp; 
            <span class='label_respuesta'>
                <?php echo (!empty($Ficha)) ? (($Ficha->Firma_Declarante == 1) ? 'SI':'NO'):''; ?>
            </span>
            </td>   

            <!--<td colspan="1">121</td>-->
            <td colspan="11" class="text-left label_field"><div class='label_order'>121</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DIGITADOR</td>

            <!--<td colspan="1">112</td>-->
            <td colspan="11" class="text-left label_field"><div class='label_order'>112</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FIRMA DEL TÉCNICO CATASTRAL</td>

            <!--<td colspan="1">123</td>-->
            <td colspan="11" class="text-left label_field"><div class='label_order'>123</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;V° B° VERIFICADOR CATASTRAL</td>
        </tr>

        <tr>
            <!--<td colspan="1">120</td>-->
            <td colspan="11" class="text-left label_field">DNI:&nbsp; <?php echo (!empty($Declarante)) ? ($Declarante->Nro_Doc):''; ?> </td>

            <!--<td colspan="1">121</td>-->
            <td colspan="11" class="text-left label_field">DNI:&nbsp; <?php echo (!empty($Personal)) ? ($Personal->Dni):''; ?> </td>

            <!--<td colspan="1">112</td>-->
            <td colspan="11" class="text-left label_field">DNI:&nbsp; <?php echo (!empty($TecnicoC)) ? ($TecnicoC->Dni):''; ?> </td>

            <!--<td colspan="1">123</td>-->
            <td colspan="11" class="text-left label_field">DNI:&nbsp;</td>
        </tr>

        <tr>
            <!--<td colspan="1">120</td>-->
            <td colspan="11" class="text-left label_field">NOMBRES:&nbsp; <?php echo (!empty($Declarante)) ? ($Declarante->Nombres):''; ?>  </td>

            <!--<td colspan="1">121</td>-->
            <td colspan="11" class="text-left label_field">NOMBRES:&nbsp; <?php echo (!empty($Personal)) ? ($Personal->Nombres):''; ?>  </td>

            <!--<td colspan="1">112</td>-->
            <td colspan="11" class="text-left label_field">NOMBRES:&nbsp; <?php echo (!empty($TecnicoC)) ? ($TecnicoC->Nombres):''; ?> </td>

            <!--<td colspan="1">123</td>-->
            <td colspan="11" class="text-left label_field">NOMBRES:&nbsp;</td>
        </tr>

        <tr>
            <!--<td colspan="1">120</td>-->
            <td colspan="11" class="text-left label_field">APELLIDOS:&nbsp; <?php echo (!empty($Declarante)) ? ($Declarante->Ape_Paterno.' '.$Declarante->Ape_Materno):''; ?>  </td>

            <!--<td colspan="1">121</td>-->
            <td colspan="11" class="text-left label_field">APELLIDOS:&nbsp; <?php echo (!empty($Personal)) ? ($Personal->APaterno.' '.$Personal->AMaterno):''; ?>  </td>

            <!--<td colspan="1">112</td>-->
            <td colspan="11" class="text-left label_field">APELLIDOS:&nbsp; <?php echo (!empty($TecnicoC)) ? ($TecnicoC->APaterno.' '.$TecnicoC->AMaterno):''; ?> </td>

            <!--<td colspan="1">123</td>-->
            <td colspan="11" class="text-left label_field">APELLIDOS:&nbsp;</td>
        </tr>

        <tr>
            <!--<td colspan="1">120</td>-->
            <td colspan="11" class="text-left label_field">FECHA:&nbsp; <?php echo (!empty($Ficha)) ? ($Ficha->Fecha_Levantamiento):''; ?> </td>

            <!--<td colspan="1">121</td>-->
            <td colspan="11" class="text-left label_field">FECHA:&nbsp; <?php echo (!empty($Ficha)) ? ($Ficha->FxRegistro):''; ?> </td>

            <!--<td colspan="1">112</td>-->
            <td colspan="11" class="text-left label_field">FECHA:&nbsp; <?php echo (!empty($Ficha)) ? ($Ficha->Fecha_Tecnico):''; ?> </td>

            <!--<td colspan="1">123</td>-->
            <td colspan="11" class="text-left label_field">FECHA:&nbsp;</td>
        </tr>
    </table>
</body><!--
</html> -->

<?php 
    if(isset($olote)) unset($olote);
    if(isset($lote)) unset($lote);

    if(isset($oFicha)) unset($oFicha);
    if(isset($Ficha)) unset($Ficha);

    if(isset($oUni_Cat)) unset($oUni_Cat);
    if(isset($Uni_Cat)) unset($Uni_Cat);

    if(isset($oRentas)) unset($oRentas);
    if(isset($Rentas)) unset($Rentas);

    if(isset($oEdificacion)) unset($oEdificacion);
    if(isset($Edificacion)) unset($Edificacion);

    if(isset($oFicha_Individual)) unset($oFicha_Individual);
    if(isset($Ficha_Individual)) unset($Ficha_Individual);

    if(isset($oUso)) unset($oUso);
    if(isset($Uso)) unset($Uso);

    if(isset($oHabilitacion_Urbana)) unset($oHabilitacion_Urbana);
    if(isset($Habilitacion_Urbana)) unset($Habilitacion_Urbana);
    
    if(isset($oIngresos)) unset($oIngresos);
    if(isset($Ingresos)) unset($Ingresos);

    if(isset($oPuertas)) unset($oPuertas);
    if(isset($Puertas)) unset($Puertas);
    if(isset($opuerta)) unset($opuerta);
    if(isset($puerta)) unset($puerta);

    if(isset($oVias)) unset($oVias);
    if(isset($Vias)) unset($Vias);
    if(isset($ovia)) unset($ovia);
    if(isset($via)) unset($via);

    if(isset($oTitulares)) unset($oTitulares);
    if(isset($Titulares)) unset($Titulares);
    
    if(isset($opersona)) unset($opersona);
    if(isset($persona)) unset($persona);
    if(isset($Personas)) unset($Personas);

    if(isset($oExoneraciones_Titular)) unset($oExoneraciones_Titular);
    if(isset($Exoneraciones_Titular)) unset($Exoneraciones_Titular);

    if(isset($oExoneraciones_Predio)) unset($oExoneraciones_Predio);
    if(isset($Exoneraciones_Predio)) unset($Exoneraciones_Predio);

    if(isset($oLinderos)) unset($oLinderos);
    if(isset($Linderos)) unset($Linderos);
    
    if(isset($oTramos)) unset($oTramos);
    if(isset($Tramos)) unset($Tramos);
    if(isset($TramoIzquierda)) unset($TramoIzquierda);
    if(isset($TramoFondo)) unset($TramoFondo);
    if(isset($TramoDerecha)) unset($TramoDerecha);
    if(isset($TramoFrente)) unset($TramoFrente);

    if(isset($oServicios_Basicos)) unset($oServicios_Basicos);
    if(isset($Servicios_Basicos)) unset($Servicios_Basicos);
    
    if(isset($oConstrucciones)) unset($oConstrucciones);
    if(isset($Construcciones)) unset($Construcciones);
    
    if(isset($oInstalaciones)) unset($oInstalaciones);
    if(isset($Instalaciones)) unset($Instalaciones);

    if(isset($oDocumentos_Adjuntos)) unset($oDocumentos_Adjuntos);
    if(isset($Documentos_Adjuntos)) unset($Documentos_Adjuntos);

    if(isset($oRegistro_Legal)) unset($oRegistro_Legal);
    if(isset($Registro_Legal)) unset($Registro_Legal);

    if(isset($oNotaria)) unset($oNotaria);
    if(isset($Notaria)) unset($Notaria);
    
    if(isset($oSunarp)) unset($oSunarp);
    if(isset($Sunarp)) unset($Sunarp);

    if(isset($oDomicilio_Fiscal)) unset($oDomicilio_Fiscal);
    if(isset($Domicilio_Fiscal)) unset($Domicilio_Fiscal);

    if(isset($oSys_Direccion)) unset($oSys_Direccion);
    if(isset($Sys_Direccion)) unset($Sys_Direccion);

    if(isset($oLitigantes)) unset($oLitigantes);
    if(isset($Litigantes)) unset($Litigantes);

    if(isset($oDeclarante)) unset($oDeclarante);
    if(isset($Declarante)) unset($Declarante);

    if(isset($oTecnicoC)) unset($oTecnicoC);
    if(isset($TecnicoC)) unset($TecnicoC);

    if(isset($oUsuario)) unset($oUsuario);
    if(isset($Usuario)) unset($Usuario);

    if(isset($oPersonal)) unset($oPersonal);
    if(isset($Personal)) unset($Personal);
?>