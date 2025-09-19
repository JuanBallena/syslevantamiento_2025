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

    # Obtenemos Edificacion
    if(!empty($Uni_Cat)):
        $oEdificacion = new Edificaciones();
        $Edificacion = $oEdificacion->ObtenerEdificacion($Uni_Cat->IdEdificacion);
    endif;

    # Obtenemos Ficha_Economica
    if(!empty($Ficha)):
        $oFicha_Economica = new Fichas_Economicas();
        $Ficha_Economica = $oFicha_Economica->ObtenerFichaEconomica($Id_Ficha);
    endif;

    # Obtenemos Conductor
    if(!empty($Ficha_Economica)):
        $oConductor = new Conductores();
        $Conductor = $oConductor->ObtenerConductor($Ficha_Economica->Id_Ficha);
    endif;

    # Obtenemos a las Personas
    if(!empty($Conductor)):
        $oPersona = new Personas();
        $Persona = $oPersona->ObtenerPersona($Conductor->IdPersona);
    endif;

    # Obtenemos Domicilio_Fiscal
    if(!empty($Ficha_Economica)):
        $oDomicilio_Fiscal = new Domicilio_Fiscal();
        $Domicilio_Fiscal = $oDomicilio_Fiscal->ObtenerDomicilioFiscal($Ficha_Economica->Id_Ficha);
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

    # Obtenemos Autorizacion Funcionamiento Municipal
    if(!empty($Ficha_Economica)):
        $oAutorizaciones_Funcionamiento = new Autorizaciones_Funcionamiento();
        $Autorizaciones_Funcionamiento = $oAutorizaciones_Funcionamiento->ObtenerAutorizacionesFuncionamiento($Ficha_Economica->Id_Ficha);
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
    <title>Ficha Urbana Economica</title>
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
        <caption><h2 class="text-center">FICHA CATASTRAL URBANA ACTIVIDAD ECONOMICA</h2></caption>
        <tr>
            <td colspan="6" class="text-center label_field"><div class='label_order'>01</div>CODIGO UNICO CATASTRAL - CUC</td>
            <td colspan="6" class="text-center label_field"><div class='label_order'>02</div>CODIGO HOJA CATASTRAL</td>
        </tr> 
        <tr>
            <td colspan="4" class="text-center" ID="txtECodCata">&nbsp;<?php echo (!empty($Uni_Cat))? $Uni_Cat->Cuc_Antecedente:'&nbsp;'; ?></td>
            <td colspan="2" class="text-center" ID="txtECUC">&nbsp;<?php echo (!empty($Uni_Cat))? $Uni_Cat->Cuc:'&nbsp;'; ?></td>
            <td colspan="6" class="text-center" ID="txtECodHoja">&nbsp;<?php echo (!empty($Uni_Cat))? $Uni_Cat->Codigo_Hoja_Cat:'&nbsp;'; ?></td>
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
            <td colspan="1" class="text-center" id="txtentrada"><?php echo (!empty($Uni_Cat))? $Uni_Cat->Cod_Entrada:'&nbsp;'; ?></td>
            <td colspan="1" class="text-center" id="txtpiso"><?php echo (!empty($Uni_Cat))? $Uni_Cat->Cod_Piso:'&nbsp;'; ?></td>
            <td colspan="1" class="text-center" id="txtcodunidad"><?php echo (!empty($Uni_Cat))? $Uni_Cat->Cod_Unidad:'&nbsp;'; ?></td>
            <td colspan="1" class="text-center" id="txtdc"><?php echo (!empty($Ficha))? $Ficha->DC:'&nbsp;'; ?></td>
        </tr>
    </table>
    <br>

    <!-- 15 espacios-->
    <table id="IDENTIFICACION_CONDUCTOR" width="100%">
        <caption style="text-left">IDENTIFICACIÓN DEL CONDUCTOR</caption>
        <tr>
            <!--<td colspan="1">4</td>-->
            <td colspan="3" class="text-center label_field"><div class='label_order'>140</div>TIPO DE CONDUCTOR</td>
            <td colspan="1" class="text-center"><?php echo (!empty($Persona)) ? ($Persona->Tip_Persona):''; ?></td>
            
            <!--<td colspan="1">11</td>-->
            <td colspan="3" class="text-center label_field"><div class='label_order'>141</div>NOMBRE COMERCIAL</td>
            <td colspan="8" class="text-center"><?php echo (!empty($Ficha_Economica)) ? ($Ficha_Economica->Nom_Comercial):''; ?></td>
        </tr>

        <tr>
            <!--<td colspan="1">4</td>-->
            <td colspan="3" class="text-center label_field"><div class='label_order'>26</div>TIPO DOC. DE IDENTIDAD</td>
            <td colspan="1" class="text-center"><?php echo (!empty($Persona)) ? ($Persona->Tip_Doc):''; ?></td>
            
            <!--<td colspan="1">6</td>-->
            <td colspan="3" class="text-center label_field"><div class='label_order'>27</div>N° DOCUMENTO</td>
            <td colspan="3" class="text-center"><?php echo (!empty($Persona)) ? ((($Persona->Tip_Persona)==1) ? ($Persona->Nro_Doc):''):''; ?></td>
            
            <!--<td colspan="1">5</td>-->
            <td colspan="5" class="text-center bloque-nulo"></td> 
        </tr>

        <tr>
            <!--<td colspan="1">5</td>-->
            <td colspan="2" class="text-center label_field"><div class='label_order'>31</div>N° DE R.U.C.</td>
            <td colspan="3" style="text-align: center"><?php echo (!empty($Persona)) ? ((($Persona->Tip_Persona)==2) ? ($Persona->Nro_Doc):''):''; ?></td>
            
            <!--<td colspan="1">10</td>-->
            <td colspan="4" class="text-center label_field"><div class='label_order'>32</div>APEL. Y NOMBRES / RAZÓN SOCIAL</td> 
            <td colspan="6" style="text-align: center"><?php echo (!empty($Persona)) ? ((($Persona->Tip_Persona)==2) ? ($Persona->Nombres):( trim($Persona->Ape_Paterno).' '.trim($Persona->Ape_Materno).' '.trim($Persona->Nombres))):''; ?></td>
        </tr>

        <tr>
            <!--<td colspan="1">142</td>-->
            <td colspan="3" class="text-center label_field"><div class='label_order'>142</div>CONDICION DEL CONDUCTOR</td>
            <td colspan="1" class="text-center"><?php echo (!empty($Conductor)) ? trim($Conductor->Condicion_Conductor):''; ?></td>

            <td colspan="11" class="text-center bloque-nulo"></td> 
        </tr>
    </table>
    <br>
    
    <!-- 21 espacios-->
    <table id="DOMICILIO_FISCAL_CONDUCTOR" width="100%">
        <caption style="text-left">DOMICILIO FISCAL DEL CONDUCTOR DE LA ACTIVIDAD</caption>
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
            <td colspan="3" style="text-align: center"><?php echo (!empty($Domicilio_Fiscal)) ? trim($Domicilio_Fiscal->Departamento):'&nbsp;'; ?></td>
            <td colspan="3" style="text-align: center"><?php echo (!empty($Domicilio_Fiscal)) ? trim($Domicilio_Fiscal->Provincia):'&nbsp;'; ?></td>
            <td colspan="3" style="text-align: center"><?php echo (!empty($Domicilio_Fiscal)) ? trim($Domicilio_Fiscal->Nombre_Distrito):'&nbsp;'; ?></td>
            <td colspan="3" style="text-align: center"><?php echo (!empty($Conductor)) ? trim($Conductor->Telefono):'&nbsp;'; ?></td> 
            <td colspan="3" style="text-align: center"><?php echo (!empty($Conductor)) ? trim($Conductor->Anexo):'&nbsp;'; ?></td>
            <td colspan="3" style="text-align: center"><?php echo (!empty($Conductor)) ? trim($Conductor->Fax):'&nbsp;'; ?></td> 
            <td colspan="3" style="text-align: center"><?php echo (!empty($Conductor)) ? trim($Conductor->Correo_Elect):'&nbsp;'; ?></td>
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
            <td colspan="5" style="text-align: center"><?php echo (!empty($Habilitacion_Urbana)) ? trim($Habilitacion_Urbana->Grupo_Urba):'&nbsp;'; ?></td>
            <td colspan="3" style="text-align: center"><?php echo (!empty($Sys_Direccion)) ? trim($Sys_Direccion->Mzna_Muni):'&nbsp;'; ?></td> 
            <td colspan="4" style="text-align: center"><?php echo (!empty($Sys_Direccion)) ? trim($Sys_Direccion->Lote_Muni):'&nbsp;'; ?></td>
            <td colspan="3" style="text-align: center"><?php echo (!empty($Sys_Direccion)) ? trim($Sys_Direccion->Sub_Lote_Muni):'&nbsp;'; ?></td>
        </tr>
    </table>
    <br>
    
    <!-- 16 espacios-->
    <table id="AUTORIZACION_ACTIVIDAD" width="50%">
        <caption style="text-left">AUTORIZACION MUNICIPAL DE FUNCIONAMIENTO</caption>
        <tr>
            <!--<td colspan="1">140</td>-->
            <td colspan="3" class="text-center label_field"><div class='label_order'>140</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;COD. ACTIVIDAD</td>
            <!--<td colspan="1">141</td>-->
            <td colspan="17" class="text-center label_field"><div class='label_order'>141</div>DESCRIPCIÓN DE LA ACTIVIDAD</td>
        </tr>

        <!-- # Obtenemos Actividad -->
        <?php if (!empty($Autorizaciones_Funcionamiento)): ?>
            <!-- INICIO DE BUCLE -->
            <?php foreach($Autorizaciones_Funcionamiento as $autorizaciones) : ?>
            <?php   $oActividad = new Actividades(); ?>
            <?php   $Actividad = $oActividad->ObtenerActividad($autorizaciones->IdActividad); ?>
            <tr>
                <!--<td colspan="1">140</td>-->
                <td colspan="3" class="text-center"><?php echo (!empty($Actividad)) ? trim($Actividad->Id_Actividad):'&nbsp;'; ?></td>
                <!--<td colspan="1">141</td>-->
                <td colspan="17" class="text-center"><?php echo (!empty($Actividad)) ? trim($Actividad->Desc_Actividad):'&nbsp;'; ?></td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <!--<td colspan="1">140</td>-->
                <td colspan="3" class="text-center">&nbsp;</td>
                <!--<td colspan="1">141</td>-->
                <td colspan="17" class="text-center"></td>
            </tr>
        <?php endif; ?>
    </table>
    <br>
    <table id="AUTORIZACION_FUNCIONAMIENTO" width="100%">
        <tr>            
            <td colspan="10" class="text-center label_field">ÁREA DE LA ACTIVIDAD ECONÓMICA</td>
            <td colspan="5" class="text-center label_field"><div class='label_order'>147</div>NRO DE EXP.</td>
            <td colspan="5" class="text-center label_field"><div class='label_order'>147</div>NRO DE LIC.</td>
        </tr>

        <tr>
            <td colspan="4" class="text-center label_field">UBICACIÓN</td>
            <td colspan="3" class="text-center label_field"><div class='label_order'>145</div>ÁREA AUTORIZADA</td>
            <td colspan="3" class="text-center label_field"><div class='label_order'>146</div>ÁREA VERIFICADA</td>

            <td colspan="5" class="text-center"><?php echo (!empty($Ficha_Economica)) ? trim($Ficha_Economica->Nro_Expediente):'&nbsp;'; ?></td>
            <td colspan="5" class="text-center"><?php echo (!empty($Ficha_Economica)) ? trim($Ficha_Economica->Nro_Licencia):'&nbsp;'; ?></td>
        </tr>

        <tr>            
            <td colspan="4" class="text-center label_field">PREDIO CATASTRAL</td>
            <td colspan="3" class="text-center"><?php echo (!empty($Ficha_Economica)) ? (float)($Ficha_Economica->Predio_Area_Autor):'&nbsp;'; ?></td>
            <td colspan="3" class="text-center"><?php echo (!empty($Ficha_Economica)) ? (float)($Ficha_Economica->Predio_Area_Verif):'&nbsp;'; ?></td>

            <td colspan="10" class="text-center label_field">VIGENCIA DE AUTORIZACIÓN</td>
        </tr>

        <tr>            
            <td colspan="4" class="text-center label_field">VÍA PUBLICA</td>
            <td colspan="3" class="text-center"><?php echo (!empty($Ficha_Economica)) ? (float)($Ficha_Economica->Viap_Area_Autor):'&nbsp;'; ?></td>
            <td colspan="3" class="text-center"><?php echo (!empty($Ficha_Economica)) ? (float)($Ficha_Economica->Viap_Area_Verif):'&nbsp;'; ?></td>

            <td colspan="5" class="text-center label_field"><div class='label_order'>149</div>FECHA DE EXPEDICIÓN</td>
            <td colspan="5" class="text-center label_field"><div class='label_order'>150</div>FECHA DE VENCIMIENTO</td>
        </tr>             

        <tr>
            <td colspan="4" class="text-center label_field">BIEN COMÚN</td>
            <td colspan="3" class="text-center"><?php echo (!empty($Ficha_Economica)) ? (float)($Ficha_Economica->BC_Area_Autor):'&nbsp;'; ?></td>
            <td colspan="3" class="text-center"><?php echo (!empty($Ficha_Economica)) ? (float)($Ficha_Economica->BC_Area_Verif):'&nbsp;'; ?></td>

            <td colspan="5" class="text-center"><?php echo (!empty($Ficha_Economica)) ? trim($Ficha_Economica->Fecha_Expedicion):'&nbsp;'; ?></td>
            <td colspan="5" class="text-center"><?php echo (!empty($Ficha_Economica)) ? trim($Ficha_Economica->Fecha_Vencimiento):'&nbsp;'; ?></td>
        </tr>

        <tr>            
            <td colspan="4" class="text-center label_field">TOTAL</td>
            <td colspan="3" class="text-center"><?php echo (!empty($Ficha_Economica)) ? (float)($Ficha_Economica->Total_Area_Autor):'&nbsp;'; ?></td>
            <td colspan="3" class="text-center"><?php echo (!empty($Ficha_Economica)) ? (float)($Ficha_Economica->Total_Area_Verif):'&nbsp;'; ?></td>

            <td colspan="5" class="text-center label_field"><div class='label_order'>151</div>INICIO DE ACTIVIDAD</td>
            <td colspan="5" class="text-center"><?php echo (!empty($Ficha_Economica)) ? trim($Ficha_Economica->Inicio_Actividad):'&nbsp;'; ?></td>
        </tr>
    </table>
    <br>

    <!-- 60 espacios-->
    <table id="AUTORIZACION_ANUNCIO" width="100%">
        <caption class="text-left">AUTORIZACIÓN DE ANUNCIO</caption>
        <tr>
            <!--<td colspan="1">152</td>-->
            <td rowspan="2" colspan="4" class="text-center label_field" width="10%"><div class='label_order'>152</div>CÓD. TIPO DE ANUNCIO</td>

            <!--<td colspan="1">153</td>-->
            <td rowspan="2" colspan="10" class="text-center label_field"><div class='label_order'>153</div>DESCRIPCIÓN DEL TIPO DE ANUNCIO</td>

            <!--<td colspan="1">154</td>-->
            <td rowspan="2" colspan="4" class="text-center label_field"><div class='label_order'>154</div>N° DE LADOS</td>

            <!--<td colspan="1">155</td>-->
            <td rowspan="2" colspan="4" class="text-center label_field"><div class='label_order'>155</div>ÁREA AUTORIZADA DEL ANUNCIO (m2)</td>

            <!--<td colspan="1">156</td>-->
            <td rowspan="2" colspan="4" class="text-center label_field"><div class='label_order'>156</div>ÁREA VERIFICADA DEL ANUNCIO (m2)</td>

            <!--<td colspan="1">157</td>-->
            <td rowspan="2" colspan="4" class="text-center label_field"><div class='label_order'>157</div>N° EXPEDIENTE</td>

            <!--<td colspan="1">158</td>-->
            <td rowspan="2" colspan="4" class="text-center label_field"><div class='label_order'>158</div>N° LICENCIA</td>

            <td colspan="6" class="text-center label_field">VIGENCIA DE AUTORIZACIÓN</td>
        </tr>

        <tr>
            <!--<td colspan="1">158</td>-->
            <td colspan="3" class="text-center label_field"><div class='label_order'>159</div>FECHA EXPEDICIÓN</td>

            <!--<td colspan="1">93</td>-->
            <td colspan="3" class="text-center label_field"><div class='label_order'>160</div>FECHA VENCIMIENTO</td>
        </tr>

        <?php if (!empty($Autorizaciones_Anuncios)): ?>
            <!-- INICIO DE BUCLE -->
            <?php foreach($Autorizaciones_Anuncios as $anuncio) : ?>
            <?php   $oMultitabla = new Multitabla(); ?>
            <?php   $Multitabla = $oMultitabla->ObtenerMultitabla($anuncio->Cod_Anuncio); ?>
            <tr>
                <td colspan="4" class="text-center"><?php echo (!empty($Autorizaciones_Anuncios)) ? trim($anuncio->Cod_Anuncio):'&nbsp;'; ?></td>
                <td colspan="10" class="text-center"><?php echo (!empty($Multitabla)) ? trim($Multitabla->DescCodigo):'&nbsp;'; ?></td>
                <td colspan="4" class="text-center"><?php echo (!empty($Autorizaciones_Anuncios)) ? trim($anuncio->Nro_Lados):'&nbsp;'; ?></td>
                <td colspan="4" class="text-center"><?php echo (!empty($Autorizaciones_Anuncios)) ? (float)($anuncio->Area_Autorizada):'&nbsp;'; ?></td>
                <td colspan="4" class="text-center"><?php echo (!empty($Autorizaciones_Anuncios)) ? (float)($anuncio->Area_Verificada):'&nbsp;'; ?></td>
                <td colspan="4" class="text-center"><?php echo (!empty($Autorizaciones_Anuncios)) ? trim($anuncio->Nro_Expediente):'&nbsp;'; ?></td>
                <td colspan="4" class="text-center"><?php echo (!empty($Autorizaciones_Anuncios)) ? trim($anuncio->Nro_Licencia):'&nbsp;'; ?></td>
                <td colspan="3" class="text-center"><?php echo (!empty($Autorizaciones_Anuncios)) ? trim($anuncio->Fecha_Expedicion):'&nbsp;'; ?></td>
                <td colspan="3" class="text-center"><?php echo (!empty($Autorizaciones_Anuncios)) ? trim($anuncio->Fecha_Vencimiento):'&nbsp;'; ?></td>
            </tr>
            <?php endforeach; ?>
            <!-- FINAL DE BUCLE -->
        <?php else: ?>
            <tr>
                <td colspan="4">&nbsp;</td>
                <td colspan="10"></td>
                <td colspan="4"></td>
                <td colspan="4"></td>
                <td colspan="4"></td>
                <td colspan="4"></td>
                <td colspan="4"></td>
                <td colspan="3"></td>
                <td colspan="3"></td>
            </tr>
        <?php endif; ?>
    </table>
    <br>

    <!-- 30 espacios-->
    <table id="INFORMACION_COMPLEMENTARIA" width="100%">
        <caption class="text-left">INFORMACIÓN COMPLEMENTARIA</caption>
        <tr>
            <!--<td colspan="1">114</td>-->
            <td colspan="9" class="text-left label_field"><div class='label_order'>114</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CONDICIÓN DE DECLARANTE</td>
            <td colspan="1" class="text-center"><?php echo (!empty($Ficha_Economica)) ? ($Ficha_Economica->Condicion_Declarante):''; ?></td>
            <td colspan="20" class="text-center bloque-nulo">01 TITULAR CATASTRAL | 02 REPRESENTANTE LEGAL | 03 ARRENDATARIO | 04 FAMILIAR | 05 VECINO | 06 OTROS.............</td>
        </tr>
        <tr>
            <!--<td colspan="1">161</td>-->
            <td colspan="9" class="text-left label_field"><div class='label_order'>161</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DOCUMENTOS PRESENTADOS</td>
            <td colspan="1" class="text-center"><?php echo (!empty($Ficha_Economica)) ? ($Ficha_Economica->Documen_Presentado):''; ?></td>
            
            <!--<td colspan="1">116</td>-->
            <td colspan="9" class="text-left label_field"><div class='label_order'>116</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ESTADO DE LLENADO DE LA FICHA</td>
            <td colspan="1" class="text-center"><?php echo (!empty($Ficha_Economica)) ? ($Ficha_Economica->Estado_Llenado):''; ?></td>

            <!--<td colspan="1">119</td>-->
            <td colspan="9" class="text-left label_field"><div class='label_order'>119</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MANTENIMIENTO</td>
            <td colspan="1" class="text-center"><?php echo (!empty($Ficha_Economica)) ? ($Ficha_Economica->Mantenimiento):''; ?></td>
        </tr>
    </table>
    <br>

    <!-- 44 espacios-->
    <table id="OBSERVACIONES" width="100%">
        <caption class="text-left">OBSERVACIONES</caption>
        <tr>
            <td class="text-justify">
                <?php echo (!empty($Ficha_Economica)) ? ( (($Ficha_Economica->Observaciones)!='')? strtoupper($Ficha_Economica->Observaciones):'&nbsp;'):'&nbsp;'; ?>
            </td>
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
    if(isset($oFicha)) unset($oFicha);
    if(isset($Ficha)) unset($Ficha);

    if(isset($olote)) unset($olote);
    if(isset($lote)) unset($lote);
    
    if(isset($oUni_Cat)) unset($oUni_Cat);
    if(isset($Uni_Cat)) unset($Uni_Cat);

    if(isset($oEdificacion)) unset($oEdificacion);
    if(isset($Edificacion)) unset($Edificacion);

    if(isset($oFicha_Economica)) unset($oFicha_Economica);
    if(isset($Ficha_Economica)) unset($Ficha_Economica); 
    
    if(isset($oConductor)) unset($oConductor);
    if(isset($Conductor)) unset($Conductor);

    if(isset($oPersona)) unset($oPersona);
    if(isset($Persona)) unset($Persona);

    if(isset($oDomicilio_Fiscal)) unset($oDomicilio_Fiscal);
    if(isset($Domicilio_Fiscal)) unset($Domicilio_Fiscal);

    if(isset($oSys_Direccion)) unset($oSys_Direccion);
    if(isset($Sys_Direccion)) unset($Sys_Direccion);

    if(isset($oHabilitacion_Urbana)) unset($oHabilitacion_Urbana);
    if(isset($Habilitacion_Urbana)) unset($Habilitacion_Urbana);

    if(isset($oAutorizaciones_Funcionamiento)) unset($oAutorizaciones_Funcionamiento);
    if(isset($Autorizaciones_Funcionamiento)) unset($Autorizaciones_Funcionamiento);

    if(isset($oActividad)) unset($oActividad);
    if(isset($Actividad)) unset($Actividad);

    if(isset($Autorizaciones_Anuncios)) unset($Autorizaciones_Anuncios);
    if(isset($anuncio)) unset($anuncio);

    if(isset($oMultitabla)) unset($oMultitabla);
    if(isset($Multitabla)) unset($Multitabla);

    if(isset($oDeclarante)) unset($oDeclarante);
    if(isset($Declarante)) unset($Declarante);

    if(isset($oTecnicoC)) unset($oTecnicoC);
    if(isset($TecnicoC)) unset($TecnicoC);

    if(isset($oUsuario)) unset($oUsuario);
    if(isset($Usuario)) unset($Usuario);

    if(isset($oPersonal)) unset($oPersonal);
    if(isset($Personal)) unset($Personal);
?>