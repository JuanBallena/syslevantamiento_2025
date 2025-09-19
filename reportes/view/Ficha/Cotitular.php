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

    # Obtenemos Ficha_Cotitularidad
    if(!empty($Ficha)):
        $oFicha_Cotitularidad = new Fichas_Cotitularidades();
        $Ficha_Cotitularidad = $oFicha_Cotitularidad->ObtenerFichaCotitular($Id_Ficha);
    endif;
    
    # Obtenemos los Titulares
    if(!empty($Ficha_Cotitularidad)):
        $oTitulares = new Titulares();
        $Titulares = $oTitulares->ObtenerTitulares($Ficha_Cotitularidad->Id_Ficha);
    endif;

    # Obtenemos Domicilio_Fiscal
    if(!empty($Ficha_Cotitularidad)):
        $oDomicilio_Fiscal = new Domicilio_Fiscal();
        $Domicilio_Fiscal = $oDomicilio_Fiscal->ObtenerDomicilioFiscal($Ficha_Cotitularidad->Id_Ficha);
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
    <title>Ficha Urbana de Cotitularidad</title>
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
        <caption><h2 class="text-center">FICHA CATASTRAL URBANA COTITULARIDAD</h2></caption>
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
            <td colspan="1" class="text-center" id="txtentrada"><?php echo (!empty($Uni_Cat))? $Uni_Cat->Cod_Entrada:'&nbsp;'; ?></td>
            <td colspan="1" class="text-center" id="txtpiso"><?php echo (!empty($Uni_Cat))? $Uni_Cat->Cod_Piso:'&nbsp;'; ?></td>
            <td colspan="1" class="text-center" id="txtcodunidad"><?php echo (!empty($Uni_Cat))? $Uni_Cat->Cod_Unidad:'&nbsp;'; ?></td>
            <td colspan="1" class="text-center" id="txtdc"><?php echo (isset($Ficha))? $Ficha->DC:'&nbsp;'; ?></td>
        </tr>
    </table>
    <br>
    
    <?php if(!empty($Titulares)): ?>
    <?php   foreach($Titulares as $titular): ?>
    <?php       $oPersona = new Personas(); ?>
    <?php       $Persona = $oPersona->ObtenerPersona($titular->IdPersona); ?>
    <?php       $oExoneracion_Titular = new Exoneraciones_Titular(); ?>
    <?php       $Exoneracion_Titular = $oExoneracion_Titular->ObtenerExoneracionTitular($Id_Ficha,$titular->IdPersona); ?>
        <!-- 15 espacios-->
        <table id="DATOS_COTITULAR" width="100%">
            <caption style="text-left">DATOS DEL COTITULAR CATASTRAL</caption>
            <!--<td colspan="1">21</td>-->
            <tr>
                <!--<td colspan="1">4</td>-->
                <td colspan="3" class="text-center label_field"><div class='label_order'>124</div>NUMERO DE<br> COTITULAR</td>
                <td colspan="1" class="text-center"><?php echo (isset($Titulares)) ? ($titular->Nro_Titular):''; ?></td>
                <!--<td colspan="1">4</td>-->
                <td colspan="3" class="text-center label_field"><div class='label_order'>125</div>TOTAL DE<br> COTITULARES</td>
                <td colspan="1" class="text-center"><?php echo (isset($Ficha_Cotitularidad)) ? ($Ficha_Cotitularidad->Total_Cotitulares):''; ?></td>
                <!--<td colspan="1">4</td>-->
                <td colspan="3" class="text-center label_field"><div class='label_order'>126</div>TIPO DE TITULAR</td>
                <td colspan="1" class="text-center"><?php echo (isset($Persona)) ? ($Persona->Tip_Persona):''; ?></td>
                <!--<td colspan="1">4</td>-->
                <td colspan="3" class="text-center label_field"><div class='label_order'>127</div>% DE COTITULAR</td>
                <td colspan="1" class="text-center"><?php echo (isset($Titulares)) ? ($titular->Porcentaje_Cotitular):'&nbsp;'; ?></td>
                <!--<td colspan="1">5</td>-->
                <td colspan="3" class="text-center label_field"><div class='label_order'>04</div>COD. DEL CONTRIBUYENTE</td>
                <td colspan="2" class="text-center"><?php echo (!empty($Titulares)) ? ($titular->Cod_Contribuyente):'&nbsp;&nbsp;&nbsp;&nbsp;'; ?></td>
            </tr>

            <tr>
                <!--<td colspan="1">26</td>-->
                <td colspan="3" class="text-center label_field"><div class='label_order'>26</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TIPO DOC. IDENTIDAD</td>
                <td colspan="1" class="text-center"><?php echo (($Persona->Tip_Persona)==1) ? ($Persona->Tip_Doc):''; ?></td>
                <!--<td colspan="1">27</td>-->
                <td colspan="3" class="text-center label_field"><div class='label_order'>27</div>N° DOC.</td> 
                <td colspan="3" class="text-center"><?php echo (($Persona->Tip_Persona)==1) ? ($Persona->Nro_Doc):''; ?></td>
                <!--<td colspan="1">28</td>-->
                <td colspan="3" class="text-center label_field"><div class='label_order'>28</div>NOMBRES</td>
                <td colspan="8" class="text-center"><?php echo (($Persona->Tip_Persona)==1) ? ($Persona->Nombres):''; ?></td>
            </tr>

            <tr>
                <!--<td colspan="1">29</td>-->
                <td colspan="11" class="text-center label_field"><div class='label_order'>29</div>APELLIDO PATERNO</td>
                <!--<td colspan="1">30</td>-->
                <td colspan="10" class="text-center label_field"><div class='label_order'>30</div>APELLIDO MATERNO</td> 
            </tr>
            <tr>
                <td colspan="11" style="text-align: center"><?php echo (($Persona->Tip_Persona)==1) ? (($Persona->Ape_Paterno!='')? ($Persona->Ape_Paterno):'&nbsp;'):'&nbsp;'; ?></td>
                <td colspan="10" style="text-align: center"><?php echo (($Persona->Tip_Persona)==1) ? ($Persona->Ape_Materno):'&nbsp;'; ?></td> 
            </tr>

            <tr>
                <!--<td colspan="1">31</td>-->
                <td colspan="3" class="text-center label_field"><div class='label_order'>31</div>N° DE R.U.C.</td>
                <td colspan="4" style="text-align: center"><?php echo (($Persona->Tip_Persona)==2) ? ($Persona->Nro_Doc):''; ?></td>
                <!--<td colspan="1">32</td>-->
                <td colspan="4" class="text-center label_field"><div class='label_order'>32</div>RAZÓN SOCIAL</td> 
                <td colspan="10" style="text-align: center"><?php echo (($Persona->Tip_Persona)==2) ? ($Persona->Nombres):''; ?></td>
            </tr>

            <tr>
                <!--<td colspan="1">47</td>-->
                <td colspan="2" class="text-center label_field"><div class='label_order'>47</div>FORMA DE ADQUISIÓN</td>
                <td colspan="1"><?php echo (!empty($Titulares)) ? trim($titular->Forma_Adquisicion):''; ?></td>
                <!--<td colspan="1">48</td>-->
                <td colspan="2" class="text-center label_field"><div class='label_order'>48</div>FECHA DE ADQUISIÓN</td> 
                <td colspan="1"><?php echo (!empty($Titulares)) ? ($titular->Fecha_Adquisicion):'&nbsp;'; ?></td>

                <!--<td colspan="1">34</td>-->   
                <td colspan="2" class="text-center label_field"><div class='label_order'>34</div>&nbsp;&nbsp;&nbsp;&nbsp;COND. ESP. DEL TITULAR</td> 
                <td colspan="1" style="text-align: center"><?php echo (!empty($Exoneracion_Titular)) ? $Exoneracion_Titular->Condicion:''; ?></td>
                <!--<td colspan="1">35</td>-->
                <td colspan="2" class="text-center label_field"><div class='label_order'>35</div>&nbsp;&nbsp;&nbsp;N° RESOLUCIÓN DE EXONERACIÓN</td>
                <td colspan="2" style="text-align: center"><?php echo (!empty($Exoneracion_Titular)) ? $Exoneracion_Titular->Nro_Resolucion:''; ?></td>
                <!--<td colspan="1">37</td>-->
                <td colspan="2" class="text-center label_field"><div class='label_order'>37</div>&nbsp;&nbsp;&nbsp;&nbsp;FECHA INICIO DE LA EXONERACIÓN</td>
                <td colspan="2" style="text-align: center"><?php echo (!empty($Exoneracion_Titular)) ? $Exoneracion_Titular->Fecha_Inicio:'&nbsp;'; ?></td>
                <!--<td colspan="1">38</td>-->
                <td colspan="2" class="text-center label_field"><div class='label_order'>38</div>&nbsp;&nbsp;&nbsp;FECHA VENCIMIENTO DE LA EXONERACIÓN</td>
                <td colspan="2" style="text-align: center"><?php echo (!empty($Exoneracion_Titular)) ? $Exoneracion_Titular->Fecha_Vencimiento:'&nbsp;'; ?></td>
            </tr>
        </table>
        <br>

        <!-- 21 espacios-->
        <table id="DOMICILIO_FISCAL_TITULAR" width="100%">
            <caption style="text-left">DOMICILIO FISCAL DEL TITULAR CATASTRAL</caption>
            <tr>
                <!--<td colspan="1">39</td>-->
                <td colspan="3" class="text-center label_field"><div class='label_order'>39</div>DEPARTAMENTO</td>
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
                <td colspan="3" style="text-align: center"><?php echo (isset($Domicilio_Fiscal)) ? trim($Domicilio_Fiscal->Departamento):'&nbsp;'; ?></td>
                <td colspan="3" style="text-align: center"><?php echo (isset($Domicilio_Fiscal)) ? trim($Domicilio_Fiscal->Provincia):'&nbsp;'; ?></td>
                <td colspan="3" style="text-align: center"><?php echo (isset($Domicilio_Fiscal)) ? trim($Domicilio_Fiscal->Nombre_Distrito):'&nbsp;'; ?></td>

                <td colspan="3" style="text-align: center"><?php echo (!empty($Titulares)) ? trim($titular->Telefono):'&nbsp;'; ?></td> 
                <td colspan="3" style="text-align: center"><?php echo (!empty($Titulares)) ? trim($titular->Anexo):'&nbsp;'; ?></td>
                <td colspan="3" style="text-align: center"><?php echo (!empty($Titulares)) ? trim($titular->Fax):'&nbsp;'; ?></td> 
                <td colspan="3" style="text-align: center"><?php echo (!empty($Titulares)) ? trim($titular->Correo_Elect):'&nbsp;'; ?></td>
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
                <td colspan="3" style="text-align: center"><?php echo (isset($Domicilio_Fiscal)) ? trim($Domicilio_Fiscal->Cod_Via):'&nbsp;'; ?></td>
                <td colspan="3" style="text-align: center"><?php echo (isset($Domicilio_Fiscal)) ? SelectorTipoVia($Domicilio_Fiscal->Tip_Via):'&nbsp;'; ?></td>
                <td colspan="5" style="text-align: center"><?php echo (isset($Domicilio_Fiscal)) ? trim($Domicilio_Fiscal->Nombre_Via):'&nbsp;'; ?></td>
                <td colspan="3" style="text-align: center"><?php echo (isset($Sys_Direccion)) ? trim($Sys_Direccion->Nro_Muni):'&nbsp;'; ?></td> 
                <td colspan="4" style="text-align: center"><?php echo (!empty($Edificacion))? trim($Edificacion->Nom_Edificacion):'&nbsp;'; ?></td>
                <td colspan="3" style="text-align: center"><?php echo (isset($Sys_Direccion)) ? trim($Sys_Direccion->Nro_Interior):'&nbsp;'; ?></td>
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
                <td colspan="3" style="text-align: center"><?php echo (isset($Habilitacion_Urbana)) ? trim($Habilitacion_Urbana->Id_Hab_Urba):'&nbsp;'; ?></td>
                <td colspan="3" style="text-align: center"><?php echo (isset($Habilitacion_Urbana)) ? trim($Habilitacion_Urbana->Nom_Hab_Urba):'&nbsp;'; ?></td>
                <td colspan="5" style="text-align: center"><?php echo (isset($Habilitacion_Urbana)) ? trim($Habilitacion_Urbana->Grupo_Urba):'&nbsp;'; ?></td>
                <td colspan="3" style="text-align: center"><?php echo (isset($Sys_Direccion)) ? trim($Sys_Direccion->Mzna_Muni):'&nbsp;'; ?></td> 
                <td colspan="4" style="text-align: center"><?php echo (isset($Sys_Direccion)) ? trim($Sys_Direccion->Lote_Muni):'&nbsp;'; ?></td>
                <td colspan="3" style="text-align: center"><?php echo (isset($Sys_Direccion)) ? trim($Sys_Direccion->Sub_Lote_Muni):'&nbsp;'; ?></td>
            </tr>
        </table>
        <br>
    <?php   endforeach; ?>
    <?php else: ?>
        <!-- 15 espacios-->
        <table id="DATOS_COTITULAR" width="100%">
            <caption style="text-left">DATOS DEL COTITULAR CATASTRAL</caption>
            <!--<td colspan="1">21</td>-->
            <tr>
                <!--<td colspan="1">4</td>-->
                <td colspan="3" class="text-center label_field"><div class='label_order'>124</div>NUMERO DE<br> COTITULAR</td>
                <td colspan="1" class="text-center"><?php echo '&nbsp;' ?></td>
                <!--<td colspan="1">4</td>-->
                <td colspan="3" class="text-center label_field"><div class='label_order'>125</div>TOTAL DE<br> COTITULARES</td>
                <td colspan="1" class="text-center"><?php echo '&nbsp;' ?></td>
                <!--<td colspan="1">4</td>-->
                <td colspan="3" class="text-center label_field"><div class='label_order'>126</div>TIPO DE TITULAR</td>
                <td colspan="1" class="text-center"><?php echo '&nbsp;' ?></td>
                <!--<td colspan="1">4</td>-->
                <td colspan="3" class="text-center label_field"><div class='label_order'>127</div>% DE COTITULAR</td>
                <td colspan="1" class="text-center"></td>
                <!--<td colspan="1">5</td>-->
                <td colspan="3" class="text-center label_field"><div class='label_order'>04</div>COD. DEL CONTRIBUYENTE</td>
                <td colspan="2" class="text-center"></td>
            </tr>

            <tr>
                <!--<td colspan="1">26</td>-->
                <td colspan="3" class="text-center label_field"><div class='label_order'>26</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TIPO DOC. IDENTIDAD</td>
                <td colspan="1" class="text-center"><?php echo '&nbsp;' ?></td>
                <!--<td colspan="1">27</td>-->
                <td colspan="3" class="text-center label_field"><div class='label_order'>27</div>N° DOC.</td> 
                <td colspan="3" class="text-center"><?php echo '&nbsp;' ?></td>
                <!--<td colspan="1">28</td>-->
                <td colspan="3" class="text-center label_field"><div class='label_order'>28</div>NOMBRES</td>
                <td colspan="8" class="text-center"></td>
            </tr>

            <tr>
                <!--<td colspan="1">29</td>-->
                <td colspan="11" class="text-center label_field"><div class='label_order'>29</div>APELLIDO PATERNO</td>
                <!--<td colspan="1">30</td>-->
                <td colspan="10" class="text-center label_field"><div class='label_order'>30</div>APELLIDO MATERNO</td> 
            </tr>
            <tr>
                <td colspan="11" style="text-align: center"><?php echo '&nbsp;' ?></td>
                <td colspan="10" style="text-align: center"></td> 
            </tr>

            <tr>
                <!--<td colspan="1">31</td>-->
                <td colspan="3" class="text-center label_field"><div class='label_order'>31</div>N° DE R.U.C.</td>
                <td colspan="4" style="text-align: center"><?php echo '&nbsp;' ?></td>
                <!--<td colspan="1">32</td>-->
                <td colspan="4" class="text-center label_field"><div class='label_order'>32</div>RAZÓN SOCIAL</td> 
                <td colspan="10" style="text-align: center"></td>
            </tr>

            <tr>
                <!--<td colspan="1">47</td>-->
                <td colspan="2" class="text-center label_field"><div class='label_order'>47</div>FORMA DE ADQUISIÓN</td>
                <td colspan="1"><?php echo '&nbsp;' ?></td>
                <!--<td colspan="1">48</td>-->
                <td colspan="2" class="text-center label_field"><div class='label_order'>48</div>FECHA DE ADQUISIÓN</td> 
                <td colspan="1"></td>

                <!--<td colspan="1">34</td>-->   
                <td colspan="2" class="text-center label_field"><div class='label_order'>34</div>&nbsp;&nbsp;&nbsp;&nbsp;COND. ESP. DEL TITULAR</td> 
                <td colspan="1" style="text-align: center"><?php echo '&nbsp;' ?></td>
                <!--<td colspan="1">35</td>-->
                <td colspan="2" class="text-center label_field"><div class='label_order'>35</div>&nbsp;&nbsp;&nbsp;N° RESOLUCIÓN DE EXONERACIÓN</td>
                <td colspan="2" style="text-align: center"></td>
                <!--<td colspan="1">37</td>-->
                <td colspan="2" class="text-center label_field"><div class='label_order'>37</div>&nbsp;&nbsp;&nbsp;&nbsp;FECHA INICIO DE LA EXONERACIÓN</td>
                <td colspan="2" style="text-align: center"></td>
                <!--<td colspan="1">38</td>-->
                <td colspan="2" class="text-center label_field"><div class='label_order'>38</div>&nbsp;&nbsp;&nbsp;FECHA VENCIMIENTO DE LA EXONERACIÓN</td>
                <td colspan="2" style="text-align: center"></td>
            </tr>
        </table>
        <br>

        <!-- 21 espacios-->
        <table id="DOMICILIO_FISCAL_TITULAR" width="100%">
            <caption style="text-left">DOMICILIO FISCAL DEL TITULAR CATASTRAL</caption>
            <tr>
                <!--<td colspan="1">39</td>-->
                <td colspan="3" class="text-center label_field"><div class='label_order'>39</div>DEPARTAMENTO</td>
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
                <td colspan="3" style="text-align: center"><?php echo '&nbsp;' ?></td>
                <td colspan="3" style="text-align: center"></td>
                <td colspan="3" style="text-align: center"></td>

                <td colspan="3" style="text-align: center"><?php echo '&nbsp;' ?></td> 
                <td colspan="3" style="text-align: center"></td>
                <td colspan="3" style="text-align: center"></td> 
                <td colspan="3" style="text-align: center"></td>
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
                <td colspan="3" style="text-align: center"><?php echo '&nbsp;' ?></td>
                <td colspan="3" style="text-align: center"></td>
                <td colspan="5" style="text-align: center"></td>
                <td colspan="3" style="text-align: center"></td> 
                <td colspan="4" style="text-align: center"></td>
                <td colspan="3" style="text-align: center"></td>
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
                <td colspan="3" style="text-align: center"><?php echo '&nbsp;' ?></td>
                <td colspan="3" style="text-align: center"></td>
                <td colspan="5" style="text-align: center"></td>
                <td colspan="3" style="text-align: center"></td> 
                <td colspan="4" style="text-align: center"></td>
                <td colspan="3" style="text-align: center"></td>
            </tr>
        </table>
        <br>
    <?php endif; ?>
    
    <!-- 30 espacios-->
    <table id="INFORMACION_COMPLEMENTARIA" width="100%">
        <caption class="text-left">INFORMACIÓN COMPLEMENTARIA</caption>
        <tr>
            <!--<td colspan="1">114</td>-->
            <td colspan="5" class="text-left label_field"><div class='label_order'>114</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CONDICIÓN DE DECLARANTE</td>
            <td colspan="1" class="text-center"><?php echo (!empty($Ficha_Cotitularidad)) ? ($Ficha_Cotitularidad->Condicion_Declarante):'&nbsp;'; ?></td>
            
            <!--<td colspan="1">116</td>-->
            <td colspan="5" class="text-left label_field"><div class='label_order'>116</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ESTADO DE LLENADO DE LA FICHA</td>
            <td colspan="1" class="text-center"><?php echo (!empty($Ficha_Cotitularidad)) ? ($Ficha_Cotitularidad->Estado_Llenado):'&nbsp;'; ?></td>

            <td colspan="12" class="text-center bloque-nulo">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        </tr>
    </table>
    <br>

    <!-- 44 espacios-->
    <table id="OBSERVACIONES" width="100%">
        <caption class="text-left">OBSERVACIONES</caption>
        <tr>
            <td class="text-justify">
                <?php echo (!empty($Ficha_Cotitularidad)) ? strtoupper($Ficha_Cotitularidad->Observaciones):'&nbsp;'; ?>
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
</body>
<!--
</html>-->

