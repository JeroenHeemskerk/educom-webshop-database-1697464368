<?php

    function getCartHeader() {
        return "Winkelwagen";
    }

    function showCartBody($data) {
        echo '<br>';
        print_r($data);
        echo '<br><br>';
        print_r($_SESSION);
        echo '<br><br>';
        print_r($_POST);
        //echo '<br><br>';
        //$cartLines = $data['cartLines'];
        //print_r($cartLines);
        //echo '<br><br>';
        //print_r($cartLines[2]);
        //echo '<br><br>';
        //print_r($cartLines[2]['amount']);


        if (!empty($data['cartLines'])){
            showTable($data);
            showBuyAction('Koop nu!');
        } else {
            echo '<h2>Er is nog niets te tonen nu de winkelmand nog leeg is. U kunt in de webshop ' . 
            'iets toevoegen om aan te schaffen en dit op deze pagina afrekenen.</h2>';
        }        
    }

    function showTable($data) {

        tableStart();
        rowStart();
        headerCell('Foto:'); 
        headerCell('Product:');
        headerCell('Beschrijving:');
        headerCell('Prijs per stuk:');
        headerCell('Hoeveelheid:');
        headerCell('Subtotaal:');
        rowEnd();
        
        foreach ($data['cartLines'] as $product_id => $value){
            rowStart();
            dataCell('<img class="tablePicture" src="' . $data['cartLines'][$product_id]['product_picture_location'] . '" alt="Een foto">', $product_id);
            dataCell($data['cartLines'][$product_id]['name'], $product_id);
            dataCell($data['cartLines'][$product_id]['description'], $product_id);
            dataCell('€' . $data['cartLines'][$product_id]['price']);
            dataCell($data['cartLines'][$product_id]['amount']);
            dataCell('€'. $data['cartLines'][$product_id]['subTotal']);
            rowEnd();
        }
    
        rowStart(); 
        dataCell('', '', 4);
        dataCell('Totaal:');  
        dataCell('€' . $data['total']);
        rowEnd();
        tableEnd();
    }
?>