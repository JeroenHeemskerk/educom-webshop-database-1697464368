<?php
    
	function getProductHeader() {
        return "Product";
    }
    
    function showProductBody($data) {
        
        echo '<h2>' . $data['product']["name"] . '</h2>';

        print_r($_SESSION);
        echo '<br><br>';
        print_r($data);
        echo '<br><br>';

        echo '<img src="' . $data['product']["product_picture_location"] . '" class="productpage" alt="Een foto"><br>' .
        'Product id: ' . $data['product']["product_id"] . '<br>' .
        'Artikel: ' . $data['product']["name"] . '<br>' .
        'Beschrijving: ' . $data['product']["description"] . '<br>' .
        'Prijs: €' . $data['product']["price"] . '<br>';

        echo '<span>' . $data['errProduct_id'] . '</span><br>' .
        '<span>' . $data['errQuantity'] . '</span><br>';

        showShopBuyAction($data['product']['product_id'], 'details', 'Voeg toe aan winkelwagen');
    }
?>