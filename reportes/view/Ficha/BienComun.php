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

    # Obtenemos Fichas_Bienes_Comunes
    if(!empty($Ficha)):
        $oFichas_Bienes_Comunes = new Fichas_Bienes_Comunes();
        $Fichas_Bienes_Comunes = $oFichas_Bienes_Comunes->ObtenerFichaBienComun($Id_Ficha);
    endif;

    if(!empty($Uni_Cat)):
        # Obtenemos las Puertas_Por_Unidad
        $oReferencia_Puertas = new Puertas_por_Unidad();
        $Referencia_Puertas = $oReferencia_Puertas->ObtenerPuertasPorUnidad($Uni_Cat->IdUniCat);
    else:
        # Obtenemos Los Ingresos
        $oReferencia_Puertas = new Ingresos();
        $Referencia_Puertas = $oReferencia_Puertas->ObtenerIngresos($Fichas_Bienes_Comunes->Id_Ficha);
    endif;

    # Obtenemos Habilitacion_Urbana
    $oHabilitacion_Urbana = new Habilitacion_Urbana();
    $Habilitacion_Urbana = $oHabilitacion_Urbana->ObtenerHU($lote->IdHU);

    # Obtenemos Usos
    if(!empty($Fichas_Bienes_Comunes)):
        $oUso = new Usos();
        $Uso = $oUso->ObtenerUso($Fichas_Bienes_Comunes->IdUso);
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

     # Obtenemos las Recapitulaciones de Edificios
    if(!empty($Ficha)):
        $oRecap_Edificio = new Recap_Edificio();
        $Recap_Edificio = $oRecap_Edificio->ObtenerRecapEdificio($Ficha->Id_Ficha);
    endif;

     # Obtenemos las Recapitulaciones de Bienes Comunes
    if(!empty($Ficha)):
        $oRecap_BBCC = new Recap_BBCC();
        $Recap_BBCC = $oRecap_BBCC->ObtenerRecapBBCC($Ficha->Id_Ficha);
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
    <title>FICHA DE BIENES COMUNES</title>
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
        <caption><h2 class="text-center">FICHA CATASTRAL URBANA BIENES COMUNES</h2></caption>
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
            <td colspan="1" class="text-center" id="txtedifica"><?php echo (isset($Edificacion))? $Edificacion->Grupo_Edifica:'&nbsp;'; ?></td>
            <td colspan="1" class="text-center" id="txtentrada"><?php echo (isset($Uni_Cat))? $Uni_Cat->Cod_Entrada:'&nbsp;'; ?></td>
            <td colspan="1" class="text-center" id="txtpiso"><?php echo (isset($Uni_Cat))? $Uni_Cat->Cod_Piso:'&nbsp;'; ?></td>
            <td colspan="1" class="text-center" id="txtcodunidad"><?php echo (isset($Uni_Cat))? $Uni_Cat->Cod_Unidad:'&nbsp;'; ?></td>
            <td colspan="1" class="text-center" id="txtdc"><?php echo (isset($Ficha))? $Ficha->DC:'&nbsp;'; ?></td>
        </tr>
    </table>
    <br>
    
    <!-- 18 espacios-->
    <table id="UBICACION_BIEN_COMUN" width="100%">
        <caption style="text-left">UBICACIÓN DEL BIEN COMUN</caption>
        <tr>
            <td ID="Cod_Via" colspan="2" class="text-center label_field" width="13%"><div class='label_order'>07</div>CÓDIGO DE VÍA</td>

            <td ID="Tip_Via" colspan="2" class="text-center label_field" width="11%"><div class='label_order'>08</div>TIPO DE VÍA</td>

            <td ID="Nom_Via" colspan="6" class="text-center label_field" width="25%"><div class='label_order'>09</div>NOMBRE DE VÍA</td>

            <td ID="Puerta" colspan="2" class="text-center label_field" width="10%"><div class='label_order'>10</div>TIPO DE<br> PUERTA</td>

            <td ID="NroMunicipal" colspan="2" class="text-center label_field" width="8%"><div class='label_order'>11</div>N° MUNICIPAL</td>

            <td ID="Condicion" colspan="2" class="text-center label_field"><div class='label_order'>12</div>&nbsp;COND. NÚMER.</td>

            <td ID="Nro_Certificacion" colspan="2" class="text-center label_field"><div class='label_order'>13</div>N° DE CER. DE NUMERACIÓN</td>
        </tr>
        <!-- INICIO DE BUCLE -->
        <?php foreach($Referencia_Puertas as $referencia): ?>
        <?php   $oPuerta = new Puertas(); ?>
        <?php   $Puerta = $oPuerta->ObtenerPuerta($referencia->IdPuerta); ?>
        <?php   $oVia = new Vias(); ?>
        <?php   $Via = $oVia->ObtenerVia($Puerta->IdVia); ?>
        <tr>
            <td colspan="2" class="text-center"><?php echo (!empty($Via))? trim($Via->Cod_Via):''; ?></td>
            <td ID="TipoVia" colspan="2" class="text-center"><?php echo (!empty($Via))? SelectorTipoVia($Via->Tip_Via):''; ?></td>
            <td ID="Nom_Via" colspan="6" class="text-center"><?php echo (!empty($Via))? trim($Via->Nom_Via):''; ?></td>             
            <td ID="TipPuerta" colspan="2" class="text-center"><?php echo (!empty($Puerta))? trim($Puerta->Tip_Puerta):''; ?></td>
            <td colspan="2" class="text-center"><?php echo (!empty($Puerta))? trim($Puerta->Nro_Muni):''; ?></td>
            <td colspan="2" class="text-center"><?php echo (!empty($Puerta))? trim($Puerta->Condicion_Nro):''; ?></td>
            <td colspan="2" class="text-center"><?php echo (!empty($Puerta))? trim($Puerta->Nro_Certificacion):''; ?></td>
        </tr>
        <?php endforeach; ?>
        <!-- FINAL DE BUCLE -->

        <tr width="100%">
            <!--<td colspan="1">14</td>-->
            <td colspan="4" class="text-center label_field"><div class='label_order'>14</div>&nbsp;&nbsp;&nbsp;NOMBRE DE LA EDIFICACIÓN</td>
            <td colspan="10" class="text-center" width="20%"><?php echo (!empty($Edificacion))? trim($Edificacion->Nom_Edificacion):'&nbsp;'; ?></td>

            <!--<td colspan="1">15</td>-->
            <td colspan="3" class="text-center label_field" width="15%"><div class='label_order'>15</div>TIPO DE EDIFICACIÓN</td>
            <td colspan="1" class="text-center" width="5%"><?php echo (isset($Edificacion))? $Edificacion->Tip_Edificacion:'&nbsp;'; ?></td>
        </tr>

        <tr>
            <!--<td colspan="1">18</td>-->
            <td colspan="3" class="text-center label_field"><div class='label_order'>18</div>CÓDIGO H.U.</td>
            <!--<td colspan="1">19</td>-->
            <td colspan="6" class="text-center label_field"><div class='label_order'>19</div>NOMBRE DE LA HABILITACIÓN URBANA</td>
            <!--<td colspan="1">20</td>-->
            <td colspan="3" class="text-center label_field"><div class='label_order'>20</div>ZONA/SECTOR/ETAPA</td>
            <!--<td colspan="1">21</td>-->
            <td colspan="2" class="text-center label_field"><div class='label_order'>21</div>MANZANA</td>
            <!--<td colspan="1">22</td>-->
            <td colspan="2" class="text-center label_field"><div class='label_order'>22</div>LOTE</td>
            <!--<td colspan="1">23</td>-->
            <td colspan="2" class="text-center label_field"><div class='label_order'>23</div>SUB-LOTE</td>
        </tr>
        <tr>
            <td colspan="3" class="text-center"><?php echo $Habilitacion_Urbana->Id_Hab_Urba; ?></td>
            <td colspan="6" style="text-align: center"><?php echo $Habilitacion_Urbana->Nom_Hab_Urba; ?></td>
            <td colspan="3" style="text-align: center"><?php echo $Habilitacion_Urbana->Grupo_Urba; ?></td>
            <td colspan="2" style="text-align: center"><?php echo $lote->Mzna_Dist; ?></td>
            <td colspan="2" style="text-align: center"><?php echo $lote->Lote_Dist; ?></td>
            <td colspan="2" style="text-align: center"><?php echo $lote->Sub_Lote_Dist; ?></td>
        </tr>
    </table>
    <br>

    <!-- 18 espacios-->
    <table id="DESCRIPCION_BIEN_COMUN" width="100%">
        <caption style="text-left">DESCRIPCIÓN DEL BIEN COMUN</caption>
        <tr>
            <!--<td colspan="1">54</td>-->
            <td colspan="5" class="text-center label_field"><div class='label_order'>54</div>CLASIFICACIÓN DEL PREDIO</td>
            <td colspan="1"><?php echo (isset($Fichas_Bienes_Comunes))? $Fichas_Bienes_Comunes->Clasificacion:''; ?></td>
            <td colspan="12" class="bloque-nulo" style="text-align: center">CASA-HABITACION | TIENDA-DEPOSITO-ALMACÉN | PREDIO EN EDIFICIO | OTROS </td>
        </tr>

        <tr>
            <!--<td colspan="1">55</td>-->
            <td colspan="5" class="text-center label_field"><div class='label_order'>55</div>PREDIO CATASTRAL EN</td>
            <td colspan="1"><?php echo (isset($Fichas_Bienes_Comunes))? $Fichas_Bienes_Comunes->Contenido_En:''; ?></td>
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
            <td colspan="3" style="text-align: center"><?php echo isset($Uso)? $Uso->Cod_Uso:''; ?></td>
            <td colspan="8" style="text-align: center"><?php echo isset($Uso)? $Uso->Desc_Uso:''; ?></td>
            <td colspan="4" style="text-align: center"><?php echo isset($lote)? $lote->Estructuracion:''; ?></td>
            <td colspan="3" style="text-align: center"><?php echo isset($lote)? $lote->Zonificacion:''; ?></td>
        </tr>

        <tr>
            <!--<td colspan="1">60</td>-->
            <td colspan="9" class="text-center label_field"><div class='label_order'>60</div>ÁREA DE TERRENO TITULO (M2)</td>
            <!--<td colspan="1">62</td>-->
            <td colspan="9" class="text-center label_field"><div class='label_order'>62</div>ÁREA DE TERRENO VERIFICADO (M2)</td>
        </tr>
        <tr>
            <td colspan="9" style="text-align: center"><?php echo (isset($Fichas_Bienes_Comunes))? (float)($Fichas_Bienes_Comunes->Area_Titulo):''; ?></td>
            <td colspan="9" style="text-align: center"><?php echo (isset($Fichas_Bienes_Comunes))? (float)($Fichas_Bienes_Comunes->Area_Verificada):''; ?></td>
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
            <td colspan="4" style="text-align: center"><?php echo $Linderos->Frente_Colinda_Campo; ?></td>
            <td colspan="4" style="text-align: center"></td>
        </tr>
        <tr>
            <td colspan="4" class="text-left label_field">DERECHA</td>
            <td colspan="3" style="text-align: center"><?php echo $TramoDerecha; ?></td>
            <td colspan="3" style="text-align: center"></td>
            <td colspan="4" style="text-align: center"><?php echo $Linderos->Der_Colinda_Campo; ?></td>
            <td colspan="4" style="text-align: center"></td>
        </tr>
        <tr>
            <td colspan="4" class="text-left label_field">IZQUIERDA</td>
            <td colspan="3" style="text-align: center"><?php echo $TramoIzquierda; ?></td>
            <td colspan="3" style="text-align: center"></td>
            <td colspan="4" style="text-align: center"><?php echo $Linderos->Izq_Colinda_Campo; ?></td>
            <td colspan="4" style="text-align: center"></td>
        </tr>
        <tr>
            <td colspan="4" class="text-left label_field">FONDO</td>
            <td colspan="3" style="text-align: center"><?php echo $TramoFondo; ?></td>
            <td colspan="3" style="text-align: center"></td>
            <td colspan="4" style="text-align: center"><?php echo $Linderos->Fondo_Colinda_Campo; ?></td>
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
            <td colspan="3" class="text-center label_field"><div class='label_order'>70</div>DESAGUE</td>
            <td colspan="1" style="text-align: center">
                <?php echo (!empty($Servicios_Basicos)) ? (($Servicios_Basicos->Desague == 1) ? 'SI':'NO'):''; ?>
            </td>
            
            <!--<td colspan="1">71</td>-->
            <td colspan="6" class="text-center label_field"><div class='label_order'>71</div>N° SUM. LUZ</td>
            <td colspan="2" class="text-center"><?php echo $Servicios_Basicos->Nro_Sum_Luz; ?></td>
            <!--<td colspan="1">72</td>-->
            <td colspan="8" class="text-center label_field"><div class='label_order'>72</div>N° CONTRATO DE AGUA</td>
            <td colspan="2" class="text-center"><?php echo trim($Servicios_Basicos->Nro_Contrato_Agua); ?></td>
            <!--<td colspan="1">73</td>-->
            <td colspan="4" class="text-center label_field"><div class='label_order'>73</div>N° TELEFONO</td>
            <td colspan="2" class="text-center" width="8%"><?php echo $Servicios_Basicos->Nro_Telefono; ?></td>
        </tr>
    </table>
    <br>

    <!-- 57 espacios-->
    <table id="CONSTRUCCIONES" width="100%">
        <caption style="text-left">CONSTRUCCIONES COMUNES</caption>
        <tr>
            <!--<td rowspan="3" colspan="1">74</td>-->
            <td rowspan="3" colspan="4" class="text-center label_field"><div class='label_order'>74</div>N° PISO<br> SOTANO<br> MEZZANINE</td>

            <!--<td rowspan="3" colspan="1">75</td>-->
            <td rowspan="3" colspan="5" class="text-center label_field"><div class='label_order'>75</div>FECHA DE<br> CONSTRUC.</td>

            <!--<td rowspan="3" colspan="1">76</td>-->
            <td rowspan="3" colspan="3" class="text-center label_field"><div class='label_order'>76</div>MEP</td>

            <!--<td rowspan="3" colspan="1">77</td>-->
            <td rowspan="3" colspan="3" class="text-center label_field"><div class='label_order'>77</div>ECS</td>

            <!--<td rowspan="3" colspan="1">78</td>-->
            <td rowspan="3" colspan="3" class="text-center label_field"><div class='label_order'>78</div>ECC</td>

            <td colspan="30" class="text-center label_field">CATEGORÍAS</td>

            <td colspan="6" class="text-center label_field">ÁREA CONSTRUIDA (M2)</td>
            
            <!--<td rowspan="3" colspan="1">88</td>-->
            <td rowspan="3" colspan="3" class="text-center label_field"><div class='label_order'>88</div>UCA</td>
        </tr>
        <tr>
            <td colspan="9" class="text-center label_field">ESTRUCTURA</td>
            <td colspan="17" class="text-center label_field">ACABADOS</td>

            <!--<td rowspan="2" colspan="1">85</td>-->
            <td rowspan="2" colspan="4" class="text-center label_field"><div class='label_order'>85</div>INST. ELEC SANIT</td>

            <!--<td rowspan="2" colspan="1">86</td>-->
            <td rowspan="2" colspan="3" class="text-center label_field"><div class='label_order'>86</div>DECLARADA</td>

            <!--<td rowspan="2" colspan="1">87</td>-->
            <td rowspan="2" colspan="3" class="text-center label_field"><div class='label_order'>87</div>VERIFICADA</td>
        </tr>
        <tr>
            <!--<td colspan="1">79</td>-->
            <td colspan="5" class="text-center label_field"><div class='label_order'>79</div>MUR<br> &<br> COL</td>

            <!--<td colspan="1">80</td>-->
            <td colspan="4" class="text-center label_field"><div class='label_order'>80</div>TECHOS</td>

            <!--<td colspan="1">81</td>-->
            <td colspan="4" class="text-center label_field"><div class='label_order'>81</div>PISOS</td>

            <!--<td colspan="1">82</td>-->
            <td colspan="5" class="text-center label_field"><div class='label_order'>82</div>PU<br> &<br> VEN</td>
            
            <!--<td colspan="1">83</td>-->
            <td colspan="4" class="text-center label_field"><div class='label_order'>83</div>REVEST.</td>
            
            <!--<td colspan="1">84</td>-->
            <td colspan="4" class="text-center label_field"><div class='label_order'>84</div>BAÑOS</td>
        </tr>
        
        <!-- INICIO DE BUCLE -->
        <?php $Suma_Area_Declarada = 0; ?>
        <?php $Suma_Area_Verificada = 0; ?>

        <?php foreach($Construcciones as $construccion) : ?>
        <?php   $Suma_Area_Declarada = $Suma_Area_Declarada + $construccion->Area_Declarada; ?>
        <?php   $Suma_Area_Verificada = $Suma_Area_Verificada + $construccion->Area_Verificada; ?>
        <tr>
            <td colspan="4" class="text-center"><?php echo $construccion->Nro_Piso; ?></td>
            <td colspan="5" class="text-center"><?php echo $construccion->Mes.'/'.$construccion->Anio; ?></td>
            <td colspan="3" class="text-center"><?php echo $construccion->Mep; ?></td>
            <td colspan="3" class="text-center"><?php echo $construccion->Ecs; ?></td>
            <td colspan="3" class="text-center"><?php echo $construccion->Ecc; ?></td>
            
            <td colspan="5" style="text-align: center"><?php echo $construccion->Estru_Muro_Col; ?></td>
            <td colspan="4" style="text-align: center"><?php echo $construccion->Estru_Techo; ?></td>
            <td colspan="4" style="text-align: center"><?php echo $construccion->Acaba_Piso; ?></td>
            <td colspan="5" style="text-align: center"><?php echo $construccion->Acaba_Puerta_Ven; ?></td>
            <td colspan="4" style="text-align: center"><?php echo $construccion->Acaba_Revest; ?></td>
            <td colspan="4" style="text-align: center"><?php echo $construccion->Acaba_Bano; ?></td>
            <td colspan="4" style="text-align: center"><?php echo $construccion->Inst_Elect_Sanita; ?></td>

            <td colspan="3" style="text-align: center"><?php echo (float)($construccion->Area_Declarada); ?></td>
            <td colspan="3" style="text-align: center"><?php echo (float)($construccion->Area_Verificada); ?></td>

            <td colspan="3" class="text-center"><?php echo $construccion->Uca; ?></td>
        </tr>
        <?php endforeach; ?>
        <!-- FIN DE BUCLE -->

        <tr>
            <td colspan="48" class="text-right label_field">TOTAL</td>

            <td colspan="3" style="text-align: center"><?php echo $Suma_Area_Declarada; ?></td>
            <td colspan="3" style="text-align: center"><?php echo $Suma_Area_Verificada; ?></td>
            <td colspan="3" class="text-center">&nbsp;</td>
        </tr>
    </table>
    <br>
        
    <!-- 60 espacios-->
    <table id="INSTALACIONES" width="100%">
        <caption class="text-left">OBRAS COMPLEMENTARIAS / OTRAS INSTALACIONES</caption>
        <tr>
            <!--<td colspan="1">90</td>-->
            <td colspan="5" class="text-center label_field" width="7%"><div class='label_order'>90</div>CÓDIGO</td>

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
        
        <?php if(!empty($Instalaciones)): ?>
            <!-- INICIO DE BUCLE -->
            <?php foreach($Instalaciones as $instalacion) : ?>
            <?php   $oCodigos_Instalaciones = new Codigos_Instalaciones(); ?>
            <?php   $Codigos_Instalaciones = $oCodigos_Instalaciones->ObtenerCodInstalacion($instalacion->IdCodInst); ?>
            <tr>
                <td colspan="5" class="text-center"><?php echo (!empty($Codigos_Instalaciones)) ? $Codigos_Instalaciones->Cod_Instalacion:'&nbsp;'; ?></td>
                <td colspan="9" class="text-center"><?php echo $Codigos_Instalaciones->Desc_Instalacion.' '.$Codigos_Instalaciones->Material; ?></td>
                <td colspan="6" class="text-center"><?php echo $instalacion->Mes.'/'.$instalacion->Anio; ?></td>
                <td colspan="4" class="text-center"><?php echo $instalacion->Mep; ?></td>
                <td colspan="4" class="text-center"><?php echo $instalacion->Ecs; ?></td>
                <td colspan="4" class="text-center"><?php echo $instalacion->Ecc; ?></td>
                <td colspan="4" class="text-center"><?php echo (float)($instalacion->Dimension_Largo); ?></td>
                <td colspan="4" class="text-center"><?php echo (float)($instalacion->Dimension_Ancho); ?></td>
                <td colspan="4" class="text-center"><?php echo (float)($instalacion->Dimension_Alto); ?></td>
                <td colspan="6" class="text-center"><?php echo (float)($instalacion->Producto_Total); ?></td>
                <td colspan="6" class="text-center"><?php echo (!empty($Codigos_Instalaciones)) ? $Codigos_Instalaciones->Unidad:'&nbsp;'; ?></td>
                <td colspan="4" class="text-center"><?php echo $instalacion->Uca; ?></td>
            </tr>
            <?php endforeach; ?>
            <!-- FINAL DE BUCLE -->
        <?php else: ?>
            <tr>
                <td colspan="5">&nbsp;</td>
                <td colspan="9"></td>
                <td colspan="6"></td>
                <td colspan="4"></td>
                <td colspan="4"></td>
                <td colspan="4"></td>
                <td colspan="4"></td>
                <td colspan="4"></td>
                <td colspan="4"></td>
                <td colspan="6"></td>
                <td colspan="6"></td>
                <td colspan="4"></td>
            </tr>
        <?php endif; ?>
    </table>
    <br>

    <!-- 18 espacios-->
    <table id="RECAPITULACION_EDIFICIOS" width="100%">
        <caption style="text-left">RECAPITULACIÓN DE EDIFICIOS</caption>
        <tr>
            <td colspan="20" class="text-center label_field"><div class='label_order'>113</div>ÁREA DE TERRENO INVADIDA EN M2</td>
        </tr>
        <tr>
            <td colspan="4" class="text-center label_field">LOTE COLINDANTE</td>
            <td colspan="1" class="text-center"><?php echo (isset($Fichas_Bienes_Comunes))? (($Fichas_Bienes_Comunes->En_Colindante != 0)? $Fichas_Bienes_Comunes->En_Colindante:''):''; ?></td>

            <td colspan="4" class="text-center label_field">JARDÍN AISLAMIENTO</td>
            <td colspan="1" class="text-center"><?php echo (isset($Fichas_Bienes_Comunes))? (($Fichas_Bienes_Comunes->En_Jardin_Aislamiento != 0)? $Fichas_Bienes_Comunes->En_Jardin_Aislamiento:''):''; ?></td>

            <td colspan="4" class="text-center label_field">ÁREA PÚBLICA</td>
            <td colspan="1" class="text-center"><?php echo (isset($Fichas_Bienes_Comunes))? (($Fichas_Bienes_Comunes->En_Area_Publica != 0)? $Fichas_Bienes_Comunes->En_Area_Publica:''):''; ?></td>

            <td colspan="4" class="text-center label_field">ÁREA INTANGIBLE</td>
            <td colspan="1" class="text-center"><?php echo (isset($Fichas_Bienes_Comunes))? (($Fichas_Bienes_Comunes->En_Area_Intangible != 0)? $Fichas_Bienes_Comunes->En_Area_Intangible:''):''; ?></td>
        </tr>
    </table>
    <br>
    <table width="100%">
        <tr>
            <td colspan="2" class="text-center label_field"><div class='label_order'>128</div>EDIFICIO</td>

            <td colspan="2" class="text-center label_field"><div class='label_order'>129</div>PORCENTAJE (%)</td>

            <td colspan="2" class="text-center label_field"><div class='label_order'>130</div>ATC (m2)</td>

            <td colspan="2" class="text-center label_field"><div class='label_order'>131</div>ACC (m2)</td>

            <td colspan="2" class="text-center label_field"><div class='label_order'>132</div>AOIC (m2)</td>
        </tr>

        <?php $RE_Porcentaje_Total = 0; ?>
        <?php $RE_ATC_Total = 0; ?>
        <?php $RE_ACC_Total = 0; ?>
        <?php $RE_AOIC_Total = 0; ?>

        <?php if(!empty($Recap_Edificio)): ?>
            <!-- INICIO DE BUCLE -->
            <?php foreach($Recap_Edificio as $recap_edificio): ?>
            <?php   $RE_Porcentaje_Total = $RE_Porcentaje_Total + $recap_edificio->Total_Porc; ?>
            <?php   $RE_ATC_Total = $RE_ATC_Total + $recap_edificio->Total_Atc; ?>
            <?php   $RE_ACC_Total = $RE_ACC_Total + $recap_edificio->Total_Acc; ?>
            <?php   $RE_AOIC_Total = $RE_AOIC_Total + $recap_edificio->Total_Aoic; ?>
            <tr>
                <td colspan="2" class="text-center"><?php echo (!empty($recap_edificio))? trim($recap_edificio->Edificio):''; ?></td>
                <td colspan="2" class="text-center"><?php echo (!empty($recap_edificio))? trim($recap_edificio->Total_Porc):''; ?></td>
                <td colspan="2" class="text-center"><?php echo (!empty($recap_edificio))? trim($recap_edificio->Total_Atc):''; ?></td>             
                <td colspan="2" class="text-center"><?php echo (!empty($recap_edificio))? trim($recap_edificio->Total_Acc):''; ?></td>
                <td colspan="2" class="text-center"><?php echo (!empty($recap_edificio))? trim($recap_edificio->Total_Aoic):''; ?></td>
            </tr>
            <?php endforeach; ?>
            <!-- FINAL DE BUCLE -->
        <?php else: ?>
            <tr>
                <td colspan="2">&nbsp;</td>
                <td colspan="2"></td>
                <td colspan="2"></td>
                <td colspan="2"></td>
                <td colspan="2"></td>
            </tr>
        <?php endif; ?>
        <tr>
            <td colspan="2" class="text-right label_field">TOTAL</td>
            <td colspan="2" class="text-center"><?php echo ($RE_Porcentaje_Total>0)? ($RE_Porcentaje_Total):''; ?></td>
            <td colspan="2" class="text-center"><?php echo ($RE_ATC_Total>0)? ($RE_ATC_Total):''; ?></td>
            <td colspan="2" class="text-center"><?php echo ($RE_ACC_Total>0)? ($RE_ACC_Total):''; ?></td>
            <td colspan="2" class="text-center"><?php echo ($RE_AOIC_Total>0)? ($RE_AOIC_Total):''; ?></td>
        </tr>
    </table>
    <br>

    <table id="RECAPITULACION_BIENES_COMUNES" width="100%">
        <caption style="text-left">RECAPITULACION DE BIENES COMUNES</caption>
        <tr>
            <td colspan="2" class="text-center label_field"><div class='label_order'>123</div>N°</td>

            <td colspan="2" class="text-center label_field">EDIFICACIÓN</td>

            <td colspan="2" class="text-center label_field">ENTRADA</td>

            <td colspan="2" class="text-center label_field">PISO</td>

            <td colspan="2" class="text-center label_field">UNIDAD</td>

            <td colspan="2" class="text-center label_field"><div class='label_order'>89</div>PORCENTAJE (%)</td>

            <td colspan="2" class="text-center label_field"><div class='label_order'>134</div>ATC</td>

            <td colspan="2" class="text-center label_field"><div class='label_order'>131</div>ACC</td>

            <td colspan="2" class="text-center label_field"><div class='label_order'>132</div>AOIC</td>
        </tr>
        <?php if(!empty($Recap_BBCC)): ?>
            <!-- INICIO DE BUCLE -->
            <?php $CONTADOR_RECAP_BBCC = 0; ?>

            <?php $RBC_Porcentaje_Total = 0; ?>
            <?php $RBC_ATC_Total = 0; ?>
            <?php $RBC_ACC_Total = 0; ?>
            <?php $RBC_AOIC_Total = 0; ?>

            <?php foreach($Recap_BBCC as $recap_bienes): ?>
            <?php   $CONTADOR_RECAP_BBCC = $CONTADOR_RECAP_BBCC+1; ?>
            <?php   $RBC_Porcentaje_Total = $RBC_Porcentaje_Total + $recap_bienes->Porc; ?>
            <?php   $RBC_ATC_Total = $RBC_ATC_Total + $recap_bienes->ATC; ?>
            <?php   $RBC_ACC_Total = $RBC_ACC_Total + $recap_bienes->ACC; ?>
            <?php   $RBC_AOIC_Total = $RBC_AOIC_Total + $recap_bienes->AOIC; ?>
            <tr>
                <td colspan="2" class="text-center"><?php echo (!empty($recap_bienes))? trim($CONTADOR_RECAP_BBCC):''; ?></td>
                <td colspan="2" class="text-center"><?php echo (!empty($recap_bienes))? trim($recap_bienes->Edifica):''; ?></td>
                <td colspan="2" class="text-center"><?php echo (!empty($recap_bienes))? trim($recap_bienes->Entrada):''; ?></td>
                <td colspan="2" class="text-center"><?php echo (!empty($recap_bienes))? trim($recap_bienes->Piso):''; ?></td>
                <td colspan="2" class="text-center"><?php echo (!empty($recap_bienes))? trim($recap_bienes->Unidad):''; ?></td>
                <td colspan="2" class="text-center"><?php echo (!empty($recap_bienes))? (float)($recap_bienes->Porc):''; ?></td>
                <td colspan="2" class="text-center"><?php echo (!empty($recap_bienes))? (float)($recap_bienes->ATC):''; ?></td>             
                <td colspan="2" class="text-center"><?php echo (!empty($recap_bienes))? (float)($recap_bienes->ACC):''; ?></td>
                <td colspan="2" class="text-center"><?php echo (!empty($recap_bienes))? (float)($recap_bienes->AOIC):''; ?></td>
            </tr>
            <?php endforeach; ?>
            <!-- FINAL DE BUCLE -->
        <?php else: ?>
            <tr>
                <td colspan="2">&nbsp;</td>
                <td colspan="2"></td>
                <td colspan="2"></td>
                <td colspan="2"></td>
                <td colspan="2"></td>
            </tr>
        <?php endif; ?>
        <tr>
            <td colspan="10" class="text-right label_field">TOTAL</td>

            <td colspan="2" class="text-center"><?php echo (!empty($recap_bienes))? ($RBC_Porcentaje_Total):''; ?></td>

            <td colspan="2" class="text-center"><?php echo (!empty($recap_bienes))? ($RBC_ATC_Total):''; ?></td>

            <td colspan="2" class="text-center"><?php echo (!empty($recap_bienes))? ($RBC_ACC_Total):''; ?></td>

            <td colspan="2" class="text-center"><?php echo (!empty($recap_bienes))? ($RBC_AOIC_Total):''; ?></td>
        </tr>
    </table>
    <br>

    <!-- 44 espacios-->
    <table id="INFORMACION_COMPLEMENTARIA" width="100%">
        <caption class="text-left">INFORMACIÓN COMPLEMENTARIA</caption>
        <tr>
            <!--<td colspan="1">114</td>-->
            <td colspan="8" class="text-left label_field"><div class='label_order'>114</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CONDICIÓN DE DECLARANTE</td>
            <td colspan="1"><?php echo $Fichas_Bienes_Comunes->Condicion_Declara; ?></td>

            <td colspan="8" class="text-left label_field"><div class='label_order'>115</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ESTADO DE LLENADO DE FICHA</td>
            <td colspan="1"><?php echo $Fichas_Bienes_Comunes->Estado_Llenado; ?></td>

            <td colspan="8" class="text-left label_field"><div class='label_order'>119</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MANTENIMIENTO</td>
            <td colspan="1" class="text-center"><?php echo $Fichas_Bienes_Comunes->Mantenimiento; ?></td>
        </tr>
    </table>
    <br>

    <!-- 44 espacios-->
    <table id="OBSERVACIONES" width="100%">
        <caption class="text-left">OBSERVACIONES</caption>
        <tr>
            <td width="100%" style="text-justify"><?php echo strtoupper($Fichas_Bienes_Comunes->Observaciones); ?><br></td>
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

    if(isset($oFichas_Bienes_Comunes)) unset($oFichas_Bienes_Comunes);
    if(isset($Fichas_Bienes_Comunes)) unset($Fichas_Bienes_Comunes);

    if(isset($oReferencia_Puertas)) unset($oReferencia_Puertas);
    if(isset($Referencia_Puertas)) unset($Referencia_Puertas);

    if(isset($oHabilitacion_Urbana)) unset($oHabilitacion_Urbana);
    if(isset($Habilitacion_Urbana)) unset($Habilitacion_Urbana);

    if(isset($oUso)) unset($oUso);
    if(isset($Uso)) unset($Uso);

    if(isset($Ingreso)) unset($Ingreso);
    if(isset($oPuerta)) unset($oPuerta);
    if(isset($Puerta)) unset($Puerta);

    if(isset($oVia)) unset($oVia);
    if(isset($Via)) unset($Via);

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

    if(isset($oRecap_Edificio)) unset($oRecap_Edificio);
    if(isset($Recap_Edificio)) unset($Recap_Edificio);

    if(isset($oRecap_BBCC)) unset($oRecap_BBCC);
    if(isset($Recap_BBCC)) unset($Recap_BBCC);

    if(isset($oDeclarante)) unset($oDeclarante);
    if(isset($Declarante)) unset($Declarante);

    if(isset($oTecnicoC)) unset($oTecnicoC);
    if(isset($TecnicoC)) unset($TecnicoC);

    if(isset($oUsuario)) unset($oUsuario);
    if(isset($Usuario)) unset($Usuario);

    if(isset($oPersonal)) unset($oPersonal);
    if(isset($Personal)) unset($Personal);
?>