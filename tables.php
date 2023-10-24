<?php

function showTable($data) {

    print_r($data);
    echo '<br><br><br>';

    tableStart();
    echo '<tr>';  
    headerCell('Foto:'); 
    headerCell('Naam:');
    headerCell('Beschrijving:');
    headerCell('Prijs per stuk:');
    headerCell('Hoeveelheid:');
    headerCell('Subtotaal:');
    echo '</tr>';
    
    foreach ($data['cartLines'] as $product_id => $value){
        echo '<tr>';
        dataCell('<img src="' . $data['cartLines'][$product_id]['product_picture_location'] . '" alt="Een foto">');
        dataCell($data['cartLines'][$product_id]['name']);
        dataCell($data['cartLines'][$product_id]['description']);
        dataCell('€' . $data['cartLines'][$product_id]['price']);
        dataCell($data['cartLines'][$product_id]['amount']);
        dataCell('€'. $data['cartLines'][$product_id]['subTotal']);
        echo '</tr>';
    }

    tableEnd();
}

function dataCell($value = "") {
    echo '<td>' . $value . '</td>';
}

function headerCell($value) {
    echo '<th>' . $value . '</th>';
}

function tableStart() {
    echo '<table>';
}

function tableEnd() {
    echo '</table>';
}
?>