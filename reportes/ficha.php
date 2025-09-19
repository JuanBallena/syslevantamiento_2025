<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Reporte Fichas Catastrales</title>

    <link rel="stylesheet" href="assets/css/estilos2000.css">

  
</head>
                  
<?php 

include '../configuracion/conexion.php';


  $conn=conectarse();

  $CodCata =$_GET['CodCata'];  
  $CodPredio = $_GET["CodPredio"];
    //$CodCata = '012101901003';   
      $sql = "SELECT CodCata,
                     PR_Predio.CodUrba,PR_Predio.CodCalle,NumFinca,Manzana,Lote,Residencial,Edificio,
                     Piso,Interior,TipoPredio,OrigenPredio,AreaTerreno,AreaOcupada,CondicionPredio,             
                     FrenteAParque,URBANIZACION.nombre as NombreUrb, VIA.nombvia as Nombrevia                

        FROM    PR_Predio,URBANIZACION,VIA
        WHERE   (PR_Predio.CodPredio = '$CodPredio') AND 
        (PR_Predio.CodUrba=URBANIZACION.codurba)AND
              (PR_Predio.CodCalle=VIA.codcalle)";  

          $stmt = sqlsrv_query($conn,$sql );

          if( $stmt === false) {
        
          die( print_r( sqlsrv_errors(), true) ); }

          $data_ubicacion=sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

          sqlsrv_free_stmt($stmt);
                  
     ?>

