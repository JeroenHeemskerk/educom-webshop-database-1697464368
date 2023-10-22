<?php
    
	function getProductHeader() {
        return "Webshop";
    }
    
    function showProductBody($data) {
        
        echo '<h2>' . $data['product']["name"] . '</h2>';

        print_r($_SESSION);
        echo '<br><br>';

        echo '<img src="' . $data['product']["product_picture_location"] . '" class="productpage" alt="Een foto"><br>' .
        'Product id: ' . $data['product']["product_id"] . '<br>' .
        'Artikel: ' . $data['product']["name"] . '<br>' .
        'Beschrijving: ' . $data['product']["description"] . '<br>' .
        'Prijs: €' . $data['product']["price"] . '<br>';
    
        showIncrementButton($data['product']['product_id'], $data['product']["product_id"]);
    }
?>