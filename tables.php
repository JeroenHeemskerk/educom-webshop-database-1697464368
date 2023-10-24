<?php

function showTable($data) {

    print_r($data);
    tableStart();
    echo '<tr>' . 
    headerCell('Product id:') . 
    headerCell('Naam:') . 
    headerCell('Beschrijving:') . 
    headerCell('Prijs:') . 
    headerCell('Foto:') . 
    headerCell('Hoeveelheid') . 
    '</tr>';

    /*
    echo '<tr>' . 
        '<td>' . $data['product']['product_id'] . '</td>' . 
        '<td>' . $data['product']['name'] . '</td>' . 
        '<td>' . $data['product']['description'] . '</td>' . 
        '<td>' . $data['product']['price'] . '</td>' . 
        '<td>' . $data['product']['product_picture_location'] . '</td>' . 
        '<td>' . $data['cart'][$data['product']['product_id']] . '</td>' .
        '</tr>';
        */
    
    echo '<tr>';
    foreach ($data['cart'] as $product_id => $amount){
        foreach ($data['products'][$product_id] as $key => $value){
            echo '<td>' . $value . '</td>';
        }
        echo '<td>' . $amount . '</td>';
    }
    echo '</tr>';
    
    echo '<tr>' . 
    dataCell() . 
    dataCell() . 
    dataCell() . 
    dataCell() . 
    dataCell() . 
    dataCell(/*Totaal*/) . 
    '</tr>';

    tableEnd();
}

function dataCell($value = "") {
    echo '<td>' . $value . '<td>';
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