<body>
          <table>
                  <tr>
                      <td align="center" colspan="8"><strong>FICHA CATASTRAL URBANA</strong></td>
                  </tr>
                  
                  
          </table>
          
          <table>
              <tbody>
                  <tr>
                      <td align="left" colspan="8"><strong>UBICACION DEL PREDIO CATASTRAL</strong></td>
                  </tr>
                  <tr>
                      <td align="left">COD. CATA : <?php echo $CodCata?></td>
                      <td align="left" colspan="2">COD. PREDIO : <?php echo $CodPredio?></td>
                      <td align="left" colspan="5">URBANIZACION : <?php echo $data_ubicacion['NombreUrb']?></td>
                  </tr>
                  <tr>
                      <td align="left">COD. CALLE : <?php echo $data_ubicacion['CodCalle']?></td>
                      <td align="left" colspan="3">NOM. CALLE : <?php echo $data_ubicacion['Nombrevia']?></td>
                      <td align="left">TIP PUERTA:  </td>    
                      <td align="left">NRO FINCA : <?php echo $data_ubicacion['NumFinca']?> </td>    
                                            
                      <td align="left" colspan="2">NRO CER : </td>  

                  </tr>
                  <tr>
                      <td align="left">CODIGO H.U. : </td>
                      <td align="left" colspan="3">NOMBRE HAB. URB. : </td>
                      <td align="left" colspan="2">ZONA/SECTOR/ETAPA : </td>                                          
                                           
                      <td align="left">MZ : <?php echo $data_ubicacion['Manzana']?></td>
                      <td align="left">LTE: : <?php echo $data_ubicacion['Lote']?></td>
                                        

                  </tr>
                  <tr>
                      <td align="left">RESIDENCIA : <?php echo $data_ubicacion['Residencial']?></td>
                      <td align="left">EDIFICIO : <?php echo $data_ubicacion['Edificio']?></td>
                      <td align="left">PISO : <?php echo $data_ubicacion['Piso']?></td>
                      <td align="left">INTERIOR : <?php echo $data_ubicacion['Interior']?></td>
                      <td align="left"> </td>
                      <td align="left"> </td>
                  </tr>
              </tbody>
          </table>
                              
    <?php 

    $sql2 = "SELECT                      
             CodPredio,
             FechaAdqui,
             PorcBienesComun,
             PorcPropiedad,
             Observacion,
             FechaFicha,
             NroFichaInspeccion,
             PR_Persona.TipoDocumento as TipoDocumento,
             PR_Persona.NroDocumento as NroDocumento,
             PR_Persona.NombreCompleto as NombreCompleto
                        
    FROM     PR_Predio_Contribuyente,PR_Persona
    WHERE    PR_Predio_Contribuyente.CodPredio = '$CodPredio' AND PR_Predio_Contribuyente.CodContribuyente=PR_Persona.CodPersona";  

          $stmt2 = sqlsrv_query($conn,$sql2 );

          if( $stmt2 === false) {
        
          die( print_r( sqlsrv_errors(), true) ); }

          $data_titular_predio=sqlsrv_fetch_array( $stmt2, SQLSRV_FETCH_ASSOC);

          sqlsrv_free_stmt( $stmt2);
     ?>
        <table>
            <tbody>
                <tr>
                    <td align="left" colspan="4"><strong>IDENTIFICACION DEL TITULAR CATASTRAL</strong></td>
                </tr>

                <tr>
                    <td align="left">TIPO TITULAR: </td>
                    <td align="left">ESTADO CIVIL: </td>
                    <td align="left">TIPO DOC. IDENTIDAD : <?php echo $data_titular_predio['TipoDocumento']?></td>
                    <td align="left">NRO DOC : <?php echo $data_titular_predio['NroDocumento']?></td>
                </tr>

                <tr>
                    <td align="left" colspan="2">NOMB. / RAZON SOCIAL: <?php echo $data_titular_predio['NombreCompleto']?></td>
                    <td align="left" colspan="2">DIRECCION FISCAL :  </td>
                </tr>
            </tbody>
        </table>

        <table>
            <tbody>
                <tr>
                      <td align="left" colspan="5"><strong>DESCRIPCION DEL PREDIO</strong></td>                                 
                </tr>
                <tr>
                    <td align="left">TIPO PREDIO: <?php echo  $data_ubicacion['TipoPredio']?></td>
                    <td align="left">FECHA ADQ.: <?php echo $FechaAdqui=date_format($data_titular_predio['FechaAdqui'],'d-m-Y')?></td>    
                    <td align="left">%BIENES EN COMUN: <?php echo $data_titular_predio['PorcBienesComun']?></td>
                    <td align="left">%PROPIEDAD: <?php echo $data_titular_predio['PorcPropiedad']?></td>         
                    <td align="left">ORIGEN: <?php echo $data_ubicacion['OrigenPredio']?></td>      
                                       
                               
                <tr>
                    <td align="left">AREA TERRENO : <?php echo $data_ubicacion['AreaTerreno']?></td>
                    <td align="left">AREA OCUP: <?php echo $data_ubicacion['AreaOcupada']?></td>
                    <td align="left">COND.: <?php echo $data_ubicacion['CondicionPredio']?></td>
                    <td align="left">FRENTE PARQUE : <?php echo $data_ubicacion['FrenteAParque']?></td>
                </tr>
                <tr>
                    <td align="left" colspan="5">OBSERVACIONES: <?php echo $data_titular_predio['Observacion']?></td>
                </tr>
            </tbody>

        </table>

        <table>
          <tbody>
              
              <tr>
              <td align="left"><strong>DATOS FICHA</strong></td>   
              <td align="left">Nro Ficha: <?php echo $data_titular_predio['NroFichaInspeccion'];?></td>    
              <td align="left">Fecha Ficha: <?php echo $FechaFicha=date_format($data_titular_predio['FechaFicha'],'d-m-Y')?></td>
              </tr>
                                   
          </tbody>
          <br>
        </table>
    

    <?php 

                    $sql3 = "SELECT       
                            nivel,
                            FecConstMes,
                            FecConstAnio,
                            MaterialPredominante,
                            EstadoConservacion,
                            Muros,
                            Techos,
                            Pisos,
                            PuertasYventanas,
                            Revestimientos,
                            Banios,
                            InstalacionesElect,
                            Uso,
                            FecCategoMes,
                            FecCategoAnio,
                            AreaConstruida
                        
                            FROM    PR_DetallePredio
                            WHERE   CodPredio = '$CodPredio'";

           $stmt3 = sqlsrv_query($conn,$sql3 );

          if( $stmt3 === false) {
        
          die( print_r( sqlsrv_errors(), true) ); }

         
         ?>

    <table>
      <tbody>
          <tr>
                <td align="left" colspan="14"><strong>CONSTRUCCIONES </strong></td> 
                                                                                        
          </tr>
          <tr>            
                <td align="left">NIVEL</td>    
                <td align="left">FECH. CONSTR.</td>    
                                 
                <td align="left">MAT. ESTRUC.</td>    
                <td align="left">EST. DE CONSERV.</td>  

                <td align="left">MUROS</td>    
                <td align="left">TECHOS</td> 
                <td align="left">PISOS</td>    
                <td align="left">PUERTAS Y VENT.</td>  
                <td align="left">REVEST.</td>   

                <td align="left">BANOS</td>    
                <td align="left">INST. ELECT.</td>    
                <td align="left">USO</td>      
                <td align="left">FEC. CATEG.</td>  
                <td align="center">AREA CONSTRUIDA</td> 
                                                                                                                              
          </tr>
        </tbody>
 
          <?php
           while($data_construcciones = sqlsrv_fetch_array($stmt3, SQLSRV_FETCH_ASSOC)){
        
          ?>

            <tr>
              <td align="center"><?php echo $data_construcciones['nivel']?></td>    
              <td align="center"><?php echo $data_construcciones['FecConstMes'].'/'.$data_construcciones['FecConstAnio']?></td>    
              <td align="center"><?php echo $data_construcciones['MaterialPredominante']?></td>    
              <td align="center"><?php echo $data_construcciones['EstadoConservacion']?></td>    
              <td align="center"><?php echo $data_construcciones['Muros']?></td>    
              <td align="center"><?php echo $data_construcciones['Techos']?></td>    
              <td align="center"><?php echo $data_construcciones['Pisos']?></td>    
              <td align="center"><?php echo $data_construcciones['PuertasYventanas']?></td>    
              <td align="center"><?php echo $data_construcciones['Revestimientos']?></td>    
              <td align="center"><?php echo $data_construcciones['Banios']?></td>    
              <td align="center"><?php echo $data_construcciones['InstalacionesElect']?></td>    
              <td align="center"><?php echo $data_construcciones['Uso']?></td>    
              <td align="center"><?php echo $data_construcciones['FecCategoMes'].'/'.$data_construcciones['FecCategoAnio']?></td>    
              <td align="center"><?php echo $data_construcciones['AreaConstruida']?></td>  
          </tr>  

        <?php

        }
          sqlsrv_free_stmt($stmt3);

          ?>

    </table>

   <?php 

              $sql4 = "SELECT    

                            Piso,
                            TAligerado,
                            TCalamina,
                            TTortaBarro,
                            TOtros,
                            Total

                            FROM    PR_PredioPiso
                            WHERE   CodPredio = '$CodPredio'";

              $stmt4 = sqlsrv_query($conn,$sql4 );

              if( $stmt4 === false) {
        
              die( print_r( sqlsrv_errors(), true) ); }

      ?>
            
        <table>
              <tbody>
                <tr>
                      <td align="left" colspan="6"><strong>DETALLE PISOS</strong></td> 
                </tr>
                <tr>            
                      <td align="center">PISO</td>    
                      <td align="center">T ALIGERADO</td>    
                      <td align="center">T.CALAMINA</td>      
                      <td align="center">T.TORTA BARRO</td>    
                      <td align="center">T. OTROS</td>  
                      <td align="center">TOTAL</td>  
                                                                                                                              
                </tr>
              </tbody>


            <?php while($data_techo=sqlsrv_fetch_array( $stmt4, SQLSRV_FETCH_ASSOC)){ ?>
                <tr>
                      <td align="center"><?php echo $data_techo['Piso']?></td>    
                      <td align="center"><?php echo $data_techo['TAligerado']?></td>    
                      <td align="center"><?php echo $data_techo['TCalamina']?></td>    
                      <td align="center"><?php echo $data_techo['TTortaBarro']?></td>    
                      <td align="center"><?php echo $data_techo['TOtros']?></td>    
                      <td align="center"><?php echo $data_techo['Total']?></td>
                </tr>
            <?php } 

             sqlsrv_free_stmt( $stmt4);

            ?>
         
                                
        </table>


   <?php 

                    $sql5 = "SELECT                      
                              Nivel,
                              FecIniMes,
                              FecIniAnio,
                              PR_FracOtrosUsos.CodPersona,
                              NroLicenciaFunc,
                              Uso,
                              AreaConstruida,
                              PR_Persona.NombreCompleto as contribuyente                          

                            FROM    PR_FracOtrosUsos,PR_Persona
                            WHERE  CodPredio = '$CodPredio' AND PR_FracOtrosUsos.CodPersona=PR_Persona.CodPersona";

                     $stmt5 = sqlsrv_query($conn,$sql5);

                     if( $stmt5 === false) {
        
                     die( print_r( sqlsrv_errors(), true) ); }

   ?>
   <br>
          <table>
                <tbody>
                  <tr>
                      <td align="left" colspan="6"><strong>FRAC. OTROS USOS</strong></td> 
                  </tr>
                  <tr>            
                      <td align="left">NIVEL</td>    
                      <td align="left">FECHA INICIO</td>      
                      <td align="left">CONTRIBUYENTE</td>  
                      <td align="left">NRO LICENCIA FUNCIONAMIENTO</td>  
                      <td align="left">USO</td>  
                      <td align="left">AREA CONSTRUIDA</td>  
                                                                                                                              
                  </tr>
                </tbody>                   
            
                  <?php while($data_usos=sqlsrv_fetch_array( $stmt5, SQLSRV_FETCH_ASSOC)){ ?>
                      <tr>
                      <td align="left"><?php echo $data_usos['Nivel']?></td>    
                      <td align="left"><?php echo $data_usos['FecIniMes'].'/'.$data_usos['FecIniAnio']?></td>    
                      <td align="left"><?php echo $data_usos['contribuyente']?></td>    
                      <td align="left"><?php echo $data_usos['NroLicenciaFunc']?></td>    
                      <td align="left"><?php echo $data_usos['Uso']?></td>   
                      <td align="left"><?php echo $data_usos['AreaConstruida']?></td>   
                      </tr>
                      <?php } 

                      sqlsrv_free_stmt( $stmt5);
                      sqlsrv_close($conn);
                        
                      ?>
          </table>

    <br><table style='page-break-after:always;'></br></table><br> 
    

  </body>

  