<?php

    function getOrdersHeader() {
        return "Bestellingen";
    }

    function showOrdersBody($data) {
        echo '<h2>Uw bestellingen:</h2>';

        tableStart();
        rowStart();
        headerCell('Bestelling ID');
        headerCell('Totaal');
        rowEnd();
        
        foreach($data['orders'] as $value){
            rowStart();
            dataCell($value['order_id']);
            dataCell('€' . $value['total']);
            rowEnd();
        }
        
        tableEnd();
    }
?>