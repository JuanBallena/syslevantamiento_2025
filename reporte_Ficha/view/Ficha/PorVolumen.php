<?php 
    // echo "SESION LOTE: ".$_SESSION['Lote']."<br>";
    //echo getcwd() . "\n";

    if(isset($_SESSION['Lote'])) :
        $Id_Lote = trim($_SESSION['Lote']);

        # Obtenemos el lote
        $oLotes = new Lotes();
        $Lotes = $oLotes->ObtenerLotes($Id_Lote);

        ##echo "<pre>";
        ##var_dump($Lotes);
        ##echo "</pre>";

        # Obtenemos las fichas que corresponden al lote.
        if(!empty($Lotes)):
            foreach ($Lotes as $lote):
                $_SESSION['Lote'] = $lote->Id_Lote;
                require 'view/Ficha/PorLote.php';
            endforeach;           
        endif;
    endif; 

    if(isset($oLotes)) unset($oLotes);
    if(isset($Lotes)) unset($Lotes);
?>