<?php  
    if(isset($oFicha)) unset($oFicha);
    if(isset($Ficha)) unset($Ficha);

    if(isset($olote)) unset($olote);
    if(isset($lote)) unset($lote);
    
    if(isset($oUni_Cat)) unset($oUni_Cat);
    if(isset($Uni_Cat)) unset($Uni_Cat);

    if(isset($oEdificacion)) unset($oEdificacion);
    if(isset($Edificacion)) unset($Edificacion);

    if(isset($oFicha_Cotitularidad)) unset($oFicha_Cotitularidad);
    if(isset($Ficha_Cotitularidad)) unset($Ficha_Cotitularidad);

    if(isset($oTitulares)) unset($oTitulares);
    if(isset($Titulares)) unset($Titulares);

    if(isset($oDomicilio_Fiscal)) unset($oDomicilio_Fiscal);
    if(isset($Domicilio_Fiscal)) unset($Domicilio_Fiscal);

    if(isset($oSys_Direccion)) unset($oSys_Direccion);
    if(isset($Sys_Direccion)) unset($Sys_Direccion);

    if(isset($oHabilitacion_Urbana)) unset($oHabilitacion_Urbana);
    if(isset($Habilitacion_Urbana)) unset($Habilitacion_Urbana);

    if(isset($Exoneracion_Titular)) unset($Exoneracion_Titular);    

    if(isset($oDeclarante)) unset($oDeclarante);
    if(isset($Declarante)) unset($Declarante);

    if(isset($oTecnicoC)) unset($oTecnicoC);
    if(isset($TecnicoC)) unset($TecnicoC);

    if(isset($oUsuario)) unset($oUsuario);
    if(isset($Usuario)) unset($Usuario);

    if(isset($oPersonal)) unset($oPersonal);
    if(isset($Personal)) unset($Personal);
?>