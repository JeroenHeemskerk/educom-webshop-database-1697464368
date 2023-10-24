<?php

    function getCartHeader() {
        return "Winkelwagen";
    }

    function showCartBody($data) {
        echo '<br>';

        if (!empty($data['cartLines'])){
            print_r($data);
            showTable($data);
            showBuyAction('Koop nu!');
        } else {
            echo '<h2>Er is nog niets te tonen nu de winkelmand nog leeg is. U kunt in de webshop ' . 
            'iets toevoegen om aan te schaffen en dit op deze pagina afrekenen.</h2>';
        }
        
    }

?>