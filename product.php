<?php
    
	function getProductHeader() {
        return "Webshop";
    }
    
    function showProductBody($data) {
        
    echo '<h2>' . $data['item']["name"] . '</h2>';
    echo '<img src="' . $data['item']["product_picture_location"] . '" class="productpage" alt="Een foto"><br>' .
    'Product id: ' . $data['item']["product_id"] . '<br>' .
    'Artikel: ' . $data['item']["name"] . '<br>' .
    'Beschrijving: ' . $data['item']["description"] . '<br>' .
    'Prijs: €' . $data['item']["price"] . '<br>';
    }
?>