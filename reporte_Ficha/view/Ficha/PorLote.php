<?php 
    // echo "SESION LOTE: ".$_SESSION['Lote']."<br>";
    //echo getcwd() . "\n";

    if(isset($_SESSION['Lote'])) :
        $Id_Lote = trim($_SESSION['Lote']);

        # Obtenemos el lote
        $oLote = new Lotes();
        $Lote = $oLote->ObtenerLote($Id_Lote);

        #echo "<pre>";
        #var_dump($Lote);
        #echo "</pre>";

        # Obtenemos las fichas que corresponden al lote.
        if(!empty($Lote)):
            $oFichas = new Fichas();
            $Fichas = $oFichas->ObtenerFichas($Lote->IdLote);
        endif;

        foreach ($Fichas as $ficha):
            $_SESSION['Tipo'] = $ficha->Tip_Ficha;
            $_SESSION['Ficha'] = $ficha->Id_Ficha;

            #echo "<pre>";
            #var_dump($ficha);
            #echo "</pre>";

            if($_SESSION['Tipo'] == '01'):
                //CrearIndividualPDF();
                require 'view/Ficha/Individual.php';
            elseif($_SESSION['Tipo'] == '02'):
                //CrearCotitularPDF();
                require 'view/Ficha/Cotitular.php';
            elseif($_SESSION['Tipo'] == '03'):
                //CrearEconomicaPDF();
                require 'view/Ficha/Economica.php';
            else:
                //CrearBienComunPDF();
                require 'view/Ficha/BienComun.php';
            endif;
        endforeach;

    endif;  
    
    if(isset($oLote)) unset($oLote);
    if(isset($Lote)) unset($Lote);

    if(isset($oFichas)) unset($oFichas);
    if(isset($Fichas)) unset($Fichas);
    if(isset($ficha)) unset($ficha);
?>