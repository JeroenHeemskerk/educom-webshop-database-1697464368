<?php
    
	function getProductHeader() {
        return "Product";
    }
    
    function showProductBody($data) {
        
        echo '<h2>' . $data['product']["name"] . '</h2>';

        echo '<img src="/educom-webshop-database-1697464368/Images/' . $data['product']["product_picture_location"] . '" class="detailPicture" alt="' . $data['products'][$i]['product_picture_location'] . '"><br>' .
        'Artikel: ' . $data['product']["name"] . '<br>' .
        'Beschrijving: ' . $data['product']["description"] . '<br>' .
        'Prijs: €' . $data['product']["price"] . '<br>';

        echo '<span>' . $data['errProduct_id'] . '</span><br>' .
        '<span>' . $data['errQuantity'] . '</span><br>';

        showAddToCartAction($data['product']['product_id'], 'details', 'Voeg toe aan winkelwagen');
    }
?>