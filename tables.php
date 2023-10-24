<?php

function dataCell($value = "", $product_id = "", $colspan = 1) {
    if ($product_id != ""){
        echo '<td colspan="' . $colspan . '"><a class="productLink" href="index.php?page=details&product_id=' . $product_id . '"><div class="pagetext">' . $value . '</div></a></td>';
    } else {
        echo '<td colspan="' . $colspan . '">' . $value . '</td>';
    }    
}

function headerCell($value) {
    echo '<th>' . $value . '</th>';
}

function rowStart() {
    echo '<tr>';
}

function rowEnd() {
    echo '</tr>';
}

function tableStart() {
    echo '<table class="center">';
}

function tableEnd() {
    echo '</table>';
}
?>