<?php

    function getCartHeader() {
        return "Winkelmandje";
    }

    function showCartBody($data) {
        echo '<h2>Pagina wordt nog gebouwd</h2>';

        if (!empty($data['cart'])){
            showTable($data);
        } else {
            echo '<h2>Er is nog niets te tonen nu de winkelmand nog leeg is. U kunt in de webshop ' . 
            'iets toevoegen om aan te schaffen en dit op deze pagina afrekenen.</h2>';
        }
        
    }

?>